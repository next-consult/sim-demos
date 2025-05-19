<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //clients
        Gate::define('clients', function ($user) {
            $arrays = [];
            foreach ($user->role->permissions as $permission) {
                array_push($arrays, $permission->nom);
            }
            return in_array("clients", $arrays) == true;
        });
        //catalogues
        Gate::define('catalogues', function ($user) {
            $arrays = [];
            foreach ($user->role->permissions as $permission) {
                array_push($arrays, $permission->nom);
            }
            return in_array("catalogues", $arrays) == true;
        });
        //devis
        Gate::define('devis', function ($user) {
            $arrays = [];
            foreach ($user->role->permissions as $permission) {
                array_push($arrays, $permission->nom);
            }
            return in_array("devis", $arrays) == true;
        });
        //factures
        Gate::define('factures', function ($user) {
            $arrays = [];
            foreach ($user->role->permissions as $permission) {
                array_push($arrays, $permission->nom);
            }
            return in_array("factures", $arrays) == true;
        });
        //paiements
        Gate::define('paiements', function ($user) {
            $arrays = [];
            foreach ($user->role->permissions as $permission) {
                array_push($arrays, $permission->nom);
            }
            return in_array("paiements", $arrays) == true;
        });
        //interventions
        Gate::define('interventions', function ($user) {
            $arrays = [];
            foreach ($user->role->permissions as $permission) {
                array_push($arrays, $permission->nom);
            }
            return in_array("interventions", $arrays) == true;
        });
        //entreprises
        Gate::define('entreprises', function ($user) {
            $arrays = [];
            foreach ($user->role->permissions as $permission) {
                array_push($arrays, $permission->nom);
            }
            return in_array("entreprises", $arrays) == true;
        });
        //taxes
        Gate::define('taxes', function ($user) {
            $arrays = [];
            foreach ($user->role->permissions as $permission) {
                array_push($arrays, $permission->nom);
            }
            return in_array("taxes", $arrays) == true;
        });
        //categories
        Gate::define('categories', function ($user) {
            $arrays = [];
            foreach ($user->role->permissions as $permission) {
                array_push($arrays, $permission->nom);
            }
            return in_array("categories", $arrays) == true;
        });
        //utilisateurs
        Gate::define('utilisateurs', function ($user) {
            $arrays = [];
            foreach ($user->role->permissions as $permission) {
                array_push($arrays, $permission->nom);
            }
            return in_array("utilisateurs", $arrays) == true;
        });
        //roles
        Gate::define('roles', function ($user) {
            $arrays = [];
            foreach ($user->role->permissions as $permission) {
                array_push($arrays, $permission->nom);
            }
            return in_array("roles", $arrays) == true;
        });


        //fournisseurs
        Gate::define('fournisseurs', function ($user) {
            $arrays = [];
            foreach ($user->role->permissions as $permission) {
                array_push($arrays, $permission->nom);
            }
            return in_array("fournisseurs", $arrays) == true;
        });

        //depenses
        Gate::define('depenses', function ($user) {
            $arrays = [];
            foreach ($user->role->permissions as $permission) {
                array_push($arrays, $permission->nom);
            }
            return in_array("depenses", $arrays) == true;
        });

        //groupes
        Gate::define('groupes', function ($user) {
            $arrays = [];
            foreach ($user->role->permissions as $permission) {
                array_push($arrays, $permission->nom);
            }
            return in_array("groupes", $arrays) == true;
        });
        //chiffres
        Gate::define('chiffres', function ($user) {
            $arrays = [];
            foreach ($user->role->permissions as $permission) {
                array_push($arrays, $permission->nom);
            }
            return in_array("chiffres", $arrays) == true;
        });

        //contacts
        Gate::define('contacts', function ($user) {
            $arrays = [];
            foreach ($user->role->permissions as $permission) {
                array_push($arrays, $permission->nom);
            }
            return in_array("contacts", $arrays) == true;
        });

        //opportunites
        Gate::define('opportunites', function ($user) {
            $arrays = [];
            foreach ($user->role->permissions as $permission) {
                array_push($arrays, $permission->nom);
            }
            return in_array("opportunites", $arrays) == true;
        });

        //calendrier
        Gate::define('calendrier', function ($user) {
            $arrays = [];
            foreach ($user->role->permissions as $permission) {
                array_push($arrays, $permission->nom);
            }
            return in_array("calendrier", $arrays) == true;
        });

        //bonlivraison
        Gate::define('bonlivraison', function ($user) {
            $arrays = [];
            foreach ($user->role->permissions as $permission) {
                array_push($arrays, $permission->nom);
            }
            return in_array("bonlivraison", $arrays) == true;
        });
        //contrat
        Gate::define('contrat', function ($user) {
            $arrays = [];
            foreach ($user->role->permissions as $permission) {
                array_push($arrays, $permission->nom);
            }
            return in_array("contrat", $arrays) == true;
        });

        //devise
        Gate::define('devise', function ($user) {
            $arrays = [];
            foreach ($user->role->permissions as $permission) {
                array_push($arrays, $permission->nom);
            }
            return in_array("devise", $arrays) == true;
        });

        //boncommande
        Gate::define('boncommande', function ($user) {
            $arrays = [];
            foreach ($user->role->permissions as $permission) {
                array_push($arrays, $permission->nom);
            }
            return in_array("boncommande", $arrays) == true;
        });

        //conges
        Gate::define('conges', function ($user) {
            $arrays = [];
            foreach ($user->role->permissions as $permission) {
                array_push($arrays, $permission->nom);
            }
            return in_array("conges", $arrays) == true;
        });

        //conges_admin
        Gate::define('conges_admin', function ($user) {
            $arrays = [];
            foreach ($user->role->permissions as $permission) {
                array_push($arrays, $permission->nom);
            }
            return in_array("conges_admin", $arrays) == true;
        });
    }
}
