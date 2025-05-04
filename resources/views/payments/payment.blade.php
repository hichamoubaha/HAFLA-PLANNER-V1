<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment - {{ $booking->event->title }}</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        .payment-card {
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .payment-method {
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .payment-method:hover {
            border-color: #007bff;
            transform: translateY(-2px);
        }
        .payment-method.active {
            border-color: #007bff;
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Payment Details</h4>
                    </div>
                    <div class="card-body">
                        <div class="payment-card">
                            <h5 class="mb-3">Event: {{ $booking->event->title }}</h5>
                            <p class="mb-2"><strong>Price:</strong> {{ $booking->event->price }}€</p>
                            <p class="mb-2"><strong>Date:</strong> {{ $booking->event->date }}</p>
                            <p><strong>Location:</strong> {{ $booking->event->location }}</p>
                        </div>

                        <form action="{{ route('payment.process', $booking) }}" method="POST">
                            @csrf
                            
                            <div class="mb-3">
                                <label for="amount" class="form-label">Amount to Pay</label>
                                <input type="number" class="form-control" id="amount" name="amount" 
                                       value="{{ $booking->event->price }}" min="0" step="0.01" required>
                            </div>

                            <div id="payment-methods">
                                <div class="payment-method active" data-method="credit_card">
                                    <i class="fas fa-credit-card me-2"></i>Credit Card
                                </div>
                                <div class="payment-method" data-method="paypal">
                                    <i class="fab fa-paypal me-2"></i>PayPal
                                </div>
                                <div class="payment-method" data-method="bank_transfer">
                                    <i class="fas fa-university me-2"></i>Bank Transfer
                                </div>
                            </div>

                            <input type="hidden" name="payment_method" id="selected_payment_method" value="credit_card">

                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-credit-card me-2"></i>Pay Now
                                </button>
                                <a href="{{ route('bookings.index') }}" class="btn btn-secondary ms-2">
                                    <i class="fas fa-arrow-left me-2"></i>Cancel
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.payment-method').forEach(method => {
            method.addEventListener('click', function() {
                // Remove active class from all methods
                document.querySelectorAll('.payment-method').forEach(m => m.classList.remove('active'));
                
                // Add active class to clicked method
                this.classList.add('active');
                
                // Update hidden input value
                document.getElementById('selected_payment_method').value = this.dataset.method;
            });
        });
    </script>
</body>
</html>
