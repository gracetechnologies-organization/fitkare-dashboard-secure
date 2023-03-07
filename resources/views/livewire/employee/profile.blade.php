<div class="container-xxl flex-grow-1 container-p-y">
    <h1 class="py-3 mb-4">Profile</h1>
    <div class="row">
        <div class="card mb-4">
            <h5 class="card-header">Profile Details</h5>
            <!-- Account -->
            <div class="card-body">
                <form id="formAccountSettings" action="{{ route('emp.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="">
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="name" class="form-label">Name</label>
                            <p>{{ $data->name }}</p>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="email" class="form-label">E-mail</label>
                            <p>{{ $data->email }}</p>
                        </div>
                    </div>
                    {{-- <div class="mt-2">
                        <button type="submit" class="btn btn-primary me-2">Save changes</button>
                    </div> --}}
                </form>
            </div>
            <!-- /Account -->
        </div>
        {{-- <div class="card">
            <h5 class="card-header">Change Password</h5>
            <div class="card-body">
                <form id="formAccountSettings" action="{{ route('emp.update_password') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="">
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="password" class="form-label">New Password</label>
                            <input class="form-control" type="password" id="password" name="password"
                                placeholder="New Password" required min="8" />
                            <small class="text-danger">
                                @error('password')
                                    {{ $message }}
                                @enderror
                            </small>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="password_confirmation" class="form-label">Repeat Password</label>
                            <input class="form-control" type="password" name="password_confirmation"
                                id="password_confirmation" placeholder="Repeat Password" min="8" required />
                            <small class="text-danger">
                                @error('password_confirmation')
                                    {{ $message }}
                                @enderror
                            </small>
                        </div>
                    </div>
                    <div class="mt-2">
                        <button type="submit" class="btn btn-primary me-2">Save changes</button>
                    </div>
                </form>
            </div>
        </div> --}}
    </div>
</div>
</div>
