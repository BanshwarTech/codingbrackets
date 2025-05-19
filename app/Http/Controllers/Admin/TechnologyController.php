<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Technology;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Storage;

class TechnologyController extends Controller
{
    public function index($id = null)
    {
        $result['technologies'] = Technology::get();
        if ($id != '') {
            $result['technology'] = DB::table('technologies')->where('id', $id)->first();
        } else {
            $result['technology'] = '';
        }
        return view('admin.technology', $result);
    }

    public function post(Request $req)
    {
        // dd($req);
        $validator = Validator::make($req->all(), [
            'name' => 'required|string',
            'image' => $req->input('id') ? 'nullable|mimes:jpeg,png,jpg,gif,svg,webp,svg+xml' : 'required|mimes:jpeg,png,jpg,gif,svg,webp,svg+xml',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $baseSlug = Str::slug($req->input('name'));
        $slug = $baseSlug;
        $count = 1;

        while (Technology::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $count;
            $count++;
        }

        // Create or Update
        if ($req->input('id')) {
            $technology = Technology::find($req->input('id'));
            $msg = 'Technology updated successfully!';
        } else {
            $technology = new Technology();
            $technology->slug = $slug;
            $msg = 'Technology created successfully!';
        }


        // Handle image
        if ($req->hasFile('image')) {
            // Delete old image from storage if it exists
            if (!empty($technology->image)) {
                $oldPath = 'tech/' . $technology->image;
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }

            $image = $req->file('image');
            $originalName = $image->getClientOriginalName();
            $filename = time() . '_' . $originalName;
            Storage::disk('public')->putFileAs('tech', $image, $filename);
            $technology->image = $filename;
        }


        // Save data
        $technology->name = $req->input('name');

        $technology->status = 'active';
        // dd($technology);
        $technology->save();

        return redirect()->route('admin.technology')->with('success', $msg);
    }

    public function delete($id)
    {
        $technology = Technology::find($id);
        if ($technology) {
            // Delete image from storage
            if (!empty($technology->image)) {
                $oldPath = 'tech/' . $technology->image;
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }

            $technology->delete();
            return redirect()->route('admin.technology')->with('success', 'Technology deleted successfully!');
        } else {
            return redirect()->route('admin.technology')->with('error', 'Technology not found!');
        }
    }
    public function status($id)
    {
        $technology = Technology::find($id);
        if ($technology) {
            $technology->status = $technology->status == 'active' ? 'inactive' : 'active';
            $technology->save();
            return redirect()->route('admin.technology')->with('success', 'Technology status updated successfully!');
        } else {
            return redirect()->route('admin.technology')->with('error', 'Technology not found!');
        }
    }
}
