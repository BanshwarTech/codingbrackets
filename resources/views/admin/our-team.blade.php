@extends('admin.includes.layout')
@section('page-title', 'Our Team')
@section('admin-content')

    <div class="card">
        <div class="card-header bg-blue d-flex justify-content-between align-items-center">
            <h5 class="text-white m-b-0">Team</h5>
            <a href="{{ route('admin.our-team.manage') }}" class="btn btn-secondary btn-sm float-end"><i
                    class="fa fa-plus-square"></i> Manage Our Team</a>
        </div>
        <div class="card-body">

            <div class="table-responsive">
                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap">
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="example1" class="myTable display " role="grid" aria-describedby="example1_info">

                                <thead>
                                    <tr role="row">
                                        <th style="width: 10px">#</th>
                                        <th>Name</th>
                                        <th>Role</th>
                                        <th>Profile</th>
                                        <th>Linked URL</th>
                                        <th>Twitter URL</th>
                                        <th style="width: 40px">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($teams as $index => $team)
                                        <tr class="align-middle">
                                            <td>{{ $index + 1 }}.</td>
                                            <td>{{ $team->name }}</td>
                                            <td>{{ $team->role }}</td>
                                            <td><img src="{{ asset('storage/our-team/' . $team->profile_image) }}"
                                                    alt="Profile Image" width="80" height="80"></td>

                                            <td>{{ $team->linkedin_url }}</td>
                                            <td>{{ $team->twitter_url }}</td>
                                            <td>
                                                <a href="{{ route('admin.our-team.manage', $team->id) }}"
                                                    class="btn btn-sm btn-primary"><i class="fa fa-edit"></i>
                                                    Edit</a>||
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-secondary btn-sm dropdown-toggle"
                                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        {{ $team->status == 'active' ? 'Active' : 'Inactive' }}
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.our-team.status', ['id' => $team->id]) }}">
                                                            Active
                                                        </a>
                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.our-team.status', ['id' => $team->id]) }}">
                                                            InActive</a>
                                                    </div>
                                                </div>
                                                ||
                                                <a href="{{ route('admin.our-team.delete', $team->id) }}"
                                                    class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Are you sure you want to delete this team member ({{ $team->name }})?')">
                                                    <i class="fa fa-trash-o"></i> Delete
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Name</th>
                                        <th>Role</th>
                                        <th>Profile</th>
                                        <th>Linked URL</th>
                                        <th>Twitter URL</th>
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
@endsection
