@extends('admin.layout.layout')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Brand</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Brand</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="card">
        <div class="card-header">
          <a href="{{ route('admin.brand.create') }}" class="card-title">Add Brand</a>
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
              @foreach($brands as $brand)
                <tr>
                  <td>{{ $brand->name }}</td>
                  <td>
                    @if($brand->image)
                      <img src="{{ asset('storage/Brand/' . $brand->image) }}" alt="{{ $brand->name }}" width="50" height="50">
                    @else
                      No image
                    @endif
                  </td>
                  <td>
                    <a href="{{ route('admin.brand.edit', $brand->id) }}" class="btn btn-sm btn-primary">
                      <i class="fas fa-edit"></i>
                    </a>
                    <a href="{{ route('admin.brand.destroy', $brand->id) }}" class="btn btn-sm btn-danger">
                      <i class="fas fa-trash-alt"></i>
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

@endsection
