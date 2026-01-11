@extends('layout.admin')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Edit / Resolve Incident #{{ $problem->id }}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('drivers.show', $problem->driver_id) }}">Back to Profile</a></li>
                    <li class="breadcrumb-item active">Edit Report</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-9">
                
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Update Incident Details</h3>
                    </div>

                    <form action="{{ route('driver-problems.update', $problem->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') <div class="card-body">
                            
                            <h5 class="text-primary"><i class="fas fa-info-circle"></i> General Information</h5>
                            <hr>

                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label>Vehicle Number <span class="text-danger">*</span></label>
                                    <input type="text" name="vehicle_number" 
                                           class="form-control {{ $errors->has('vehicle_number') ? 'is-invalid' : '' }}" 
                                           value="{{ old('vehicle_number', $problem->vehicle_number) }}" required>
                                    @if ($errors->has('vehicle_number'))
                                        <span class="text-danger small">{{ $errors->first('vehicle_number') }}</span>
                                    @endif
                                </div>
                                
                                <div class="col-md-6 form-group">
                                    <label>Occurrence Date & Time</label>
                                    <input type="datetime-local" name="occurrence_date" 
                                           class="form-control {{ $errors->has('occurrence_date') ? 'is-invalid' : '' }}" 
                                           value="{{ old('occurrence_date', date('Y-m-d\TH:i', strtotime($problem->occurrence_date))) }}" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label>Incident Type</label>
                                    <select name="type" class="form-control">
                                        @php $types = ['Accident', 'Traffic Case', 'Vehicle Breakdown', 'Document Lost', 'Medical Emergency', 'Fuel Issue', 'Passenger Complaint', 'Other']; @endphp
                                        @foreach($types as $type)
                                            <option value="{{ $type }}" {{ old('type', $problem->type) == $type ? 'selected' : '' }}>{{ $type }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label>Severity Level</label>
                                    <select name="severity" class="form-control">
                                        <option value="Low" {{ $problem->severity == 'Low' ? 'selected' : '' }}>Low</option>
                                        <option value="Medium" {{ $problem->severity == 'Medium' ? 'selected' : '' }}>Medium</option>
                                        <option value="High" {{ $problem->severity == 'High' ? 'selected' : '' }}>High</option>
                                        <option value="Critical" {{ $problem->severity == 'Critical' ? 'selected' : '' }}>Critical</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Location / Place</label>
                                <input type="text" name="place" class="form-control" value="{{ old('place', $problem->place) }}">
                            </div>

                            <div class="form-group">
                                <label>Description</label>
                                <textarea name="description" class="form-control" rows="3">{{ old('description', $problem->description) }}</textarea>
                            </div>

                            <div class="form-group">
                                <label>Proof / Evidence Image</label>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="custom-file">
                                            <input type="file" name="proof_image" class="custom-file-input">
                                            <label class="custom-file-label">Choose new file to replace...</label>
                                        </div>
                                        <small class="text-muted">Leave empty if you don't want to change the image.</small>
                                    </div>
                                    <div class="col-md-4 text-center">
                                        @if($problem->proof_image)
                                            <p class="text-sm mb-1">Current Image:</p>
                                            <img src="/problems/{{ $problem->proof_image }}" class="img-thumbnail" style="height: 80px;">
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <br>
                            <div class="p-3 mb-2 bg-light border rounded">
                                <h5 class="text-danger"><i class="fas fa-user-shield"></i> Office / Admin Resolution</h5>
                                <hr>
                                
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label>Total Cost / Fine Amount (BDT)</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">৳</span>
                                            </div>
                                            <input type="number" step="0.01" name="cost" class="form-control" 
                                                   placeholder="0.00" value="{{ old('cost', $problem->cost) }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label>Status</label>
                                        <select name="status" class="form-control font-weight-bold">
                                            <option value="Pending" {{ $problem->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="Solved" {{ $problem->status == 'Solved' ? 'selected' : '' }} class="text-success">Solved</option>
                                            <option value="Rejected" {{ $problem->status == 'Rejected' ? 'selected' : '' }} class="text-danger">Rejected</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Admin Note / Action Taken</label>
                                    <textarea name="admin_note" class="form-control" rows="2" 
                                              placeholder="Write what action was taken...">{{ old('admin_note', $problem->admin_note) }}</textarea>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer text-center">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fa fa-save"></i> Update Report
                            </button>
                            <a href="{{ route('driver-problems.show', $problem->id) }}" class="btn btn-secondary btn-lg ml-2">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection