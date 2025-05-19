<html>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<style>
    .nom-entreprise {
        color: #2874A6 !important;
        font-family: serif !important
    }

    .detail-entreprise {
        margin-top: -8px;
        color: #2874A6 !important;
        font-size: 13px;
        font-weight: 500;
        font-family: serif !important
    }

    .livraison-label {
        font-size: 13px;
        font-weight: 600;
        color: black;
    }

    .livraison-info {
        font-size: 12px;
        font-weight: 400;
        color: black;
        margin-left: 3px;
    }

    .livraison {
        font-size: 11px !important;
        text-align: center !important;
        color: black !important;
    }

    .th-livraison {
        font-size: 11px !important;
        text-align: center !important;
        color: black !important;
        background-color: #BDC3C7
    }

    .img-checkbox {
        width: 25px;
        height: 25px;

    }

    .title-livraison {
        text-align: center;
        color: #333;
        font-size: 23px;
        margin-bottom: 50px;
        margin-top: 10px;
        font-weight: 700;
        font-family: 'Trebuchet MS', sans-serif !important;
    }

    span {
        line-height: 1em
    }

    #footer {
        position: absolute;
        bottom: 0;
        width: 100%;
        height: 2.5rem;
        border-top:1px black solid;
        padding-top:8px;
        color: #2874A6 !important;
        font-weight:600;
        font-family:12px !important;

        /* Footer height */
    }
</style>

<body>
    <div class="row" style="margin-top:-10px;border-bottom: 1px solid black;padding-bottom:15px">

        <div class="col-xs-4">
            <img style="width: 180px; height: 80px;"
                src="data:image/png;base64,{{ base64_encode(@file_get_contents($photo)) }}">
        </div>

        <div class="col-xs-8 " style="margin-top:-30px">
            <h3 class="nom-entreprise">{{ $livraison->ordre->entreprise->nom }}</h3>
            <div class="detail-entreprise">
                <span>{{ $livraison->ordre->entreprise->adresse }}</span><br>
                <span>Code Fiscal: {{ $livraison->ordre->entreprise->mf }}</span><br>
                <span> E-mail :{{ $livraison->ordre->entreprise->email }} @if ($livraison->ordre->entreprise->web)
                        - web site : {{ $livraison->ordre->entreprise->web }}
                    @endif
                </span><br>
            </div>
        </div>



    </div>
    <div class="title-livraison">
        BON DE LIVRAISON / DELIVERY NOTE: {{ $livraison->numero }}
    </div>
    <div class="row">
        <div class="col-xs-6">
            <p class="livraison-label">Date : <span
                    class="livraison-info">{{ date('d/m/Y', strtotime($livraison->date)) }}</p>
            <p class="livraison-label">Our Ref :<span class="livraison-info">{{ $livraison->ordre->items->no_dossier }}
            </p>
            <p class="livraison-label">Master BL:<span class="livraison-info">{{ $livraison->master_bl }}</p>
            <p class="livraison-label">Lieu d’enlèvement / Pick up address:</span><span
                    class="livraison-info">{{ $livraison->ordre->items->adress_enlev }}</p>
            <p class="livraison-label">Lieu de livraison / Delivery address:</span><span
                    class="livraison-info">{{ $livraison->ordre->items->adress_livraison }}</p>
            <p class="livraison-label">Expéditeur/Sender: </span><span
                    class="livraison-info">{{ $livraison->ordre->items->nom_enlev }}</p>
            <p class="livraison-label">Destinataire/Receiver:</span><span
                    class="livraison-info">{{ $livraison->ordre->items->nom_livraison }}</p>
            <p class="livraison-label">Chauffer / Driver:</span><span
                    class="livraison-info">
                    
                   @if ($livraison->ordre->items->chauffeur) {{ $livraison->ordre->items->chauffeur->nom }}
                    {{ $livraison->ordre->items->chauffeur->prenom }}@endif</p>
        </div>
        <div class="col-xs-6" style="margin-top:-3px">
            <p class="livraison-label"> EMIS PAR/ISSUED BY:</span><span
                    class="livraison-info">{{ $livraison->user->name }}</p>
            <p class="livraison-label"> Client / Customer:</span><span
                    class="livraison-info">{{ $livraison->ordre->client->nom }}
                    {{ $livraison->ordre->client->prenom }}</p>
            <p class="livraison-label"> House BL:</span><span class="livraison-info">{{ $livraison->house_bl }}</p>

            <p class="livraison-label" style="margin-top:128px">Matr. camion / Truck nbr: </span>@if ($livraison->ordre->items->camion)<span
                    class="livraison-info">{{ $livraison->ordre->items->camion->matricule }}@endif</p>
        </div>

    </div>

    <div style="margin-top:20px">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="th-livraison">
                        Nbre colis/Number of packages
                    </th>
                    <th class="th-livraison">
                        Poids/Weight
                    </th>
                    <th class="th-livraison">
                        Marchandise/Commodity
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="livraison">{{ $livraison->ordre->items->nb_coliss }}</td>
                    <td class="livraison">{{ $livraison->ordre->items->poids }}</td>
                    <td class="livraison">{{ $livraison->ordre->items->nature }}</td>
                </tr>

            </tbody>


        </table>
    </div>
    <br>
    <div class="row">
        <div class="col-xs-6">
            <p class="livraison-label">
                Date d’arrivée/Arrival date:</span> <span class="livraison-info"></p>
            <p class="livraison-label">Chauffer / Driver:</span><span
                    class="livraison-info">@if ($livraison->ordre->items->chauffeur){{ $livraison->ordre->items->chauffeur->nom }}
                    {{ $livraison->ordre->items->chauffeur->prenom }}@endif</p>

        </div>
        <div class="col-xs-6" style="margin-top:-3px">
            <p class="livraison-label">Heure d’arrivée/Arrival time:</p>
            <p class="livraison-label">Heure d’arrivée / Arrival time :</p>
        </div>

    </div>
    <br>
    <br>
    <div>
        <img class="img-checkbox"
            src="data:image/png;base64,{{ base64_encode(@file_get_contents('assets/img/checkbox.png')) }}">
        <span class="livraison-label">Sans manquant, ni dégâts apparents / No Loss or apparent damages
        </span><br>

        <img style="margin-top:3px" class="img-checkbox"
            src="data:image/png;base64,{{ base64_encode(@file_get_contents('assets/img/checkbox.png')) }}">
        <span class="livraison-label">Avec manquant ou dégât / With loss or damages:
        </span>

    </div>

    <br>
    <br>
    <br>
    <div>
        <p class="livraison-label">
            Réceptionnaire /Receiver: </p>
        <p class="livraison-label">Nom / Name : </p>
        <p class="livraison-label">Signature + Cachet / Stamp: </p>



    </div>

    <div id="footer">
        <p style="font-size:13px">{{ $livraison->footer }}</p>
    </div>

























    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</body>

</html>
