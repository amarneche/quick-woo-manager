@extends('layouts.admin')

@section('content')
    <div class="content">
        <form action="{{route('admin.crowler.store')}}" method="post" >
           
        <div class="card mb-3">
            <div class="card-header">
             <p class="text-primary fw-bold"> {{__('Import products from Safir click')}}</p>
            </div>
            <div class="card-body">
                @csrf @method('post')
                <div class="mb-3">
                  <label for="products" class="form-label">Insert links </label>
                  <textarea class="form-control" name="products" id="products" rows="10"></textarea>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="margin" class="form-label">Add Margin:</label>
                            <input type="number"
                              class="form-control" name="margin" id="margin" aria-describedby="helpId" placeholder="margin">
                            <small id="helpId" class="form-text text-muted">Add the amount of DZD you want in addition to the profit</small>
                          </div>
            
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="category" class="form-label">Main Category</label>
                            <select class="form-select " name="category" id="category">
                               @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->title}}</option>
                               @endforeach
                            </select>
                        </div>
                    </div>
                </div>

            </div>
            <div class="card-footer">
                <div class="pull-right float-end">
                    <button type="submit" class="btn btn-primary">Schedule Import</button>
                </div>
            </div>
        </div>
        </form>

    </div>
@endsection
