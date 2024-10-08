<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\Cart;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class BooksController extends Controller
{
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
