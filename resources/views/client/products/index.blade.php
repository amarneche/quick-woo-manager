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
            <div class="row mb-4">
                <div class="col-md-6 float-right">
                    <button class="btn btn-light border border-2 border-black" type="button" data-bs-toggle="offcanvas" data-bs-target="#offCanvaMenu" aria-controls="offCanvaMenu">
                        <i class="bi bi-funnel"></i>بحث</button>

                </div>
            </div>
            <div class="row mx-auto">
                @foreach ($products as $product)
                    <div class="col-md-4 col-sm-12 mb-4 p2 ">
                        <div class="bg-white shadow rounded h-100 overflow-hidden">

                            <a href="{{ route('client.products.show', $product) }}">
                                <div class="img-container" style="background-image: url('{{ $product->getFirstMediaUrl('featured') }}'); aspect-ratio: 1; background-position: center; background-repeat: no-repeat; background-size: cover; " >
                                    @if($product->free_shipping)
                                        <span class="badge bg-primary m-2 px-4 py-2">توصيل مجاني</span>
                                    @endif
                                </div>
                            </a>
                            <div class="p-4">
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
            <div class="row mx-auto overflow-hidden">
                {{ $products->links() }}
            </div>
        </div><!-- End: Team -->

    </section>
    
@endsection
