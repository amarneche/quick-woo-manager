@extends('layouts.admin')

@section('content')
    <div id="content">


        <h3 class="text-dark mb-4">Edit product</h3>
        <form action="{{ route('admin.products.update',$product) }}" method="post" enctype="multipart/form-data">
            @method('patch')
            @csrf
            <div class="row mb-3">
                <div class="col-lg-8">

                    <div class="row">
                        <div class="col">
                            <div class="card shadow mb-3">
                                <div class="card-header py-3">
                                    <p class="text-primary m-0 fw-bold">Product Setting </p>
                                </div>
                                <div class="card-body">

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3"><label class="form-label" for="title"><strong>Title <span
                                                            class="text-danger">*</span> </strong></label>
                                                            <input
                                                    id="title" class="form-control" type="text" value="{{$product->title}}"
                                                    placeholder="Product title" name="title" /></div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3"><label class="form-label" for="sku"><strong>Sku <span
                                                            class="text-danger">*</span></strong></label>
                                                            <input id="sku" class="form-control" type="sku" value="{{$product->sku}}"
                                                    name="sku" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="mb-3">
                                                <label class="form-label" for="price"><strong> Price <span
                                                            class="text-danger">*</span> </strong>
                                                </label>
                                                <input id="price" class="form-control" type="number" name="price" value="{{$product->price}}" />
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="mb-3">
                                                <label class="form-label" for="sale_price"><strong> Sale price
                                                    </strong></label>
                                                <input id="sale_price" class="form-control" type="number" value="{{$product->sale_price}}"
                                                    name="sale_price" />
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="card shadow mb-3">
                                <div class="card-header py-3">
                                    <p class="text-primary m-0 fw-bold">Short description</p>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="short_description" class="form-label">Short description</label>
                                        <textarea class="ckeditor form-control" name="short_description" id="short_description" rows="5">{!! $product->short_description !!}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="card shadow mb-3">
                                <div class="card-header py-3">
                                    <p class="text-primary m-0 fw-bold">Facebook description</p>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Facebook description <span
                                                class="text-danger">*</span></label>
                                        <textarea class="form-control" name="description" id="description" rows="5">{{$product->description}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="card shadow mb-5">
                                <div class="card-header py-3">
                                    <p class="text-primary m-0 fw-bold">Product Description</p>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="product_description" class="form-label">Description for product page</label>
                
                                                <textarea class="ckeditor form-control" name="product_description" id="product_description" rows="10"> {!!$product->product_description!!} </textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card mb-3">
                        <button type="submit" class="btn btn-primary">Update </button>
                    </div>
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="category" class="form-label">Categorie</label>
                                <select class="form-select " name="category" id="category">
                                    
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" @selected($product->categories->contains($category->id)) >{{ $category->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="availabilty" class="form-label">Availability</label>
                                <select class="form-select " name="availabilty" id="availabilty">
                                    @foreach(App\Models\Product::$availability as $availability)
                                        <option value="{{$availability}}" @selected($product->availability==$availability)>{{$availability}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="condition" class="form-label">Condition</label>
                                <select class="form-select " name="condition" id="condition">
                                   @foreach(App\Models\Product::$condition as $condition)
                                   <option value="{{$condition}}" @selected($product->condition==$condition)>{{$condition}}</option>

                                   @endforeach

                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="brand" class="form-label">Brand <span class="text-danger">*</span> </label>
                                <input type="text" class="form-control" name="brand" value="{{$product->brand}}" id="brand"
                                    aria-describedby="brandHelpID" placeholder="Brand">
                                <small id="brandHelpID" class="form-text text-muted">Enter brand title</small>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-3 " id="product-featured">
                        <div class="card-body text-center shadow ">
                            <div id="image-area">
                                <img class="image responsive w-100" src="{{$product->getFirstMediaUrl('featured','preview')}}" alt="" id="featuredPreview">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Featured image <span class="text-danger">*</span></label>
                                <input type="file" class="form-control" name="featured" id="featured"
                                    accept="image/*">
                                <small id="helpId" class="form-text text-muted">Help text</small>
                            </div>
                            <div id="info-area"></div>

                        </div>
                    </div>
                    <div class="card mb-3 ">
                        <div class="row m-2">
                            @foreach($product->getMedia('gallery')  as $media )
                            <div class="col-md-4 border border-1 m-1 ">
                                <a href="#" class="badge bg-primary">New!</a>
                                <span class="position-absolute  badge badge-circle badge-primary">x</span>
                                <img src="{{$media->getUrl()}}" class="img-fluid rounded-top" alt="">
                            </div>
                            @endforeach

                        </div>
                        <div class="card-body text-center shadow">
                            <div class="mb-3">
                                <label for="gallery" class="form-label">Gallery</label>
                                <input type="file" class="form-control" name="gallery[]" id="gallery"
                                    placeholder="Gallery" aria-describedby="GalleryInput" multiple>
                                <div id="GalleryInput" class="form-text">Upload Galery</div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-3">
                        <div class="card-header">
                            <p class="text-primary m-0 fw-bold">Additional Setting </p>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="gender" class="form-label">Gender</label>
                                <select class="form-select " name="gender" id="gender">
                                    @foreach(App\Models\Product::$gender as $gender)
                                        <option value="{{$gender}}" @selected($gender==$product->gender)> {{$gender}}   </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="age_group" class="form-label">Age group</label>
                                <select class="form-select " name="age_group" id="age_group">
                                    @foreach(App\Models\Product::$age_groups as $group)
                                        <option value="{{$group}}" @selected($group==$product->age_group) >{{$group}} </option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="mb-3">
                              <label for="materiel" class="form-label">Materiel</label>
                              <input type="text"
                                class="form-control" name="materiel" id="materiel" aria-describedby="helpId" placeholder="">
                              <small id="helpId" class="form-text text-muted">Enter materiel of product</small>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </form>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/plugins/ckeditor/ckeditor.js') }}"></script>

    <script>
        $(document).ready(function() {
            ClassicEditor.create(document.getElementById("product_description"));
            ClassicEditor.create(document.getElementById("short_description"));
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            featured = document.getElementById("featured");
            gallery = document.getElementById("gallery");
            featuredPond = FilePond.create(featured);
            galleryPond = FilePond.create(gallery);
            galleryPond.setOptions({
                alllowMultiple: true
            });
        });
    </script>
@endsection
