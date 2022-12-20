@extends('layouts.client')

@section('content')
    <section class="py-5">
        <!-- Start: 1 Row 2 Columns -->
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <img class="img-fluid" src="{{ $product->getFirstMediaUrl('featured') }}" loading="lazy">
                </div>
                <div class="col-md-6">
                    <h4>
                        <span>{{ $product->title }}</span>
                    </h4>
                    <div class="row my-2">
                        <div class="col">
                            <span class="fw-bolder display-6   text-primary">{{$product->price}} دج</span>
                            <span  class="text-decoration-line-through mx-2 display-6" >{{$product->sale_price}} دج</span>
                        </div>
                    </div>
                    <div class="row" dir="{{ $product->direction }}">
                        <div class="col">
                            <p>{{ $product->short_description }} </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card  bg-light border-dark border rounded-0 border-2 shadow-lg d-flex justify-content-center align-items-center mb-5 px-3 "
                                id="order">
                                <div class="card-body w-100 ">
                                    <h2 class=" mb-4">قدم طلبك الأن</h2>
                                    <form method="post" id="quick-order" action="{{ route('client.quick-order',['product'=>$product]) }}" data-choosen-price="{{$product->getChoosenPrice()}}" >
                                        @csrf @method('post')
                                        
                                        <input type="hidden" name="product_id"value="{{$product->id}}"  >
                                        <!-- Start: Success Example -->
                                        <div class="mb-3">
                                            <input class="form-control text-center" type="text" id="name" name="name"  placeholder="الاسم و اللقب">
                                            </div>
                                        <!-- End: Success Example -->

                                        <!-- Start: Error Example -->
                                        <div class="mb-3">
                                            <input dir="ltr" class="form-control text-center" type="text" id="phoneNumber"  name="phone" placeholder="رقم الهاتف">
                                        </div>
                                        <!-- End: Error Example -->
                                        <!-- Start: Error Example -->
                                        <div class="mb-3">
                                            <select class="form-select select2 " name="wilaya_id" required>
                                                <option value="" class="text-center">الولاية</option>
                                                @foreach($wilayas as $wilaya)
                                                <option value="{{$wilaya->id}}" data-code="{{$wilaya->code}}" data-home="{{$wilaya->delivery_home}}" data-stop-desk="{{$wilaya->delivery_stopDesk}}">{{$wilaya->name}}</option>
                                                @endforeach
                                            </select>
                                        </div><!-- End: Error Example -->
                                        <!-- Start: Error Example -->
                                        <div class="mb-3">
                                            <input class="form-control text-center" type="text" id="commune" name="commune"
                                                placeholder="البلدية">
                                        </div>
                                        <!-- End: Error Example -->
                                        <div id="delivery" class="row mb-3">
                                            <div class="col d-flex justify-content-center align-items-center mx-2 p-1 border border-2 ">
                                                <div class="form-check  py-3">
                                                    <input class="form-check-input" data-cost="" type="radio" id="homeDelivery" name="delivery" value="home">
                                                    <label class="form-check-label" for="homeDelivery">  توصيل الى  المنزل <strong id="priceHomeDelivery"> </strong> </label>
                                                    
                                                </div>
                                            </div>
                                            <div class="col d-flex flex-grow-1 justify-content-center align-items-center mx-2 p-1 border border-2"
                                                for="formCheck-3">
                                                <div class="form-check py-3">
                                                    <input class="form-check-input" data-cost="" type="radio" id="stopDesk" name="delivery" value="stopDesk">
                                                    <label class="form-check-label text-nowrap" for="stopDesk">
                                                        توصيل الى المكتب <strong id="priceStopDesk"> </strong>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="input-group input-group-sm d-flex d-md-flex flex-row justify-content-md-center align-items-md-center"
                                                style="text-align: center;">
                                                <span class="border rounded-pill input-group-text" id="incrementQty">+</span>
                                                <input class="form-control mx-2 fw-bolder text-center" type="text" name="product_qty" value="1" min="1" >
                                                <span class="border rounded-pill input-group-text" id="decrementQty">-</span>
                                            </div>
                                        </div>
                                        <div>
                                            <button class="btn btn-primary btn-lg d-block w-100"  id="submitBtn"   type="submit">
                                                <span class="fw-bold">تأكيد الطلب: <span class="" id="total">   </span></span>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- End: 1 Row 2 Columns -->
        <!-- Start: 1 Row 1 Column -->
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 style="text-align: center;font-weight: bold;">الخصائص</h1>
                    {!! $product->description !!}
                    <div class="d-flex flex-grow-1 flex-fill justify-content-center align-items-center"><a
                            class="d-flex btn btn-primary" href="#order"><br><strong>تقـديم الطلب</strong><br></a></div>
                </div>
            </div>
        </div><!-- End: 1 Row 1 Column -->
    </section><!-- Start: Footer Multi Column -->
@endsection


@section('scripts')

    <script src="{{asset('assets/front/js/quick-order.js')}}" ></script>
@endsection