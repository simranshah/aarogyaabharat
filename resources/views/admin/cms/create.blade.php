@extends('admin.layout.layout')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create CMS Record</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">CMS</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title"><small>Create CMS Record</small></h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="cmsForm" method="POST" action="{{ route('admin.cms.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">

                                <!-- Page Selection -->
                                <div class="form-group">
                                    <label for="pageSelect">Select Page</label>
                                    <select name="page_id" id="pageSelect" class="form-control @error('page_id') is-invalid @enderror">
                                        <option value="">Select a Page</option>
                                        @foreach($pages as $page)
                                            <option value="{{ $page->id }}" {{ old('page_id') == $page->id ? 'selected' : '' }}>
                                                {{ $page->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('page_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Title Field -->
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title" value="{{ old('title') }}">
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Description Field -->
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description" placeholder="Enter Description">{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Content Field -->
                                <div class="form-group">
                                    <label for="cmsContent">Content</label>
                                    <textarea name="content" class="form-control @error('content') is-invalid @enderror" id="cmsContent" placeholder="Enter Content">{{ old('content') }}</textarea>
                                    @error('content')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Status Field -->
                                <div class="form-group">
                                    <label for="cmsStatus">Status</label>
                                    <select name="is_active" id="cmsStatus" class="form-control @error('is_active') is-invalid @enderror">
                                        <option value="1" {{ old('is_active') == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ old('is_active') == 0 ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                    @error('is_active')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Image Upload Field -->
                                <div class="form-group">
                                    <label for="image">Upload Images</label>
                                    <input type="file" name="image[]" class="form-control @error('image') is-invalid @enderror" id="image" multiple>
                                    @error('image.*')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="imagealt">Image Alt</label>
                                    <input type="text" name="alt" class="form-control @error('alt') is-invalid @enderror" id="imagealt" placeholder="Image Alt" value="{{ old('alt') }}">
                                    @error('alt')
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

<script>
    document.addEventListener("DOMContentLoaded", function() {
        CKEDITOR.replace('cmsContent');
    });
</script>

@endsection
