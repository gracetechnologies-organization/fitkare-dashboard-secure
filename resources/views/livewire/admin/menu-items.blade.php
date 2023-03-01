<div class="container-xxl flex-grow-1 container-p-y">
    @if (session()->has('error'))
        <div class="bs-toast toast toast-placement-ex m-2 fade bg-danger top-0 end-0 show" role="alert"
            aria-live="assertive" aria-atomic="true" data-delay="2000">
            <div class="toast-header">
                <i class="bx bx-bell me-2"></i>
                <div class="me-auto fw-semibold">Error</div>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                {{ session()->get('error') }}
            </div>
        </div>
    @endif
    @if (session()->has('success'))
        <div class="bs-toast toast toast-placement-ex m-2 fade bg-success top-0 end-0 show" role="alert"
            aria-live="assertive" aria-atomic="true" data-delay="2000">
            <div class="toast-header">
                <i class="bx bx-bell me-2"></i>
                <div class="me-auto fw-semibold">Success</div>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                {{ session()->get('success') }}
            </div>
        </div>
    @endif
    <div wire:ignore.self class="modal fade" id="basicModal" tabindex="-1" aria-labelledby="basicModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="basicModalLabel">Add Menu Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        wire:click="closeModel"></button>
                </div>
                <form wire:submit.prevent="saveMenuItem">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" id="name" wire:model="name" class="form-control"
                                    placeholder="Name" />
                                <small class="text-danger">
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="price" class="form-label">Price</label>
                                <input type="text" id="price" wire:model="price" class="form-control"
                                    placeholder="Price" />
                                <small class="text-danger">
                                    @error('price')
                                        {{ $message }}
                                    @enderror
                                </small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="media" class="form-label">Media</label>
                                <input class="form-control" type="file" wire:model="media">
                                <small class="text-danger">
                                    @error('media')
                                        {{ $message }}
                                    @enderror
                                </small>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                            wire:click="closeModel">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div wire:ignore.self class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel">Edit Menu Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        wire:click="closeModel"></button>
                </div>
                <form wire:submit.prevent="updateMenuItem">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" id="name" wire:model="name" class="form-control"
                                    placeholder="Name" />
                                <small class="text-danger">
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="price" class="form-label">Price</label>
                                <input type="text" id="price" wire:model="price" class="form-control"
                                    placeholder="Email" />
                                <small class="text-danger">
                                    @error('price')
                                        {{ $message }}
                                    @enderror
                                </small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="d-flex align-items-start align-items-sm-center gap-4">
                                <img src="{{ $previous_media }}" class="d-block rounded" height="100"
                                    width="100" id="uploadedAvatar" />
                            </div>
                            <div class="col mb-3">
                                <label for="media" class="form-label">Media</label>
                                <input class="form-control" type="file" wire:model="media">
                                <small class="text-danger">
                                    @error('media')
                                        {{ $message }}
                                    @enderror
                                </small>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                            wire:click="closeModel">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete Menu Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        wire:click="closeModel"></button>
                </div>
                <form wire:submit.prevent="destroyMenuItem">
                    <div class="modal-body">
                        <h4>Are you sure you want to delete this data?</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal"
                            wire:click="closeModel">
                            No
                        </button>
                        <button type="submit" class="btn btn-danger">Yes! Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-between">
        <h4 class="fw-bold py-3 mb-4">Menu Items</h4>
        <button type="button" class="btn btn-primary py-3 mb-4" data-bs-toggle="modal"
            data-bs-target="#basicModal">
            <i class='bx bx-plus-medical'></i>
        </button>
    </div>
    <!-- Basic Bootstrap Table -->
    <div class="card">
        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Added By</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse ($menu_items as $menu_item)
                        <tr>
                            <td>{{ $menu_item->id }}</td>
                            <td>{{ $menu_item->name }}</td>
                            <td>RS {{ $menu_item->price }}</td>
                            <td>
                                <img src="{{ $menu_item->getFirstMediaUrl() }}" class="d-block rounded"
                                    height="100" alt="{{ $menu_item->name }}">
                            </td>
                            <td>{{ $menu_item->inserting_person->name }}</td>
                            <td>
                                <button type="button" class="btn btn-outline-info" data-bs-toggle="modal"
                                    data-bs-target="#updateModal" wire:click="editMenuItem({{ $menu_item->id }})"><i
                                        class='bx bxs-edit-alt'></i></button>
                                <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal"
                                    wire:click="deleteMenuItem({{ $menu_item->id }})"><i
                                        class='bx bxs-trash'></i></button>
                            </td>
                        </tr>
                    @empty
                        <tr class="alert alert-warning alert-dismissible text-center rounded-bottom">
                            <td colspan="5" class="text-center">No Record Found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="row">
            {{ $menu_items->links() }}
        </div>
    </div>
    <!--/ Basic Bootstrap Table -->
</div>
