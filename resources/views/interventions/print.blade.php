<?php

function replace($montant)
{
    $montant = str_replace('.', ',', $montant);
    return $montant;
}
function get_date($date)
{
    $day = date('w', strtotime($date));

    switch ($day) {
        case '0':
            $jour = 'Dimanche';

            break;
        case '1':
            $jour = 'Lundi';
            break;
        case '2':
            $jour = 'Mardi';

            break;
        case '3':
            $jour = 'Mercredi';

            break;
        case '4':
            $jour = 'Jeudi';

            break;
        case '5':
            $jour = 'Vendredi';

            break;
        case '6':
            $jour = 'Samedi';

            break;

        default:
    }

    $final_string = $jour . ' Le : ' . date('d/m/Y', strtotime($date));
    return $final_string;
}

?>






<html>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<style>
    .titre_div {
        text-align: center;
        font-weight: 700;
        padding: 5px;
    }

    .titre-des-div {
        text-align: center;
        font-weight: 700;
        border-top: 1px black solid;
        border-bottom: 1px black solid;
        padding: 5px;


    }

    .border_div {
        border: 1px black solid !important
    }

    .client_div {
        line-height: 1.5em;

    }

    .description-div {
        height: 470px;
        border-bottom: 1px black solid;

    }

    .final-div {
        font-weight: 700;
        border-bottom: 1px black solid;
    }

    .signature {
        text-align: center;
        vertical-align: middle;
        margin-top: 15px
    }

    .table-bordered th {
        border-bottom: 1px solid black !important;


    }

    .table-bordered {
        border-bottom: none !important;


    }

    .footer {
        position: absolute;
        right: 0;
        bottom: 0;
        left: 0;
        padding: 1rem;
        background-color: #efefef;
        text-align: center;
    }
</style>

<body>

    <div class="container">
        <div class="row">
            <div>
                <img class="logo" style="width:150px;height:60px"
                    src="data:image/png;base64,{{ base64_encode(@file_get_contents($photo)) }}">
            </div>
            <br>
            <div class="border_div" style="height:849px;margin-top:10px">

                <div class="titre_div" style="border-bottom: 1px black solid">
                    Fiche D'intervention
                </div>
                <br>
                <div class="client_div row">
                    <div class="col-xs-8" style="margin-left:5px">
                        <p>
                            <b>Date:</b> {{ $intervention->date }} <br>
                            <b>Client:</b> {{ $intervention->client->nom }} <br>
                            <b>Adresse:</b> {{ $intervention->client->adresse }} <br>
                        </p>
                    </div>
                    <div class="col-xs-4">
                        <img class="logo" style="width:160px;height:60px"
                            src="data:image/png;base64,{{ base64_encode(@file_get_contents($logo_client)) }}">
                    </div>
                </div>
                <br>

                <div class="titre-des-div">
                    Description
                </div>
                <div class="description-div">
                    <p style="margin-left:5px;margin-top:5px">
                        {{ $intervention->description }}
                    </p>
                </div>
                {{-- <div class="final-div row">
                    <div class="col-xs-6" style="border-right:1px black solid;margin-left:5px">
                        <p style="text-align:center;"> Intervenant </p>
                        <p> Nom: ................</p>

                    </div>

                    <div class="col-xs-6" style="border-right:1px black solid">
                        <p style="text-align:center;"> Client </p>
                        <p> Nom: ................</p>
                    </div>
                </div> --}}
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width:50%;text-align:center;border-right:1px black solid">
                                Intervenant
                            </th>
                            <th style="width:50%;text-align:center">
                                Client
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="line-height: 14px; ">
                            <td style="border-right:1px black solid">
                                <b> NOM:</b> {{ $intervention->intervenant }}
                                <div class='signature'>
                                    Signature
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                </div>
                            </td>
                            <td>
                                <b> NOM:</b> {{ $intervention->client->nom }}
                                <div class='signature'>
                                    Signature
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>



            </div>

            <div class="footer">
                <p style="font-size:12px">{{ $intervention->entreprise->footer }}</p>
            </div>
        </div>
    </div>





    {{--


    {{ $ordre->numero }} <br>
    <img style="width: 180px; height: 80px;"
        src="data:image/png;base64,{{ base64_encode(@file_get_contents($photo)) }}"> --}}

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</body>

</html>
