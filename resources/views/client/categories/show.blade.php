@extends('layouts.client')

@section('content')
    <section class="py-5">
        <!-- Start: Team -->
        <div class="container py-5">
            <div class="row mb-4 mb-lg-5">
                <div class="col-md-8 col-xl-6 text-center mx-auto">
                    <h2 class="fw-bold">{{$category->title}}</h2>
                    <p class="text-muted">تصفح قائمة المنتوجات</p>
                </div>
            </div>
            <div class="row mx-auto">
                @foreach ($category->products as $product)
                    <div class="col-md-4 col-sm-12 mb-4 p2 ">
                        <div class="bg-white shadow rounded h-100">
                            <a href="{{ route('client.products.show', $product) }}">
                                <img class="rounded img-fluid shadow w-100 fit-cover"
                                    src="{{ $product->getFirstMediaUrl('featured') }}" style="height: 250px;" /></a>
                            <div class="py-4 px-2">
                                <h6 class="fw-bold">{{ $product->title }}</h6>
                                <div class="col text-center">
                                    <h6 class="fw-bolder   text-primary @isset($product->sale_price) text-decoration-line-through @endisset  ">
                                        {{ $product->price }} دج</h6>
                                    @isset($product->sale_price)
                                        <h6 class="mx-2">{{ $product->sale_price }} دج</h6>
                                    @endisset
                                </div>
                                <div class="col text-center">
                                    <a href="{{ route('client.products.show', $product) }}" class="btn btn-primary"> أطلب
                                        الأن : {{ $product->getChoosenPrice() }} دج </a>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div><!-- End: Team -->

    </section>
@endsection
