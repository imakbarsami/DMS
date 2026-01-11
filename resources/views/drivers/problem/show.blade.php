@extends('layout.admin')

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            
            <div class="invoice p-3 mb-3 mt-4" id="printable-area" style="border: 1px solid #ddd; background: white;">
                
                <div class="row">
                    <div class="col-12">
                        <h4>
                            <i class="fas fa-car-crash text-danger"></i> INCIDENT REPORT
                            <small class="float-right">Date: {{ date('d/m/Y') }}</small>
                        </h4>
                    </div>
                </div>
                
                <div class="row invoice-info mt-4">
                    
                    <div class="col-sm-4 invoice-col">
                        <strong>Driver Details</strong>
                        <address>
                            <strong>{{ $problem->driver->name }}</strong><br>
                            Phone: {{ $problem->driver->phone }}<br>
                            License: {{ $problem->driver->license_number }}
                        </address>
                    </div>
                    
                    <div class="col-sm-4 invoice-col">
                        <strong>Incident Details</strong>
                        <address>
                            <b>Type:</b> {{ $problem->type }}<br>
                            <b>Vehicle:</b> {{ $problem->vehicle_number }}<br>
                            <b>Place:</b> {{ $problem->place }}<br>
                            <b>Time:</b> {{ $problem->occurrence_date->format('d M Y, h:i A') }}
                        </address>
                    </div>
                    
                    <div class="col-sm-4 invoice-col">
                        <b>Report ID: #{{ $problem->id }}</b><br>
                        <br>
                        <b>Severity:</b> 
                        @if($problem->severity == 'High' || $problem->severity == 'Critical')
                            <span class="badge badge-danger">{{ $problem->severity }}</span>
                        @else
                            <span class="badge badge-warning">{{ $problem->severity }}</span>
                        @endif
                        <br>
                        <b>Status:</b> 
                        @if($problem->status == 'Solved')
                            <span class="badge badge-success">Solved</span>
                        @else
                            <span class="badge badge-danger">Pending</span>
                        @endif
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12">
                        <p class="lead">Description of Incident:</p>
                        <p class="text-muted well well-sm shadow-none" style="margin-top: 10px; background: #f8f9fa; padding: 15px; border: 1px solid #eee;">
                            {{ $problem->description }}
                        </p>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12">
                        <p class="lead">Visual Evidence / Proof:</p>
                        <div class="text-center border p-2">
                            @if($problem->proof_image)
                                <img src="/problems/{{ $problem->proof_image }}" alt="Evidence" style="max-width: 100%; max-height: 400px;">
                            @else
                                <span class="text-muted">No image evidence attached.</span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-6">
                        <p class="lead">Admin Note / Action Taken:</p>
                        <p class="text-muted" style="border-bottom: 1px solid #ddd; padding-bottom: 5px;">
                            {{ $problem->admin_note ?? 'No action taken yet.' }}
                        </p>
                    </div>
                    <div class="col-6">
                        <p class="lead">Financial Summary</p>
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th style="width:50%">Estimated Cost / Fine:</th>
                                    <td>{{ $problem->cost ? number_format($problem->cost, 2) . ' BDT' : '0.00 BDT' }}</td>
                                </tr>
                                <tr>
                                    <th>Status:</th>
                                    <td>{{ $problem->status }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                
                <div class="row mt-5 pt-5 signature-area" style="display: none;">
                    <div class="col-6 text-center">
                        <p>__________________________</p>
                        <p>Driver Signature</p>
                    </div>
                    <div class="col-6 text-center">
                        <p>__________________________</p>
                        <p>Authorized Signature</p>
                    </div>
                </div>

                <div class="row no-print mt-4">
                    <div class="col-12">
                        
                        <button onclick="window.print()" class="btn btn-dark">
                            <i class="fas fa-print"></i> Print Report
                        </button>
                        
                        <a href="{{ route('driver-problems.edit', $problem->id) }}" class="btn btn-primary float-right" style="margin-right: 5px;">
                            <i class="fas fa-edit"></i> Edit / Resolve
                        </a>

                        <a href="{{ route('drivers.show', $problem->driver_id) }}" class="btn btn-secondary float-right" style="margin-right: 5px;">
                             Back to Profile
                        </a>
                    </div>
                </div>
            </div>
            </div>
    </div>
</div>

<style>
@media print {
    body {
        background-color: white !important;
        margin: 0 !important;
    }
    body * {
        visibility: hidden;
    }
    
    #printable-area, #printable-area * {
        visibility: visible;
    }

    #printable-area {
        position: absolute !important;
        left: 0 !important;
        top: 0 !important;
        width: 100% !important;
        margin: 0 !important;
        padding: 20px !important; 
        background-color: white !important; 
        border: none !important; 
        box-shadow: none !important; 
    }

    .no-print, .main-footer, .main-header, .main-sidebar {
        display: none !important;
    }
    
    .signature-area {
        display: flex !important;
        margin-top: 50px !important;
    }
}
</style>

@endsection