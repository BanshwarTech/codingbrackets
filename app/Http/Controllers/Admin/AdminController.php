<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminLogin;
use App\Models\OurTeam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function login()
    {
        return view(view: 'admin.login');
    }

    public function loginPost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $admin = AdminLogin::where('useremail', $request->email)->first();

        if (!$admin) {
            return back()->withErrors([
                'email' => 'Email not found.',
            ])->withInput();
        }

        if (!Hash::check($request->password, $admin->password)) {
            return back()->withErrors([
                'password' => 'Incorrect password.',
            ])->withInput();
        }

        // Set session data
        $request->session()->put('ADMIN_LOGIN', true);
        $request->session()->put('ADMIN_ID', $admin->id);
        $request->session()->put('ADMIN_NAME', $admin->username);
        $request->session()->put('ADMIN_EMAIL', $admin->useremail);
        $request->session()->put('ADMIN_PROFILE', $admin->profile);
        $request->session()->put('IS_ADMIN', $admin->is_admin);

        // dd($admin->is_admin);
        if ($admin->is_admin == 1) {
            return redirect()->route('admin.dashboard')->with('success', 'Login successful!');
        } else {
            return redirect()->route('admin.login')->with('error', 'You are not authorized to access admin panel.');
        }
    }


    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function logout(Request $request)
    {
        $request->session()->forget([
            'ADMIN_LOGIN',
            'ADMIN_ID',
            'ADMIN_NAME',
            'ADMIN_EMAIL',
            'IS_ADMIN'
        ]);
        return redirect()->route('admin.login')->with('success', 'Logged out successfully.');
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
            'profile_image' => $req->input('id') ? 'nullable|mimes:jpeg,png,jpg,gif,svg,webp,svg+xml' : 'required|mimes:jpeg,png,jpg,gif,svg,webp,svg+xml',
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
    public function deleteTeamMember($id)
    {
        $team = OurTeam::find($id);
        if ($team) {
            if (!empty($team->profile_image)) {
                $oldPath = 'public/our-team/' . $team->profile_image;
                if (Storage::exists($oldPath)) {
                    Storage::delete($oldPath);
                }
            }
            $team->delete();
            return redirect()->route('admin.ourTeam')->with('success', 'Our Team deleted successfully!');
        } else {
            return redirect()->route('admin.ourTeam')->with('error', 'Our Team not found!');
        }
    }
    public function statusTeamMember($id)
    {
        $team = OurTeam::find($id);
        if ($team) {
            $team->status = $team->status == 'active' ? 'inactive' : 'active';
            $team->save();
            return redirect()->route('admin.ourTeam')->with('success', 'Our Team status updated successfully!');
        } else {
            return redirect()->route('admin.ourTeam')->with('error', 'Our Team not found!');
        }
    }
}
