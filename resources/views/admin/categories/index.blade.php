@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <div class="card-title">
                <p class="text-primary fw-bold"> {{ __('Catergories list:') }} </p>
            </div>
            <div class="card-toolbar">
                <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#createCategory"
                    aria-controls="offcanvasEnd"> Create </button>
            </div>
        </div>

        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr>
                        <th></th>
                        <th>Title</th>
                        <th>Slug</th>
                        <th>Products count</th>

                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($categories as $category)
                        <tr>
                            <td>
                                <img width="50" src="{{ $category->getFirstMediaUrl('featured') }}" alt="fetured"
                                    class="img rounded responsive ">
                            </td>
                            <td>{{ $category->title }}</td>
                            <td>{{ $category->slug }}</td>
                            <td>{{ $category->products->count() }}</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item edit-category" href=""
                                            data-action="{{ route('admin.categories.update', $category) }}"
                                            data-title="{{ $category->title }}"
                                            data-media-url="{{ $category->getFirstMediaUrl('featured') }}"
                                            data-description="{{ $category->description }}" data-bs-toggle="offcanvas"
                                            data-bs-target="#editCategory">
                                            <i class="bx bx-edit-alt me-2 edit-category"></i>
                                            Edit
                                        </a>
                                        <a class="dropdown-item delete-link" data-bs-target="#deleteModal"
                                            data-bs-toggle="modal"
                                            data-action="{{ route('admin.categories.destroy', $category) }}"><i
                                                class="bx bx-trash me-2"></i>
                                            Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {{ $categories->links() }}
        </div>
    </div>
    @include('admin.categories.create')
    @include('admin.categories.edit-canvas')
@endsection

@section('scripts')
    <script>
        jQuery(document).ready(function() {
            var featuredCreate =document.getElementById("featuredCreate");
            var featuredEdit =document.getElementById("featuredEdit");

            const pondCreate =FilePond.create(featuredCreate);
            const pondEdit =FilePond.create(featuredEdit);
            $('.edit-category').on('click', function() {
                //get Data from it : and affetc it to this Form : 
                $("#editCategoryForm").attr('action', $(this).data('action'));
                $('#editCategoryForm input[name="title"]').val($(this).data('title'));
                $('#editCategoryForm input[name="description"]').val($(this).data('description'));
            });

        });
    </script>
@endsection
