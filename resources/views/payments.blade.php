@extends('layouts.app')

@section('title', 'ONLINE PAYMENTS GATEWAY - VIGYANMEV JAYATE')

@section('content')

    <div class="page-banner">
        <div class="container">
            <h1>ऑनलाइन भुगतान गेटवे / Online Payments Gateway</h1>
            <div class="breadcrumb">
                <a href="{{ route('home') }}">Home</a> &raquo; <span>Online Payments Gateway</span>
            </div>
        </div>
    </div>

    <section style="padding: 60px 0;">
        <div class="container">
            
            <div class="payment-card">
                <div style="text-align: center; margin-bottom: 25px;">
                    <div style="font-size: 2.5rem; margin-bottom: 10px;">💳</div>
                    <h2 style="font-size: 1.6rem; color: var(--primary-color);">Subscription & Donation Gateway</h2>
                    <p style="font-size: 0.85rem; color: var(--text-muted); margin-top: 5px;">
                        Pay online for Life-Time Subscriptions, Donor Contributions, or Advertisement bookings.
                    </p>
                </div>

                <form action="#" method="POST" onsubmit="event.preventDefault(); alert('Redirecting to secure bank payment gateway... Payment Simulated Successfully!'); this.reset();">
                    
                    <div class="form-group">
                        <label for="payee_name">Full Name / पूरा नाम</label>
                        <input type="text" id="payee_name" class="form-control" placeholder="Enter your name" required>
                    </div>

                    <div class="form-group">
                        <label for="payee_email">Email Address / ईमेल पता</label>
                        <input type="email" id="payee_email" class="form-control" placeholder="Enter your email" required>
                    </div>

                    <div class="form-group">
                        <label for="payee_phone">Mobile Number / मोबाइल नंबर</label>
                        <input type="tel" id="payee_phone" class="form-control" placeholder="Enter 10-digit mobile number" required pattern="[0-9]{10}">
                    </div>

                    <div class="form-group">
                        <label for="payment_purpose">Purpose of Payment / भुगतान का उद्देश्य</label>
                        <select id="payment_purpose" class="form-control" required>
                            <option value="">-- Select Purpose --</option>
                            <option value="lifetime_subscription">Life-Time Magazine Subscription (Rs 5,000)</option>
                            <option value="annual_subscription">Annual Magazine Subscription (Rs 500)</option>
                            <option value="donation">Donor Contribution / Life Dinner</option>
                            <option value="advertisement">Advertisement Booking Payment</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="amount">Payment Amount (INR) / राशि</label>
                        <input type="number" id="amount" class="form-control" placeholder="Enter amount in Rupees" required min="1">
                    </div>

                    <div style="background-color: var(--bg-light); border: 1px solid var(--border-color); border-radius: 4px; padding: 15px; margin-bottom: 25px; font-size: 0.75rem; color: #475569; display: flex; align-items: start; gap: 8px;">
                        <span style="font-size: 1.1rem; line-height: 1;">🛡️</span>
                        <span>
                            Your payment transactions are encrypted using secure 256-bit SSL connections. Authorized by the Government of India billing guidelines.
                        </span>
                    </div>

                    <button type="submit" class="btn-primary" style="width: 100%; padding: 12px; font-size: 1rem;">Proceed to Secure Payment Gateway ➔</button>

                </form>
            </div>

        </div>
    </section>

@endsection
