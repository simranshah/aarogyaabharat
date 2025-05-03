@extends('admin.layout.layout')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Product Attribute</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Product</li>
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
                            <h3 class="card-title"><small>Edit Product Attribute</small></h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="productForm" method="POST" action="{{ route('admin.products.attribute.update', $attribute->id) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <!-- Additional Product Attribute Fields -->
                                <div class="form-group">
                                    <label for="productSelect">Select Product</label>
                                    <select name="product_id" id="productSelect" class="form-control @error('product_id') is-invalid @enderror">
                                        <option value="">Select a Product</option>
                                        @foreach($products as $product)
                                        <option value="{{ $product->id }}"
                                            {{ $attribute->product_id == $product->id ? 'selected' : (old('product_id') == $product->id ? 'selected' : '') }}>
                                            {{ $product->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('product_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="productSize">Stock</label>
                                    <input type="number" min="0" name="stock" class="form-control @error('stock') is-invalid @enderror" id="productStock" placeholder="Enter Stock" value="{{ old('stock', $attribute->stock) }}">
                                    @error('stock')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="productSize">Size</label>
                                    <input type="text" name="size" class="form-control @error('size') is-invalid @enderror" id="productSize" placeholder="Enter Size" value="{{ old('size', $attribute->size) }}">
                                    @error('size')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="productColor">Color</label>
                                    <input type="text" name="color" class="form-control @error('color') is-invalid @enderror" id="productColor" placeholder="Enter Color" value="{{ old('color', $attribute->color) }}">
                                    @error('color')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="productWeight">Weight</label>
                                    <input type="text" name="weight" class="form-control @error('weight') is-invalid @enderror" id="productWeight" placeholder="Enter Weight" value="{{ old('weight', $attribute->weight) }}">
                                    @error('weight')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="productMaterial">Material</label>
                                    <input type="text" name="material" class="form-control @error('material') is-invalid @enderror" id="productMaterial" placeholder="Enter Material" value="{{ old('material', $attribute->material) }}">
                                    @error('material')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="productBrand">Brand</label>
                                    <input type="text" name="brand" class="form-control @error('brand') is-invalid @enderror" id="productBrand" placeholder="Enter Brand" value="{{ old('brand', $attribute->brand) }}">
                                    @error('brand')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="productModelNumber">Model Number</label>
                                    <input type="text" name="model_number" class="form-control @error('model_number') is-invalid @enderror" id="productModelNumber" placeholder="Enter Model Number" value="{{ old('model_number', $attribute->model_number) }}">
                                    @error('model_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="productExpirationDate">Expiration Date</label>
                                    <input type="date" name="expiration_date" class="form-control @error('expiration_date') is-invalid @enderror" id="productExpirationDate" placeholder="Enter Expiration Date" value="{{ old('expiration_date', $attribute->expiration_date) }}">
                                    @error('expiration_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <!-- Existing fields... -->
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
