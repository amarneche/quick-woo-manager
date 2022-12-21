@extends('layouts.admin')

@section('content')
    <div id="content">


        <h3 class="text-dark mb-4">Edit product</h3>
        <form action="{{ route('admin.products.update', $product) }}" method="post" enctype="multipart/form-data">
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
                                        <div class="col">
                                            <div class="mb-3"><label class="form-label"
                                                    for="title"><strong>Title</strong></label>
                                                <input id="title" value="{{ $product->title }}" class="form-control"
                                                    type="text" placeholder="Product title" name="title" />
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="mb-3"><label class="form-label"
                                                    for="sku"><strong>Sku</strong></label>
                                                <input id="sku" value="{{ $product->sku }}" class="form-control"
                                                    type="sku" placeholder="" name="sku" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="mb-3"><label class="form-label" for="price"><strong> Price
                                                    </strong></label>
                                                <input id="price" class="form-control" value="{{ $product->price }}"
                                                    type="number" name="price" />
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="mb-3"><label class="form-label" for="sale_price"><strong> Sale
                                                        price
                                                    </strong></label>
                                                <input id="sale_price" class="form-control"
                                                    value="{{ $product->sale_price }}" type="number" name="sale_price" />
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
                                        <textarea class="form-control" name="short_description" id="short_description" rows="5">
                                            {!! $product->short_description !!}
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card mb-3">
                        <button type="submit" class="btn btn-primary">Edit </button>
                    </div>
                    <div class="card mb-3 " id="product-featured">
                        <div class="card-body text-center shadow ">
                            <div class="mb-3">
                                <label for="" class="form-label">Featured image</label>
                                <input type="file" class="form-control" name="featured" id="" accept="image/*">
                                <small id="helpId" class="form-text text-muted">Help text</small>
                            </div>

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
                                <textarea class="form-control" name="description" id="description" rows="10">
                                    {!! $product->description !!}
                                </textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
<script src="{{asset("assets/plugins/ckeditor/ckeditor.js")}}" ></script>

    <script>
        $(document).ready(function() {
            ClassicEditor.create(document.getElementById("description"));
            ClassicEditor.create(document.getElementById("short_description"));
        });
        var uploadedDocumentFileMap = {}
        Dropzone.options.productFeatured = {
            url: '{{ route('admin.products.storeMedia') }}',
            maxFilesize: 25, // MB
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 25
            },
            success: function(file, response) {
                $('form').append('<input type="hidden" name="document_file[]" value="' + response.name + '">')
                uploadedDocumentFileMap[file.name] = response.name
            },
            removedfile: function(file) {
                file.previewElement.remove()
                var name = ''
                if (typeof file.file_name !== 'undefined') {
                    name = file.file_name
                } else {
                    name = uploadedDocumentFileMap[file.name]
                }
                $('form').find('input[name="document_file[]"][value="' + name + '"]').remove()
            },
            init: function() {
                @if (isset($crmDocument) && $crmDocument->document_file)
                    var files =
                        {!! json_encode($crmDocument->document_file) !!}
                    for (var i in files) {
                        var file = files[i]
                        this.options.addedfile.call(this, file)
                        file.previewElement.classList.add('dz-complete')
                        $('form').append('<input type="hidden" name="document_file[]" value="' + file.file_name +
                            '">')
                    }
                @endif
            },
            error: function(file, response) {
                if ($.type(response) === 'string') {
                    var message = response //dropzone sends it's own error messages in string
                } else {
                    var message = response.errors.file
                }
                file.previewElement.classList.add('dz-error')
                _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
                _results = []
                for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                    node = _ref[_i]
                    _results.push(node.textContent = message)
                }

                return _results
            }
        }
    </script>
@endsection
