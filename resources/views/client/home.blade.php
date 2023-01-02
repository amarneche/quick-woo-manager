@extends('layouts.client')

@section('content')
    <div class="container-fluid m-0">
        <div class="row">
            <div class="col p-0">
                <section>
                    <div
                        style="height: 400px;background: url('{{ asset('assets/front/img/hero-girl.jpg') }}') center / cover;background-position: top;background-repeat: no-repeat;">
                    </div>
                    <div class="container h-100 position-relative" style="top: -50px;">
                        <div class="row gy-5 gy-lg-0 row-cols-1 row-cols-md-2 row-cols-lg-3">
                            <div class="col">
                                <div class="card shadow">
                                    <div class="card-body pt-5 p-4">
                                        <div class="bs-icon-lg bs-icon-rounded bs-icon-primary d-flex flex-shrink-0 justify-content-center align-items-center position-absolute mb-3 bs-icon lg"
                                            style="top: -30px;"><svg class="bi bi-stars" xmlns="http://www.w3.org/2000/svg"
                                                width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16">
                                                <path
                                                    d="M7.657 6.247c.11-.33.576-.33.686 0l.645 1.937a2.89 2.89 0 0 0 1.829 1.828l1.936.645c.33.11.33.576 0 .686l-1.937.645a2.89 2.89 0 0 0-1.828 1.829l-.645 1.936a.361.361 0 0 1-.686 0l-.645-1.937a2.89 2.89 0 0 0-1.828-1.828l-1.937-.645a.361.361 0 0 1 0-.686l1.937-.645a2.89 2.89 0 0 0 1.828-1.828l.645-1.937zM3.794 1.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387A1.734 1.734 0 0 0 4.593 5.69l-.387 1.162a.217.217 0 0 1-.412 0L3.407 5.69A1.734 1.734 0 0 0 2.31 4.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387A1.734 1.734 0 0 0 3.407 2.31l.387-1.162zM10.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732L9.1 2.137a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L10.863.1z">
                                                </path>
                                            </svg></div>
                                        <h4 class="card-title">أفضل الأسعار</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card shadow">
                                    <div class="card-body pt-5 p-4">
                                        <div class="bs-icon-lg bs-icon-rounded bs-icon-primary d-flex flex-shrink-0 justify-content-center align-items-center position-absolute mb-3 bs-icon lg"
                                            style="top: -30px;"><svg class="bi bi-truck" xmlns="http://www.w3.org/2000/svg"
                                                width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16">
                                                <path
                                                    d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5v-7zm1.294 7.456A1.999 1.999 0 0 1 4.732 11h5.536a2.01 2.01 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456zM12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12v4zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z">
                                                </path>
                                            </svg></div>
                                        <h4 class="card-title">توصيل سريع</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card shadow">
                                    <div class="card-body pt-5 p-4">
                                        <div class="bs-icon-lg bs-icon-rounded bs-icon-primary d-flex flex-shrink-0 justify-content-center align-items-center position-absolute mb-3 bs-icon lg"
                                            style="top: -30px;"><svg class="bi bi-chat-dots"
                                                xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                                fill="currentColor" viewBox="0 0 16 16">
                                                <path
                                                    d="M5 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2z">
                                                </path>
                                                <path
                                                    d="m2.165 15.803.02-.004c1.83-.363 2.948-.842 3.468-1.105A9.06 9.06 0 0 0 8 15c4.418 0 8-3.134 8-7s-3.582-7-8-7-8 3.134-8 7c0 1.76.743 3.37 1.97 4.6a10.437 10.437 0 0 1-.524 2.318l-.003.011a10.722 10.722 0 0 1-.244.637c-.079.186.074.394.273.362a21.673 21.673 0 0 0 .693-.125zm.8-3.108a1 1 0 0 0-.287-.801C1.618 10.83 1 9.468 1 8c0-3.192 3.004-6 7-6s7 2.808 7 6c0 3.193-3.004 6-7 6a8.06 8.06 0 0 1-2.088-.272 1 1 0 0 0-.711.074c-.387.196-1.24.57-2.634.893a10.97 10.97 0 0 0 .398-2z">
                                                </path>
                                            </svg></div>
                                        <h4 class="card-title">خدمة ما بعد البيع</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <h1 class="fw-bold text-center my-5">تسوق حسب التصنيفات</h1>
            </div>
        </div>
        <div class="row mx-xs-4 mx-2">
            @foreach ($categories as $category)
                <div class="col-md-6 col-xl-4 p-2">
                    <a href="{{ route('client.categories.show', $category) }}">
                        <div class="card shadow h-100 justify-content-center">
                            <div class="card-body"><img class="rounded img-fluid w-100"
                                    src="{{ $category->getFirstMediaUrl('featured') }}" />
                                <h5 class="fw-bold text-center mt-3">{{ $category->title }} </h5>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach


        </div>
    </div>


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
                                    <h6
                                        class="fw-bolder   text-primary @isset($product->sale_price) text-decoration-line-through @endisset  ">
                                        {{ $product->price }} دج</h6>
                                    @isset($product->sale_price)
                                        <h6 class="mx-2">{{ $product->sale_price }} دج</h6>
                                    @endisset
                                </div>
                                <div class="col text-center">
                                    <a href="{{ route('client.products.show', $product) }}" class="btn btn-primary"> أطلب
                                        الأن : {{ $product->getChoosenPrice() }} دج </a>
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
