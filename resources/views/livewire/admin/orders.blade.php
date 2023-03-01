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
                    <h5 class="modal-title" id="basicModalLabel">Add Order</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        wire:click="closeModel"></button>
                </div>
                <form wire:submit.prevent="saveOrder">
                    <div class="modal-body">
                        <div class="row mb-3 border rounded p-2">
                            <h5>Menu Items</h5>
                            <small class="text-danger">
                                @error('check_prod')
                                    {{ $message }}
                                @enderror
                            </small>
                            @foreach ($menu_items as $menu_item)
                                <div class="form-check col-md-3 mb-1">
                                    <input type="checkbox" class="form-check-input"
                                        wire:click="add({{ $i }},{{ $menu_item->id }})"
                                        id="{{ $menu_item->id }}" @if (!is_null($products) && in_array($menu_item->id, $products)) checked @endif
                                        @if (!is_null($products) && in_array($menu_item->id, $products)) disabled @endif>
                                    <label class="form-check-label" for="{{ $menu_item->id }}"> {{ $menu_item->name }}
                                        (RS.{{ $menu_item->price }})
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        @if (!is_null($inputs))
                            @foreach ($inputs as $key => $value)
                                <div class="row mb-3">
                                    <div class="col-md-5 mb-1">
                                        <div class="form-group">
                                            <input type="text" class="form-control"
                                                wire:model="product.{{ $value }}" placeholder="Product" disabled>
                                            <small class="text-danger">
                                                @error('product.' . $value)
                                                    {{ $message }}
                                                @enderror
                                            </small>
                                        </div>
                                    </div>
                                    <div class="col-md-5 mb-1">
                                        <div class="form-group">
                                            <input type="number" class="form-control"
                                                wire:model="qty.{{ $value }}" placeholder="Quantity">
                                            @error('qty.' . $value)
                                                <span class="text-danger error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-2 mb-1">
                                        <button class="btn btn-danger"
                                            wire:click.prevent="remove({{ $key }})">remove</button>
                                    </div>
                                </div>
                            @endforeach
                        @endif
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
    {{-- <div wire:ignore.self class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel"
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
    </div> --}}
    <div wire:ignore.self class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel">Order detail</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        wire:click="closeModel"></button>
                </div>
                <div class="modal-body">
                    @if (!is_null($order_detail) && !empty($order_detail))
                        <div class="d-flex justify-content-around mb-4">
                            <b>Order No # {{ $order_detail->id }}</b>
                            <b>Time : {{ $order_detail->created_at->diffForHumans() }}</b>
                        </div>
                        <table class="table table-hover mb-4">
                            <thead>
                                <tr>
                                    <th>Order item</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Sub Total</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach ($order_detail->order_items as $item)
                                    @php
                                        $single_item = \App\Models\Product::where('id', '=', $item->prod_id)->first();                                        
                                    @endphp
                                    <tr>
                                        <td>{{ $single_item->name }}</td>
                                        <td>Rs. {{ $single_item->price }}</td>
                                        <td>{{ $item->qty }}</td>
                                        <td>Rs. {{ $single_item->price * $item->qty }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="text-end mb-4">
                            <b>Grand Total : Rs. {{ $order_detail->total_bill }}
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                        wire:click="closeModel">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete Order</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        wire:click="closeModel"></button>
                </div>
                <form wire:submit.prevent="destroyOrder">
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
        <h4 class="fw-bold py-3 mb-4">Orders</h4>
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
                        <th>Bill</th>
                        <th>Added by</th>
                        <th>Added at</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse ($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>RS. {{ $order->total_bill }}</td>
                            <td>{{ $order->inserting_person->name }}</td>
                            <td>{{ $order->created_at->diffForHumans() }}</td>
                            <td>
                                <button type="button" class="btn btn-outline-info" data-bs-toggle="modal"
                                    data-bs-target="#updateModal" wire:click="editOrder({{ $order->id }})"><i
                                        class='bx bx-door-open'></i></button>
                                <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal" wire:click="deleteOrder({{ $order->id }})"><i
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
            {{ $orders->links() }}
        </div>
    </div>
    <!--/ Basic Bootstrap Table -->
</div>
