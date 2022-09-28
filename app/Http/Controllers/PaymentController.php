<?php

namespace App\Http\Controllers;

use App\Auction;
use App\Bid;
use App\Events\BidAcceptedNotification;
use App\Events\BookingConfirmation;
use App\Extra;
use Cartalyst\Stripe\Exception\CardErrorException;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\Resource;
use App\Mail\RequestPaymentLink;
use Mail;
use App\Coupon;
use Twilio\Rest\Client;

class PaymentController extends Controller
{
    public function index(){

    }

    public function requestPayment(Request $request)
    {
        // dd($msg = $request->all());
        // $msg = $request->all();

        $msg = request([
            'auction_id',
            'auction_type',
            'full_name',
            'phone',
            'email',
            'currency',
            'total_auction'
        ]);

        // dd($msg);

        Mail::to('info@luefty.com')->send(new RequestPaymentLink($msg));

        return back()->with('info', __('You will receive an email from info@luefty.com with a secure payment link. Please check your in box and spam.') );
    }


    public function stripePayment(Request $request){
        // dd($request->all());
        $auctionId = $request->auctionid;

        $auction = Auction::findOrFail($auctionId);

        $percentage = $auction->servicePrice->starting_bid * 0.10;

        $extras_total = Extra::where('auction_id', $auction->id)->sum('total');

        $total = $auction->order_total + $extras_total - $auction->discount;
        // if ($auction->category_id == 7){
        // }else {
        //     $total = $auction->servicePrice->starting_bid + $percentage + $extras_total;
        // }

        $bid = Bid::where('auction_id', $auction->id)->where('won', 1)->first();

        // dd($extras = Extra::where('auction_id', $auction->id)->get());
        if ($auction->country->currency == 'EUR')
        {
            $currency = 'EUR';
        }else{
            $currency = 'USD';
        }

        try {
            $charge = Stripe::charges()->create([
                'amount' => $total,
                'currency' => $currency,
                'source' => $request->stripeToken,
                'description' => 'Luefty Order: '.$auction->auction_id,
                'receipt_email' => $auction->email,
                'metadata' => [
                    // 'order_id' => $auction->auction_id,
                    // 'contents' => '',
                ],
            ]);
            // Success

            $auction->status = 'Open';
            $auction->paid_amount = $total;
            $auction->paid_date = \Carbon\Carbon::now();
            $auction->payment_method = 'Stripe';
            $auction->payment_status = 'Paid';

            $auction->save();

            // event(new BookingConfirmation($auction));
            // event(new BookingConfirmation($bid));
            
            // if (Bid::where('auction_id', $auction->id)->where('won', 1)->count())
            // {
            //     event(new BidAcceptedNotification($bid));
            // }

            // Coupon
            // $coupon = new Coupon();
            // $discount = $total * 0.05;
            // $coupon->auction_id = $auction->id;
            // $coupon->code = 'B' . $auction->id . 'D' . \Carbon\Carbon::now()->format('ym');;
            // $coupon->discount = $discount;
            // $coupon->expiration_date = \Carbon\Carbon::now()->addYears(1);
            // $coupon->status = 'Active';
            // $coupon->save();

            $from = $auction->fromcity->name;
            $to = $auction->tocity->name;
            $date = $auction->date . ',' . date('g:ia', strtotime($auction->arrival_time));
            $paid_amount = $auction->country->currency_symbol. number_format($total, 2, '.', ',');
            
            // WhatsApp notification
            // $sid = env("TWILIO_AUTH_SID");
            // $token = env("TWILIO_AUTH_TOKEN");
            // $twilio = new Client($sid, $token);
            // $message = $twilio->messages
            //     ->create("whatsapp:18493412723", // to
            //             [   
            //                 "from" => "whatsapp:+14155238886",
            //                 "body" => "https://luefty.com \n \Thanks for your payment! \nDetails: \nFrom *$from* to *$to* \n \n Date: *$date* \n \nAmount: *$paid_amount*",
            //             ]
            //     );

            return redirect()->route('confirmation.index')->with('success_message', 'Thank you! Your payment has been successfully accepted!');

        } catch (CardErrorException $e) {
            $auction->payment_status = 'Pending';
            $auction->save();

            return back()->withErrors('Error!' . $e->getMessage());
        }
    }
}
