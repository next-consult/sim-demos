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
    .table-titre td {
        border: 2px inset #000000 !important;
        padding: 5px;
        font-size: 12px;
        font-weight: bold;

    }

    .table-destin td {
        border: 2px inset #000000 !important;
        padding: 5px;
        font-size: 12px;
        font-weight: 400;

    }

    .table-destin {
        margin-top: 40px !important;
        border-collapse: collapse !important;
        width: 100%
    }

    .no-ordre {
        font-size: 12px;
        font-weight: bold;
        margin-left: -8px !important
    }

    .table-titre {
        margin-top: -30px !important;
        border-collapse: collapse !important;
        width: 100%
    }

    .title-td {
        font-size: 13px !important;

    }

    .center-td {
        text-align: center
    }

    .img-checkbox {
        width: 20px;
        height: 20px;

    }

    .img-checkbox-checked {
        width: 15px;
        height: 16px;
        margin-left: 3px !important;

    }

    .label-checkbox {
        margin-left: 26px;
        margin-top: 5px;
        font-size: 12px !important;
        font-weight: 400;

    }

    .height-td {

        height: 23px !important;
    }

    .espace-table {
        margin-top: -30px
    }

    .td-data {

        font-size: 13px !important;
        font-weight: 500 !important;

    }
</style>

