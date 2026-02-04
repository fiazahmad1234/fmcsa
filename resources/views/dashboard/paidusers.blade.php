@extends('layout.dashboard1')

@section('dashboard-content')
<div class="row g-3 mb-4">
    <!-- Total Users Card -->
    <div class="col-md-4 col-12">
        <div class="card p-3 text-center shadow-sm bg-primary text-white h-100">
            <i class="bi bi-people-fill fs-1"></i>
            <h5 class="mt-2">Total Users</h5>
            <p class="small">{{ $totalUsers ?? 0 }}</p>
        </div>
    </div>

    <!-- Total Amount Card -->
    <div class="col-md-4 col-12">
        <div class="card p-3 text-center shadow-sm bg-success text-white h-100">
            <i class="bi bi-currency-dollar fs-1"></i>
            <h5 class="mt-2">Total Amount</h5>
            <p class="small">${{ number_format($totalAmount ?? 0, 2) }}</p>
        </div>
    </div>

    <!-- Total Payments Card -->
    <div class="col-md-4 col-12">
        <div class="card p-3 text-center shadow-sm bg-warning text-dark h-100">
            <i class="bi bi-card-checklist fs-1"></i>
            <h5 class="mt-2">Total Payments</h5>
            <p class="small">{{ $totalPayments ?? 0 }}</p>
        </div>
    </div>
</div>

<!-- Payments Table -->
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Payments Overview</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Payment ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Amount</th>
                                <th>Plan</th>
                                <th>Currency</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($payments as $payment)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $payment->payment_id }}</td>
                                <td>{{ $payment->name }}</td>
                                <td>{{ $payment->email }}</td>
                                <td>{{ $payment->phone ?? '-' }}</td>
                                <td>{{ $payment->address ?? '-' }}</td>
                                <td>${{ number_format($payment->amount, 2) }}</td>
                                <td>{{ $payment->plan ?? '-' }}</td>
                                <td>{{ strtoupper($payment->currency) }}</td>
                                <td>
                                    @php
                                        $statusClass = 'secondary';
                                        if($payment->status == 'success') $statusClass = 'success';
                                        elseif($payment->status == 'pending') $statusClass = 'warning';
                                        elseif($payment->status == 'failed') $statusClass = 'danger';
                                    @endphp
                                    <span class="badge bg-{{ $statusClass }}">
                                        {{ ucfirst($payment->status) }}
                                    </span>
                                </td>
                                <td>{{ $payment->created_at ? $payment->created_at->format('d M Y, h:i A') : '-' }}</td>
                                <td>{{ $payment->updated_at ? $payment->updated_at->format('d M Y, h:i A') : '-' }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="12" class="text-center">No payments found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Optional Pagination -->
                {{-- <div class="mt-3 px-3">
                    {{ $payments->links('pagination::bootstrap-5') }}
                </div> --}}
            </div>
        </div>
    </div>
</div>
@endsection
