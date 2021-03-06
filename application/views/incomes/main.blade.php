@include('head')
@if (isset($message) )
    <h3 style="color: #bc4348;">{{ $message }}</h3>
@endif
<h2>Prijmy</h2>

<h2>Filter Prijmov</h2>
{{ Form::open('incomes/filter', 'POST', array('class' => 'side-by-side')); }}

<div class="thumbnail">
    <h4>Dátum</h4>
    <div class="input-prepend">
        <span class="add-on">Od: </span>
        <input class="span3" type="date" name="od" value="{{ $od }}">
    </div>
    <div class="input-prepend">
    <span class="add-on">Do: </span>
    <input class="span3" type="date" name="do" value="{{ $do }}">
</div>
 <div class="input-prepend">
        <span class="add-on">Vydajca: </span>
    <select name="vydajca" class="span3">
        <option value="all" selected="selected">Vsetci</option>
        @foreach ($partners as $partner)
        <option value="{{ $partner->id }}"> {{ $partner->t_nazov }}</option>
        @endforeach
    </select>
     </div>
   <div class="input-prepend">

        <span class="add-on">Kategoria: </span>
        <select name="category" class="span3">
          @foreach ($kategorie as $kat)
            <option value="{{ $kat->id_kategoria_a_produkt }}">{{ $kat->t_nazov }}</option>
            @endforeach
        </select>
    <div class="submit">
        {{ Form::submit('Zobraziť' , array('class' => 'btn')); }}
    </div>
    {{ Form::close() }}
    </div>
 </div>
<h2 class="">Zoznam prijmov</h2>
<form id="form1" name="form1" method="post" action="">
    <table class="table table-bordered table-striped">
        <thead>
	        <tr>
	            <th>
	            </th>
	            <th>Dátum</th>
	            <th>Vydajca Platby</th>
	            <th>Názov</th>
	            <th>Suma v €</th>
	            <th>Výbe akcie</th>
	        </tr>
        </thead>
        <tbody>
        @foreach ($prijmy as $prijem)
        <tr>
            <td><input type="checkbox" name="checkbox2" id="checkbox2" /></td>
            <td>{{ date('d.m.Y',strtotime($prijem->d_datum)) }}</td>
    		<td>{{ $prijem->partner->t_nazov }}</td>
            <td>{{ $prijem->t_poznamka }}</td>
            <td>{{ round($prijem->vl_suma_prijmu,2) }} EUR</td>
            <td><a class="btn" >Upraviť</a>
                <a class="btn" >Vymazať</a></td>
        </tr>
        @endforeach
        </tbody>
    </table>
</form>
<pre>

  </pre>

@include('foot');