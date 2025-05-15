@extends('admin.includes.layout')
@section('page-title', 'Manage Services Content')
@section(section: 'admin-content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-outline">
                <div class="card-header bg-blue">
                    <h5 class="text-white m-b-0">Team Member</h5>
                </div>
                <div class="card-body">
                    <form
                        action="{{ isset($services_content) ? route('admin.services.content.manage.post', $services_content->id) : route('admin.services.content.manage.post') }}"
                        method="POST">
                        @csrf
                        <div class="row">
                            <input type="hidden" name="id" value="{{ $services_content->id ?? '' }}">
                            <div class="form-group col-12 col-lg-4 col-md-4">
                                <label for="service_id">Service ID</label>
                                <select name="service_id" id="service_id"
                                    class="custom-select form-control @error('service_id') is-invalid @enderror">
                                    <option value="">-- Select Service --</option>
                                    @foreach ($service as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('service_id', isset($services_content) ? $services_content->service_id : '') == $item->id ? 'selected' : '' }}>
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('service_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                            </div>

                            <div class="form-group col-12 col-lg-4 col-md-4">
                                <label for="title">Title</label>
                                <input type="text" name="title" class="form-control"
                                    value="{{ old('title', $services_content->title ?? '') }}" required>
                                @error('title')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-12 col-lg-4 col-md-4">
                                <label for="short_heading">Short Heading</label>
                                <input type="text" name="short_heading" class="form-control"
                                    value="{{ old('short_heading', $services_content->short_heading ?? '') }}">
                                @error('short_heading')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-12 col-lg-6 col-md-6">
                                <label for="main_heading">Main Heading</label>
                                <textarea name="main_heading" class="form-control">{{ old('main_heading', $services_content->main_heading ?? '') }}</textarea>
                                @error('main_heading')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-12 col-lg-6 col-md-6">
                                <label for="main_content">Main Content</label>
                                <textarea name="main_content" class="form-control">{{ old('main_content', $services_content->main_content ?? '') }}</textarea>
                                @error('main_content')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-12 ">
                                <label for="features_heading">Features Heading</label>
                                <input type="text" name="features_heading" class="form-control"
                                    value="{{ old('features_heading', $services_content->features_heading ?? '') }}">
                                @error('features_heading')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-12">
                                <label for="features">Features</label>
                                <textarea name="features" class="form-control" id="features">{{ old('features', $services_content->features ?? '') }}</textarea>
                                @error('features')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
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
