@extends('admin.layout.layout')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Product</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.products') }}">Products</a></li>
                            <li class="breadcrumb-item active">Edit Product</li>
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
                                <h3 class="card-title"><small>Edit Product</small></h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form id="productForm" method="POST"
                                action="{{ route('admin.products.update', $product->id) }}" enctype="multipart/form-data">
                                @csrf
                                <!-- @method('PUT') -->
                                <div class="card-body">
                                    <!-- Product Name -->
                                    <div class="form-group">
                                        <label for="productName">Product Name</label>
                                        <input type="text" name="name"
                                            class="form-control @error('name') is-invalid @enderror" id="productName"
                                            placeholder="Enter Product Name" value="{{ old('name', $product->name) }}">
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Category -->
                                    <div class="form-group">
                                        <label for="productCategory">Category</label>
                                        <select name="category_id"
                                            class="form-control @error('category_id') is-invalid @enderror"
                                            id="productCategory">
                                            <option value="">Select Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Title -->
                                    <div class="form-group">
                                        <label for="productTitle">Title</label>
                                        <input type="text" name="title"
                                            class="form-control @error('title') is-invalid @enderror" id="productTitle"
                                            placeholder="Enter Product Title" value="{{ old('title', $product->title) }}">
                                        @error('title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Image -->
                                    <div class="form-group">
                                        <label for="productImage">Product Image</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" name="image[]"
                                                    class="custom-file-input @error('image') is-invalid @enderror"
                                                    id="productImage" multiple>
                                                <label class="custom-file-label" for="productImage">Choose file</label>
                                            </div>
                                            <div class="input-group-append">
                                                <span class="input-group-text">Upload</span>
                                            </div>
                                        </div>
                                        @if ($product->image)
                                            <div class="mt-2">
                                                <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" onload="calculateourprice()"
                                                    width="100">
                                            </div>
                                        @endif
                                        @error('image')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    @if ($product->images->isNotEmpty() && isset($product->images->first()->alt) && !empty($product->images->first()->alt))
                                        <div class="form-group">
                                            <label for="imagealt">Image Alt</label>
                                            <input type="text" name="alt"
                                                class="form-control @error('alt') is-invalid @enderror" id="imagealt"
                                                placeholder="Image Alt"
                                                value="{{ old('alt', $product->images->first()->alt) }}">
                                            @error('alt')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    @endif

                                    <!-- Description -->
                                    <div class="form-group">
                                        <label for="productDescription">Description</label>
                                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="productDescription"
                                            placeholder="Enter Product Description">{{ old('description', $product->description) }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Features and Specifications -->
                                    <div class="form-group">
                                        <label for="productFeatures">Features and Specifications</label>
                                        <textarea name="features_specification" class="form-control @error('features_specification') is-invalid @enderror"
                                            id="productFeatures" placeholder="Enter Product Features and Specifications">{{ old('features_specification', $product->features_specification) }}</textarea>
                                        @error('features_specification')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Price -->
                                    <div class="form-group">
                                        <label for="productPrice">Orignal Price</label>
                                        <input type="number" name="price" min="0"
                                            class="form-control @error('price') is-invalid @enderror" id="productPrice" onblur="calculateourprice()"
                                            placeholder="Enter Product Price" value="{{ old('price', $product->price) }}">
                                        @error('price')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="productDiscount">Product Discount (%)</label>
                                        <input type="number" name="dicount_percentage" min="0"
                                            class="form-control @error('dicount_percentage') is-invalid @enderror" id="productDiscount" onblur="calculateourprice()"
                                            placeholder="Enter Product Discount (%)" value="{{ old('dicount_percentage' , $product->discount_percentage) }}">
                                        @error('dicount_percentage')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="productDiscount">Product Our Price</label>
                                        <input type="number" name="" min="0"
                                            class="form-control" id="prouctourprize"
                                            placeholder="Enter Product Discount (%)" value="" readonly>
                                            <div class="invalid-feedback"></div> 
                                    </div>
                                    <!-- Weekly Price -->
                                    <div class="form-group">
                                        <label for="weeklyPrice">Monthly Price</label>
                                        <input type="number" name="monthly_price" min="0"
                                            class="form-control @error('monthly_price') is-invalid @enderror"
                                            id="weeklyPrice" placeholder="Enter Monthly Price"
                                            value="{{ old('monthly_price', $product->monthly_price) }}">
                                        @error('monthly_price')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="deliveryFees">Delivery And Installation Fees</label>
                                        <input type="number" name="delivery_and_installation_fees" min="0"
                                            class="form-control @error('delivery_and_installation_fees') is-invalid @enderror"
                                            id="deliveryFees" placeholder="Enter Delivery and Installation Fees"
                                            value="{{ old('delivery_and_installation_fees', $product->delivery_and_installation_fees) }}">
                                        @error('delivery_and_installation_fees')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="gst">GST Percentage</label>
                                        <input type="number" name="gst" min="0"
                                            class="form-control @error('gst') is-invalid @enderror" id="gst"
                                            placeholder="Enter GST Percentage" value="{{ old('gst', $product->gst) }}">
                                        <small style="color:red">Please enter the GST percentage.</small>
                                        @error('gst')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Rentable -->
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input type="checkbox" name="is_rentable" class="form-check-input"
                                                id="isRentable" value="{{ $product->is_rentable ? 1 : 0 }}"
                                                {{ old('is_rentable', $product->is_rentable) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="isRentable">Is Rentable</label>
                                        </div>
                                        @error('is_rentable')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Popular -->
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input type="checkbox" name="is_popular" class="form-check-input"
                                                id="isPopular" value="{{ $product->is_popular ? 1 : 0 }}"
                                                {{ old('is_popular', $product->is_popular) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="isPopular">Is Popular</label>
                                        </div>
                                        @error('is_popular')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- New -->
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input type="checkbox" name="is_new" class="form-check-input" value="{{ $product->is_new ? 1 : 0 }}"
                                                id="isNew" {{ old('is_new', $product->is_new) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="isNew">Is New</label>
                                        </div>
                                        @error('is_new')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                     <div class="form-group">
                                        <div class="form-check">
                                            <input type="checkbox" name="product_for_you" class="form-check-input" value="{{ $product->product_for_you ? 1 : 0 }}"
                                                id="isNew" {{ old('product_for_you', $product->product_for_you) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="isNew">Product For You</label>
                                        </div>
                                        @error('product_for_you')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                     <div class="form-group">
                                        <div class="form-check">
                                            <input type="checkbox" name="flash_sale" class="form-check-input" value="{{ $product->flash_sale ? 1 : 0 }}"
                                                id="flash_sale" {{ old('flash_sale', $product->flash_sale) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="flash_sale">Flash Sale</label>
                                        </div>
                                        @error('flash_sale')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                     <div class="form-group">
                                        <div class="form-check">
                                            <input type="checkbox" name="best_selling_products" class="form-check-input" value="{{ $product->best_selling_products ? 1 : 0 }}"
                                                id="best_selling_products" {{ old('best_selling_products', $product->best_selling_products) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="best_selling_products">Best Selling Products</label>
                                        </div>
                                        @error('best_selling_products')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                     <div class="form-group">
                                        <div class="form-check">
                                            <input type="checkbox" name="sports_healthcare_more" class="form-check-input" value="{{ $product->sports_healthcare_more ? 1 : 0 }}"
                                                id="sports_healthcare_more" {{ old('sports_healthcare_more', $product->sports_healthcare_more) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="sports_healthcare_more">Sports Healthcare More</label>
                                        </div>
                                        @error('sports_healthcare_more')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                     <div class="form-group">
                                        <div class="form-check">
                                            <input type="checkbox" name="top_deals" class="form-check-input" value="{{ $product->top_deals ? 1 : 0 }}"
                                                id="top_deals" {{ old('top_deals', $product->top_deals) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="top_deals">Top Deals</label>
                                        </div>
                                        @error('top_deals')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                     <div class="form-group">
                                        <div class="form-check">
                                            <input type="checkbox" name="top_pick_for_you" class="form-check-input" value="{{ $product->top_pick_for_you ? 1 : 0 }}"
                                                id="top_pick_for_you" {{ old('top_pick_for_you', $product->top_pick_for_you) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="top_pick_for_you">Top Pick For You</label>
                                        </div>
                                        @error('top_pick_for_you')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- About Item -->
                                    <div class="form-group">
                                        <label for="aboutItem">About Item</label>
                                        <textarea name="about_item" class="form-control @error('about_item') is-invalid @enderror" id="aboutItem"
                                            placeholder="Enter About Item">{{ old('about_item', $product->about_item) }}</textarea>
                                        @error('about_item')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="aboutItem">Features Specification</label>
                                        <textarea name="features_specification" class="form-control @error('features_specification') is-invalid @enderror" id="features_specification"
                                            placeholder="Enter Features Specification">{{ old('features_specification', $product->features_specification) }}</textarea>
                                        @error('features_specification')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                     <div class="form-group">
                                        <label for="aboutItem">Measurements</label>
                                        <textarea name="measurements" class="form-control @error('measurements') is-invalid @enderror" id="features_specification"
                                            placeholder="Enter Features Specification">{{ old('features_specification', $product->measurements) }}</textarea>
                                        @error('measurements')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                     <div class="form-group">
                                        <label for="aboutItem">Usage Instructions</label>
                                        <textarea name="usage_instructions" class="form-control @error('usage_instructions') is-invalid @enderror" id="usage_instructions"
                                            placeholder="Enter Features Specification">{{ old('usage_instructions', $product->usage_instructions) }}</textarea>
                                        @error('usage_instructions')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                     <div class="form-group">
                                        <label for="aboutItem">Why Choose This Product</label>
                                        <textarea name="why_choose_this_product" class="form-control @error('why_choose_this_product') is-invalid @enderror" id="why_choose_this_product"
                                            placeholder="Enter Features Specification">{{ old('why_choose_this_product', $product->why_choose_this_product) }}</textarea>
                                        @error('why_choose_this_product')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>


                                    <div class="form-group">
                                        <label for="pageName">Page Title(HEAD)</label>
                                        <input type="text" name="page_title"
                                            class="form-control @error('page_title') is-invalid @enderror" id="pagetitle"
                                            placeholder="Enter Page title" value="{{ old('page_title',$product->page_title) }}">
                                        @error('page_title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="seo_meta_tag_title">SEO Meta Tag Title</label>
                                        <input type="text" name="seo_meta_tag_title"
                                            class="form-control @error('seo_meta_tag_title') is-invalid @enderror"
                                            id="seo_meta_tag_title" placeholder="Enter Page Name"
                                            value="{{ old('seo_meta_tag_title' ,$product->seo_meta_tag_title) }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="seo_meta_tag">SEO Meta Tag Description</label>
                                        <input type="text" name="seo_meta_tag"
                                            class="form-control @error('seo_meta_tag') is-invalid @enderror"
                                            id="seo_meta_tag" placeholder="Enter Page Name"
                                            value="{{ old('seo_meta_tag' ,$product->seo_meta_tag) }}">
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

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            CKEDITOR.replace('productFeatures');
            CKEDITOR.replace('aboutItem');
            CKEDITOR.replace('why_choose_this_product');
            CKEDITOR.replace('measurements');
            CKEDITOR.replace('usage_instructions');
            CKEDITOR.replace('features_specification'); 
        });
        function calculateourprice() {
            var price = parseFloat(document.getElementById('productPrice').value);
            var discountPercentage = parseFloat(document.getElementById('productDiscount').value);
            var ourPrice = price - (price * (discountPercentage / 100));
            document.getElementById('prouctourprize').value = ourPrice.toFixed(2);
        }
    </script>
@endsection
