<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\sendMail;
use RealRashid\SweetAlert\Facades\Alert;
use Validator;




class indexController extends Controller
{
    public function index(){

        return view('index');
    } 

    public function sendMail(Request $request){
        
        

        try{
            
    $recaptchaSecretKey = "6Lci_88oAAAAAOnZoTXBhjMsazPwc_hLO5x-RVVa";
    $recaptchaResponse = $request->input('g-recaptcha-response');
    $verify = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$recaptchaSecretKey&response=$recaptchaResponse");
    $responseKeys = json_decode($verify, true);
    
    //dd($responseKeys);

    if (intval($responseKeys["success"]) == false) {
       Alert::error('Confirm reCAPTCHA');

            return redirect($_SERVER['HTTP_REFERER'].'#contact');
    }
            
    $validator = Validator::make($request->all(),[
        'name' => 'required',
        'message' => 'required',
        'project' => 'required',
        'email' => 'required|email',

    ]);

    if ($validator->fails()) {

 Alert::error('Error', 'try agine');
        return redirect($_SERVER['HTTP_REFERER'].'#contact');

    }else{

            Mail::send(new sendMail($request));

            Alert::success('successfully send', 'Thank you for contacting us! You will be answered within 24 hours.');

            return redirect($_SERVER['HTTP_REFERER'].'#contact');
    }
           

        }catch(\Exception $e){

        Alert::error('Error', 'Error during the creation!try agine');
        return redirect($_SERVER['HTTP_REFERER'].'#contact');

        }

    }
}
