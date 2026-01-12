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
            
            <div class="col-md-3 d-print-none">
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
                    <div class="card-header p-2 d-print-none">
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
                                
                                <div class="row mb-3 d-print-none">
                                    <div class="col-12 text-right">
                                        <button onclick="window.print()" class="btn btn-default mr-2">
                                            <i class="fas fa-print"></i> Print History
                                        </button>
                                        <a href="{{ route('driver-problems.create', $driver->id) }}" class="btn btn-danger">
                                            <i class="fa fa-exclamation-triangle"></i> Report New Issue
                                        </a>
                                    </div>
                                </div>

                                <div id="printable-history">
                                    
                                    <div class="d-none d-print-block mb-4">
                                        <h3 class="text-center border-bottom pb-2" style="text-transform: uppercase;">Official Incident History Log</h3>
                                        <div class="text-center mb-4">R-Creation Limited</div>
                                        
                                        <div class="row border p-2 m-0">
                                            <div class="col-6">
                                                <strong style="text-decoration: underline;">DRIVER INFO:</strong><br>
                                                Name: <strong>{{ $driver->name }}</strong><br>
                                                Phone: {{ $driver->phone }}<br>
                                                License: {{ $driver->license_number }}
                                            </div>
                                            <div class="col-6 text-right">
                                                <strong style="text-decoration: underline;">STATISTICS:</strong><br>
                                                Total Incidents: {{ $driver->problems->count() }}<br>
                                                Highest Severity: 
                                                @php 
                                                    $maxSev = $driver->problems->pluck('severity')->unique();
                                                    if($maxSev->contains('Critical')) echo 'Critical';
                                                    elseif($maxSev->contains('High')) echo 'High';
                                                    else echo 'Normal';
                                                @endphp
                                                <br>
                                                <strong>TOTAL LOSS: {{ number_format($driver->problems->sum('cost'), 2) }} BDT</strong>
                                            </div>
                                        </div>
                                        <div class="text-right mt-2 text-muted small">Printed On: {{ date('d M Y, h:i A') }}</div>
                                    </div>

                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th style="width: 15%">Date & Time</th>
                                                    <th>Vehicle #</th>
                                                    <th>Type</th>
                                                    <th>Location</th>
                                                    <th>Severity</th>
                                                    
                                                    <th class="d-print-none">Status</th>
                                                    
                                                    <th class="text-right">Cost (BDT)</th>
                                                    
                                                    <th class="text-center d-print-none" style="width: 15%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($driver->problems as $problem)
                                                    <tr>
                                                        <td>
                                                            {{ $problem->occurrence_date->format('d M Y') }}<br>
                                                            <small class="text-muted">{{ $problem->occurrence_date->format('h:i A') }}</small>
                                                        </td>
                                                        <td>{{ $problem->vehicle_number }}</td>
                                                        <td>{{ $problem->type }}</td>
                                                        <td>{{ $problem->place ?? '-' }}</td>
                                                        <td>
                                                            @if($problem->severity == 'Critical')
                                                                <span class="badge badge-danger">Critical</span>
                                                            @elseif($problem->severity == 'High')
                                                                <span class="badge badge-warning">High</span>
                                                            @else
                                                                <span class="badge badge-light border">{{ $problem->severity }}</span>
                                                            @endif
                                                        </td>
                                                        
                                                        <td class="d-print-none">
                                                            @if($problem->status == 'Solved')
                                                                <span class="badge badge-success">Solved</span>
                                                            @elseif($problem->status == 'Rejected')
                                                                <span class="badge badge-secondary">Rejected</span>
                                                            @else
                                                                <span class="badge badge-warning">Pending</span>
                                                            @endif
                                                        </td>

                                                        <td class="text-right font-weight-bold">
                                                            {{ $problem->cost ? number_format($problem->cost, 2) : '0.00' }}
                                                        </td>

                                                        <td class="text-center d-print-none">
                                                            <a href="{{ route('driver-problems.show', $problem->id) }}" class="btn btn-sm btn-info" title="View"><i class="fa fa-eye"></i></a>
                                                            <a href="{{ route('driver-problems.edit', $problem->id) }}" class="btn btn-sm btn-warning" title="Edit"><i class="fa fa-edit"></i></a>
                                                            <form action="{{ route('driver-problems.destroy', $problem->id) }}" method="POST" style="display:inline" onsubmit="return confirm('Delete this record?')">
                                                                @csrf @method('DELETE')
                                                                <button type="submit" class="btn btn-sm btn-danger" title="Delete"><i class="fa fa-trash"></i></button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="8" class="text-center text-muted">No incidents found for this driver.</td>
                                                    </tr>
                                                @endforelse
                                                
                                                @if($driver->problems->count() > 0)
                                                <tr class="font-weight-bold d-none d-print-row" style="border-top: 2px solid #000;">
                                                    <td colspan="5" class="text-right text-uppercase">Grand Total Loss:</td>
                                                    
                                                    <td class="text-right">{{ number_format($driver->problems->sum('cost'), 2) }}</td>
                                                    
                                                    <td class="d-print-none"></td> 
                                                </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="d-none d-print-flex justify-content-between mt-5 pt-5">
                                        <div class="text-center" style="width: 250px; border-top: 1px solid #000; padding-top: 5px;">
                                            Driver Signature
                                        </div>
                                        <div class="text-center" style="width: 250px; border-top: 1px solid #000; padding-top: 5px;">
                                            Authorized Signature
                                        </div>
                                    </div>

                                </div>
                            </div>
                            </div>
                        </div></div>
                </div>
            </div>
        </div></section>

<style>
@media print {
    /* 1. সবকিছুর ব্যাকগ্রাউন্ড জোর করে সাদা করা */
    body, html, .wrapper, .content-wrapper, .main-header, .main-sidebar, .card {
        background: #ffffff !important;
        background-color: #ffffff !important;
        color: #000000 !important;
    }

    /* 2. সব এলিমেন্ট হাইড করা */
    body * { 
        visibility: hidden; 
    }
    
    /* 3. শুধু আমাদের হিস্ট্রি সেকশনটা ভিজিবল করা */
    #printable-history, #printable-history * { 
        visibility: visible; 
    }

    /* 4. প্রিন্ট এরিয়া সেটআপ (Background White) */
    #printable-history {
        position: fixed; /* absolute এর বদলে fixed ব্যবহার করলে অনেক সময় কাজ করে */
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 20px;
        background-color: #ffffff !important; /* এখানে সাদা কালার ফিক্স করা হলো */
        z-index: 9999; /* সবার উপরে থাকার জন্য */
    }

    /* 5. গ্র্যান্ড টোটাল রো প্রিন্টে দেখানোর লজিক */
    tr.d-print-row {
        display: table-row !important;
    }

    /* 6. অপ্রয়োজনীয় বর্ডার ও শ্যাডো রিমুভ */
    .card { border: none !important; box-shadow: none !important; }
    
    /* 7. ইউটিলিটি ক্লাস */
    .d-print-none { display: none !important; }
    
    /* 8. টেবিল বর্ডার */
    table { width: 100% !important; border-collapse: collapse !important; }
    th, td { border: 1px solid #000 !important; padding: 5px !important; }
}
</style>

@endsection