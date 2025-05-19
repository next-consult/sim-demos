<?php
function replace($montant)
{
    $montant = str_replace('.', ',', $montant);
    return $montant;
}
?>
<?php
//conversion chiffre en lettres
class ChiffreEnLettre
{
//NE GERE PAS TOUT (les pluriels...)
#Variables
public $leChiffreSaisi;
public $enLettre='';
public $chiffre=array(1=>"un",2=>"deux ",3=>"trois ",4=>"quatre ",5=>"cinq ",6=>"six ",7=>"sept ",8=>"huit ",9=>"neuf ",10=>"dix ",11=>"onze ",12=>"douze ",13=>"treize ",14=>"quatorze ",15=>"quinze ",16=>"seize ",17=>"dix-sept ",18=>"dix-huit ",19=>"dix-neuf ",20=>"vingt ",30=>"trente ",40=>"quarante ",50=>"cinquante ",60=>"soixante ",70=>"soixante-dix ",80=>"quatre-vingt ",90=>"quatre-vingt-dix ");


#Fonction de conversion appelée dans la feuille principale
function Conversion($sasie)
{
$this->enLettre='';
$sasie=trim($sasie);

#suppression des espaces qui pourraient exister dans la saisie
$nombre='';
$laSsasie=explode(' ',$sasie);
foreach ($laSsasie as $partie)
$nombre.=$partie;

#suppression des zéros qui précéderaient la saisie
$nb=strlen($nombre);
for ($i=0;$i<=$nb;)
{
if(substr($nombre,$i,1)==0)
{
$nombre=substr($nombre,$i+1);
$nb=$nb-1;
}
elseif(substr($nombre,$i,1)<>0)
{
$nombre=substr($nombre,$i);
break;
}
}
#echo $nombre;
#$this->SupZero($nombre);
#le nombre de caract que comporte le nombre saisi de sa forme sans espace et sans 0 au début
$nb=strlen($nombre);
#echo $nb.'<br/ >';
#$this->leChiffreSaisi=$nombre;
#conversion du chiffre saisi en lettre selon les cas
switch ($nb)
{
case 0:
$this->enLettre='zéro';
case 1:
if ($nombre==0)
{
$this->enLettre='zéro';
break;
}
elseif($nombre<>0)
{
$this->Unite($nombre);
break;
}

case 2:
$unite=substr($nombre,1);
$dizaine=substr($nombre,0,1);
$this->Dizaine(0,$nombre,$unite,$dizaine);
break;

case 3:
$unite=substr($nombre,2);
$dizaine=substr($nombre,1,1);
$centaine=substr($nombre,0,1);
$this->Centaine(0,$nombre,$unite,$dizaine,$centaine);
break;

#cas des milles
case ($nb>3 and $nb<=6):
$unite=substr($nombre,$nb-1);
$dizaine=substr($nombre,($nb-2),1);
$centaine=substr($nombre,($nb-3),1);
$mille=substr($nombre,0,($nb-3));
$this->Mille($nombre,$unite,$dizaine,$centaine,$mille);
break;

#cas des millions
case ($nb>6 and $nb<=9):
$unite=substr($nombre,$nb-1);
$dizaine=substr($nombre,($nb-2),1);
$centaine=substr($nombre,($nb-3),1);
$mille=substr($nombre,-6);
$million=substr($nombre,0,$nb-6);
$this->Million($nombre,$unite,$dizaine,$centaine,$mille,$million);
break;

#cas des milliards
/*case ($nb>9 and $nb<=12):
$unite=substr($nombre,$nb-1);
$dizaine=substr($nombre,($nb-2),1);
$centaine=substr($nombre,($nb-3),1);
$mille=substr($nombre,-6);
$million=substr($nombre,-9);
$milliard=substr($nombre,0,$nb-9);
Milliard($nombre,$unite,$dizaine,$centaine,$mille,$million,$milliard);
break;*/

}
if (!empty($this->enLettre))
	return $this->enLettre;
}

#Gestion des miiliards
/*
function Milliard($nombre,$unite,$dizaine,$centaine,$mille,$million,$milliard)
{

}
*/

#Gestion des millions

function Million($nombre,$unite,$dizaine,$centaine,$mille,$million)
{
#si les mille comportent un seul chiffre
#$cent represente les 3 premiers chiffres du chiffre ex: 321 dans 12502321
#$mille represente les 3 chiffres qui suivent les cents ex: 502 dans 12502321
#reste represente les 6 premiers chiffres du chiffre ex: 502321 dans 12502321

$cent=substr($nombre,-3);
$reste=substr($nombre,-6);

if (strlen($million)==1)
{
$mille=substr($nombre,1,3);
$this->enLettre.=$this->chiffre[$million];
	if ($million == 1){
		$this->enLettre.=' million ';
	}else{
		$this->enLettre.=' millions ';
	}
}
elseif (strlen($million)==2)
{
$mille=substr($nombre,2,3);
$nombre=substr($nombre,0,2);
//echo $nombre;
$this->Dizaine(0,$nombre,$unite,$dizaine);
$this->enLettre.='millions ';
}
elseif (strlen($million)==3)
{
$mille=substr($nombre,3,3);
$nombre=substr($nombre,0,3);
$this->Centaine(0,$nombre,$unite,$dizaine,$centaine);
$this->enLettre.='millions ';
}

#recuperation des cens dans nombre

#suppression des zéros qui précéderaient le $reste
$nb=strlen($reste);
for ($i=0;$i<=$nb;)
{
if(substr($reste,$i,1)==0)
{
$reste=substr($reste,$i+1);
$nb=$nb-1;
}
elseif(substr($reste,$i,1)<>0)
{
$reste=substr($reste,$i);
break;
}
}
$nb=strlen($reste);
#si tous les chiffres apres les milions =000000 on affiche x million
if ($nb==0)
;
else
{
#Gestion des milles
#suppression des zéros qui précéderaient les milles dans $mille
$nb=strlen($mille);
for ($i=0;$i<=$nb;)
{
if(substr($mille,$i,1)==0)
{
$mille=substr($mille,$i+1);
$nb=$nb-1;
}
elseif(substr($mille,$i,1)<>0)
{
$mille=substr($mille,$i);
break;
}
}
#le nombre de caract que comporte le nombre saisi de sa forme sans espace et sans 0 au début
$nb=strlen($mille);
#echo '<br />nb='.$nb.'<br />';
if ($nb==0)
;
#AffichageResultat($enLettre);
elseif ($nb==1)
{
if ($mille==1)
$this->enLettre.='milles ';
else
{
$this->Unite($mille);
$this->enLettre.='milles ';
}
}
elseif ($nb==2)
{
$this->Dizaine(1,$mille,$unite,$dizaine);
$this->enLettre.='milles ';
}
elseif ($nb==3)
{
$this->Centaine(1,$mille,$unite,$dizaine,$centaine);
$this->enLettre.='milles ';
}
#Gestion des cents
#suppression des zéros qui précéderaient les cents dans $cent
$nb=strlen($cent);
for ($i=0;$i<=$nb;)
{
if(substr($cent,$i,1)==0)
{
$cent=substr($cent,$i+1);
$nb=$nb-1;
}
elseif(substr($cent,$i,1)<>0)
{
$cent=substr($cent,$i);
break;
}
}
#le nombre de caract que comporte le nombre saisi de sa forme sans espace et sans 0 au début
$nb=strlen($cent);
#echo '<br />nb='.$nb.'<br />';
if ($nb==0)
;
#AffichageResultat($enLettre);
elseif ($nb==1)
$this->Unite($cent);
elseif ($nb==2)
$this->Dizaine(0,$cent,$unite,$dizaine);
elseif ($nb==3)
$this->Centaine(0,$cent,$unite,$dizaine,$centaine);
}
}

#Gestion des milles

function Mille($nombre,$unite,$dizaine,$centaine,$mille)
{
#si les mille comportent un seul chiffre
#$cent represente les 3 premiers chiffres du chiffre ex: 321 dans 12321
if (strlen($mille)==1)
{
$cent=substr($nombre,1);
#si ce chiffre=1
if ($mille==1)
$this->enLettre.='';
#si ce chiffre<>1
elseif($mille<>1)
$this->enLettre.=$this->chiffre[$mille];
}
elseif (strlen($mille)>1)
{
if (strlen($mille)==2)
{
$cent=substr($nombre,2);
$nombre=substr($nombre,0,2);
#echo $nombre;
$this->Dizaine(1,$nombre,$unite,$dizaine);
}
if (strlen($mille)==3)
{
$cent=substr($nombre,3);
$nombre=substr($nombre,0,3);
#echo $nombre;
$this->Centaine(1,$nombre,$unite,$dizaine,$centaine);
}
}

$this->enLettre.='milles ';
#recuperation des cens dans nombre
#suppression des zéros qui précéderaient la saisie
$nb=strlen($cent);
for ($i=0;$i<=$nb;)
{
if(substr($cent,$i,1)==0)
{
$cent=substr($cent,$i+1);
$nb=$nb-1;
}
elseif(substr($cent,$i,1)<>0)
{
$cent=substr($cent,$i);
break;
}
}
#le nombre de caract que comporte le nombre saisi de sa forme sans espace et sans 0 au début
$nb=strlen($cent);
#echo '<br />nb='.$nb.'<br />';
if ($nb==0)
;//AffichageResultat($enLettre);
elseif ($nb==1)
$this->Unite($cent);
elseif ($nb==2)
$this->Dizaine(0,$cent,$unite,$dizaine);
elseif ($nb==3)
$this->Centaine(0,$cent,$unite,$dizaine,$centaine);

}

#Gestion des centaines

function Centaine($inmillier,$nombre,$unite,$dizaine,$centaine)
{

$unite=substr($nombre,2);
$dizaine=substr($nombre,1,1);
$centaine=substr($nombre,0,1);
#comme 700
if ($unite==0 and $dizaine==0)
{
if ($centaine==1)
$this->enLettre.='cents';
elseif ($centaine<>1)
		{
				if ($inmillier == 0)
					$this->enLettre.=($this->chiffre[$centaine].' cents').' ';
				if ($inmillier == 1)
					$this->enLettre.=($this->chiffre[$centaine].' cents').' ';
		}
}
#comme 705
elseif ($unite<>0 and $dizaine==0)
{
if ($centaine==1)
$this->enLettre.=('cents '.$this->chiffre[$unite]).' ';
elseif ($centaine<>1)
$this->enLettre.=($this->chiffre[$centaine].' cents '.$this->chiffre[$unite]).' ';
}
//comme 750
elseif ($unite==0 and $dizaine<>0)
{
#recupération des dizaines
$nombre=substr($nombre,1);
//echo '<br />nombre='.$nombre.'<br />';
if ($centaine==1)
{
$this->enLettre.='cents ';
$this->Dizaine(0,$nombre,$unite,$dizaine).' ';
}
elseif ($centaine<>1)
{
$this->enLettre.=$this->chiffre[$centaine].' cents ';
$this->Dizaine(0,$nombre,$unite,$dizaine).' ';

}

}
#comme 695
elseif ($unite<>0 and $dizaine<>0)
{
$nombre=substr($nombre,1);

if ($centaine==1)
{
$this->enLettre.='cents ';
$this->Dizaine(0,$nombre,$unite,$dizaine).' ';
}

elseif ($centaine<>1)
{
$this->enLettre.=($this->chiffre[$centaine].' cents ');
$this->Dizaine(0,$nombre,$unite,$dizaine).' ';
}
}

}


#Gestion des dizaines

function Dizaine($inmillier,$nombre,$unite,$dizaine)
{
$unite=substr($nombre,1);
$dizaine=substr($nombre,0,1);

#comme 70
if ($unite==0)
{
$val=$dizaine.'0';
$this->enLettre.=$this->chiffre[$val];
		if ($inmillier == 0 && $val == 80){
			$this->enLettre.='s ';
		}
		$this->enLettre.=' ';
}
#comme 71
elseif ($unite<>0)
#dizaine different de 9
if ($dizaine<>9 and $dizaine<>7)
{
if ($dizaine==1)
{
$val=$dizaine.$unite;
$this->enLettre.=$this->chiffre[$val].' ';
}
else
{
$val=$dizaine.'0';
if ($unite == 1 && $dizaine <> 8){
$this->enLettre.=($this->chiffre[$val].' et '.$this->chiffre[$unite]).' ';
}else{
$this->enLettre.=($this->chiffre[$val].'-'.$this->chiffre[$unite]).' ';
}
}
}
#dizaine =9
elseif ($dizaine==9)
$this->enLettre.=($this->chiffre[80].'-'.$this->chiffre['1'.$unite]).' ';
elseif ($dizaine==7)
{
if ($unite == 1){
	$this->enLettre.=($this->chiffre[60].' et '.$this->chiffre['1'.$unite]).' ';
}else{
	$this->enLettre.=($this->chiffre[60].'-'.$this->chiffre['1'.$unite]).' ';
}
}
}
#Gestion des unités

function Unite($unite)
{
$this->enLettre.=($this->chiffre[$unite]).' ';
}

}
?>

