<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aarogya Bharat UAT Login</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', 'Roboto', sans-serif;
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 50%, #1e3c72 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200"><defs><pattern id="medical" width="60" height="60" patternUnits="userSpaceOnUse"><g opacity="0.03"><path d="M30 10 L30 50 M10 30 L50 30" stroke="white" stroke-width="2"/><circle cx="30" cy="30" r="15" fill="none" stroke="white" stroke-width="1"/></g></pattern></defs><rect width="200" height="200" fill="url(%23medical)"/></svg>');
            animation: medicalFloat 25s linear infinite;
        }

        @keyframes medicalFloat {
            0% { transform: translateX(0) translateY(0); }
            100% { transform: translateX(-60px) translateY(-60px); }
        }

        .login-container {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            padding: 45px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
            width: 100%;
            max-width: 450px;
            position: relative;
            border: 1px solid rgba(255, 255, 255, 0.3);
            animation: slideIn 1s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(50px) scale(0.9);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .header-section {
            text-align: center;
            margin-bottom: 35px;
            position: relative;
        }

        .emblem-container {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
            margin-bottom: 20px;
        }

        .emblem {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #FF9933, #FFFFFF, #138808);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
        }

        /* .emblem::before {
            content: '⚕';
            font-size: 24px;
            color: #1e3c72;
            font-weight: bold; */
            /* z-index: 2;
            position: relative;
        }

        .emblem::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at center, rgba(255,255,255,0.3) 0%, transparent 70%);
            animation: shine 3s ease-in-out infinite;
        } */

        @keyframes shine {
            0%, 100% { opacity: 0; }
            50% { opacity: 1; }
        }

        .main-title {
            font-size: 2.2rem;
            font-weight: 700;
            color: #1e3c72;
            margin-bottom: 5px;
            letter-spacing: -0.5px;
        }

        .main-title .bharat {
            color: #138808;
        }

        .subtitle {
            color: #666;
            font-size: 0.95rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin-bottom: 8px;
        }

        .env-badge {
            display: inline-block;
            background: linear-gradient(135deg, #FF9933, #FF7722);
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .form-section {
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 25px;
            position: relative;
        }

        .form-label {
            display: block;
            color: #444;
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 0.9rem;
        }

        .form-input {
            width: 100%;
            padding: 16px 20px;
            border: 2px solid #e1e5e9;
            border-radius: 12px;
            font-size: 16px;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.9);
            color: #333;
            position: relative;
        }

        .form-input:focus {
            outline: none;
            border-color: #1e3c72;
            background: rgba(255, 255, 255, 1);
            transform: translateY(-1px);
            box-shadow: 0 8px 25px rgba(30, 60, 114, 0.15);
        }

        .form-input::placeholder {
            color: #999;
            font-weight: 400;
        }

        .input-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
            font-size: 18px;
            pointer-events: none;
            transition: color 0.3s ease;
        }

        .form-input:focus + .input-icon {
            color: #1e3c72;
        }

        .login-btn {
            width: 100%;
            padding: 18px;
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .login-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.6s;
        }

        .login-btn:hover::before {
            left: 100%;
        }

        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 35px rgba(30, 60, 114, 0.3);
        }

        .login-btn:active {
            transform: translateY(0);
        }

        .footer-section {
            text-align: center;
            margin-top: 30px;
            padding-top: 25px;
            border-top: 1px solid #eee;
        }

        .footer-text {
            color: #666;
            font-size: 0.85rem;
            margin-bottom: 10px;
        }

        .gov-footer {
            color: #1e3c72;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .floating-elements {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            pointer-events: none;
        }

        .health-icon {
            position: absolute;
            color: rgba(255, 255, 255, 0.1);
            font-size: 60px;
            animation: healthFloat 8s ease-in-out infinite;
        }

        .health-icon:nth-child(1) {
            top: 15%;
            left: 10%;
            animation-delay: 0s;
        }

        .health-icon:nth-child(2) {
            top: 70%;
            right: 15%;
            animation-delay: 3s;
        }

        .health-icon:nth-child(3) {
            bottom: 20%;
            left: 20%;
            animation-delay: 6s;
        }

        @keyframes healthFloat {
            0%, 100% {
                transform: translateY(0px) rotate(0deg);
                opacity: 0.1;
            }
            50% {
                transform: translateY(-30px) rotate(5deg);
                opacity: 0.2;
            }
        }

        @media (max-width: 480px) {
            .login-container {
                margin: 20px;
                padding: 35px 25px;
            }
            
            .main-title {
                font-size: 1.8rem;
            }

            .emblem {
                width: 50px;
                height: 50px;
            }
        }

        /* Security indicator */
        .security-badge {
            position: absolute;
            top: -10px;
            right: -10px;
            background: #138808;
            color: white;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(19, 136, 8, 0.7); }
            70% { box-shadow: 0 0 0 10px rgba(19, 136, 8, 0); }
            100% { box-shadow: 0 0 0 0 rgba(19, 136, 8, 0); }
        }
    </style>
