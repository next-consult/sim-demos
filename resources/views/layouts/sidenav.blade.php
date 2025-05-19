<!-- Sidebar Start -->
<?php
 $routeName = \Request::route()->getName();

 ?>
<aside class="seipkon-main-sidebar">
    <nav id="sidebar">
        <!-- Sidebar Profile Start -->
        <div class="sidebar-profile clearfix">
            <div class="profile-avatar">
                <img src="{{ asset('assets/img') . '/' . auth()->user()->photo }}" alt="profile" />
            </div>
            <div class="profile-info">
                <h3>{{ auth()->user()->name }} </h3>
                <p>Bienvenue !</p>
            </div>
        </div>
        <!-- Sidebar Profile End -->

        <!-- Menu Section Start -->
        <div class="menu-section">
            <ul class="list-unstyled components">
@if(auth()->user()->role_id != 13)

                <li class="@if ($routeName == 'home') active @endif">
                    <a href="{{ route('home') }}">
                        <i class="fa fa-dashboard"></i>
                        Dashboard
                    </a>
                </li>
				@endif

            </ul>
            @if(auth()->user()->role_id != 13)
<h3>CRM</h3>@endif

            <ul class="list-unstyled components">
                @can('contacts')
                <li class="@if ($routeName == 'crm.contact.index') active @endif">
                    <a href="{{ route('crm.contact.index') }}">
                        <i class="fa-solid fa-address-book"></i>
                        Leads
                    </a>
                </li>
                @endcan
                @can('opportunites')
                <li class="@if ($routeName == 'crm.index_new') active @endif">
                    <a href="{{ route('crm.index_new') }}">
                        <i class="fa-solid fa-chart-simple"></i>
                        Pipeline
                    </a>
                </li>
                @endcan
                @can('calendrier')
                <li class="@if ($routeName == 'crm.calendars') active @endif">
                    <a href="{{ route('crm.calendars') }}">
                        <i class="fa-solid fa-calendar-days"></i>
                        Calendrier
                    </a>
                </li>
                @endcan

            </ul>@can('clients')
            <h3>Vente</h3>

            <ul class="list-unstyled components">

                
                <li class="@if (
                         $routeName == 'clients.index' ||
                             $routeName == 'clients.add' ||
                             $routeName == 'clients.update' ||
                             $routeName == 'clients.show') active @endif">
                    <a href="{{ route('clients.index') }}">
                        <i class="fa fa-users"></i>
                        Clients
                    </a>
                </li>
				                <li class="@if ($routeName == 'contrats.index') active @endif">
                    <a href="{{ route('contrats.index') }}">
                        <i class="fa-solid  fa-file-contract"></i>
                        Contrats
                    </a>
                </li>
                @endcan
				

                @can('fournisseurs')
                <li
                    class="@if ($routeName == 'fournisseur.index' || $routeName == 'fournisseur.add' || $routeName == 'fournisseur.update') active @endif">
                    <a href="{{ route('fournisseur.index') }}">
                        <i class="fa fa-building-user"></i>
                        Fournisseurs
                    </a>
                </li>
                @endcan

                @can('catalogues')
                <li
                    class="@if ($routeName == 'catalogues.index' || $routeName == 'catalogues.update' || $routeName == 'catalogues.add') active @endif">
                      <a href="#produits_menu" data-toggle="collapse" aria-expanded="false">
                        <i class="fa-solid fa-money-check"></i>
                        Produits
                    </a>
			<ul class="collapse list-unstyled" id="produits_menu">
                        <li>
                            <a href="{{ route('catalogues.index') }}">
                                <i class="fa-solid fa-box"></i>
                                Liste des produits
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('catalogues.client-products') }}" class="nav-link {{ request()->routeIs('catalogues.client-products') ? 'active' : '' }}">
                                <i class="fa-solid fa-box"></i>
                                Produits Clients
                            </a>
                        </li>
                    </ul>
                </li>
				   <li class="@if ($routeName == 'stock.index' || $routeName == 'stock.update' || $routeName == 'stock.add') active @endif">

                    <a href="#ex_multlable" data-toggle="collapse" aria-expanded="false">
                        <i class="fa-solid fa-warehouse"></i>
                        Stock
                    </a>
                    <ul class="collapse list-unstyled" id="ex_multlable">
                       <li><a href="{{ route('stock.index') }}">
                        <i class="fa-solid fa-chart-line"></i>                        Entrée /Sortie</a></li>
                       <li><a href="{{ route('stock.emplacement') }}">
                        <i class="fa-solid fa-boxes-stacked"></i>                        Emplacement</a></li>
						                        <li><a href="{{ route('stock.etat') }}">
                            <i class="fa-solid fa-boxes-stacked"></i>État de Stock</a></li>
						
						
                       {{-- <li><a href="{{ route('stock.entree') }}">
                        <i class="fa-solid fa-truck-moving"></i>                        Entrée</a></li>
                       <li><a href="{{ route('stock.sortie') }}">
                        <i class="fa-solid fa-truck-ramp-box"></i>                        Sortie</a></li> --}}
                    </ul>
                 </li>
                @endcan
				


             
                
                @can('devis')
                <li class="@if ($routeName == 'devis.index' || $routeName == 'devis.update') active @endif">
                    <a href="{{ route('devis.index') }}">
                        <i class="fa-solid fa-file-export" style="margin-right:5px"></i>
                        Devis
                    </a>
                </li>
                @endcan
                @can('bonlivraison')
                <li class="@if ($routeName == 'bonlivraisons.index') active @endif">
                    <a href="{{ route('bonlivraisons.index') }}">
                        <i class="fa-solid fa-truck-fast" style="margin-right:5px"></i>
                        Bonlivraisons
                    </a>
                </li>
                @endcan
                @can('boncommande')
                <li class="@if ($routeName == 'boncommande.index') active @endif">
                    <a href="{{ route('boncommande.index') }}">
                        <i class="fa-solid fa-file-export"></i>
                        Bon de commandes
                    </a>
                </li>
                @endcan

                @can('factures')
                <li class="@if ($routeName == 'factures.index') active @endif">
                    <a href="{{ route('factures.index') }}">
                        <i class="fa-solid fa-file-circle-check"></i>
                        Factures
                    </a>
                </li>
                @endcan
                @can('paiements')
                <li class="@if ($routeName == 'paiement.index') active @endif">
                    <a href="{{ route('paiement.index') }}">

                        <i class="fa-solid fa-credit-card"></i>
                        Paiements
                    </a>
                </li>
                @endcan
                @can('interventions')
                <li class="@if ($routeName == 'interventions.index') active @endif">
                    <a href="{{ route('interventions.index') }}">
                        <i class="fa-solid fa-briefcase"></i>

                        Interventions
                    </a>
                </li>
				{{-- <li class="@if ($routeName == 'plannings.index') active @endif">
                    <a href="{{ route('plannings.index') }}">
                        <i class="fa-solid fa-calendar"></i>
                        Old Planning
                    </a>
                </li> --}}
                <li class="@if ($routeName == 'plannings.gear2') active @endif">
                    <a href="{{ route('plannings.gear2') }}">
                        <i class="fa-solid fa-calendar"></i>
                        Planning
                    </a>
                </li>
                @endcan

                @can('depenses')
                <li
                    class="@if ($routeName == 'depense.index' || $routeName == 'depense.add' || $routeName == 'depense.update') active @endif">
                    <a href="{{ route('depense.index') }}">
                        <i class="fa-solid fa-sack-dollar"></i>
                        Dépenses
                    </a>
                </li>
                @endcan

                {{-- <li
                    class="@if ($routeName == 'bonlivraisons.index' || $routeName == 'bonlivraisons.update') active @endif">
                    <a href="{{ route('bonlivraisons.index') }}">

                        <i class="fa-solid fa-truck-fast"></i>
                        Bon de livraison
                    </a>
                </li> --}}
            </ul>

            <h3>Congés</h3>

            <ul class="list-unstyled components">
                @can('conges')
                <li class="@if (
                         $routeName == 'conges.index' ||
                             $routeName == 'conges.add' ||
                             $routeName == 'conges.update'
                            ) active @endif">
                    <a href="{{ route('conges.index') }}">
                        <i class="fa-solid fa-share-from-square"></i>
                        Mes demandes des congés
                    </a>
                </li>
                @endcan
                @can('conges_admin')
                <li class="@if (
                         $routeName == 'conges.admin'
                            ) active @endif">
                    <a href="{{ route('conges.admin') }}">
                        <i class="fa-solid fa-check-to-slot"></i>
                        Accepte/refuse Congés
                    </a>
                </li>
                @endcan

                {{-- @can('clients')
                <li class="@if (
                         $routeName == 'conges.index' ||
                             $routeName == 'conges.add' ||
                             $routeName == 'conges.update' ||
                             ) active @endif">
                    <a href="{{ route('clients.index') }}">
                        <i class="fa fa-users"></i>
                        Clients
                    </a>
                </li>
                @endcan --}}

            </ul>
        </div>
        <!-- Menu Section End -->
        <!-- Menu Camion-->

        <!-- Menu Section End -->

      @if(auth()->user()->role_id != 13)
  <div class="menu-section">
            <h3>Paramétres </h3>@endif

            <ul class="list-unstyled components">

                @can('entreprises')
                <li
                    class="@if ($routeName == 'entreprises.index' || $routeName == 'entreprises.add' || $routeName == 'entreprises.update') active @endif">
                    <a href="{{ route('entreprises.index') }}">
                        <i class="fa-solid fa-building"></i>

                        Entreprises
                    </a>
                </li>
                @endcan
                @can('taxes')
                <li class="@if ($routeName == 'taxe.index') active @endif">
                    <a href="{{ route('taxe.index') }}">
                        <i class="fa-solid fa-money-bill"></i>

                        Taxes
                    </a>
                </li>


                @endcan
              <!--  @can('conges_admin')

                <li class="@if ($routeName == 'parametre.index') active @endif">
                    <a href="{{ route('parametre.index') }}">
                        <i class="fa-solid fa-arrow-right"></i>

                        Congés
                    </a>
                </li>
                @endcan-->
                @can('devise')
                <li class="@if ($routeName == 'devise.index') active @endif">
                    <a href="{{ route('devise.index') }}">
                        <i class="fa-solid fa-coins"></i>

                        Devises
                    </a>
                </li>
                @endcan

               @if(auth()->user()->role_id != 13)
 <li class="@if ($routeName == 'parametre.index') active @endif">
                    <a href="{{ route('parametre.index') }}">
                        <i class="fa-solid fa-coins"></i>

                        Oem parametre
                    </a>
                </li>
