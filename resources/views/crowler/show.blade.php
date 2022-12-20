@extends('layouts.admin')

@section('content')
    <div class="content">
        <div class="card">
            <form action="/crowler" method="post" >
                @csrf 
                @method('post')
                <div class="input-group">
                    <input type="text" name="product" class="form-control bg-light border-0 small" placeholder="Insert link"
                        aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