</head>
<body>
    <div class="floating-elements">
        <div class="health-icon">🏥</div>
        <div class="health-icon">⚕️</div>
        <div class="health-icon">🩺</div>
    </div>

    <div class="login-container">
        <div class="security-badge">🔒</div>
        
        <div class="header-section">
            <div class="emblem-container">
                <div class="emblem">
                      <img style="height: 100%;width:100%" src="{{asset('front/images/logo_mini.svg')}}" alt="Aarogyaa Bharat Logo" />
                </div>
            </div>
            <h1 class="main-title">Aarogyaa <span class="bharat">Bharat</span></h1>
            <div class="subtitle">Digital Health Platform</div>
            <div class="env-badge">UAT Environment</div>
        </div>

        <div class="form-section">
            <form method="POST">
                <!-- CSRF token placeholder -->
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                
                <div class="form-group">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-input" placeholder="Enter your username" required>
                    <div class="input-icon">👤</div>
                </div>

                <div class="form-group">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-input" placeholder="Enter your password" required>
                    <div class="input-icon">🔑</div>
                </div>

                <button type="submit" class="login-btn">
                    Secure Login
                </button>
            </form>
        </div>

        <div class="footer-section">
            <div class="footer-text">
                Testing Environment • Authorized Personnel Only
            </div>
           
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const inputs = document.querySelectorAll('.form-input');
            const loginBtn = document.querySelector('.login-btn');
            const emblem = document.querySelector('.emblem');

            // Enhanced input interactions
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.style.transform = 'scale(1.02)';
                    const icon = this.nextElementSibling;
                    if (icon) {
                        icon.style.transform = 'translateY(-50%) scale(1.1)';
                    }
                });

                input.addEventListener('blur', function() {
                    this.parentElement.style.transform = 'scale(1)';
                    const icon = this.nextElementSibling;
                    if (icon) {
                        icon.style.transform = 'translateY(-50%) scale(1)';
                    }
                });

                // Real-time validation styling
                input.addEventListener('input', function() {
                    if (this.value.length > 0) {
                        this.style.borderColor = '#138808';
                    } else {
                        this.style.borderColor = '#e1e5e9';
                    }
                });
            });

            // Enhanced button interaction
            loginBtn.addEventListener('click', function(e) {
                const username = document.querySelector('input[name="username"]').value;
                const password = document.querySelector('input[name="password"]').value;
                
                if (username && password) {
                    this.innerHTML = '🔄 Authenticating...';
                    this.style.background = 'linear-gradient(135deg, #4a90e2, #357abd)';
                    
                    // Add loading animation to emblem
                    emblem.style.animation = 'spin 1s linear infinite';
                }
            });

            // Enhanced keyboard navigation
            inputs.forEach((input, index) => {
                input.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        if (index < inputs.length - 1) {
                            inputs[index + 1].focus();
                        } else {
                            loginBtn.click();
                        }
                    }
                });
            });

            // Add spin animation
            const style = document.createElement('style');
            style.textContent = `
                @keyframes spin {
                    from { transform: rotate(0deg); }
                    to { transform: rotate(360deg); }
                }
            `;
            document.head.appendChild(style);
        });
    </script>
</body>
</html>