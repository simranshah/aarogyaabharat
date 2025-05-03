@extends('admin.layout.layout')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Banners</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Banners</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="card">
        <div class="card-header">
          <a href="{{ route('banners.create') }}" class="btn btn-primary">Add Banner</a>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Name</th>
                <th>Image</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($banners as $banner)
                <tr>
                  <td>{{ $banner->title }}</td>
                  <td>
                    @if($banner->image)
                      <img src="{{ asset('storage/' . $banner->image) }}" alt="{{ $banner->title }}" width="100" height="50">
                    @else
                      No image
                    @endif
                  </td>
                  <td>
                    <a href="{{ route('banners.edit', $banner->id) }}" class="btn btn-sm btn-primary">
                      <i class="fas fa-edit"></i>
                    </a>
                    <a href="{{ route('banners.destroy', $banner->id) }}" class="btn btn-sm btn-danger">
                      <i class="fas fa-trash"></i>
                    </a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection
