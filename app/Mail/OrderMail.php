<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Order;
use App\Models\Order_item;
use Webklex\IMAP\Client;

class OrderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->id = $data;

        $this->info_cus = Order::find($data);
        $this->info_cart = Order_item::where('order_id',$data)->get();
        $this->data = [
            'info_cus' => $this->info_cus,
            'info_cart' => $this->info_cart,
        ];
    }
    public function build()
    {
        return $this->view('mails.order')->from(\env('MAIL_USERNAME') , 'IT24H')->subject("[IT24H] Thông tin đơn hàng #{$this->id}")
            ->with($this->data);
    }
}
