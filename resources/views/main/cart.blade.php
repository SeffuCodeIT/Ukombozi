@extends("layout.index")
@section("content")
    <main class="main" style="background-color: #fff;">
        <div class="page-header text-center" style="background-image: url('{{ asset("assets/images/page-header-bg.jpg") }}')">
            <div class="container">
                <h1 class="page-title">My Shopping Cart<span>Shop</span></h1>
            </div><!-- End .container -->
        </div><!-- End .page-header -->
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Shop</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
                </ol>
            </div><!-- End .container -->
        </nav><!-- End .breadcrumb-nav -->

        <div class="page-content">
            <div class="cart">

                <div class="container">
                    <div class="row">
                        <div class="col-lg-9">
                            <table class="table table-cart table-mobile">
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
                                <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($cart as $item)
                                    <tr>
                                        <td class="product-col">
                                            <div class="product">
                                                <figure class="product-media">
                                                    <a href="#">
                                                        <!-- Display the product image -->
                                                        <img src="{{ asset('book-pics/' . $item->book->cover_pic) }}" alt="{{ $item->product_title }}">
                                                    </a>
                                                </figure>

                                                <h3 class="product-title">
                                                    <!-- Display the product title -->
                                                    <a href="#">{{ $item->title }}</a>
                                                </h3><!-- End .product-title -->
                                            </div><!-- End .product -->
                                        </td>
                                        <!-- Display the product price -->
                                        <td class="price-col">Kshs {{ number_format($item->price, 2) }}</td>
                                        <td class="quantity-col">
                                            <div class="cart-product-quantity">
                                                <!-- Display the quantity and allow user to update it -->
                                                <input type="number" class="form-control" value="{{ $item->quantity }}" min="1" max="10" step="1" data-decimals="0" required>
                                            </div><!-- End .cart-product-quantity -->
                                        </td>
                                        <!-- Display the total price for the item (quantity * price) -->
                                        <td class="total-col">Kshs {{ number_format($item->price * $item->quantity, 2) }}</td>
                                        <td class="remove-col">
                                            <!-- Add a button to remove the product from the cart -->
                                            <form action="{{ route('removeItem', $item->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-remove"><i class="icon-close"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table><!-- End .table table-wishlist -->

                            <div class="cart-bottom">
                                <div class="cart-discount">
                                    <form action="#">
                                        <div class="input-group">
                                            <input type="text" class="form-control" required placeholder="coupon code">
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-primary-2" type="submit"><i class="icon-long-arrow-right"></i></button>
                                            </div><!-- .End .input-group-append -->
                                        </div><!-- End .input-group -->
                                    </form>
                                </div><!-- End .cart-discount -->

                                <a href="#" class="btn btn-outline-dark-2"><span>UPDATE CART</span><i class="icon-refresh"></i></a>
                            </div><!-- End .cart-bottom -->
                        </div><!-- End .col-lg-9 -->
                        <aside class="col-lg-3">
                            <div class="summary summary-cart">
                                <h3 class="summary-title">Cart Total</h3>
                                <table class="table table-summary">
                                    <tbody>
                                    <tr class="summary-subtotal">
                                        <td>Subtotal:</td>
                                        <td id="subtotal">Kshs {{ number_format($cart->sum(function($item) { return $item->price * $item->quantity; }), 2) }}</td>
                                    </tr>
                                    <tr class="summary-shipping">
                                        <td>Shipping:</td>
                                        <td>&nbsp;</td>
                                    </tr>

                                    <tr class="summary-shipping-row">
                                        <td>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="free-shipping" name="shipping" class="custom-control-input" value="0" checked>
                                                <label class="custom-control-label" for="free-shipping">Pick up From CBD</label>
                                            </div>
                                        </td>
                                        <td>Kshs 0.00</td>
                                    </tr>

                                    <tr class="summary-shipping-row">
                                        <td>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="standard-shipping" name="shipping" class="custom-control-input" value="500">
                                                <label class="custom-control-label" for="standard-shipping">Doorstep Delivery:</label>
                                            </div>
                                        </td>
                                        <td>Kshs 500.00</td>
                                    </tr>

                                    <tr class="summary-total">
                                        <td>Total:</td>
                                        <td id="total">Kshs {{ number_format($cart->sum(function($item) { return $item->price * $item->quantity; }), 2) }}</td>
                                    </tr>
                                    </tbody>
                                </table>

                                <a href="{{url("checkout")}}" class="btn btn-outline-primary-2 btn-order btn-block">PROCEED TO CHECKOUT</a>
                            </div>
                        </aside>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- JavaScript to Update Total Price -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get the subtotal from the page
            const subtotalElement = document.getElementById('subtotal');
            const totalElement = document.getElementById('total');
            let subtotal = parseFloat("{{ $cart->sum(function($item) { return $item->price * $item->quantity; }) }}");

            // Add event listeners to the shipping options
            document.querySelectorAll('input[name="shipping"]').forEach((elem) => {
                elem.addEventListener('change', function(event) {
                    // Get the selected shipping cost
                    let shippingCost = parseFloat(event.target.value);

                    // Calculate the new total
                    let total = subtotal + shippingCost;

                    // Update the total in the DOM
                    totalElement.innerText = 'Kshs ' + total.toFixed(2);
                });
            });
        });
    </script>
@endsection
