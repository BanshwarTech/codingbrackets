@extends('admin.includes.layout')
@section('page-title', 'Technologies')
@section('admin-content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-outline">
                <div class="card-header bg-blue d-flex justify-content-between align-items-center">
                    <h5 class="text-white m-b-0">Add Technology</h5>
                    <a href="{{ route('admin.website') }}"
                        class="btn btn-secondary btn-sm float-end {{ is_object($technology) && isset($technology->id) && $technology->id > 0 ? '' : 'd-none' }}"><i
                            class="fa fa-arrow-left"></i> Back</a>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.technology.post') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-10">
                                <div class="row">
                                    <input type="hidden" name="id" value="{{ $technology->id ?? '' }}">
                                    <div class="form-group col-md-6 ">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="Enter website type " value="{{ $technology->name ?? '' }}">
                                        @error('name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-6 ">
                                        <label for="image">Image</label>
                                        <input type="file" class="form-control" id="image" name="image"
                                            value="{{ $technology->image ?? '' }}">
                                        @error('image')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            {{-- Image on the right --}}
                            <div class="col-sm-2 d-flex align-items-start justify-content-center mt-4">
                                @if (!empty($technology->image) && file_exists(storage_path('app/public/tech/' . $technology->image)))
                                    <img src="{{ asset('storage/tech/' . $technology->image) }}" alt="image"
                                        class="img-thumbnail img-fluid" style="height: 150px; width: 150px;">
                                @endif
                            </div>
                        </div>


                        <!-- Optional: created_at and updated_at will be auto-managed by backend -->

                        <button type="submit" class="btn btn-success">Submit</button>
                    </form>

                </div>
            </div>
            <div
                class="card card-outline mt-3 {{ is_object($technology) && isset($technology->id) && $technology->id > 0 ? 'd-none' : '' }}">

                <div class="card-header bg-blue">
                    <h5 class="text-white m-b-0">Technologies</h5>
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
                                                <th>Technology Name</th>
                                                <th>Image</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($technologies as $index => $tech)
                                                <tr class="align-middle">
                                                    <td>{{ $index + 1 }}.</td>
                                                    <td>{{ $tech->name }}</td>
                                                    <td><img src="{{ asset('storage/tech/' . $tech->image) }}"
                                                            alt="{{ $tech->slug }}" height="50"></td>
                                                    <td>
                                                        <a href="{{ route('admin.technology', $tech->id) }}"
                                                            class="btn btn-sm btn-primary  mt-1"><i class="fa fa-edit"></i>
                                                            Edit</a>
                                                        ||
                                                        <div class="btn-group mt-1">
                                                            <button type="button"
                                                                class="btn btn-secondary btn-sm dropdown-toggle"
                                                                data-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                                {{ $tech->status == 'active' ? 'Active' : 'Inactive' }}
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item"
                                                                    href="{{ route('admin.technology.status', ['id' => $tech->id, 'status' => 'active']) }}">
                                                                    Active
                                                                </a>
                                                                <a class="dropdown-item"
                                                                    href="{{ route('admin.technology.status', ['id' => $tech->id, 'status' => 'inactive']) }}">
                                                                    InActive</a>
                                                            </div>
                                                        </div>
                                                        ||
                                                        <a href="{{ route('admin.technology.delete', $tech->id) }}"
                                                            class="btn btn-sm btn-danger  mt-1"
                                                            onclick="return confirm('Are you sure you want to delete this technology({{ $tech->name }})?')"><i
                                                                class="fa fa-trash-o"></i>
                                                            Delete</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th style="width: 10px">#</th>
                                                <th>Technology Name</th>
                                                <th>Image</th>
                                                <th>Action</th>
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
