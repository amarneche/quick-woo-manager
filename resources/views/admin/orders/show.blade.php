@extends("layouts.admin")

@section("content")
<div class="row d-flex justify-content-center" dir="rtl">
    <div class="col col-md-8">
        <div class="card border border-2">
            <div class="card-header text-center">
                <h5>معلومات الطلبية</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="text-center">
                            <h6 class="text-center fw-bold">الإسم و اللقب</h6><span>{{$order->name}} </span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="text-center">
                            <h6 class="text-center fw-bold">رقم الهاتف</h6><span dir="ltr">{{$order->phone}}</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="text-center">
                            <h6 class="text-center fw-bold">الولاية</h6><span>{{$order->wilaya->name}}</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="text-center">
                            <h6 class="text-center fw-bold">البلدية</h6><span>{{$order->commune}}</span>
                        </div>
                    </div>



                </div>
                <div class="row">
                    <div class="col">
                        <h5 class="text-center fw-bold mt-4">المحتوى</h5>
                    </div>
                </div>
                <div class="row">
                    @foreach($order->items as $item)
                    <div class="col border border-1 p-0 rounded d-flex w-100">
                        <div class="flex-shrink-1 flex-nowrap">
                            <img  class="responsive rounded m-2" width="100" src="{{$item->product_thumbnail_url}}" />
                        </div>
                        <div class="flex-grow-1 d-flex mx-2">
                            <div class="py-2">
                                <h6 class="fw-bold">   {{$item->product_title}} <br /></h6>
                                <h6 class="fw-bold">   {{$item->sku}} <br /></h6>
                                @if(!is_null($item->product?->safir_link))
                                    <a target="_blank" href="{{$item->product?->safir_link}} " class="btn btn-primary">{{__("Safir link")}}</a> <br />
                                @endif
                                <h6 class="fw-bold text-muted">   {{$item->price}} دج * {{$item->qte}} = {{$item->price *$item->qte}} دج  </h6>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="row mt-4 mb-4">
                    <div class="col-md-4">
                        <div class="text-center">
                            <h6 class="text-center fw-bold">طريقة التوصيل</h6><span>{{$order->delivery_method_name}}</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-center">
                            <h6 class="text-center fw-bold">تكلفة التوصيل</h6><span>{{$order->delivery_cost}} دج</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-center">
                            <h6 class="text-center fw-bold"> المجموع</h6><span>{{$order->total}}  دج</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col text-center">
                        <a href="/" class="btn btn-primary"> تصفح المزيد من العروض   </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection