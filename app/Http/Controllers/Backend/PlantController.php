<?php

namespace App\Http\Controllers\Backend;

use App\Models\Plant;
use Illuminate\Http\Request;

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
        return view('backend.plants.edit');
    }

    public function edit($id)
    {
        $plant = Plant::find($id);
        //$utenti_enti = User::role('Ente')->get();
        return view('backend.plants.edit', compact('plant'));
    }
   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /*public function store(Request $request)
    {
        $request->validate([
            'entity_id' => 'required',
            'text' => 'required',
        ]);
        $request->request->add(['user_id' => Auth::id()]);
        //array_merge($request->all(), ['user_id' => Auth::id()]);
        Plant::create($request->all());

        return redirect()->route('admin.messaggi.index')
            ->with('flash_success', 'Messaggio registrato con successo');
    }*/
    public function update(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required',
           
        ]);

        Plant::where('id',$id)->update($request->except(['_token', '_method' ]));
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
