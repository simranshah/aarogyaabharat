@extends('admin.layout.layout')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <h1>Query Details</h1>
            </div>
        </section>

        <section class="content">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Query #{{ $raiseQuery->id }}</h3>
                </div>
                <div class="card-body">
                    <!-- Query Information -->
                    <h5>Query Information</h5>
                    @if (!empty($raiseQuery->full_name))
                        <p><strong>Full Name:</strong> {{ $raiseQuery->full_name }}</p>
                    @endif
                    @if (!empty($raiseQuery->email))
                        <p><strong>Email:</strong> {{ $raiseQuery->email }}</p>
                    @endif
                    @if (!empty($raiseQuery->mobile))
                        <p><strong>Mobile:</strong> {{ $raiseQuery->mobile }}</p>
                    @endif
                    @if (!empty($raiseQuery->product_name))
                        <p><strong>Product Name:</strong> {{ $raiseQuery->product_name }}</p>
                    @endif
                    <hr /><br />

                    <!-- File Upload -->
                    @if (!empty($raiseQuery->file_upload))
                        <h5>Uploaded File</h5>
                        @php
                            $filePath = asset('storage/' . $raiseQuery->file_upload);
                            $fileExtension = pathinfo($raiseQuery->file_upload, PATHINFO_EXTENSION);
                        @endphp
                        @if (in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif']))
                            <img src="{{ $filePath }}" alt="Uploaded Image" style="max-width: 200px; height: auto;">
                        @else
                            <a href="{{ $filePath }}" target="_blank" class="btn btn-primary">Download File</a>
                        @endif
                    @endif

                    <hr /><br />

                    <!-- Description -->
                    @if (!empty($raiseQuery->description))
                        <h5>Description</h5>
                        <p>{{ $raiseQuery->description }}</p>
                    @endif
                    <hr /><br />

                    <!-- Created At -->
                    <h5>Query Date</h5>
                    <p><strong>Created At:</strong> {{ $raiseQuery->created_at->format('Y-m-d H:i') }}</p>
                    <hr /><br />
                </div>

                <div class="card-footer">
                    <a href="{{ route('admin.contactus') }}" class="btn btn-secondary">Back to Queries</a>
                </div>
            </div>
        </section>
    </div>
@endsection
