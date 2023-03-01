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
    {{-- ************************************ Add Model ************************************ --}}
    <div wire:ignore.self class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Add Exercise</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        wire:click="resetModal"></button>
                </div>
                <form wire:submit.prevent="add" method="POST">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col mb-3">
                                <label for="ex_name" class="form-label">Exercise*</label>
                                <input type="text" placeholder="Enter exercise name" wire:model.lazy="ex_name"
                                    class="form-control">
                                <small class="text-danger">
                                    @error('ex_name')
                                        {{ $message }}
                                    @enderror
                                </small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="ex_description" class="form-label">Description*</label>
                                <textarea placeholder="Enter description here..." rows="3" wire:model.lazy="ex_description" class="form-control"></textarea>
                                <small class="text-danger">
                                    @error('ex_description')
                                        {{ $message }}
                                    @enderror
                                </small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="ex_duration" class="form-label">Duration*</label>
                                <input type="number" placeholder="Enter duration" wire:model.lazy="ex_duration"
                                    class="form-control">
                                <small class="text-danger">
                                    @error('ex_duration')
                                        {{ $message }}
                                    @enderror
                                </small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="ex_thumbnail" class="form-label">Thumbnail*</label>
                                <input type="file"
                                    accept="image/png, image/jpeg, image/jpg, image/bmp, image/gif, image/svg, image/webp"
                                    wire:model.lazy="ex_thumbnail" class="form-control">
                                <small class="text-danger">
                                    @error('ex_thumbnail')
                                        {{ $message }}
                                    @enderror
                                </small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="ex_video" class="form-label">Video*</label>
                                <input type="file" accept="video/*" wire:model.lazy="ex_video" class="form-control">
                                <small class="text-danger">
                                    @error('ex_video')
                                        {{ $message }}
                                    @enderror
                                </small>
                            </div>
                        </div>
                        <div class="row">
                            <label for="ex_category_id" class="form-label">Meta Info</label>
                            @foreach ($meta_info as $single_index => $value)
                                <?php print_r($single_index); ?>
                                <div class="input-group mb-3">
                                    <select wire:model.lazy="meta_info.{{ $single_index }}.ex_category_id"
                                        class="form-select col-sm-12">
                                        <option selected value="">Category*</option>
                                        @forelse ($categories as $single_category)
                                            <option value="{{ $single_category->id }}">
                                                {{ $single_category->name }}
                                            </option>
                                        @empty
                                            <option value="" disabled>No Data</option>
                                        @endforelse
                                    </select>
                                    <select wire:model.lazy="meta_info.{{ $single_index }}.ex_level_id"
                                        class="form-select">
                                        <option selected value="">Level</option>
                                        @forelse($levels as $single_level)
                                            <option value="{{ $single_level->id }}">
                                                {{ $single_level->name }}
                                            </option>
                                        @empty
                                            <option value="" disabled>No Data</option>
                                        @endforelse
                                    </select>
                                    <select wire:model.lazy="meta_info.{{ $single_index }}.ex_program_id"
                                        class="form-select">
                                        <option selected value="">Program</option>
                                        @forelse($programs as $single_program)
                                            <option value="{{ $single_program->id }}">
                                                {{ $single_program->name }}
                                            </option>
                                        @empty
                                            <option value="" disabled>No Data</option>
                                        @endforelse
                                    </select>
                                    <select wire:model.lazy="meta_info.{{ $single_index }}.ex_from_day"
                                        class="form-select">
                                        <option selected value="">From day</option>
                                        @for ($from_day = 1; $from_day <= 24; $from_day++)
                                            <option value="{{ $from_day }}">{{ $from_day }}</option>
                                        @endfor
                                    </select>
                                    <select wire:model.lazy="meta_info.{{ $single_index }}.ex_till_day"
                                        class="form-select">
                                        <option selected value="">Till day</option>
                                        @for ($from_day = 1; $from_day <= 24; $from_day++)
                                            <option value="{{ $from_day }}">{{ $from_day }}</option>
                                        @endfor
                                    </select>
                                    <button type="button" wire:click="addMetaInfoRow({{ $single_index }})"
                                        class="btn btn-secondary">
                                        <i class='bx bxs-plus-circle display-5'></i>
                                    </button>
                                </div>
                            @endforeach
                            <small class="text-danger">
                                @error('meta_info.*.ex_category_id')
                                    {{ $message }}
                                @enderror
                            </small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                            wire:click="resetModal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary" wire:loading.class="btn-dark"
                            wire:loading.class.remove="btn-primary" wire:loading.attr="disabled">
                            <span wire:loading.remove>Add</span>
                            <span wire:loading>
                                <span class="spinner-border spinner-border-sm" role="status"
                                    aria-hidden="true"></span>
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- ************************************ Edit Exercise Model ************************************ --}}
    <div wire:ignore.self class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Exercise</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        wire:click="resetModal"></button>
                </div>
                <form wire:submit.prevent="edit" method="POST">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col mb-3">
                                <label for="ex_name" class="form-label">Exercise*</label>
                                <input type="text" placeholder="Enter exercise name" wire:model.lazy="ex_name"
                                    class="form-control">
                                <small class="text-danger">
                                    @error('ex_name')
                                        {{ $message }}
                                    @enderror
                                </small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="ex_description" class="form-label">Description*</label>
                                <textarea placeholder="Enter description here..." rows="3" wire:model.lazy="ex_description"
                                    class="form-control"></textarea>
                                <small class="text-danger">
                                    @error('ex_description')
                                        {{ $message }}
                                    @enderror
                                </small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="ex_duration" class="form-label">Duration*</label>
                                <input type="number" placeholder="Enter duration" wire:model.lazy="ex_duration"
                                    class="form-control">
                                <small class="text-danger">
                                    @error('ex_duration')
                                        {{ $message }}
                                    @enderror
                                </small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="ex_thumbnail" class="form-label">Thumbnail*</label>
                                <input type="file"
                                    accept="image/png, image/jpeg, image/jpg, image/bmp, image/gif, image/svg, image/webp"
                                    wire:model.lazy="ex_thumbnail" class="form-control">
                                <small class="text-danger">
                                    @error('ex_thumbnail')
                                        {{ $message }}
                                    @enderror
                                </small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="ex_video" class="form-label">Video*</label>
                                <input type="file" accept="video/*" wire:model.lazy="ex_video"
                                    class="form-control">
                                <small class="text-danger">
                                    @error('ex_video')
                                        {{ $message }}
                                    @enderror
                                </small>
                            </div>
                        </div>
                        <div class="row">
                            <label for="ex_category_id" class="form-label">Meta Info</label>
                            @foreach ($meta_info as $single_index => $value)
                                <?php print_r($single_index); ?>
                                <div class="input-group mb-3">
                                    <select wire:model.lazy="meta_info.{{ $single_index }}.ex_category_id"
                                        class="form-select col-sm-12">
                                        <option selected value="">Category*</option>
                                        @forelse ($categories as $single_category)
                                            <option value="{{ $single_category->id }}">
                                                {{ $single_category->name }}
                                            </option>
                                        @empty
                                            <option value="" disabled>No Data</option>
                                        @endforelse
                                    </select>
                                    <select wire:model.lazy="meta_info.{{ $single_index }}.ex_level_id"
                                        class="form-select">
                                        <option selected value="">Level</option>
                                        @forelse($levels as $single_level)
                                            <option value="{{ $single_level->id }}">
                                                {{ $single_level->name }}
                                            </option>
                                        @empty
                                            <option value="" disabled>No Data</option>
                                        @endforelse
                                    </select>
                                    <select wire:model.lazy="meta_info.{{ $single_index }}.ex_program_id"
                                        class="form-select">
                                        <option selected value="">Program</option>
                                        @forelse($programs as $single_program)
                                            <option value="{{ $single_program->id }}">
                                                {{ $single_program->name }}
                                            </option>
                                        @empty
                                            <option value="" disabled>No Data</option>
                                        @endforelse
                                    </select>
                                    <select wire:model.lazy="meta_info.{{ $single_index }}.ex_from_day"
                                        class="form-select">
                                        <option selected value="">From day</option>
                                        @for ($from_day = 1; $from_day <= 24; $from_day++)
                                            <option value="{{ $from_day }}">{{ $from_day }}</option>
                                        @endfor
                                    </select>
                                    <select wire:model.lazy="meta_info.{{ $single_index }}.ex_till_day"
                                        class="form-select">
                                        <option selected value="">Till day</option>
                                        @for ($from_day = 1; $from_day <= 24; $from_day++)
                                            <option value="{{ $from_day }}">{{ $from_day }}</option>
                                        @endfor
                                    </select>
                                    <button type="button" wire:click="addMetaInfoRow({{ $single_index }})"
                                        class="btn btn-secondary">
                                        <i class='bx bxs-plus-circle display-5'></i>
                                    </button>
                                </div>
                            @endforeach
                            <small class="text-danger">
                                @error('meta_info.*.ex_category_id')
                                    {{ $message }}
                                @enderror
                            </small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                            wire:click="resetModal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary" wire:loading.class="btn-dark"
                            wire:loading.class.remove="btn-primary" wire:loading.attr="disabled">
                            <span wire:loading.remove>Add</span>
                            <span wire:loading>
                                <span class="spinner-border spinner-border-sm" role="status"
                                    aria-hidden="true"></span>
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- ************************************ Delete Exercise Model ************************************ --}}
    <div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="deleteModalLabel">Delete Exercise</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        wire:click="resetModal"></button>
                </div>
                <form wire:submit.prevent="destroy">
                    <div class="modal-body">
                        <p class="fs-4 text-danger">
                            Are you sure you want to delete this data? <br>
                            You can't undo this action!!
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-success" data-bs-dismiss="modal">
                            No
                        </button>
                        <button type="submit" class="btn btn-danger" wire:loading.class="btn-dark"
                            wire:loading.class.remove="btn-danger" wire:loading.attr="disabled">
                            <span wire:loading.remove>Delete</span>
                            <span wire:loading>
                                <span class="spinner-border spinner-border-sm" role="status"
                                    aria-hidden="true"></span>
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-6 col-md-6">
            <h1 class="fw-bold py-3 my-1">{{ config('app.name') }} Exercises</h1>
        </div>
        <div class="col-12 col-sm-6 col-md-5">
            <div class="input-group my-3">
                <input type="text" wire:model.debounce.500ms="search" class="form-control py-3"
                    placeholder="Search here...">
                {{-- <button class="btn btn-primary" type="button"><i class='bx bx-search-alt'></i></button> --}}
            </div>
        </div>
        <div class="col-12 col-md-1">
            <button type="button" class="btn btn-primary my-3 py-3 w-100" data-bs-toggle="modal"
                data-bs-target="#addModal" wire:click="resetModal">
                <i class='bx bx-plus-medical'></i>
            </button>
        </div>
    </div>
    <!-- Basic Bootstrap Table -->
    <div class="card">
        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="col-md-1">ID</th>
                        <th class="col-md-2">Thumbnail</th>
                        <th class="col-md-2">Exercise</th>
                        <th class="col-md-2">Description</th>
                        <th class="col-md-1">Duration</th>
                        <th class="col-md-1">Video</th>
                        <th>Category</th>
                        <th>Level</th>
                        <th>Program</th>
                        <th class="col-md-1">Days</th>
                        <th class="col-md-1">Active</th>
                        <th class="col-md-1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Action</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse ($data as $single_index)
                        <tr>
                            <td>{{ $single_index->id }}</td>
                            <td>
                                <img src="{{ asset('storage/images/' . $single_index->ex_thumbnail_url) }}"
                                    width="120px">
                            </td>
                            <td>{{ $single_index->ex_name }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($single_index->ex_description, 40, '...') }}</td>
                            <td>{{ $single_index->ex_duration }}</td>
                            <td>
                                <a href="{{ asset('storage/videos/' . $single_index->ex_video_url) }}"
                                    target="_blank"><i class='bx bx-play bx-lg'></i></a>
                            </td>
                            <td>Category</td>
                            <td>Level</td>
                            <td>Program</td>
                            <td>1-24</td>
                            <td>{{ $single_index->is_active }}</td>
                            <td>
                                <button type="button" class="btn btn-outline-info" data-bs-toggle="modal"
                                    data-bs-target="#editModal"
                                    wire:click="renderEditModal({{ $single_index->id }})">
                                    <i class='bx bxs-edit-alt'></i>
                                </button>
                                <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal"
                                    wire:click="renderDeleteModal({{ $single_index->id }})">
                                    <i class='bx bxs-trash'></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr class="alert alert-warning alert-dismissible text-center rounded-bottom">
                            <td colspan="8" class="text-center">No Record Found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="row">
            {{ $data->links() }}
        </div>
    </div>
    <!--/ Basic Bootstrap Table -->
</div>
