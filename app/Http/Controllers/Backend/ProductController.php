<?php

namespace App\Http\Controllers\Backend;

use App\Models\Cultivation;
use App\Models\Product;
use App\Models\Productcategory;
use Illuminate\Http\Request;
use Storage;

/**
 * Class DashboardController.
 */
class ProductController
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('backend.products');
    }

    public function create()
    {
        $cultivations = Cultivation::all();
        $productcategories = Productcategory::all();
        return view('backend.products.edit', compact('cultivations','productcategories'));
    }

    public function edit($id)
    {
        $cultivations = Cultivation::all();
        $product = Product::find($id);
        $productcategories = Productcategory::all();
        //$utenti_enti = User::role('Ente')->get();
        return view('backend.products.edit', compact('product','cultivations','productcategories'));
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
            'name' => 'required|max:128',
            'file_upload' => 'image|max:5000',
            'productcategories_id' => 'required|integer|min:1'
        ]);
        if($request->has('file_upload')!=null){
            $curr_ten = app('currentTenant');
            if($curr_ten==null) {
                $curr_ten = "generale";
            } else $curr_ten = $curr_ten->name;
            $extension = $request->file('file_upload')->extension();
            $path = $request->file('file_upload')->storeAs('public/tenant/'.$curr_ten."products/", str_replace(' ','-',$request->name) . '.' .  $extension);

            $request->request->add(['image' => $path]);
        }
        $request->merge(['price' => str_replace(',', '.', $request->price)]);
        //array_merge($request->all(), ['user_id' => Auth::id()]);
        Product::create($request->except('file_upload'));

        return redirect()->route('admin.prodotti.index')
            ->with('flash_success', 'Prodotto creato con successo');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:128',
            'file_upload' => 'image|max:5000',
        ]);
        $tmpProd = Product::where('id',$id)->first();
        if($request->has('file_upload')!=null){
            $curr_ten = app('currentTenant');
            if($curr_ten==null) {
                $curr_ten = "generale";
            } else $curr_ten = $curr_ten->name;       
            $extension = $request->file('file_upload')->extension();
            Storage::delete($tmpProd->image);
            $path = $request->file('file_upload')->storeAs('public/tenant/'.$curr_ten."products/", str_replace(' ','-',$request->name) . '.' .  $extension);

            $request->request->add(['image' => $path]);
            //dd($tmpProd->image);
           
        }
        $request->merge(['price' => str_replace(',', '.', $request->price)]);
        $tmpProd->update($request->except(['_token', '_method','file_upload' ]));
        return redirect()->route('admin.prodotti.index')
            ->with('flash_success', 'Prodotto aggiornato con successo');
    }
  

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('admin.prodotti.index')
            ->with('flash_success', 'Prodotto eliminato con successo');
    }
}
