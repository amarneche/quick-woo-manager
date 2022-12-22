@extends("layouts.admin")

@section("content")
    <div class="container-fluid">
        <h4 class="text-dark">{{__("Orders")}}</h4>

        <div class="card card-shadow">
            <div class="card-header">
                <h4>{{__('Liste des commandes')}}</h4>
            </div>  
            <div class="card-body no-padding">
                <table class="table table-sm-responsive">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Wilaya</th>
                            <th>commune</th>
                            <th>Method</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td >{{$order->id}}</td>
                            <td data-content="{{$order->name}}" >{{$order->name}}</td>
                            <td data-content="{{$order->phone}}">{{$order->phone}}</td>
                            <td data-content="{{$order->wilaya->name}}">{{$order->wilaya->name}}</td>
                            <td data-content="{{$order->commune}}">{{$order->commune}}</td>
                            <td data-content="{{$order->delivery_method_name}}">{{$order->delivery_method_name}}</td>
                            <td>{{$order->total}}</td>
                            <td>
                                <a href="{{route('admin.orders.show',$order)}}" class="btn btn-xs btn-circle btn-primary"><i class="bi bi-eye"></i></a>
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        $('table td').on('click', function(){
            
            navigator.clipboard.writeText($(this).data('content'));
        });
    });
</script>

@endsection