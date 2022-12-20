@extends('layouts.client')

@section('content')
    <section class="py-5">
        <!-- Start: Team -->
        <div class="container py-5">
            <div class="row mb-4 mb-lg-5">
                <div class="col-md-8 col-xl-6 text-center mx-auto">
                    <h2 class="fw-bold">المنتوجات</h2>
                    <p class="text-muted">تصفح قائمة المنتوجات&nbsp;</p>
                </div>
            </div>
            <div class="row mx-auto">
                @foreach($products as $product)
                <div class="col-md-4 col-sm-12 mb-4">
                    <div><a href="{{route('client.products.show', $product)}}">
                        <img class="rounded img-fluid shadow w-100 fit-cover" src="{{$product->getFirstMediaUrl('gallery')}}"
                                style="height: 250px;" /></a>
                        <div class="py-4">
                            <span @class(["badge bg-primary mb-2" ,'text-decoration-line-through bg-secondary' =>$product->sale_price<$product->price]) >
                                 {{$product->price}} DZD  
                                 {{-- @isset($product->sale_price)
                                 <strong>{{$product->sale_price}} DZD  </strong>
                                 @endisset --}}

                            </span>
                          @isset($product->sale_price)
                            <span @class(["badge bg-primary mb-2" ]) > <strong>{{$product->sale_price}} DZD  </strong></span>

                            @endisset
                            <h4 class="fw-bold">{{$product->title}}</h4>
                            <p class="text-muted">{{$product->short_description}}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="row mx-auto">
                {{$products->links()}}
            </div>
        </div><!-- End: Team -->

    </section>
@endsection
