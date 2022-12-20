@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <h3 class="text-dark mb-4">{{ __('Products') }}</h3>
        <div class="card shadow">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <div class="card-title">
                    <p class="text-primary m-0 fw-bold">{{ __('Products list') }}</p>

                </div>
                <div class="card-toolbar">
                    <a href="{{route('admin.products.create')}}" class="btn btn-primary"> <i class="bi bi-plus"></i>Create product  </a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 text-nowrap">
                        <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable"><label
                                class="form-label">Show <select class="d-inline-block form-select form-select-sm">
                                    <option value="10" selected>10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select></label></div>
                    </div>
                    <div class="col-md-6">
                        <div id="dataTable_filter" class="text-md-end dataTables_filter"><label class="form-label"><input
                                    class="form-control form-control-sm" type="search" aria-controls="dataTable"
                                    placeholder="Search" /></label>
                        </div>
                    </div>
                </div>
                <div id="dataTable" class="table-responsive table mt-2" role="grid" aria-describedby="dataTable_info">
                    <table id="dataTable" class="table my-0">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Price</th>
                                <th>sale price</th>
                                <th>SKU </th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td> <img src="{{$product->getFirstMediaUrl('featured','thumbnail')}}" width="70" class="rounded m-2"> </td>
                                    <td>{{ $product->title_excerpt }}</td>
                                    <td>{{ $product->price }}</td>
                                    <td>{{ $product->sale_price }}</td>
                                    <td>{{ $product->sku }}</td>
                                    <td>
                                        <a href="{{ route('admin.products.show', $product) }}"
                                            class="btn btn-sm btn-clean btn-circle btn-secondary"><i
                                                class="bi bi-eye"></i></a>
                                        <a href="{{ route('admin.products.edit', $product) }}"
                                            class="btn btn-sm btn-clean btn-circle btn-primary"><i
                                                class="bi bi-pencil-square"></i></a>
                                        <a href="{{ route('admin.products.destroy', $product) }}"
                                            class="btn btn-sm btn-clean btn-circle btn-danger"><i
                                                class="bi bi-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Price</th>
                                <th>sale price</th>
                                <th>SKU </th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                {{ $products->links() }}

            </div>
        </div>
    </div>
@endsection
