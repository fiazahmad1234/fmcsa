@extends('layout.dashboard1')

@section('dashboard-content')
<div class="row justify-content-center">
    <div class="card shadow-sm w-100">
        <div class="card-header bg-primary text-white mt-2">
            <h5 class="mb-0">Subscribers Emails</h5>
        </div>
        <div class="card-body">
            @if($subscribers->isEmpty())
                <p class="text-muted">No subscribers found.</p>
            @else
                <ul class="list-group">
                    @foreach($subscribers as $subscriber)
                        <li class="list-group-item">{{ $subscriber->email }}</li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</div>
@endsection
