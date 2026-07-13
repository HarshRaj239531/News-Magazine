@extends('layouts.app')

@section('title', __('Online Payments Gateway') . ' - ' . __('Vigyanmev Jayate'))

@section('content')

    <div class="page-banner">
        <div class="container">
            <h1>{{ __('Online Payments Gateway') }}</h1>
            <div class="breadcrumb">
                <a href="{{ route('home') }}">{{ __('Home') }}</a> &raquo; <span>{{ __('Online Payments Gateway') }}</span>
            </div>
        </div>
    </div>

    <section style="padding: 60px 0;">
        <div class="container">
            
            <div class="payment-card">
                <div style="text-align: center; margin-bottom: 25px;">
                    <div style="font-size: 2.5rem; margin-bottom: 10px;">💳</div>
                    <h2 style="font-size: 1.6rem; color: var(--primary-color);">{{ __('Subscription & Donation Gateway') }}</h2>
                    <p style="font-size: 0.85rem; color: var(--text-muted); margin-top: 5px;">
                        {{ __('Pay online for Life-Time Subscriptions, Donor Contributions, or Advertisement bookings.') }}
                    </p>
                </div>

                <form action="#" method="POST" onsubmit="event.preventDefault(); alert('Redirecting to secure bank payment gateway... Payment Simulated Successfully!'); this.reset();">
                    
                    <div class="form-group">
                        <label for="payee_name">{{ __('Full Name') }}</label>
                        <input type="text" id="payee_name" class="form-control" placeholder="Enter your name" required>
                    </div>

                    <div class="form-group">
                        <label for="payee_email">{{ __('Email Address') }}</label>
                        <input type="email" id="payee_email" class="form-control" placeholder="Enter your email" required>
                    </div>

                    <div class="form-group">
                        <label for="payee_phone">{{ __('Mobile Number') }}</label>
                        <input type="tel" id="payee_phone" class="form-control" placeholder="Enter 10-digit mobile number" required pattern="[0-9]{10}">
                    </div>

                    <div class="form-group">
                        <label for="payment_purpose">{{ __('Purpose of Payment') }}</label>
                        <select id="payment_purpose" class="form-control" required>
                            <option value="">-- {{ __('Select Purpose') }} --</option>
                            <option value="lifetime_subscription">{{ __('Life-Time Magazine Subscription') }} (Rs 5,000)</option>
                            <option value="annual_subscription">{{ __('Annual Magazine Subscription') }} (Rs 500)</option>
                            <option value="donation">{{ __('Donor Contribution / Life Dinner') }}</option>
                            <option value="advertisement">{{ __('Advertisement Booking Payment') }}</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="amount">{{ __('Payment Amount') }} (INR)</label>
                        <input type="number" id="amount" class="form-control" placeholder="Enter amount in Rupees" required min="1">
                    </div>

                    <div style="background-color: var(--bg-light); border: 1px solid var(--border-color); border-radius: 4px; padding: 15px; margin-bottom: 25px; font-size: 0.75rem; color: #475569; display: flex; align-items: start; gap: 8px;">
                        <span style="font-size: 1.1rem; line-height: 1;">🛡️</span>
                        <span>
                            {{ __('Your payment transactions are encrypted using secure 256-bit SSL connections.') }}
                        </span>
                    </div>

                    <button type="submit" class="btn-primary" style="width: 100%; padding: 12px; font-size: 1rem;">{{ __('Proceed to Secure Payment Gateway') }} ➔</button>

                </form>
            </div>

        </div>
    </section>

@endsection