<html>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<style>
    .titre {
        text-decoration: "capitalize"
    }

    .header {
        position: fixed;
        top: 0 !important;
        right: 0 !important;
        left: 0 !important;
        padding: 0.5rem !important;
        background-color: white;
        z-index: 1000;
    }

    .content {
        margin-top: 120px;
        padding-top: 10px;
        position: relative;
        z-index: 1;
        margin-bottom: 60px;
    }

    .footer {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        width: 100%;
        background-color: #efefef;
        z-index: 1000;
    }

    td,
    th {
        word-wrap: break-word;
        font-size: 12px
    }

    #total_table {
        border-top: none !important;
    }

    .name-caract {
        font-family: DejaVu Sans;
    }

    @page {
        counter-increment: page;
        counter-reset: page 1;
    }

    .pageNumber {
        counter-reset: pages;
    }

    .pageNumber:after {
        content: counter(page) " / " counter(pages);
    }

    @media print {
        .pageNumber:after {
            content: counter(page) " / " counter(pages);
        }
    }

    table thead {
        display: table-header-group; 
        background-color: white; 
    }

    table thead th {
        font-weight: bold;
        border-bottom: 2px solid #ddd;
    }

    table tbody {
        display: table-row-group;
    }

    @media print {
        table {
            page-break-inside: auto;
        }
        
        tr {
            page-break-inside: avoid;
            page-break-after: auto;
        }

        thead {
            display: table-header-group !important;
            background-color: white !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        tbody {
            display: table-row-group;
        }

      

        .footer {
        position: fixed;
        bottom: 0;
        width: 100%;
        display: table-footer-group !important;
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
        background-color: #efefef;

    }
        @page {
            margin-bottom: 50px;
        }

        body {
            margin-bottom: 60px;
        }
    }

    table thead {
        display: table-header-group;
        background-color: white !important;
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
    }

    table thead th {
        font-weight: bold;
        background-color: white !important;
        border-bottom: 2px solid #ddd;
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
    }

    #product_table {
        border-collapse: collapse;
        width: 100%;
        margin-bottom: 60px;
    }

    #product_table thead {
        display: table-header-group !important;
    }

    #product_table tbody {
        display: table-row-group;
    }

    #product_table tr {
        page-break-inside: avoid;
    }

    #product_table th {
        font-weight: bold;
        background-color: white !important;
        border-bottom: 1px solid #000;
    }

    @page {
        margin-top: 20px;
    }

    @media print {
        #product_table {
            overflow: visible !important;
        }

        #product_table thead {
            display: table-header-group !important;
        }

        #product_table tr {
            break-inside: avoid !important;
            page-break-inside: avoid !important;
        }

        #product_table th {
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
            background-color: white !important;
        }

        #product_table thead th {
            position: sticky;
            top: 0;
            background-color: white !important;
            z-index: 2;
        }
    }

    @media print {
        thead {
            display: table-header-group !important;
        }
        tfoot {
            display: table-footer-group !important;
        }
        table {
            page-break-inside: auto !important;
        }
        tr {
            page-break-inside: avoid !important;
            page-break-after: auto !important;
        }
    }

    .header .row {
        margin-bottom: 0 !important;
        padding: 4px !important;
    }

    .main-table {
        width: 100%;
        height: 100%;
        border-collapse: collapse;
    }

    .main-table thead {
        display: table-header-group;
    }

    .main-table tfoot {
        display: table-footer-group !important;
    }

    .footer-content {
        position: relative;
        padding: 0.5rem;
        background-color: white !important;
    }

    @media print {
        .main-table tfoot {
            display: table-footer-group !important;
        }
        
        .footer-content {
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }
    }

    .page-number:before {
        content: 'Page ' counter(page);
    }

    .page-count:before {
        content: ' / ' counter(pages);
    }

    @media print {
        .page-number:before {
            content: 'Page ' counter(page);
        }
        
        .page-count:before {
            content: ' / ' counter(pages);
        }
    }

    /* Ajoutez ces styles pour la pagination */
    .page-info {
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 12px;
        font-family: Arial, sans-serif;
    }
    
    @media print {
        .page-info {
            position: fixed !important;
            top: 10px !important;
            right: 10px !important;
        }
    }

