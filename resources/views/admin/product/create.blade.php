@extends('admin.layout.layout')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Create Product</h1>
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
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title"><small>Create Product</small></h3>
                            </div>
                            <form id="productForm" method="POST" action="{{ route('admin.products.store') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <!-- Product Fields -->
                                    <div class="form-group">
                                        <label for="productName">Product Name</label>
                                        <input type="text" name="name"
                                            class="form-control @error('name') is-invalid @enderror" id="productName"
                                            placeholder="Enter Product Name" value="{{ old('name') }}">
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="productCategory">Category</label>
                                        <select name="category_id"
                                            class="form-control @error('category_id') is-invalid @enderror"
                                            id="productCategory">
                                            <option value="">Select Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="productCategory">Sub Category</label>
                                        <select name="subcategory_id"
                                            class="form-control @error('subcategory_id') is-invalid @enderror"
                                            id="productCategory">
                                            <option value="">Select Category</option>
                                            @foreach ($subcategories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ old('subcategory_id') == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('subcategory_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="productBrand">Brand</label>
                                        <select name="brand_id"
                                            class="form-control @error('brand_id') is-invalid @enderror"
                                            id="productBrand">
                                            <option value="">Select Brand</option>
                                            @foreach ($brands as $brand)
                                                <option value="{{ $brand->id }}"
                                                    {{ old('brand_id') == $brand->id ? 'selected' : '' }}>
                                                    {{ $brand->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('brand_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="productTitle">Title</label>
                                        <input type="text" name="title"
                                            class="form-control @error('title') is-invalid @enderror" id="productTitle"
                                            placeholder="Enter Product Title" value="{{ old('title') }}">
                                        @error('title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
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
                                        @error('image.*')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="image_1">Extra Image 1</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" name="image_1" class="custom-file-input" id="image_1">
                                                <label class="custom-file-label" for="image_1">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="image_2">Extra Image 2</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" name="image_2" class="custom-file-input" id="image_2">
                                                <label class="custom-file-label" for="image_2">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="image_3">Extra Image 3</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" name="image_3" class="custom-file-input" id="image_3">
                                                <label class="custom-file-label" for="image_3">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="image_4">Extra Image 4</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" name="image_4" class="custom-file-input" id="image_4">
                                                <label class="custom-file-label" for="image_4">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="imagealt">Image Alt</label>
                                        <input type="text" name="alt" class="form-control @error('alt') is-invalid @enderror" id="imagealt" placeholder="Image Alt" value="{{ old('alt') }}">
                                        @error('alt')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="productDescription">Description</label>
                                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="productDescription"
                                            placeholder="Enter Product Description">{{ old('description') }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    {{-- <div class="form-group">
                                        <label for="productFeatures">Features and Specifications</label>
                                        <textarea name="features_specification" class="form-control @error('features_specification') is-invalid @enderror"
                                            id="productFeatures" placeholder="Enter Product Features and Specifications">{{ old('features_specification') }}</textarea>
                                        @error('features_specification')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div> --}}
                                    <div class="form-group">
                                        <label for="productPrice">Orignal Price</label>
                                        <input type="number" name="price" min="0"
                                            class="form-control @error('price') is-invalid @enderror" id="productPrice" onblur="calculateourprice()"
                                            placeholder="Enter Product Price" value="{{ old('price') }}">
                                        @error('price')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="productDiscount">Product Discount (%)</label>
                                        <input type="number" name="dicount_percentage" min="0"
                                            class="form-control @error('dicount_percentage') is-invalid @enderror" id="productDiscount" onblur="calculateourprice()"
                                            placeholder="Enter Product Discount (%)" value="{{ old('dicount_percentage') }}">
                                        @error('dicount_percentage')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="productDiscount">Product our Price</label>
                                        <input type="number" name="" min="0"
                                            class="form-control" id="prouctourprize"
                                            placeholder="Enter Product Discount (%)" value="" readonly>
                                            <div class="invalid-feedback"></div>

                                    </div>
                                    <div class="form-group">
                                        <label for="weeklyPrice">Monthly Price</label>
                                        <input type="number" name="monthly_price" min="0"
                                            class="form-control @error('monthly_price') is-invalid @enderror"
                                            id="weeklyPrice" placeholder="Enter Monthly Price"
                                            value="{{ old('monthly_price') }}">
                                        @error('weekly_price')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="deliveryFees">Delivery And Installation Fees</label>
                                        <input type="number" name="delivery_and_installation_fees" min="0"
                                            class="form-control @error('delivery_and_installation_fees') is-invalid @enderror"
                                            id="deliveryFees" placeholder="Enter Delivery and Installation Fees"
                                            value="{{ old('delivery_and_installation_fees') }}">
                                        @error('delivery_and_installation_fees')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="gst">GST Percentage</label>
                                        <input type="number" name="gst" min="0"
                                            class="form-control @error('gst') is-invalid @enderror" id="gst"
                                            placeholder="Enter GST Percentage" value="{{ old('gst') }}">
                                        <small style="color:red">Please enter the GST percentage.</small>
                                        @error('gst')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input type="checkbox" name="is_rentable" class="form-check-input"
                                                value="1" id="isRentable" {{ old('is_rentable') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="isRentable">Is Rentable</label>
                                        </div>
                                        @error('is_rentable')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <div class="form-check">
                                            <input type="checkbox" name="is_popular" class="form-check-input"
                                                id="isPopular" value="1" {{ old('is_popular') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="isPopular">Is Popular</label>
                                        </div>
                                        @error('is_popular')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <div class="form-check">
                                            <input type="checkbox" name="product_for_you" class="form-check-input"
                                                id="product_for_you" value="1" {{ old('product_for_you') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="product_for_you">Product For You</label>
                                        </div>
                                        @error('product_for_you')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input type="checkbox" name="flash_sale" class="form-check-input"
                                                id="flash_sale" value="1" {{ old('flash_sale') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="flash_sale">Flash Sale</label>
                                        </div>
                                        @error('flash_sale')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input type="checkbox" name="best_selling_products" class="form-check-input"
                                                id="best_selling_products" value="1" {{ old('best_selling_products') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="best_selling_products">Best Selling Products</label>
                                        </div>
                                        @error('best_selling_products')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input type="checkbox" name="sports_healthcare_more" class="form-check-input"
                                                id="sports_healthcare_more" value="1" {{ old('sports_healthcare_more') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="sports_healthcare_more">Sports Healthcare More</label>
                                        </div>
                                        @error('sports_healthcare_more')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input type="checkbox" name="top_deals" class="form-check-input"
                                                id="top_deals" value="1" {{ old('top_deals') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="top_deals">Top Deals</label>
                                        </div>
                                        @error('top_deals')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input type="checkbox" name="top_pick_for_you" class="form-check-input"
                                                id="top_pick_for_you" value="1" {{ old('top_pick_for_you') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="top_pick_for_you">Top Pick For You</label>
                                        </div>
                                        @error('top_pick_for_you')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input type="checkbox" name="is_new" class="form-check-input"
                                                id="isNew" value="1" {{ old('is_new') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="isNew">Is New</label>
                                        </div>
                                        @error('is_new')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="aboutItem">About Item</label>
                                        <textarea name="about_item" class="form-control @error('about_item') is-invalid @enderror" id="aboutItem"
                                            placeholder="Enter About Item">{{ old('about_item') }}</textarea>
                                        @error('about_item')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="aboutItem">Features Specification</label>
                                        <textarea name="features_specification" class="form-control @error('features_specification') is-invalid @enderror" id="features_specification"
                                            placeholder="Enter About Item">{{ old('features_specification') }}</textarea>
                                        @error('features_specification')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="aboutItem">Measurements</label>
                                        <textarea name="measurements" class="form-control @error('measurements') is-invalid @enderror" id="measurements"
                                            placeholder="Enter About Item">{{ old('measurements') }}</textarea>
                                        @error('measurements')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="aboutItem">Why Choose This Product</label>
                                        <textarea name="why_choose_this_product" class="form-control @error('why_choose_this_product') is-invalid @enderror" id="why_choose_this_product"
                                            placeholder="Enter About Item">{{ old('why_choose_this_product') }}</textarea>
                                        @error('why_choose_this_product')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                     <div class="form-group">
                                        <label for="aboutItem">Usage Instructions</label>
                                        <textarea name="usage_instructions" class="form-control @error('usage_instructions') is-invalid @enderror" id="usage_instructions"
                                            placeholder="Enter About Item">{{ old('usage_instructions') }}</textarea>
                                        @error('usage_instructions')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="pageName">Page Title(HEAD)</label>
                                        <input type="text" name="page_title"
                                            class="form-control @error('page_title') is-invalid @enderror" id="pagetitle"
                                            placeholder="Enter Page title" value="{{ old('page_title') }}">
                                        @error('page_title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="seo_meta_tag_title">SEO Meta Tag Title</label>
                                        <input type="text" name="seo_meta_tag_title"
                                            class="form-control @error('seo_meta_tag_title') is-invalid @enderror"
                                            id="seo_meta_tag_title" placeholder="Enter Page Name"
                                            value="{{ old('seo_meta_tag_title') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="seo_meta_tag">SEO Meta Tag Description</label>
                                        <input type="text" name="seo_meta_tag"
                                            class="form-control @error('seo_meta_tag') is-invalid @enderror"
                                            id="seo_meta_tag" placeholder="Enter Page Name"
                                            value="{{ old('seo_meta_tag') }}">
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

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
