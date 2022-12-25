@extends('layouts.admin')

@section('content')
    <div id="content">


        <h3 class="text-dark mb-4">Create product</h3>
        <form action="{{ route('admin.products.store') }}" method="post" enctype="multipart/form-data">
            @method('post')
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
                                            <div class="mb-3"><label class="form-label"
                                                    for="title"><strong>Title</strong></label><input id="title"
                                                    class="form-control" type="text" placeholder="Product title"
                                                    name="title" /></div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3"><label class="form-label"
                                                    for="sku"><strong>Sku</strong></label><input id="sku"
                                                    class="form-control" type="sku" placeholder="" name="sku" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="mb-3">
                                                <label class="form-label" for="price"><strong> Price </strong>
                                                </label>
                                                <input id="price" class="form-control" type="number" name="price" />
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="mb-3">
                                                <label class="form-label" for="sale_price"><strong> Sale price
                                                    </strong></label>
                                                <input id="sale_price" class="form-control" type="number"
                                                    name="sale_price" />
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="card shadow">
                                <div class="card-header py-3">
                                    <p class="text-primary m-0 fw-bold">Short description</p>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="short_description" class="form-label">Short description</label>
                                        <textarea class="ckeditor form-control" name="short_description" id="short_description" rows="5"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card mb-3">
                        <button type="submit" class="btn btn-primary">Create </button>
                    </div>
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="category" class="form-label">Categorie</label>
                                <select class="form-select " name="category" id="category">
                                    <option selected>Select one</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-3 " id="product-featured">
                        <div class="card-body text-center shadow ">
                            <div id="image-area">
                                <img class="image responsive w-100" src="" alt="" id="featuredPreview">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Featured image</label>
                                <input type="file" class="form-control" name="featured" id="featured" accept="image/*">
                                <small id="helpId" class="form-text text-muted">Help text</small>
                            </div>
                            <div id="info-area"></div>

                        </div>
                    </div>
                    <div class="card mb-3 ">
                        <div class="card-body text-center shadow">
                            <div class="mb-3">
                                <label for="gallery" class="form-label">Gallery</label>
                                <input type="file" class="form-control" name="gallery[]" id="gallery"
                                    placeholder="Gallery" aria-describedby="GalleryInput" multiple>
                                <div id="GalleryInput" class="form-text">Upload Galery</div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <div class="card shadow mb-5">
                <div class="card-header py-3">
                    <p class="text-primary m-0 fw-bold">Description</p>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>

                                <textarea class="form-control" name="description" id="description" rows="10"></textarea>
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
            ClassicEditor.create(document.getElementById("description"));
            ClassicEditor.create(document.getElementById("short_description"));
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            featured= document.getElementById("featured");
            gallery= document.getElementById("gallery");
            featuredPond =FilePond.create(featured);
            galleryPond =FilePond.create(gallery);
            galleryPond.setOptions({alllowMultiple:true});
        });

    </script>
@endsection
