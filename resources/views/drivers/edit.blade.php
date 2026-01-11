@extends('layout.admin')
   
@section('content')

<div class="content-header">
    <div class="container-fluid mt-3">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Edit Driver Info</h1>
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
                        <h3 class="card-title">Update Information for: <strong>{{ $driver->name }}</strong></h3>
                    </div>

                    <form action="{{ route('drivers.update', $driver->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                    
                        <div class="card-body">
                            
                            <h5 class="text-primary mb-3"><i class="fa fa-user"></i> Basic Information</h5>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label>Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" value="{{ old('name', $driver->name) }}" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}">
                                    @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>

                                <div class="col-md-6 form-group">
                                    <label>Phone <span class="text-danger">*</span></label>
                                    <input type="text" name="phone" value="{{ old('phone', $driver->phone) }}" class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}">
                                    @if ($errors->has('phone'))
                                        <span class="text-danger">{{ $errors->first('phone') }}</span>
                                    @endif
                                </div>

                                <div class="col-md-6 form-group">
                                    <label>NID Number</label>
                                    <input type="text" name="nid_number" value="{{ old('nid_number', $driver->nid_number) }}" class="form-control {{ $errors->has('nid_number') ? 'is-invalid' : '' }}">
                                    @if ($errors->has('nid_number'))
                                        <span class="text-danger">{{ $errors->first('nid_number') }}</span>
                                    @endif
                                </div>

                                <div class="col-md-6 form-group">
                                    <label>Date of Birth</label>
                                    <input type="date" name="dob" value="{{ old('dob', $driver->dob) }}" class="form-control {{ $errors->has('dob') ? 'is-invalid' : '' }}">
                                    @if ($errors->has('dob'))
                                        <span class="text-danger">{{ $errors->first('dob') }}</span>
                                    @endif
                                </div>
                            </div>

                            <hr>

                            <h5 class="text-primary mb-3"><i class="fa fa-id-card"></i> License & Work Info</h5>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label>License Number <span class="text-danger">*</span></label>
                                    <input type="text" name="license_number" value="{{ old('license_number', $driver->license_number) }}" class="form-control {{ $errors->has('license_number') ? 'is-invalid' : '' }}">
                                    @if ($errors->has('license_number'))
                                        <span class="text-danger">{{ $errors->first('license_number') }}</span>
                                    @endif
                                </div>

                                <div class="col-md-6 form-group">
                                    <label>License Expiry Date</label>
                                    <input type="date" name="license_expiration_date" value="{{ old('license_expiration_date', $driver->license_expiration_date) }}" class="form-control">
                                </div>

                                <div class="col-md-4 form-group">
                                    <label>Experience (Years)</label>
                                    <input type="number" name="experience" value="{{ old('experience', $driver->experience) }}" class="form-control">
                                </div>

                                <div class="col-md-4 form-group">
                                    <label>Blood Group</label>
                                    <select name="blood_group" class="form-control">
                                        <option value="">Select</option>
                                        @foreach(['A+', 'B+', 'AB+', 'O+', 'A-', 'B-', 'AB-', 'O-'] as $bg)
                                            <option value="{{ $bg }}" {{ old('blood_group', $driver->blood_group) == $bg ? 'selected' : '' }}>{{ $bg }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4 form-group">
                                    <label>Status</label>
                                    <select name="status" class="form-control">
                                        <option value="1" {{ old('status', $driver->status) == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ old('status', $driver->status) == 0 ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>
                            </div>

                            <hr>

                            <h5 class="text-primary mb-3"><i class="fa fa-map-marker-alt"></i> Address</h5>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label>City</label>
                                    <input type="text" name="city" value="{{ old('city', $driver->city) }}" class="form-control">
                                </div>
                                
                                <div class="col-md-6 form-group">
                                    <label>District</label>
                                    <input type="text" name="district" value="{{ old('district', $driver->district) }}" class="form-control">
                                </div>

                                <div class="col-md-12 form-group">
                                    <label>Full Address</label>
                                    <textarea class="form-control" rows="3" name="address">{{ old('address', $driver->address) }}</textarea>
                                </div>
                            </div>

                            <hr>

                            <h5 class="text-primary mb-3"><i class="fa fa-images"></i> Update Images</h5>
                            <div class="row">
                                
                                <div class="col-md-4 form-group">
                                    <label>Profile Image</label>
                                    <input type="file" name="image" class="form-control form-control-file border p-1 mb-2 {{ $errors->has('image') ? 'is-invalid' : '' }}">
                                    @if($driver->image)
                                        <div class="p-2 border rounded bg-light text-center">
                                            <img src="/images/{{ $driver->image }}" height="80px" class="rounded">
                                            <p class="text-muted text-xs mb-0 mt-1">Current Image</p>
                                        </div>
                                    @endif
                                    @if ($errors->has('image'))
                                        <div class="text-danger">{{ $errors->first('image') }}</div>
                                    @endif
                                </div>

                                <div class="col-md-4 form-group">
                                    <label>NID Copy</label>
                                    <input type="file" name="nid_img" class="form-control form-control-file border p-1 mb-2 {{ $errors->has('nid_img') ? 'is-invalid' : '' }}">
                                    @if($driver->nid_img)
                                        <div class="p-2 border rounded bg-light text-center">
                                            <img src="/nid/{{ $driver->nid_img }}" height="80px" class="rounded">
                                            <p class="text-muted text-xs mb-0 mt-1">Current NID</p>
                                        </div>
                                    @endif
                                    @if ($errors->has('nid_img'))
                                        <div class="text-danger">{{ $errors->first('nid_img') }}</div>
                                    @endif
                                </div>

                                <div class="col-md-4 form-group">
                                    <label>Driving License</label>
                                    <input type="file" name="driving_license_img" class="form-control form-control form-control-file border p-1 mb-2 {{ $errors->has('driving_license_img') ? 'is-invalid' : '' }}">
                                    @if($driver->driving_license_img)
                                        <div class="p-2 border rounded bg-light text-center">
                                            <img src="/driving-licences/{{ $driver->driving_license_img }}" height="80px" class="rounded">
                                            <p class="text-muted text-xs mb-0 mt-1">Current License</p>
                                        </div>
                                    @endif
                                    @if ($errors->has('driving_license_img'))
                                        <div class="text-danger">{{ $errors->first('driving_license_img') }}</div>
                                    @endif
                                </div>

                            </div>

                        </div>
                        <div class="card-footer text-center">
                            <button type="submit" class="btn btn-primary btn-lg"><i class="fa fa-save"></i> Update Driver Info</button>
                            <a href="{{ route('drivers.index') }}" class="btn btn-secondary btn-lg ml-2"><i class="fa fa-times"></i> Cancel</a>
                        </div>

                    </form>
                </div>
                </div>
        </div>
    </div>
</section>

@endsection