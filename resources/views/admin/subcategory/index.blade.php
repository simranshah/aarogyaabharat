@extends('admin.layout.layout')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Sub Category</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Sub Category</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="card">
        <div class="card-header">
          <a href="{{ route('admin.sub.categories.create') }}" class="card-title">Add Sub Category</a>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <!-- <div id="jsGrid1"></div> -->
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Name</th>
                <th>Category</th>
                <th>Image</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($subCategories as $subCategory)
                <tr>
                  <td>{{ $subCategory->name }}</td>
                  <td>
                    <ul>
                      @foreach($categories->where('id', $subCategory->category_id) as $Category)
                        <li>{{ $Category->name }}</li>
                      @endforeach
                    </ul>
                  </td>
                  <td>
                    @if($subCategory->image)
                      <img src="{{ asset('storage/subcategories/' . $subCategory->image) }}" alt="{{ $subCategory->name }}" width="50" height="50">
                    @else
                      No image
                    @endif
                  </td>
                  
                  <td>
                    <a href="{{ route('admin.sub.categories.edit', $subCategory->id) }}" class="btn btn-sm btn-primary">
                      <i class="fas fa-edit"></i>
                    </a>
                    <a href="{{ route('admin.sub.categories.destroy', $subCategory->id) }}" class="btn btn-sm btn-danger">
                      <i class="fas fa-trash-alt"></i>
                    </a>
                  </td>
                </tr>
              @endforeach
            </tbody>
            <!-- <tfoot>
              <tr>
                <th>Rendering engine</th>
                <th>Browser</th>
                <th>Platform(s)</th>
                <th>Engine version</th>
                <th>CSS grade</th>
              </tr>
            </tfoot> -->
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </section>
    <!-- /.content -->
</div>

@endsection
