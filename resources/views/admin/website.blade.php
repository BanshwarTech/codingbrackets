@extends('admin.includes.layout')
@section('page-title', 'Website Types')
@section('admin-content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-outline">
                <div class="card-header bg-blue d-flex justify-content-between align-items-center">
                    <h5 class="text-white m-b-0">Add Webite Type</h5>
                    <a href="{{ route('admin.website') }}"
                        class="btn btn-secondary btn-sm float-end {{ is_object($website_type) && isset($website_type->id) && $website_type->id > 0 ? '' : 'd-none' }}"><i
                            class="fa fa-arrow-left"></i> Back</a>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.website.post') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-10">
                                <div class="row">
                                    <input type="hidden" name="id" value="{{ $website_type->id ?? '' }}">
                                    <div class="form-group col-md-6 ">
                                        <label for="website_type">Name</label>
                                        <input type="text" class="form-control" id="website_type" name="website_type"
                                            placeholder="Enter website type " value="{{ $website_type->name ?? '' }}">
                                        @error('website_type')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-6 ">
                                        <label for="icon">Icon</label>
                                        <input type="file" class="form-control" id="icon" name="icon"
                                            value="{{ $website_type->icon ?? '' }}">
                                        @error('icon')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-12 ">
                                        <label for="description">Description</label>
                                        <textarea name="description" id="description" class="form-control">{{ $website_type->description ?? '' }}</textarea>
                                        @error('description')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            {{-- Image on the right --}}
                            <div class="col-sm-2 d-flex align-items-start justify-content-center mt-4">
                                @if (!empty($website_type->icon) && file_exists(storage_path('app/public/icon/' . $website_type->icon)))
                                    <img src="{{ asset('storage/icon/' . $website_type->icon) }}" alt="icon"
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
                class="card card-outline mt-3 {{ is_object($website_type) && isset($website_type->id) && $website_type->id > 0 ? 'd-none' : '' }}">

                <div class="card-header bg-blue">
                    <h5 class="text-white m-b-0">Webite Type</h5>
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
                                                <th>Website Type</th>
                                                <th>Description</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>s
                                            @foreach ($website_types as $index => $serve)
                                                <tr class="align-middle">
                                                    <td>{{ $index + 1 }}.</td>
                                                    <td>{{ $serve->name }}</td>
                                                    <td><span style="width:100px;">{{ $serve->description }}</span></td>
                                                    <td>
                                                        <a href="{{ route('admin.website', $serve->id) }}"
                                                            class="btn btn-sm btn-primary  mt-1"><i class="fa fa-edit"></i>
                                                            Edit</a>
                                                        ||
                                                        <div class="btn-group mt-1">
                                                            <button type="button"
                                                                class="btn btn-secondary btn-sm dropdown-toggle"
                                                                data-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                                {{ $serve->status == 'active' ? 'Active' : 'Inactive' }}
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item"
                                                                    href="{{ route('admin.website.status', ['id' => $serve->id, 'status' => 'active']) }}">
                                                                    Active
                                                                </a>
                                                                <a class="dropdown-item"
                                                                    href="{{ route('admin.website.status', ['id' => $serve->id, 'status' => 'inactive']) }}">
                                                                    InActive</a>
                                                            </div>
                                                        </div>
                                                        ||
                                                        <a href="{{ route('admin.website.delete', $serve->id) }}"
                                                            class="btn btn-sm btn-danger  mt-1"
                                                            onclick="return confirm('Are you sure you want to delete this website type({{ $serve->name }})?')"><i
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
