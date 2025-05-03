<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <meta name="description" content="503 - Internal Server Error. Our server is currently unavailable. Please try again later.">
    <meta http-equiv="refresh" content="10;url={{ url('/') }}">
    <title>503 - Internal Server Error</title>
    <style>
        body {
            background-color: #f4f4f9;
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .error-container {
            text-align: center;
            background-color: #fff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            animation: fadeIn 1s ease-in-out;
        }

        h1 {
            font-size: 72px;
            margin: 0;
            color: #e74c3c;
        }

        p {
            font-size: 18px;
            color: #333;
            margin-top: 10px;
        }

        .quote-box {
            margin-top: 20px;
            padding: 15px;
            background-color: #e8f5e9;
            border-left: 5px solid #2ecc71;
            border-radius: 8px;
            font-size: 16px;
            font-style: italic;
        }

        a {
            text-decoration: none;
            color: #3498db;
            margin-top: 20px;
            display: inline-block;
        }

        a:hover {
            text-decoration: underline;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 600px) {
            h1 {
                font-size: 48px;
            }
            p {
                font-size: 16px;
            }
            .quote-box {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>

    @php
        // Set the HTTP 503 status code
        http_response_code(503);

        $medical_fitness_quotes = [
            "A stethoscope is just a fancy headphone for doctors… but with only one song – your heartbeat.",
            "Wheelchairs are the only ride where you get VIP treatment everywhere you go.",
            "Hospital beds are the ultimate remote-controlled recliner, but people only appreciate them when they actually need one.",
            "An oxygen concentrator is just a home air filter, but for your lungs… sounds way cooler, right?",
            "BP monitors make people realize that their “I’m totally fine” is a complete lie.",
            "People pay for spa massages, but a hospital bed has an auto-relax mode… who’s really winning?",
            "Doctors' handwriting is so bad that pharmacists are secretly trained detectives.",
            "MRIs are basically a giant expensive drum concert… featuring you as the main attraction.",
            "Ambulances are the only vehicle where breaking traffic rules is encouraged.",
            "A thermometer is the only thing that can make you go from “I’m fine” to “I need a doctor” in three seconds.",
            "Doctors are the only people who can tell you to relax while holding a needle in their hands.",
            "Going to the doctor always involves being asked if you’ve been drinking water like it’s the solution to all problems.",
            "Dentists are the only professionals who ask you questions while your mouth is wide open.",
            "Hospital gowns are designed for ultimate humiliation, but apparently “for your comfort.”",
            "X-ray technicians are the only people who say “hold still” while running away from the machine.",
            "Why is the medicine bottle childproof? Adults can barely open it either.",
            "Painkillers are proof that tiny things can solve huge problems.",
            "Doctors prescribe rest, but life prescribes deadlines.",
            "If laughter is the best medicine, why don’t hospitals have stand-up comedians on call?",
            "Paracetamol is the universal “one pill fits all” cure for every desi parent.",
            "Water is the real MVP – clears skin, improves digestion, and makes you feel like a hydration guru.",
            "Running on a treadmill is going nowhere but feeling accomplished.",
            "Fitness trainers say, “Just one more set!” Meanwhile, you’ve been dying for the last 10 minutes.",
            "Dieting is basically saying “no” to happiness.",
            "The best exercise is running away from responsibilities."
        ];

        $quote = $medical_fitness_quotes[array_rand($medical_fitness_quotes)];
    @endphp

    <div class="error-container">
        <h1>503</h1>
        <p>Service Unavailable! We are currently performing maintenance.</p>
        <div class="quote-box">
            <strong>Fun Fact:</strong> "{{ $quote }}"
        </div>       
        
    </div>

</body>
</html>
