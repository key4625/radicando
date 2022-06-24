<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use File;
use Carbon\Carbon as Carbon;
/**
 * Class SettingController.
 */
class SettingController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        /*$inscadenza = Appointment::inScadenza();
        $dafare= Appointment::dafareOggi();
        $clientisuggeriti = Customer::wherehas('appointments', function($q){
            $q->where('dateStart', '>=', Carbon::now()->addDays(-365));
        })->get();*/
        $settings = Setting::all()->pluck('value','name');
        return view('backend.settings.index',compact('settings'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Setting  $customer
     * @return \Illuminate\Http\Response
     */
    public function updateAll(Request $request)
    {
        /*request()->validate([
            'name' => 'unique'
        ]);*/
        $curr_ten = app('currentTenant');
        if($curr_ten==null) {
            $curr_ten = "generale";
        } else $curr_ten = $curr_ten->name;   
        foreach($request->except('_token') as $k => $v){         
            if($k == "app_logo"){
                $v = $v->storeAs('public/tenant/'.$curr_ten.'/profilo', "logo.".($v->extension()));
                //$v = 'logo.'.($v->extension());
            }
            if($k == "app_img_copertina"){
                $v = $v->storeAs('public/tenant/'.$curr_ten.'/profilo', "copertina.".($v->extension()));
                //$v = 'copertina.'.($v->extension());
            }
            if($k == "app_img"){
                $v = $v->storeAs('public/tenant/'.$curr_ten.'/profilo', "generale.".($v->extension()));
                //$v = 'generale.'.($v->extension());
            }
            $tmpSet = Setting::find($k); 
            if ($tmpSet != null) { 
                $tmpSet->value= $v;
                $tmpSet->save();
            } else {
                $tmpSet = Setting::create([
                    'name' => $k,
                    'value' => $v,
                    'type' => "Altro"
                ]);
                //return redirect()->back()->with('error','Errore sul salvataggio delle impostazioni, '.$k.' non trovato');
            } 
        }        
        return redirect()->back()->with('success','Impostazioni aggiornate');
    }
}
