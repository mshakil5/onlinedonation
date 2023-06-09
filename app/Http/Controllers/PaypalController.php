<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Omnipay\Omnipay;
use App\Models\Transaction;
use App\Models\Campaign;
use App\Models\EventTransaction;
use App\Models\TicketSale;
use App\Models\User;
use App\Models\Event;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use App\Mail\PaymentMail;
use App\Mail\EventPaymentMail;
use App\Mail\ContactFormMail;
use App\Models\EmailContent;
use Mail;
use App\Models\ContactMail;

class PaypalController extends Controller
{
    private $gateway;

    public function __construct() {
        $this->gateway = Omnipay::create('PayPal_Rest');
        $this->gateway->setClientId(env('PAYPAL_CLIENT_ID'));
        $this->gateway->setSecret(env('PAYPAL_CLIENT_SECRET'));
        $this->gateway->setTestMode(true);
    }

    public function pay(Request $request)
    {
        session(['event_id' => $request->event_id]);
        session(['paypalqty' => $request->paypalqty]);

        try {
            $response = $this->gateway->purchase(array(
                'amount' => $request->amount,
                'currency' => env('PAYPAL_CURRENCY'),
                'returnUrl' => url('success'),
                'cancelUrl' => url('error')
            ))->send();

            if ($response->isRedirect()) {
                $response->redirect();
            }
            else{
                return $response->getMessage();
            }

        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function success(Request $request)
    {
        if ($request->input('paymentId') && $request->input('PayerID')) {
            $transaction = $this->gateway->completePurchase(array(
                'payer_id' => $request->input('PayerID'),
                'transactionReference' => $request->input('paymentId')
            ));

            $event_id = session('event_id');
            $paypalqty = session('paypalqty');

            $request->session()->forget('event_id');
            $request->session()->forget('paypalqty');

            $response = $transaction->send();

            if ($response->isSuccessful()) {
                $arr = $response->getData();
                $amount = $arr['transactions'][0]['amount']['total'];

                $payment = new Payment();
                $payment->event_id = $event_id;
                $payment->payment_id = $arr['id'];
                $payment->payer_id = $arr['payer']['payer_info']['payer_id'];
                $payment->payer_email = $arr['payer']['payer_info']['email'];
                $payment->amount = $arr['transactions'][0]['amount']['total'];
                $payment->currency = env('PAYPAL_CURRENCY');
                $payment->payment_status = $arr['state'];
                $payment->save();

                $sales = new TicketSale();
                $sales->date = date('Y-m-d');
                $sales->tran_no = date('his');
                $sales->user_id = Auth::user()->id;
                $sales->event_id =  $event_id;
                $sales->commission = "00";
                $sales->amount = $amount;
                $sales->total_amount = $amount;
                $sales->quantity = $paypalqty;
                $sales->payment_type = "Paypal";
                $sales->user_notification = "0";
                $sales->admin_notification = "0";
                $sales->status = "0";
                $sales->save();

                $event = Event::find($event_id);
                $event->available = $event->available-$paypalqty;
                $event->sold = $event->sold+$paypalqty;
                $event->save();

                $stripetopup = new EventTransaction();
                $stripetopup->date = date('Y-m-d');
                $stripetopup->tran_no = date('his');
                $stripetopup->tran_type = "In";
                $stripetopup->user_id = Auth::user()->id;
                $stripetopup->event_id = $event_id;
                $stripetopup->commission = "0";
                $stripetopup->amount = $amount;
                $stripetopup->total_amount = $amount;
                $stripetopup->token = time();
                $stripetopup->description = "Event Payment";
                $stripetopup->payment_type = "Paypal";
                $stripetopup->notification = "0";
                $stripetopup->status = "0";
                $stripetopup->save();

                
                $eventdetails = Event::where('id', $event_id)->first();
                $adminmail = ContactMail::where('id', 1)->first()->email;
                $contactmail = Auth::user()->email;
                $ccEmails = [$adminmail];
                $msg = EmailContent::where('title','=','event_payment_email_message')->first()->description;

                if ($sales->quantity = 1) {
                    $ticketname = "Single";
                } else if ($sales->quantity = 2) {
                    $ticketname = "Couple";
                } else {
                    $ticketname = "Family";
                }
                
                if (isset($msg)) {
                    $array['eventname'] = $eventdetails->title;
                    $array['start'] = $eventdetails->event_start_date;
                    $array['vanue'] = $eventdetails->venue_name;
                    $array['quantity'] = $paypalqty;
                    $array['amount'] =  $amount;
                    $array['tranNo'] = $stripetopup->tran_no;
                    $array['name'] = Auth::user()->name;
                    $array['email'] = Auth::user()->email;
                    $array['subject'] = "Event Booking Confirmation";
                    $array['message'] = $msg;
                    $array['contactmail'] = $contactmail;
        
                    $date = \Carbon\Carbon::parse($eventdetails->event_start_date)->isoFormat('MMM Do YYYY');
                    $time = \Carbon\Carbon::parse($eventdetails->event_start_date)->format('H:i:s');
        
                    $array['message'] = str_replace(
                        ['{{event_name}}','{{user_name}}','{{event_date}}','{{event_time}}','{{event_id}}','{{venue}}','{{price}}','{{booking_date}}','{{tran_no}}','{{ticket_name}}','{{amount}}','{{payment_type}}','{{title}}','{{house_number}}','{{road_name}}','{{town}}','{{postcode}}'],
                        [$eventdetails->title, Auth::user()->name,$date,$time,$eventdetails->id,$eventdetails->venue_name, $eventdetails->price, $stripetopup->date, $stripetopup->tran_no, $ticketname, $amount, $stripetopup->payment_type,$eventdetails->title,$eventdetails->house_number,$eventdetails->road_name,$eventdetails->town,$eventdetails->postcode],
                        $msg
                    );
                    Mail::to($contactmail)
                        ->cc($ccEmails)
                        ->send(new EventPaymentMail($array));
        
                }
                

                $tranid = $arr['id'];
                return view('frontend.paypalsuccess', compact('tranid'));

            }
            else{
                return $response->getMessage();
            }
        }
        else{
            return view('frontend.paypalerror');
        }
    }

    public function error()
    {
        return view('frontend.paypaldecline');  
        
    }


    // campaign payment function
    public function campaignpaymentpay(Request $request)
    {
        session(['campaign_id' => $request->campaign_id]);
        session(['paypalcommission' => $request->paypalcommission]);
        session(['paypaltips' => $request->paypaltips]);
        session(['pdisplayname' => $request->pdisplayname]);

        try {
            $response = $this->gateway->purchase(array(
                'amount' => $request->amount,
                'currency' => env('PAYPAL_CURRENCY'),
                'returnUrl' => url('campaign-success'),
                'cancelUrl' => url('campaign-error')
            ))->send();

            if ($response->isRedirect()) {
                $response->redirect();
            }
            else{
                return $response->getMessage();
            }

        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function campaignpaymentsuccess(Request $request)
    {
        if ($request->input('paymentId') && $request->input('PayerID')) {
            $transaction = $this->gateway->completePurchase(array(
                'payer_id' => $request->input('PayerID'),
                'transactionReference' => $request->input('paymentId')
            ));

            $campaign_id = session('campaign_id');
            $paypaltips = session('paypaltips');
            $paypalcommission = session('paypalcommission');
            $pdisplayname = session('pdisplayname');

            $request->session()->forget('campaign_id');
            $request->session()->forget('paypaltips');
            $request->session()->forget('paypalcommission');
            $request->session()->forget('pdisplayname');

            $response = $transaction->send();

            if ($response->isSuccessful()) {
                $arr = $response->getData();
                $amount = $arr['transactions'][0]['amount']['total'];

                $payment = new Payment();
                $payment->campaign_id = $campaign_id;
                $payment->payment_id = $arr['id'];
                $payment->payer_id = $arr['payer']['payer_info']['payer_id'];
                $payment->payer_email = $arr['payer']['payer_info']['email'];
                $payment->amount = $arr['transactions'][0]['amount']['total'];
                $payment->currency = env('PAYPAL_CURRENCY');
                $payment->payment_status = $arr['state'];
                $payment->save();


                $stripetopup = new Transaction();
                $stripetopup->date = date('Y-m-d');
                $stripetopup->tran_no = date('his');
                $stripetopup->tran_type = "In";
                $stripetopup->user_id = Auth::user()->id;
                $stripetopup->campaign_id = $campaign_id;
                $stripetopup->commission = $paypalcommission;
                $stripetopup->tips_percent = "10";
                $stripetopup->tips = $paypaltips;
                $stripetopup->amount = $amount - $paypalcommission - $paypaltips;
                $stripetopup->total_amount = $amount;
                $stripetopup->token = time();
                if ($pdisplayname == "Kind Soul") {
                    $stripetopup->donation_display_name = "Kind Soul";
                    $stripetopup->show_name = "0";
                } else {
                    $stripetopup->donation_display_name = $pdisplayname;
                    $stripetopup->show_name = "1";
                }
                $stripetopup->donation_type = "Campaign";
                $stripetopup->description = "Donation";
                $stripetopup->payment_type = "Paypal";
                $stripetopup->notification = "0";
                $stripetopup->status = "0";
                $stripetopup->save();

                // fundraiser balance update
                    $fundraiser = User::find(Auth::user()->id);
                    $fundraiser->balance =  $fundraiser->balance + $amount - $paypalcommission - $paypaltips;
                    $fundraiser->save();
                // fundraiser balance update end

                // campaign total collection update
                    $campaign = Campaign::find($campaign_id);
                    $campaign->total_collection = $campaign->total_collection + $amount - $paypalcommission - $paypaltips;
                    $campaign->save();
                // campaign total collection update end

                $adminmail = ContactMail::where('id', 1)->first()->email;
                $contactmail = Auth::user()->email;
                $ccEmails = [$adminmail];
                // $msg = "Campaign Payment confirmation";
                $getcampaigndtl = Campaign::where('id',$campaign_id)->first();
                $msg = EmailContent::where('title','=','campaign_donation_email_message')->first()->description;
                if (isset($msg)) {
                    $array['name'] = Auth::user()->name;
                    $array['email'] = Auth::user()->email;
                    $array['subject'] = "Campaign Payment confirmation";
                    $array['message'] = $msg;
                    $array['contactmail'] = $contactmail;

                    $array['message'] = str_replace(
                        ['{{title}}','{{user_name}}','{{date}}','{{amount}}','{{payment_method}}'],
                        [$getcampaigndtl->title, Auth::user()->name,$stripetopup->date,$amount,$stripetopup->payment_type],
                        $msg
                    );
                    Mail::to($contactmail)
                        ->cc($ccEmails)
                        ->send(new EventPaymentMail($array));

                }
                

                $tranid = $arr['id'];
                return view('frontend.paypalsuccess', compact('tranid'));

            }
            else{
                return $response->getMessage();
            }
        }
        else{
            return view('frontend.paypalerror');
        }
    }

    public function campaignpaymenterror()
    { 
        
        return view('frontend.paypaldecline');  
    }


    // charity payment function
    public function charitypaymentpay(Request $request)
    {
        session(['charity_id' => $request->charity_id]);
        session(['paypalcommission' => $request->paypalcommission]);

        try {
            $response = $this->gateway->purchase(array(
                'amount' => $request->amount,
                'currency' => env('PAYPAL_CURRENCY'),
                'returnUrl' => url('campaign-success'),
                'cancelUrl' => url('campaign-error')
            ))->send();

            if ($response->isRedirect()) {
                $response->redirect();
            }
            else{
                return $response->getMessage();
            }

        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function charitypaymentsuccess(Request $request)
    {
        if ($request->input('paymentId') && $request->input('PayerID')) {
            $transaction = $this->gateway->completePurchase(array(
                'payer_id' => $request->input('PayerID'),
                'transactionReference' => $request->input('paymentId')
            ));

            $charity_id = session('charity_id');
            $paypalcommission = session('paypalcommission');

            $request->session()->forget('charity_id');
            $request->session()->forget('paypalcommission');

            $response = $transaction->send();

            if ($response->isSuccessful()) {
                $arr = $response->getData();
                $amount = $arr['transactions'][0]['amount']['total'];

                $payment = new Payment();
                $payment->charity_id = $charity_id;
                $payment->payment_id = $arr['id'];
                $payment->payer_id = $arr['payer']['payer_info']['payer_id'];
                $payment->payer_email = $arr['payer']['payer_info']['email'];
                $payment->amount = $arr['transactions'][0]['amount']['total'];
                $payment->currency = env('PAYPAL_CURRENCY');
                $payment->payment_status = $arr['state'];
                $payment->save();


                $stripetopup = new Transaction();
                $stripetopup->date = date('Y-m-d');
                $stripetopup->tran_no = date('his');
                $stripetopup->tran_type = "In";
                $stripetopup->user_id = Auth::user()->id;
                $stripetopup->charity_id = $charity_id;
                $stripetopup->commission = $paypalcommission;
                $stripetopup->amount = $amount - $paypalcommission;
                $stripetopup->total_amount = $amount;
                $stripetopup->token = time();
                $stripetopup->donation_type = "Charity";
                $stripetopup->description = "Charity Donation";
                $stripetopup->payment_type = "Paypal";
                $stripetopup->notification = "0";
                $stripetopup->status = "0";
                $stripetopup->save();

                // charity balance update
                    $fundraiser = User::find($charity_id);
                    $fundraiser->balance =  $fundraiser->balance + $amount - $paypalcommission;
                    $fundraiser->save();
                // charity balance update end


                $adminmail = ContactMail::where('id', 1)->first()->email;
                $contactmail = Auth::user()->email;
                $ccEmails = [$adminmail];
                
                $getcharitydtl = User::where('id',$charity_id)->first();
                $msg = EmailContent::where('title','=','charity_donation_email_message')->first()->description;
                if (isset($msg)) {
                    $array['name'] = Auth::user()->name;
                    $array['email'] = Auth::user()->email;
                    $array['subject'] = "Charity Payment confirmation";
                    $array['message'] = $msg;
                    $array['contactmail'] = $contactmail;

                    $array['message'] = str_replace(
                        ['{{title}}','{{user_name}}','{{date}}','{{amount}}','{{payment_method}}'],
                        [$getcharitydtl->name, Auth::user()->r_name,$stripetopup->date,$amount,$stripetopup->payment_type],
                        $msg
                    );
                    Mail::to($contactmail)
                        ->cc($ccEmails)
                        ->send(new EventPaymentMail($array));

                }
                

                $tranid = $arr['id'];
                return view('frontend.paypalsuccess', compact('tranid'));

            }
            else{
                return $response->getMessage();
            }
        }
        else{
            return view('frontend.paypalerror');
        }
    }

    public function charitypaymenterror()
    { 
        
        return view('frontend.paypaldecline');  
    }
}
