<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Faq;
use App\Models\Subscribe;
use App\Models\WebsitePolicy;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function subscribe(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
        ]);

        if(Subscribe::where('email', $request->email)->first()){
            return response()->json(['success' => false, 'message' => 'You have already subscribed']);
        }
        Subscribe::create($request->all());
        return response()->json(['success' => true, 'message' => 'Thank You. You have subscribed to our newsletter']);
    }

    public function aboutUs()
    {
        return view('frontend.about-us.index');
    }

    public function contactUs()
    {
        return view('frontend.contact-us.index');
    }

    public function saveContactMsg(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'phone' => 'required|max:255',
            'email' =>'required|email|max:255',
            'subject' =>'required',
            'message' =>'required',
        ]);

        Contact::create($request->all());
        return redirect()->back()->with('success', 'Message has been sent successfully');
    }

    public function faq()
    {
        $data['item'] = Faq::latest()->get();
        return view('frontend.faq.index', $data);
    }

    public function privacyPolicy()
    {
        $data['tab'] = 'Privacy Policy';
        $data['item'] = WebsitePolicy::pluck('privacy_policy')->first();
        return view('frontend.policies.index', $data);
    }
    public function termsCondition()
    {
        $data['tab'] = 'Terms and Conditions';
        $data['item'] = WebsitePolicy::pluck('terms_conditions')->first();
        return view('frontend.policies.index', $data);
    }
    public function cookiePolicy()
    {
        $data['tab'] = 'Cookie Policy';
        $data['item'] = WebsitePolicy::pluck('cookies_policy')->first();
        return view('frontend.policies.index', $data);
    }
    public function returnPolicy()
    {
        $data['tab'] = 'Return Policy';
        $data['item'] = WebsitePolicy::pluck('return_policy')->first();
        return view('frontend.policies.index', $data);

    }
    public function disclaimer()
    {
        $data['tab'] = 'Disclaimer';
        $data['item'] = WebsitePolicy::pluck('disclaimer')->first();
        return view('frontend.policies.index', $data);

    }

}
