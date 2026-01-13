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
                        Order #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}
                    </h1>
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('dashboard') }}" class="text-muted text-hover-primary">Home</a>
                        </li>
                        <li class="breadcrumb-item"><span class="bullet bg-gray-400 w-5px h-2px"></span></li>
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('orders.index') }}" class="text-muted text-hover-primary">Orders</a>
                        </li>
                        <li class="breadcrumb-item text-gray-800">View Order</li>
                    </ul>
                </div>

                <div class="d-flex align-items-center gap-3">
                    <form action="{{ route('orders.status', $order) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <select name="status" class="form-select form-select-solid w-150px" onchange="this.form.submit()">
                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                            <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            <option value="failed" {{ $order->status == 'failed' ? 'selected' : '' }}>Failed</option>
                        </select>
                    </form>
                </div>
            </div>
        </div>
        <!--end::Toolbar-->

        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div id="kt_app_content_container" class="app-container container-xxl">

                <!-- Order Info Card -->
                <div class="card mb-5">
                    <div class="card-header">
                        <h3 class="card-title">Order Information</h3>
                    </div>
                    <div class="card-body">
                        <div class="row g-5">
                            <div class="col-md-6">
                                <h5>Customer Details</h5>
                                <p><strong>Name:</strong> {{ $order->name ?? $order->user?->name ?? 'N/A' }}</p>
                                <p><strong>Email:</strong> {{ $order->email }}</p>
                                <p><strong>Phone:</strong> {{ $order->phone }}</p>
                                @if($order->notes)
                                    <p><strong>Notes:</strong> {{ $order->notes }}</p>
                                @endif
                            </div>

                            <div class="col-md-6">
                                <h5>Order Details</h5>
                                <p><strong>Order ID:</strong> #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</p>
                                <p><strong>Placed on:</strong> {{ $order->created_at->format('d M Y, H:i') }}</p>
                                <p><strong>Status:</strong> {!! $order->status_badge !!}</p>
                                <p><strong>Total:</strong> RM {{ number_format($order->total, 2) }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order Items Table -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Order Items</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Quantity</th>
                                        <th>Unit Price</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order->items as $item)
                                        <tr>
                                            <td>{{ $item->product?->name ?? 'Deleted Product' }}</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td>RM {{ number_format($item->price, 2) }}</td>
                                            <td>RM {{ number_format($item->price * $item->quantity, 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr class="fw-bold">
                                        <td colspan="3" class="text-end">Total:</td>
                                        <td>RM {{ number_format($order->total, 2) }}</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
