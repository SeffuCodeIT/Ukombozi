<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\Cart;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;


class BooksController extends Controller
{

    public function getToken()
    {
        $response = Http::post('https://www.members.ukombozilibrary.org/api/token/', [
            'username' => env('UKOMBOZI_CLIENT_ID'),
            'password' => env('UKOMBOZI_CLIENT_SECRET'),
            'grant_type' => 'client_credentials',
        ]);

        if ($response->successful()) {
            return $response->json(); // Returns access_token and refresh_token
        }

        // Capture and return error details for debugging
        return response()->json([
            'error' => 'Failed to get token',
            'status' => $response->status(),
            'message' => $response->json() ?? $response->body() // Get error message if available
        ], $response->status());
    }


    public function getBooks()
    {
        $tokenResponse = $this->getToken();

        if (!isset($tokenResponse['access'])) {
            return response()->json(['error' => 'Failed to retrieve access token'], 401);
        }

        $accessToken = $tokenResponse['access'];
        $apiUrl = 'https://www.members.ukombozilibrary.org/api/books/'; // First page URL
        $totalBooks = 0;

        while ($apiUrl) { // Loop until no more pages exist
            $response = Http::withToken($accessToken)->get($apiUrl);

            if (!$response->successful()) {
                return response()->json([
                    'error' => 'Failed to fetch books',
                    'status' => $response->status(),
                    'message' => $response->json() ?? $response->body()
                ], $response->status());
            }

            $data = $response->json();

            // Debug: Log API response structure
            \Log::info('API Response:', $data);

            $books = $data['results'] ?? $data; // Adjust if books are inside 'results'

            if (!is_array($books)) {
                return response()->json(['error' => 'Unexpected API response format'], 500);
            }

            foreach ($books as $book) {
                $publicationYear = $book['publication_year'] ?? null;
                $printDate = $publicationYear ? "{$publicationYear}-01-01" : null;

                // Extract category ID from genre URL
                $category = null;
                if (!empty($book['genre']) && is_array($book['genre'])) {
                    $categoryUrl = $book['genre'][0] ?? null;
                    if ($categoryUrl) {
                        $categoryParts = explode('/', rtrim($categoryUrl, '/'));
                        $category = end($categoryParts);
                        $category = is_numeric($category) ? (int)$category : null;
                    }
                }

                // Insert into database
                Books::create([
                    'title' => $book['title'],
                    'author_name' => $book['author'],
                    's_author_name' => $book['editor'] ?? '',
                    'print_date' => $printDate,
                    'book_summary' => $book['summary'] ?? '',
                    'book_price' => $book['price'] ?? 0,
                    'stock_quantity' => 10,
                    'cover_pic' => $book['cover_image'] ?? $book['cover_url'] ?? '',
                    'publisher' => $book['publisher'] ?? '',
                    'category' => $category,
                    'status' => 1,
                    'seo' => str_slug($book['title']),
                ]);

                $totalBooks++;
            }

            // Update URL for next page
            $apiUrl = $data['next'] ?? null; // Check if 'next' exists in API response

            // Debug: Log pagination info
            \Log::info("Next Page URL: " . ($apiUrl ?? 'No more pages'));
        }

        return response()->json(['message' => "Books populated successfully! Total books: $totalBooks"]);
    }


    public function getBooksCount()
    {
        $tokenResponse = $this->getToken();

        if (!isset($tokenResponse['access'])) {
            return response()->json(['error' => 'Failed to retrieve access token'], 401);
        }

        $accessToken = $tokenResponse['access'];


        $url = "https://www.members.ukombozilibrary.org/api/books/";

        $response = Http::withToken($accessToken)->get($url);

        if ($response->successful()) {
            $books = $response->json();
            return count($books); // Return total number of books
        }

        \Log::error('Failed to fetch books', ['response' => $response->body()]);
        return "Failed to fetch books.";
    }


