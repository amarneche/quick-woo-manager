@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <h4 class="text-dark">{{ __('Orders') }}</h4>

        <div class="card card-shadow">
            <div class="card-header">
                <h4>{{ __('Liste des commandes') }}</h4>
            </div>

            <div class="card-body no-padding">
                <div class="table-responsive">
                    <table class="table ">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Wilaya</th>
                                <th>commune</th>
                                <th>Method</th>
                                <th>Total</th>
                                <th>{{__("Status")}}</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td data-content="{{ $order->name }}">{{ $order->name }}</td>
                                    <td data-content="{{ $order->phone }}">{{ $order->phone }}</td>
                                    <td data-content="{{ $order->wilaya->name }}">{{ $order->wilaya->name }}</td>
                                    <td data-content="{{ $order->commune }}">{{ $order->commune }}</td>
                                    <td data-content="{{ $order->delivery_method_name }}">
                                        {{ $order->delivery_method_name }}
                                    </td>
                                    <td>{{ $order->total }}</td>
                                    <td>
                                        <div class="dropdown open">
                                            <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" id="triggerId" data-bs-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                        {{$order->stage?->name}}
                                                    </button>
                                            <div class="dropdown-menu" aria-labelledby="triggerId">
                                                @foreach($stages->except($order->stage?->id) as $stage)
                                                    <button class="dropdown-item btn btn-sm">
                                                        {{$stage->name}}
                                                    </button>
                                                @endforeach
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-primary y dropdown-toggle" type="button"
                                                id="triggerId" data-bs-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">

                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="triggerId">

                                                <a class="dropdown-item"
                                                    href="{{ route('admin.orders.show', $order) }}">View</a>
                                                <a class="dropdown-item delete-link" href="{{ route('admin.orders.destroy', $order) }}"
                                                    data-bs-target="#deleteModal" data-bs-toggle="modal"
                                                    data-action="{{ route('admin.orders.destroy', $order) }}">Delete </a>
                                                <a class="dropdown-item"
                                                    href="{{ route('admin.orders.edit', $order) }}">Edit </a>

                                            </div>
                                        </div>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                {{$orders->links()}}
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('table td').on('click', function() {

                navigator.clipboard.writeText($(this).data('content'));
            });
        });
    </script>
@endsection
