@extends('admin.includes.layout')
@section('page-title', 'Services Content')
@section(section: 'admin-content')
    <div class="row">
        <div class="col-lg-12">

            <div class="card card-outline">

                <div class="card-header bg-blue d-flex justify-content-between align-items-center ">
                    <h5 class="text-white m-b-0">Services Content</h5>
                    <a href="{{ route('admin.services.content.manage') }}" class="btn btn-secondary float-end">Manage Service
                        Content</a>
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
                                            @foreach ($services_content as $index => $serve)
                                                <tr class="align-middle">
                                                    <td>{{ $index + 1 }}.</td>
                                                    <td>{{ $serve->title }}</td>
                                                    <td>
                                                        <a href="{{ route('admin.services.content.manage', $serve->id) }}"
                                                            class="btn btn-sm btn-primary"><i
                                                                class="fa-regular fa-pen-to-square"></i>
                                                            Edit</a>
                                                        ||
                                                        <div class="btn-group">
                                                            <button type="button"
                                                                class="btn btn-secondary btn-sm dropdown-toggle"
                                                                data-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
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
                                                                class="fa-regular fa-pen-to-square"></i>
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
