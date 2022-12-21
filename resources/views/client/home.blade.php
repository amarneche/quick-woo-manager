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
                @foreach ($products as $product)
                    <div class="col-md-4 col-sm-12 mb-4 p2 ">
                        <div class="bg-white shadow rounded h-100">
                            <a href="{{ route('client.products.show', $product) }}">
                                <img class="rounded img-fluid shadow w-100 fit-cover"
                                    src="{{ $product->getFirstMediaUrl('gallery') }}" style="height: 250px;" /></a>
                            <div class="py-4 px-2">
                                <h6 class="fw-bold">{{ $product->title }}</h6>
                                <div class="col text-center">
                                    <h6 class="fw-bolder   text-primary">{{ $product->price }} دج</h6>
                                    @isset($product->sale_price)    <h6 class="text-decoration-line-through mx-2">{{ $product->sale_price }} دج</h6> @endisset
                                </div>
                                <div class="col text-center">
                                    <a href="{{route('client.products.show',$product)}}" class="btn btn-primary">  أطلب الأن : {{$product->getChoosenPrice()}} دج </a>
                                </div>
                                {{-- <p class="text-muted">{!! $product->excerpt !!}</p> --}}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row mx-auto">
                {{ $products->links() }}
            </div>
        </div><!-- End: Team -->

    </section>
@endsection
