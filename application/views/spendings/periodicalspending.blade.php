@include('head')
@if (isset($message) )
    <h3 style="color: #bc4348;">{{ $message }}</h3>
@endif
<h2>Výdavky</h2>
@include('spendings/sp-submenu')

<h2>Pravidelný výdavok</h2>

<div class="thumbnail">
    <h4>Systémové správy:</h4>
{{ Form::open('spendings/savefromtemplate', 'POST', array('class' => '')); }}
<table border="0" style="width: 100%;">
<tr><td>
    <div class="input-prepend">
        <span class="add-on">Dátum:</span>
        <input class="span3" type="date" name="datum" value="{{ $datum }}" />
    </div>
</td>
<td>
<div class="input-prepend" style="float:left">
     <span class="add-on">Názov výdavku: </span>
    <select name="sablona" class="span3">
    @foreach ($sablony as $sablona)
        <option value="{{ $sablona->id }}">{{ $sablona->t_poznamka }}</option>
    @endforeach
    </select>
</div>
</td>
<td>
<div class="input-prepend">
    <span class="add-on">Zaplatil: </span>
    <select name="osoba" class="span3">
    @foreach ($osoby as $osoba)
        <option value="{{ $osoba->id }}">{{ $osoba->t_meno_osoby }} {{$osoba->t_priezvisko_osoby }}</option>
    @endforeach
    </select>
</div>
</td></tr>
<tr><td>
<div>
    <input type="submit" class="btn" value="Potvrdiť" />
</div>
</td></tr>
</table>
{{ Form::close() }}
<hr>

<script type="text/javascript">
function multiCheck()
{
	var valChecked = $('#multicheck').val();
	if(valChecked == 0)
	{
		$('.spendcheck').prop('checked', true);
		$('#multicheck').val(1);
	}
	else
	{
		$('.spendcheck').prop('checked', false);
		$('#multicheck').val(0);
	}
}
</script>

<h4 class="">Zoznam šablón výdavkov</h4>
<form id="form1" name="form1" method="post" action="multideletetemplatespending">
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th><input type="checkbox" value="0" id="multicheck" onclick="multiCheck();" /></th>
            <th>Názov</th>
            <th>Príjemca platby</th>
            <th>Pravidelnosť</th>
            <th>Kategória</th>
            <th>Suma v €</th>
            <th>Výber akcie</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($sablony as $sablona)
        <tr>
            <td><input type="checkbox" name="template[]" id="checkbox2" class="spendcheck" value="{{ md5($sablona->id). $secretword}}" /></td>
            <td>{{ $sablona->t_poznamka }}</td>
            <td>{{ $sablona->prijemca }}</td>
            <td>{{ (($sablona->fl_pravidelny == 'A')? "Pravidelný" : "Nepravidelný") }}</td>
            <td>{{ $sablona->kategoria }}</td>
            <td>{{ $sablona->vl_jednotkova_cena }} €</td>
            <td><a class="btn" href="templatespending?id={{ $sablona->id }}">Upraviť</a>
                <a class="btn" href="deletetemplatespending?template={{ md5($sablona->id). $secretword}}"><i class="icon-remove"></i>Vymazať</a></td>
        </tr>
        @endforeach
        </tbody>
    </table>
    <a class="btn" href="#" onclick="document.getElementById('form1').submit(); return false;"><i class="icon-remove"></i>Vymazať zvolené</a>
</form>

@include('foot');
