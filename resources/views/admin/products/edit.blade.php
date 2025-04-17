<!-- adding header -->
@include("admin/dash/header")
<!-- end header -->

    <!-- ========== Left Sidebar Start ========== -->
    @include("admin/dash/left_side_bar")
    <!-- Left Sidebar End -->     

    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <!-- start page title -->
                <div class="page-title-box">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h6 class="page-title">{{ $title }}</h6>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('products') }}">{{ $title }}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Edit {{ $title }}</li>
                            </ol>
                        </div>
                        <div class="col-md-4">
                            <div class="float-end d-none d-md-block">
                                <div class="dropdown">
                                    <a href="{{ route('products') }}" class="btn btn-primary  dropdown-toggle" aria-expanded="false">
                                        <i class="fas fa-arrow-left me-2"></i> Back
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end page title -->
                <form class="custom-validation" action="{{ route('products.update-process') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" value="{{ $product->id }}" name="product_id">
                    <div class="row">
                        <div class="col-lg-9">
                            <div class="card">
                                <div class="card-header bg-primary text-light">
                                    Edit Product
                                </div>
                                <div class="card-body row">
                                    <!-- <div class="mb-3">
                                        <label class="form-label">Parent Category</label>
                                        <div>
                                            <select class="form-select" name="cat_id" id="cat_id" aria-label="Default select example" required>
                                                <option value="">None</option>
                                            </select>
                                        </div>
                                    </div> -->

                                    <!-- <div class="mb-3">
                                        <label class="form-label">Category</label>
                                        <div>
                                            <select class="form-select" name="subcat_id" id="subcat_id" aria-label="Default select example">
                                                <option value="">None</option>
                                            </select>
                                        </div>
                                    </div> -->

                                    <div class="mb-3 col-md-4">
                                        <label class="form-label">Name</label>
                                        <div>
                                            <input data-parsley-type="text" type="text" class="form-control" value="{{ $product->title }}" required placeholder="Enter Title" name="name">
                                        </div>
                                    </div>

                                    <div class="mb-3 col-md-4">
                                        <label class="form-label">Choose Category</label>
                                        <div>
                                            <select class="form-select" name="cat_id" id="cat_id" aria-label="Default select example" required>
                                                <option value="" disabled selected>Choose...</option>
                                                @foreach($categories as $categorie)
                                                <option value="{{ $categorie->id }}" @if($categorie->id == $product->category_id) selected @endif>{{ $categorie->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3 col-md-4">
                                        <label class="form-label">SKU</label>
                                        <div>
                                            <input data-parsley-type="text" type="text" class="form-control" required placeholder="" name="sku" value="{{ $product->sku }}">
                                        </div>
                                    </div> 

                                    <div class="mb-3 col-md-3">
                                        <label class="form-label">Price</label>
                                        <input data-parsley-type="text" type="text" class="form-control" required placeholder="" name="product_price" id="product_price_input" value="{{ $product->price }}" onkeyup="calculateTotPrice()">
                                    </div>

                                    <div class="mb-3 col-md-3">
                                        <label class="form-label">Discount Rate</label>
                                        <div id="discount_input_container">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text input-group-text-currency" id="basic-addon-discount-variation">%</span>
                                                </div>
                                                <input type="number" name="discount_rate" id="input_discount_rate" aria-describedby="basic-addon-discount-variation" class="form-control form-input" value="{{ $product->discount_rate }}" min="0" max="99" placeholder="0" onkeyup="calculateTotPrice()">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3 col-md-3">
                                        <label class="form-label">GST<small>&nbsp;(Goods & Services Tax)</small></label>
                                        <div id="gst_input_container">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                <span class="input-group-text input-group-text-currency" id="basic-addon-gst">%</span>
                                                </div>
                                                <input type="number" name="gst_rate" id="input_gst_rate" aria-describedby="basic-addon-gst" class="form-control form-input" value="{{ $product->gst_rate }}" min="0" max="99" placeholder="0" onkeyup="calculateTotPrice()">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3 col-md-3">
                                        <label class="form-label">Total Price</label>
                                        <input data-parsley-type="text" type="text" class="form-control" placeholder="" name="total_price" id="total_price_input" value="{{ $product->total_price }}" readonly>
                                    </div>
                      
                                    <div class="mb-3">
                                        <label class="form-label">Short Description</label>
                                        <div>
                                            <textarea name="short_desc" class="form-control editor" rows="5">{{ $product->short_desc }}</textarea>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Description</label>
                                        <div>
                                            <textarea name="description"  class="form-control editor" rows="5">{{ $product->description }}</textarea>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Specification</label>
                                        <div>
                                            <textarea name="product_specification"  class="form-control editor" rows="5">{{ $product->product_specification }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="card">
                                <div class="card-header bg-primary text-light">
                                    Product Image
                                </div>
                                <div class="card-body text-center">
                                    <div class="mb-0">
                                        <img class="img-thumbnail rounded me-2" id="blah" alt="" width="200" src="{{ $product->product_image }}" data-holder-rendered="true" style="display: {{ is_have_image($product->product_image) }};">
                                    </div>
                                    <div class="mb-0">
                                        <input type="file" name="product_image" class="filestyle" id="imgInp" data-input="false" data-buttonname="btn-secondary">
                                    </div> 
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header bg-primary text-light">
                                    Publish
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="weight" class="form-label">Weight</label>
                                        <input class="form-control" name="weight" id="weight" value="{{ $product->weight }}" required="">
                                        <div class="invalid-feedback">
                                            This field is required
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label mb-3 d-flex">Is Add On Product ?</label>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" id="is_addon1" name="is_addon" class="form-check-input" value="1" {{ check_uncheck(1,$product->is_addon) }}>
                                            <label class="form-check-label" for="is_addon1">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" id="is_addon2" name="is_addon" class="form-check-input" value="0" {{ check_uncheck(0,$product->is_addon) }}>
                                            <label class="form-check-label" for="is_addon2">No</label>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label mb-3 d-flex">Is Dil Se Product ?</label>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" id="is_dilse1" name="is_dilse" class="form-check-input" value="1" {{ check_uncheck(1,$product->is_dilse) }}>
                                            <label class="form-check-label" for="is_dilse1">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" id="is_dilse2" name="is_dilse" class="form-check-input" value="0" {{ check_uncheck(0,$product->is_dilse) }}>
                                            <label class="form-check-label" for="is_dilse2">No</label>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label mb-3 d-flex">Is Special Product ?</label>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" id="is_special_product1" name="is_special_product" class="form-check-input" value="1" {{ check_uncheck(1,$product->is_special_product) }}>
                                            <label class="form-check-label" for="is_special_product1">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" id="is_special_product2" name="is_special_product" class="form-check-input" value="0" {{ check_uncheck(1,$product->is_special_product) }}>
                                            <label class="form-check-label" for="is_special_product2">No</label>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label mb-3 d-flex">Visiblity</label>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" id="customRadioInline1" name="is_visible" class="form-check-input" value="1" {{ check_uncheck(1,$product->is_visible) }}>
                                            <label class="form-check-label" for="customRadioInline1">Show</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" id="customRadioInline2" name="is_visible" class="form-check-input" value="0" {{ check_uncheck(0,$product->is_visible) }}>
                                            <label class="form-check-label" for="customRadioInline2">Hide</label>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label mb-3 d-flex">Is Bestseller?</label>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" id="pcy" name="is_featured" class="form-check-input" value="1" {{ check_uncheck(1,$product->is_featured) }}>
                                            <label class="form-check-label" for="pcy">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" id="pcn" name="is_featured" class="form-check-input" value="0" {{ check_uncheck(0,$product->is_featured) }}>
                                            <label class="form-check-label" for="pcn">No</label>
                                        </div>
                                    </div> 
                                    <div class="mb-0">
                                        <div>
                                            <button type="submit" class="btn btn-primary waves-effect waves-light me-1">
                                                Save & Next
                                            </button>
                                            <button type="reset" class="btn btn-secondary waves-effect">
                                                Cancel
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->
                </form>
            </div>
            <!-- container-fluid -->
        </div>
    </div>

    <script>
        function calculateTotPrice() {
            const price = parseFloat(document.getElementById('product_price_input').value) || 0;
            const discountRate = parseFloat(document.getElementById('input_discount_rate').value) || 0;
            const gstRate = parseFloat(document.getElementById('input_gst_rate').value) || 0;

            const discountAmount = (discountRate / 100) * price;
            const discountedPrice = price - discountAmount;
            const gstAmount = (gstRate / 100) * discountedPrice;
            const totalPrice = discountedPrice + gstAmount;

            document.getElementById('total_price_input').value = totalPrice.toFixed(2);
        }
    </script>

@include("admin/dash/footer")