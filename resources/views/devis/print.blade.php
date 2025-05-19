<?php
function replace($montant)
{
    $montant = str_replace('.', ',', $montant);
    return $montant;
}
?>


<html>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<style>
    .titre {
        text-decoration: "capitalize"
    }


    .footer {
        position: fixed;
        right: 0 !important;
        bottom: 0 !important;
        left: 0 !important;
        padding: 1rem !important;
        text-align: center !important;
        background-color: #efefef;
        page-break-after: initial;


    }


    td,
    th {
        word-wrap: break-word;
        font-size: 12px
    }

    #total_table {
        border-top: none !important;
    }
</style>

<body>
    <div>
        <div class="row" style="border-bottom:1px black solid;padding:8px">
            <div class="col-xs-3">
                <img style="width: 180px; height: 80px;"
                    src="data:image/png;base64,{{ base64_encode(@file_get_contents($photo)) }}">
            </div>

            <div class="col-xs-8"style="margin-top:-20px">
                <h1 style="margin-left:106px">Devis #{{ $devis->numero }}</h1>
                <span style="float:right;margin-right:42px"><b>DATE:</b>{{ $devis->date }}</span>
            </div>
        </div>
        <div class="row" style="margin-top:25px">
            <div class="col-xs-5">
                <p class="addressMySam">
                    <strong style="font-size:22px;text-decoration:capitalize">Client</strong><br />
                    {{ $devis->client->nom }}<br />
                    {{ $devis->client->adresse }}<br />
                    {{ $devis->client->telephone }}
                </p>
            </div>
            <div class="col-xs-6">
                <table class="table" style="font-size:12px;">
                    <tr >
                        <td>Total : <b>{{ replace(sprintf('%.3f', $devis->devis_ttc)) }}</b></td>
                        <td>Devise :<b><?php echo \App\Models\Devise::where('symbole', $devis->devise)->first()->code; ?></b></td>
                        <td>Offre valable: <b>15 jours </b></td>
                    </tr>
					 <tr >
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </table>

            </div>


        </div>

        <div>
            <table class="table" style="margin-top:20px" id="product_table">
                <thead>
                    <tr>
                        <th style="width:11%">Produit</th>
                        <th style="width:37%">Description</th>
						<th style="width:10%">PU HT</th>
                        <th style="width:7%">QTE</th>
						<th style="width:10%">Total HT</th>
                        <th style="width:7%">TVA</th>
						@if($devis->devis_remise != 0)
 <th style="width:7%">Remise</th>@endif

                        <th style="width:14%">Total TTC</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($devis->items as $key => $item)
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
                                {{ replace(sprintf('%.3f', $item->prix_ht)) }}
                            </td>
                            <td>
                                {{ $item->quantites }}

                            </td>
                            <td>{{ replace(sprintf('%.3f', $item->total_ht )) }}
                            </td>
                           
<td>
                                {{ $item->tva }} %

                            </td>


  @if($devis->devis_remise != 0)<td>
                                {{ $item->remise }} 

                            </td>%@endif
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
            <div class="col-xs-6" style="border-top:1px #DDDDDD solid">
                <div style="margin-top:12px">
                    <span style="font-size:11px;"></span>
                </div>
            </div>
            <div class="col-xs-5">
                <table class="table" style="border-top:1px #DDDDDD solid" id="total_table">
                    <tbody>
                        <tr style="border-top:none">
                            <td>Total HT:</td>
                            <td class="text-left">
                                {{ replace(sprintf('%.3f', $devis->devis_ht)) }}
                                {{ $devis->devise }}


                            </td>
                        </tr>
 @if($devis->devis_remise != 0)
<tr>
                            <td>Total Remise:</td>
                            <td class="text-left">
                               - {{ replace(sprintf('%.3f', $devis->devis_remise)) }} {{ $devis->devise }}
                            </td>
                        </tr>@endif

                        <tr>
                            <td>Total TVA:</td>
                            <td class="text-left">
                                {{ replace(sprintf('%.3f', $devis->devis_tva)) }} {{ $devis->devise }}
                            </td>
                        </tr>
						
                        <tr>
                            <td class="text-bold-800" style="white-space: nowrap;"> <span class="total"><b>Total
                                        TTC:</b></span></td>
                            <td class="text-bold-800 text-left"> <b>

                                    <span class="total"> {{ replace(sprintf('%.3f', $devis->devis_ttc)) }}
                                        {{ $devis->devise }}

                                    </span>
                                </b></td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
		<div class="col-xs-6" style="border-top:1px #DDDDDD solid">
                <div style="margin-top:12px">
                    <span style="font-size:11px;"><strong>Conditions de ventes :</strong>  {!! nl2br(e($devis->condition)) !!}</span>
                </div>
            </div>
        <br>

        <!-- Invoice Footer -->
     <div class="footer">
        <p style="font-size:9px">
			{{$devis->entreprise->footer}}
			BIAT SARL;
			@if($devis->devise=="TND")
			RIB : 0800 8000 6710 0226 3083;IBAN: TN59 0800 8000 6710 0226 3083;
			@elseif($devis->devise=="€")
			RIB EURO : 08 008 000675902674 23;IBAN EURO: TN59 08 008 000675902674 23
			@elseif($devis->devise=="$")
			RIB USD: 08 008 0006759027203 49;IBAN USD : TN59 08 008 0006759027203 49
			@endif



		</p>
    </div>
        <!--/ Invoice Footer -->

        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</body>

</html>
