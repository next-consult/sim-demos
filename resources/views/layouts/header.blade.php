<!-- Main Header Start -->
<header class="main-header">

    <!-- Logo Start -->
    <div class="seipkon-logo">
        <a href="{{ route('home') }}">
            <img src="{{ asset('assets/img/new_sim.png') }}" alt="logo"
                style="width:140px;margin-top:18px">
        </a>
    </div>
    <!-- Logo End -->

    <!-- Header Top Start -->
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="header-top-section">

                <div class="header-top-right-section pull-right">
                    <ul class="nav nav-pills nav-top navbar-right">
                        <div class="pull-left">

                            <!-- Collapse Menu Btn Start -->
                            <button type="button" id="sidebarCollapse" class=" navbar-btn">
                                <i class="fa fa-bars"></i>
                            </button>
                            <!-- Collapse Menu Btn End -->


                            <!-- Header Top Search End -->

                        </div>
                        <!-- Full Screen Btn Start -->
                        <li>
                            <a href="#" id="fullscreen-button">
                                <i class="fa fa-arrows-alt"></i>
                            </a>
                        </li>

                        <?php
                        $all_notifs = \App\Models\Notif::where('user_id', auth()->user()->id)
                            ->orderBy('created_at', 'desc')
                            ->get();
                        $unread_notifs = \App\Models\Notif::where('user_id', auth()->user()->id)
                            ->where('read_at', null)
                            ->orderBy('created_at', 'desc')
                            ->get();
                        
                        ?>

                        <li class="dropdown">
                            <a class="dropdown-toggle cart-icon" href="#" data-toggle="dropdown"
                                onclick="read_notifs()">
                                <i class="fa fa-bell"></i>
                                <span id="js-count">{{ count($unread_notifs) }}</span>

                                <input type="hidden" value="{{ auth()->user()->id }}" id="user_id" />
                            </a>
                            <div class="notification-box dropdown-menu animated bounceIn">
                                <div class="notification-header">
                                    {{-- <h4>3 new notification</h4> --}}
                                    {{-- <a href="#">clear all</a> --}}
                                </div>
                                <div class="notification-body">
                                    <ul>
                                        @if (count($all_notifs) > 0)
                                            @foreach ($all_notifs as $notif)
                                                @if ($notif->type_notif == 'conge_en_attente')
                                                    <li>
                                                        <a href="{{ route('conges.admin') }}"
                                                            class="single-notification">
                                                            <div class="notification-img bg_red">
                                                                <i class="fa fa-calendar" style="font-size:30px"></i>
                                                            </div>
                                                            <div class="notification-txt">
                                                                <h4 style="font-weight:400">{{ $notif->description }}
                                                                </h4>
                                                                <span>{{ $notif->created_at }}</span>
                                                            </div>
                                                        </a>
                                                    </li>
                                                @elseif ($notif->type_notif == 'camion_epuise')
                                               
                                                    <li>
                                                        <a href="{{ route('camions.update', ['id' => $notif->camion_id]) }}"
                                                            class="single-notification">
                                                            <div class="notification-img bg_red">
                                                                <i class="fa fa-truck" style="font-size:30px"></i>
                                                            </div>
                                                            <div class="notification-txt">
                                                                <h4 style="font-weight:400">
                                                                    {!! $notif->description !!}
                                                                </h4>

                                                                <span>{{ $notif->created_at }}</span>
                                                            </div>

                                                        </a>
                                                    </li>
                                                @elseif ($notif->type_notif == 'camion_bientot_epuise')
                                                    <li>
                                                        <a href="{{ route('camions.update', ['id' => $notif->camion_id]) }}"
                                                            class="single-notification">
                                                            <div class="notification-img bg_yellow">
                                                                <i class="fa fa-truck" style="font-size:30px"></i>
                                                            </div>
                                                            <div class="notification-txt">
                                                                <h4 style="font-weight:400">
                                                                    {!! $notif->description !!}
                                                                </h4>

                                                                <span>{{ $notif->created_at }}</span>
                                                            </div>

                                                        </a>
                                                    </li>
                                                @elseif ($notif->type_notif == 'client_montant_epuise')
                                                    <li>
                                                        <a href="{{ route('clients.show', ['id' => $notif->client_id]) }}"
                                                            class="single-notification">
                                                            <div class="notification-img "
                                                                style="background-color:{{ $notif->client->categorie->couleur }}">
                                                                <i class="fa fa-user" style="font-size:30px"></i>
                                                            </div>
                                                            <div class="notification-txt">
                                                                <h4 style="font-weight:400">
                                                                    {!! $notif->description !!}
                                                                </h4>

                                                                <span>{{ $notif->created_at }}</span>
                                                            </div>

                                                        </a>
                                                    </li>
                                                @elseif ($notif->type_notif == 'client_date_bientot_epuise')
                                                    <li>
                                                        <a href="{{ route('factures.update', ['id' => $notif->facture_id]) }}"
                                                            class="single-notification">
                                                            <div class="notification-img "
                                                                style="background-color:{{ $notif->client->categorie->couleur }}">
                                                                <i class="fa fa-user" style="font-size:30px"></i>
                                                            </div>
                                                            <div class="notification-txt">
                                                                <h4 style="font-weight:400">
                                                                    {!! $notif->description !!}
                                                                </h4>

                                                                <span>{{ $notif->created_at }}</span>
                                                            </div>

                                                        </a>
                                                    </li>
                                                @elseif ($notif->type_notif == 'client_date_epuise')
                                                    <li>
                                                        <a href="{{ route('factures.update', ['id' => $notif->facture_id]) }}"
                                                            class="single-notification">
                                                            <div class="notification-img "
                                                                style="background-color:{{ $notif->client->categorie->couleur }}">
                                                                <i class="fa fa-user" style="font-size:30px"></i>
                                                            </div>
                                                            <div class="notification-txt">
                                                                <h4 style="font-weight:400">
                                                                    {!! $notif->description !!}
                                                                </h4>

                                                                <span>{{ $notif->created_at }}</span>
                                                            </div>

                                                        </a>
                                                    </li>
                                                @endif
                                            @endforeach
                                        
										@else
                                            <li class="notification-empty">
                                                <div class="notification-img">
                                                    <i class="fa fa-bell-slash" style="font-size:30px"></i>
                                                </div>
                                                <div class="notification-txt">
                                                    <h4>Aucune notification</h4>
                                                    <span>Vous n'avez pas de nouvelles notifications.</span>
                                                </div>
                                            </li>
