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
    .titre_div {
        text-align: left;
        font-weight: bold;
        padding: 5px;
    }

    .border_div {
        border: 1px black solid !important
    }

    th {
        font-size: 11px
    }
</style>

<body>


    <div class="container">
        <div class="border_div row">
            <div class="titre_div row">
                <div class="col-xs-5" style="margin-left:5px">

                    <p style="font-size:11px"> REPUBLIQUE TUNISIENNE <br>
                        MINISTERE DU PLAN ET DES FINANCES <br><br>
                        DIRECTION GENERALE
                        DU CONTROLE FISCAL </p>
                </div>
                <div class="col-xs-4" style="margin-left:10px">
                    <p style="font-size:9px"> CERTIFICAT DE RETENUE D'IMPOT SUR LE REVENU OU D'IMPOT SUR LES
                        SOCIETES </p>
                    <br><br>
                    <p style="font-size:14px;margin-left:-100px;margin-top:10px"> Retenue effectuee
                        le:{{ Date('Y-m-d') }} </p>

                </div>
            </div>



        </div>
        <div class="border_div row">
            <div class="titre_div row">
                <div class="col-xs-4" style="margin-left:5px">

                    <p style="font-size:11px">A.- PERSONNE OU ORGANISME PAYEUR</p>
                </div>
                <div class="col-xs-7" style="margin-left:10px">
                    <p style="font-size:9px">IDENTIFIANT</p>
                    <br>

                    <table class="table table-bordered" style="width:97%">
                        <thead>
                            <tr>
                                <th style="width:25%;text-align:center">
                                    MATRICULE FISCAL
                                </th>
                                <th style="width:25%;text-align:center">
                                    CODE TVA
                                </th>
                                <th style="width:25%;text-align:center">
                                    CODE Categorie(2)

                                </th>
                                <th style="width:25%;text-align:center">
                                    No Etab secondaire
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    {{ $facture->type=="fournisseur" ? $facture->fournisseur->mf : $facture->entreprise->mf }}
                                </td>
                                <td>
                                    A
                                </td>
                                <td>
                                    M
                                </td>
                                <td>
                                    000
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
            <div class="titre_div row">

                <div class="col-xs-10" style="margin-left:5px">

                    <p style="font-size:11px">Denomination de la personne ou de l'organisme payeur :  {{ $facture->type=="fournisseur" ? $facture->fournisseur->nom : $facture->entreprise->nom }}</p>
                    <p style="font-size:11px">Adresse :  {{ $facture->type=="fournisseur" ? $facture->fournisseur->adresse : $facture->entreprise->adresse }}</p>
                </div>
            </div>


        </div>
        <div class="border_div row">
            <div class="titre_div row">
                <div class="col-xs-5" style="margin-left:5px">

                    <p style="font-size:11px">B.- RETENUES EFFECTUEES SUR :</p>
                </div>
                <div class="col-xs-6" style="margin-left:10px">
                    <table class="table table-bordered" style="width:97%">
                        <thead>
                            <tr>
                                <th style="width:25%;text-align:center">
                                    MONTANT BRUT
                                </th>
                                <th style="width:25%;text-align:center">
                                    RETENUE
                                </th>
                                <th style="width:25%;text-align:center">
                                    MONTANT NET

                                </th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $facture_net=$facture->facture_ttc;
                            $facture_retenu = $facture->facture_ttc * (1 / 100);
                            $facture_net -= round($facture_retenu, 3);
                            ?>
                            <tr>
                                <td>
                                    {{ replace(sprintf('%.3f', $facture->facture_ttc)) }}
                                </td>
                                <td>
                                    {{ replace(sprintf('%.3f', $facture_retenu)) }}
                                </td>
                                <td>
                                    {{ replace(sprintf('%.3f', $facture_net)) }}

                                </td>

                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
            <div class="row" style="margin-top:-25px">

                <div class="col-xs-10" style="margin-left:5px">

                    <p style="font-size:11px">-1%</p>
                    <p style="font-size:11px">-Honoraires</p>
                    <p style="font-size:11px">-Commissions, Courtages et Loyer</p>
                    <p style="font-size:11px">
                        -Redevances...................................................................</p>
                    <p style="font-size:11px">-Revenus des comptes speciaux d'epargne ouverts aupres des banques.</p>
                    <p style="font-size:11px">-Revenus des comptes speciaux d'epargne ouverts aupres des banques.</p>
                    <p style="font-size:11px">-Revenus des capitaux mobiliers .................................</p>
                    <p style="font-size:11px">-Revenus des bons de caisse au porteur</p>

                    <p style="font-size:14px;font-weight:600">Facture N°:<span style="font-weight:700;font-size:14px">
                            {{ $facture->numero }} </span> </p>
                </div>
            </div>


        </div>
        <div class="border_div row">
            <div class="titre_div row">
                <div class="col-xs-4" style="margin-left:5px">

                    <p style="font-size:11px">C.-BENEFICIAIRE</p>
                </div>
                <div class="col-xs-7" style="margin-left:10px">

                    <br>

                    <table class="table table-bordered" style="width:97%">
                        <thead>
                            <tr>
                                <th style="width:25%;text-align:center">
                                    MATRICULE FISCAL
                                </th>
                                <th style="width:25%;text-align:center">
                                    CODE TVA
                                </th>
                                <th style="width:25%;text-align:center">
                                    CODE Categorie(2)

                                </th>
                                <th style="width:25%;text-align:center">
                                    No Etab secondaire
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    {{ $facture->type=="fournisseur" ? $facture->entreprise->mf : $facture->client->mf }}
                                </td>
                                <td>
                                    A
                                </td>
                                <td>
                                    M
                                </td>
                                <td>
                                    000
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
            <div class="titre_div row" style="margin-top:-110px">

                <div class="col-xs-10" style="margin-left:5px">

                    <p style="font-size:11px">No de la carte d'idendite <br> ou <br> de sejour pour les etrangers</p>
                    <br>
                    <br>
                    <p style="font-size:11px">Nom, prenoms ou raison sociale:<span
                            style="font-weight:400;font-size:12px">  {{ $facture->type=="fournisseur" ? $facture->entreprise->nom : $facture->client->nom }} </span></p>
                    <p style="font-size:11px">Adresse professionnelle:<span style="font-weight:400;font-size:12px">
                             {{ $facture->type=="fournisseur" ? $facture->entreprise->adresse : $facture->client->adresse }} </span></p>
                </div>
            </div>


        </div>
    </div>





















    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</html>
