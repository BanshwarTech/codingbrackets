<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ServicesContentController extends Controller
{
    public function manage()
    {

        $result['services_content'] = DB::table('service_contents')->get();
        return view('admin.services.service-content', $result);
    }

    public function manageContent($id = null)
    {
        $result['service'] = DB::table('services')->where('status', 'active')->get();
        $result['services_content'] = DB::table('service_contents')->where('id', $id)->first();
        return view('admin.services.service-content-manage', $result);
    }

    public function manageContentPost(Request $req)
    {
        // dd($req->all());
        // Validation
        $validator = Validator::make($req->all(), [
            'service_id' => 'required|exists:services,id',
            'title' => 'required|string|max:255',
            'short_heading' => 'required|string',
            'main_heading' => 'required|string',
            'main_content' => 'required|string',
            'features_heading' => 'required|string',
            'features' => 'required|string',
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $slug = Str::slug($req->input('title')) . '-' . uniqid();
        // Create or Update
        if ($req->input('id')) {
            $serviceContent = ServiceContent::find($req->input('id'));
            $msg = 'Service content updated successfully!';
        } else {
            $serviceContent = new ServiceContent();
            $serviceContent->slug =  $slug;
            $msg = 'Service content created successfully!';
        }

        $serviceContent->service_id = $req->input('service_id');
        $serviceContent->title = $req->input('title');


        $serviceContent->short_heading = $req->input('short_heading');
        $serviceContent->main_heading = $req->input('main_heading');
        $serviceContent->main_content = $req->input('main_content');
        $serviceContent->features_heading = $req->input('features_heading');
        $serviceContent->features = $req->input('features');
        $serviceContent->status = 'active';
        $serviceContent->save();
        return redirect()->route('admin.services.content')->with('success', $msg);
    }
}
