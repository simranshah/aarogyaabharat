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
                    <input type="text" name="title" class="form-control" id="notificationTitle" placeholder="Enter notification title"  value="{{ old('title') }}">
                    @error('title')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                  
                  <!-- Message Field -->
                  <div class="form-group">
                    <label for="notificationMessage">Notification Message</label>
                    <textarea name="message" class="form-control" id="notificationMessage" placeholder="Enter notification message">{{ old('message') }}</textarea>
                    @error('message')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                </div>
                <div class="card-body">
                  
                  <!-- Title Field -->
                  <div class="form-group">
                    <label for="notificationTitle">Email Subject</label>
                    <input type="text" name="email_subject" class="form-control" id="notificationTitle" placeholder="Enter Email Subject"  value="{{ old('email_subject') }}">
                    @error('email_subject')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                  
                  <!-- Message Field -->
                  <div class="form-group">
                    <label for="notificationMessage">Email Body</label>
                    <textarea name="email_body" class="form-control" id="notificationMessage" placeholder="Enter Email Body" >{{ old('email_body') }}</textarea>
                    @error('email_body')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="form-group">
                      <label>Type</label><br>
                      <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" name="type[]" id="type_notification" value="notification" {{ is_array(old('type')) && in_array('notification', old('type')) ? 'checked' : '' }}>
                      <label class="form-check-label" for="type_notification">Notification</label>
                      </div>
                      <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" name="type[]" id="type_email" value="email" {{ is_array(old('type')) && in_array('email', old('type')) ? 'checked' : '' }}>
                      <label class="form-check-label" for="type_email">Email</label>
                      </div>
                      @error('type')
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
