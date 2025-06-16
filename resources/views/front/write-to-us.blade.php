@extends('front.layouts.layout')
@section('content')
<div class="breadcrumbs">
    <div class="container">
        <ul>
            <li><a href="{{ route('home') }}">Home</a> </li>
            <li><a href="{{ route('write.to.us') }}">Write For Us</a> </li>
        </ul>
    </div>    
</div>

@php
    $isMobile = request()->header('User-Agent') && preg_match('/mobile|android|iphone|ipad|phone/i', request()->header('User-Agent'));
@endphp
       @if(! $isMobile)
       <div class="write-to-us-container">
       @else
       <div class="container">
       @endif

    <!-- Left: Article Submission Form -->
    <div class="business-form">
        <h2>Write to Us</h2>
        <p>Share your expertise by submitting an article or blog post on medical &amp; healthcare topics.</p>
        
        <form action="{{ route('articles.submit') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- Row 1: Name + Email -->
            <div class="form-row">
                <div class="form-group">
                    <label for="authorName" class="required-field">Your Name</label>
                    <input id="authorName" name="authorName" type="text" placeholder="e.g., Dr. Jane Doe" 
                           value="{{ old('authorName') }}" required>
                    @error('authorName')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="authorEmail" class="required-field">Email Address</label>
                    <input id="authorEmail" name="authorEmail" type="email" placeholder="you@example.com" 
                           value="{{ old('authorEmail') }}" required>
                    @error('authorEmail')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Row 2: Topic + Title -->
            <div class="form-row">
                <div class="form-group">
                    <label for="topic" class="required-field">Topic Area</label>
                    <select id="topic" name="topic" required>
                        <option value="">Select a topic…</option>
                        <option value="clinical-research" {{ old('topic') == 'clinical-research' ? 'selected' : '' }}>Clinical Research</option>
                        <option value="patient-care" {{ old('topic') == 'patient-care' ? 'selected' : '' }}>Patient Care &amp; Nursing</option>
                        <option value="public-health" {{ old('topic') == 'public-health' ? 'selected' : '' }}>Public Health &amp; Epidemiology</option>
                        <option value="medical-technology" {{ old('topic') == 'medical-technology' ? 'selected' : '' }}>Medical Technology &amp; Devices</option>
                        <option value="nutrition" {{ old('topic') == 'nutrition' ? 'selected' : '' }}>Nutrition &amp; Wellness</option>
                        <option value="other" {{ old('topic') == 'other' ? 'selected' : '' }}>Other Healthcare Topic</option>
                    </select>
                    @error('topic')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="title" class="required-field">Article Title</label>
                    <input id="title" name="title" type="text" placeholder="Your article's headline" 
                           value="{{ old('title') }}" required>
                    @error('title')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Full width: Abstract -->
            <div class="form-row">
                <div class="form-group full-width">
                    <label for="abstract" class="required-field">Short Abstract</label>
                    <textarea id="abstract" name="abstract" placeholder="A 2–3 sentence summary…" required>{{ old('abstract') }}</textarea>
                    @error('abstract')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Full width: File upload -->
            <div class="form-row">
                <div class="form-group full-width">
                    <label for="fileUpload" class="required-field">Upload Manuscript</label>
                    <input id="fileUpload" name="fileUpload" type="file" accept=".doc,.docx,.pdf" required>
                    @error('fileUpload')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                    <small class="file-requirements">Accepted formats: .doc, .docx, .pdf (Max 10MB)</small>
                </div>
            </div>

            <p><small>* All fields are required.</small></p>
            <button type="submit" style="background: radial-gradient(65.36% 56.94% at 90.88% 63.68%, #FFCC5C 3.76%, #F2A602 100%);" class="submit-btn">Submit Article</button>
        </form>
    </div>

    <!-- Right column remains unchanged -->
    <div class="right-col">
        <!-- Right: Submission Guidelines -->
        <div class="guidelines-card">
            <h2>Submission Guidelines</h2>
            <p>Please follow these when preparing your manuscript:</p>
            <ul>
                <li>Original content only.</li>
                <li>Length: 800–1,500 words.</li>
                <li>Use APA or Vancouver citation style.</li>
                <li>Include a 50-word author bio with credentials.</li>
                <li>Please ensure your submission pertains exclusively to medical or &nbsp; healthcare topics.</li>
                <li>Submit in Microsoft Word or PDF format.</li>
                <li>Allow 2–4 weeks for review &amp; feedback.</li>
            </ul>
        </div>

        <div class="about-card">
            <h2>About Aarogyaa Bharat</h2>
            <p>
                Aarogyaa Bharat is India's premier partner for medical and healthcare solutions, supplying
                cutting-edge equipment and round-the-clock technical support to hospitals, clinics, and wellness
                centers nationwide. We're passionate about building a community of clinicians, researchers, and
                industry experts—and that's where you come in. Whether your work focuses on clinical research,
                patient-care best practices, or emerging medical technologies, we invite you to share your insights
                with our audience. Our streamlined editorial process will help your article shine and reach the
                practitioners who need it most.
            </p>
        </div>
    </div>
</div>
<div class="log-out">
<div class="popup-overlay" id="logoutPopup5" style="display: none;">
    <div class="popup">
      <button class="close-btn" onclick="document.getElementById('logoutPopup5').style.display='none';">&times;</button>
      {{-- <img src="{{asset('front/images/server_isuue.svg')}}" alt="Logout" class="popup-image1" /> --}}
      {{-- <h2 class="popup-title">Come back soon!</h2> --}}
      <p class="popup-text">Your article has been submitted successfully!</p>
      <div class="popup-buttons">
       <button class="btn yes-btn"  onclick="document.getElementById('logoutPopup5').style.display='none';" >Yes</button>
        {{-- <button class="btn cancel-btn" onclick="document.getElementById('logoutPopup5').style.display='none';">Cancel</button> --}}
      </div>
    </div>
  </div>
 </div>
  @if(session('success'))
           <script>
            document.getElementById('logoutPopup5').style.display='flex';
           </script>
        @endif
@endsection