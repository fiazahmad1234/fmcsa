@php
    function clean($v) {
        return trim(html_entity_decode(strip_tags($v)));
    }
@endphp
@extends('layout.app')
@section('content')

<!DOCTYPE html>
<html>
<head>
    <title>FMCSA Carrier Lookup</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<style>
    body { 
        background-color: #f0f2f5; 
        font-family: 'Plus Jakarta Sans', sans-serif; 
    }

    /* Attractive Header with Gradient */
    .results-header {
        background: linear-gradient(135deg, #1e293b 0%, #3b82f6 100%);
        padding: 2.5rem 2rem;
        border-radius: 16px 16px 0 0;
        color: white;
        box-shadow: 0 10px 25px -5px rgba(59, 130, 246, 0.3);
    }

    .results-header h4 {
        font-weight: 700;
        letter-spacing: -0.5px;
        margin-bottom: 5px;
    }

    .results-header p {
        opacity: 0.8;
        font-size: 0.9rem;
        margin-bottom: 0;
    }

    /* Table Container Styling */
    .table-card {
        background: #ffffff;
        border-radius: 0 0 16px 16px;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05);
        border: none;
        margin-bottom: 3rem;
    }

    /* Professional Table Headings */
    .table thead th {
        background-color: #f8fafc;
        color: #ffffff;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.05rem;
        padding: 1.25rem 1rem;
        border-bottom: 2px solid #e2e8f0;
    }

    .table tbody td {
        padding: 1.25rem 1rem;
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
        font-size: 0.9rem;
    }

    /* Status Pill Badges */
    .status-pill {
        padding: 0.4rem 1rem;
        border-radius: 8px;
        font-size: 0.75rem;
        font-weight: 700;
    }
    .status-active { background: #dcfce7; color: #15803d; }
    .status-inactive { background: #fee2e2; color: #b91c1c; }

    /* Hover effect */
    .table-hover tbody tr:hover {
        background-color: #f8fbff;
        transition: all 0.2s ease;
    }

    .company-title {
        color: #0f172a;
        font-weight: 700;
        font-size: 1rem;
    }
    .table thead th {
        background-color: #157347;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.05rem;
        padding: 1.25rem 1rem;
        border-bottom: 2px solid #e2e8f0;
    }.card.shadow-lg.border-0 {
  margin-top: 120px !important;
}
</style>
</head>
<body>
<div class="container-fluaid m-5">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-primary text-white text-center">
            <h4 class="mb-0">FMCSA Carrier Lookup</h4>
            <small>Enter DOT numbers to fetch data</small>
        </div>
        <div class="card-body">
      <form method="POST" action="{{ route('fmcsa.fetch') }}">
    @csrf
    <div class="row g-3 align-items-end">
        <!-- Start DOT -->
        <div class="col-md-5">
            <label class="form-label fw-bold text-secondary">Start DOT #</label>
            <div class="input-group shadow-sm">
                <span class="input-group-text bg-light border-2 border-end-0 text-muted">
                    <i class="bi bi-play-circle"></i>
                </span>
                <input type="number" name="start_dot" class="form-control border-start-0" placeholder="1077300" required>
            </div>
        </div>

        <!-- End DOT -->
        <div class="col-md-5">
            <label class="form-label fw-bold text-secondary">End DOT #</label>
            <div class="input-group shadow-sm">
                <span class="input-group-text bg-light border-2 border-end-0 text-muted">
                    <i class="bi bi-stop-circle"></i>
                </span>
                <input type="number" name="end_dot" class="form-control border-start-0" placeholder="1077400" required>
            </div>
        </div>

        <!-- Fetch Button -->
        <div class="col-md-2 d-grid">
            <button type="submit" class="btn btn-primary btn-lg shadow-sm p-1">
                <i class="bi bi-lightning-charge-fill "></i>FETCH DATA
            </button>
        </div>
    </div>
</form>


    </div>
        </div>
    
@if(isset($allData) && count($allData) > 0)
<div class="container-fluid py-4 px-0">
    <div class=" card card-custom border-none">
         <div class="results-header d-flex justify-content-between align-items-center">
        <div>
            <h4><i class="bi bi-truck-flatbed me-2"></i> Carrier Analytics Data</h4>
            <p>Real-time FMCSA snapshot for your requested DOT/MC numbers</p>
        </div>
        <div class="text-end">
            <span class="badge bg-white text-primary px-3 py-2 rounded-3 fw-bold shadow-sm">
                {{ count($allData) }} Records
            </span>
        </div>
    </div>
        <div class="table-responsive">
            <table class="table table-striped table-border table-hover border align-middle mb-0 ">
                <thead >
                    <tr>
                        <th class="ps-3">Company</th>
                        <th>Address(county&state)</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Year</th>
                        <th>DOT</th>
                        <th>MC</th>
                        <th>Units</th>
                        <th>Driver</th>
                        <th>Status</th>
                        <th>Type</th>
                        <th>Source</th>
                        <th class="pe-3">Error</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($allData as $data)
                     @php
        $status = strtoupper($data['Status'] ?? '');
    @endphp

    @if($status === 'ACTIVE' || $status === 'OFFLINE')
                    <div class="bg-danger">
                    <tr class="">
                        <td class="ps-3 {{ empty($data['CompanyName']) ? 'bg-dark text-muted italic' : '' }}">
                         <span class=" text-dark fs-8 company-name">{{ clean($data['CompanyName'] ?? '—') }}</span>
                        </td>

                        <td class="{{ empty($data['Location']) ? 'bg-light text-muted' : '' }} text-dark fs-8">
                            {{ clean($data['Location'] ?? '—') }}
                        </td>

                        <td class="{{ empty($data['Phone']) ? 'bg-light text-muted' : '' }}">
                            <span class="text-nowrap">{{ clean($data['Phone'] ?? '—') }}</span>
                        </td>

                        <td class="{{ empty($data['Email']) ? 'bg-light text-muted' : '' }}">
                            <span class="text-primary fw-medium">{{ $data['Email'] ?? '—' }}</span>
                        </td>

                        <td>{{ clean($data['MCS150Date'] ?? '—') }}</td>
                        <td><span class="badge bg-light text-dark border">{{ $data['DOT'] ?? '—' }}</span></td>
                       <td class="">{{ clean($data['MC'] ?? '—') }}</td>


                        <td class="text-center fw-bold">{{ clean($data['PowerUnits'] ?? '0') }}</td>
                         <td class="text-center fw-bold">{{ clean($data['Drivers'] ?? '0') }}</td>

                        
                        <td>
                           @php
    $status = strtoupper($data['Status'] ?? '');
    // If ACTIVE → bg-danger (red), else bg-success (green)
    $badgeClass = ($status === 'ACTIVE') ? 'bg-danger text-white' : 'bg-success text-white';
@endphp

<span class="badge px-2 py-1 {{ $badgeClass }}">{{ $status ?: '—' }}</span>
                        </td>
                        
                        <td><span class="text-muted small text-uppercase fw-bold">{{ clean($data['EntityType'] ?? '—') }}</span></td>

                        <td>
                            @if(!empty($data['Source']))
                                <a href="{{ $data['Source'] }}" target="_blank" class="btn btn-sm btn-outline-primary py-0 px-2">
                                    Link
                                </a>
                            @else
                                  <a href="https://safer.fmcsa.dot.gov/CompanySnapshot.aspx" target="_blank" class="btn btn-sm btn-outline-primary py-0 px-2">
                                    </i>Source
                                </a>
                            @endif
                        </td>

                        <td class="pe-3 {{ empty($data['Error']) || $data['Error'] === 'None' ? 'text-success' : 'text-danger fw-bold' }}">
                            @if(empty($data['Error']) || $data['Error'] === 'None')
                                <i class="bi bi-check-circle-fill me-1"></i>None
                            @else
                                <i class="bi bi-exclamation-triangle-fill me-1"></i>{{ $data['Error'] }}
                            <i class="bi bi-exclamation-triangle-fill me-1"></i>{{ $data['OperatingStatus'] }}

                            @endif
                        </td>
                    </tr>
                    <div>
                         @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@else
    <p class="mt-5">Please enter a DOT number to fetch carrier data.</p>
@endif
@if(isset($allData) && count($allData) > 0)
<form method="POST" action="{{ route('fmcsa.export') }}" class="d-inline">
    @csrf

    <!-- Send fetched data safely -->
    <input type="hidden" name="export_data" value='@json($allData)'>

    <button type="submit" class="btn btn-success shadow-sm">
        <i class="bi bi-file-earmark-excel-fill me-1"></i>
        Export Data
    </button>
</form>
@endif

</div>
</body>
</html>
@endsection
