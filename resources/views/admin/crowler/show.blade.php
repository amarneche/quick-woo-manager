@extends('layouts.admin')

@section('content')
    <div class="content">
        <div class="card">
            <form action="{{route('admin.crowler.store')}}" method="post" >
                @csrf 
                @method('post')
                <div class="mb-3">
                  <label for="products" class="form-label">Insert Links</label>
                  <textarea class="form-control" name="products" id="products" rows="10"></textarea>
                </div>
                <div class="row">
                    <button class="btn btn-primary" type="submit" > Schedule   </button>
                </div>
            </form>
        </div>
    </div>
@endsection
