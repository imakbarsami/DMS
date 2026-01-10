@extends('layout.admin')

@section('content')

<div class="content-header">
    <div class="container-fluid mt-3 mb-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Drivers List</h1>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                
                <div class="card card-primary card-outline">
                    
                    <div class="card-header">
                        <h3 class="card-title">Manage Drivers</h3>
                        <div class="card-tools">
                            <a class="btn btn-success btn-sm" href="{{ route('drivers.create') }}">
                                <i class="fas fa-plus"></i> Add New Driver
                            </a>
                        </div>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 50px">No</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>License No</th>
                                    <th>Status</th>
                                    <th width="200px" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($drivers as $driver)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        @if($driver->image)
                                            <img src="/images/{{ $driver->image }}" class="img-circle" width="40px" height="40px" style="object-fit:cover">
                                        @else
                                            <img src="https://via.placeholder.com/40" class="img-circle" width="40px">
                                        @endif
                                    </td>
                                    <td>{{ $driver->name }}</td>
                                    <td>{{ $driver->phone }}</td>
                                    <td>{{ $driver->license_number }}</td>
                                    <td>
                                        @if($driver->status) 
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <form action="{{ route('drivers.destroy',$driver->id) }}" method="POST">
                                            
                                            <a class="btn btn-info btn-sm" href="{{ route('drivers.show',$driver->id) }}">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            
                                            <a class="btn btn-primary btn-sm" href="{{ route('drivers.edit',$driver->id) }}">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>

                                            @csrf
                                            @method('DELETE')
                                            
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="card-footer clearfix">
                        <div class="float-right">
                            {{ $drivers->links() }}
                        </div>
                    </div>

                </div>
                </div>
        </div>
    </div>
</section>

@endsection