    public function updateBookCovers()
    {
        // Get books with missing cover_pic
        $books = Books::whereNull('cover_pic')->orWhere('cover_pic', '')->get();

        $tokenResponse = $this->getToken();

        if (!isset($tokenResponse['access'])) {
            return response()->json(['error' => 'Failed to retrieve access token'], 401);
        }

        $accessToken = $tokenResponse['access'];


        foreach ($books as $book) {
            Log::info("Updating book: {$book->id}"); // Log progress

            $response = Http::withToken($accessToken)->timeout(10)->get("https://www.members.ukombozilibrary.org/api/books/{$book->id}/");

            if (!$response->successful()) {
                Log::warning("Failed to fetch book: {$book->id}");
                continue; // Skip this book if the API call fails
            }

            $bookData = $response->json();
            $coverPic = $bookData['cover_image'] ?? $bookData['cover_url'] ?? null;

            if ($coverPic) {
                $book->cover_pic = $coverPic;
                $book->save();
                Log::info("Cover updated for book: {$book->id}");
            }
        }

        return response()->json(['message' => 'Book covers updated successfully']);
    }




    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function payment()
    {
        //
    }

    public function checkout()
    {
        //
        $user = Auth::user();
        $cart = \App\Models\Cart::where('phone', $user->phone)->get();
        return view("main.checkout", compact("cart", "user"));

    }
    public function updateCart(Request $request)
    {
        $user = Auth::user();

        // Loop through the input quantities using item IDs
        foreach ($request->quantities as $cartItemId => $quantity) {
            // Find the cart item by ID
            $cartItem = Cart::find($cartItemId);

            // Ensure the cart item belongs to the user
            if ($cartItem && $cartItem->phone == $user->phone) {
                // Update the quantity
                $cartItem->quantity = $quantity;
                $cartItem->save();
            }
        }

        // Redirect back to the cart page with a success message
        return redirect()->route('showCart')->with('success', 'Cart updated successfully!');
    }

//    public function removeItem($id)
//    {
//        Cart::destroy($id);
//        return redirect()->back()->with('success', 'Book removed successfully!');
//    }
    public function removeItem($id)
    {
        try {
            // Log the current cart status before deletion
            Log::info('Removing item from cart: ' . $id);

            // Delete the item
            Cart::destroy($id);

            // Log the action
            Log::info('Item removed successfully: ' . $id);

            // Check if there are any items left in the cart
            $user = Auth::user();
            $remainingItems = Cart::where('phone', $user->phone)->count();

            Log::info('Remaining items in cart: ' . $remainingItems);

            if ($remainingItems == 0) {
                // Log when cart is empty
                Log::info('Cart is now empty after removing item: ' . $id);
                return redirect()->back()->with('success', 'Item removed successfully! Your cart is now empty.');
            }

            return redirect()->back()->with('success', 'Book removed successfully!');
        } catch (\Exception $e) {
            // Log any errors
            Log::error('Error removing item from cart: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to remove the book. Please try again.');
        }
    }



    public function showCart()
    {
        $user = Auth::user();
        $count = \App\Models\Cart::where('phone', $user->phone)->count();
        $cart = \App\Models\Cart::where('phone', $user->phone)->get();

        return view('main.cart', compact('cart', 'user', 'count'));
    }

    public function category(Request $request)
    {
        //
        $data = new Categories();

        $data->category_title = $request->category_title;
        $data->category_slug = $request->category_slug;

        $data->save();


        return redirect()->back()
            ->with('success', 'Category created successfully.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $bookDetails = $request->all();

        if ($coverPicFile = $request->file('cover_pic')) {
            $coverPicFileName = time() . $coverPicFile->getClientOriginalName();
            $coverPicFile->move('book-pics', $coverPicFileName);
            $bookDetails["cover_pic"] = $coverPicFileName;
            Books::create($bookDetails);
            Session::flash('success', 'Book added successfully');
            return redirect()->back();
        } else {
            Session::flash('error', 'Book addition failed');
            return redirect()->back();
        }

    }

    public function addCart(Request $request, $id)
    {
        if (Auth::id()) {

            $user = Auth::user();
            $cart = new Cart();
            $product = Books::find($id);

            $cart->name = $user->name;
            $cart->phone = $user->phone;
            $cart->address = $user->address;
            $cart->title = $product->title;
            $cart->price = $product->book_price;
            $cart->quantity = $request->quantity;
            $cart->save();
            if ($cart->save()) {
                Session::flash('success', 'Book added to cart successfully');

            } else {
                Session::flash('error', 'Book addition failed');
                return redirect()->back();

            }

            return redirect()->back();
        } else {
            return redirect('login');
        }


//        return "id is" . $id;
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
