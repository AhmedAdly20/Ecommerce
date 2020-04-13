<?php

namespace App\Listeners;

use App\Coupon;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Jobs\UpdateCoupon;

class CartUpdatedlistener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $couponName = session()->get('coupon')['name'];

        if($couponName){
            $coupon = Coupon::where('code', $couponName)->first();
    
            dispatch_now(new UpdateCoupon($coupon));
        }
    }
}
