@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row flex-nowrap">
            @include('partials.customer-sidebar')

            <div class="col py-3">
                <div class="container-fluid">

                    <!-- Header with Toggle Button -->
                    <div
                        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h1 class="h2">Order History</h1>
                        <button class="btn btn-sm btn-danger d-md-none" id="sidebarToggle">
                            <i class="fas fa-bars"></i>
                        </button>
                    </div>

                    <div class="card shadow">
                        <div class="card-body">
                            @if ($orders->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Order #</th>
                                                <th>Date</th>
                                                <th>Items</th>
                                                <th>Total</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($orders as $order)
                                                <tr>
                                                    <td>{{ $order->id }}</td>
                                                    <td>{{ $order->created_at->format('d M Y') }}</td>
                                                    <td>{{ $order->items_count }}</td>
                                                    <td>${{ number_format($order->total_amount, 2) }}</td>
                                                    <td>
                                                        <span class="badge bg-success">
                                                            {{ ucfirst($order->status) }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('customer.orders.show', $order->id) }}"
                                                            class="btn btn-sm btn-outline-primary">
                                                            View Details
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{ $orders->links() }}
                                </div>
                            @else
                                <div class="text-center py-4">
                                    <i class="fas fa-history fa-3x text-muted mb-3"></i>
                                    <h5>No Order History</h5>
                                    <p class="text-muted">You don't have any completed orders yet</p>
                                    <a href="{{ route('customer.bike-builder') }}" class="btn btn-primary">
                                        <i class="fas fa-tools me-2"></i>Build Your Bike
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const sidebarToggle = document.getElementById('sidebarToggle');
                const sidebar = document.getElementById('sidebar');
                const sidebarClose = document.getElementById('sidebarClose');

                if (sidebarToggle && sidebar) {
                    sidebarToggle.addEventListener('click', function() {
                        sidebar.classList.remove('d-none');
                        sidebar.classList.add('d-block', 'show');
                    });
                }

                if (sidebarClose && sidebar) {
                    sidebarClose.addEventListener('click', function() {
                        sidebar.classList.remove('show', 'd-block');
                        sidebar.classList.add('d-none');
                    });
                }
            });
        </script>
    @endpush
@endsection
