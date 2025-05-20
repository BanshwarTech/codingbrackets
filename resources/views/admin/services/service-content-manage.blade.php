@extends('admin.includes.layout')
@section('page-title', 'Manage Services Content')
@section(section: 'admin-content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-outline">
                <div class="card-header bg-blue d-flex justify-content-between align-items-center ">
                    <h5 class="text-white m-b-0">
                        {{ isset($services_content->id) && $services_content->id != 0 ? 'Update' : 'Create' }} Service
                        Content</h5>
                    <a href="{{ route('admin.services.content') }}" class="btn btn-secondary btn-sm float-end"> <i
                            class="fa fa-arrow-left"></i>
                        Back</a>
                </div>
                <div class="card-body">
                    <form
                        action="{{ isset($services_content) ? route('admin.services.content.manage.post', $services_content->id) : route('admin.services.content.manage.post') }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">

                            <div class="col-md-10">
                                <div class="row"> {{-- Hidden ID Field --}}
                                    <input type="hidden" name="id" value="{{ $services_content->id ?? '' }}">

                                    {{-- Service Selector --}}
                                    <div class="form-group col-12 col-md-4">
                                        <label for="service_id">Service</label>
                                        <select name="service_id" id="service_id"
                                            class="custom-select form-control @error('service_id') is-invalid @enderror">
                                            <option value="">-- Select Service --</option>
                                            @foreach ($service as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ old('service_id', $services_content->service_id ?? '') == $item->id ? 'selected' : '' }}>
                                                    {{ $item->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('service_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Title --}}
                                    <div class="form-group col-12 col-md-4">
                                        <label for="title">Title</label>
                                        <input type="text" name="title" class="form-control"
                                            value="{{ old('title', $services_content->title ?? '') }}" required>
                                        @error('title')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Short Heading --}}
                                    <div class="form-group col-12 col-md-4">
                                        <label for="short_heading">Short Heading</label>
                                        <input type="text" name="short_heading" class="form-control"
                                            value="{{ old('short_heading', $services_content->short_heading ?? '') }}">
                                        @error('short_heading')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Main Heading --}}
                                    <div class="form-group col-12 col-md-6">
                                        <label for="main_heading">Main Heading</label>
                                        <textarea name="main_heading" class="form-control">{{ old('main_heading', $services_content->main_heading ?? '') }}</textarea>
                                        @error('main_heading')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Main Content --}}
                                    <div class="form-group col-12 col-md-6">
                                        <label for="main_content">Main Content</label>
                                        <textarea name="main_content" class="form-control">{{ old('main_content', $services_content->main_content ?? '') }}</textarea>
                                        @error('main_content')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Features Heading --}}
                                    <div class="form-group col-8">
                                        <label for="features_heading">Features Heading</label>
                                        <input type="text" name="features_heading" class="form-control"
                                            value="{{ old('features_heading', $services_content->features_heading ?? '') }}">
                                        @error('features_heading')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Features Image --}}
                                    <div class="form-group col-4">
                                        <label for="image">Features Image</label>
                                        <input type="file" class="form-control" id="image" name="image">
                                        @error('image')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Features --}}
                                    <div class="form-group col-12">
                                        <label for="features">Features</label>
                                        <textarea name="features" class="form-control" id="features">{{ old('features', $services_content->features ?? '') }}</textarea>
                                        @error('features')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            {{-- Image on the right --}}
                            <div class="col-sm-2 d-flex align-items-start justify-content-center mt-4">
                                @if (!empty($services_content->image) && file_exists(storage_path('app/public/service/' . $services_content->image)))
                                    <img src="{{ asset('storage/service/' . $services_content->image) }}"
                                        alt="Profile Image" class="img-thumbnail img-fluid"
                                        style="height: 150px; width: 150px;">
                                @endif
                            </div>

                        </div>

                        <button type="submit" class="btn btn-primary">
                            {{ isset($services_content) ? 'Update' : 'Create' }}
                        </button>
                    </form>


                </div>
            </div>
        </div>
    </div>

    <!-- Load open-source TinyMCE (no API key required) -->
    <script src="https://cdn.jsdelivr.net/npm/tinymce@6.8.3/tinymce.min.js"></script>
    <script>
        tinymce.init({
            selector: '#features',
            height: 300,
            menubar: false,
            plugins: 'preview importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap quickbars emoticons accordion',
            toolbar: 'undo redo | accordion accordionremove | blocks fontfamily fontsize | bold italic underline strikethrough | align numlist bullist | link image | table media | lineheight outdent indent| forecolor backcolor removeformat | charmap emoticons | code fullscreen preview | save print | pagebreak anchor codesample | ltr rtl',
            branding: false, // hides "Powered by TinyMCE"
            statusbar: false, // hides bottom word count/status if not needed
            default_link_target: "_blank", // links open in new tab
        });
    </script>

@endsection
