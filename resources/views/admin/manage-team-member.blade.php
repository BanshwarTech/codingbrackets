@extends('admin.includes.layout')
@section('page-title', 'Manage Team Member')
@section('admin-content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-outline">
                <div class="card-header bg-blue">
                    <h5 class="text-white m-b-0">Team Member</h5>
                </div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data" action="{{ route('admin.our-team.manage.post') }}">
                        @csrf
                        <input type="hidden" name="id" value="{{ $team->id ?? '' }}">
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Enter name" value="{{ $team->name ?? '' }}">
                            </div>

                            <div class="form-group col-6">
                                <label for="role">Role</label>
                                <input type="text" class="form-control" id="role" name="role"
                                    placeholder="Enter role" value="{{ $team->role ?? '' }}">
                            </div>

                            <div class="form-group col-6">
                                <label for="profile_image">Profile Image</label>
                                <input type="file" class="form-control" id="profile_image" name="profile_image">
                                @if (!empty($team->profile_image) && file_exists(storage_path('app/public/our-team/' . $team->profile_image)))
                                    <img src="{{ asset('storage/our-team/' . $team->profile_image) }}" alt="Profile Image"
                                        width="80" height="80">
                                @endif

                            </div>

                            <div class="form-group col-6">
                                <label for="linkedin_url">LinkedIn URL</label>
                                <input type="url" class="form-control" id="linkedin_url" name="linkedin_url"
                                    placeholder="Enter LinkedIn profile URL" value="{{ $team->linkedin_url ?? '' }}">
                            </div>

                            <div class="form-group col-6">
                                <label for="twitter_url">Twitter URL</label>
                                <input type="url" class="form-control" id="twitter_url" name="twitter_url"
                                    placeholder="Enter Twitter profile URL" value="{{ $team->twitter_url ?? '' }}">
                            </div>

                        </div>

                        <!-- Optional: created_at and updated_at will be auto-managed by backend -->

                        <button type="submit" class="btn btn-success">Submit</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
