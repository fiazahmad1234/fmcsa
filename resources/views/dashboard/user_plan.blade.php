@extends('layout.dashboard1')

@section('dashboard-content')


    @if($planData)
    <div class="row mt-4">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Active Plan Details</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover align-middle mb-0">
                            <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Email</th>
                                    <th>Plan</th>
                                    <th>Amount</th>
                                    <th>Currency</th>
                                    <th>Status</th>
                                    <th>Start Date</th>
                                    <th>Expiry Date</th>
                                    <th>Remaining Days</th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach($planData as $index => $plan)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $plan['email'] }}</td>
                        <td>{{ $plan['plan'] }}</td>
                        <td>{{ $plan['amount'] }} </td>
                        <td>{{ $plan['currency'] }}</td>
                        <td>{{ $plan['status'] }}</td>
                        <td>{{ $plan['start_date'] }}</td>
                        <td>{{ $plan['expiry_date'] }}</td>
                        <td>{{ $plan['remaining_days'] }}</td>
                    </tr>
                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
        <div class="alert alert-warning mt-3">
            You currently have no active plan.
        </div>
    @endif

@endsection
