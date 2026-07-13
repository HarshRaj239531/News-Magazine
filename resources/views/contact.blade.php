@extends('layouts.app')

@section('title', __('Contact Us') . ' - ' . __('Vigyanmev Jayate'))

@section('content')

    <div class="page-banner">
        <div class="container">
            <h1>{{ __('Contact Us') }}</h1>
            <div class="breadcrumb">
                <a href="{{ route('home') }}">{{ __('Home') }}</a> &raquo; <span>{{ __('Contact Us') }}</span>
            </div>
        </div>
    </div>

    <section style="padding: 60px 0;">
        <div class="container" style="display: grid; grid-template-columns: 1fr 1fr; gap: 40px; align-items: start;">
            
            <!-- Left Side: Office Info -->
            <div class="sidebar-panel" style="padding: 40px;">
                <h2 style="font-size: 1.6rem; color: var(--primary-color); margin-bottom: 25px; border-bottom: 2px solid var(--accent-color); padding-bottom: 10px;">{{ __('Vigyanmev Jayate') }} {{ __('Head Office') }}</h2>
                
                <div style="margin-bottom: 20px;">
                    <p style="font-weight: bold; color: var(--primary-color); font-size: 1rem; margin-bottom: 5px;">📍 {{ __('Address') }}:</p>
                    <p style="font-size: 0.9rem; color: #4a5568;">Vigyanmev Jayate Scientific Press Club Head Office,<br>New Delhi, Delhi - 110001, India</p>
                </div>

                <div style="margin-bottom: 20px;">
                    <p style="font-weight: bold; color: var(--primary-color); font-size: 1rem; margin-bottom: 5px;">📧 {{ __('Email Address') }}:</p>
                    <p style="font-size: 0.9rem; color: #4a5568;"><a href="mailto:contact@vigyanmev.gov.in">contact@vigyanmev.gov.in</a></p>
                </div>

                <div style="margin-bottom: 20px;">
                    <p style="font-weight: bold; color: var(--primary-color); font-size: 1rem; margin-bottom: 5px;">📞 {{ __('Phone') }}:</p>
                    <p style="font-size: 0.9rem; color: #4a5568;">+91-11-23091122, +91-11-23094455</p>
                </div>

                <div style="margin-bottom: 20px;">
                    <p style="font-weight: bold; color: var(--primary-color); font-size: 1rem; margin-bottom: 5px;">📜 {{ __('Ministry Details') }}:</p>
                    <p style="font-size: 0.9rem; color: #4a5568;">{{ __('Registered under Ministry of Information and Broadcasting, Government of India.') }}</p>
                </div>
            </div>

            <!-- Right Side: Contact Form -->
            <div class="payment-card" style="margin: 0; max-width: 100%;">
                <h2 style="font-size: 1.5rem; color: var(--primary-color); margin-bottom: 20px;">{{ __('Send Us an Inquiry') }}</h2>
                <p style="font-size: 0.85rem; color: var(--text-muted); margin-bottom: 25px;">{{ __('Please fill out this form to submit your inquiry or feedback to our board editors.') }}</p>
                
                @if(session('success'))
                    <div style="background-color: #dcfce7; color: #15803d; padding: 12px; border-radius: 4px; font-size: 0.85rem; margin-bottom: 20px; font-weight: bold;">
                        ✓ {{ session('success') }}
                    </div>
                @endif

                <form action="#" method="POST" onsubmit="event.preventDefault(); alert('Thank you for contacting us! Your inquiry has been submitted.'); this.reset();">
                    <div class="form-group">
                        <label for="name">{{ __('Your Name') }}</label>
                        <input type="text" id="name" class="form-control" placeholder="Enter your full name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">{{ __('Email Address') }}</label>
                        <input type="email" id="email" class="form-control" placeholder="Enter email address" required>
                    </div>
                    <div class="form-group">
                        <label for="subject">{{ __('Subject') }}</label>
                        <input type="text" id="subject" class="form-control" placeholder="Enter message subject" required>
                    </div>
                    <div class="form-group">
                        <label for="message">{{ __('Message') }}</label>
                        <textarea id="message" rows="5" class="form-control" placeholder="Type your message here..." required style="resize: vertical;"></textarea>
                    </div>
                    <button type="submit" class="btn-primary" style="width: 100%; padding: 12px; font-size: 0.95rem;">{{ __('Send Message') }} ✉</button>
                </form>
            </div>

        </div>
    </section>

@endsection
