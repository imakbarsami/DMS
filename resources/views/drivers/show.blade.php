@extends('layout.admin')

@section('content')

<div class="content-header">
    <div class="container-fluid mt-3">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Driver Profile</h1>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <strong>{{ $driver->name }}</strong>
                        </h3>
                        <div class="card-tools">
                            @if($driver->status) 
                                <span class="badge badge-success">Active</span>
                            @else
                                <span class="badge badge-danger">Inactive</span>
                            @endif
                            
                            <a class="btn btn-primary btn-sm ml-2" href="{{ route('drivers.index') }}"> 
                                <i class="fa fa-arrow-left"></i> Back
                            </a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 text-center border-right">
                                @if($driver->image)
                                    <img src="/images/{{ $driver->image }}" class="img-circle elevation-2" style="width: 150px; height: 150px; object-fit: cover;">
                                @else
                                    <img src="https://via.placeholder.com/150" class="img-circle elevation-2">
                                @endif
                                <h3 class="profile-username text-center mt-3">{{ $driver->name }}</h3>
                                <p class="text-muted text-center">{{ $driver->city ?? 'N/A' }}, {{ $driver->district ?? '' }}</p>
                                
                                <div class="text-center mt-3">
                                    <a href="{{ route('drivers.edit', $driver->id) }}" class="btn btn-primary btn-block">
                                        <i class="fa fa-edit"></i> Edit Profile
                                    </a>
                                </div>
                            </div>

                            <div class="col-md-8">
                                <h4 class="text-primary mb-3"><i class="fa fa-user"></i> Personal Information</h4>
                                <table class="table table-striped">
                                    <tr>
                                        <th width="30%">Phone</th>
                                        <td>{{ $driver->phone }}</td>
                                    </tr>
                                    <tr>
                                        <th>License Number</th>
                                        <td>{{ $driver->license_number }}</td>
                                    </tr>
                                    <tr>
                                        <th>NID Number</th>
                                        <td>{{ $driver->nid_number ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>License Expiry</th>
                                        <td>
                                            {{ $driver->license_expiration_date }}
                                            @if($driver->license_expiration_date && $driver->license_expiration_date < date('Y-m-d'))
                                                <span class="badge badge-danger ml-2">Expired</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Date of Birth</th>
                                        <td>{{ $driver->dob }}</td>
                                    </tr>
                                    <tr>
                                        <th>Blood Group</th>
                                        <td>{{ $driver->blood_group ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Experience</th>
                                        <td>{{ $driver->experience ? $driver->experience . ' Years' : 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Address</th>
                                        <td>{{ $driver->address }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <hr>

                        <div class="row mt-4">
                            <div class="col-12 mb-3">
                                <h4 class="text-primary"><i class="fa fa-file-image"></i> Documents</h4>
                            </div>

                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header bg-light">
                                        <strong>Driving License Image</strong>
                                    </div>
                                    <div class="card-body text-center">
                                        @if($driver->driving_license_img)
                                            <a href="/images/{{ $driver->driving_license_img }}" target="_blank">
                                                <img src="/images/{{ $driver->driving_license_img }}" class="img-fluid img-thumbnail" style="max-height: 300px;">
                                            </a>
                                            <br>
                                            <small class="text-muted">Click to enlarge</small>
                                        @else
                                            <span class="text-muted">No License Image Uploaded</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header bg-light">
                                        <strong>NID Image</strong>
                                    </div>
                                    <div class="card-body text-center">
                                        @if($driver->nid_img)
                                            <a href="/images/{{ $driver->nid_img }}" target="_blank">
                                                <img src="/images/{{ $driver->nid_img }}" class="img-fluid img-thumbnail" style="max-height: 300px;">
                                            </a>
                                            <br>
                                            <small class="text-muted">Click to enlarge</small>
                                        @else
                                            <span class="text-muted">No NID Image Uploaded</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</section>
@endsection