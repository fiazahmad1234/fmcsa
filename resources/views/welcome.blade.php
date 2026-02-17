@php
    function clean($v) {
        return trim(html_entity_decode(strip_tags($v)));
    }
@endphp
@extends('layout.app')
@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <title>FMCSA Intelligence Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body { background-color: #f8fafc; font-family: 'Inter', system-ui, sans-serif; }
        
        .search-card { border: none; border-radius: 15px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); margin-top: 30px; }
        .search-header { background: #1e293b; color: white; padding: 1.25rem; border-radius: 15px 15px 0 0; }

        .results-container { background: white; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.08); overflow: hidden; }
        
        /* Updated Header for Buttons */
        .results-header { 
            background: linear-gradient(135deg, #1e293b 0%, #3b82f6 100%); 
            padding: 1.25rem 1.5rem; 
            color: white; 
        }

        .table thead th {
            background-color: #f1f5f9;
            color: #475569;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.7rem;
            letter-spacing: 0.05em;
            padding: 1rem;
        }

        .fleet-text { font-weight: 600; font-size: 0.85rem; color: #0f172a; }
        .status-pill { padding: 0.35rem 0.75rem; border-radius: 50px; font-size: 0.7rem; font-weight: 700; }
        
        /* Authority Colors */
        .auth-danger { color: #ef4444; font-weight: 800; font-size: 0.75rem; }
        .auth-success { color: #10b981; font-weight: 800; font-size: 0.75rem; }

        .header-btn {
            font-size: 0.75rem;
            font-weight: 700;
            padding: 0.4rem 0.8rem;
            border-radius: 8px;
            transition: all 0.2s;
        }

        @media print {
            .no-print, .search-card { display: none !important; }
            .results-container { box-shadow: none; border: 1px solid #000; }
        }
    </style>
</head>
<body>

<div class="container py-4">
    <div class="card search-card no-print mb-4">
        <div class="search-header">
                         <div class="section-heading">

            <!-- <h5 class="mb-0"><i class="bi bi-search me-2"></i> Carrier Data Lookup</h5> -->
            <h2 class="mb-0"> <i class="bi bi-search me-2" style="color:#03a3ec;"></i><sapn style="color:#03a3ec;"> Carrier</span> <span>Data Lookup</span></h2>
@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show shadow-sm border-0 rounded-3">
    <div class="d-flex align-items-center">
        <i class="bi bi-exclamation-triangle-fill me-2 fs-5"></i>
        <div>
            <strong>Error!</strong>
            <div class="small mt-1">
                {{ session('error') }}
            </div>
        </div>
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif



        <div class="card-body p-4">
            <form id="queryForm" method="POST" action="{{ route('fmcsa.fetch') }}">
                @csrf
                <div class="row g-3">
                    <div class="col-md-5">
                        <label class="form-label small fw-bold text-muted">START MC/DOT</label>
                        <input type="number" name="start_dot" class="form-control" placeholder="1077300" required>
                    </div>
                    <div class="col-md-5">
                        <label class="form-label small fw-bold text-muted">END MC/DOT</label>
                        <input type="number" name="end_dot" class="form-control" placeholder="1077400" required>
                    </div>
                    <div class="col-md-2 d-grid">
                        <label class="form-label d-none d-md-block">&nbsp;</label>
                        <button type="submit" class="btn btn-primary fw-bold">FETCH</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div id="dataTableContainer">
    @if(isset($allData) && count($allData) > 0)
       <div class="results-header">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">

        <!-- LEFT SIDE -->
        <div>
            <h5 class="mb-1 fw-bold text-white">FMCSA Carrier Analytics</h5>
            <small class="opacity-75">Verified SAFER Snapshot</small>
        </div>

        <!-- RIGHT SIDE -->
        <div class="d-flex flex-wrap gap-2 justify-content-md-end">

            <form method="POST" action="{{ route('fmcsa.export') }}" class="m-0">
                @csrf
                <input type="hidden" name="export_data" value='@json($allData)'>
                <button type="submit" class="btn btn-light text-success header-btn">
                    <i class="bi bi-file-earmark-excel me-1"></i>
                    <span class="d-none d-sm-inline">Export All</span>
                </button>
            </form>

            <form method="POST" action="{{ route('emails.export') }}" class="m-0">
                @csrf
                <input type="hidden" name="export_data" value='@json($allData)'>
                <button type="submit" class="btn btn-light text-primary header-btn">
                    <i class="bi bi-envelope me-1"></i>
                    <span class="d-none d-sm-inline">Emails</span>
                </button>
            </form>

            <button type="button"
                    class="btn btn-light text-dark header-btn"
                    onclick="window.print()">
                <i class="bi bi-printer me-1"></i>
                <span class="d-none d-sm-inline">Print</span>
            </button>

            <span class="badge bg-white text-primary px-3 py-2 rounded-pill fw-bold align-self-center">
                {{ count($allData) }} Entities
            </span>

        </div>

    </div>
</div>



             <div class="d-none d-md-block">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Company</th>
                            <th>Email & Phone</th>
                            <th>Type & Fleet (U/D)</th>
                            <th>Identity</th>
                            <th>Status</th>
                            <th>Authority</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach($allData as $data)
                            @php
                                $status = strtoupper($data['Status'] ?? '');
                                $opStatus = strtoupper($data['OperatingStatus'] ?? '');
                                $isAuth = Str::contains($opStatus, 'AUTHORIZED FOR PROPERTY');
                                $entity = strtoupper($data['EntityType'] ?? 'CARRIER');
                            @endphp
                            <tr>
                                <td>
                                    
                                    <div class="fw-bold text-dark">{{ $data['CompanyName'] ?? '—' }}</div>
                                    <div class="small text-muted"><i class="bi bi-geo-alt me-1"></i>{{ $data['Location'] ?? '—' }}</div>
                                </td>
                                <td>
                                    <div class="small fw-medium text-primary">{{ $data['Email'] ?? '—' }}</div>
                                    <div class="small text-muted">{{ $data['Phone'] ?? '—' }}</div>
                                </td>
                                <td>
                                    <div class="fleet-text">
                                        type:{{ $entity }} <br>
                                        unit:{{ $data['PowerUnits'] ?? '0' }} driv:{{ $data['Drivers'] ?? '0' }}
                                    </div>
                                </td>
                                <td class="small">
                                    <div class="text-secondary">DOT: {{ $data['DOT'] ?? '—' }}</div>
                                    <div class="text-secondary">MC: {{ $data['MC'] ?? '—' }}</div>
                                </td>
                                <td>
                                    <span class="status-pill {{ $status === 'ACTIVE' ? 'bg-success-subtle text-success' : 'bg-danger-subtle text-danger' }}">
                                        {{ $status ?: 'INACTIVE' }}
                                    </span>
                                </td>
                               <td>
                                @if($isAuth )
                            
                                    <span class="auth-success">
                                        <i class="bi bi-check-circle-fill me-1"></i>AUTHORIZED
                                    </span>
                                @else
                                    <span class="auth-danger">
                                        <i class="bi bi-x-circle-fill me-1"></i>NOT AUTHORIZED
                                    </span>
                                @endif
                            </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- MOBILE CARDS -->
<div class="d-md-none p-3">
    @foreach($allData as $data)
        @php
            $status = strtoupper($data['Status'] ?? '');
            $opStatus = strtoupper($data['OperatingStatus'] ?? '');
            $isAuth = Str::contains($opStatus, 'AUTHORIZED');
            $entity = strtoupper($data['EntityType'] ?? 'CARRIER');
        @endphp

        <div class="card mb-3 shadow-sm border-0 rounded-4">
            <div class="card-body">

                <h6 class="fw-bold mb-1">
                    {{ $data['CompanyName'] ?? '—' }}
                </h6>

                <div class="small text-muted mb-2">
                    <i class="bi bi-geo-alt"></i>
                    {{ $data['Location'] ?? '—' }}
                </div>

                <div class="row small mb-2">
                    <div class="col-6">
                        <strong>DOT:</strong> {{ $data['DOT'] ?? '—' }}
                    </div>
                    <div class="col-6">
                        <strong>MC:</strong> {{ $data['MC'] ?? '—' }}
                    </div>
                </div>

                <div class="small mb-2">
                    <strong>Email:</strong>
                    <div class="text-primary">{{ $data['Email'] ?? '—' }}</div>

                    <strong>Phone:</strong>
                    <div>{{ $data['Phone'] ?? '—' }}</div>
                </div>

                <div class="small mb-2">
                    <strong>Type:</strong> {{ $entity }} <br>
                    <strong>Fleet:</strong> Units {{ $data['PowerUnits'] ?? 0 }} |
                    Drivers {{ $data['Drivers'] ?? 0 }}
                </div>

                <div class="d-flex justify-content-between align-items-center mt-2">
                    <span class="badge {{ $status === 'ACTIVE' ? 'bg-success' : 'bg-danger' }}">
                        {{ $status ?: 'INACTIVE' }}
                    </span>

                    @if($isAuth)
                        <span class="text-success fw-bold small">
                            <i class="bi bi-check-circle-fill"></i> AUTHORIZED
                        </span>
                    @else
                        <span class="text-danger fw-bold small">
                            <i class="bi bi-x-circle-fill"></i> NOT AUTHORIZED
                        </span>
                    @endif
                </div>

            </div>
        </div>
    @endforeach
</div>

        </div>
    @endif
    </div>

    <div id="loading" class="text-center py-5" style="display: none;">
        <div class="spinner-border text-primary" role="status"></div>
        <p class="mt-2 fw-bold text-muted">Retrieving Records...</p>
    </div>
</div>

<script>
    document.getElementById('queryForm').addEventListener('submit', function() {
        document.getElementById('loading').style.display = 'block';
        document.getElementById('dataTableContainer').style.display = 'none';
    });
</script>

</body>
</html>
@endsection