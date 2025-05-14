<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Services;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ServicesController extends Controller
{
    public function index($id = null)
    {
        $result['services'] = DB::table('services')->get();
        if ($id != '') {
            $result['service'] = DB::table('services')->where('id', $id)->first();
        } else {
            $result['service'] = '';
        }
        return view('admin.services.index', $result);
    }

    public function post(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'servicename' => 'required|string|max:255|unique:services,name,' . $req->input('id'),
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        // Create or Update
        if ($req->input('id')) {
            $service = Services::find($req->input('id'));
            $msg = 'Service updated successfully!';
        } else {
            $service = new Services();
            $msg = 'Service created successfully!';
        }
        $service->name = $req->input('servicename');
        $service->slug = generateUniqueSlug($req->input('servicename'), Services::class);
        $service->status = 'active';
        $service->save();


        return redirect()->route('admin.services')->with('success', $msg);
    }

    public function delete($id)
    {
        $service = Services::find($id);
        if ($service) {
            $service->delete();
            return redirect()->route('admin.services')->with('success', 'Service deleted successfully!');
        } else {
            return redirect()->route('admin.services')->with('error', 'Service not found!');
        }
    }

    public function status($id, $status)
    {
        $service = Services::find($id);
        if ($service) {
            $service->status = $status;
            $service->save();
            return redirect()->route('admin.services')->with('success', 'Service status updated successfully!');
        } else {
            return redirect()->route('admin.services')->with('error', 'Service not found!');
        }
    }
}


function generateUniqueSlug($name, $model, $column = 'slug')
{
    $slug = Str::slug($name);
    $originalSlug = $slug;
    $counter = 1;

    while ($model::where($column, $slug)->exists()) {
        $slug = $originalSlug . '-' . $counter;
        $counter++;
    }

    return $slug;
}
