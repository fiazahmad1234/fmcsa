@extends('layout.dashboard1')

@section('dashboard-content')
<div class="row justify-content-center">
    <div class="card shadow-sm w-100">
        <div class="card-header bg-primary text-white mt-2">
            <h5 class="mb-0">Email Configurations</h5>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if($configs->isEmpty())
                <p class="text-muted">No email configurations found.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Account Name</th>
                                <th>Email</th>
                                <th>SMTP Host</th>
                                <th>SMTP Port</th>
                                <th>Encryption</th>
                                <th>Created At</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($configs as $config)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $config->name }}</td>
                                    <td>{{ $config->email }}</td>
                                    <td>{{ $config->smtp_host ?? '—' }}</td>
                                    <td>{{ $config->smtp_port ?? '—' }}</td>
                                    <td>{{ $config->smtp_encryption ? 'Yes' : 'No' }}</td>
                                    <td>{{ $config->created_at->format('d M Y H:i') }}</td>
                                    <td class="text-center">
                                        <!-- Edit Button -->
                                        <button class="btn btn-sm btn-warning me-1" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#editModal{{ $config->id }}">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>

                                        <!-- Delete Button -->
                                        <button class="btn btn-sm btn-danger" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#deleteModal{{ $config->id }}">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </td>
                                </tr>

                                <!-- Edit Modal -->
                                <div class="modal fade" id="editModal{{ $config->id }}" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h6 class="modal-title">Edit Email Configuration</h6>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('email.update', $config->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')

                                                    <div class="mb-3">
                                                        <label class="form-label">Account Name</label>
                                                        <input type="text" name="name" class="form-control" value="{{ $config->name }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Email</label>
                                                        <input type="email" name="email" class="form-control" value="{{ $config->email }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Password</label>
                                                        <input type="password" name="password" class="form-control" placeholder="Leave blank to keep current">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">SMTP Host</label>
                                                        <input type="text" name="smtp_host" class="form-control" value="{{ $config->smtp_host }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">SMTP Port</label>
                                                        <input type="number" name="smtp_port" class="form-control" value="{{ $config->smtp_port }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Encryption</label>
                                                        <select name="smtp_encryption" class="form-control">
                                                            <option value="1" {{ $config->smtp_encryption ? 'selected' : '' }}>Yes</option>
                                                            <option value="0" {{ !$config->smtp_encryption ? 'selected' : '' }}>No</option>
                                                        </select>
                                                    </div>

                                                    <div class="text-end">
                                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Delete Modal -->
                                <div class="modal fade" id="deleteModal{{ $config->id }}" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h6 class="modal-title text-danger">Delete Email Configuration</h6>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure you want to delete <strong>{{ $config->name }}</strong>?</p>
                                                <form action="{{ route('email.destroy', $config->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="text-end">
                                                        <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
