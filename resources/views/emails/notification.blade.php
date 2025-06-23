<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $subject }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            background-color: #f8f9fa;
            padding: 20px 0;
        }
        
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        /* Header */
        .header {
            background: linear-gradient(135deg, #4f46e5, #7c3aed);
            padding: 30px 20px;
            text-align: center;
            color: white;
        }
        
        .logo {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 8px;
        }
        
        .header-tagline {
            font-size: 14px;
            opacity: 0.9;
        }
        
        /* Main Content */
        .content {
            padding: 40px 30px;
            text-align: center;
        }
        
        .subject-line {
            font-size: 32px;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 20px;
        }
        
        .promo-badge {
            display: inline-block;
            background: #ef4444;
            color: white;
            padding: 12px 24px;
            border-radius: 25px;
            font-size: 20px;
            font-weight: 600;
            margin: 15px 0 25px 0;
        }
        
        .message {
            font-size: 16px;
            color: #6b7280;
            margin: 25px 0;
            line-height: 1.7;
            max-width: 480px;
            margin-left: auto;
            margin-right: auto;
        }
        
        .highlight-text {
            color: #1f2937;
            font-weight: 600;
        }
        
        .cta-button {
            display: inline-block;
            background: #10b981;
            color: white;
            padding: 16px 40px;
            text-decoration: none;
            border-radius: 8px;
            font-size: 18px;
            font-weight: 600;
            margin: 25px 0;
            transition: background-color 0.2s ease;
        }
        
        .cta-button:hover {
            background: #059669;
        }
        
        .urgency {
            background: #fef3c7;
            padding: 15px;
            border-radius: 8px;
            margin: 25px 0;
            border-left: 4px solid #f59e0b;
        }
        
        .urgency-text {
            color: #92400e;
            font-weight: 600;
            font-size: 14px;
            margin: 0;
        }
        
        /* Footer */
        .footer {
            background: #374151;
            color: white;
            padding: 30px 20px;
            text-align: center;
        }
        
        .footer-logo {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 15px;
        }
        
        .footer-content {
            margin-bottom: 20px;
            font-size: 14px;
            line-height: 1.6;
            color: #d1d5db;
        }
        
        .social-links {
            margin: 20px 0;
        }
        
        .social-icon {
            display: inline-block;
            width: 36px;
            height: 36px;
            background: #4b5563;
            border-radius: 6px;
            margin: 0 5px;
            line-height: 36px;
            text-decoration: none;
            color: white;
            font-size: 16px;
            transition: background-color 0.2s ease;
        }
        
        .social-icon:hover {
            background: #6b7280;
        }
        
        .footer-links {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #4b5563;
        }
        
        .footer-links a {
            color: #9ca3af;
            text-decoration: none;
            margin: 0 12px;
            font-size: 13px;
            transition: color 0.2s ease;
        }
        
        .footer-links a:hover {
            color: white;
        }
        
        /* Responsive */
        @media (max-width: 600px) {
            .email-container {
                margin: 0 10px;
            }
            
            .content {
                padding: 25px 20px;
            }
            
            .subject-line {
                font-size: 26px;
            }
            
            .promo-badge {
                font-size: 18px;
                padding: 10px 20px;
            }
            
            .message {
                font-size: 15px;
            }
            
            .cta-button {
                padding: 14px 30px;
                font-size: 16px;
            }
            
            .footer-links a {
                display: block;
                margin: 8px 0;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="header">
            <div class="logo"><img style="height: 100%;width:100%" src="{{asset('front/images/logo_mini.svg')}}" alt="Aarogyaa Bharat Logo" /></div>
            <div class="header-tagline">Quality Products, Great Prices</div>
        </div>
        
        <!-- Main Content -->
        <div class="content">
            <!-- Subject Line -->
            <h1 class="subject-line">{{ $subject }}</h1>
            
            <!-- Promotion Badge -->
            {{-- <div class="promo-badge">40% OFF Everything</div> --}}
            
            <!-- Main Message -->
            <div class="message">
                {!! nl2br(e($body)) !!}
            </div>
            
            <!-- Call to Action -->
            {{-- <a href="#" class="cta-button">Shop Now & Save 40%</a> --}}
            
            <!-- Urgency Message -->
            {{-- <div class="urgency">
                <p class="urgency-text">⏰ Limited time offer - Don't miss out!</p>
            </div> --}}
        </div>
        
        <!-- Footer -->
        <div class="footer">
            <div class="footer-logo"><img style="height: 100%;width:100%" src="{{asset('front/images/logo_mini.svg')}}" alt="Aarogyaa Bharat Logo" />
 </div>
            
            <div class="footer-content">
                📧 support@aarogyaabharat.com<br>
                📞 +91 9921407039<br>
                📍 Office- 05, 1st Floor, Choice Arcade, Balkrishna Sakharam Dhole Patil Rd, opp. Ruby Hall Clinic, Sangamvadi, Pune, Maharashtra 411001
            </div>
            
            <div class="social-links">
                <a href="#" class="social-icon">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                    </svg>
                </a>
                <a href="#" class="social-icon">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                    </svg>
                </a>
                <a href="#" class="social-icon">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                    </svg>
                </a>
                <a href="#" class="social-icon">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                    </svg>
                </a>
            </div>
            
            <div class="footer-links">
                <a href="#">Unsubscribe</a>
                <a href="#">Privacy Policy</a>
                <a href="#">Terms of Service</a>
                <a href="#">Contact Us</a>
            </div>
        </div>
    </div>
</body>
</html>