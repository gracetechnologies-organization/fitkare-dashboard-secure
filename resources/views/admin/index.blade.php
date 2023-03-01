@extends('admin.layout.main')
@push('head')
@endpush
@section('content')
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">Dashboard</h4>
        <!-- Basic Bootstrap Table -->
        <div class="row">
            <div class="card col-lg-3 col-md-3 order-1 m-2">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <i class='bx bx-lg bx-bar-chart-alt-2 text-success'></i>
                        </div>
                        <div>
                            <span class="fw-semibold d-block mb-1">Popular in people</span>
                            {{-- <h3 class="card-title mb-2">{{ $mostSoldProduct->name }}</h3> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="card col-lg-3 col-md-3 order-1 m-2">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <i class='bx bx-lg bx-dollar-circle text-success'></i>
                        </div>
                        <div>
                            <span class="fw-semibold d-block mb-1">Sale of this month</span>
                            <h3 class="card-title mb-2">Rs.{{ $totalSelling }}</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card col-lg-3 col-md-3 order-1 m-2">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <i class='bx bx-lg bx-dollar-circle text-success'></i>
                        </div>
                        <div>
                            <span class="fw-semibold d-block mb-1">Total Sale</span>
                            <h3 class="card-title mb-2">Rs.{{ $totalSale }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Basic Bootstrap Table -->
    </div>
    <!-- / Content -->
@endsection
@push('footer')
@endpush
