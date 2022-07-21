<!DOCTYPE html>
<html>
<head>
    <title>Hai appena effettuato un ordine su Radicando.it</title>
</head>
<body>
    <div style="text-align:center;">
        <img style="max-height:100px;" src="https://{{$_SERVER['SERVER_NAME'];}}/{{ Storage::url(App\Models\Setting::find('app_logo')->value) }}">
        <h3 >{{App\Models\Setting::find('app_company_name')->value}}</h3>
    </div>
    <div>
        <h4>Riepilogo ordine</h4>
        <p>{{ $details['ordine']->nome." ".$details['ordine']->cognome }}</p>
        <p>{{ $details['ordine']->email }} - {{ $details['ordine']->tel }}</p>
        <p><b>Data ordine</b>: {{Carbon\Carbon::create($details['ordine']->data)->translatedFormat('D d M')}}</p>
        @if($details['ordine']->consegna_domicilio == 1)
            <p><b>Luogo spedizione</b>: {{ $details['ordine']->citta }} - {{ $details['ordine']->indirizzo }}</p>
        @endif
      
        
    
        @if( $details['ordine']->plants()->count()>0)
            <table border=1>
                <tbody>
                    <tr><td colspan="4"><b>Frutta e verdura</b></td></tr>
                    <tr>
                        <td>Nome</td>
                        <td>Quantità</td>
                        <td>Prezzo</td>
                        <td>Totale</td>
                    </tr>
                    @foreach($details['ordine']->plants()->withPivot('quantity','quantity_um','price','price_um')->orderby('fragile','asc')->get() as $tmp_item_order)
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
        @if($details['ordine']->products()->count()>0)
            <table border=1>
                <tbody>
                    <tr><td colspan="4" ><b>Prodotti</b></td></tr>
                    <tr>
                        <td>Nome</td>
                        <td>Quantità</td>
                        <td>Prezzo</td>
                        <td>Totale</td>
                    </tr>
                    @foreach($details['ordine']->products()->withPivot('quantity','quantity_um','price','price_um')->orderby('fragile','asc')->get() as $tmp_item_order)
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

        <p><b>NOTE</b>: {{$details['ordine']->notes}} </p>     
        <h5>TOTALE: {{$details['ordine']->prezzo_tot}} €</h5>   
    
        <p>Grazie!</p>
    </div>
</body>
<footer>
    Radicando - Agricoltura online - www.radicando.it - info@radicando.it
</footer>
</html>