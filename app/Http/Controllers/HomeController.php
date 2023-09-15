<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use App\Models\UserShipping;
use App\Models\WebsiteSetting;
use App\Services\InvoiceService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['account_info'] = User::findOrFail(Auth::guard('web')->user()->id);
        $data['shipping_info'] = UserShipping::where('user_id',Auth::guard('web')->user()->id)->first();
        $data['orders'] = Order::where('user_id', Auth::guard('web')->user()->id)->latest()->paginate(15);
        $data['total_buyed'] = Order::where('user_id', Auth::guard('web')->user()->id)
            ->sum('grand_total');
        $data['pending_order'] = Order::where('user_id', Auth::guard('web')->user()->id)
            ->where('order_status', '1')
            ->count();
        $data['confirm_order'] = Order::where('user_id', Auth::guard('web')->user()->id)
            ->where('order_status', '2')
            ->count();
        $data['delivered_order'] = Order::where('user_id', Auth::guard('web')->user()->id)
            ->where('order_status', '3')
            ->count();
        $data['cancel_order'] = Order::where('user_id', Auth::guard('web')->user()->id)
            ->where('order_status', '4')
            ->count();

        return view('home', $data);
    }

    public function userOrder(Request $request, $id)
    {
        $data['order'] = Order::where('id', $id)
            ->where('user_id', Auth::guard('web')->user()->id)
            ->with('products')
            ->first();
        $data['website_setting'] = WebsiteSetting::first();
        return view('frontend.user.orders.view-order', $data);
    }

    public function invoice(InvoiceService $invoice, Request $request, $id)
    {
        return $invoice->getInvoice(orderId:$id);
    }

    public function printInvoice(Request $request, $id)
    {
        $data['order'] = Order::where('id', $id)
            ->where('user_id', Auth::guard('web')->user()->id)
            ->with('products')
            ->first();
        $data['website_setting'] = WebsiteSetting::first();
        return view('frontend.user.orders.print-invoice', $data);
    }


    public function updateProfile(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'phone' => 'required',
            'email' =>'required|email|unique:users,email,' . Auth::guard('web')->user()->id
        ]);
        $user = User::findOrFail(Auth::guard('web')->user()->id);
        $user->name = $request->first_name ?? $user->name;
        $user->last_name = $request->last_name ?? $user->last_name;
        $user->email = $request->email ?? $user->email;
        $user->address = $request->address ?? $user->address;
        $user->phone = $request->phone ?? $user->phone;
        $user->save();
        return redirect()->back()->with('success','Account Updated Successfully');
    }

    public function updateShipping(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' =>'required|email',
            'country' =>'required',
            'city' =>'required',
            'state' =>'required',
            'zip' =>'required',
            'phone' =>'required',
            'address_1' =>'required',
        ]);

        $shipping = UserShipping::where('user_id',Auth::guard('web')->user()->id)->first();
        $request['user_id'] = Auth::guard('web')->user()->id;
        $shipping ? $shipping->fill($request->all())->save() : UserShipping::create($request->all());
        return redirect()->back()->with('success','Shipping Updated Successfully');
    }
    public function changePassword(Request $request)
    {
        $this->validate($request, [
            'current_password' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::find(Auth::guard('web')->user()->id);
        if(Hash::check($request->current_password, $user->password)){
            $user->password = Hash::make($request->password);
            $user->save();
            return redirect()->back()->with('success','Password has been changed successfully');
        }
        return redirect()->back()->with('change_pass_error','Current password does not match');
    }


}
