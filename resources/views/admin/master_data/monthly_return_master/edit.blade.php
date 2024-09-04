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
                        <h6 class="page-title">Lavel Master</h6>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('lavel-master') }}">Lavel Master</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Add new Lavel</li>
                        </ol>
                    </div>
                    <div class="col-md-4">
                        <div class="float-end d-none d-md-block">
                            <div class="dropdown">
                                <a href="{{ route('monthly-return.index') }}" class="btn btn-primary  dropdown-toggle" aria-expanded="false">
                                    <i class="fas fa-arrow-left me-2"></i> Back
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <form class="custom-validation" action="{{ route('monthly-return.update',$item->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-lg-9">
                        <div class="card">
                            <div class="card-header bg-primary text-light">
                                Edit Lavel
                            </div>
                            <div class="card-body row">
                                <div class="mb-3 col-md-4">
                                    <label class="form-label">Choose Category</label>
                                    <div>
                                        <select class="form-select" name="category" id="cat_id" aria-label="Default select example" required>
                                            <option value="" disabled selected>Choose...</option>
                                            @foreach($categories as $categorie)
                                            <option value="{{ $categorie->id }}">{{ $categorie->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label class="form-label">Choose Product</label>
                                    <div>
                                        <select class="form-select" name="product" id="product" aria-label="Default select example" required>
                                            <option value="" disabled selected>None</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="form_amount" class="form-label">From Amount</label>
                                    <div>
                                        <input data-parsley-type="number" type="number"
                                            class="form-control" required id="form_amount"
                                            placeholder="" name="form_amount" value="{{ $item->form_amount }}">
                                    </div>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="to_amount" class="form-label">To Amount</label>
                                    <div>
                                        <input data-parsley-type="number" type="number"
                                            class="form-control" id="to_amount"
                                            placeholder="" name="to_amount" value="{{ $item->to_amount }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="percentage" class="form-label">Persentage</label>
                                    <div class="input-group has-validation">
                                        <span class="input-group-text"><i class="fas fa-percent"></i></span>
                                        <input type="number" class="form-control" placeholder="" value="{{ $item->percentage }}" id="percentage" aria-describedby="inputGroupPrepend" name="percentage" required>
                                        <div class="invalid-feedback">
                                            This field is required
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="percentage" class="form-label">Return Persentage</label>
                                    <div class="input-group has-validation">
                                        <span class="input-group-text"><i class="fas fa-percent"></i></span>
                                        <input type="number" class="form-control" placeholder="" value="" id="percentage" aria-describedby="inputGroupPrepend" name="return_percentage" required>
                                        <div class="invalid-feedback">
                                            This field is required
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                    <div class="col-lg-3">
                        <div class="card">
                            <div class="card-header bg-primary text-light">
                                Publish
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label mb-3 d-flex">Visiblity</label>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" id="customRadioInline1" name="visiblity" class="form-check-input" value="1" {{ check_uncheck($item->visiblity,1) }}>
                                        <label class="form-check-label" for="customRadioInline1">Show</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" id="customRadioInline2" name="visiblity" class="form-check-input" value="0" {{ check_uncheck($item->visiblity,0) }}>
                                        <label class="form-check-label" for="customRadioInline2">Hide</label>
                                    </div>
                                </div>
                                <div class="mb-0">
                                    <div>
                                        <button type="submit" class="btn btn-primary waves-effect waves-light me-1">
                                            Save & Publish
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

@section('script')
<script>
    $('#cat_id').on('change',function(){
        $.ajax({
            url:"{{ route('monthly-return.get-products-by-category') }}",
            type:'POST',
            data:{"category_id":$(this).val(),"_token":"{{ csrf_token() }}"},
            success:function(response){
                $("#product").html('');
                $("#product").append('<option value="">Select Product</option>');
                $.each(response, function(index, item) {
                    $("#product").append('<option value="' + item.id + '">' + item.title + '</option>');
                });
            }
        });
    });
</script>
@endsection

@include("admin/dash/footer")