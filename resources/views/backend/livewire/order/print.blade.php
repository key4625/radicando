<div 
	x-data="{
		printDiv() {
            document.getElementById('dastampare').style.display = 'block';
            document.getElementById('buttonstampa').style.display = 'none';
			var printContents = this.$refs.container.innerHTML;
            
			var originalContents = document.body.innerHTML;
			document.body.innerHTML = printContents;
			window.print();
			document.body.innerHTML = originalContents;
            document.getElementById('dastampare').style.display = 'none';
            document.getElementById('buttonstampa').style.display = 'block';
		}
	}" 
	x-cloak
	x-ref="container"
	class="print:text-black relative"
>

	@isset($printButton)
		{{ $printButton }}
	@else
		<div id="buttonstampa" class="print:hidden absolute top-3 right-4" style="display:block;">
            <button class="btn btn-primary d-block mb-3" type="button" x-on:click="printDiv()" ><i class="fas fa-print"></i> Stampa ordini</button> 
		</div>
	@endisset

    <div id="dastampare" style="display:none;">
        <div class="row">
            @foreach($orders as $order)
                <div class="col-6">
                    <h3 class="d-inline">{{$order->nome}} {{$order->cognome}}</h3>
                    <h5  class="d-inline">{{Carbon\Carbon::create($order->data)->translatedFormat('D d M')}} </h5>
                    <p>Tel. {{$order->telefono}} - Indirizzo {{$order->citta}} {{$order->indirizzo}}</p>
                    @if($order->plants()->count()>0)
                        <table class="table table-sm table-bordered w-full">
                            <thead>
                                <tr><td colspan="4" class="text-bold">Frutta e verdura</td></tr>
                                <tr>
                                    <td>Nome</td>
                                    <td>Quantità</td>
                                    <td>Prezzo</td>
                                    <td>Totale</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->plants()->withPivot('quantity','quantity_um','price','price_um')->orderby('fragile','asc')->get() as $tmp_item_order)
                                    <tr> 
                                        <td>{{$tmp_item_order->nome}}</td>
                                        <td>{{ $tmp_item_order->pivot->quantity}} {{ $tmp_item_order->pivot->quantity_um}}</td>
                                        <td>{{$tmp_item_order->pivot->price}}€ / {{$tmp_item_order->pivot->price_um}}</td>
                                        <td>@if($tmp_item_order->pivot->price_um==$tmp_item_order->pivot->quantity_um) 
                                                {{$tmp_item_order->pivot->price * $tmp_item_order->pivot->quantity }} €
                                            @else 
                                                &nbsp;
                                            @endif 
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                    
                    @if($order->products()->count()>0)
                        <table class="table table-sm table-bordered w-full">
                            <thead>
                                <tr><td colspan="4" class="text-bold">Prodotti</td></tr>
                                <tr>
                                    <td>Nome</td>
                                    <td>Quantità</td>
                                    <td>Prezzo</td>
                                    <td>Totale</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->products()->withPivot('quantity','quantity_um','price','price_um')->orderby('fragile','asc')->get() as $tmp_item_order)
                                    <tr> 
                                        <td>{{$tmp_item_order->name}}</td>
                                        <td>{{ $tmp_item_order->pivot->quantity}} {{ $tmp_item_order->pivot->quantity_um}}</td>
                                        <td>{{$tmp_item_order->pivot->price}}€ / {{$tmp_item_order->pivot->price_um}}</td>
                                        <td>
                                            @if($tmp_item_order->pivot->price_um==$tmp_item_order->pivot->quantity_um) 
                                                {{$tmp_item_order->pivot->price * $tmp_item_order->pivot->quantity }} €
                                            @else 
                                                &nbsp;
                                            @endif 
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif  
                    <p><b>NOTE</b>: {{$order->notes}} </p>     
                    <h5>TOTALE: {{$order->prezzo_tot}} €</h5>      
                    <hr>
                </div>     
            @endforeach
        </div>
    </div>

</div>