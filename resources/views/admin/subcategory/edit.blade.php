@extends('admin.layout.layout')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Subcategory</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Subcategory</li>
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
                <h3 class="card-title"><small>Edit Subcategory</small></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="subcategoryForm" method="POST" action="{{ route('admin.sub.categories.update', $subcategory->id) }}" enctype="multipart/form-data">
                @csrf
                <!-- @method('PUT') -->
                <div class="card-body">
                    <div class="form-group">
                        <label for="category">Category</label>
                        <select name="category_id" class="form-control @error('category_id') is-invalid @enderror" id="category">
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $category->id == old('category_id', $subcategory->category_id) ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="subcategoryName">Subcategory Name</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="subcategoryName" placeholder="Enter Subcategory Name" value="{{ old('name', $subcategory->name) }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="subcategoryImage">Subcategory Image</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" name="images[]"  multiple class="custom-file-input @error('image') is-invalid @enderror" id="subcategoryImage" onchange="previewImage(event)">
                                <label class="custom-file-label" for="subcategoryImage">Choose file</label>
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text">Upload</span>
                            </div>
                        </div>
                        @error('image')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                        @if($subcategory->image)
                            <div class="mt-2">
                                <img src="{{ asset('storage/subcategories/' . $subcategory->image) }}" alt="{{ $subcategory->name }}" class="img-thumbnail" width="150" id="imagePreview">
                            </div>
                        @endif

                        <div id="imagePreviewContainer" class="mt-2"></div>
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

<script>
  function previewImage(event) {
    const files = event.target.files;
    const imagePreviewContainer = document.getElementById('imagePreviewContainer');
    imagePreviewContainer.innerHTML = ''; 

    Array.from(files).forEach(file => {
        const reader = new FileReader();
        reader.onload = function(e) {
            const img = document.createElement('img');
            img.src = e.target.result;
            img.className = 'img-thumbnail';
            img.width = 150;
            img.style.margin = '5px';
            imagePreviewContainer.appendChild(img);
        };
        reader.readAsDataURL(file);
    });
}

</script>
