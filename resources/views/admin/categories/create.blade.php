<div class="offcanvas offcanvas-end" tabindex="-1" id="createCategory" aria-labelledby="offcanvasEndLabel">
    <div class="offcanvas-header">
        <h5 id="offcanvasEndLabel" class="offcanvas-title">Create new category</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body  mx-0 flex-grow-0">
        <form action="{{ route('admin.categories.store') }}" method="post" enctype="multipart/form-data">
            @csrf @method('post')
            <div class="row">
                <div class="row-md-12">
                    <div class="mb-3">
                      <label for="featuredCreate" class="form-label">Main Image</label>
                      <input type="file" class="form-control FilePond" name="featured" id="featuredCreate" placeholder="" aria-describedby="featuredImageHelp">
                      <div id="featuredImageHelp" class="form-text">Upload for main image</div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" name="title" id="title"
                            aria-describedby="helpTitle" placeholder="Category title">
                        <small id="helpTitle" class="form-text text-muted">Category name</small>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" name="description" id="description" rows="2"></textarea>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mb-2 d-grid w-100">Create</button>
            <button type="button" class="btn btn-outline-secondary d-grid w-100" data-bs-dismiss="offcanvas">
                Cancel
            </button>
        </form>
    </div>
</div>
