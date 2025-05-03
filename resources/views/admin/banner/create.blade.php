@extends('admin.layout.layout')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Banner</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('banners.index') }}">Banners</a></li>
                        <li class="breadcrumb-item active">Create Banner</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Create Banner</h3>
                        </div>
                        <form id="bannerForm" method="POST" action="{{ route('banners.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="bannerTitle">Title</label>
                                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="bannerTitle" placeholder="Enter Banner Title" value="{{ old('title') }}">
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="bannerLink">Link</label>
                                    <input type="text" name="link" class="form-control @error('link') is-invalid @enderror" id="bannerLink" placeholder="Enter Banner Link" value="{{ old('link') }}">
                                    @error('link')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="bannerDescription">Description</label>
                                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="bannerDescription" placeholder="Enter Banner Description">{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="bannerImage">Banner Image</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="image" class="custom-file-input @error('image') is-invalid @enderror" id="bannerImage">
                                            <label class="custom-file-label" for="bannerImage">Choose file</label>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text">Upload</span>
                                        </div>
                                    </div>
                                    @error('image')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="isMobile">Is Mobile Banner?</label>
                                    <div class="form-check">
                                        <input type="checkbox" name="is_mobile" class="form-check-input" id="isMobile" value="1" {{ old('is_mobile') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="isMobile">Yes, this is a mobile banner</label>
                                    </div>
                                    @error('is_mobile')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label for="bannerStatus">Status</label>
                                    <!-- Hidden input to ensure a value is always sent -->
                                    <input type="hidden" name="status" value="0">
                                    <div class="form-check">
                                        <input type="checkbox" name="status" class="form-check-input" id="bannerStatus" value="1" {{ old('status') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="bannerStatus">Active</label>
                                    </div>
                                    @error('status')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="bannerOrder">Display Order</label>
                                    <input type="number" name="display_order" min="0" class="form-control @error('display_order') is-invalid @enderror" id="bannerOrder" placeholder="Enter Display Order" value="{{ old('display_order') }}">
                                    @error('display_order')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection
