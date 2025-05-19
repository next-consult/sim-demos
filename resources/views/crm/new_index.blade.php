@extends('layouts.app')

@section('content')
    <?php
    $date_debut = Date('Y') . '-01-01';
    $date_fin = Date('Y') . '-12-31';

    ?>
    <!-- Breadcromb Row Start -->
    <div class="row">
        <div class="col-md-12">
            <div class="breadcromb-area">
                <div class="row">
                    <div class="col-md-2">
                        <div class="seipkon-breadcromb-left">
                            <h3>Pipeline</h3>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group row">
                            <label for='inputPassword' class='col-md-4 col-form-label'>Status</label>
                            <div class='col-md-8'>

                                <select class="form-control opp-class" id="opp-status">
                                    <option value="">Tous</option>
                                    <option value="Opportunité">Opportunité</option>
                                    <option value="Devis">Devis</option>
                                    <option value="Facture">Facture</option>

                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-3">
                        <div class="form-group row">
                            <label for='inputPassword' class='col-md-4 col-form-label'>Date de début</label>
                            <div class='col-md-8'>
                                <input type="date" id="start_date" class="form-control change_date"
                                    value="{{ $date_debut }}">
                            </div>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label for='inputPassword' class='col-md-4 col-form-label'>Date de fin</label>
                            <div class='col-md-8'>
                                <input type="date" id="end_date" class="form-control change_date"
                                    value="{{ $date_fin }}">
                            </div>

                        </div>

                    </div>

                    <div class="col-md-2">
                        <button id="filter_btn" class="btn btn-primary">Filtrer</button>

                    </div>
                </div>

            </div>
        </div>
        <!-- End Breadcromb Row -->

        <!-- Advance Table Row Start -->
        <div class="row">
            <div class="col-md-12">
                <div class="page-box">
                    <div class="datatables-example-heading">
                    </div>
                    <div class="table-responsive ">
                        <table class="table display table-bordered " id="crm_table">
                            <thead>
                                <tr>
                                    <th>Numéro</th>
                                    <th>R/S</th>
                                    <th>Nom et prénom</th>
                                    <th>Poste</th>
                                    <th>Email</th>
                                    <th>Telephone</th>
                                    <th>Mobile</th>
                                    <th>Status</th>
                                    <th>Date d'ajout</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($oportunitys as $opp)
                                    <tr>
                                        <td>{{$opp->numero}}</td>
                                        <td>{{ $opp->contact->raison_social }}</td>
                                        <td>{{ $opp->contact->nom }} {{ $opp->contact->prenom }}</td>
                                        <td>{{ $opp->contact->poste }}</td>
                                        <td>{{ $opp->contact->email }}</td>
                                        <td>{{ $opp->contact->telephone }}</td>
                                        <td>{{ $opp->contact->mobile }}</td>

                                        <td>
                                            @if ($opp->step == '1')
                                                <span class="badge badge-warning">Opportunité</span>
                                            @elseif($opp->step == '2')
                                                <span class="badge badge-info">Devis</span>
                                            @elseif($opp->step == '3')
                                                <span class="badge badge-success">Facture</span>
                                            @endif

                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($opp->created_at)->format('Y-m-d') }}</td>

                                        <td style="text-align:left">
                                            <div class="dropdown">
                                                <button class="btn btn-options btn-success dropdown-toggle" type="button"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Options <i class="fa-solid fa-circle-chevron-down"></i>
                                                </button>
                                                <div class="dropdown-menu pull-right" aria-labelledby="dropdownMenuButton">
                                                    <ul class="list-group">
                                                        @if ($opp->step != 3)
                                                            <a href="#">
                                                                <li class="list-group-item next-step"
                                                                    data-id="{{ $opp->id }}"
                                                                    data-step="{{ $opp->step }}"> <i
                                                                        class="fas fa-arrow-right"></i>
                                                                    @if ($opp->step == 1)
                                                                        Devis
                                                                    @elseif($opp->step == 2)
                                                                        Facture
                                                                    @endif

                                                                </li>
                                                            </a>
                                                        @endif
                                                        <a href="#" data-toggle="modal" data-target="#update_opp"
                                                            class="update_button" data-id="{{ $opp->id }}"
                                                            id="update_test{{ $opp->id }}"
                                                            onclick="update_modal({{ $opp->id }},'show')">
                                                            <li class="list-group-item"><i class="fa fa-eye"
                                                                    style="margin-right:5px"></i> Afficher </li>
                                                        </a>
                                                        <a href="#" data-toggle="modal" data-target="#update_opp"
                                                            class="update_button" data-id="{{ $opp->id }}"
                                                            onclick="update_modal({{ $opp->id }},'update')">
                                                            <li class="list-group-item"><i class="fa fa-pen"
                                                                    style="margin-right:5px"></i> Modifier </li>
                                                        </a>
                                                        <a href="#">
                                                            <li class="list-group-item delete-li" style="cursor:pointer"
                                                                onclick="deleteopportunite({{ $opp->id }})"><i
                                                                    class="fa-solid fa-trash"
                                                                    style="margin-right:5px;"></i>Supprimer</li>
                                                        </a>
                                                    </ul>
                                                </div>
                                            </div>

                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- UpdateModal -->
        <div class="modal  fade" id="update_opp" role="dialog">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="row">
                            <div class="col-md-9">
                                <h4 class="modal-title" style="float:left" id="exampleModalLongTitle">Gérer
                                    l'opportunité (<span id="code_opp"></span>)
                                </h4>

                            </div>

                            <div class="col-md-3">


                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                                    style="float:right" onclick="close_modal()">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                        </div>



                    </div>

                    <div class="modal-body">
                        <div class="tabs-example">
                            <div class="tabs-box-example horizontal-tab-example">
                                <ul class="nav nav-tabs" id="service_pro" role="tablist">
                                    <li role="presentation" id="detail_tab" class="active"><a href="#details"
                                            role="tab" data-toggle="tab">Détails</a></li>
                                    <li role="presentation" id="notes_tab"><a href="#notes" role="tab"
                                            data-toggle="tab">Notes</a>
                                    <li id="devis_tab" role="presentation"><a href="#devis" role="tab"
                                            data-toggle="tab">Devis</a>
                                    </li>
                                    <li id="facture_tab" role="presentation"><a href="#factures" role="tab"
                                            data-toggle="tab">Facture</a>
                                    </li>

                                    <li id="document_tab" role="presentation"><a href="#documents" role="tab"
                                            data-toggle="tab"> Autre documents</a>
                                    </li>
                                    {{--
                                    <li role="devis"><a href="#devis" role="tab"
                                            data-toggle="tab">devis</a></li> --}}
                                </ul>
                            </div>
                            <div id="seipkkon_tab_content" class="tab-content">
                                <div id="details" class="tab-pane fade in active">
                                    <div class="row justify-content-center">
                                        <div class="col-md-12" id="detail_show">

                                        </div>
                                    </div>
                                </div>
                                <div id="notes" class="tab-pane fade in ">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button class="btn btn-primary " style="float:right" onclick="save_notes()"
                                                id="save_note">Enregistrer les notes</button>
                                            <br>
                                            <button class="btn btn-success " id="add_note">+Ajouter</button>

                                        </div>
                                        <input type="hidden" id="opp_id" />
                                        <input type="hidden" id="type_btn" />

                                        <div class=" col-md-12" style="margin-top:10px">
                                            <div id="note_div">
                                            </div>
                                            {{-- <div id="note1" class="bloc-note count_notes">
                                                <div class="form-group">
                                                    <label class="control-label" style="font-size:15px">Objet:
                                                    </label>
                                                    <span>qsfdqsdqsdqs</span>
                                                    <label  class="control-label" style="float:right"><b>seif </label><br>
                                                    <label  class="control-label" style="float:right;margin-top:-10px"><b>20-05-2023 </label>

                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label" style="font-size:15px"> Description:
                                                    </label>
                                                    <p>Le lorem ipsum est, en imprimerie, une suite de mots sans
                                                        signification utilisée à titre provisoire pour calibrer une mise en
                                                        page, le texte définitif venant remplacer le faux-texte dès qu'il
                                                        est prêt ou que la mise en page est achevée. Généralement, on
                                                        utilise un texte en faux latin, le Lorem ipsum ou Lipsum.</p>

                                                </div>


                                            </div> --}}
                                        </div>
                                    </div>

                                </div>
                                <div id="devis" class="tab-pane fade in">
                                    <div class="row">


                                        <div id="devis_div" class=" col-md-12" style="margin-top:10px">

                                            <div id="devis_files" class="bloc-note " style="margin-bottom: 10px;">
                                                <h5 class="title-devis">
                                                    Les devis internes</h5>
                                                <div style="display: flex; justify-content: center;">
                                                    <table class="table" id="table-facture-show">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col" style="text-align:center">Numéro
                                                                </th>
                                                                <th scope="col" style="text-align:center">Montant
                                                                </th>
                                                                <th scope="col" style="text-align:center">Date</th>
                                                                <th scope="col" style="text-align:center">Action
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        </tbody>
                                                    </table>

                                                </div>
                                            </div>
                                            <div id="devis_attaches" class="bloc-note " style="margin-bottom: 10px;">
                                                <h5 class="title-devis">
                                                    Les devis attachés</h5>
                                                <div style="display: flex; justify-content: center;">
                                                    <table class="table" id="devis-attaches">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col" style="text-align:center">Numéro
                                                                </th>
                                                                <th scope="col" style="text-align:center">Montant
                                                                </th>
                                                                <th scope="col" style="text-align:center">Date</th>
                                                                <th scope="col" style="text-align:center">Action
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        </tbody>
                                                    </table>

                                                </div>
                                            </div>

                                            {{-- <div id="update_file" style="display:none"class="bloc-note "
                                            style="margin-bottom: 10px;">
                                            <h5 class="title-devis">
                                                Modifier le fichier</h5>
                                            <div class="form-group row" style="margin-top: 10px;">
                                                <input type="hidden" id="file_id" />

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="control-label">Fichier: <span
                                                                class="obligatoire">*</span></label>
                                                        <input type="file" class="form-control" name="file_update">

                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="control-label">Montant: <span
                                                                class="obligatoire">*</span> </label>
                                                        <input type="number" placeholder="Montant" class="form-control"
                                                            name="montant_update">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="control-label">Date:</label>
                                                        <input type="date" class="form-control" name="date_update">
                                                    </div>
                                                </div>
                                            </div>
                                        </div> --}}
                                        </div>

                                        <div id="adddevis" class="bloc-note ">
                                            <h5 class="title-devis">
                                                Ajouter un devis</h5>
                                            <div class="custom-control custom-radio custom-control-inline"
                                                style="margin-top:15px">
                                                <input type="radio" id="interne" name="type_devis"
                                                    class="custom-control-input" style="margin-left: 10px;"
                                                    value="interne" checked>
                                                <label class="custom-control-label" for="interne"
                                                    style='font-size:14px'>
                                                    Devis interne</label>

                                                <input type="radio" id="autre" name="type_devis"
                                                    class="custom-control-input" value="autre" style="margin-left:15px">
                                                <label class="custom-control-label" for="autre"
                                                    style='font-size:14px'>
                                                    Un autre Fichier</label>
                                            </div>
                                            <div class="form-group row" id="new_file"
                                                style="margin-top: 10px;display:none">

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="control-label">Fichier: <span
                                                                class="obligatoire">*</span></label>
                                                        <input type="file" class="form-control" name="file">

                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="control-label">Montant: <span
                                                                class="obligatoire">*</span> </label>
                                                        <input type="number" placeholder="Montant" class="form-control"
                                                            name="montant">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="control-label">Date:</label>
                                                        <input type="date" class="form-control" name="date">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <button class="btn btn-info " id="valide_devis">Valider le
                                                    devis</button>
                                            </div>

                                        </div>

                                    </div>
                                </div>


                                <div id="factures" class="tab-pane fade in">
                                    <div class="row">


                                        <div id="facture_div" class=" col-md-12" style="margin-top:10px">

                                            <div id="facture_files" class="bloc-note " style="margin-bottom: 10px;">
                                                <h5 class="title-devis">
                                                    Les factures internes</h5>
                                                <div style="display: flex; justify-content: center;">
                                                    <table class="table" id="table-facture">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col" style="text-align:center">Numéro
                                                                </th>
                                                                <th scope="col" style="text-align:center">Montant
                                                                </th>
                                                                <th scope="col" style="text-align:center">Date</th>
                                                                <th scope="col" style="text-align:center">Action
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        </tbody>
                                                    </table>

                                                </div>
                                            </div>
                                            <div id="facture_attaches" class="bloc-note " style="margin-bottom: 10px;">
                                                <h5 class="title-devis">
                                                    Les factures attachés</h5>
                                                <div style="display: flex; justify-content: center;">
                                                    <table class="table" id="facture-attaches">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col" style="text-align:center">Numéro
                                                                </th>
                                                                <th scope="col" style="text-align:center">Montant
                                                                </th>
                                                                <th scope="col" style="text-align:center">Date</th>
                                                                <th scope="col" style="text-align:center">Action
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        </tbody>
                                                    </table>

                                                </div>
                                            </div>

                                            {{-- <div id="update_file" style="display:none"class="bloc-note "
                                            style="margin-bottom: 10px;">
                                            <h5 class="title-devis">
                                                Modifier le fichier</h5>
                                            <div class="form-group row" style="margin-top: 10px;">
                                                <input type="hidden" id="file_id" />

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="control-label">Fichier: <span
                                                                class="obligatoire">*</span></label>
                                                        <input type="file" class="form-control" name="file_update">

                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="control-label">Montant: <span
                                                                class="obligatoire">*</span> </label>
                                                        <input type="number" placeholder="Montant" class="form-control"
                                                            name="montant_update">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="control-label">Date:</label>
                                                        <input type="date" class="form-control" name="date_update">
                                                    </div>
                                                </div>
                                            </div>
                                        </div> --}}
                                        </div>

                                        <div id="addfacture" class="bloc-note ">
                                            <h5 class="title-devis">
                                                Ajouter une facture</h5>
                                            <div class="custom-control custom-radio custom-control-inline"
                                                style="margin-top:15px">
                                                <input type="radio" id="interne_facture" name="type_facture"
                                                    class="custom-control-input" style="margin-left: 10px;"
                                                    value="interne" checked>
                                                <label class="custom-control-label" for="interne_facture"
                                                    style='font-size:14px'>
                                                    facture interne</label>

                                                <input type="radio" id="autre_facture" name="type_facture"
                                                    class="custom-control-input" value="autre" style="margin-left:15px">
                                                <label class="custom-control-label" for="autre_facture"
                                                    style='font-size:14px'>
                                                    Un autre Fichier</label>
                                            </div>
                                            <div class="form-group row" id="new_file_facture"
                                                style="margin-top: 10px;display:none">

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="control-label">Fichier: <span
                                                                class="obligatoire">*</span></label>
                                                        <input type="file" class="form-control" name="file_facture">

                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="control-label">Montant: <span
                                                                class="obligatoire">*</span> </label>
                                                        <input type="number" placeholder="Montant" class="form-control"
                                                            name="montant_facture">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="control-label">Date:<span
                                                                class="obligatoire">*</span></label>
                                                        <input type="date" class="form-control" name="date_facture">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <button class="btn btn-info " id="valide_facture">Valider la
                                                    facture</button>
                                            </div>

                                        </div>

                                    </div>
                                </div>

                                <div id="documents" class="tab-pane fade in">
                                    <div class="row">


                                        <div id="document_div" class=" col-md-12" style="margin-top:10px">

                                            <div id="documents_files" class="bloc-note " style="margin-bottom: 10px;">
                                                <h5 class="title-devis">
                                                    Les documents</h5>
                                                <div style="display: flex; justify-content: center;">
                                                    <table class="table" id="table-documents">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col" style="text-align:center">Fichier
                                                                </th>
                                                                <th scope="col" style="text-align:center">Action
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        </tbody>
                                                    </table>

                                                </div>
                                            </div>


                                        </div>

                                        <div id="adddocument" class="bloc-note">
                                            <h5 class="title-devis">
                                                Ajouter un document</h5>

                                            <div class="form-group row" id="new_file_documenr" style="margin-top: 10px">

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="control-label">Fichier: <span
                                                                class="obligatoire">*</span></label>
                                                        <input type="file" class="form-control" name="file_document">

                                                    </div>
                                                </div>

                                            </div>
                                            <div class="form-group ">
                                                <button class="btn btn-info " id="valide_document">Valider le
                                                    document</button>
                                            </div>

                                        </div>

                                    </div>
                                </div>










                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    @endsection

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.5.1/sweetalert2.all.min.js"></script>
    <script scr="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.2/js/toastr.min.js"></script>
    <script>
        function close_modal() {
            console.log('hhhhh')
            $('#update_opp').modal('hide');

            $('#update_opp').removeClass('in');
            $('#update_opp').removeClass('show');
            $('#update_opp').css('display', 'none');
        }

        function update_modal(id, type_btn) {
            $('#update_opp').modal('show');
            $('#update_opp').removeClass('show');
            $('#update_opp').addClass('in');

            console.log('hsshhh')
            $('#devis').removeClass('in active');
            $('#notes').removeClass('in active');
            $('#factures').removeClass('in active')
            $('#documents').removeClass('in active')

            $('#details').addClass('in active')


            $('#notes_tab').removeClass('active');
            $('#devis_tab').removeClass('active');
            $('#facture_tab').removeClass('active');
            $('#document_tab').removeClass('active');
            $('#detail_tab').addClass('active');

            $('#note_div').empty()
            $('#detail_show').empty()
            $('#opp_id').val(id)
            $('#type_btn').val(type_btn)

            // test if update or show
            if (type_btn == "update") {
                $('#save_btn').show()
                $('#add_note').show()
                $('#adddevis').show()
                $('#addfacture').show()
                $('#save_note').show()
                $('#adddocument').show()
            } else {
                $('#save_btn').hide()
                $('#add_note').hide()
                $('#adddevis').hide()
                $('#save_note').hide()
                $('#addfacture').hide()
                $('#adddocument').hide()

            }

            //to back
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            jQuery.ajax({
                url: "{{ url('/oneopp') }}/" + id,
                method: 'get',
                success: function(result) {
                    let opp = result
                    let contact = opp.contact
                    if (opp.step == "1") {
                        $('#devis_tab').hide()
                        $('#facture_tab').hide()
                    } else if (opp.step == "2") {
                        $('#devis_tab').show()
                        $('#facture_tab').hide()

                    } else if (opp.step == "3") {
                        $('#devis_tab').show()
                        $('#facture_tab').show()
                        $('#adddevis').hide()


                    }
                    $('#code_opp').empty()
                    $('#code_opp').append(`Opp-${opp.id}`)


                    const contactElements = contact.contacts.map(element => `
                    <tr>
                        <td class="data">${element.nom}</td>
                        <td class="data">${element.poste}</td>
                        <td class="data">${element.telephone}</td>
                        <td class="data">${element.fixe}</td>
                        <td class="data">${element.email}</td>
                    </tr>
                `).join('');
                    let photo = "{{ asset('assets/img/user.png') }}"
                    if (contact.photo != null) {
                        photo = "{{ asset('assets/img') }}/" + contact.photo
                    }
                    $("#detail_show").append(`
                 <div class="profile-left">
                                                <div class="widget_card_page profile-box header_bg_blue">
                                                    <div class="profile-widget-img">

                                                        <img src=${photo} alt="profile"
                                                            style="width: 135px;height: 120px;" />

                                                    </div>
                                                    <div class="profile-widget-info">

                                                        <p>
                                                            <span class="livraison-label">Raison social :</span>
                                                            ${contact.raison_social}

                                                        </p>
                                                        <p>

                                                        <div class="form-container">
                                                            <div class="form-row">
                                                                  <span class="livraison-label">Segments :</span>
                                                                    <div class="col-md-8">
                                                                        <select class="js-example-basic-single js-states form-control" id="type_projet" ${type_btn=="show" ? 'disabled' : ''}>
                                                                            <option value="Big deal" ${opp.type_projet=="Big deal" ? 'selected' : ''}>Big deal
                                                                            </option>
                                                                            <option value="Medium deal" ${opp.type_projet=="Medium deal" ? 'selected' : ''}>Medium deal
                                                                            </option>
                                                                            <option value="Small deal" ${opp.type_projet=="Small deal" ? 'selected' : ''}>Small deal
                                                                            </option>
                                                                            <option value="Non qualifié" ${opp.type_projet=="Non qualifié" ? 'selected' : ''}>Non qualifié
                                                                            </option>
                                                                        </select>
                                                                    </div>
                                                            </div>
                                                        </div>
                                                        </p>
                                                        <p>
                                                        <div class="form-container">
                                                            <div class="form-row">
                                                                <span class="livraison-label">Date Deal:</span>
                                                                <input type="date" class="form-control date-deal" ${type_btn=="show" ? 'disabled' : ''} id="date_deal" value="${opp.date_deal}" />
                                                            </div>
                                                        </div>
                                                        </p>
                                                         <p>
                                                        <div class="form-container">
                                                            <div class="form-row">
                                                                <span class="livraison-label">Revenue espéré:</span>
                                                                <input type="number" class="form-control date-deal" ${type_btn=="show" ? 'disabled' : ''} id="revenu" value="${opp.expected_revenue}" />
                                                            </div>
                                                        </div>
                                                        </p>

                                                        <p>
                                                                 <div class="form-container">
                                                                    <div class="form-row">
                                                                    <span class="livraison-label">Rating
                                                                        :</span>
                                                                           <div class="rating">
                                                                    <input type="hidden" id="rating_value" name="rating" value="${opp.rating}">
                                                                    <span class="star ${opp.rating>=1 ? 'active' : ''}" id="star1" data-value="1" onclick="add_rating($(this))"></span>
                                                                    <span class="star  ${opp.rating>=2 ? 'active' : ''}" id="star2" data-value="2" onclick="add_rating($(this))"></span>
                                                                    <span class="star ${opp.rating>=3 ? 'active' : ''}" id="star3" data-value="3" onclick="add_rating($(this))"></span>
                                                                    <span class="star ${opp.rating>=4 ? 'active' : ''}" id="star4" data-value="4" onclick="add_rating($(this))"></span>
                                                                    <span class="star ${opp.rating==5 ? 'active' : ''}" id="star5" data-value="5" onclick="add_rating($(this))" ></span>
                                                                </div>
                                                                    </div>
                                                                 </div>
                                                        </p>
                                                        ${type_btn!="show" ? `<button type="button" class="btn btn-primary " onclick="save_profil()" id="save_btn">Enregistrer</button>`: ''}



                                                    </div>

                                                </div>
                                                <!-- End Widget Card -->
                                                ${type_btn=="show" ?
                                                `<div class="profile-bio">


                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <div class="single-profile-bio">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <h3>Info générales</h3>

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <ul class="work_history">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <li>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <div class="table-responsive">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <table class="table table-bordered table_info"
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            style="text-align:center">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <tr>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <th>Nom et prénom:</th>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <td class="data">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                ${contact.nom}  ${contact.prenom}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                </td>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <th>Téléphone :</th>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <td class="data">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   ${contact.telephone}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                </td>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <th>Mobile :</th>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <td class="data">${contact.mobile}</td>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <th>Email :</th>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <td class="data">${contact.email}</td>


                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </tr>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <tr>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <th>M/F:</th>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <td class="data">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    ${contact.mf}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                </td>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <th>Secteur :</th>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <td class="data">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  ${contact.secteur}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                </td>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <th>Poste :</th>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <td class="data">  ${contact.poste}</td>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <th>Email :</th>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <td class="data"> ${contact.email}</td>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </tr>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <tr>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <th>Web</th>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <td class="data">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    ${contact.web}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                </td>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <th>Facebook:</th>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <td class="data">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    ${contact.facebook}

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                </td>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <th>Linkedin</th>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <td class="data">  ${contact.linkedin}</td>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <th>Instagram</th>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <td class="data"> ${contact.instagram}</td>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </tr>

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <tr>


                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <th>Fax :</th>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <td class="data">${contact.fax}</td>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <th>Date d'ajout :</th>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <td class="data">${opp.created_at}</td>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <th>Code postal :</th>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <td class="data">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    ${contact.code_postal}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                </td>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <th>Adresse :</th>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <td class="data">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                ${contact.adresse}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                </td>

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </tr>



                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        </table>

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                </li>

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </ul>

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <div class="single-profile-bio">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <h3>Autre contact</h3>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <table class="table table-bordered table_info"
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    style="text-align:center">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <tr>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <th>Nom :</th>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <th>Poste :</th>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <th>Téléphone :</th>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <th>Autre telephone :</th>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <th>Email :</th>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        </td>

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    </tr>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   ${contactElements}

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                </table>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <div class="single-profile-bio">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <h3>Commentaire</h3>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <p>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      ${contact.comentaire}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                </p>

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </div>


                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        </div>

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    </div>`




                                                 : ''}

                                            </div>


                 `)

                    //partie notes
                    let notes = result.notes;
                    //update
                    if (type_btn == "update") {
                        for (let i = 0; i < notes.length; i++) {
                            $('#note_div').append(`<br>
                            <div id="note${i}" class="bloc-note count_notes">
                                <div class="form-group">
                                    <label class="control-label">Objet:<span class="obligatoire">*</span></label>
                                   <button type="button" class="btn btn-danger btn-note" onclick="delete_note(${i})">X</button>
                                    <input type="hidden" class="form-control" name="keynote" value="${notes[i].id}">
                                    <div style="position: relative;">
                                        <input type="text" placeholder="objet" class="form-control" id="objetnote${i}" name="objetnote" value="${notes[i].objet}">

                                    </div>
                                    </div>
                                    <div class="form-group">
                                        <p><label class="control-label"> Description: <span class="obligatoire">*</span></label><p>
                                        <textarea class="form-control" id="descriptionnote${i}" name="descriptionnote">${notes[i].description}</textarea>
                                    </div>
                            </div>
                        `);
                        }

                    } else if (type_btn == "show") {
                        for (let i = 0; i < notes.length; i++) {
                            var formattedDateTime = formatDate(new Date(notes[i]
                                .created_at));
                            $('#note_div').append(`<br>
                          <div id="note${i}" class="bloc-note ">
                                                <div class="form-group">
                                                    <label class="control-label" style="font-size:15px">Objet:
                                                    </label>
                                                    <span>${notes[i].objet}</span>
                                                    <label  class="control-label" style="float:right"><b>${notes[i].user.name} </label><br>
                                                    <label  class="control-label" style="float:right;margin-top:-10px"><b>${formattedDateTime} </label>

                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label" style="font-size:15px"> Description:
                                                    </label>
                                                    <p>${notes[i].description}</p>

                                                </div>

                                            </div>
                        `);
                        }
                    }


















                    //partie devis

                    //devis sim
                    $("#table-facture-show tbody").empty()

                    var tableBody = $("#table-facture-show tbody");
                    for (var i = 0; i < opp.devis.length; i++) {
                        var row = $("<tr>");
                        var numero = $("<td style='text-align:center'>").append(
                            "<a class='dev-num'><b >" +
                            opp.devis[i].numero +
                            "</b></a>");
                        var montant = $("<td style='text-align:center'>").append(
                            "<b >" +
                            opp.devis[i].devis_ttc +
                            "</b>");
                        var date = $("<td style='text-align:center'>").append(
                            "<b >" +
                            opp.devis[i].date +
                            "</b>");

                        var options = $("<td style='text-align:center'>").append(`<div class="dropdown">
                                                <button class="btn btn-options btn-success dropdown-toggle" type="button"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                                    style="margin-left:20px">
                                                    Options <i class="fa-solid fa-circle-chevron-down"></i>
                                                </button>
                                                <div class="dropdown-menu pull-right" aria-labelledby="dropdownMenuButton">
                                                    <ul class="list-group">
                                                        <a id="pdf-link-${opp.devis[i].id}">
                                                            <li class="list-group-item"><i class="fa fa-file"
                                                                    style="margin-right:5px"></i> PDF </li>
                                                        </a>
                                                        <a id='dev-num-${opp.devis[i].id}'>
                                                            <li class="list-group-item"><i class="fa fa-pen"
                                                                    style="margin-right:5px"></i> Modifier </li>
                                                        </a>
                                                        <a  onclick="deletedevis(${opp.devis[i].id})">
                                                            <li class="list-group-item" style="cursor:pointer"><i
                                                                    class="fa-solid fa-trash"
                                                                    style="margin-right:5px;"></i>Supprimer</li>
                                                        </a>

                                                    </ul>
                                                </div>
                                            </div>`);
                        row.append(numero);
                        row.append(montant);
                        row.append(date);
                        row.append(options);
                        tableBody.append(row);
                        //urlnum
                        var myUrl = `editdevis/${opp.devis[i].id}`;
                        $(`#dev-num-${opp.devis[i].id}`).attr('href', myUrl);
                        $(`#dev-num-${opp.devis[i].id}`).attr('target', "_blank");

                        //url pdf
                        var pdfurl = `printdevis/${opp.devis[i].id}`;
                        $(`#pdf-link-${opp.devis[i].id}`).attr('href', pdfurl);




                    }
                    //devis attachés
                    $("#devis-attaches tbody").empty()

                    var attacheBody = $("#devis-attaches tbody");
                    for (var i = 0; i < opp.devis_files.length; i++) {
                        if (opp.devis_files[i].type == "devis") {
                            var row = $("<tr>");
                            var numero = $("<td style='text-align:center'>").append(
                                "<b >" +
                                opp.devis_files[i].fichier +
                                "</b>");
                            var montant = $("<td style='text-align:center'>").append(
                                "<b >" +
                                opp.devis_files[i].montant +
                                "</b>");
                            var date = $("<td style='text-align:center'>").append(
                                "<b >" +
                                opp.devis_files[i].date +
                                "</b>");
                            var options = $("<td style='text-align:center'>").append(`<div class="dropdown">
                                                <button class="btn btn-options btn-success dropdown-toggle" type="button"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                                    style="margin-left:20px">
                                                    Options <i class="fa-solid fa-circle-chevron-down"></i>
                                                </button>
                                                <div class="dropdown-menu pull-right" aria-labelledby="dropdownMenuButton">
                                                    <ul class="list-group">
                                                        <a id="download-link-${opp.devis_files[i].id}">
                                                            <li class="list-group-item"><i class="fa fa-file"
                                                                    style="margin-right:5px"></i> Download </li>
                                                        </a>
                                                        <a  id="update-devis-link-${opp.devis_files[i].id}">
                                                            <li class="list-group-item " ><i class="fa fa-pen"
                                                                    style="margin-right:5px" ></i> Modifier </li>
                                                        </a>
                                                        <a onclick="delete_file_opp(${opp.devis_files[i].id})" >
                                                            <li class="list-group-item" style="cursor:pointer"><i
                                                                    class="fa-solid fa-trash"
                                                                    style="margin-right:5px;"></i>Supprimer</li>
                                                        </a>

                                                    </ul>
                                                </div>
                                            </div>`);
                            row.append(numero);
                            row.append(montant);
                            row.append(date);
                            row.append(options);
                            attacheBody.append(row);

                            //update file
                            var url_link = `update_file_opp/${opp.devis_files[i].id}`;
                            $(`#update-devis-link-${opp.devis_files[i].id}`).attr('href',
                                url_link);

                            $(`#update-devis-link-${opp.devis_files[i].id}`).attr('target',
                                "_blank");



                            //download file
                            var pdfurl = `downloadfile/${opp.devis_files[i].fichier}`;
                            $(`#download-link-${opp.devis_files[i].id}`).attr('href',
                                pdfurl);

                        }



                    }

                    //partie factures


                    //facture sim
                    $("#table-facture tbody").empty()

                    var tableBody = $("#table-facture tbody");
                    for (var i = 0; i < opp.facture.length; i++) {
                        var row = $("<tr>");
                        var numero = $("<td style='text-align:center'>").append(
                            "<a class='dev-num'><b >" +
                            opp.facture[i].numero +
                            "</b></a>");
                        var montant = $("<td style='text-align:center'>").append(
                            "<b >" +
                            opp.facture[i].facture_ttc +
                            "</b>");
                        var date = $("<td style='text-align:center'>").append(
                            "<b >" +
                            opp.facture[i].date +
                            "</b>");

                        var options = $("<td style='text-align:center'>").append(`<div class="dropdown">
                                                <button class="btn btn-options btn-success dropdown-toggle" type="button"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                                    style="margin-left:20px">
                                                    Options <i class="fa-solid fa-circle-chevron-down"></i>
                                                </button>
                                                <div class="dropdown-menu pull-right" aria-labelledby="dropdownMenuButton">
                                                    <ul class="list-group">
                                                        <a id="pdf-link-facture${opp.facture[i].id}">
                                                            <li class="list-group-item"><i class="fa fa-file"
                                                                    style="margin-right:5px"></i> PDF </li>
                                                        </a>
                                                        <a id='dev-num-facture${opp.facture[i].id}'>
                                                            <li class="list-group-item"><i class="fa fa-pen"
                                                                    style="margin-right:5px"></i> Modifier </li>
                                                        </a>
                                                        <a  onclick="deletefacture(${opp.facture[i].id})">
                                                            <li class="list-group-item" style="cursor:pointer"><i
                                                                    class="fa-solid fa-trash"
                                                                    style="margin-right:5px;"></i>Supprimer</li>
                                                        </a>

                                                    </ul>
                                                </div>
                                            </div>`);
                        row.append(numero);
                        row.append(montant);
                        row.append(date);
                        row.append(options);
                        tableBody.append(row);
                        //urlnum
                        var myUrl = `updatefacture/${opp.facture[i].id}`;
                        $(`#dev-num-facture${opp.facture[i].id}`).attr('href', myUrl);
                        $(`#dev-num-facture${opp.facture[i].id}`).attr('target', "_blank");

                        //url pdf
                        var pdfurl = `printfacture/${opp.facture[i].id}`;
                        $(`#pdf-link-facture${opp.facture[i].id}`).attr('href', pdfurl);




                    }
                    //facture attachés
                    $("#facture-attaches tbody").empty()

                    var attacheBody = $("#facture-attaches tbody");
                    for (var i = 0; i < opp.facture_files.length; i++) {
                        if (opp.devis_files[i].type == "facture") {

                            var row = $("<tr>");
                            var numero = $("<td style='text-align:center'>").append(
                                "<b >" +
                                opp.facture_files[i].fichier +
                                "</b>");
                            var montant = $("<td style='text-align:center'>").append(
                                "<b >" +
                                opp.facture_files[i].montant +
                                "</b>");
                            var date = $("<td style='text-align:center'>").append(
                                "<b >" +
                                opp.facture_files[i].date +
                                "</b>");
                            var options = $("<td style='text-align:center'>").append(`<div class="dropdown">
                                                <button class="btn btn-options btn-success dropdown-toggle" type="button"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                                    style="margin-left:20px">
                                                    Options <i class="fa-solid fa-circle-chevron-down"></i>
                                                </button>
                                                <div class="dropdown-menu pull-right" aria-labelledby="dropdownMenuButton">
                                                    <ul class="list-group">
                                                        <a id="download-link-facture${opp.facture_files[i].id}">
                                                            <li class="list-group-item"><i class="fa fa-file"
                                                                    style="margin-right:5px"></i> Download </li>
                                                        </a>
                                                        <a id="update-facture-link-${opp.facture_files[i].id}">
                                                            <li class="list-group-item " ><i class="fa fa-pen"
                                                                    style="margin-right:5px" ></i> Modifier </li>
                                                        </a>
                                                        <a onclick="delete_file_opp(${opp.facture_files[i].id})" >
                                                            <li class="list-group-item" style="cursor:pointer"><i
                                                                    class="fa-solid fa-trash"
                                                                    style="margin-right:5px;"></i>Supprimer</li>
                                                        </a>
                                                    </ul>
                                                </div>
                                            </div>`);
                            row.append(numero);
                            row.append(montant);
                            row.append(date);
                            row.append(options);
                            attacheBody.append(row);

                            //update file
                            var url_link = `update_file_opp/${opp.devis_files[i].id}`;
                            $(`#update-facture-link-${opp.devis_files[i].id}`).attr('href',
                                url_link);

                            $(`#update-facture-link-${opp.devis_files[i].id}`).attr(
                                'target',
                                "_blank");

                            //download file
                            var pdfurl = `downloadfile/${opp.devis_files[i].fichier}`;
                            $(`#download-link-facture${opp.devis_files[i].id}`).attr('href',
                                pdfurl);


                        }
                    }



                    //document attachés
                    $("#table-documents tbody").empty()

                    var attacheBody = $("#table-documents tbody");
                    for (var i = 0; i < opp.facture_files.length; i++) {
                        if (opp.devis_files[i].type == "document") {

                            var row = $("<tr>");
                            var numero = $("<td style='text-align:center'>").append(
                                "<b >" +
                                opp.facture_files[i].fichier +
                                "</b>");
                            var options = $("<td style='text-align:center'>").append(`<div class="dropdown">
                                                <button class="btn btn-options btn-success dropdown-toggle" type="button"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                                    style="margin-left:20px">
                                                    Options <i class="fa-solid fa-circle-chevron-down"></i>
                                                </button>
                                                <div class="dropdown-menu pull-right" aria-labelledby="dropdownMenuButton">
                                                    <ul class="list-group">
                                                        <a id="download-link-document${opp.facture_files[i].id}">
                                                            <li class="list-group-item"><i class="fa fa-file"
                                                                    style="margin-right:5px"></i> Download </li>
                                                        </a>

                                                        <a onclick="delete_file_opp(${opp.facture_files[i].id})" >
                                                            <li class="list-group-item" style="cursor:pointer"><i
                                                                    class="fa-solid fa-trash"
                                                                    style="margin-right:5px;"></i>Supprimer</li>
                                                        </a>
                                                    </ul>
                                                </div>
                                            </div>`);
                            row.append(numero);
                            row.append(options);
                            attacheBody.append(row);
                            //download file
                            var pdfurl = `downloadfile/${opp.devis_files[i].fichier}`;
                            $(`#download-link-document${opp.devis_files[i].id}`).attr(
                                'href',
                                pdfurl);

                        }
                    }
                }


            });













        }

        function update_file(id, montant, date) {
            console.log(id)
            console.log(montant)
            console.log(date)
            $('#update_file').show()

            $('#file_id').val(id)
            $('input[name=montant_update]').val(montant)
            $('input[name=nom_update]').val(date)
        }

        function test_opp() {
            let opp_id = "{{ session('opp_id') }}"
            console.log(opp_id)
            if (opp_id) {
                update_modal(opp_id, 'show')

            }

        }

        $(document).ready(function() {
            test_opp()
            $('#filter_btn').click(function() {
                var startDate = new Date($('#start_date').val());
                var endDate = new Date($('#end_date').val());
                console.log(startDate)
                console.log(endDate)

                $('#crm_table tbody tr').each(function() {
                    var rowDate = new Date($(this).find('td:nth-child(9)').text());

                    if (rowDate >= startDate && rowDate <= endDate) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });
            //create_document
            $('#valide_document').click(function() {
                $('.erreur').empty();
                var files = $("input[name='file_document']")[0].files
                var file_result = files.length > 0 ? files[0] : ''
                var opp_id = $("#opp_id").val()
                var form = new FormData();
                form.append('file', file_result);
                form.append('id', opp_id);
                form.append('type_file', 'document');

                jQuery.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('input[name="_token"]').val()
                    },
                    url: "{{ url('/storedocument') }}",
                    method: 'post',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form,
                    success: function(result) {
                        if (result.error) {
                            Swal.fire({
                                position: 'top-center',
                                icon: 'error',
                                title: 'Un erreur est survenu',
                                showConfirmButton: true,
                                timer: 3000
                            })
                            if (result.error.file) {
                                error_message(result.error.file[0],
                                    "input[name='file_document']")
                            }


                        } else if (result == 200) {
                            Swal.fire({
                                position: 'top-center',
                                icon: 'success',
                                title: 'document ajouté avec succéss',
                                showConfirmButton: false,
                                timer: 1000
                            })
                            setTimeout(function() {
                                location.reload(true);
                            }, 1000);
                        }

                    }
                });
                console.log(file_result)

            })




            //add_devis
            $('#valide_devis').click(function() {
                $('.erreur').empty();
                var type_devis = $('input[name = "type_devis"]:checked').val()
                var files = $("input[name='file']")[0].files
                var opp_id = $("#opp_id").val()
                var montant = $('input[name = "montant"]').val()
                var date = $('input[name = "date"]').val()
                var file_result = files.length > 0 ? files[0] : ''

                var form = new FormData();
                form.append('file', file_result);
                form.append('type_devis', type_devis);
                form.append('id', opp_id);
                form.append('montant', montant);
                form.append('date', date);
                form.append('type_file', 'devis');

                jQuery.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('input[name="_token"]').val()
                    },
                    url: "{{ url('/createdevisopportunite') }}",
                    method: 'post',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form,
                    success: function(result) {
                        if (result.error) {
                            Swal.fire({
                                position: 'top-center',
                                icon: 'error',
                                title: 'Un erreur est survenu',
                                showConfirmButton: true,
                                timer: 3000
                            })
                            if (result.error.file) {
                                error_message(result.error.file[0],
                                    "input[name='file']")
                            }
                            if (result.error.montant) {
                                error_message(result.error.montant[0],
                                    "input[name='montant']")
                            }

                        } else if (result.success == 200) {
                            Swal.fire({
                                position: 'top-center',
                                icon: 'success',
                                title: 'Devis ajouté avec succéss',
                                showConfirmButton: false,
                                timer: 1000
                            })
                            if (result.type_result == "interne") {
                                setTimeout(function() {
                                    window.location.href =
                                        `editdevis/${result.success_id}`;
                                }, 1000);
                            } else {
                                setTimeout(function() {
                                    location.reload(true);
                                }, 1000);
                            }


                        }

                    }
                });
            });

            //add_facture
            $('#valide_facture').click(function() {
                $('.erreur').empty();
                var type_facture = $('input[name = "type_facture"]:checked').val()
                var files = $("input[name='file_facture']")[0].files
                var opp_id = $("#opp_id").val()
                var montant = $('input[name = "montant_facture"]').val()
                var date = $('input[name = "date_facture"]').val()

                var file_result = files.length > 0 ? files[0] : ''
                var form = new FormData();
                form.append('file', file_result);
                form.append('type_facture', type_facture);
                form.append('id', opp_id);
                form.append('montant', montant);
                form.append('date', date);
                form.append('type_file', 'facture');

                jQuery.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('input[name="_token"]').val()
                    },
                    url: "{{ url('/createfactureopportunite') }}",
                    method: 'post',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form,
                    success: function(result) {
                        if (result.error) {
                            Swal.fire({
                                position: 'top-center',
                                icon: 'error',
                                title: 'Un erreur est survenu',
                                showConfirmButton: true,
                                timer: 3000
                            })
                            if (result.error.file) {
                                error_message(result.error.file[0],
                                    "input[name='file_facture']")
                            }
                            if (result.error.montant) {
                                error_message(result.error.montant[0],
                                    "input[name='montant_facture']")
                            }
                            if (result.error.montant) {
                                error_message(result.error.montant[0],
                                    "input[name='date_facture']")
                            }

                        } else if (result.success == 200) {
                            Swal.fire({
                                position: 'top-center',
                                icon: 'success',
                                title: 'Facture ajouté avec succéss',
                                showConfirmButton: false,
                                timer: 1000
                            })
                            if (result.type_result == "interne") {
                                setTimeout(function() {
                                    window.location.href =
                                        `updatefacture/${result.success_id}`;
                                }, 1000);
                            } else {
                                setTimeout(function() {
                                    location.reload(true);
                                }, 1000);
                            }


                        }

                    }
                });
            });

            //next_step
            $('.next-step').click(function() {
                var id = $(this).data('id');
                var step = $(this).data('step');
                jQuery.ajax({
                    url: "{{ url('/rightchange') }}",
                    method: 'post',
                    data: {
                        id: id,
                        step: step,
                        _token: "{{ csrf_token() }}",
                    },
                    success: function(result) {
                        let link = result.type_result == 'devis' ? 'editdevis/' :
                            'updatefacture/';
                        Swal.fire({
                            position: 'top-center',
                            icon: 'success',
                            title: 'Oportunité Changé avecc succéss',
                            showConfirmButton: false,
                            timer: 1000
                        })
                        setTimeout(function() {
                            window.location.href = link + result.success_id;
                        }, 1000);
                    }
                });
            })
            $("input[name='type_devis']").change(function() {
                value = $(this).val()
                if (value == "interne") {
                    $('#new_file').hide()
                } else if (value == "autre") {
                    $('#new_file').show()

                }
            });
            $("input[name='type_facture']").change(function() {
                value = $(this).val()
                if (value == "interne") {
                    $('#new_file_facture').hide()
                } else if (value == "autre") {
                    $('#new_file_facture').show()

                }
            });



            $("#add_note").click(function(event) {
                event.preventDefault();
                let count = 0;
                console.log(count)
                let element = $('.count_notes').last()
                if (element.length > 0) {
                    count = Number(element.attr('id').match(/\d+/)[0]) + 1
                }
                $('#note_div').append(`<div id="note${count}" class="bloc-note count_notes">  <div class="form-group">
                                                    <label class="control-label">Objet:<span
                                                            class="obligatoire">*</span> </label>
                                                    <button type="button" class="btn btn-danger btn-note " onclick="delete_note(${count})">X</button>
                                                  <input type="hidden" class="form-control  "
                                                        name="keynote" value="new">
                                                    <input type="text" placeholder="objet" class="form-control  "
                                                        id="objetnote${count}" name="objetnote">
                                                </div>
                                                <div class="form-group">
                                                    <p><label class="control-label"> Description: <span
                                                            class="obligatoire">*</span></label><p>
                                                    <textarea  class="form-control " id="descriptionnote${count}" name="descriptionnote"></textarea>
                                                </div>
                                            </div>
            `)


            });
            $('.star').click(function() {
                var value = $(this).attr('data-value');
                $('#rating_value').val(value);

                $('.star').removeClass('active');
                for (var i = 1; i <= value; i++) {
                    $('#star' + i).addClass('active');
                }
            });



        });

        function formatDate(date) {
            const options = {
                hour: '2-digit',
                minute: '2-digit',
                hour12: false,
                year: 'numeric',
                month: '2-digit',
                day: '2-digit'
            };

            const formattedTime = date.toLocaleTimeString('Fr', options);

            return `${formattedTime}`;
        }



















        function add_rating(test) {

            var value = test.attr('data-value');
            var type_btn = $('#type_btn').val()
            if (type_btn == "update") {
                var count_actives = $('.star.active').length
                console.log(count_actives)
                console.log(value)
                $('#rating_value').val(value);
                $('.star').removeClass('active');

                for (var i = 1; i <= value; i++) {
                    $('#star' + i).addClass('active');
                }
                if (count_actives == 1 && value == 1) {
                    $('#star1').removeClass('active');
                    $('#rating_value').val(0);

                }
            }

        }

        function save_notes() {
            var test = true
            $('.erreur').empty();

            var obligatoire =
                "<p class='text-danger erreur' style='float:left;font-size:13px' >Ce champ est obligatoire</p>"
            var all_objets = $("input[name='objetnote']")
                .map(function() {
                    if (!$(this).val()) {
                        test = false
                        $(obligatoire).insertAfter(this);
                    }


                    return $(this).val();
                }).get();
            var all_descriptions = $("textarea[name='descriptionnote']")
                .map(function() {
                    if (!$(this).val()) {
                        test = false
                        $(obligatoire).insertAfter(this);
                    }


                    return $(this).val();
                }).get();

            var all_ids = $("input[name='keynote']")
                .map(function() {
                    if (!$(this).val()) {
                        test = false
                        $(obligatoire).insertAfter(this);
                    }

                    return $(this).val();
                }).get();

            if (!test) {
                console.log("erreur")
                Swal.fire({
                    icon: "error",
                    title: "Il y'a un erreur",
                });
                return false
            }
            let notes = []
            for (let i = 0; i < all_objets.length; i++) {
                notes.push({
                    'objet': all_objets[i],
                    'description': all_descriptions[i],
                    'id': all_ids[i]
                })
            }
            //

            let itemsnotes = JSON.stringify(notes);
            let opp_id = $('#opp_id').val()

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            jQuery.ajax({
                url: "{{ url('/save_notes') }}",
                method: 'post',
                data: {
                    notes: itemsnotes,
                    id: opp_id,
                    _token: "{{ csrf_token() }}",

                },
                success: function(result) {
                    console.log(result)

                    if (result.error) {
                        Swal.fire({
                            position: 'top-center',
                            icon: 'error',
                            title: 'Un erreur est survenu',
                            showConfirmButton: true,
                            timer: 3000
                        })
                    } else if (result == 200) {
                        Swal.fire({
                            icon: "success",
                            title: "Note enregistré",
                        });
                    }

                }
            });

        }

        function save_profil() {

            let date_deal = $('#date_deal').val()
            let type_projet = $('#type_projet').val()
            let revenu = $('#revenu').val()
            let rating_value = $("#rating_value").val()
            let opp_id = $('#opp_id').val()

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            jQuery.ajax({
                url: "{{ url('/save_profil') }}",
                method: 'post',
                data: {
                    id: opp_id,
                    date_deal: date_deal,
                    type_projet: type_projet,
                    revenu: revenu,
                    rating_value: rating_value,
                    _token: "{{ csrf_token() }}",
                },
                success: function(result) {
                    console.log(result)

                    if (result.error) {
                        Swal.fire({
                            position: 'top-center',
                            icon: 'error',
                            title: 'Un erreur est survenu',
                            showConfirmButton: true,
                            timer: 3000
                        })
                        if (result.error.date_deal) {
                            error_message(result.error.date_deal[0], "#date_deal")
                        }
                        if (result.error.type_projet) {
                            error_message(result.error.type_projet[0], "#type_projet")
                        }
                        if (result.error.revenu) {
                            error_message(result.error.revenu[0], "#revenu")
                        }
                        if (result.error.rating_value) {
                            error_message(result.error.rating_value[0], "#rating_value")
                        }

                    } else if (result == 200) {
                        Swal.fire({
                            icon: "success",
                            title: "Opportunité enregistré",
                        });
                    }

                }
            });
            console.log(notes)


        }

        function delete_note(id) {
            console.log(id)
            $(`#note${id}`).remove()
        }

        function error_message(messages, input) {
            return $("<span class='text-danger erreur' style='float:left;font-size:13px' >" + messages + "</span>")
                .insertAfter(input);
        }

        function delete_file_opp(id) {
            swal.fire({
                title: "Suppriméer?",
                icon: 'question',
                text: "Etes–vous sur que vous voulez supprimer le fichier?",
                type: "warning",
                showCancelButton: !0,
                customClass: 'swal-wide',
                confirmButtonText: "Oui, Confirmer!",
                cancelButtonText: "Non, Annuler!",
                reverseButtons: !0
            }).then(function(e) {

                if (e.value === true) {
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        type: 'get',
                        url: "{{ url('/delete_file_opp') }}/" + id,
                        data: {
                            _token: CSRF_TOKEN
                        },
                        dataType: 'JSON',
                        success: function(results) {
                            if (results == 200) {
                                Swal.fire({
                                    position: 'top-center',
                                    icon: 'success',
                                    title: "Le fichier est supprimé avecc succéss",
                                    showConfirmButton: false,
                                    timer: 1000
                                })
                                setTimeout(function() {
                                    location.reload()

                                }, 1000);
                            }
                        }
                    });

                } else {
                    e.dismiss;
                }

            }, function(dismiss) {
                return false;
            })
        }
    </script>

    @section('content')
    @endsection
