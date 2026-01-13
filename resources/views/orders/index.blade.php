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

                <!-- Filters (keep your existing filter card if you have one) -->

                <!-- Orders Table -->
                <div class="card card-flush">
                    <div class="card-header">
                        <h3 class="card-title">Orders List</h3>
                    </div>

                    <div class="card-body pt-0">
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_orders_table">
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
                                    <tr data-order-id="{{ $order->id }}">
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
                                        <td class="status-cell" data-current-status="{{ $order->status }}">
                                            {!! $order->status_badge !!}
                                        </td>
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



<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const csrfToken = '{{ csrf_token() }}';

    // Handle status change
    document.querySelectorAll('.status-dropdown').forEach(select => {
        select.addEventListener('change', async function () {
            const orderId = this.dataset.orderId;
            const newStatus = this.value;
            const cell = this.closest('.status-cell');

            // Show loading state
            cell.innerHTML = '<span class="badge badge-light-secondary">Updating...</span>';

            try {
                const response = await fetch(`/orders/${orderId}/status`, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ status: newStatus })
                });

                const data = await response.json();

                if (data.success) {
                    // Update badge in table
                    cell.innerHTML = getStatusBadge(newStatus);

                    Swal.fire({
                        icon: 'success',
                        title: 'Updated!',
                        text: 'Order status changed to ' + newStatus,
                        timer: 2000,
                        showConfirmButton: false,
                        toast: true,
                        position: 'top-end'
                    });
                } else {
                    cell.innerHTML = getStatusBadge(this.dataset.currentStatus); // Revert
                    Swal.fire('Error', data.message || 'Failed to update status', 'error');
                }
            } catch (error) {
                cell.innerHTML = getStatusBadge(this.dataset.currentStatus);
                Swal.fire('Error', 'Something went wrong. Please try again.', 'error');
            }
        });
    });

    // Helper to generate status badge HTML
    function getStatusBadge(status) {
        const badges = {
            pending: 'warning',
            processing: 'info',
            completed: 'success',
            cancelled: 'danger',
            failed: 'danger'
        };
        const color = badges[status] || 'secondary';
        return `<span class="badge badge-light-${color}">${status.charAt(0).toUpperCase() + status.slice(1)}</span>`;
    }
});
</script>
@endsection
