<?php

namespace App\Http\Controllers\Backend;

use App\Models\Animal;
use App\Models\Plant;
use Illuminate\Http\Request;

/**
 * Class DashboardController.
 */
class AnimalController
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('backend.animals');
    }

    public function create()
    {
        return view('backend.animals.edit');
    }

    public function edit($id)
    {
        $animal = Animal::find($id);
        //$utenti_enti = User::role('Ente')->get();
        return view('backend.animals.edit', compact('animal'));
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

        Animal::where('id',$id)->update($request->except(['_token', '_method' ]));
        return redirect()->route('admin.animali.index')
            ->with('flash_success', 'Animale aggiornato con successo');
    }
  

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $animal = Animal::findOrFail($id);
        $animal->delete();
        return redirect()->route('admin.animali.index')
            ->with('flash_success', 'Animale rimosso con successo');
    }
}
