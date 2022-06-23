<?php

namespace App\Http\Controllers\Backend;

use App\Models\Plant;
use App\Models\Plantcategory;
use Illuminate\Http\Request;
use Storage;

/**
 * Class DashboardController.
 */
class PlantController
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('backend.plants');
    }

    public function create()
    {
        $plant_categories = Plantcategory::all()->pluck('name','id');
        return view('backend.plants.edit', compact('plant_categories'));
    }

    public function edit($id)
    {
        $plant = Plant::find($id);
        $plant_categories = Plantcategory::all()->pluck('name','id');
        //$utenti_enti = User::role('Ente')->get();
        return view('backend.plants.edit', compact('plant','plant_categories'));
    }
   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'price' => 'required',
            'abbreviazione' => 'unique'
        ]);
        if($request->has('file_upload')!=null){
            $curr_ten = app('currentTenant');
            if($curr_ten==null) {
                $curr_ten = "generale";
            } else $curr_ten = $curr_ten->name;
            $extension = $request->file('file_upload')->extension();
            $path = $request->file('file_upload')->storeAs('public/tenant/'.$curr_ten.'/plants', str_replace(' ','-',$request->nome) . '.' .  $extension);
            $request->request->add(['image' => $path]);
        }
        //$request->request->add(['user_id' => Auth::id()]);
        //array_merge($request->all(), ['user_id' => Auth::id()]);
     
        if($request->abbreviazione==null){
            $request->merge(['abbreviazione' => trim($request->nome)]);
        }
        Plant::create($request->except('file_upload'));

        return redirect()->route('admin.piante.index')
            ->with('flash_success', 'Pianta registrata con successo');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required',
            'price' => 'required',
            'abbreviazione' => 'unique'  
        ]);
        $tmpPlant = Plant::where('id',$id)->first();
        if($request->has('file_upload')!=null){
            $curr_ten = app('currentTenant');
            if($curr_ten==null) {
                $curr_ten = "generale";
            } else $curr_ten = $curr_ten->name;       
            $extension = $request->file('file_upload')->extension();
            $path = $request->file('file_upload')->storeAs('public/tenant/'.$curr_ten.'/plants', str_replace(' ','-',$request->nome) . '.' .  $extension);

            $request->request->add(['image' => $path]);
            //dd($tmpPlant->image);
            Storage::delete($tmpPlant->image);
        }
        if($request->abbreviazione==null){
            $request->merge(['abbreviazione' => substr(trim($request->nome),0,5)]);
        }
        Plant::where('id',$id)->update($request->except(['_token', '_method','file_upload']));
        return redirect()->route('admin.piante.index')
            ->with('flash_success', 'Coltura aggiornata con successo');
    }
  

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $plant = Plant::findOrFail($id);
        $plant->delete();
        return redirect()->route('admin.piante.index')
            ->with('flash_success', 'Coltura cancellata con successo');
    }
}
