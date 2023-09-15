@extends('frontend.layout.app')

@section('title') Home @endsection
@section('style')
<link href="{{ asset('frontend_assets/assets/css/invoice.css')}}" rel="stylesheet">
@endsection

@section('content')
<!-- breadcrumb area start -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb-wrap">
                    <nav aria-label="breadcrumb">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}?tab=orders">Orders</a></li>
                            <li class="breadcrumb-item active" aria-current="page">View</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb area end -->
 <!-- login register wrapper start -->
 <div class="login-register-wrapper mb-5" >
    <div class="container">
        <div class="member-area-from-wrap">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="row inv-heading">
                        <div class="col-md-6"><h4>{{ $website_setting->website_name }}</h4></div>
                        <div class="col-md-6 text-right">
                            <a href="{{ route('user.order.download', $order->id) }}" class="btn btn-info">Download Invoice</a>
                            <a href="{{ route('user.order.print', $order->id) }}" class="btn btn-success">Print Invoice</a>
                        </div>
                    </div>
                    <div class="invoice-box" id="printableArea">
                        <table cellpadding="0" cellspacing="0">
                            <tr class="top">
                                <td colspan="5">
                                    <table>
                                        <tr>
                                            <td class="title" width="150px">
                                                <img src="{{ ImageViewer::show($website_setting->website_logo) }}" style="" />
                                            </td>

                                            <td>
                                                Invoice No: {{ $order->invoice_id }}<br />
                                                Created: {{ date('M d Y', strtotime($order->created_at)) }}<br />
                                                Order Status: {{ Str::OrderStatus($order->order_status) }}<br />
                                                Payment Status: {{ Str::PaymentStatus($order->payment_status) }}<br />
                                                Payment Method: {{ Str::PaymentMethod($order->payment_method) }}<br />
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>

                            <tr class="information">
                                <td colspan="5">
                                    <table>
                                        <tr>
                                            <td>
                                                <h4>From</h4>
                                                @if($website_setting->website_name){{ $website_setting->website_name }}<br />@endif
                                                @if($website_setting->website_email){{ $website_setting->website_email }}<br />@endif
                                                @if($website_setting->website_phone){{ $website_setting->website_phone }}<br />@endif
                                                @if($website_setting->website_address){{ $website_setting->website_address }}@endif
                                            </td>

                                            <td>
                                                <h4>To</h4>
                                                @if($order->first_name){{ $order->first_name }} {{ $order->last_name }}<br />@endif
                                                @if($order->email){{ $order->email }}<br />@endif
                                                @if($order->phone){{ $order->phone }}<br />@endif
                                                @if($order->address_2)Address 1: {{ $order->address_1 }}<br />Address 2: {{ $order->address_2 }}<br />@endif
                                                @if($order->address_2 == ''){{ $order->address_1 }}@endif
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>

                            <tr class="heading">
                                <td>Product</td>
                                <td style="text-align: center">Qty</td>
                                <td style="text-align: center">Price</td>
                                <td style="text-align: center">Shipping</td>
                                <td style="text-align: center">Total</td>
                            </tr>
                            @php $subTotal = 0; @endphp


                            @foreach ($order->products as $item)
                                <tr class="item">
                                    <td>{{ $item->prduct_name }}</td>
                                    <td style="text-align: center">{{ $item->qty }}</td>
                                    <td style="text-align: center">
                                        ${{ $item->discounted_price }}
                                        @if($item->discount > 0)
                                            {{ $item->discount_type == 1 ? '(-'.$item->discount.'% Applied)' :  '(-$'.$item->discount.' Applied)' }}
                                        @endif
                                    </td>
                                    <td style="text-align: center">
                                        {{ $item->is_free == 1 ? 'Free Shipping' : '$'.$item->total_shipping_price }}
                                    </td>
                                    <td style="text-align: center">${{ $item->grand_total }}</td>
                                </tr>
                                @php $subTotal += $item->grand_total; @endphp
                            @endforeach

                            @if($order->coupon_amount)
                                <tr class="total">
                                    <td colspan="5" style="text-align: right">Coupon Amount: - ${{ $order->coupon_amount }}</td>
                                </tr>
                            @endif

                            @if($order->extra_amount)
                                <tr class="total">
                                    <td colspan="5" style="text-align: right">Aditionl Charge: ${{ $order->extra_amount }}</td>
                                </tr>
                            @endif
                            <tr class="total">
                                <td colspan="5" style="text-align: right">Sub Total: ${{ $subTotal }}</td>
                            </tr>
                            <tr class="total">
                                <td colspan="5" style="text-align: right">Grand Total: ${{ $order->grand_total + $order->extra_amount }}</td>
                            </tr>
                        </table>
                        <br/>
                        @if($order->extra_amount_note)
                            {!! $order->extra_amount_note !!}
                        @endif

                        {!! $website_setting->invoice_aditional !!}
                    </div>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
    </div>
</div>
<!-- login register wrapper end -->

@endsection


@section('script')

@endsection

