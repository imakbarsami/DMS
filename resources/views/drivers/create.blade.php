@extends('layout.admin')
  
@section('content')

<div class="content-header">
    <div class="container-fluid mt-3">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Add New Driver</h1>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Fill Driver Information</h3>
                    </div>
                    
                    <form action="{{ route('drivers.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="card-body">
                            <h5 class="text-primary mb-3">Basic Information</h5>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label>Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" value="{{ old('name') }}" placeholder="Enter Name">
                                    @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>

                                <div class="col-md-6 form-group">
                                    <label>Phone <span class="text-danger">*</span></label>
                                    <input type="text" name="phone" class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" value="{{ old('phone') }}" placeholder="Enter Phone Number">
                                    @if ($errors->has('phone'))
                                        <span class="text-danger">{{ $errors->first('phone') }}</span>
                                    @endif
                                </div>

                                <div class="col-md-6 form-group">
                                    <label>NID Number</label>
                                    <input type="text" name="nid_number" class="form-control {{ $errors->has('nid_number') ? 'is-invalid' : '' }}" value="{{ old('nid_number') }}" placeholder="Enter NID Number">
                                    @if ($errors->has('nid_number'))
                                        <span class="text-danger">{{ $errors->first('nid_number') }}</span>
                                    @endif
                                </div>

                                <div class="col-md-6 form-group">
                                    <label>Date of Birth</label>
                                    <input type="date" name="dob" class="form-control {{ $errors->has('dob') ? 'is-invalid' : '' }}" value="{{ old('dob') }}">
                                    @if ($errors->has('dob'))
                                        <span class="text-danger">{{ $errors->first('dob') }}</span>
                                    @endif
                                </div>
                            </div>

                            <hr>

                            <h5 class="text-primary mb-3">License & Job Info</h5>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label>License Number <span class="text-danger">*</span></label>
                                    <input type="text" name="license_number" class="form-control {{ $errors->has('license_number') ? 'is-invalid' : '' }}" value="{{ old('license_number') }}" placeholder="Enter License Number">
                                    @if ($errors->has('license_number'))
                                        <span class="text-danger">{{ $errors->first('license_number') }}</span>
                                    @endif
                                </div>

                                <div class="col-md-6 form-group">
                                    <label>License Expiry Date</label>
                                    <input type="date" name="license_expiration_date" class="form-control" value="{{ old('license_expiration_date') }}">
                                </div>

                                <div class="col-md-4 form-group">
                                    <label>Experience (Years)</label>
                                    <input type="number" name="experience" class="form-control" value="{{ old('experience') }}" placeholder="Ex: 5">
                                </div>

                                <div class="col-md-4 form-group">
                                    <label>Blood Group</label>
                                    <select name="blood_group" class="form-control">
                                        <option value="">Select Blood Group</option>
                                        <option value="A+" {{ old('blood_group') == 'A+' ? 'selected' : '' }}>A+</option>
                                        <option value="B+" {{ old('blood_group') == 'B+' ? 'selected' : '' }}>B+</option>
                                        <option value="AB+" {{ old('blood_group') == 'AB+' ? 'selected' : '' }}>AB+</option>
                                        <option value="O+" {{ old('blood_group') == 'O+' ? 'selected' : '' }}>O+</option>
                                        <option value="A-" {{ old('blood_group') == 'A-' ? 'selected' : '' }}>A-</option>
                                        <option value="B-" {{ old('blood_group') == 'B-' ? 'selected' : '' }}>B-</option>
                                        <option value="AB-" {{ old('blood_group') == 'AB-' ? 'selected' : '' }}>AB-</option>
                                        <option value="O-" {{ old('blood_group') == 'O-' ? 'selected' : '' }}>O-</option>
                                    </select>
                                </div>

                                <div class="col-md-4 form-group">
                                    <label>Status</label>
                                    <select name="status" class="form-control">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                            </div>

                            <hr>

                            <h5 class="text-primary mb-3">Address</h5>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label>City</label>
                                    <input type="text" name="city" class="form-control" value="{{ old('city') }}" placeholder="Enter City">
                                </div>

                                <div class="col-md-6 form-group">
                                    <label>District</label>
                                    <input type="text" name="district" class="form-control" value="{{ old('district') }}" placeholder="Enter District">
                                </div>

                                <div class="col-md-12 form-group">
                                    <label>Full Address</label>
                                    <textarea class="form-control" rows="3" name="address" placeholder="Enter Full Address">{{ old('address') }}</textarea>
                                </div>
                            </div>

                            <hr>

                            <h5 class="text-primary mb-3">Document Uploads</h5>
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <label>Profile Image</label>
                                    <input type="file" name="image" class="form-control form-control-file border p-1 {{ $errors->has('image') ? 'is-invalid' : '' }}">
                                    @if ($errors->has('image'))
                                        <span class="text-danger">{{ $errors->first('image') }}</span>
                                    @endif
                                </div>

                                <div class="col-md-4 form-group">
                                    <label>Upload NID Copy</label>
                                    <input type="file" name="nid_img" class="form-control form-control-file border p-1 {{ $errors->has('nid_img') ? 'is-invalid' : '' }}">
                                    @if ($errors->has('nid_img'))
                                        <span class="text-danger">{{ $errors->first('nid_img') }}</span>
                                    @endif
                                </div>

                                <div class="col-md-4 form-group">
                                    <label>Upload Driving License</label>
                                    <input type="file" name="driving_license_img" class="form-control form-control-file border p-1 {{ $errors->has('driving_license_img') ? 'is-invalid' : '' }}">
                                    @if ($errors->has('driving_license_img'))
                                        <span class="text-danger">{{ $errors->first('driving_license_img') }}</span>
                                    @endif
                                </div>
                            </div>

                        </div>
                        <div class="card-footer text-center">
                            <button type="submit" class="btn btn-primary btn-lg"><i class="fa fa-save"></i> Submit Information</button>
                            <a href="{{ route('drivers.index') }}" class="btn btn-secondary btn-lg ml-2"><i class="fa fa-times"></i> Cancel</a>
                        </div>
                    </form>
                </div>
                </div>
        </div>
    </div>
</section>

@endsection