@extends('layouts.master')

@section('content')

<!--begin::Main-->
<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
    <div class="d-flex flex-column flex-column-fluid">

        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                        Customer Orders
                    </h1>
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('dashboard') }}" class="text-muted text-hover-primary">Home</a>
                        </li>
                        <li class="breadcrumb-item"><span class="bullet bg-gray-400 w-5px h-2px"></span></li>
                        <li class="breadcrumb-item text-muted">Orders</li>
                        <li class="breadcrumb-item text-gray-800">All Orders</li>
                    </ul>
                </div>

                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <a href="{{ route('orders.export') }}" class="btn btn-light-primary">
                        <i class="ki-duotone ki-file-down fs-2"></i> Export to Excel
                    </a>
                </div>
            </div>
        </div>
        <!--end::Toolbar-->

        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div id="kt_app_content_container" class="app-container container-xxl">

                <!--begin::Filter Card-->
                <div class="card card-flush mb-5">
                    <div class="card-header">
                        <h3 class="card-title">Filter Orders</h3>
                    </div>
                    <div class="card-body">
                        <form method="GET" action="{{ route('orders.index') }}">
                            <div class="row g-4">
                                <div class="col-md-3">
                                    <label class="form-label">Status</label>
                                    <select name="status" class="form-select">
                                        <option value="all" {{ request('status', 'all') == 'all' ? 'selected' : '' }}>All</option>
                                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Processing</option>
                                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                                        <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                        <option value="failed" {{ request('status') == 'failed' ? 'selected' : '' }}>Failed</option>
                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">Customer</label>
                                    <input type="text" name="customer" class="form-control" placeholder="Name or Email"
                                           value="{{ request('customer') }}">
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">From Date</label>
                                    <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">To Date</label>
                                    <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
                                </div>
                            </div>

                            <div class="mt-4 text-end">
                                <button type="submit" class="btn btn-primary">Apply Filters</button>
                                <a href="{{ route('orders.index') }}" class="btn btn-light">Reset</a>
                            </div>
                        </form>
                    </div>
                </div>

                <!--begin::Orders Table-->
                <div class="card card-flush">
                    <div class="card-header">
                        <h3 class="card-title">Orders List</h3>
                    </div>

                    <div class="card-body pt-0">
                        <table class="table align-middle table-row-dashed fs-6 gy-5">
                            <thead>
                                <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                    <th>Order ID</th>
                                    <th>Customer</th>
                                    <th>Total</th>
                                    <th>Items</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody class="fw-semibold text-gray-600">
                                @forelse($orders as $order)
                                    <tr>
                                        <td>
                                            <a href="{{ route('orders.show', $order->id) }}" class="text-gray-800 fw-bold">
                                                #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}
                                            </a>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column">
                                                <span class="fw-bold">{{ $order->name ?? $order->user?->name ?? 'Guest' }}</span>
                                                <span class="text-muted small">{{ $order->email }}</span>
                                            </div>
                                        </td>
                                        <td>RM {{ number_format($order->total, 2) }}</td>
                                        <td>{{ $order->items->count() }}</td>
                                        <td>{!! $order->status_badge !!}</td>
                                        <td>{{ $order->created_at->format('d M Y H:i') }}</td>
                                        <td>
                                            <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-light-primary">
                                                View Details
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-10">
                                            <div class="text-muted fs-4">No orders found.</div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        <div class="mt-5">
                            {{ $orders->appends(request()->query())->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
