@extends('admin.includes.layout')
@section('page-title', 'Services')
@section('admin-content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-outline">
                <div class="card-header bg-blue d-flex justify-content-between align-items-center">
                    <h5 class="text-white m-b-0">{{ isset($service->id) && $service->id != 0 ? 'Update' : 'Create' }}
                        Services</h5>
                    <a href="{{ route('admin.services') }}"
                        class="btn btn-secondary btn-sm float-end {{ is_object($service) && isset($service->id) && $service->id > 0 ? '' : 'd-none' }}"><i
                            class="fa fa-arrow-left"></i> Back</a>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.services.post') }}">
                        @csrf
                        <input type="hidden" name="id" value="{{ $service->id ?? '' }}">
                        <div class="form-group ">
                            <label for="name">Service Name</label>
                            <input type="text" class="form-control" id="name" name="servicename"
                                placeholder="Enter service name" value="{{ $service->name ?? '' }}">
                            @error('servicename')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Optional: created_at and updated_at will be auto-managed by backend -->

                        <button type="submit"
                            class="btn btn-success">{{ isset($service->id) && $service->id != 0 ? 'Update' : 'Create' }}
                        </button>
                    </form>

                </div>
            </div>
            <div
                class="card card-outline mt-3 {{ is_object($service) && isset($service->id) && $service->id > 0 ? 'd-none' : '' }}">

                <div class="card-header bg-blue">
                    <h5 class="text-white m-b-0">Services</h5>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="example1" class="myTable display " role="grid"
                                        aria-describedby="example1_info">

                                        <thead>
                                            <tr role="row">
                                                <th style="width: 10px">#</th>
                                                <th>Name</th>
                                                <th style="width: 40px">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($services as $index => $serve)
                                                <tr class="align-middle">
                                                    <td>{{ $index + 1 }}.</td>
                                                    <td>{{ $serve->name }}</td>
                                                    <td>
                                                        <a href="{{ route('admin.services', $serve->id) }}"
                                                            class="btn btn-sm btn-primary"><i class="fa fa-edit"></i>
                                                            Edit</a>
                                                        ||
                                                        <div class="btn-group">
                                                            <button type="button"
                                                                class="btn btn-secondary btn-sm dropdown-toggle"
                                                                data-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                                <i class="fa fa-toggle-down"></i>
                                                                {{ $serve->status == 'active' ? 'Active' : 'Inactive' }}
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item"
                                                                    href="{{ route('admin.services.status', ['id' => $serve->id, 'status' => 'active']) }}">
                                                                    Active
                                                                </a>
                                                                <a class="dropdown-item"
                                                                    href="{{ route('admin.services.status', ['id' => $serve->id, 'status' => 'inactive']) }}">
                                                                    InActive</a>
                                                            </div>
                                                        </div>
                                                        ||
                                                        <a href="{{ route('admin.services.delete', $serve->id) }}"
                                                            class="btn btn-sm btn-danger"
                                                            onclick="return confirm('Are you sure you want to delete this service?')"><i
                                                                class="fa fa-trash-o"></i>
                                                            Delete</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th style="width: 10px">#</th>
                                                <th>Name</th>
                                                <th style="width: 40px">Action</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
