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
                    <h5 class="modal-title" id="basicModalLabel">Add Employee</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        wire:click="closeModel"></button>
                </div>
                <form wire:submit.prevent="saveEmployee">
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
                                <label for="email" class="form-label">Email</label>
                                <input type="email" id="email" wire:model="email" class="form-control"
                                    placeholder="Email" />
                                <small class="text-danger">
                                    @error('email')
                                        {{ $message }}
                                    @enderror
                                </small>
                            </div>
                        </div>
                        <div class="mb-3 form-password-toggle">
                            <label class="form-label" for="password">Password</label>
                            <div class="input-group input-group-merge">
                                <input type="password" id="password" class="form-control" wire:model="password"
                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                    aria-describedby="password" required />
                                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                            </div>
                            <small class="text-danger">
                                @error('password')
                                    {{ $message }}
                                @enderror
                            </small>
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
                    <h5 class="modal-title" id="updateModalLabel">Edit Employee</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        wire:click="closeModel"></button>
                </div>
                <form wire:submit.prevent="updateEmployee">
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
                                <label for="email" class="form-label">Email</label>
                                <input type="email" id="email" wire:model="email" class="form-control"
                                    placeholder="Email" />
                                <small class="text-danger">
                                    @error('email')
                                        {{ $message }}
                                    @enderror
                                </small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" id="password" wire:model="password" class="form-control"
                                    placeholder="Password" />
                                <small class="text-danger">
                                    @error('password')
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
                    <h5 class="modal-title" id="deleteModalLabel">Delete Employee</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        wire:click="closeModel"></button>
                </div>
                <form wire:submit.prevent="destroyEmployee">
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
        <h4 class="fw-bold py-3 mb-4">Employees</h4>
        <button type="button" class="btn btn-primary py-3 mb-4" data-bs-toggle="modal"
            data-bs-target="#basicModal">
            <i class='bx bx-plus-medical'></i>
        </button>
    </div>
    <!-- Basic Bootstrap Table -->
    {{-- <div class="card">
        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Joining</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse ($employees as $employee)
                        <tr>
                            <td>{{ $employee->id }}</td>
                            <td>{{ $employee->name }}</td>
                            <td>{{ $employee->email }}</td>
                            <td>{{ $employee->created_at->diffForHumans() }}</td>
                            <td>
                                <button type="button" class="btn btn-outline-info" data-bs-toggle="modal"
                                    data-bs-target="#updateModal" wire:click="editEmployee({{ $employee->id }})"><i
                                        class='bx bxs-edit-alt'></i></button>
                                <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal" wire:click="deleteEmployee({{ $employee->id }})"><i
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
            {{ $employees->links() }}
        </div>
    </div> --}}
    <!--/ Basic Bootstrap Table -->

    <link rel="stylesheet" href="{{ asset('dashboard/css/custom-styles.css') }}">

    <section class="wrapper">
        <div class="container">
            <div class="row">
                <div class="col text-center mb-5">
                    <h1 class="display-4">Bootstrap 4 Cards With Background Image</h1>
                    <p class="lead">Lorem ipsum dolor sit amet at enim hac integer volutpat maecenas pulvinar. </p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-4 mb-4">
                    <div class="card text-white card-has-bg click-col"
                        style="background-image:url('https://source.unsplash.com/600x900/?tech,street');">
                        <img class="card-img d-none" src="https://source.unsplash.com/600x900/?tech,street"
                            alt="Goverment Lorem Ipsum Sit Amet Consectetur dipisi?">
                        <div class="card-img-overlay d-flex flex-column">
                            <div class="card-body">
                                <small class="card-meta mb-2">Thought Leadership</small>
                                <h4 class="card-title mt-0 "><a class="text-white" herf="#">Goverment Lorem
                                        Ipsum Sit Amet Consectetur dipisi?</a></h4>
                                <small><i class="far fa-clock"></i> October 15, 2020</small>
                            </div>
                            <div class="card-footer">
                                <div class="media">
                                    <img class="mr-3 rounded-circle"
                                        src="https://assets.codepen.io/460692/internal/avatars/users/default.png"
                                        alt="Generic placeholder image" style="max-width:50px">
                                    <div class="media-body">
                                        <h6 class="my-0 text-white d-block">Oz Coruhlu</h6>
                                        <small>Director of UI/UX</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4 mb-4">
                    <div class="card text-white card-has-bg click-col"
                        style="background-image:url('https://source.unsplash.com/600x900/?tree,nature');">
                        <img class="card-img d-none" src="https://source.unsplash.com/600x900/?tree,nature"
                            alt="Goverment Lorem Ipsum Sit Amet Consectetur dipisi?">
                        <div class="card-img-overlay d-flex flex-column">
                            <div class="card-body">
                                <small class="card-meta mb-2">Thought Leadership</small>
                                <h4 class="card-title mt-0 "><a class="text-white" herf="#">Goverment Lorem
                                        Ipsum Sit Amet Consectetur dipisi?</a></h4>
                                <small><i class="far fa-clock"></i> October 15, 2020</small>
                            </div>
                            <div class="card-footer">
                                <div class="media">
                                    <img class="mr-3 rounded-circle"
                                        src="https://assets.codepen.io/460692/internal/avatars/users/default.png"
                                        alt="Generic placeholder image" style="max-width:50px">
                                    <div class="media-body">
                                        <h6 class="my-0 text-white d-block">Oz Coruhlu</h6>
                                        <small>Director of UI/UX</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4 mb-4">
                    <div class="card text-white card-has-bg click-col"
                        style="background-image:url('https://source.unsplash.com/600x900/?computer,design');">
                        <img class="card-img d-none" src="https://source.unsplash.com/600x900/?computer,design"
                            alt="Goverment Lorem Ipsum Sit Amet Consectetur dipisi?">
                        <div class="card-img-overlay d-flex flex-column">
                            <div class="card-body">
                                <small class="card-meta mb-2">Thought Leadership</small>
                                <h4 class="card-title mt-0 "><a class="text-white" herf="#">Goverment Lorem
                                        Ipsum Sit Amet Consectetur dipisi?</a></h4>
                                <small><i class="far fa-clock"></i> October 15, 2020</small>
                            </div>
                            <div class="card-footer">
                                <div class="media">
                                    <img class="mr-3 rounded-circle"
                                        src="https://assets.codepen.io/460692/internal/avatars/users/default.png"
                                        alt="Generic placeholder image" style="max-width:50px">
                                    <div class="media-body">
                                        <h6 class="my-0 text-white d-block">Oz Coruhlu</h6>
                                        <small>Director of UI/UX</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-6 col-lg-4 mb-4">
                    <div class="card text-white card-has-bg click-col"
                        style="background-image:url('https://source.unsplash.com/600x900/?tech,street');">
                        <img class="card-img d-none" src="https://source.unsplash.com/600x900/?tech,street"
                            alt="Goverment Lorem Ipsum Sit Amet Consectetur dipisi?">
                        <div class="card-img-overlay d-flex flex-column">
                            <div class="card-body">
                                <small class="card-meta mb-2">Thought Leadership</small>
                                <h4 class="card-title mt-0 "><a class="text-white" herf="#">Goverment Lorem
                                        Ipsum Sit Amet Consectetur dipisi?</a></h4>
                                <small><i class="far fa-clock"></i> October 15, 2020</small>
                            </div>
                            <div class="card-footer">
                                <div class="media">
                                    <img class="mr-3 rounded-circle"
                                        src="https://assets.codepen.io/460692/internal/avatars/users/default.png"
                                        alt="Generic placeholder image" style="max-width:50px">
                                    <div class="media-body">
                                        <h6 class="my-0 text-white d-block">Oz Coruhlu</h6>
                                        <small>Director of UI/UX</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4 mb-4">
                    <div class="card text-white card-has-bg click-col"
                        style="background-image:url('https://source.unsplash.com/600x900/?tree,nature');">
                        <img class="card-img d-none" src="https://source.unsplash.com/600x900/?tree,nature"
                            alt="Goverment Lorem Ipsum Sit Amet Consectetur dipisi?">
                        <div class="card-img-overlay d-flex flex-column">
                            <div class="card-body">
                                <small class="card-meta mb-2">Thought Leadership</small>
                                <h4 class="card-title mt-0 "><a class="text-white" herf="#">Goverment Lorem
                                        Ipsum Sit Amet Consectetur dipisi?</a></h4>
                                <small><i class="far fa-clock"></i> October 15, 2020</small>
                            </div>
                            <div class="card-footer">
                                <div class="media">
                                    <img class="mr-3 rounded-circle"
                                        src="https://assets.codepen.io/460692/internal/avatars/users/default.png"
                                        alt="Generic placeholder image" style="max-width:50px">
                                    <div class="media-body">
                                        <h6 class="my-0 text-white d-block">Oz Coruhlu</h6>
                                        <small>Director of UI/UX</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4 mb-4">
                    <div class="card text-white card-has-bg click-col"
                        style="background-image:url('https://source.unsplash.com/600x900/?computer,design');">
                        <img class="card-img d-none" src="https://source.unsplash.com/600x900/?computer,design"
                            alt="Goverment Lorem Ipsum Sit Amet Consectetur dipisi?">
                        <div class="card-img-overlay d-flex flex-column">
                            <div class="card-body">
                                <small class="card-meta mb-2">Thought Leadership</small>
                                <h4 class="card-title mt-0 "><a class="text-white" herf="#">Goverment Lorem
                                        Ipsum Sit Amet Consectetur dipisi?</a></h4>
                                <small><i class="far fa-clock"></i> October 15, 2020</small>
                            </div>
                            <div class="card-footer">
                                <div class="media">
                                    <img class="mr-3 rounded-circle"
                                        src="https://assets.codepen.io/460692/internal/avatars/users/default.png"
                                        alt="Generic placeholder image" style="max-width:50px">
                                    <div class="media-body">
                                        <h6 class="my-0 text-white d-block">Oz Coruhlu</h6>
                                        <small>Director of UI/UX</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>

</div>
