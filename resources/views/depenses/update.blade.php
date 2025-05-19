<?php
function replace($montant)
{
    $montant = str_replace('.', ',', $montant);
    return $montant;
}
?>


@extends('layouts.app')

@section('content')
    <!-- Breadcromb Row Start -->
    <div class="row">
        <div class="col-md-12">
            <div class="breadcromb-area">
                <div class="row ">
                    <div class="col-md-4">
                        <h3><span>{{$facture->client->nom}} </span><span style="font-size: 14px; color: {{$facture->client->categorie->couleur}};text-transform: initial;"><b>{{ $facture->client->categorie->nom }}({{ $facture->client->categorie->montant }} TND) ({{ $facture->client->categorie->nb_jours }} Jours)</b></span></h3>
                    </div>
                    <div class="col-md-8">
                        <div class="btn-group" role="group" aria-label="Basic example" id="btn_group">


                            
                                @if($facture->status!='paye_partielle' && $facture->status!='valide' && $facture->status!='paye')
                                <button   type="button" class="btn btn-info  " onclick="savefacture()" id="save_facture"><i class="fa fa-check"></i>
                                Enregistrer la
                                facture</button>
                                @endif
                                <div class="dropdown">
                                <button class="btn btn-options btn-success dropdown-toggle" type="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                    style="margin-left:20px">
                                    Options <i class="fa-solid fa-circle-chevron-down"></i>
                                </button>
                                <div class="dropdown-menu pull-right" aria-labelledby="dropdownMenuButton">
                                    <ul class="list-group">
                                        @can('paiements')
                                            <a data-toggle="modal" data-target="#payement" style="cursor:pointer">
                                                <li class="list-group-item">

                                                    <i class="fa-solid fa-credit-card" style="margin-right:5px;"></i>
                                                    Saisir le paiement
                                                </li>
                                            </a>
                                        @endcan
                                        <a href="{{ route('factures.print', ['id' => $facture->id]) }}">
                                            <li class="list-group-item"><i class="fa fa-file" style="margin-right:5px"></i>
                                                PDF </li>
                                        </a>
                                       
                                        {{-- <a href="#">
                                            <li class="list-group-item" style="cursor:pointer"><i class="fa-solid fa-trash"
                                                    style="margin-right:5px;"></i>Supprimer</li>
                                        </a> --}}
                                    </ul>
                                </div>
                            </div>
                              
                        

                            <a href="{{ route('factures.index') }} "><button type="button" class="btn btn-warning btn_retour"
                                    style=" margin-left: 120px;
"><i class="fa-solid fa-backward"></i>Retour</button></a>

                        </div>


                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcromb Row -->

    <!-- Invoice Row Start -->
    <div class="row">
        <div class="col-md-12">
            <div class="page-box">
                <div class="invoice-box">
                    <h4 class="invoice-status">{{ $facture->status }}</h4>
                    <div class="invoice-head">
                        <h2>#{{ $facture->numero }} @if($facture->client->type=='sans_taxe')<span style="font-size: 18px; color: #A93226;text-transform: initial;">(Client exonéré de tva)</span>@elseif($facture->client->type=='avec_taxe')<span style="font-size: 18px; color: #145A32;text-transform: initial;">(Client avec taxe)</span>@endif</span></h2>
                      
                    </div>
                    <div class="invoice-address">
                        <div class="row">
                            <div class="col-md-2 ">
                                <div class="invoice-company-address">
                                    <h3>Entreprise</h3>
                                    <p class="name-invoice"><b>{{ $facture->entreprise->nom }}</b></p>
                                    <p>{{ $facture->entreprise->adresse }}</p>
                                    <p>Tel No: {{ $facture->entreprise->telephone }}</p>
                                    <p>Email: {{ $facture->entreprise->email }}</p>
                                    <p>Web: {{ $facture->entreprise->web }}</p>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="billed-to-address">
                                    <h3>Client</h3>
                                    <p class="name-invoice"><b>{{ $facture->client->nom }}
                                            </b>
                                    </p>
                                    <p>{{ $facture->client->adresse }}</p>
                                    <p>Tel No: {{ $facture->client->telephone }}</p>
                                    <p>Email: {{ $facture->client->email }}</p>
                                </div>
                            </div>
                             <div class="col-md-4 ">
                                <div class="billed-to-address">
                                    <h3>Options</h3>
                                    <div class="form-group row">
                                        <p class="name-invoice col-md-5 col-form-label" style="margin-top:10px">
                                            <b>Status</b>
                                        </p>
                                        <div class="col-md-7">

                                            @if($facture->status =='en cours' )
                                                <select class="form-control none" id="status">
                                                <option value="en cours"
                                                    {{ $facture->status == 'en cours' ? 'selected' : '' }}>En cours
                                                </option>
                                                <option value="valide" {{ $facture->status == 'valide' ? 'selected' : '' }}>
                                                    Valide</option>
                                                </select>
                                            @elseif($facture->status =='valide')
                                                <span class="form-control disabled">Valide</span>
                                             
                                             @elseif($facture->status =='paye_partielle' || $facture->status=='valide')
                                                <span class="form-control disabled">Converti en facture</span>
                                            @endif


                                           
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <p class="name-invoice col-md-5 col-form-label" style="margin-top:10px"><b>Numéro
                                                facture</b></p>
                                        <div class="col-md-7">
                                            {{-- @if($facture->status!='paye_partielle')
                                            <input type="text" class="form-control" id="numero_facture"
                                                value="{{ $facture->numero }}">
                                            @else
                                            <span class="form-control disabled">{{ $facture->numero }}</span>
                                             @endif --}}
                                             <span class="form-control disabled">{{ $facture->numero }}</span>

                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <p class="name-invoice col-md-5 col-form-label" style="margin-top:10px"><b>Date
                                                facture</b></p>
                                        <div class="col-md-7">

                                            {{-- @if($facture->status!='paye_partielle')
                                           <input type="date" class="form-control" id="date_facture"
                                                value="{{ $facture->date }}">
                                            @else
                                            <span class="form-control disabled">{{ $facture->date }}</span>
                                             @endif --}}
                                               <span class="form-control disabled">{{ $facture->date }}</span>
                                            
                                        </div>
                                    </div>

                                     <div class="form-group row">
                                        <p class="name-invoice col-md-5 col-form-label" style="margin-top:10px"><b>Date
                                                paiement</b></p>
                                        <div class="col-md-7">

                                            {{-- @if($facture->status!='paye_partielle')
                                           <input type="date" class="form-control" id="date_facture"
                                                value="{{ $facture->date }}">
                                            @else
                                            <span class="form-control disabled">{{ $facture->date }}</span>
                                             @endif --}}
                                               <span class="form-control disabled">{{ $facture->date_paiement }}</span>
                                            
                                        </div>
                                    </div>
                                    
                                    

                                    
                                </div>
                            </div>

                             <div class="col-md-4">
                                <div class="billed-to-address">
                                    <h3>
                                        Frais:@if ($facture->status != 'paye' && $facture->status != 'paye_partielle' && $facture->status != 'valide')
                                                <span style="font-size:14px;color:green;cursor:pointer;font-weight:500"
                                                    onclick="add_frais()">(Ajouter)</span>
                                            @endif
                                    </h3>

                                    <div class="form-group row">
                                        <p class="name-invoice col-md-5 col-form-label" style="margin-top:10px"><b>Timbre</b></p>
                                        <div class="col-md-7">

                                            {{-- @if($facture->status!='paye_partielle')
                                           <input type="date" class="form-control" id="date_facture"
                                                value="{{ $facture->date }}">
                                            @else
                                            <span class="form-control disabled">{{ $facture->date }}</span>
                                             @endif --}}
                                               <input @if ($facture->status == 'paye' || $facture->status == 'paye_partielle' || $facture->status == 'valide') disabled @endif type="number" class="form-control"
                                            id="timbre_value" value="{{ $facture->timbre }}" onchange="total_final()"
                                            >
                                            
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <p class="name-invoice col-md-5 col-form-label" style="margin-top:10px"><b>Retenu à la source (%)</b></p>
                                        <div class="col-md-7">

                                            {{-- @if($facture->status!='paye_partielle')
                                           <input type="date" class="form-control" id="date_facture"
                                                value="{{ $facture->date }}">
                                            @else
                                            <span class="form-control disabled">{{ $facture->date }}</span>
                                             @endif --}}
                                            
                                        </div>
                                    </div>

                                    {{-- <div class="form-group row" style="margin-top:15px">

                                        <div class="col-md-9">
                                            <input type="text" class="form-control" placeholder="Nom du frais" name="titre[]">
                                        </div>
                                        <div class="col-md-9" style="margin-top:5px">
                                            <input type="number" class="form-control" name="montant[]" placeholder="Montant">
                                        </div>
                                        <div class="col-md-3 frais-annuler" >
                                        <a class='btn btn-danger ' style="float:right"><span style="font-size:12px">Annuler</span></a>
                                        </div>
                                    
                                        

                                    </div> --}}
                                    <table style="margin-top:15px" id="frais_table">
                                        <tbody>
                                            @foreach ($facture->frais as $frais)
                                                <tr>
                                                    <td style="width:80%">
                                                        <br>
                                                        <input @if ($facture->status == 'paye' || $facture->status == 'paye_partielle' || $facture->status == 'valide') disabled @endif type="hidden"
                                                            class="form-control" placeholder="Nom du frais" name="id_frais[]"
                                                            value="{{ $frais->id }}">

                                                        <input @if ($facture->status == 'paye' || $facture->status == 'paye_partielle' || $facture->status == 'valide') disabled @endif type="text"
                                                            class="form-control" placeholder="Nom du frais" name="titre[]"
                                                            value="{{ $frais->nom }}">
                                                        <input @if ($facture->status == 'paye' || $facture->status == 'paye_partielle' || $facture->status == 'valide') disabled @endif type="number"
                                                            class="form-control" name="montant[]" onchange='total_final()'
                                                            placeholder="Montant" style="margin-top:5px" value="{{ $frais->montant }}">
                                                    </td>
                                                    @if ($facture->status != 'paye' && $facture->status != 'paye_partielle' && $facture->status != 'valide')
                                                        <td>
                                                            <a class='btn btn-danger ' style="float:right;margin-left:5px"
                                                                onclick=delete_frais($(this))><span
                                                                    style="font-size:12px">Annuler</span></a>
                                                        </td>
                                                    @endif
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>


                                </div>
                            </div>
                           
                        </div>
                    </div>
                    <div class="row" style="margin-top:30px">
                        <div class="col-md-6 col-sm-6">
                            <div class="seipkon-breadcromb-left" style="margin-top:15px">
                                <h3>Liste des opérations</h3>
                            </div>
                        </div>
                         @if($facture->status!='paye_partielle' && $facture->status!='valide' && $facture->status!='paye')
                        <div class="col-md-6 col-sm-6">
                            <div class="seipkon-breadcromb-right">
                               <button class="btn btn-success btn_mobile" data-toggle="modal" data-target="#produit_catalogue" >Ajouter produit éxistant</button> 
                                <button class="btn btn-success btn_mobile" onclick="addoperation('new')">Ajouter nouveau produit</button>
                            </div>
                        </div>
                        
                        @endif
                    </div>
                    <div class="invoice-table">

                        <div class="table-responsive">
                            <table class="table table-bordered" id="facture_table">
                                    <tr id=0 style="background:#DEE2E6 "> 
                                        <th>Produit</th>
                                        <th>Déscription</th>
                                        <th style="width:10%">Quantités:</th>
                                        <th style="width:12%">Prix unitaire HT</th>
                                        <th style="width:12%"><span style="font-size:14px">TVA : </span>
                                        </th>
                                        <th style="width:12%"><span style="font-size:14px">Remise : </span>

                                        </th>
                                        <th>Total HT</th>

                                        <th>Total remise</th>

                                        <th>Total TVA</th>
                                        <th>Total TTC</th>
                                         @if($facture->status!='paye_partielle' && $facture->status!='valide' && $facture->status!='paye')<th>#</th>@endif
                                    </tr>
                                    @if (count($facture->items) > 0)
                                        @foreach ($facture->items as $key => $item)
                                            <tr id="{{ $key + 1 }}">

                                            <td> 
                                            <input type='hidden' class='form-control' value={{$item->id}} name='id[]'>

                                            @if($facture->status!='paye_partielle' && $facture->status!='valide' && $facture->status!='paye')
                                            <input type="text" class="form-control"
                                                        value="{{ $item->produit }}"name="produits[]"  id="{{ $key + 1 }}_produit">
                                            @else
                                                <span class="form-control disabled"> {{ $item->produit }}</span>
                                            @endif  



                                            </td>
                                             <td> 
                                                <textarea class='form-control' id='description_id[]-{{ $key + 1 }}' name='description[]' @if($facture->status == 'paye_partielle' || $facture->status == 'valide' || $facture->status == 'paye') disabled @endif >{{$item->description}}</textarea>
                                                </td>
                                                <td> 
                                           @if($facture->status!='paye_partielle' && $facture->status!='valide' && $facture->status!='paye')
                                             <input type="number" class="form-control"
                                                        value="{{ $item->quantites }}" name="quantites[]" min="1"
                                                        required onchange=calcule($(this)) id="quantites_id-{{ $key + 1 }}">
                                            @else
                                                <span class="form-control disabled">{{$item->quantites}}</span>
                                            @endif  
                                                
                                            

                                                  
                                                </td>
                                               


                                                
                                                <td> 

                                            @if($facture->status!='paye_partielle' && $facture->status!='valide' && $facture->status!='paye')
                                                 <input type="number" class="form-control"
                                                        value="{{ $item->prix_ht }}"name="prix_ht[]" onchange=calcule($(this));test_prix($(this)) old-value="{{ $item->prix_ht }}" id="prix_id-{{ $key + 1 }}">
                                            @else
                                                <span class="form-control disabled">{{$item->prix_ht}}</span>
                                            @endif  
                                                </td>

                                                <td>  
                                             @if($facture->status!='paye_partielle' && $facture->status!='valide' && $facture->status!='paye')
                                                 <select onchange=calcule($(this))  name='tva[]'class='form-control none' style='margin-top:5px'id="tva_id-{{ $key + 1 }}" >
                                                            @foreach ($taxes as $taxe)
                                                                        <option value='{{ $taxe->pourcentage }}' style='float:left'
                                                                         {{ $taxe->pourcentage == $item->tva ? 'selected' : '' }}
                                                                        >
                                                                            {{ $taxe->nom }}</option>
                                                            @endforeach
                                                 </select>
                                            @else
                                                <span class="form-control disabled">{{ $item->tva}}</span>
                                            @endif  
                                                  
                                                </td>
                                                <td>

                                                    

                                                    <div class="row justify-content-start">


                                                        <div class="col-md-6">







                                                            @if($facture->status!='paye_partielle' && $facture->status!='valide' && $facture->status!='paye')
                                                               <input type="number" class="form-control"
                                                                value="{{ $item->remise }}" name="remise[]" required
                                                                style="width:70px" onchange=calcule($(this)) id="remise_id-{{ $key + 1 }}">
                                                            @else
                                                                <span class="form-control disabled">
                                                                
                                                              {{ $item->remise }}
                                                                
                                                                </span>
                                                            @endif  

                                                            
                                                        </div>
                                                        <div class="col-md-6">

                                                            

                                                            @if($facture->status!='paye_partielle' && $facture->status!='valide' && $facture->status!='paye')
                                                                <select class="form-select none" style="margin-top:5px"
                                                                id="type_remise-{{ $key + 1 }}" onchange=calcule($(this))>
                                                                <option value="pourcentage"
                                                                    {{ $item->type_remise == 'pourcentage' ? 'selected' : '' }}>
                                                                    <span style="font-size:10px">%
                                                                    </span>
                                                                </option>
                                                                <option value="montant"
                                                                    {{ $item->type_remise == 'montant' ? 'selected' : '' }}>
                                                                    <span style="font-size:10px">TND
                                                                    </span>
                                                                </option>
                                                            </select>
                                                            @else
                                                                <span class="form-control disabled">
                                                                
                                                                {{ $item->type_remise == 'montant' ? 'TND' : '' }}
                                                                {{ $item->type_remise == 'pourcentage' ? '%' : '' }}
                                                                
                                                                </span>
                                                            @endif  



                                                        </div>
                                                    </div>


                                                </td>

                                                <td><span id='total_ht_id-{{$key+1}}'>{{ replace(sprintf('%.3f', $item->total_ht)) }}</span></td>

                                                <td><span id='total_remise_id-{{$key+1}}'>{{ replace(sprintf('%.3f', $item->total_remise)) }}</span></td>


                                                <td><span id='total_tva_id-{{$key+1}}'>{{ replace(sprintf('%.3f', $item->total_tva)) }}</span></td>
                                                <td><span id='total_ttc_id-{{$key+1}}'>{{ replace(sprintf('%.3f', $item->total_ttc)) }}</span></td>
                                                @if($facture->status!='paye_partielle' && $facture->status!='valide' && $facture->status!='paye')
                                                <td>
                                                    <a class="btn btn_mobile" onclick="delete_operation($(this))">X
                                                    </a>
                                                </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    @endif
                            </table>
                        </div>
                    </div>
                    <div class="invoice-footer-note">
                        <div class="row">
                            <div class="col-md-8">
                                @if (count($facture->paiements) > 0)
                                    <div class="invoice-company-address">
                                        <h3>Les paiements effectués</h3>


                                    </div>
                                    <table class="table table-bordered" style="width:80%;margin-top:10px">
                                        <thead>
                                            <tr>
                                                <th class="th-livraison">
                                                    Montant
                                                </th>
                                                <th class="th-livraison">
                                                    Date de paiement
                                                </th>
                                                <th class="th-livraison">
                                                    Méthodes
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($facture->paiements as $paiement)
                                                <tr>
                                                    <td class="livraison">
                                                        {{ replace(sprintf('%.3f', $paiement->montant)) }}
                                                    </td>
                                                    <td class="livraison">{{ date('Y-m-d', strtotime($paiement->date)) }}
                                                    </td>
                                                    <td class="livraison">{{ $paiement->method }}
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>


                                    </table>
                                @endif

                                <div class="invoice-subtotal" style="text-align:left">
                                    <p class="paiement-facture"><span>Total Payé:</span>-
                                        {{ replace(sprintf('%.3f', $facture->facture_paye)) }}
                                        TND</p>


                                    <p class="paiement-facture"><span >Solde restant:</span> <span
                                            class="total-style-solde">{{ replace(sprintf('%.3f', $facture->facture_solde)) }}
                                        </span>TND
                                    </p>


                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <div class="invoice-subtotal">
                                    <p><span>Total HT:</span><span id='total_facture_ht'>
                                            {{ replace(sprintf('%.3f', $facture->facture_ht)) }} </span> TND</p>
                                    <p><span>Total Remise:</span>
                                        <span
                                            id='total_facture_remise'>-{{ replace(sprintf('%.3f', $facture->facture_remise)) }}</span>TND
                                    </p>


                                    <p><span>Total TVA:</span><span id='total_facture_tva'>
                                            {{ replace(sprintf('%.3f', $facture->facture_tva)) }}</span> TND
                                    </p>
                                    <p><span>Total Frais:</span><span id='total_facture_frais'>
                                            {{ replace(sprintf('%.3f', $facture->facture_debour)) }}</span>
                                        TND
                                    </p>
                                    <p><span>Timbre:</span><span id='timbre'>
                                            {{ replace(sprintf('%.3f', $facture->timbre)) }}</span>
                                        TND
                                    </p>
                                  


                                    <p><span>Total
                                            TTC:</span> <span class="total-style-ttc"
                                            id='total_facture_ttc'>{{ replace(sprintf('%.3f', $facture->facture_ttc)) }}
                                        </span>TND
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-8 col-sm-8">
                                <div class="invoice-note">
                                    <h4>Conditions de ventes :</h4>
                                    {{-- <input style="height:94px" class="form-control" name="condition"
                                        value="@if ($facture->condition) {{ $facture->condition }}@else {{ $facture->entreprise->condition }}@endif" />  --}}


                                    <textarea class="form-control  @error('condition') is-invalid @enderror " @if($facture->status=='paye_partielle' || $facture->status=='valide' || $facture->status=='paye') disabled @endif name="condition">@if ($facture->condition) {{ $facture->condition }}@else{{ $facture->entreprise->condition }}@endif
                                     </textarea>


                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="invoice-action">
                        <div class="row">
                            <div class="col-md-12">
                            
                                <h4 style="color:#333;float:left">Pied de la page :</h4>
                                <br>
                               

                                <textarea class="form-control" name="footer" @if($facture->status=='paye_partielle' || $facture->status=='valide' || $facture->status=='paye') disabled @endif>@if ($facture->footer){{ $facture->footer }}@else{{ $facture->entreprise->footer }}@endif
                                </textarea>

                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
     
    </div>


    <div class="modal fade" id="produit_catalogue" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" style="float:left" id="exampleModalLongTitle">Ajouter un produit
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="inputPassword" class="col-md-4 col-form-label">Choisir
                                le produit</label>
                            <div class="col-md-8">
                                <input type="hidden" id="client_id" />
                                <select class="js-example-basic-single js-states form-control"style="width: 100%"
                                    id="cataloge_id" required>
                                    @foreach ($catalogues as $catalogue)
                                        <option value="{{ $catalogue->id }}" style="float:left">
                                            {{ $catalogue->produit }} ( {{ $catalogue->numero }})</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-dismiss="modal">Retour</button>
                        <button type="submit" class="btn btn-primary" onclick="add_catalogue()">Ajouter</button>
                    </div>

            </div>
        </div>
    </div>
    <!-- End Invoice Row -->

   <div class="modal fade" id="payement" role="dialog" aria-labelledby="exampleModalCenterTitle"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" style="float:left" id="exampleModalLongTitle">
                                                Saisir le paiement:<span style="font-size:13px;">Solde
                                                    réstant(<span id="new_solde">{{ $facture->facture_solde }}</span> TND)</span>

                                            </h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form id="paiement_form">

                                            <div class="modal-body">
                                                
                                                {{-- <p style="font-size:14px;font-weight:500;margin-bottom:10px;padding-bottom:5px;border-bottom:1px  #e5e5e5 solid"
                                                    class="text-success"> L'avance du client
                                                    :{{ $montant_avance }} TND
                                                    @if ($montant_avance > 0)
                                                        <input type="radio" class="custom-control-input" id="avance"
                                                            name="type_paiement_avance" style="margin-left:20px"
                                                            value="avance" onchange="test_avance()">
                                                        <label class="custom-control-label" for="avance"
                                                            style="color:black" class="text-info">
                                                            Utilisez l'avance
                                                        </label>
                                                    @endif

                                                    <input type="radio" class="custom-control-input" id="sans_avance"
                                                        value="sans_avance" name="type_paiement_avance"
                                                        style="margin-left:10px" onchange="test_avance()" checked>
                                                    <label class="custom-control-label" for="sans_avance"
                                                        style="color:black">Sans Avance</label><br>
                                                    @if ($montant_avance > 0)
                                                        <div class="form-group row">
                                                            <label for="inputPassword"
                                                                class="col-md-4 col-form-label">Montant avance</label>
                                                            <div class="col-md-8">
                                                                <input type="number" class="form-control"
                                                                    id="montant_avance">

                                                            </div>
                                                        </div>
                                                    @endif
                                                </p> --}}
                                                <div class="form-group row">
                                                    <label for="inputPassword" class="col-md-4 col-form-label">
                                                        Montant</label>
                                                    <div class="col-md-8">
                                                        <input type="number" class="form-control" id="montant"
                                                            value="{{ $facture->facture_solde }}" >

                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputPassword" class="col-md-4 col-form-label">Date du
                                                        paiement</label>
                                                    <div class="col-md-8">
                                                        <input type="date" class="form-control" id="date"
                                                            value="{{ date('Y-m-d') }}">

                                                    </div>
                                                </div>


                                                <div class="form-group row">
                                                    <label for="inputPassword" class="col-md-4 col-form-label">Methode de
                                                        paiement</label>
                                                    <div class="col-md-8">
                                                        <select class="form-control none" id="method">
                                                            <option value="cheque">Chèque</option>
                                                            <option value="especes">Especes</option>
                                                            <option value="virement">Virement</option>
                                                            <option value="traite">Traite</option>

                                                        </select>

                                                    </div>
                                                </div>
                                                {{-- <div class="form-group row">
                                                    <label for="inputPassword" class="col-md-4 col-form-label">
                                                        Retenu a la source</label>
                                                    <div class="col-md-8">
                                                        <i class="fa-solid fa-toggle-on text-success"
                                                            style="font-size:24px;cursor:pointer" id="active"
                                                            value="active" status="1"
                                                            onclick="change_togle($(this))"></i>
                                                        <i class="fa-solid fa-toggle-off text-dark"
                                                            style="font-size:24px;cursor:pointer;display:none"
                                                            id="desactive" value="desactive" status="0"
                                                           onclick="change_togle($(this))" ></i>
                                                    </div>
                                                </div> --}}
                                                <div class="form-floating mb-3  ">
                                                    <label for="floatingTextarea2">Note</label>

                                                    <textarea class="form-control" id="note" id="floatingTextarea2" style="height: 100px"></textarea>
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-warning"
                                                    data-dismiss="modal">Annuler</button>
                                                <button type="submit" class="btn btn-primary" id="submit_paiement"
                                                    onclick="paiement()">Valider
                                                    le paiement</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
@endsection
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.5.1/sweetalert2.all.min.js"></script>

<script>
    {{-- function change_togle(toogle) {

       
        $("#new_solde").empty()
        var type_click = toogle.attr('value')
        var facture_solde=parseFloat('{{$facture->facture_solde}}')
        var facture_retenu= parseFloat("{{ $facture->facture_retenu }}")
       
        var new_solde=facture_solde+facture_retenu
        console.log(new_solde)

        if (type_click == "active") {
            $('#desactive').attr('status', "1")
            $('#active').attr('status', "0")
            $('#desactive').show()
            $('#active').hide()
            
            $('#montant').val(new_solde.toFixed(3))
             $("#new_solde").html(new_solde.toFixed(3).replace('.', ','))

        } else if (type_click == "desactive") {
            $('#desactive').attr('status', "0")
            $('#active').attr('status', "1")
            $('#active').show()
            $('#desactive').hide()
            $('#montant').val(facture_solde.toFixed(3))
            $("#new_solde").html(facture_solde.toFixed(3).replace('.', ','))

        }

    } --}}
    //frais
    function delete_frais(row) {
        row.closest('tr').remove();
        total_final()
    }
       function paiement() {
      $('#submit_paiement').attr('disabled', 'disabled'); 
        $('.erreur').empty()

        var date = jQuery('#date').val()
        var montant = jQuery('#montant').val()
        var method = jQuery('#method').val()
        var note = jQuery('#note').val()
        var retenu = "{{ $facture->retenu }}"
        var status_retenu = "desactive"
        if (retenu > 0) {
            var active = $('#active')
            var desactive = $('#desactive')
           
            if(active.attr('status')==1){
            status_retenu = "active"     
            }
            else if(desactive.attr('status')==1){
            status_retenu = "desactive"     

            }
        }
        console.log(status_retenu)

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        jQuery.ajax({
            url: "{{ url('/savepaiement') }}/" + '{{ $facture->id }}',
            method: 'post',
            data: {
                status_retenu:status_retenu,
                date: date,
                montant: montant,
                method: method,
                note: note,
                _token: "{{ csrf_token() }}",
            },
            success: function(result) {
                console.log(result.error_montant);
                if (result.error_montant != null) {
                    $('#submit_paiement').removeAttr('disabled');

                    error_message(result.error_montant, "#montant")
                }
                if (result.error) {

                    $('#submit_paiement').removeAttr('disabled');

                    if (result.error.date) {
                        error_message(result.error.date[0], "#date")
                    }
                    if (result.error.montant) {
                        error_message(result.error.montant[0], "#montant")
                    }
                    if (result.error.method) {
                        error_message(result.error.method[0], "#method")
                    }


                } else if (result == 200) {


                    Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'Paiement effectué avecc succéss',
                        showConfirmButton: false,
                        timer: 1000
                    })

                    setTimeout(function() {

                        location.reload(true);
                    }, 1000);

                } else if (result == -1) {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'Ereeur modification ,Facture déja payé',
                        showConfirmButton: false,
                        timer: 1000
                    })

                    setTimeout(function() {

                        location.reload(true);
                    }, 1000);





                }

            }
        });

    }
    function add_frais() {
        $('#frais_table tbody').append("<tr> " +
            "<td style='width:80%'><br>" +
            "<input type='hidden' class='form-control' name='id_frais[]' value='new'><input type='text' class='form-control' placeholder='Nom du frais' name='titre[]'>" +
            "<input type='number' class='form-control' name='montant[]'  onchange='total_final()' placeholder='Montant'" +
            " style='margin-top:5px'>" +
            " </td>" +
            "<td>" +
            "<a class='btn btn-danger ' style='float:right;margin-left:5px' onclick=delete_frais($(this))><span style='font-size:12px'>Annuler</span></a>" +
            "</td>" +
            " </tr>")
    }
    $(document).ready(function() {
          if("{{$facture->status}}"=="paye" || "{{$facture->status}}"=="paye_partielle"  ){
         $("#desactive").prop("onclick", null).off("click");
         $("#active").prop("onclick", null).off("click");
        } 
        var retenu = "{{ $facture->retenu }}"

        if (retenu == 0) {
            $('#desactive').attr('status', "1")
            $('#desactive').show()
            $("#desactive").prop("onclick", null).off("click");
            $('#active').remove()
        }
        //status facture
        var status_facture = '{{ $facture->status }}'

        if (status_facture == 'annuler') {
            $('.invoice-status').css('background', 'red')
            $('.invoice-status').toggleClass('annuler');
            $('.invoice-status').html('Annulé')

        } else if (status_facture == 'en cours') {
            $('.invoice-status').css('background', '#A6ACAF')
            $('.invoice-status').toggleClass('etablir');
            $('.invoice-status').html('En cours')

        } else if (status_facture == 'valide') {
            $('.invoice-status').css('background', '#21618C')
            $('.invoice-status').toggleClass('envoye');
            $('.invoice-status').html('facture valide')

        } else if (status_facture == 'paye') {
            $('.invoice-status').css('background', '#0B5345')
            $('.invoice-status').toggleClass('paye_total');
            $('.invoice-status').html('Payé')

        }
        else if (status_facture == 'paye_partielle') {
              $('.invoice-status').html('Payé partiellement')
            $('.invoice-status').css('background', '#eea236')
            $('.invoice-status').toggleClass('paye_partielle');

        }

        
        $('#facture_table tr').each(function() {
            if (this.id > 0) {
                var tva_id="#tva_id-"+this.id
       
       var type_client='{{$facture->client->type}}'
             if(type_client=='sans_taxe'){
                        $( tva_id+"> option").each(function() {
                           if(this.value!=0){
                            this.remove()
                           }
                        });

              }
               else{
                    $(tva_id+ " option[value=" +result.tva+ "]").prop('selected', true);
            }
            }

        });
         

    });
   
     //error_message
    function error_message(messages, input) {
        return $("<span class='text-danger erreur' style='float:left;font-size:13px' >" + messages + "</span>")
            .insertAfter(input);
    }
    //test_number
    function test_number(number, test) {
        if (!isNaN(number) && parseFloat(number) >= parseFloat(test)) {
            return true
        } else {
            return false
        }
    }
    //save
    function savefacture(type_save) {
        $('.erreur').empty();
        var test = true
        var title_var = ""
        var obligatoire =
            "<p class='text-danger erreur' style='float:left;font-size:13px' >Ce champ est obligatoire</p>"
        var number =
            "<p class='text-danger erreur' style='float:left;font-size:13px' >Ce champ est doit etre supérieur ou égale a 0,001</p>"

        var quantites =
            "<p class='text-danger erreur' style='float:left;font-size:13px' >Ce champ est doit etre supérieur ou égale a 1</p>"

        var remise =
            "<p class='text-danger erreur' style='float:left;font-size:13px' >Ce champ est doit etre un entier</p>"



        if ($('#facture_table tr').length <= 1) {
            test = false
            title_var = "La facture est vide"

        } else {
            title_var = "Il faut remplir tous les champs correctement"

        }




        var rowCount = $('#facture_table tr').length;
        var all_remises = []
        var tva = []

        $('#facture_table tr').each(function() {
            if (this.id > 0) {
                var remises = $("#type_remise-" + this.id + " option:selected").val()
                var item_tva = $("#tva_id-" + this.id + " option:selected").val()
                all_remises.push(remises)
                tva.push(item_tva)
            }

        });
        

           

        var catalogues = []
        var produits = []

       


        var ids = $("input[name='id[]']")
            .map(function() {
                return $(this).val();
            }).get();

         var nom_frais = $("input[name='titre[]']")
            .map(function() {
                if (!$(this).val()) {
                    test = false
                    $(obligatoire).insertAfter(this);
                }


                return $(this).val();
            }).get();


        var montant_frais = $("input[name='montant[]']")
            .map(function() {
                if (!$(this).val()) {
                    test = false
                    $(obligatoire).insertAfter(this);

                } else if (!test_number($(this).val(), 0)) {
                    test = false
                    $(number).insertAfter(this);


                }
                return $(this).val();
            }).get();
            var id_frais = $("input[name='id_frais[]']")
            .map(function() {

                if (!$(this).val()) {
                    test = false

                }

                return $(this).val();
            }).get();


        var quantites = $("input[name='quantites[]']")
            .map(function() {


                if (!$(this).val()) {
                    test = false
                    $(obligatoire).insertAfter(this);

                } else if (!test_number($(this).val(), 0.001)) {
                    test = false
                    $(quantites).insertAfter(this);


                }

                return $(this).val();
            }).get();

          var description = $("textarea[name='description[]']")
            .map(function() {


                if (!$(this).val()) {
                    test = false
                    $(obligatoire).insertAfter(this);

                }

                return $(this).val();
            }).get();

         var produits = $("input[name='produits[]']")
            .map(function() {


                if (!$(this).val()) {
                    test = false
                    $(obligatoire).insertAfter(this);

                }

                return $(this).val();
            }).get(); 


      
        var prix_ht = $("input[name='prix_ht[]']")
            .map(function() {

                if (!$(this).val()) {
                    test = false
                    $(obligatoire).insertAfter(this);

                } else if (!test_number($(this).val(), 0.001)) {
                    test = false
                    $(number).insertAfter(this);


                }
                return $(this).val();
            }).get();
    


        var remise = $("input[name='remise[]']")
            .map(function() {
                if ($(this).val() && !test_number($(this).val(), 0)) {
                    test = false
                    $(remise).insertAfter(this);
                }
                return $(this).val();
            }).get();


        if (test == false) {
            swal.fire({
                title: title_var,

                timer: 1000,
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading()
                    const b = Swal.getHtmlContainer().querySelector('b')
                    timerInterval = setInterval(() => {
                        b.textContent = Swal.getTimerLeft()
                    }, 100)
                },
                willClose: () => {
                    clearInterval(timerInterval)
                }
            }).then((result) => {
                /* Read more about handling dismissals below */
                if (result.dismiss === Swal.DismissReason.timer) {}
            })


        }

        if (test == true) {
             var frais = []
             var items = []
            for (let j = 0; j < nom_frais.length; j++) {

                frais.push({
                    'nom': nom_frais[j],
                    'montant': montant_frais[j],
                    'id': id_frais[j]

                })


            }

            for (let i = 0; i < quantites.length; i++) {

                    if(!remise[i]){
                        remise[i]=0
                    }
                object=total(prix_ht[i], quantites[i], tva[i], remise[i], all_remises[i])
          
                items.push({
                    'id':ids[i],
                    'produit':produits[i],
                    'description':description[i],
                    'quantites': quantites[i],
                    'prix_ht': prix_ht[i],
                    'tva': tva[i],
                    'remise': remise[i],
                    'total_remise': object['total_remise'],
                    'type_remise': all_remises[i],
                    'total_ht': object['total_ht'],
                    'total_tva': object['total_tva'],
                    'total_ttc': object['total_ttc'],
                })


            }
            var itemsJson = JSON.stringify(items);
            var fraisJson = JSON.stringify(frais);
            var condition = $("textarea[name='condition']").val();
            var footer = $("textarea[name='footer']").val();
            var status = $('#status').val();
            var timbre = 0
            if ($("#timbre_value").val()) {
                timbre = $("#timbre_value").val()

            }
            var status = jQuery('#status').val()
            var retenu = jQuery('#retenu').val()
            
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            
         
            
            if (status == "valide") {



                swal.fire({
                    title: "Valider la facture?",
                    icon: 'question',
                    text: "Etes-vous sûrs,vous voulez valider la facture ??  Vous ne pouvez pas changer la facture ultérieurement !!",
                    type: "warning",
                    showCancelButton: !0,
                    customClass: 'swal-wide',
                    confirmButtonText: "Oui, Confirmer!",
                    cancelButtonText: "Non, Annuler!",
                    reverseButtons: !0
                }).then(function(e) {

                    if (e.value === true) {
                        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                        jQuery.ajax({
                url: "{{ url('/savefacture') }}/" + '{{ $facture->id }}',
                method: 'post',
                data: {
                    items: itemsJson,
                    condition: condition,
                    footer: footer,
                    status: status,
                    frais: fraisJson,
                    status: status,
                     retenu: retenu,
                    timbre: timbre,
                    _token: "{{ csrf_token() }}",
                },
                success: function(result) {

                   if (result.error) {
                        Swal.fire({
                            position: 'top-center',
                            icon: 'error',
                            title: 'Un erreur est survenu',
                            showConfirmButton: true,
                            timer: 3000
                        })
                        if (result.error.numero_facture) {
                            error_message(result.error.numero_facture[0], "#numero_facture")
                        }
                        if (result.error.date_facture) {
                            error_message(result.error.date_facture[0], "#date_facture")
                        }

                    } else if (result == 200) {
                     
                              Swal.fire({
                            position: 'top-center',
                            icon: 'success',
                            title: 'facture configuré avecc succéss',
                            showConfirmButton: false,
                            timer: 1000
                        })

                        setTimeout(function() {

                            location.reload(true);
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



            } else if (status == "en cours") {
            
            
            jQuery.ajax({
                url: "{{ url('/savefacture') }}/" + '{{ $facture->id }}',
                method: 'post',
                data: {
                    items: itemsJson,
                    condition: condition,
                    footer: footer,
                    status: status,
                    frais: fraisJson,
                    status: status,
                     retenu: retenu,
                    timbre: timbre,
                    _token: "{{ csrf_token() }}",
                },
                success: function(result) {

                   if (result.error) {
                        Swal.fire({
                            position: 'top-center',
                            icon: 'error',
                            title: 'Un erreur est survenu',
                            showConfirmButton: true,
                            timer: 3000
                        })
                        if (result.error.numero_facture) {
                            error_message(result.error.numero_facture[0], "#numero_facture")
                        }
                        if (result.error.date_facture) {
                            error_message(result.error.date_facture[0], "#date_facture")
                        }

                    } else if (result == 200) {
                     
                              Swal.fire({
                            position: 'top-center',
                            icon: 'success',
                            title: 'facture configuré avecc succéss',
                            showConfirmButton: false,
                            timer: 1000
                        })

                        setTimeout(function() {

                            location.reload(true);
                        }, 1000);

                      
                         
                      

                    } 

                }
            }); 
          }
        }
    }



     function add_catalogue(){
            var cataloge=$('#cataloge_id').val();
            var page_data = {{ Js::from($facture->items) }};
            var rowCount = $('#facture_table  tr').length;
            var id = 0;
            if (rowCount > 1) {
                var id = $('#facture_table tr').last().attr('id');
            }

            var id_1 = parseInt(id) + 1
            var name_remise = "type_remise-" + id_1
            var catalogue_id = "catalogue_id_" + id_1
            var quantites_id = "quantites_id-" + id_1
            var prix_id = "prix_id-" + id_1
            var tva_id = "tva_id-" + id_1
            var remise_id = "remise_id-" + id_1
                                                                                                                                    
            var total_ht_id = "total_ht_id-" + id_1
            var total_remise_id = "total_remise_id-" + id_1
            var total_tva_id = "total_tva_id-" + id_1
            var total_ttc_id = "total_ttc_id-" + id_1
            var description = "description_id-" + id_1


            
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            jQuery.ajax({
                url: "{{ url('/onecatalogue') }}/" + cataloge,
                method: 'get',
                data: {
                 
                    _token: "{{ csrf_token() }}",
                },
                success: function(result) {
                    console.log(result)
                     $('#facture_table tr:last').after(
                    "<tr id=" + id_1 +
                    "><td><input type='hidden' class='form-control' value='new' name='id[]'> <input type='text' class='form-control' name='produits[]' value='"+result.produit+"' id="+catalogue_id+"_produit>"+
                                    "</td>"+
                                    "<td><textarea class='form-control' id="+description+" name='description[]'  @if($facture->status=='converti_facture' && $facture->status=='valide') disabled @endif >"+
                                    ""+result.description+"</textarea></td>"+
                                    "<td><input type='number' class='form-control'  value='"+result.quantites+"' name='quantites[]' onchange=calcule($(this)) required id="+quantites_id+"></td><td> <input type='text' onchange=calcule($(this));test_prix($(this))  class='form-control'  name='prix_ht[]' value='"+result.prix_ht+"' old- required id="+prix_id+"></td>"+
                                    "<td> <select onchange=calcule($(this))  name='tva[]'class='form-control none' style='margin-top:5px' id=" +
                    tva_id +
                    ">"+
                                    "@foreach ($taxes as $taxe)"+
                                           "<option value='{{ $taxe->pourcentage }}' style='float:left' " +(result.tva=='{{ $taxe->pourcentage }}' ? 'selected': '') +">"+
                                                "{{ $taxe->nom }}</option>"+
                                    "@endforeach"+
                                    "</td><td> <div class='row justify-content-start'> <div class='col-md-6'><input type='number' class='form-control' value='"+result.remise+"' name='remise[]'  onchange=calcule($(this))  id="+remise_id+" required style='width:70px'></div><div class='col-md-6'><select onchange=calcule($(this))  name='type_remise'class='form-select none' style='margin-top:5px' id=" +
                    name_remise +
                    "><option value='pourcentage' " +(result.type_remise=='pourcentage' ? 'selected': '')+ "><span style='font-size:10px'>%</span></option><option value='montant' "+(result.type_remise=='montant' ? 'selected': '') +"><span style='font-size:10px'>TND </span></option></select></div></div></td><td id="+total_ht_id+">"+result.total_ht+"</td><td id="+total_remise_id+">"+result.total_remise+"</td><td id="+total_tva_id+">"+result.total_tva+"</td><td id="+total_ttc_id+">"+result.total_ttc+"</td><td><a class='btn btn_mobile' onclick ='delete_operation($(this))'>X</a></td></tr>"
                );
                 
                   $("#produit_catalogue .close").click()
                total_final()
                }
            });  
                     
    }

     //add row
    function addoperation(test) {

        var page_data = {{ Js::from($facture->items) }};
        var rowCount = $('#facture_table  tr').length;
        var id = 0;
        if (rowCount > 1) {
            var id = $('#facture_table tr').last().attr('id');
        }

        var id_1 = parseInt(id) + 1
        var name_remise = "type_remise-" + id_1
        var catalogue_id = "catalogue_id_" + id_1
        var quantites_id = "quantites_id-" + id_1
        var prix_id = "prix_id-" + id_1
        var tva_id = "tva_id-" + id_1
        var remise_id = "remise_id-" + id_1
                                                                                                                                
        var total_ht_id = "total_ht_id-" + id_1
        var total_remise_id = "total_remise_id-" + id_1
        var total_tva_id = "total_tva_id-" + id_1
        var total_ttc_id = "total_ttc_id-" + id_1
        var description = "description_id-" + id_1

        var object={'id':catalogue_id}
        {{-- if(test==="existe"){


        
        $('#facture_table tr:last').after(
            "<tr id=" + id_1 +
            "><td><input type='hidden' class='form-control' value='new' name='id[]'><select onchange=catalogue_info($(this).val(),"+catalogue_id.toString()+") class='js-example-basic-single js-states form-control' style='width: 100%'"+
                                "id="+catalogue_id+" required>"+
                                "@foreach ($catalogues as $catalogue)"+
                                    "<option value='{{ $catalogue->id }}' style='float:left'>"+
                                        "{{ $catalogue->produit }}</option>"+
                                "@endforeach"+
                            "</select>"+
                            "</td>"+
                            "<td><textarea class='form-control' id="+description+" name='description[]' @if($facture->status=='paye_partielle' && $facture->status=='valide') disabled @endif >"+
                            "</textarea></td>"+
                            "<td><input type='number' class='form-control' value='' name='quantites[]' onchange=calcule($(this)) required id="+quantites_id+"></td><td> <input type='text' onchange=calcule($(this));test_prix($(this))  class='form-control' value='' name='prix_ht[]' old-value='' required id="+prix_id+"></td>"+
                            "<td> <select onchange=calcule($(this))  name='tva[]'class='form-control none' style='margin-top:5px' id=" +
            tva_id +
            ">"+
                            "@foreach ($taxes as $taxe)"+
                                    "<option value='{{ $taxe->pourcentage }}' style='float:left'>"+
                                        "{{ $taxe->nom }}</option>"+
                             "@endforeach"+
                            "</td><td> <div class='row justify-content-start'> <div class='col-md-6'><input type='number' class='form-control' value='' name='remise[]' onchange=calcule($(this))  id="+remise_id+" required style='width:70px'></div><div class='col-md-6'><select onchange=calcule($(this))  name='type_remise'class='form-select none' style='margin-top:5px' id=" +
            name_remise +
            "><option value='pourcentage'> <span style='font-size:10px'>%</span></option><option value='montant'><span style='font-size:10px'>TND </span></option></select></div></div></td><td id="+total_ht_id+"></td><td id="+total_remise_id+"></td><td id="+total_tva_id+"></td><td id="+total_ttc_id+"></td><td><a class='btn btn_mobile' onclick ='delete_operation($(this))'>X</a></td></tr>"
        );

         $('#facture_table tr').each(function() {
            if(this.id==id_1){
               $(this).find("td:eq(0) select option:selected").each (function( column, select) {
                  catalogue_info(select.value,object)
              });  
            }
        }); 
        } --}}
      
            $('#facture_table tr:last').after(
            "<tr id=" + id_1 +
            "><td><input type='hidden' class='form-control' value='new' name='id[]'> <input type='text' class='form-control' name='produits[]' id="+catalogue_id+"_produit>"+
                            "</td>"+
                            "<td><textarea class='form-control' id="+description+" name='description[]' @if($facture->status=='paye_partielle' && $facture->status=='valide') disabled @endif >"+
                            "</textarea></td>"+
                            "<td><input type='number' class='form-control' value='' name='quantites[]' onchange=calcule($(this)) required id="+quantites_id+"></td><td> <input type='text' onchange=calcule($(this));test_prix($(this))  class='form-control' value='' name='prix_ht[]' old-value='' required id="+prix_id+"></td>"+
                            "<td> <select onchange=calcule($(this))  name='tva[]'class='form-control none' style='margin-top:5px' id=" +
            tva_id +
            ">"+
                            "@foreach ($taxes as $taxe)"+
                                    "<option value='{{ $taxe->pourcentage }}' style='float:left'>"+
                                        "{{ $taxe->nom }}</option>"+
                             "@endforeach"+
                            "</td><td> <div class='row justify-content-start'> <div class='col-md-6'><input type='number' class='form-control' value='' name='remise[]' onchange=calcule($(this))  id="+remise_id+" required style='width:70px'></div><div class='col-md-6'><select onchange=calcule($(this))  name='type_remise'class='form-select none' style='margin-top:5px' id=" +
            name_remise +
            "><option value='pourcentage'> <span style='font-size:10px'>%</span></option><option value='montant'><span style='font-size:10px'>TND </span></option></select></div></div></td><td id="+total_ht_id+"></td><td id="+total_remise_id+"></td><td id="+total_tva_id+"></td><td id="+total_ttc_id+"></td><td><a class='btn btn_mobile' onclick ='delete_operation($(this))'>X</a></td></tr>"
        );

  
        total_final()
   
    }
     //delete row
    function delete_operation(row) {
        row.closest('tr').remove();
        total_final()
    }

    //get destination from select
    function catalogue_info(select_val,select_id){
    select_id = select_id.id.replace('catalogue_id_','');
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            jQuery.ajax({
                url: "{{ url('/onecatalogue') }}/" + select_val,
                method: 'get',
                data: {
                 
                    _token: "{{ csrf_token() }}",
                },
                success: function(result) {
                    var name_remise = "#type_remise-" + select_id
                    var catalogue_id = "#catalogue_id_" + select_id
                    var quantites_id = "#quantites_id-" + select_id
                    var prix_id = "#prix_id-" + select_id
                    var tva_id = "#tva_id-" + select_id
                    var remise_id = "#remise_id-" + select_id
                    var total_ht_id = "#total_ht_id-" + select_id
                    var total_remise_id = "#total_remise_id-" + select_id
                    var total_tva_id = "#total_tva_id-" + select_id
                    var total_ttc_id = "#total_ttc_id-" + select_id
                    var name_remise = "#type_remise-" + select_id
                    var description = "#description_id-" + select_id

                    $(total_ht_id).empty()
                    $(total_remise_id).empty()
                    $(total_tva_id).empty()
                    $(total_ttc_id).empty()
                    $(quantites_id).val(result.quantites)
                    $(prix_id).val(result.prix_ht)
                    
                    var type_client='{{$facture->client->type}}'
                    if(type_client=='sans_taxe'){
                        $( tva_id+"> option").each(function() {
                           if(this.value!=0){
                            this.remove()
                           }
                        });

                    }
                    else{
                    $(tva_id+ " option[value=" +result.tva+ "]").prop('selected', true);

                    }

                    
                    $(remise_id).val(result.remise)

                    if(result.type_remise=='pourcentage'){
                     $(name_remise+ " option[value='pourcentage']").prop('selected', true);
                    $(name_remise).change()
                    }
                    else if(result.type_remise=='montant'){
                    $(name_remise+ " option[value='montant']").prop('selected', true);
                    $(name_remise).change()
                    }
                    var total_tva=0.000;
                     if(type_client=='avec_taxe'){
                      $(total_tva_id).html(total_tva)
                      total_tva=result.total_tva

                     }
                    total_ttc=parseFloat(result.total_ht-result.total_remise)+parseFloat(total_tva)
                    $(total_tva_id).html(total_tva)
                    $(total_ht_id).html(result.total_ht)
                    $(total_remise_id).html(result.total_remise)
                    $(total_ttc_id).html(parseFloat(total_ttc).toFixed(3))
                    $("textarea#description_id-"+select_id).text(result.description)

                    total_final()
                }
            });  

    }
       //when input change calcule
     function calcule(ligne){
           select_id=ligne.attr('id').match(/\d+/)[0]

            var name_remise = $("#type_remise-" + select_id).val()
            var quantites_id = $("#quantites_id-" + select_id).val()
            var prix_id = $("#prix_id-" + select_id).val()
            var tva_id = $("#tva_id-" + select_id).val()
            var remise_id = $("#remise_id-" + select_id).val()
               
               if(!quantites_id){
               quantites_id=1

               }
                if(!prix_id){
                  prix_id=0


               }
                if(!tva_id){
                   tva_id=0


               }
                if(!remise_id){
                remise_id=0


               }
               
            

           object=total(prix_id, quantites_id, tva_id, remise_id, name_remise)
           var total_ht_id = "#total_ht_id-" + select_id
            var total_remise_id = "#total_remise_id-" + select_id
            var total_tva_id = "#total_tva_id-" + select_id
            var total_ttc_id = "#total_ttc_id-" + select_id

                    $(total_ht_id).empty()
                    $(total_remise_id).empty()
                    $(total_tva_id).empty()
                    $(total_ttc_id).empty()

                     $(total_ht_id).html(object['total_ht'].replace('.',','))
                    $(total_remise_id).html(object['total_remise'].replace('.',','))
                    $(total_tva_id).html(object['total_tva'].replace('.',','))
                    $(total_ttc_id).html(object['total_ttc'].replace('.',','))
            total_final()  
      
      }

        //calcule total in array
      function total(prix_ht, quantites, tva, remise_valeur, type_remise) {

        if(!test_number(prix_ht, 0) || !test_number(quantites, 0))
        {
        return false
               
        }
         if(!prix_ht|| !quantites)
        {
        return false
               
        }
        
        

        var totale_ht = parseFloat(prix_ht) * parseFloat(quantites)
        
        
        if (type_remise == 'pourcentage') {
            var total_remise = parseFloat(totale_ht) * (parseFloat(remise_valeur) / 100)
        } else if (type_remise == 'montant') {
            var total_remise = parseFloat(remise_valeur)

        }
        var new_total_ht=parseFloat(totale_ht) -parseFloat(total_remise)
        var total_tva = parseFloat(new_total_ht) * (parseFloat(tva) / 100)
        
        var total_ttc = parseFloat(new_total_ht) + parseFloat(total_tva)

        return {
            'total_ht': parseFloat(totale_ht).toFixed(3),
            'total_tva': parseFloat(total_tva).toFixed(3),
            'total_remise': parseFloat(total_remise).toFixed(3),
            'type_remise': parseFloat(type_remise).toFixed(3),
            'total_ttc': parseFloat(total_ttc).toFixed(3),
        }

    }

    //function final

   function total_final() {
        var total_ht = 0
        var total_remise = 0
        var total_tva = 0
        var total_ttc = 0
        var total_debours = 0
        var timbre = 0
        if ($("#timbre_value").val()) {
            timbre = $("#timbre_value").val()

        }

        $('#facture_table tr').each(function() {

            var currentRow = $(this).closest("tr");
            if (this.id > 0) {

                var col_ht = currentRow.find("td:eq(6)").text().replace(',', '.');

                var col_remise = currentRow.find("td:eq(7)").text().replace(',', '.');
                var col_tva = currentRow.find("td:eq(8)").text().replace(',', '.');
                var col_ttc = currentRow.find("td:eq(9)").text().replace(',', '.');
                total_ht += parseFloat(col_ht)
                total_remise += parseFloat(col_remise)
                total_tva += parseFloat(col_tva)
                total_ttc += parseFloat(col_ttc)
            }
        });

        var montant_frais = $("input[name='montant[]']")
            .map(function() {
                if (!$(this).val()) {
                    return 0;

                } else {
                    return $(this).val()
                }
            }).get();


        for (montant of montant_frais) {
            total_debours += parseFloat(montant)

        }

        $("#total_facture_ht").empty()
        $("#total_facture_remise").empty()
        $("#total_facture_tva").empty()
        $("#total_facture_ttc").empty()
        $("#total_retenu_ht").empty()
        $('.total-style-solde').empty()



        var montant_retenu = 0
        var retenu = 0
        var items_factures = {{ Js::from($facture->items) }};

        


        total_ttc = parseFloat(total_ttc) + parseFloat(total_debours) + parseFloat(timbre)
   

        {{-- $("#total_retenu_ht").html('-' + retenu.toFixed(3).replace('.', ',')) --}}

        $("#total_facture_ht").html(total_ht.toFixed(3).replace('.', ','))
        $("#total_facture_frais").html(total_debours.toFixed(3).replace('.', ','))
        $("#total_facture_remise").html('-' + total_remise.toFixed(3).replace('.', ','))
        $("#total_facture_tva").html(total_tva.toFixed(3).replace('.', ','))
        $("#timbre").html(parseFloat(timbre).toFixed(3).replace('.', ','))
        $("#total_facture_ttc").html(total_ttc.toFixed(3).replace('.', ','))
        $(".total-style-solde").html(total_ttc.toFixed(3).replace('.', ','))

    }
    function test_prix(input)
    {
      $('#save_facture').attr('disabled',true)
      var prev =input.attr('old-value');
      
      var select_id=input.attr('id').match(/\d+/)[0]
       var catalogue_id = $("#catalogue_id_" +select_id+ " option:selected").val()
         $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            jQuery.ajax({
                url: "{{ url('/onecatalogue') }}/" + catalogue_id,
                method: 'get',
                data: {
                 
                    _token: "{{ csrf_token() }}",
                },
                success: function(result) {
                    if(parseFloat(result.prix_ht)>parseFloat(input.val())){
                        error_message('Le prix introduit est inférieur au prix dans le catalogue (minimum:'+result.prix_ht+' Dt)',input)
                        setTimeout( "$('.erreur').hide();", 3000);

                        if(!prev){
                        input.val(result.prix_ht)

                        }
                        else{
                        input.val(prev)

                        }

                        input.change()
                    }
            $('#save_facture').attr('disabled',false)
                    
                }
            });  

    }
      function generate_ordres()
      {
          $('.erreur').empty()
            var facture_id = '{{$facture->id}}'
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });


            swal.fire({
                title: "Générer des ordres de travail?",
                icon: 'question',
                text: "Etes-vous sûrs,vous voulez générer des ordres de travail ??  Vous ne pouvez pas changer la facture ultérieurement !!",
                type: "warning",
                showCancelButton: !0,
                customClass: 'swal-wide',
                confirmButtonText: "Oui, Confirmer!",
                cancelButtonText: "Non, Annuler!",
                reverseButtons: !0
            }).then(function(e) {

                if (e.value === true) {
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                        jQuery.ajax({
                    url: "{{ url('/addordre') }}",
                    method: 'post',
                    data: {
                        facture_id: facture_id,
                        _token: "{{ csrf_token() }}",
                    },
                    success: function(result) {
                        if (result.error) {
                            if (result.error.facture_id) {
                                error_message(result.error.facture_id[0], "#facture_id")
                            }
                        } 
                        else if (result.success_id) {
                        Swal.fire({
                                position: 'top-center',
                                icon: 'success',
                                title: 'Ordres générés avec succéss',
                                showConfirmButton: false,
                                timer: 1000
                            })
                            setTimeout(function() {
                                window.location.href ="{{ url('/updateordre') }}/"+result.success_id+"/all"
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
