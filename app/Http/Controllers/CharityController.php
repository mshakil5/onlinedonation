<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Country;
use App\Models\ContactMail;
use App\Models\GivingLevel;
use App\Models\EmailContent;
use App\Models\Transaction;
use App\Mail\EventActiveMail;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CharityController extends Controller
{
    public function charity()
    {
        $countries = Country::select('id', 'name')->get();
        return view('auth.charityregister', compact('countries'));
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'country' => 'required',
            'r_name' => 'required',
            'r_position' => 'required',
            'phone' => 'required',
            'r_phone' => 'required',
            'password' => ['required','min:6'],
            'confirm_password' => 'required|same:password',
        ]);
    }
    
    public function create(array $data)
    {
        // dd("controller");
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'country' => $data['country'],
            'r_name' => $data['r_name'],
            'r_position' => $data['r_position'],
            'r_phone' => $data['r_phone'],
            'phone' => $data['phone'],
            'postcode' => $data['postcode'],
            'is_type' => '2',
        ]);
    }

    public function charityregistration(Request $request)
    {

        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => 'required',
            'password' => ['required','min:6'],
            'confirm_password' => 'required|same:password',
        ]);
        
        $data = new User();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->country = $request->country;
        $data->r_phone = $request->r_phone;
        $data->r_position = $request->r_position;
        $data->r_name = $request->r_name;
        $data->phone = $request->phone;
        $data->password = Hash::make($request->password);
        if(isset($request->bank_statement)){
            $rand = mt_rand(100000, 999999);
            $imageName = time(). $rand .'.'.$request->bank_statement->extension();
            $request->bank_statement->move(public_path('images'), $imageName);
            $data->bank_statement= $imageName;
        }
        $data->is_type = '2';
        $data->status = '0';
        $data->save();
        // return redirect()->route('login');
        return redirect()->route('login')->with('message', "Charity Registration Successful. Please Login"); 
    }

    public function getCharityByAdmin()
    {
        $countries = Country::select('id', 'name')->get();
        $data = User::where('is_type','2')->get();
        return view('admin.charity.charity', compact('countries','data'));
    }

    public function getCharityBalanceByAdmin()
    {
        $countries = Country::select('id', 'name')->get();
        $data = User::where('is_type','2')->where('balance','>', 0)->get();
        return view('admin.charity.charity', compact('countries','data'));
    }

    public function newCharitystore(Request $request)
    {
        
        if(empty($request->email)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Email \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }
        if(empty($request->phone)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Phone \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }
        if(empty($request->password)){            
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Password\" field..!</b></div>"; 
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }
        if(isset($request->password) && ($request->password != $request->confirm_password)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Password doesn't match.</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }
        $chkemail = User::where('email',$request->email)->first();
        if($chkemail){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>This email already added.</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }
        $data = new User;
        $data->name = $request->name;
        $data->country = $request->country;
        $data->phone = $request->phone;
        $data->email = $request->email;
        $data->r_phone = $request->r_phone;
        $data->r_position = $request->r_position;
        $data->r_name = $request->r_name;
        $data->is_type = '2';
        if(isset($request->password)){
            $data->password = Hash::make($request->password);
        }
        if ($data->save()) {
            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Data Create Successfully.</b></div>";
            return response()->json(['status'=> 300,'message'=>$message]);
        }else{
            return response()->json(['status'=> 303,'message'=>'Server Error!!']);
        }
    }

    public function newCharityedit($id)
    {
        $where = [
            'id'=>$id
        ];
        $info = User::where($where)->get()->first();
        return response()->json($info);
    }

    public function newCharityupdate(Request $request)
    {

        
        if(empty($request->name)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Username \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }
        if(empty($request->email)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Email \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }
        if(empty($request->phone)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Phone \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }
        
        if(isset($request->password) && ($request->password != $request->confirm_password)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Password doesn't match.</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }

        $duplicateemail = User::where('email',$request->email)->where('id','!=', $request->codeid)->first();
        if($duplicateemail){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>This email already added.</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }
        $data = User::find($request->codeid);
        $data->name = $request->name;
        $data->sur_name = $request->surname;
        $data->phone = $request->phone;
        $data->email = $request->email;
        $data->house_number = $request->house_number;
        $data->street_name = $request->street_name;
        $data->town = $request->town;
        $data->postcode = $request->postcode;
        if(isset($request->password)){
            $data->password = Hash::make($request->password);
        }
        if ($data->save()) {
            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Data Updated Successfully.</b></div>";
            return response()->json(['status'=> 300,'message'=>$message]);
        }
        else{
            return response()->json(['status'=> 303,'message'=>'Server Error!!']);
        } 
    }

    public function newCharitydelete($id)
    {
        if(User::destroy($id)){
            return response()->json(['success'=>true,'message'=>'User has been deleted successfully']);
        }else{
            return response()->json(['success'=>false,'message'=>'Delete Failed']);
        }
    }

    public function activeDeactiveAccount(Request $request)
    {
        $charitydtl = User::where('id', $request->id)->first();
        $data = User::find($request->id);
        $data->status = $request->status;
        $data->save();

        if($request->status==1){
            $active = User::find($request->id);
            $active->status = $request->status;
            $active->save();


            $adminmail = ContactMail::where('id', 1)->first()->email;
            $contactmail = $charitydtl->email;
            $ccEmails = [$adminmail];
            $msg = EmailContent::where('title','=','Charity approval')->first()->description;

            
            $array['name'] = $charitydtl->name;
            $array['email'] = $charitydtl->email;
            $array['subject'] = "Congrats! We published your charity.";
            $array['message'] = $msg;
            $array['contactmail'] = $contactmail;

            $array['message'] = str_replace(
                ['{{r_name}}','{{user_name}}','{{phone}}','{{house_number}}','{{road_name}}','{{town}}','{{postcode}}'],
                [$charitydtl->r_name, $charitydtl->name,$charitydtl->phone,$charitydtl->house_number, $charitydtl->street_name, $charitydtl->town, $charitydtl->postcode],
                $msg
            );

            Mail::to($contactmail)
                // ->cc($ccEmails)
                ->send(new EventActiveMail($array));



            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Active Successfully.</b></div>";
            return response()->json(['status'=> 300,'message'=>$message]);
        }else{
            $deactive = User::find($request->id);
            $deactive->status = $request->status;
            $deactive->save();
            $message ="<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Inactive Successfully.</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
        }
    }

    public function charityDonate($id)
    {
        $data = User::where('id',$id)->first();
        $givinglvls = GivingLevel::all();
        // dd($givinglvls);
        return view('frontend.charitypayment', compact('data','givinglvls'));
    }

    public function viewTransactionCharityByAdmin($id)
    {
        $data = User::with('transaction')->where('id', $id)->first();
        $transaction = Transaction::where('charity_id', $id)->orderby('id','DESC')->get();
        $totalInAmount = Transaction::where('charity_id', $id)->where('tran_type','In')->sum('amount');
        $totalOutAmount = Transaction::where('charity_id', $id)->where('tran_type','Out')->sum('amount');
        return view('admin.charity.tranview',compact('data','transaction','totalInAmount','totalOutAmount'));
        
    }

    
}
