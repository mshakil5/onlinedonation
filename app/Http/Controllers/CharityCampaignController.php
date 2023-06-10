<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\FundraisingSource;
use App\Models\Campaign;
use App\Models\EmailContent;
use App\Mail\ContactFormMail;
use App\Mail\EventActiveMail;
use Carbon\Carbon;
use DB;
use Mail;
use App\Models\CampaignImage;
use App\Models\Comment;
use App\Models\User;
use App\Models\ContactMail;
use App\Models\Transaction;
use Illuminate\support\Facades\Auth;

class CharityCampaignController extends Controller
{
    public function startCharityCampaign($id)
    {
        
        $data = User::where('id',$id)->first();
        return view('user.startcharitycampaign', compact('data'));
    }
}
