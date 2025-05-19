/*=========================================================================================
[Advance Table Custom Javascript]

Project	     : Seipkon - Responsive Admin Template
Author       : Hassan Rasu
Author URL   : https://themeforest.net/user/themescare
Version      : 1.0
Primary use  : Seipkon - Responsive Admin Template

Only Use For advance-table.html Page.

==========================================================================================*/


(function ($) {
	"use strict";

	jQuery(document).ready(function ($) {
		//client_table
		var client_table=$('.client_table_index').DataTable({
            'paging': true,
            'pagingType': "numbers",
            'language': {
                searchPlaceholder: 'Rechercher...',
                sSearch: ''
            },
            order: [
                [0, 'des']
            ],
        });
		jQuery('.status-dropdown').on('change', function(e){
			var status = $(this).val();
			$('.status-dropdown').val(status)
			//dataTable.column(6).search('\\s' + status + '\\s', true, false, true).draw();
			client_table.column(6).search(status).draw();
		  })
		var devis_table=$('.devis_table_index').DataTable({
            'paging': true,
            'pagingType': "numbers",
            'language': {
                searchPlaceholder: 'Rechercher...',
                sSearch: ''
            },
            order: [
                [0, 'des']
            ],
        });
		jQuery('.status-dropdown').on('change', function(e){
			var status = $(this).val();
			$('.status-dropdown').val(status)
			//dataTable.column(6).search('\\s' + status + '\\s', true, false, true).draw();
			devis_table.column(5).search(status).draw();
		  })
		var dossier=$('.dossier_table_index').DataTable({
            'paging': true,
            'pagingType': "numbers",
            'language': {
                searchPlaceholder: 'Rechercher...',
                sSearch: ''
            },
            order: [
                [0, 'des']
            ],
        });

		jQuery('.status-dropdown').on('change', function(e){
			var status = $(this).val();
			$('.status-dropdown').val(status)
			//dataTable.column(6).search('\\s' + status + '\\s', true, false, true).draw();
			dossier.column(6).search(status).draw();
		  })

		$('.ordres_table_index').DataTable({
            'paging': true,
            'pagingType': "numbers",
            'language': {
                searchPlaceholder: 'Rechercher...',
                sSearch: ''
            },
            order: [
                [0, 'des']
            ],
        });
		
		
	var	facture_table =$('.facture_table_index').DataTable({
            'paging': true,
            'pagingType': "numbers",
            'language': {
                searchPlaceholder: 'Rechercher...',
                sSearch: ''
            },
            order: [
                [0, 'des']
            ],
        });


		var	camion_table =$('#camion_table_index').DataTable({
            'paging': true,
            'pagingType': "numbers",
            'language': {
                searchPlaceholder: 'Rechercher...',
                sSearch: ''
            },
            order: [
                [0, 'des']
            ],
        });
		var	chauffeur_index =$('#chauffeur_table_index').DataTable({
            'paging': true,
            'pagingType': "numbers",
            'language': {
                searchPlaceholder: 'Rechercher...',
                sSearch: ''
            },
            order: [
                [0, 'des']
            ],
        });
		jQuery('.status-dropdown').on('change', function(e){
			var status = $(this).val();
			$('.status-dropdown').val(status)
			//dataTable.column(6).search('\\s' + status + '\\s', true, false, true).draw();
			chauffeur_index.column(3).search(status).draw();
			camion_table.column(4).search(status).draw();
		  })
		  jQuery('.status-dropdown-facture').on('change', function(e){
			var status = $(this).val();
			$('.status-dropdown').val(status)
			//dataTable.column(6).search('\\s' + status + '\\s', true, false, true).draw();
			facture_table.column(7).search(status).draw();

		  })

		  

		jQuery('.status-dropdown').on('change', function(e){
			var status = $(this).val();
			$('.status-dropdown').val(status)
			//dataTable.column(6).search('\\s' + status + '\\s', true, false, true).draw();
			facture_table.column(7).search(status).draw();
		  })




		$('.paiement_table_index').DataTable({
            'paging': true,
            'pagingType': "numbers",		
            'language': {
                searchPlaceholder: 'Rechercher...',
                sSearch: ''
            },
            order: [
                [0, 'des']
            ],
        });
		$('.livraisons_index').DataTable({
            'paging': true,
            'pagingType': "numbers",		
            'language': {
                searchPlaceholder: 'Rechercher...',
                sSearch: ''
            },
            order: [
                [0, 'des']
            ],
        });

		/* 
		=================================================================
		Datatables Example One JS
		=================================================================	
		*/
		$('#datatables_example_1').DataTable({
			'order': [
				[0, "desc"]
			],
			'paging': true,
			'pagingType': "numbers",
			'language': {
				searchPlaceholder: 'Search...',
				sSearch: ''
			}
		});

		/* 
		=================================================================
		Responsiv Datatables Example JS
		=================================================================	
		*/

	
		$('#responsive_datatables_example').DataTable({
			'paging': true,
			'pagingType': "numbers",
			'language': {
				searchPlaceholder: 'Rechercher...',
				sSearch: ''
			},
			order: [[0, 'desc']],
		});

		

		var table = $('#button_datatables_example').DataTable({

			'pagingType': "numbers",
			'lengthChange': false,
			'language': {
				searchPlaceholder: 'Search...',
				sSearch: ''
			}
		});

		new $.fn.dataTable.Buttons(table, {
			buttons: [{
					extend: "copy",
					className: "datatable-btn btn-sm"
				},
				{
					extend: "csv",
					className: "datatable-btn btn-sm"
				},
				{
					extend: "pdf",
					className: "datatable-btn btn-sm"
				},
				{
					extend: "print",
					className: "datatable-btn btn-sm"
				}
			]
		});

		table.buttons().container()
			.appendTo($('.col-sm-6:eq(0)', table.table().container()));


	});




}(jQuery));