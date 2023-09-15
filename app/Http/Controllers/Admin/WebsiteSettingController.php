<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WebsitePolicy;
use App\Models\WebsiteSetting;
use App\Services\ImageService;
use Illuminate\Http\Request;

class WebsiteSettingController extends Controller
{
    public function index( Request $request )
    {
        $data['data'] = WebsiteSetting::first();
        return view('admin.website-setting.index', $data);
    }

    public function store( ImageService $image, Request $request)
    {
        $website = WebsiteSetting::first();
        if($request->has('logo')) {
            if($website && $website->website_logo) $image->delete($website->website_logo);
            $request['website_logo'] = $image->upload($request->logo, 'website_setting');
        }

        if($request->has('favicon')){
            if($website && $website->website_favicon) $image->delete($website->website_favicon);
            $request['website_favicon'] = $image->upload($request->favicon, 'website_setting');
        }

        if($request->has('banner')){
            if($website && $website->happy_customer_background_image) $image->delete($website->happy_customer_background_image);
            $request['happy_customer_background_image'] = $image->upload($request->banner, 'website_setting');
        }

        $website ? $website->fill($request->all())->save() : WebsiteSetting::create($request->all());
        return redirect()->back()->with('success', 'Setting Successfully Updated');

    }

    public function policies()
    {
        $data['data'] = WebsitePolicy::first();
        return view('admin.website-policy.index', $data);
    }

    public function policyStore(Request $request)
    {
        $website = WebsitePolicy::first();
        $website ? $website->fill($request->all())->save() : WebsitePolicy::create($request->all());
        return redirect()->back()->with('success', 'Policies Successfully Updated');
    }
}
