@extends('admin.includes.layout')
@section('page-title', 'Our Team')
@section('admin-content')

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center ">
            <h3 class="card-title mb-0 fw-bold fs-4">Team</h3>
            <a href="{{ route('admin.our-team.manage') }}" class="btn btn-primary float-end">Manage Our Team</a>
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
                                                    class="btn btn-sm btn-primary"><i
                                                        class="fa-regular fa-pen-to-square"></i>
                                                    Edit</a>
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
