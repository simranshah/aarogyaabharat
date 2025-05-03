@extends('admin.layout.layout')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Page</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Edit Page</li>
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
                            <h3 class="card-title"><small>Edit Page</small></h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="pageForm" method="POST" action="{{ route('admin.page.update', $page->id) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="pageName">Name</label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="pageName" placeholder="Enter Page Name" value="{{ old('name', $page->name) }}">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="title_tag">Tag Title</label>
                                    <input type="text" name="title_tag" class="form-control @error('title_tag') is-invalid @enderror" id="title_tag" placeholder="Enter Tag Title" value="{{ old('title_tag', $page->title_tag) }}">
                                </div>
                                <div class="form-group">
                                    <label for="pageName">Page Title(HEAD)</label>
                                    <input type="text" name="page_title" class="form-control @error('page_title') is-invalid @enderror" id="pagetitle" placeholder="Enter Page title" value="{{ old('page_title' , $page->page_title) }}">
                                    @error('page_title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="seo_meta_tag_title">SEO Meta Tag Title</label>
                                    <input type="text" name="seo_meta_tag_title" class="form-control @error('seo_meta_tag_title') is-invalid @enderror" id="seo_meta_tag_title" placeholder="Enter Page Name" value="{{ old('seo_meta_tag_title', $page->seo_meta_tag_title) }}">
                                </div>
                                <div class="form-group">
                                    <label for="seo_meta_tag">SEO Meta Tag Description</label>
                                    <input type="text" name="seo_meta_tag" class="form-control @error('seo_meta_tag') is-invalid @enderror" id="seo_meta_tag" placeholder="Enter Page Name" value="{{ old('seo_meta_tag', $page->seo_meta_tag) }}">
                                </div>
                                <div class="form-group">
                                    <label for="pageStatus">Status</label>
                                    <select name="status" id="pageStatus" class="form-control @error('status') is-invalid @enderror">
                                        <option value="1" {{ old('status', $page->status) == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ old('status', $page->status) == 0 ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
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
