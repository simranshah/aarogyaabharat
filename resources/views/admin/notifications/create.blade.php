@extends('admin.layout.layout')

@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Send Notifications</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Notifications</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><small>Send Notifications</small></h3>
              </div>

              <!-- Send Notification Form for All Customers -->
              <form action="{{ route('admin.notification.store') }}" method="POST" class="mt-4">
                @csrf
                <div class="card-body">
                  
                  <!-- Title Field -->
                  <div class="form-group">
                    <label for="notificationTitle">Notification Title</label>
                    <input type="text" name="title" class="form-control" id="notificationTitle" placeholder="Enter notification title" required value="{{ old('title') }}">
                    @error('title')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                  
                  <!-- Message Field -->
                  <div class="form-group">
                    <label for="notificationMessage">Notification Message</label>
                    <textarea name="message" class="form-control" id="notificationMessage" placeholder="Enter notification message" required>{{ old('message') }}</textarea>
                    @error('message')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Send Notification to Customers</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
