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

        foreach($request->except('_token') as $k => $v){         
            if($k == "app_logo"){
                $v->storeAs('public/', "logo.".($v->extension()));
                $v = 'logo.'.($v->extension());
            }
            $tmpSet = Setting::find($k); 
            if ($tmpSet != null) { 
                $tmpSet->value= $v;
                $tmpSet->save();
            } else return redirect()->back()->with('error','Errore sul salvataggio delle impostazioni, '.$k.' non trovato');
        }        
        return redirect()->back()->with('success','Impostazioni aggiornate');
    }
}