</style>

<body>
  

    <div class="header">
        <div class="row" style="border-bottom:1px black solid;padding:8px">
            <div class="col-xs-3">
                <img style="width: 180px; height: 80px;"
                    src="data:image/png;base64,{{ base64_encode(@file_get_contents($photo)) }}">
            </div>

            <div class="col-xs-8" style="margin-top:-20px">
                <h1 style="margin-left:106px">Facture #{{ $facture->numero }}</h1>
                <div style="text-align: right; margin-right: 42px;">
                    <div><b>DATE:</b> {{ $facture->date }}</div>
                    
                </div>
                <br>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="row" style="margin-top:25px">
            <div class="col-xs-5">
                @if ($facture->type == 'client')
                    <p class="addressMySam">
                        <strong style="font-size:22px;text-decoration:capitalize">Client</strong><br />
                        <span class="name-caract"> {{ $facture->client->nom }} </span><br />
                        {{ $facture->client->adresse }}<br />
                        {{ $facture->client->telephone }}<br />
                        M/F:{{ $facture->client->mf }}
                    </p>
                @else
                    <p class="addressMySam">
                        <strong style="font-size:22px;text-decoration:capitalize">Client</strong><br />
                        <span class="name-caract"> {{ $facture->fournisseur->nom }} </span><br />
                        {{ $facture->fournisseur->adresse }}<br />
                        {{ $facture->fournisseur->telephone }}
                    </p>
                @endif
            </div>
            <div class="col-xs-6">
                <table class="table" style="font-size:12px">
                    <tr>
                        <td>Total : <b>{{ replace(sprintf('%.3f', $facture->facture_ttc)) }}</b></td>
                        <td>Devise :<b><?php echo \App\Models\Devise::where('symbole', $facture->devise)->first()->code; ?></b></td>
                    </tr>
                    <tr>
                        <td>M/F: <b>{{$facture->entreprise->mf}} </b></td>
                        <td>Type : <b>EXP REP INV</b></td>
                    </tr>
                    <tr>
                        <td>Note <b>#None</b></td>
                        <td></td>
                    </tr>
                </table>

            </div>


        </div>

        <div style="overflow: visible !important;">
            <table class="table" style="margin-top:20px" id="product_table">
                <thead>
                    <tr>
                        <th style="width:11%; border-bottom: 1px solid #000;">Produit</th>
                        <th style="width:37%; border-bottom: 1px solid #000;">Description</th>
                        <th style="width:10%; border-bottom: 1px solid #000;">PU HT</th>
                        <th style="width:7%; border-bottom: 1px solid #000;">QTE</th>
                        <th style="width:14%; border-bottom: 1px solid #000;">Total HT</th>
                        <th style="width:7%; border-bottom: 1px solid #000;">TVA</th>
                        <th style="width:14%; border-bottom: 1px solid #000;">Total TTC</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($facture->items as $key => $item)
                        <?php

                        $remise_unite = $item->total_remise / $item->quantites;

                        ?>
                        <tr id="{{ $key + 1 }}">

                            <td>
                                {{ $item->produit }}
                            </td>
                            <td>
                                <div style="word-wrap: break-word;"> {{ $item->description }}</div>
                            </td>
                            <td>
                                {{ replace(sprintf('%.3f', $item->prix_ht - $item->total_remise / $item->quantites)) }}
                            </td>
                            <td>
                                {{ $item->quantites }}

                            </td>
                            <td>{{ replace(sprintf('%.3f', $item->total_ht - $item->total_remise)) }}
                            </td>
                            <td>
                                {{ $item->tva }} %

                            </td>




                            <td><span
                                    id='total_ttc_id-{{ $key + 1 }}'>{{ replace(sprintf('%.3f', $item->total_ttc)) }}</span>
                            </td>

                        </tr>
                    @endforeach
                </tbody>


            </table>
        </div>


        {{-- <p class="lead">Total due</p> --}}
        <div class="row" style="border-top:1px #DDDDDD solid">
            <div class="col-xs-6">
                <br>
                <p style="font-size:12px">Arrêtée la présente facture à la somme de:</p>


                <?php

                $ttc = replace(sprintf('%.3f', round($facture->facture_ttc + $facture->facture_retenu, 3)));

                $totales = explode(',', $ttc);
                $partie_1 = $totales[0];

                if ($totales[1] == '000') {
                    $partie_2 = 0;
                } else {
                    $partie_2 = $totales[1];
                }
                $lettre = new ChiffreEnLettre();

                $lettres = $lettre->Conversion(intval($partie_1));
                $x = intval($partie_2);

                ?>



                <span style="font-size:13px;font-weight:500;text-transform : uppercase;">{{ ucfirst($lettres) }}
                    <?php echo \App\Models\Devise::where('symbole', $facture->devise)->first()->grande_unite; ?>
                    ,
                    {{ $x }} <?php echo \App\Models\Devise::where('symbole', $facture->devise)->first()->petite_unite; ?></span>
                <br>
                <br>
                <span style="font-size:12px">
                    <div class="invoice-subtotal" style="text-align:left">
                        <p style="font-size:12px"><span>Total Payé:</span>-
                            {{ replace(sprintf('%.3f', $facture->facture_paye)) }}
                            {{ $facture->devise }}</p>


                        <p style="font-size:12px"><span>Solde Restant:</span> <span
                                class="total-style-solde">{{ replace(sprintf('%.3f', $facture->facture_solde)) }}
                            </span>{{ $facture->devise }}
                        </p>
                    </div>

                </span>
                
                <span style="font-size:12px">
                    <div class="invoice-subtotal" style="text-align:left">
                        <p style="font-size:12px">
                           
                            {{ $facture->condition }}</p>


                      
                    </div>

                </span>
            </div>
            <div class="col-md-12">

                <table class="table" style="width:40%;float:right;border-top:none" id="total_table">
                    <tbody>
                        <tr style="border-top:none">
                            <td>Total HT:</td>
                            <td class="text-left">
                                {{ replace(sprintf('%.3f', $facture->facture_ht - $facture->facture_remise)) }}
                                {{ $facture->devise }}


                            </td>
                        </tr>

                        <tr>
                            <td>Total TVA:</td>
                            <td class="text-left">
                                {{ replace(sprintf('%.3f', $facture->facture_tva)) }} {{ $facture->devise }}
                            </td>
                        </tr>
                        <tr>
                            <td>Timbre:</td>
                            <td class="text-left">
                                {{ replace(sprintf('%.3f', $facture->timbre)) }} {{ $facture->devise }}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-bold-800" style="white-space: nowrap;"> <span class="total"><b>Total
                                        TTC:</b></span></td>
                            <td class="text-bold-800 text-left"> <b>

                                    <span class="total"> {{ replace(sprintf('%.3f', $facture->facture_ttc)) }}
                                        {{ $facture->devise }}

                                    </span>
                                </b></td>
                        </tr>

                    </tbody>
                </table>
            </div>




        </div>
        <br>

        <div class="footer">
            <table width="100%" style="margin-bottom: 5px;">
                <tr>
                    <td style="font-size:9px; text-align: center;">
                        {{$facture->entreprise->footer}} &nbsp;&nbsp;|&nbsp;&nbsp; 
                        Entrprise : {{$facture->entreprise->nom}} &nbsp;&nbsp;|&nbsp;&nbsp; 
                        adresse : {{$facture->entreprise->adresse}} &nbsp;&nbsp;|&nbsp;&nbsp; 
                        @if($facture->devise=="TND")
                            RIB : {{$facture->entreprise->rib}} &nbsp;&nbsp;|&nbsp;&nbsp; 
                            IBAN: {{$facture->entreprise->iban}}&nbsp;&nbsp;|&nbsp;&nbsp; 
                        @elseif($facture->devise=="€")
                            RIB EURO : {{$facture->entreprise->rib}} &nbsp;&nbsp;|&nbsp;&nbsp; 
                            IBAN EURO: {{$facture->entreprise->iban}}&nbsp;&nbsp;|&nbsp;&nbsp; 
                        @elseif($facture->devise=="$")
                            RIB USD: {{$facture->entreprise->rib}} &nbsp;&nbsp;|&nbsp;&nbsp; 
                            IBAN USD : {{$facture->entreprise->iban}}&nbsp;&nbsp;|&nbsp;&nbsp; 
                        @endif
                    </td>
                </tr>
            </table>
        </div>

    </div>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/php">
        if (isset($pdf)) {
            $text_color = array(0, 0, 0);
            $font = $fontMetrics->getFont("DejaVu Sans", "normal");
            $pdf->page_text(440, 75, "PAGE: {PAGE_NUM} / {PAGE_COUNT}", $font, 10, $text_color);
        }
    </script>
</body>

</html>

