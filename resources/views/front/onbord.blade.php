<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - Aarogyaa Bharat Registration Successful</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #233F8C;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            overflow-x: hidden;
        }

        .container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 24px;
            padding: 60px 40px;
            text-align: center;
            max-width: 600px;
            width: 100%;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
            position: relative;
            overflow: hidden;
            animation: slideUp 0.8s ease-out;
        }

        .container::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, #E49F0B, #E49F0B, #E49F0B);
            animation: shimmer 2s infinite;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes shimmer {
            0% { left: -100%; }
            100% { left: 100%; }
        }

        .logo-container {
            margin-bottom: 20px;
            animation: fadeIn 1s ease-out 0.3s both;
        }

        .logo {
            width: 100px;
            height: 100px;
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: pulse 2s infinite;
        }

        .logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            filter: drop-shadow(0 10px 30px rgba(228, 159, 11, 0.3));
            border-radius: 20px;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        .site-name {
            font-size: 28px;
            font-weight: 700;
            color: #2d3748;
            
            letter-spacing: -0.5px;
        }

        .welcome-section {
            margin-bottom: 40px;
            animation: fadeIn 1s ease-out 0.6s both;
        }

        .user-name {
            font-size: 32px;
            font-weight: 800;
            color: #E49F0B;
            margin-bottom: 20px;
            animation: glow 2s ease-in-out infinite alternate;
           
        }

        @keyframes glow {
            from { 
                filter: brightness(1);
                text-shadow: 0 2px 10px rgba(228, 159, 11, 0.3);
            }
            to { 
                filter: brightness(1.2);
                text-shadow: 0 2px 15px rgba(228, 159, 11, 0.5);
            }
        }

        .welcome-message {
            font-size: 18px;
            color: #4a5568;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .success-message {
            font-size: 20px;
            font-weight: 600;
            color: #4a5568;
            margin-bottom: 30px;
        }

        .countdown-container {
            margin: 40px 0;
            animation: fadeIn 1s ease-out 0.9s both;
        }

        .countdown-circle {
            width: 120px;
            height: 120px;
            margin: 0 auto 20px;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .countdown-svg {
            width: 120px;
            height: 120px;
            transform: rotate(-90deg);
        }

        .countdown-circle-bg {
            fill: none;
            stroke: #e2e8f0;
            stroke-width: 8;
        }

        .countdown-circle-progress {
            fill: none;
            stroke: #E49F0B;
            stroke-width: 8;
            stroke-linecap: round;
            stroke-dasharray: 314;
            stroke-dashoffset: 314;
            animation: countdown 10s linear forwards;
        }

        @keyframes countdown {
            from { stroke-dashoffset: 314; }
            to { stroke-dashoffset: 0; }
        }

        .countdown-number {
            position: absolute;
            font-size: 36px;
            font-weight: 800;
            color: #E49F0B;
            text-shadow: 0 2px 10px rgba(228, 159, 11, 0.3);
        }

        .countdown-text {
            font-size: 16px;
            color: #718096;
            margin-bottom: 30px;
        }

        .cta-button {
            background: #E49F0B;
            color: black;
            border: none;
            padding: 16px 40px;
            font-size: 18px;
            font-weight: 600;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 10px 30px rgba(228, 159, 11, 0.3);
            position: relative;
            overflow: hidden;
            animation: fadeIn 1s ease-out 1.2s both;
        }

        .cta-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 40px rgba(228, 159, 11, 0.4);
            background: #D8920A;
        }

        .cta-button:active {
            transform: translateY(0);
        }

        .cta-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }

        .cta-button:hover::before {
            left: 100%;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .decorative-elements {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            overflow: hidden;
        }

        .particle {
            position: absolute;
            width: 6px;
            height: 6px;
            background: #E49F0B;
            border-radius: 50%;
            opacity: 0.6;
            animation: float 6s ease-in-out infinite;
        }

        .particle:nth-child(1) { top: 20%; left: 10%; animation-delay: 0s; }
        .particle:nth-child(2) { top: 60%; left: 85%; animation-delay: 2s; }
        .particle:nth-child(3) { top: 80%; left: 20%; animation-delay: 4s; }
        .particle:nth-child(4) { top: 30%; left: 75%; animation-delay: 1s; }

        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        /* Responsive Design */
                    @media (max-width: 768px) {
            .container {
                padding: 40px 30px;
                margin: 10px;
            }

            .logo {
                width: 80px;
                height: 80px;
            }

            .site-name {
                font-size: 24px;
            }

            .user-name {
                font-size: 26px;
            }

            .welcome-message {
                font-size: 16px;
            }

            .success-message {
                font-size: 18px;
            }

            .cta-button {
                padding: 14px 30px;
                font-size: 16px;
            }
        }

                    @media (max-width: 480px) {
            .container {
                padding: 30px 20px;
            }

            .logo {
                width: 70px;
                height: 70px;
            }

            .user-name {
                font-size: 20px;
            }

            .site-name {
                font-size: 18px;
            }
            .welcome-section {
               margin-bottom: 17px;
            }
            .countdown-text {
              font-size: 14px;
            }
                .welcome-message {
              font-size: 13px;
            }
        }

        /* Accessibility improvements */
        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }
    </style>
