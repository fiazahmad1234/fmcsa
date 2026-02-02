@extends('layout.dashboard1')

@section('dashboard-content')
<div class="row g-3">
       <div class="col-md-3">
        <div class="card p-3 text-center h-100 shadow-sm">
            <i class="bi bi-inbox-fill fs-1 text-primary"></i>
            <h5 class="mt-2">Fetch Emails</h5>
            <p class="small text-muted">Pull emails from your inbox.</p>
            <a href="" class="btn btn-primary btn-sm mt-2">Go</a>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-3 text-center h-100 shadow-sm">
            <i class="bi bi-send-fill fs-1 text-success"></i>
            <h5 class="mt-2">Send Emails</h5>
            <p class="small text-muted">Compose and send emails.</p>
            <a href="" class="btn btn-success btn-sm mt-2">Go</a>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-3 text-center h-100 shadow-sm">
            <i class="bi bi-gear-fill fs-1 text-warning"></i>
            <h5 class="mt-2">Email Configuration</h5>
            <p class="small text-muted">Manage SMTP & IMAP settings.</p>
            <a href="" class="btn btn-warning btn-sm mt-2 text-white">Go</a>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-3 text-center h-100 shadow-sm">
            <i class="bi bi-clock-history fs-1 text-danger"></i>
            <h5 class="mt-2">Auto Email Sending</h5>
            <p class="small text-muted">Send emails automatically.</p>
            <a href="" class="btn btn-danger btn-sm mt-2">Go</a>
        </div>
    </div>
</div>
@endsection
