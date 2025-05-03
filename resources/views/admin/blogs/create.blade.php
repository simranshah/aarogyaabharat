@extends('admin.layout.layout')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Blog</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Blog</li>
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
                            <h3 class="card-title"><small>Create Blog</small></h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="blogForm" method="POST" action="{{ route('admin.blogs.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="blogName">Name</label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="blogName" placeholder="Enter Blog Name" value="{{ old('name') }}">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="blogImage">Image</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="image" class="custom-file-input @error('image') is-invalid @enderror" id="blogImage">
                                            <label class="custom-file-label" for="blogImage">Choose file</label>
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
                                    <label for="imagealt">Image Alt</label>
                                    <input type="text" name="alt" class="form-control @error('alt') is-invalid @enderror" id="imagealt" placeholder="Image Alt" value="{{ old('alt') }}">
                                    @error('alt')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="ArticleAuthor">Article Author</label>
                                    <input type="text" name="article_author" class="form-control @error('article_author') is-invalid @enderror" id="article_author" placeholder="Enter Blog Article Author" value="{{ old('article_author') }}">
                                    @error('article_author')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="blogTitle">Title</label>
                                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="blogTitle" placeholder="Enter Blog Title" value="{{ old('title') }}">
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="blogTitle">Tagename</label>
                                    <input type="text" name="tagename" class="form-control @error('tagename') is-invalid @enderror" id="tagename" placeholder="Enter Blog Tagename" value="{{ old('tagename') }}">
                                    @error('tagename')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="blogDescription">Description</label>
                                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="blogDescription" placeholder="Enter Blog Description">{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="blogContentHtml">Content HTML</label>
                                    <textarea name="content_html" class="form-control @error('content_html') is-invalid @enderror" id="blogContentHtml" placeholder="Enter Blog Content HTML">{{ old('content_html') }}</textarea>
                                    @error('content_html')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="pageName">Page Title(HEAD)</label>
                                    <input type="text" name="page_title" class="form-control @error('page_title') is-invalid @enderror" id="pagetitle" placeholder="Enter Page title" value="{{ old('page_title') }}">
                                    @error('page_title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                {{-- <div class="form-group">
                                    <label for="seo_meta_tag_title">SEO Meta Tag Title</label>
                                    <input type="text" name="seo_meta_tag_title" class="form-control @error('seo_meta_tag_title') is-invalid @enderror" id="seo_meta_tag_title" placeholder="Enter Page Name" value="{{ old('seo_meta_tag_title') }}">
                                </div>
                                <div class="form-group">
                                    <label for="seo_meta_tag">SEO Meta Tag Description</label>
                                    <input type="text" name="seo_meta_tag" class="form-control @error('seo_meta_tag') is-invalid @enderror" id="seo_meta_tag" placeholder="Enter Page Name" value="{{ old('seo_meta_tag') }}">
                                </div> --}}
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

<!-- Include CKEditor script -->
<!-- <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script> -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        CKEDITOR.replace('blogContentHtml', {
    allowedContent: true, // Allow all content including inline styles
    extraAllowedContent: '*(*);*{*}', // Allow all tags and all styles
    removeFormatAttributes: ''
});
    });
</script>

@endsection
