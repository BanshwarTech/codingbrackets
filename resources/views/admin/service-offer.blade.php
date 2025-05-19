@extends('admin.includes.layout')
@section('page-title', 'Service Offer')
@section('admin-content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card card-outline">
                <div class="card-header bg-blue d-flex justify-content-between align-items-center">
                    <h5 class="text-white m-b-0">{{ isset($offer->id) ? 'Create Offer Service' : 'Update Offer Service' }}
                    </h5>
                    <a href="{{ route('admin.service.offer') }}"
                        class="btn btn-secondary btn-sm float-end {{ is_object($serviceOffer) && isset($serviceOffer->id) && $serviceOffer->id > 0 ? '' : 'd-none' }}"><i
                            class="fa fa-arrow-left"></i> Back</a>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.service.offer.post') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-10">
                                <div class="row">
                                    <input type="hidden" name="id" value="{{ $serviceOffer->id ?? '' }}">
                                    <div class="form-group col-md-6 ">
                                        <label for="offer_title">Title</label>
                                        <input type="text" class="form-control" id="offer_title" name="offer_title"
                                            placeholder="" value="{{ $serviceOffer->offer_title ?? '' }}">
                                        @error('offer_title')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-6 ">
                                        <label for="offer_image">Image</label>
                                        <input type="file" class="form-control" id="offer_image" name="offer_image"
                                            value="{{ $serviceOffer->offer_image ?? '' }}">
                                        @error('offer_image')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    {{-- descoption --}}
                                    <div class="form-group col-12 ">
                                        <label for="offer_description	">Description</label>
                                        <textarea name="offer_description" id="offer_description" class="form-control">{{ $serviceOffer->offer_description ?? '' }}</textarea>
                                        @error('offer_description')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-6 ">
                                        <label for="button_text">Button Text</label>
                                        <input type="text" name="button_text" id="button_text" class="form-control"
                                            value="{{ $serviceOffer->button_text ?? '' }}">
                                        @error('button_text')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-6 ">
                                        <label for="button_link">Button Link</label>
                                        <input type="text" name="button_link" id="button_link" class="form-control"
                                            value="{{ $serviceOffer->button_link ?? '' }}">
                                        @error('button_link')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            {{-- Image on the right --}}
                            <div class="col-sm-2 d-flex align-items-start justify-content-center mt-4">
                                @if (!empty($serviceOffer->offer_image) && file_exists(storage_path('app/public/offer/' . $serviceOffer->offer_image)))
                                    <img src="{{ asset('storage/offer/' . $serviceOffer->offer_image) }}" alt="image"
                                        class="img-thumbnail img-fluid" style="height: 150px; width: 150px;">
                                @endif
                            </div>

                        </div>


                        <!-- Optional: created_at and updated_at will be auto-managed by backend -->

                        <button type="submit"
                            class="btn btn-success">{{ isset($offer->id) ? 'Create' : 'Update' }}</button>
                    </form>

                </div>
            </div>
            <div
                class="card card-outline mt-3 {{ is_object($serviceOffer) && isset($serviceOffer->id) && $serviceOffer->id > 0 ? 'd-none' : '' }}">

                <div class="card-header bg-blue">
                    <h5 class="text-white m-b-0">Offer Services</h5>
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
                                                <th>Title</th>
                                                <th>Description</th>
                                                <th>Image</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($serviceOffers as $index => $tech)
                                                <tr class="align-middle">
                                                    <td>{{ $index + 1 }}.</td>
                                                    <td>{{ $tech->offer_title }}</td>
                                                    <td>{{ $tech->offer_description }}</td>
                                                    <td><img src="{{ asset('storage/offer/' . $tech->offer_image) }}"
                                                            alt="{{ $tech->offer_image }}" height="50"></td>
                                                    <td>
                                                        <a href="{{ route('admin.service.offer', $tech->id) }}"
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
                                                                    href="{{ route('admin.service.offer.status', ['id' => $tech->id]) }}">
                                                                    Active
                                                                </a>
                                                                <a class="dropdown-item"
                                                                    href="{{ route('admin.service.offer.status', ['id' => $tech->id]) }}">
                                                                    InActive</a>
                                                            </div>
                                                        </div>
                                                        ||
                                                        <a href="{{ route('admin.service.offer.delete', $tech->id) }}"
                                                            class="btn btn-sm btn-danger  mt-1"
                                                            onclick="return confirm('Are you sure you want to delete this offer service({{ $tech->name }})?')"><i
                                                                class="fa fa-trash-o"></i>
                                                            Delete</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th style="width: 10px">#</th>
                                                <th>Title</th>
                                                <th>Description</th>
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
