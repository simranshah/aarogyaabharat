@extends('front.layouts.layout')
@section('content')
    @php
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
         <img src="{{ asset('front/images/404.png') }}" alt="404 Error" class="error-image">
        <p>Oops! The page you're looking for doesn't exist.</p>
        <div class="quote-box">
            <strong>Fun Fact::</strong> "{{ $quote }}"
        </div>
        <p><a href="{{ url('/') }}">Go back to Home</a></p>
    </div>
@endsection
