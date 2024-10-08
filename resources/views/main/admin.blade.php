@extends("layout.index")
@section("content")
{{--start of adding new category--}}
    <hr class="mt-3 mb-5 mt-md-1">
    <div class="row justify-content-center">
        <div class="col-md-9 col-lg-7">
            <div class="text-center">
                <h2 class="title mb-1">Add New Category</h2>
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                {{-- Error Messages --}}
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <p class="lead text-primary">
                    Organize your books by adding categories.
                </p>
                <p class="mb-3">Please provide a title and a slug for the new category.</p>
            </div>

            <form action="{{url('/category')}}" method="POST" class="category-form mb-2">
                @csrf <!-- Laravel's CSRF protection -->
                <div class="row">
                    <div class="col-sm-6">
                        <label for="category_title" class="sr-only">Category Title</label>
                        <input type="text" class="form-control" id="category_title" name="category_title" placeholder="Category Title *" required>
                    </div>

                    <div class="col-sm-6">
                        <label for="category_slug" class="sr-only">Slug</label>
                        <input type="text" class="form-control" id="category_slug" name="category_slug" placeholder="Slug *" required>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-outline-primary-2 btn-minwidth-sm">
                        <span>SUBMIT</span>
                        <i class="icon-long-arrow-right"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
{{--end of adding new category--}}
{{--start of adding new book--}}
<hr class="mt-5 mb-5 mt-md-1">
<div class="row justify-content-center">
    <div class="col-md-9 col-lg-7">
        <div class="text-center">
            <h2 class="title mb-1">Add New Book</h2>
            {{-- Success Message --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            {{-- Error Messages --}}
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <p class="lead text-primary">
                Fill in the details to add a new book to your collection.
            </p>
            <p class="mb-3">Please provide all necessary information about the book.</p>
        </div>

        <form action="{{url('/save-book')}}" method="POST" class="book-form mb-2" enctype="multipart/form-data">
            @csrf <!-- Laravel's CSRF protection -->

            <!-- Title -->
            <div class="row">
                <div class="col-sm-6">
                    <label for="title" class="sr-only">Title</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Book Title *" required>
                </div>

                <div class="col-sm-6">
                    <label for="author_name" class="sr-only">Author Name</label>
                    <input type="text" class="form-control" id="author_name" name="author_name" placeholder="Author Name *" required>
                </div>
            </div>

            <!-- Second Author Name -->
            <div class="row mt-3">
                <div class="col-sm-6">
                    <label for="s_author_name" class="sr-only">Second Author Name</label>
                    <input type="text" class="form-control" id="s_author_name" name="s_author_name" placeholder="Second Author Name">
                </div>

                <div class="col-sm-6">
                    <label for="print_date" class="sr-only">Print Date</label>
                    <input type="date" class="form-control" id="print_date" name="print_date" placeholder="Print Date *" required>
                </div>
            </div>

            <!-- Book Summary -->
            <div class="mt-3">
                <label for="book_summary" class="sr-only">Book Summary</label>
                <textarea class="form-control" id="book_summary" name="book_summary" placeholder="Book Summary *" rows="4" required></textarea>
            </div>

            <!-- Book Price and Stock Quantity -->
            <div class="row mt-3">
                <div class="col-sm-6">
                    <label for="book_price" class="sr-only">Book Price</label>
                    <input type="number" class="form-control" id="book_price" name="book_price" placeholder="Book Price *" step="0.01" required>
                </div>

                <div class="col-sm-6">
                    <label for="stock_quantity" class="sr-only">Stock Quantity</label>
                    <input type="number" class="form-control" id="stock_quantity" name="stock_quantity" placeholder="Stock Quantity *" required>
                </div>
            </div>

            <!-- Cover Picture -->
            <div class="mt-3">
                <label for="cover_pic" class="sr-only">Cover Picture</label>
                <input type="file" class="form-control" id="cover_pic" name="cover_pic" required>
            </div>

            <!-- Publisher and Category -->
            <div class="row mt-3">
                <div class="col-sm-6">
                    <label for="publisher" class="sr-only">Publisher</label>
                    <input type="text" class="form-control" id="publisher" name="publisher" placeholder="Publisher *" required>
                </div>

                <div class="col-sm-6">
                    <label for="category" class="sr-only">Category</label>
                    <select class="form-control" id="category" name="category" required>
                        <option value="">Select Category *</option>
                        <!-- Loop through categories in the backend to populate this dropdown -->
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->category_slug }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Status and SEO -->
            <div class="row mt-3">
                <div class="col-sm-6">
                    <label for="status" class="sr-only">Status</label>
                    <select class="form-control" id="status" name="status" required>
                        <option value="">Select Status *</option>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>

                <div class="col-sm-6">
                    <label for="seo" class="sr-only">SEO</label>
                    <input type="text" class="form-control" id="seo" name="seo" placeholder="SEO Title *" required>
                </div>
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-outline-primary-2 btn-minwidth-sm">
                    <span>SUBMIT</span>
                    <i class="icon-long-arrow-right"></i>
                </button>
            </div>
        </form>
    </div>
</div>

{{--end of adding new book--}}
@endsection

