@extends('layouts.app')

@section('main')
    <div class="my-3 mb-4">
        <h1 class="h3 font-monospace">New Art</h1>
        <p class="font-monospace">
            Create product by filling up the name, description, price and more.
        </p>
    </div>

    <div class="row">
        <div class="col-12 col-lg-6">
            <form>
                <div class="mb-3">
                    <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                    <input name="name" type="text" class="form-control" id="name"
                        placeholder="Your desired product name" required maxlength="255" minlength="3"
                        aria-labelledby="nameHelpBlock" />
                    <div id="nameHelpBlock" class="form-text">
                        The product name must be 3-255 characters long.
                    </div>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
                    <textarea name="description" class="form-control" id="description" rows="5" minlength="3"
                        placeholder="The product description" required></textarea>
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Price <span class="text-danger">*</span></label>
                    <input name="price" type="number" class="form-control" id="price" min="1.00" step="0.01"
                        placeholder="Enter your desired product price" required />
                </div>

                <div class="mt-3 mt-lg-4">
                    <button class="btn btn-primary" type="submit">Submit form</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="/js/products/create.js"></script>
@endpush
