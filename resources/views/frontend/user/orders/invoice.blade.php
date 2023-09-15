<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Invoice</title>

		<style>
			.invoice-box {
				font-size: 14px;
				line-height: 24px;
				font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
			}
			.invoice-box table {
				width: 100%;
				line-height: inherit;
				text-align: left;
			}

			.invoice-box table td {
				padding: 5px;
				vertical-align: top;
			}

			.invoice-box table tr td:nth-child(2) {
				text-align: right;
			}

			.invoice-box table tr.top table td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.top table td.title {
				font-size: 45px;
				line-height: 45px;
				color: #333;
			}

			.invoice-box table tr.information table td {
				padding-bottom: 40px;
			}

			.invoice-box table tr.heading td {
				background: #eee;
				border-bottom: 1px solid #ddd;
				font-weight: bold;
			}

			.invoice-box table tr.details td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.item td {
				border-bottom: 1px solid #eee;
			}

			.invoice-box table tr.item.last td {
				border-bottom: none;
			}

			.invoice-box table tr.total td:nth-child(2) {
				border-top: 2px solid #eee;
				font-weight: bold;
			}

			@media only screen and (max-width: 600px) {
				.invoice-box table tr.top table td {
					width: 100%;
					display: block;
					text-align: center;
				}

				.invoice-box table tr.information table td {
					width: 100%;
					display: block;
					text-align: center;
				}
			}
            .item-center{
                text-align: center !important;
            }
		</style>
	</head>

	<body>
		<div class="invoice-box">
			<table cellpadding="0" cellspacing="0">
				<tr class="top">
					<td colspan="5">
						<table>
							<tr>
								<td class="title" width="20px">
									<img src="{{ public_path('logo.png') }}" style="" />
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
	</body>
</html>
