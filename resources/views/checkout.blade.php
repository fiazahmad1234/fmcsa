@extends('layout.app')

@section('content')
<div class="container mt-5 mb-5 py-5">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <!-- Card Wrapper -->
            <div class="card mt-5 shadow-lg border-0 rounded-4">
                <div class="card-body p-5">
                    <!-- Stripe Logo -->
                    <div class="text-center">
                        <h3 class="mt-3 fw-bold">Secure Payment</h3>
                        <p class="text-muted fs-6">Checkout</p>
                    </div>

                    <!-- Flash Messages -->
                    @if(session('success'))
                        <div class="alert alert-success shadow-sm">{{ session('success') }}</div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger shadow-sm">{{ session('error') }}</div>
                    @endif

                    <div class="row bg-light shadow-sm rounded-4">
                        <!-- LEFT COLUMN (col-md-8) -->
                        <div class="col-md-8">
                            <form id="payment-form" method="POST" action="{{ route('checkout.process') }}">
                                @csrf

                                <h4 class="mb-4 fw-bold text-black">Billing Details</h4>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">Full Name</label>
                                    <input type="text" name="name" class="form-control rounded-3 shadow-sm" placeholder="John Doe" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">Email</label>
                                    <input type="email" name="email" class="form-control rounded-3 shadow-sm" placeholder="john@example.com" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">Phone Number</label>
                                    <input type="text" name="phone" class="form-control rounded-3 shadow-sm" placeholder="+1 234 567 890" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">Address</label>
                                    <input type="text" name="address" class="form-control rounded-3 shadow-sm" placeholder="123 Main St, City" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">Amount (USD)</label>
                                    <input type="number" name="amount" class="form-control rounded-3 shadow-sm" placeholder="50" required>
                                </div>
                        </div>

                        <!-- RIGHT COLUMN (col-md-4) -->
                        <div class="col-md-4">
                            <div class="p-4 border rounded-4 shadow-sm bg-white h-100">
                                <h4 class="fw-bold mb-4 text-black">Payment Method</h4>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">Card Details</label>
                                    <div id="card-element" class="form-control p-3 rounded-3 shadow-sm"></div>
                                    <div id="card-errors" role="alert" class="text-danger mt-2 small"></div>
                                </div>

                                <input type="hidden" name="payment_method_id" id="payment_method_id">

                                <button type="submit" class="btn btn-primary btn-lg w-100 mt-4 fw-bold shadow-sm">
                                    <i class="bi bi-credit-card me-2"></i> Pay Now
                                </button>

                                <p class="text-center text-muted mt-3 small">
                                    Your payment is secure and encrypted via Stripe.
                                </p>

                                <!-- Accepted Cards -->
                                <div class="d-flex justify-content-center mt-3 gap-3">
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/5/5e/Visa_Inc._logo.svg" height="30">
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/2/2a/Mastercard-logo.svg" height="30">
<img src="https://upload.wikimedia.org/wikipedia/commons/b/ba/Stripe_Logo%2C_revised_2016.svg" alt="Stripe Logo" height="40">
</div>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Stripe JS -->
<script src="https://js.stripe.com/v3/"></script>
<script>
    const stripe = Stripe('{{ env("STRIPE_KEY") }}');
    const elements = stripe.elements();

    const cardElement = elements.create('card', {
        style: {
            base: {
                fontSize: '16px',
                color: '#32325d',
                '::placeholder': { color: '#aab7c4' },
                fontFamily: 'Arial, sans-serif',
            },
            invalid: { color: '#fa755a' }
        }
    });

    cardElement.mount('#card-element');

    const form = document.getElementById('payment-form');
    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        const { paymentMethod, error } = await stripe.createPaymentMethod('card', cardElement);
        if(error) {
            document.getElementById('card-errors').textContent = error.message;
        } else {
            document.getElementById('payment_method_id').value = paymentMethod.id;
            form.submit();
        }
    });
</script>

<style>
body {
    background-color:white;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.card {
    border-radius: 20px;
}

.card-body {
    padding: 3rem;
}

#card-element {
    border-radius: 10px;
    border: 1px solid #ced4da;
}

.form-control {
    border: 1px solid #ced4da;
    padding: 0.75rem;
    transition: all 0.3s;
}

.form-control:focus {
    border-color: #03a4ed;
    box-shadow: 0 0 0 0.2rem rgba(3,164,237,0.25);
}

button.btn-primary {
    background-color: #03a4ed;
    border-color: #03a4ed;
    transition: all 0.3s;
}

button.btn-primary:hover {
    background-color: #0284c7;
    border-color: #0284c7;
}

.bg-light {
    background-color: #ffffff !important;
}
</style>
@endsection