</head>
<body>
    <div class="container">
       

        <div class="logo-container">
            <div class="logo">
                <img src="{{asset('front/images/logo_mini.svg')}}" alt="Aarogyaa Bharat Logo" />
            </div>
            <h1 class="site-name">Aarogyaa Bharat</h1>
        </div>

        <div class="welcome-section">
            <h2 class="user-name">Welcome, {{$customer->name}}!</h2>
            <p class="welcome-message">
                Your registration was successful and we're absolutely thrilled to have you join our community!
            </p>
            <p class="success-message">
                🎉 You're all set to begin your journey with us!
            </p>
        </div>

        <div class="countdown-container">
            <p class="countdown-text">Redirecting to your Log-in in <span id="countdownText">10</span> seconds...</p>
        </div>
      <a href="{{ route('login') }}" >
        <button class="cta-button" onclick="proceedToDashboard()">
            Continue to Log-in
        </button>
        </a>
    </div>

    <script>
        // Countdown functionality
        let countdownTime = 10;
        // const countdownNumber = document.getElementById('countdownNumber');
        const countdownText = document.getElementById('countdownText');
        
        function updateCountdown() {
            // countdownNumber.textContent = countdownTime;
            countdownText.textContent = countdownTime;
            
            if (countdownTime === 0) {
                // Redirect or proceed to dashboard
                proceedToDashboard();
                return;
            }
            
            countdownTime--;
            setTimeout(updateCountdown, 1000);
        }
        
        // Start countdown when page loads
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(updateCountdown, 1000); // Start after 1 second
        });
        
        // Button click handler
        function proceedToDashboard() {
            const button = document.querySelector('.cta-button');
            button.style.transform = 'scale(0.95)';
            button.textContent = 'Loading...';
            
            setTimeout(() => {
                // In a real application, this would redirect to the dashboard
                location.href = '/log-in'; // Redirect to dashboard
                // window.location.href = '/dashboard'; // Uncomment this for actual redirect
                button.textContent = 'Continue to Log-in';
                button.style.transform = 'scale(1)';
            }, 1000);
        }
        
        // Add entrance animation for particles
        document.addEventListener('DOMContentLoaded', function() {
            const particles = document.querySelectorAll('.particle');
            particles.forEach((particle, index) => {
                setTimeout(() => {
                    particle.style.opacity = '0.6';
                }, index * 200);
            });
        });
        
        // Add subtle hover effects to the container
        const container = document.querySelector('.container');
        container.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-5px)';
            this.style.transition = 'transform 0.3s ease';
        });
        
        container.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    </script>
</body>
</html>