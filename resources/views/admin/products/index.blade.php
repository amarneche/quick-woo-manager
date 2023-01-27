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
                    <a class="btn btn-primary" data-bs-toggle="collapse" href="#contentId" aria-expanded="false"
                        aria-controls="contentId">
                        {{__("Filter")}}
                    </a>
                    <a href="{{ route('admin.products.create') }}" class="btn btn-primary"> 
                        <i class="bi bi-plus"></i> {{__("Create Product")}}
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="collapse @if(!is_null(request('filter'))) show @endif" id="contentId">
                    <form action="{{ route('admin.products.index') }}" method="get">
                        
                        <div class="row">
                            <div class="col-md-3">
                                <div class="mb-3">
                                  <label for="filter[sku]" class="form-label">{{__("SKU")}}</label>
                                  <input type="text" value="{{request("filter.sku","")}}"
                                    class="form-control" name="filter[sku]" id="filter[sku]" aria-describedby="helpId" placeholder="">
                                </div>
                            </div>
                            <div class="col-md-3">

                                <div class="mb-3">
                                    <label for="filter[title]" class="form-label">{{ __('Title') }}</label>
                                    <input type="text" value="{{request('filter.title',"")}}" class="form-control" name="filter[title]" id="filter[title]"
                                        aria-describedby="helpId" placeholder="Product title">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="brand" class="form-label">{{__("Brand")}}</label>
                                    <select class="form-select " name="filter[brand]" id="brand">
                                        <option value=""></option>
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand }}" @selected(request('filter.brand')==$brand ) >{{ $brand }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="mb-3">
                                    <label for="sort[]" class="form-label">{{__("Sort by")}}</label>
                                    <select class="form-select " name="sort[]" id="sort[]">
                                        <option value="-data->views">{{__("Views descending")}}</option>
                                        <option value="data->views">{{__("Views at Ascending")}}</option>
                                        <option value="-created_at">{{__("Created at descending")}}</option>
                                        <option value="created_at">{{__("Created at Ascending")}}</option>
                                        <option value="-price">{{__("Price at descending")}}</option>
                                        <option value="price">{{__("Price at Ascending")}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 d-flex  align-items-center">
                                <a href="{{route('admin.products.index')}}" class="btn btn-secondary mx-2">{{__("Clear")}}</a>
                                <button type="submit" class="btn btn-primary">{{ __('Filter') }}</button>
                            </div>
                        </div>
                        
                    </form>
                </div>
                <div id="dataTable" class="table-responsive table mt-2" role="grid" aria-describedby="dataTable_info">
                    <table class="table my-0">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Brand</th>
                                <th>Price</th>
                                <th>sale price</th>
                                <th>Safir price</th>
                                <th>Safir margin</th>
                                <th>SKU </th>
                                <th>Views </th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td> <img src="{{ $product->getFirstMediaUrl('featured', 'thumbnail') }}"
                                            width="70" class="rounded m-2"> </td>
                                    <td>{{ $product->title_excerpt }}</td>
                                    <td>{{ $product->brand }}</td>
                                    <td>{{ $product->price }}</td>
                                    <td>{{ $product->sale_price }}</td>
                                    <td>{{ $product->safir_price }}</td>
                                    <td>{{ $product->minProfit }}</td>
                                    <td>{{ $product->sku }}</td>
                                    <td>{{ $product->views }}</td>
                                    <td>
                                        <div class="dropdown open">
                                            <button class="btn btn-clean btn-icon dropdown-toggle" type="button"
                                                id="actionId" data-bs-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">

                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="actionId">
                                                <a target="_blank" class="dropdown-item"
                                                    href="{{ route('client.products.show', $product) }}"><i
                                                        class="bi bi-eye"></i> View</a>
                                                <a class="dropdown-item"
                                                    href="{{ route('admin.products.edit', $product) }}"> <i
                                                        class="bi-pencil-square"></i> Edit
                                                </a>
                                                <a class="dropdown-item delete-link"
                                                    data-action="{{ route('admin.products.destroy', $product) }}"
                                                    data-bs-target="#deleteModal" data-bs-toggle="modal">
                                                    <i class="bi bi-trash"></i> Delete
                                                </a>
                                                <a class="dropdown-item schedule" data-bs-toggle="modal"
                                                    data-bs-target="#schedule-modal"
                                                    data-action="{{ route('admin.products.schedule', $product) }}">
                                                    {{ __('Share as Post') }}
                                                </a>
                                                <a target="_blank" href="{{ $product->safir_link }}"
                                                    class="dropdown-item">Safir link</a>

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
                {{ $products->links() }}
            </div>
        </div>
    </div>
@endsection
@section('modals')
    @include('admin.modals.schedule-product')
@endsection