@endif

                @can('categories')
                <li class="@if ($routeName == 'categories.index') active @endif">
                    <a href="{{ route('categories.index') }}">
                        <i class="fa-solid fa-layer-group"></i>

                        Categories
                    </a>
                </li>
                @endcan
                @can('utilisateurs')
                <li class="@if ($routeName == 'users.index') active @endif">
                    <a href="{{ route('users.index') }}">
                        <i class="fa-solid fa-users-gear"></i>

                        Utilisateurs
                    </a>
                </li>
                @endcan
                @can('roles')
                <li class="@if ($routeName == 'roles.index') active @endif">
                    <a href="{{ route('roles.index') }}">
                        <i class="fa-solid fa-shield-halved"></i>
                        Roles
                    </a>
                </li>
                @endcan
                @can('groupes')
                <li
                    class="@if ($routeName == 'groupe.index' || $routeName == 'groupe.add' || $routeName == 'groupe.update') active @endif">
                    <a href="{{ route('groupe.index') }}">
                        <i class="fa-solid fa-laptop-file"></i>
                        Compteur
                    </a>
                </li>
                @endcan
                @can('chiffres')
                <li class="@if ($routeName == 'chiffreaffaire.index') active @endif">
                    <a href="{{ route('chiffreaffaire.index') }}">
                        <i class="fa-solid fa-money-check-dollar"></i>
                        Chiffre affaire
                    </a>
                </li>
                @endcan



            </ul>
        </div>
        <!-- Menu Section End -->



    </nav>
</aside>
<!-- End Sidebar -->
