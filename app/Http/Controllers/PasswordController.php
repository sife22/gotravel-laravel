<?php

namespace App\Http\Controllers;

use App\Mail\PasswordNotifs;
use App\Models\Agence;
use App\Models\Client;
use App\Models\Password;
use Carbon\Carbon;
use DateTime;
use Faker\Core\DateTime as CoreDateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class PasswordController extends Controller
{
    public function pagePassword(){
        return view('email');
    }

    public function sendCode(Request $request){
        // return date("H:i");
        $email = $request['email'];
        $validateData = $request->validate([
            'email'=>'required|email',
        ],[
            'email.required' => "l'email est obligatoire!",
            'email.email' => "Ce n'est pas un email.",
        ]);

        $client = Client::all()->where('email', '=', $email)->first();
        $agence = Agence::all()->where('email', '=', $email)->first();
        if($client){
            if($validateData){
            $old_emails = Password::all()->where('email', '=', $email);
            foreach($old_emails as $old){
                $old->delete();
            };
            $new = New Password();
            $new->email = $email;
            $new->code = rand(1000, 9999);
            $new->date_expiration = date('H:i');
            $new->save();
            Mail::to($email)->send(new PasswordNotifs($new->code));
            session()->put('email', $email);
            session()->flash('sendCode', 'Entrer le code que vous avez recevoir.');
            return view('code') ;
            }else{
            return redirect()->back()->withErrors($validateData)->withInput();
        }
        }elseif($agence){
            if($validateData){
                $old_emails = Password::all()->where('email', '=', $email);
                foreach($old_emails as $old){
                    $old->delete();
                };
                $new = New Password();
                $new->email = $email;
                $new->code = rand(1000, 9999);
                $new->date_expiration = date('H:i');
                $new->save();
                Mail::to($email)->send(new PasswordNotifs($new->code));
                session()->put('email', $email);
                session()->flash('sendCode', 'Entrer le code que vous avez recevoir.');
                return view('code') ;
            }else{
                return redirect()->back()->withErrors($validateData)->withInput();
            }
        }else{
        session()->flash('userNotFound', "Ce email n'existe pas sur notre platform");
        session()->pull('email');
        return redirect()->back();
        }

        // if($agence){
            
        // }else{
        //     session()->flash('userNotFound', "Ce email n'existe pas sur notre platform");
        //     session()->pull('email');
        //     return redirect()->back();
        // }

    }
    

    public function pageCode(){
        if(session()->has('email')){
            return view('code');
        }else{
            return redirect('/');
        }
    }


    public function pageNewPassword(){
        if(session()->has('email')){
            return view('nouveau_mot_de_passe');
        }else{
            return redirect('/');
        }
    }

    public function verificationCode(Request $request){
        $code = $request['code'];
        $user = Password::all()->where('email', '=', session()->get('email'))->first();
        if($user and $user->code == $code){
            return redirect('/nouveau_mot_de_passe');
        }else{
            session()->flash('codeIncorrect', "Le code est incorrect");
            return redirect('/code_vérification');
        }
    }


    public function resetPassword(Request $request){
        $client = Client::where('email', '=', session()->get('email'))->first();
        $agence = Agence::where('email', '=', session()->get('email'))->first();
        $validateData = $request->validate([
            'mot_de_passe'=>'required',
        ],[
            'mot_de_passe.required'=>'*Mot de passe obligatoire',
        ]);

        if(!$validateData){
            return redirect('/nouveau_mot_de_passe')->withErrors($validateData)->withInput();
        }

        if($client){
            $client->mot_de_passe = Hash::make($validateData['mot_de_passe']);
            $client->save();
            session()->pull('email');
            session()->flash('resetPassword', 'Votre mot de passe a été bien modifier.');
            return redirect('/connexion/client');
        }

        if($agence){
            $agence->mot_de_passe = Hash::make($validateData['mot_de_passe']);
            $agence->save();
            session()->pull('email');
            session()->flash('resetPassword', 'Votre mot de passe a été bien modifié.');
            return redirect('/connexion/agence');
        }
    }
}
