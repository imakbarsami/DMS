@extends('layout.admin')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Driver Profile: {{ $driver->name }}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('drivers.index') }}">List</a></li>
                    <li class="breadcrumb-item active">Profile</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            
            <div class="col-md-3">
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            @if($driver->image)
                                <img class="profile-user-img img-fluid img-circle"
                                     src="/images/{{ $driver->image }}"
                                     alt="User profile picture" style="width: 100px; height: 100px; object-fit: cover;">
                            @else
                                <img class="profile-user-img img-fluid img-circle"
                                     src="https://via.placeholder.com/150"
                                     alt="User profile picture">
                            @endif
                        </div>

                        <h3 class="profile-username text-center">{{ $driver->name }}</h3>
                        <p class="text-muted text-center">{{ $driver->designation ?? 'Driver' }}</p>

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Status</b> 
                                <a class="float-right">
                                    @if($driver->status) 
                                        <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-danger">Inactive</span>
                                    @endif
                                </a>
                            </li>
                            <li class="list-group-item">
                                <b>Experience</b> <a class="float-right">{{ $driver->experience }} Years</a>
                            </li>
                            <li class="list-group-item">
                                <b>Blood Group</b> <a class="float-right">{{ $driver->blood_group }}</a>
                            </li>
                        </ul>

                        <a href="{{ route('drivers.edit', $driver->id) }}" class="btn btn-primary btn-block"><b>Edit Profile</b></a>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item">
                                <a class="nav-link {{ session('active_tab') == 'history' ? '' : 'active' }}" href="#details" data-toggle="tab">
                                    General Info
                                </a>
                            </li>
                            
                            <li class="nav-item">
                                <a class="nav-link" href="#documents" data-toggle="tab">
                                    Documents
                                </a>
                            </li>
                            
                            <li class="nav-item">
                                <a class="nav-link {{ session('active_tab') == 'history' ? 'active' : '' }}" href="#history" data-toggle="tab">
                                    Problem History
                                </a>
                            </li>
                        </ul>
                    </div><div class="card-body">
                        <div class="tab-content">
                            
                            <div class="tab-pane {{ session('active_tab') == 'history' ? '' : 'active' }}" id="details">
                                <table class="table table-striped">
                                    <tr><th width="30%">Phone</th><td>{{ $driver->phone }}</td></tr>
                                    <tr><th>NID Number</th><td>{{ $driver->nid_number }}</td></tr>
                                    <tr><th>License Number</th><td>{{ $driver->license_number }}</td></tr>
                                    <tr>
                                        <th>License Expiry</th>
                                        <td>
                                            {{ $driver->license_expiration_date }}
                                            @if($driver->license_expiration_date < date('Y-m-d'))
                                                <span class="badge badge-danger ml-2">Expired</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr><th>Date of Birth</th><td>{{ $driver->dob }}</td></tr>
                                    <tr><th>City / District</th><td>{{ $driver->city }}, {{ $driver->district }}</td></tr>
                                    <tr><th>Full Address</th><td>{{ $driver->address }}</td></tr>
                                </table>
                            </div>

                            <div class="tab-pane" id="documents">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card shadow-sm">
                                            <div class="card-header bg-light"><strong>Driving License</strong></div>
                                            <div class="card-body text-center">
                                                @if($driver->driving_license_img)
                                                    <a href="/driving-licences/{{ $driver->driving_license_img }}" target="_blank">
                                                        <img src="/driving-licences/{{ $driver->driving_license_img }}" class="img-fluid" style="max-height: 200px;">
                                                    </a>
                                                @else
                                                    <span class="text-muted">Not Uploaded</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card shadow-sm">
                                            <div class="card-header bg-light"><strong>NID Copy</strong></div>
                                            <div class="card-body text-center">
                                                @if($driver->nid_img)
                                                    <a href="/nid/{{ $driver->nid_img }}" target="_blank">
                                                        <img src="/nid/{{ $driver->nid_img }}" class="img-fluid" style="max-height: 200px;">
                                                    </a>
                                                @else
                                                    <span class="text-muted">Not Uploaded</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane {{ session('active_tab') == 'history' ? 'active' : '' }}" id="history">
                                
                                <div class="row mb-3">
                                    <div class="col-12 text-right">
                                        <a href="{{ route('driver-problems.create', $driver->id) }}" class="btn btn-danger">
                                            <i class="fa fa-exclamation-triangle"></i> Report New Issue
                                        </a>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Date</th>
                                                <th>Vehicle #</th>
                                                <th>Type</th>
                                                <th>Severity</th>
                                                <th>Status</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($driver->problems as $problem)
                                                <tr>
                                                    <td>{{ $problem->occurrence_date->format('d M Y') }}</td>
                                                    <td>{{ $problem->vehicle_number }}</td>
                                                    <td><strong>{{ $problem->type }}</strong></td>
                                                    <td>
                                                        @if($problem->severity == 'High' || $problem->severity == 'Critical')
                                                            <span class="badge badge-danger">{{ $problem->severity }}</span>
                                                        @elseif($problem->severity == 'Medium')
                                                            <span class="badge badge-warning">{{ $problem->severity }}</span>
                                                        @else
                                                            <span class="badge badge-info">{{ $problem->severity }}</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($problem->status == 'Solved')
                                                            <span class="badge badge-success">Solved</span>
                                                        @elseif($problem->status == 'Rejected')
                                                            <span class="badge badge-secondary">Rejected</span>
                                                        @else
                                                            <span class="badge badge-warning">Pending</span>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="{{ route('driver-problems.show', $problem->id) }}" class="btn btn-sm btn-info" title="View Details"><i class="fa fa-eye"></i></a>
                                                        <a href="{{ route('driver-problems.edit', $problem->id) }}" class="btn btn-sm btn-warning" title="Update"><i class="fa fa-edit"></i></a>
                                                        
                                                        <form action="{{ route('driver-problems.destroy', $problem->id) }}" method="POST" style="display:inline" onsubmit="return confirm('Are you sure you want to delete this record?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger" title="Delete"><i class="fa fa-trash"></i></button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6" class="text-center text-muted">
                                                        No incidents reported yet.
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            </div>
                        </div></div>
                </div>
            </div>
        </div></section>

@endsection