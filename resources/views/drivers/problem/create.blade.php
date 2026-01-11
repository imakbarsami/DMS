@extends('layout.admin')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Report Incident</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('drivers.show', $driver->id) }}">Back to Profile</a></li>
                    <li class="breadcrumb-item active">New Report</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                
                <div class="card card-danger">
                    <div class="card-header">
                        <h3 class="card-title">
                            Reporting for Driver: <strong>{{ $driver->name }}</strong>
                        </h3>
                    </div>

                    <form action="{{ route('driver-problems.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="driver_id" value="{{ $driver->id }}">

                        <div class="card-body">
                            
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label>Vehicle Number <span class="text-danger">*</span></label>
                                    <input type="text" name="vehicle_number" 
                                           class="form-control {{ $errors->has('vehicle_number') ? 'is-invalid' : '' }}" 
                                           placeholder="e.g. Dhaka Metro-GA-12-1234" 
                                           value="{{ old('vehicle_number') }}">
                                    
                                    @if ($errors->has('vehicle_number'))
                                        <span class="text-danger small">{{ $errors->first('vehicle_number') }}</span>
                                    @endif
                                    <small class="text-muted d-block">Which vehicle was he driving?</small>
                                </div>
                                
                                <div class="col-md-6 form-group">
                                    <label>Occurrence Date & Time <span class="text-danger">*</span></label>
                                    <input type="datetime-local" name="occurrence_date" 
                                           class="form-control {{ $errors->has('occurrence_date') ? 'is-invalid' : '' }}" 
                                           value="{{ old('occurrence_date') }}">
                                           
                                    @if ($errors->has('occurrence_date'))
                                        <span class="text-danger small">{{ $errors->first('occurrence_date') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label>Incident Type <span class="text-danger">*</span></label>
                                    <select name="type" class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}">
                                        <option value="">Select Type</option>
                                        <option value="Accident" {{ old('type') == 'Accident' ? 'selected' : '' }}>Accident (Collision)</option>
                                        <option value="Traffic Case" {{ old('type') == 'Traffic Case' ? 'selected' : '' }}>Traffic Case / Fine</option>
                                        <option value="Vehicle Breakdown" {{ old('type') == 'Vehicle Breakdown' ? 'selected' : '' }}>Vehicle Breakdown</option>
                                        <option value="Document Lost" {{ old('type') == 'Document Lost' ? 'selected' : '' }}>Document Lost</option>
                                        <option value="Medical Emergency" {{ old('type') == 'Medical Emergency' ? 'selected' : '' }}>Medical Emergency</option>
                                        <option value="Fuel Issue" {{ old('type') == 'Fuel Issue' ? 'selected' : '' }}>Fuel Theft / Shortage</option>
                                        <option value="Passenger Complaint" {{ old('type') == 'Passenger Complaint' ? 'selected' : '' }}>Passenger Complaint</option>
                                        <option value="Other" {{ old('type') == 'Other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                    @if ($errors->has('type'))
                                        <span class="text-danger small">{{ $errors->first('type') }}</span>
                                    @endif
                                </div>

                                <div class="col-md-6 form-group">
                                    <label>Severity Level</label>
                                    <select name="severity" class="form-control">
                                        <option value="Low" {{ old('severity') == 'Low' ? 'selected' : '' }}>Low (Minor Issue)</option>
                                        <option value="Medium" {{ old('severity') == 'Medium' ? 'selected' : '' }}>Medium (Needs Attention)</option>
                                        <option value="High" {{ old('severity') == 'High' ? 'selected' : '' }}>High (Serious/Urgent)</option>
                                        <option value="Critical" {{ old('severity') == 'Critical' ? 'selected' : '' }}>Critical (Emergency)</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Location / Place</label>
                                <input type="text" name="place" 
                                       class="form-control {{ $errors->has('place') ? 'is-invalid' : '' }}" 
                                       placeholder="Where did it happen?" 
                                       value="{{ old('place') }}">
                                @if ($errors->has('place'))
                                    <span class="text-danger small">{{ $errors->first('place') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>Detailed Description</label>
                                <textarea name="description" 
                                          class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" 
                                          rows="4" 
                                          placeholder="Describe exactly what happened...">{{ old('description') }}</textarea>
                                @if ($errors->has('description'))
                                    <span class="text-danger small">{{ $errors->first('description') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>Proof / Evidence Image</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" name="proof_image" class="custom-file-input {{ $errors->has('proof_image') ? 'is-invalid' : '' }}">
                                        <label class="custom-file-label">Choose file (Image only)</label>
                                    </div>
                                </div>
                                @if ($errors->has('proof_image'))
                                    <span class="text-danger small d-block mt-1">{{ $errors->first('proof_image') }}</span>
                                @endif
                                <small class="text-muted">Upload photo of the accident, police slip, or broken part (Max: 2MB).</small>
                            </div>

                        </div>
                        <div class="card-footer text-center">
                            <button type="submit" class="btn btn-danger btn-lg">
                                <i class="fa fa-paper-plane"></i> Submit Report
                            </button>
                            <a href="{{ route('drivers.show', $driver->id) }}" class="btn btn-secondary btn-lg ml-2">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection