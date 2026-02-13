@extends('layout.dashboard1')

@section('dashboard-content')
<div class="row justify-content-center">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm w-100 ">
        <div class="card-header bg-primary text-white mt-3">
            <h5 class="mb-0">Email Configuration</h5>
        </div>
        <div class="card-body">
            <form action="{{route('email-validate')}}" method="POST">
                @csrf

                <!-- Name -->
                <div class="mb-3">
                    <label class="form-label">Account Name</label>
                    <input type="text" name="name" class="form-control" value="" required>
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="" required>
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Enter new password" required>
                </div>


                <button type="submit" class="btn btn-primary">Save Configuration</button>
            </form>
        </div>
    </div>
</div>
@endsection
