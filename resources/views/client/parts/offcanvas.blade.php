<div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offCanvaMenu" aria-labelledby="offCanvasH5">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offCanvasH5">Menu :</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="row">
            @foreach ($categories as $category)
                <div class="col-md-6  text-center">
                    <div class="border border-1 rounded m-1">
                        <div class="rounded"
                            style="background-image: url('{{ $category->getFirstMediaUrl('featured') }}');
                background-position: center;
                object-fit:cover;
                aspect-ratio: 16/9;
            ">
                        </div>
                        <small for="" class="small">{{ $category->title }} <span class="badge rounded-pill text-bg-primary">{{$category->products->count()}} </span> </small>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
