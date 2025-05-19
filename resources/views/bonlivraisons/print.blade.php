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
                <h1 style="margin-left:106px">#{{ $bonlivraison->numero }}</h1>
                <span style="float:right;margin-right:42px"><b>DATE:</b>{{ $bonlivraison->date }}</span>
            </div>
        </div>
        <div class="row" style="margin-top:25px">
            <div class="col-xs-7" >
                <p class="addressMySam">
                    <strong style="font-size:22px;text-decoration:capitalize">Client</strong><br />
                    {{ $bonlivraison->client->nom }}<br />
                    {{ $bonlivraison->client->adresse }}<br />
                    {{ $bonlivraison->client->telephone }}
                </p>
            </div>
			   <div class="col-xs-4" >
                <p class="addressMySam">
                    <strong style="font-size:22px;text-decoration:capitalize">{{ $bonlivraison->entreprise->nom }}</strong><br />
                    {{ $bonlivraison->entreprise->adresse }}<br />
                    {{ $bonlivraison->entreprise->telephone }}<br />
					M/F:{{ $bonlivraison->entreprise->mf }}<br />

                </p>
            </div>


        </div>

        <div>
            <table class="table" style="margin-top:20px" id="product_table">
                <thead>
                    <tr>
                        <th style="width:20%">Produit</th>
                        <th>Description</th>
                        <th style="width:20%">QTE</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bonlivraison->items as $key => $item)
                        <tr id="{{ $key + 1 }}">

                            <td>
                                {{ $item->produit }}
                            </td>
                            <td>
                                <div style="word-wrap: break-word;"> {!! nl2br(e($item->description)) !!}</div>
                            </td>
                            <td>
                                {{ $item->quantites }}

                            </td>
                        </tr>
                    @endforeach
                </tbody>


            </table>
        </div>


        {{-- <p class="lead">Total due</p> --}}
        {{-- <div class="row" style="border-top:1px #DDDDDD solid">
            <div class="col-md-12">
                <table class="table" style="width:40%;float:right;border-top:none" id="total_table">
                    <tbody>
                        <tr style="border-top:none">
                            <td>Total HT:</td>
                            <td class="text-left">
                                {{ replace(sprintf('%.3f', $bonlivraison->bonlivraison_ht - $bonlivraison->bonlivraison_remise)) }} TND


                            </td>
                        </tr>

                        <tr>
                            <td>Total TVA:</td>
                            <td class="text-left">
                                {{ replace(sprintf('%.3f', $bonlivraison->bonlivraison_tva)) }} TND
                            </td>
                        </tr>
                        <tr>
                            <td class="text-bold-800" style="white-space: nowrap;"> <span class="total"><b>Total
                                        TTC:</b></span></td>
                            <td class="text-bold-800 text-left"> <b>

                                    <span class="total"> {{ replace(sprintf('%.3f', $bonlivraison->bonlivraison_ttc)) }}
                                        TND

                                    </span>
                                </b></td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div> --}}
        <br>

        <!-- Invoice Footer -->
        <div class="footer">
            <p style="font-size:12px">{{ $bonlivraison->footer }}</p>
        </div>
        <!--/ Invoice Footer -->

        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</body>

</html>
