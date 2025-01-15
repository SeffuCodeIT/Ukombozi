@extends("layout.index")
@section("content")
    <main class="main" style="background-color: #fff;">
        <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
            <div class="container">
                <h1 class="page-title">Checkout<span>Shop</span></h1>
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
            </div><!-- End .container -->
        </div><!-- End .page-header -->
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Shop</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                </ol>
            </div><!-- End .container -->
        </nav><!-- End .breadcrumb-nav -->

        <div class="page-content">
            <div class="checkout">
                <div class="container">
                    <div class="checkout-discount">
                        <form action="#">
                            <input type="text" class="form-control" required id="checkout-discount-input">
                            <label for="checkout-discount-input" class="text-truncate">Have a coupon? <span>Click here to enter your code</span></label>
                        </form>
                    </div><!-- End .checkout-discount -->
                    <form action="{{url("submitOrderRequest")}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-lg-9">
                                <h2 class="checkout-title">Billing Details</h2><!-- End .checkout-title -->
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>First Name *</label>
                                        <input type="text" class="form-control" value="{{$user->name}}" name="first_name" style="font-weight: bold;" required>
                                    </div><!-- End .col-sm-6 -->

{{--                                    <div class="col-sm-6">--}}
{{--                                        <label>Last Name (optional)</label>--}}
{{--                                        <input type="text" class="form-control" required>--}}
{{--                                    </div><!-- End .col-sm-6 -->--}}
                                </div><!-- End .row -->


                                <label>Country *</label>
                                <input type="text" class="form-control" required value="Kenya" name="country" style="font-weight: bold;">

                                <label>County *</label>
                                <input type="text" class="form-control" name="county" required placeholder="Nairobi">

                                <label>Constituency *</label>
                                <input type="text" class="form-control" name="constituency"  placeholder="Dagoretti South" required>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>Street address *</label>
                                        <input type="text" class="form-control" name="street_address" value="{{$user->address}}" required style="font-weight: bold;">
                                    </div><!-- End .col-sm-6 -->

                                    <div class="col-sm-6">
                                        <label>Popular Landmark *</label>
                                        <input type="text" class="form-control" name="landmark" required placeholder="Appartments, suite, unit etc ...">
                                    </div><!-- End .col-sm-6 -->
                                </div><!-- End .row -->

                                <div class="row">
{{--                                    <div class="col-sm-6">--}}
{{--                                        <label>Postcode / ZIP *</label>--}}
{{--                                        <input type="text" class="form-control" required>--}}
{{--                                    </div><!-- End .col-sm-6 -->--}}

                                    <div class="col-sm-6">
                                        <label>Phone *</label>
                                        <input type="tel" class="form-control" name="phone" style="font-weight: bold;" value="254{{$user->phone}}" required>
                                    </div><!-- End .col-sm-6 -->
                                </div><!-- End .row -->

                                <label>Email address *</label>
                                <input type="email" class="form-control" name="email" value="{{$user->email}}" required style="font-weight: bold;">

                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox"  class="custom-control-input" id="checkout-create-acc" ">
                                    <label class="custom-control-label" for="checkout-create-acc">Create an account?  (optional)</label>
                                </div><!-- End .custom-checkbox -->

                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="checkout-diff-address">
                                    <label class="custom-control-label" for="checkout-diff-address">Ship to a different address?  (optional)</label>
                                </div><!-- End .custom-checkbox -->

                                <label>Order notes (optional)</label>
                                <textarea class="form-control" cols="30" rows="4" placeholder="Notes about your order, e.g. special notes for delivery"></textarea>
                            </div><!-- End .col-lg-9 -->
                            <aside class="col-lg-3">
                                <div class="summary">
                                    <h3 class="summary-title">Your Order</h3><!-- End .summary-title -->

                                    <table class="table table-summary">
                                        <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Total</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        @foreach($cart as $item)
                                        <tr>
                                            <td><a href="#">{{ $item->title }}</a></td>
                                            <td>Kshs {{ number_format($item->price, 2) }}</td>
                                        </tr>
                                        @endforeach

                                        <tr class="summary-subtotal">
                                            <td>Subtotal:</td>
                                            <td>Kshs {{ number_format($cart->sum(function($item) { return $item->price * $item->quantity; }), 2) }}</td>
                                        </tr><!-- End .summary-subtotal -->
                                        <tr class="summary-shipping">
                                            <td>Shipping:</td>
                                            <td>&nbsp;</td>
                                        </tr>

                                        <tr class="summary-shipping-row">
                                            <td>
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="free-shipping" name="shipping_method"  class="custom-control-input" value="0" checked>
                                                    <label class="custom-control-label" for="free-shipping">Pick up From CBD</label>
                                                </div>
                                            </td>
                                            <td>Kshs 0.00</td>
                                        </tr>

                                        <tr class="summary-shipping-row">
                                            <td>
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="standard-shipping" name="shipping_method"  class="custom-control-input" value="500">
                                                    <label class="custom-control-label" for="standard-shipping">Doorstep Delivery:</label>
                                                </div>
                                            </td>
                                            <td>Kshs 500.00</td>
                                        </tr>

                                        <tr class="summary-total">
                                            <td>Total:</td>
                                            <td>        <input type="hidden" name="total" id="total" value="{{ $cart->sum(function($item) { return $item->price * $item->quantity; }) }}">
                                            </td>
{{--                                            <td id="total" name="total">Kshs {{ number_format($cart->sum(function($item) { return $item->price * $item->quantity; }), 2) }}</td>--}}
                                        </tr>
                                        <tr class="summary-total">
                                            <td>Total:</td>
                                            <td>
                                            <input type="hidden" name="total" id="total" value="{{ $cart->sum(function($item) { return $item->price * $item->quantity; }) }}"></td>
                                        </tr>
                                        </tbody>
                                    </table><!-- End .table table-summary -->

                                    <button type="submit" class="btn btn-outline-primary-2 btn-order btn-block">
                                        <span class="btn-text">Place Order</span>
                                        <span class="btn-hover-text">Proceed to Checkout</span>
                                    </button>
                                </div><!-- End .summary -->
                            </aside><!-- End .col-lg-3 -->
                        </div><!-- End .row -->
                    </form>
                </div><!-- End .container -->
            </div><!-- End .checkout -->
        </div><!-- End .page-content -->
    </main><!-- End .main -->

    <!-- JavaScript to Update Total Price -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get elements
            const totalElement = document.getElementById('total');
            const subtotal = parseFloat("{{ $cart->sum(function($item) { return $item->price * $item->quantity; }) }}");

            // Set default total value on page load (initially set to subtotal + default shipping method, which is 0 for pickup)
            let shippingCost = document.querySelector('input[name="shipping_method"]:checked').value;
            let initialTotal = subtotal + parseFloat(shippingCost);
            totalElement.value = initialTotal.toFixed(2);
            document.querySelector('.summary-total td:last-child').innerText = 'Kshs ' + initialTotal.toFixed(2);

            // Add event listeners to the shipping options
            document.querySelectorAll('input[name="shipping_method"]').forEach((elem) => {
                elem.addEventListener('change', function(event) {
                    // Get the selected shipping cost
                    shippingCost = parseFloat(event.target.value);

                    // Calculate the new total
                    let total = subtotal + shippingCost;

                    // Update the total in the hidden input and display the new total
                    totalElement.value = total.toFixed(2); // For the hidden input field
                    document.querySelector('.summary-total td:last-child').innerText = 'Kshs ' + total.toFixed(2);
                });
            });
        });
    </script>

@endsection
