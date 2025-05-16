<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WebsiteType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class WebsiteController extends Controller
{
    public function index($id = null)
    {
        $result['website_types'] = DB::table('website_types')->get();
        if ($id != '') {
            $result['website_type'] = DB::table('website_types')->where('id', $id)->first();
        } else {
            $result['website_type'] = '';
        }
        return view('admin.website', $result);
    }

    public function post(Request $req)
    {
        // dd($req);
        $validator = Validator::make($req->all(), [
            'website_type' => 'required|string',
            'description' => 'nullable|string',
            'icon' => $req->input('id') ? 'nullable|mimes:jpeg,png,jpg,gif,svg,webp,svg+xml' : 'required|mimes:jpeg,png,jpg,gif,svg,webp,svg+xml',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        // Create or Update
        if ($req->input('id')) {
            $serviceContent = WebsiteType::find($req->input('id'));
            $msg = 'Website type updated successfully!';
        } else {
            $serviceContent = new WebsiteType();
            $msg = 'Website type created successfully!';
        }

        // Handle image
        if ($req->hasFile('icon')) {
            if (!empty($serviceContent->icon)) {
                $oldPath = 'public/icon/' .  $serviceContent->icon;
                if (Storage::exists($oldPath)) {
                    Storage::delete($oldPath);
                }
            }

            $icon = $req->file('icon');
            $icon_name = time() . '.' . $icon->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('icon/', $icon, $icon_name);
            $serviceContent->icon = $icon_name;
        }

        $serviceContent->name = $req->input('website_type');
        $serviceContent->description = $req->input('description');
        $serviceContent->status = 'active';
        $serviceContent->save();

        return redirect()->route('admin.website')->with('success', $msg);
    }
    public function delete($id)
    {
        $serviceContent = WebsiteType::find($id);
        if ($serviceContent) {
            $oldPath = 'public/icon/' .  $serviceContent->icon;
            if (Storage::exists($oldPath)) {
                Storage::delete($oldPath);
            }
            $serviceContent->delete();
            return redirect()->route('admin.website')->with('success', 'Website type deleted successfully!');
        } else {
            return redirect()->route('admin.website')->with('error', 'Website type not found!');
        }
    }
    public function status($id)
    {
        $serviceContent = WebsiteType::find($id);
        if ($serviceContent) {
            $serviceContent->status = $serviceContent->status == 'active' ? 'inactive' : 'active';
            $serviceContent->save();
            return redirect()->route('admin.website')->with('success', 'Website type status updated successfully!');
        } else {
            return redirect()->route('admin.website')->with('error', 'Website type not found!');
        }
    }
}