<body>

    <div class="container">
        <div class="row">
            <div>

                <table class="table-titre">
                    <tr>
                        <td rowspan="3" class="center-td" style="width:25%">

                            <img class="logo" style="width:150px;height:60px"
                                src="data:image/png;base64,{{ base64_encode(@file_get_contents($photo)) }}">

                        </td>
                        <td class="center-td ">Formulaire</td>
                        <td>FOR.LOG.001</td>
                    </tr>
                    <tr>
                        <td rowspan="2" class="center-td">Ordre de transport</td>
                        <td>Version 06</td>
                    </tr>
                    <td>Page : 1/1</td>


                </table>

            </div>
            <br>
            <br>
            <br>
            <div style="text-align:center;margin-top:-50px">
                <span class="no-ordre">N° : {{ $ordre->numero }}</span>

            </div>
            <div>
                <div style="margin-top:-55px">
                    <table class="table-destin">
                        <tr>
                            <td rowspan="3" class="center-td title-td" style="width:25%">ENLEVEMENT</td>
                            <td class="center-td" style="width:20%">
                                <div class="height-td">
                                    Adresse
                                </div>
                            </td>
                            <td class="td-data">{{ $ordre->items->adress_enlev }}</td>
                        </tr>
                        <tr>
                            <td class="center-td">
                                <div class="height-td">Nom du contact</div>
                            </td>
                            <td class="td-data">{{ $ordre->items->nom_enlev }}</td>
                        </tr>
                        <tr>
                            <td class="center-td">
                                <div class="height-td">Tranche horraire</div>
                            </td>
                            <td class="td-data">
                                @if ($ordre->items->date_enlev)
                                    {{ get_date($ordre->items->date_enlev) }}
                                @endif

                            </td>
                        </tr>


                    </table>
                </div>
                <div class="espace-table">
                    <table class="table-destin">
                        <tr>
                            <td rowspan="3" class="center-td title-td" style="width:25%">LIVRAISON</td>
                            <td class="center-td" style="width:20%">
                                <div class="height-td">Adresse</div>
                            </td>
                            <td class="td-data">{{ $ordre->items->adress_livraison }}</td>
                        </tr>
                        <tr>
                            <td class="center-td">
                                <div class="height-td">Nom du contact</div>
                            </td>
                            <td class="td-data">{{ $ordre->items->nom_livraison }}</td>
                        </tr>
                        <tr style="background-color:#D0D3D4 ">
                            <td class="center-td">
                                <div class="height-td">Horaire objectif</div>
                            </td>
                            <td class="td-data">
                                @if ($ordre->items->date_livraison)
                                    {{ get_date($ordre->items->date_livraison) }}
                                @endif
                            </td>
                        </tr>


                    </table>
                </div>
                <div class="espace-table">

                    <table class="table-destin">
                        <tr>
                            <td rowspan="4" class="center-td title-td" style="width:25%">MARCHANDISES
                                A TRANSPORTER</td>
                            <td class="center-td" style="width:20%">
                                <div class="height-td">Nature</div>
                            </td>
                            <td class="td-data">{{ $ordre->items->nature }}</td>
                        </tr>
                        <tr>
                            <td class="center-td">
                                <div class="height-td">Poids</div>
                            </td>
                            <td class="td-data">
                                @if ($ordre->items->poids >= 0)
                                    {{ $ordre->items->poids }} KGS
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="center-td">
                                <div class="height-td">Nombre de colis</div>
                            </td>
                            <td class="td-data">{{ $ordre->items->nb_coliss }}</td>
                        </tr>
                        <tr>
                            <td class="center-td">
                                <div class="height-td">Volume</div>
                            </td>
                            <td class="td-data">
                                @if ($ordre->items->volume >= 0)
                                    {{ $ordre->items->volume }} M³
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="center-td title-td">Spécificités</td>
                            <?php
                            
                            $specif = $ordre->items->specif;
                            
                            ?>
                            <td colspan="2">
                                <div class="form-check checkbox-xl">

                                    @if ($specif == 'inflam')
                                        <img class="img-checkbox-checked"
                                            src="data:image/png;base64,{{ base64_encode(@file_get_contents('assets/img/checked.png')) }}">
                                    @else()
                                        <img class="img-checkbox"
                                            src="data:image/png;base64,{{ base64_encode(@file_get_contents('assets/img/checkbox.png')) }}">
                                    @endif



                                    <label class="form-check-label label-checkbox" for="checkbox-3">Inflamable</label>
                                </div>

                                <div class="form-check checkbox-xl">
                                    @if ($specif == 'fragile')
                                        <img class="img-checkbox-checked"
                                            src="data:image/png;base64,{{ base64_encode(@file_get_contents('assets/img/checked.png')) }}">
                                    @else()
                                        <img class="img-checkbox"
                                            src="data:image/png;base64,{{ base64_encode(@file_get_contents('assets/img/checkbox.png')) }}">
                                    @endif

                                    <label class="form-check-label label-checkbox" for="checkbox-3">Fragile</label>
                                </div>

                                <div class="form-check checkbox-xl">


                                    @if ($specif != 'inflam' && $specif != 'fragile')
                                        <img class="img-checkbox-checked"
                                            src="data:image/png;base64,{{ base64_encode(@file_get_contents('assets/img/checked.png')) }}">
                                    @else
                                        <img class="img-checkbox"
                                            src="data:image/png;base64,{{ base64_encode(@file_get_contents('assets/img/checkbox.png')) }}">
                                    @endif

                                    <label class="form-check-label label-checkbox" for="checkbox-3">Autre : @if ($specif != null && $specif != 'inflam' && $specif != 'fragile')
                                            <b>{{ $specif }}</b>
                                        @endif
                                    </label>
                                </div>
                            </td>
                        </tr>


                    </table>
                </div>
                <div class="espace-table">


                    <table class="table-destin">
                        <tr>
                            <td class="center-td title-td" style="width:25%">
                                <div style="height: 40px; overflow:hidden;">
                                    N° dossier

                                </div>

                            </td>
                            <td class="center-td title-td" style="width:20%">
                                <div style="height: 30px; overflow:hidden;">
                                    N°

                                </div>

                            </td>
                            <td class="td-data">
                                <div style="height: 30px; overflow:hidden;">
                                    {{ $ordre->items->no_dossier }}

                                </div>

                            </td>
                        </tr>



                    </table>
                </div>
                <div class="espace-table">

                    <table class="table-destin">
                        <tr>
                            <td class="center-td title-td" style="width:25%">
                                <div style="height: 45px; overflow:hidden;">
                                    REMARQUES
                                    ADDITIONNELLES



                                </div>

                            </td>
                            <td class=" td-data">
                                <div style="height: 56px; overflow:hidden;">
                                    {{ $ordre->items->remarques }}

                                </div>

                            </td>

                        </tr>



                    </table>
                </div>

                <div class="espace-table">

                    <table class="table-destin">
                        <tr>
                            <td colspan="2" style="text-align:right">
                                <span style="margin-right:40px">Prix Achat</span>
                            </td>

                            <td style="width:55%;" class="td-data">
                                @if ($ordre->items->prix_achat >= 0)
                                    {{ replace(sprintf('%.3f', $ordre->items->prix_achat)) }} DT
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td rowspan="3" class="center-td">
                                CONDITIONS
                                TRANSPORT

                            </td>
                            <td class="center-td">Prix Vente</td>
                            <td class="td-data">
                                @if ($ordre->items->prix_vente >= 0)
                                    {{ replace(sprintf('%.3f', $ordre->items->prix_vente)) }} DT
                                @endif


                            </td>

                        </tr>
                        <tr>
                            <td class="center-td">Matricule camion</td>
                            <td class="td-data">
                                @if ($ordre->items->camion)
                                    {{ $ordre->items->camion->matricule }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="center-td">Chauffeur</td>
                            <td class="td-data">
                                @if ($ordre->items->chauffeur)
                                    {{ $ordre->items->chauffeur->nom }}
                                    {{ $ordre->items->chauffeur->prenom }}
                                @endif
                            </td>

                        </tr>
                        <tr>
                            <td colspan="2" class="center-td">
                                <div style="height: 38px; overflow:hidden;">Evaluation transporteur
                                </div>
                            </td>

                            <td class="td-data">
                                <div style="height: 38px; overflow:hidden;">
                                    {{ $ordre->items->evaluation }}
                                </div>

                            </td>
                        </tr>

                    </table>
                </div>


            </div>
            <div style="text-align:right">
                Date : {{ date('d/m/Y') }}
            </div>
            <div style="margin-left:15px;font-size:12px">
                {{ $ordre->devis->entreprise->nom }}<br>
                {{ $ordre->devis->entreprise->adresse }}<br>
                <b>Tel :</b> {{ $ordre->devis->entreprise->telephone }}<br>
                <b>E-mail :</b> {{ $ordre->devis->entreprise->email }}
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
