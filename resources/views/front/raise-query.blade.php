@extends('front.layouts2.layout2')
@section('content')
    <div class="breadcrumbs">
        <div class="container">
            <ul>
                <li><a href="{{ route('home') }}">Home</a> </li>
                <li><a href="{{ route('raise.query') }}">Raise Query</a> </li>
            </ul>
        </div>
    </div>
    <section class="queryPart">
        <div class="container">
            <div class="titlePart">
                <h4>Raise Your Query</h4>
                <p>Enter your email or mobile to fill your need</p>
            </div>
            <!-- Show submitted message -->
            @if (session('submitted'))
                <div class="alert alert-success">
                    {{ session('submitted') }}
                </div>
            @endif

            <form class="raiseForm" id="raise_form" action="{{ route('query.submit') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div style="margin-left: -12px;margin-right: -12px;">
                    <div class="inputMainBlock">
                        <span>Full Name<i>*</i></span>
                        <input type="text" name="full_name" class="FullNameVD" placeholder="Full Name"
                            value="{{ old('full_name') }}">
                        @error('full_name')
                            <div class="qurery-errormsg">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="inputMainBlock">
                        <span>E-mail ID<i>*</i></span>
                        <input type="text" name="email" class="emailVD" placeholder="example@gmail.com"
                            value="{{ old('email') }}">
                        @error('email')
                            <div class="qurery-errormsg">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="inputMainBlock">
                        <span>Mobile Number<i>*</i></span>
                        <input type="text" name="mobile" class="mobileVD" placeholder="00000 00000"
                            value="{{ old('mobile') }}">
                        @error('mobile')
                            <div class="qurery-errormsg">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="inputMainBlock">
                        <span>Product Name</span>
                        <input type="text" name="product_name" class="AnyValueVD" placeholder="wheelchair"
                            value="{{ old('product_name') }}">
                        @error('product_name')
                            <div class="qurery-errormsg">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="inputMainBlock">
                        <span>Upload Reference
                            {{-- <i>*</i> --}}
                        </span>
                        <label class="fileUpload">
                            Browse Picture <img src="{{ asset('front/images/upload.svg') }}" alt="upload" />
                            <input type="file" name="file_upload" class="file-upload AnyValueVD" />
                        </label>
                        <div class="uploadedPart">
                            <div class="imgDis">
                                <a href="#;">
                                    <img src="{{ asset('front/images/Remove_x.svg') }}" alt="Remove_x" class="close1" />
                                </a>
                                <img src="#" alt="" class="uploadeedImg" />
                            </div>
                            <p>Image Upload Successfully</p>
                        </div>
                        @error('file_upload')
                            <div class="qurery-errormsg">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="inputMainBlock">
                        <span>Description</span>
                        <textarea name="description" class="AnyValueVD" value="{{ old('description') }}"> {{ old('description') }} </textarea>
                        @error('description')
                            <div class="qurery-errormsg">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="checkboxPart">
                    <div class="">
                        <label>
                            <input type="checkbox" name="terms" />
                            <i></i>
                        </label>
                        I read and understand <a href="{{ route('terms.and.conditions') }}">Terms and Conditions</a>.
                    </div>

                    <button type="submit">Submit Query</button>
                </div>
                @error('terms')
                    <p class="qurery-qurery-qurery-errormsg" style="color:#B40000;padding-left: 36px;font-size: 14px;">Please check terms and
                        conditions.</p>
                @enderror
            </form>
        </div>
    </section>
      @if (session('submitted'))
    {{-- <script>
       
             toastr.success('{{session("submitted")}}');
         
    </script> --}}
    @endif
@endsection('content')
