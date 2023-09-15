<?php
namespace App\Services;

use App\Models\Order;
use App\Models\WebsiteSetting;
use Illuminate\Support\Facades\App;

class InvoiceService{

    protected $savePath = 'storage/invoice/';

    public function getInvoice(int $orderId, string $status = 'download') : object | string
    {
        $data['order'] = Order::where('id', $orderId)
        ->with('products')
        ->first();
        $data['website_setting'] = WebsiteSetting::first();
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('frontend.user.orders.invoice', $data);

        if($status === 'download'){
            return $pdf->download($data['order']->invoice_id.'.pdf');
        }else{
            $fullPath = public_path($this->savePath. $data['order']->invoice_id.'.pdf');
            $pdf->render();
            file_put_contents($fullPath, $pdf->output());
            return $fullPath;
        }
    }
}