@endif
                                        {{-- <li>
                                            <a href="#" class="single-notification">
                                                <div class="notification-img bg_green">
                                                    <i class="fa fa-check"></i>
                                                </div>
                                                <div class="notification-txt">
                                                    <h4>Successful transaction of $210</h4>
                                                    <span>1 minutes ago</span>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="single-notification">
                                                <div class="notification-img bg_red">
                                                    <i class="fa fa-thumbs-up"></i>
                                                </div>
                                                <div class="notification-txt">
                                                    <h4>33 pending post for approval</h4>
                                                    <span>3 minutes ago</span>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="single-notification">
                                                <div class="notification-img bg_blue">
                                                    <i class="fa fa-comments-o"></i>
                                                </div>
                                                <div class="notification-txt">
                                                    <h4>2 new comments found</h4>
                                                    <span>5 minutes ago</span>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="single-notification">
                                                <div class="notification-img bg_green">
                                                    <i class="fa fa-truck "></i>
                                                </div>
                                                <div class="notification-txt">
                                                    <h4>order details confirmation</h4>
                                                    <span>43 seconds ago</span>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="single-notification">
                                                <div class="notification-img bg_yellow">
                                                    <i class="fa fa-envelope-o"></i>
                                                </div>
                                                <div class="notification-txt">
                                                    <h4>you have received an email</h4>
                                                    <span>56 seconds ago</span>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="single-notification">
                                                <div class="notification-img bg_green">
                                                    <i class="fa fa-check"></i>
                                                </div>
                                                <div class="notification-txt">
                                                    <h4>Successful transaction of $210</h4>
                                                    <span>1 minutes ago</span>
                                                </div>
                                            </a>
                                        </li> --}}
										
                                    </ul>
                                </div>
                                <div class="notification-footer">
                                    {{-- <a href="#"><i class="fa fa-angle-down"></i>see all notification</a> --}}
                                </div>
                            </div>
                        </li>
                        <!-- Notification Toggle End -->

                        <!-- Profile Toggle Start -->
                        <li class="dropdown">
                            <a class="dropdown-toggle profile-toggle" href="#" data-toggle="dropdown">
                                <img src="{{ asset('assets/img') . '/' . auth()->user()->photo }}"
                                    class="profile-avator" alt="admin profile" />
                                <div class="profile-avatar-txt">
                                    <p>{{ auth()->user()->name }}</p>
                                    <i class="fa fa-angle-down"></i>
                                </div>
                            </a>
                            <div class="profile-box dropdown-menu animated bounceIn">
                                <ul>
                                    <li><a href="{{ route('profil.update') }}"><i class="fa fa-pencil-square"></i>
                                            Modifier profil</a></li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            <i class="fa fa-power-off"></i> sign out</a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!-- Profile Toggle End -->

                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- Header Top End -->
	
	</header>
