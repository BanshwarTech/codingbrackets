<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OurTeam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function login()
    {
        return view(view: 'admin.login');
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function logout()
    {
        // Logic for logging out the admin
        return redirect()->route('admin.login');
    }
    public function ourTeam()
    {
        $result['teams'] = DB::table('our_teams')->get();
        return view('admin.our-team', $result);
    }
    public function manageTeamMember(Request $req, $id = null)
    {
        if ($id != '') {
            $result['team'] = DB::table('our_teams')->where('id', $id)->first();
        } else {
            $result['team'] = '';
        }
        return view('admin.manage-team-member', $result);
    }
    public function manageTeamMemberPost(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'profile_image' => $req->input('id') ? 'required|mimes:jpeg,png,jpg,gif,svg,webp,svg+xml' : 'nullable|mimes:jpeg,png,jpg,gif,svg,webp,svg+xml',
            'linkedin_url' => 'nullable|string|max:255',
            'twitter_url' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Create or Update
        if ($req->input('id')) {
            $team = OurTeam::find($req->input('id'));
            $msg = 'Our Team updated successfully!';
        } else {
            $team = new OurTeam();
            $msg = 'Our Team created successfully!';
        }

        // Handle profile_image
        if ($req->hasFile('profile_image')) {
            if (!empty($team->profile_image)) {
                $oldPath = 'public/our-team/' . $team->profile_image;
                if (Storage::exists($oldPath)) {
                    Storage::delete($oldPath);
                }
            }

            $profile_image = $req->file('profile_image');
            $profile_image_name = time() . '.' . $profile_image->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('our-team/', $profile_image, $profile_image_name);
            $team->profile_image = $profile_image_name;
        }

        // Set values
        $team->name = $req->input('name');
        $team->role = $req->input('role');
        $team->linkedin_url = $req->input('linkedin_url');
        $team->twitter_url = $req->input('twitter_url');
        $team->status = 'active';
        $team->save();

        return redirect()->route('admin.ourTeam')->with('success', $msg);
    }
}
