@extends('layouts.app')

@section('main')
    <div class="my-3 mb-4">
        <h1 class="h3 font-monospace">Product Lists</h1>
        <p class="font-monospace">NextColor products, name, description, price and more.</p>
    </div>

    <div class="table-responsive" style="min-height: 65vh">
        <table id="products-table" class="table table-hover caption-top">
            <caption></caption>
            <thead>
                <tr class="font-monospace">
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Price</th>
                    <th scope="col">Created at</th>
                    <th scope="col">Updated at</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                {{-- table loading --}}
                <tr>
                    <td colspan="7">
                        <div class="text-center my-5">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                    </td>
                </tr>
                {{-- end table loading --}}

                {{-- data here --}}
            </tbody>
        </table>
    </div>

    <div id="products-table-pagination" class="btn-group font-monospace my-3" role="group"
        aria-label="product list pagination">
        {{-- pagination here --}}
    </div>
@endsection

@section('modals')
    {{-- delete modal --}}
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body p-4 px-5">
                    <h4 id="modal-delete-title" class="font-monospace text-danger mt-3">
                        Delete this item?
                    </h4>
                    <p class="mb-4">
                        Please review the item before you press the delete button. The action cannot be
                        undone.
                    </p>
                    <div class="d-flex justify-content-end">
                        <div>
                            <button id="modal-delete-confirm" type="button" class="btn btn-danger font-monospace">
                                Delete
                            </button>
                            <button type="button" class="btn btn-secondary font-monospace" data-bs-dismiss="modal">
                                Close
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end delete modal --}}
@endsection

@push('scripts')
    <script src="/js/products/index.js"></script>
@endpush