<script>
    $(document).ready(function() {
        fetch('/pending-conge-notifications', {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                        'content')
                },

            })
            .then(response => response.json())
            .then(data => {
                console.log('Notifications fetched:', data);
            })
            .catch(error => {
                console.error('Error fetching notifications:', error);
            });
    });
</script>

<!-- Main Header End -->
{{-- $notif_visite=DB::table('customnotifs')->where('user_id',$user->id)
                ->where('created_at','>',now()->subDays(1)->format('Y-m-d H:i:s'))
                ->where('camion_id',$camion->id)
                ->where('camion_type_notif','visite_epuise')
                ->get();
                $notif_assurance=DB::table('customnotifs')->where('user_id',$user->id)
                ->where('created_at','>',now()->subDays(1)->format('Y-m-d H:i:s'))
                ->where('camion_id',$camion->id)

                ->where('camion_type_notif','assurance_epuise')
                ->get();
                $notif_vignette=DB::table('customnotifs')->where('user_id',$user->id)
                ->where('created_at','>',now()->subDays(1)->format('Y-m-d H:i:s'))
                ->where('camion_id',$camion->id)

                ->where('camion_type_notif','vignette_epuise')
                ->get();
                if(strtotime($camion->date_assurance)<=$date_now && $notif_assurance->isEmpty()){
                    Notif::create([
                        "user_id"=>$user->id,
                        "description"=>"L'assurance du camion <b>".$camion->matricule."</b> est epuisé",
                        "camion_id"=>$camion->id,
                        "type_notif"=>'camion_epuise',
                        "camion_type_notif"=>'assurance_epuise',
                    ]);
    
                }
         
                $visite=strtotime(Carbon::parse($camion->date_visite)->addYears(1));

                if($visite<=$date_now && $notif_visite->isEmpty())
                {
   
                Notif::create([
                    "user_id"=>$user->id,
                    "description"=>"La visite technique du camion <b>".$camion->matricule."</b> est epuisé",
                    "camion_id"=>$camion->id,
                    "type_notif"=>'camion_epuise',
                    "camion_type_notif"=>'visite_epuise',
                ]);
   
               } 
              
               if(strtotime($camion->date_vignette)<=$date_now && $notif_vignette->isEmpty()){
          
                Notif::create([
                    "user_id"=>$user->id,
                    "description"=>"La vignette du camion <b>".$camion->matricule."</b> est epuisé",
                    "camion_id"=>$camion->id,
                    "type_notif"=>'camion_epuise',
                    "camion_type_notif"=>'vignette_epuise',
                ]);
               } --}}
