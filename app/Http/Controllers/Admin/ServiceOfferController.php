<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceOffer;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Storage;

class ServiceOfferController extends Controller
{

    public function index($id = null)
    {
        $result['serviceOffers'] = ServiceOffer::get();
        if ($id != '') {
            $result['serviceOffer'] = DB::table('service_offers')->where('id', $id)->first();
        } else {
            $result['serviceOffer'] = '';
        }

        return view('admin.service-offer', $result);
    }
    public function post(Request $request)
    {

        try {
            // dd($request->all());
            $validator = Validator::make($request->all(), [
                'offer_title' => 'required|string',
                'offer_description' => 'required|string',
                'offer_image' => $request->input('id')
                    ? 'nullable|mimes:jpeg,png,jpg,gif,svg,webp,svg+xml'
                    : 'required|mimes:jpeg,png,jpg,gif,svg,webp,svg+xml',
                'button_text' => 'nullable|string',
                'button_link' => 'nullable|string',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }


            // Create or Update
            if ($request->input('id')) {
                $offer = ServiceOffer::find($request->input('id'));
                $msg = 'Service Offer updated successfully!';
            } else {
                $offer = new ServiceOffer();
                $msg = 'Service Offer created successfully!';
            }

            // Handle image
            if ($request->hasFile('offer_image')) {
                if (!empty($offer->offer_image)) {
                    $oldPath = 'offer/' . $offer->offer_image;
                    if (Storage::disk('public')->exists($oldPath)) {
                        Storage::disk('public')->delete($oldPath);
                    }
                }

                $image = $request->file('offer_image');
                $originalName = $image->getClientOriginalName();
                $filename = time() . '_' . $originalName;
                Storage::disk('public')->putFileAs('offer', $image, $filename);
                $offer->offer_image = $filename;
            }

            // Set attributes and save
            $offer->offer_title = $request->input('offer_title');
            $offer->offer_description = $request->input('offer_description');
            $offer->button_text = $request->input('button_text');
            $offer->button_link = $request->input('button_link');
            $offer->status = 'active';
            $offer->save();

            return redirect()->route('admin.service.offer')->with('success', $msg);
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        $offer = ServiceOffer::find($id);
        if ($offer) {
            // Delete the image from storage
            if (!empty($offer->offer_image)) {
                $oldPath = 'offer/' . $offer->offer_image;
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }

            // Delete the offer
            $offer->delete();
            return redirect()->route('admin.service.offer')->with('success', 'Service Offer deleted successfully!');
        } else {
            return redirect()->route('admin.service.offer')->with('error', 'Service Offer not found!');
        }
    }

    public function status($id)
    {
        $offer = ServiceOffer::find($id);
        if ($offer) {
            $offer->status = $offer->status == 'active' ? 'inactive' : 'active';
            $offer->save();
            return redirect()->route('admin.service.offer')->with('success', 'Service Offer status updated successfully!');
        } else {
            return redirect()->route('admin.service.offer')->with('error', 'Service Offer not found!');
        }
    }
}
