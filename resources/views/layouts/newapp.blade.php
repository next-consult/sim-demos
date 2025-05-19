<!DOCTYPE html>
<html lang="en">


<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Seipkon is a Premium Quality Admin Site Responsive Template" />
    <meta name="keywords"
        content="admin template, admin, admin dashboard, cms, Seipkon Admin, premium admin templates, responsive admin, panel, software, ui, web app, application" />
    <meta name="author" content="Themescare">
    <!-- Title -->
    <title>SIM</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/img/favicon/favicon-32x32.png') }}">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/animate.min.css') }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap/bootstrap.min.css') }}">

    <!-- Themify Icon CSS -->
    {{-- <link rel="stylesheet" href="{{ asset('assets/plugins/themify-icons/themify-icons.css') }}"> --}}
    <!-- Perfect Scrollbar CSS -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.min.css') }}">
    <!-- Jvector CSS -->
    {{-- <link rel="stylesheet" href="{{ asset('assets/plugins/jvector/css/jquery-jvectormap.css') }}"> --}}
    <!-- Daterange CSS -->
    {{-- <link rel="stylesheet" href="{{ asset('assets/plugins/daterangepicker/css/daterangepicker.css') }}"> --}}
    <!-- Bootstrap-select CSS -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-select/css/bootstrap-select.min.css') }}">
    <!-- Summernote CSS -->
    {{-- <link rel="stylesheet" href="{{ asset('assets/plugins/summernote/css/summernote.css') }}"> --}}
    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/seipkon.css') }}">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.css"
        integrity="sha512-0nkKORjFgcyxv3HbE4rzFUlENUMNqic/EzDIeYCgsKa/nwqr2B91Vu/tNAu4Q0cBuG4Xe/D1f/freEci/7GDRA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- fonts CSS -->
    {{-- <link rel="stylesheet" href="{{ asset('assets/fonts/css/all.min.css') }}"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
        integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- font awesome cdn --}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/css/dataTables.bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/css/buttons.bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/css/responsive.bootstrap.min.css') }}">

    {{-- select2 --}}

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

    {{-- sweetalertcss --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.6.0/sweetalert2.css"
        integrity="sha512-0BcnfLcXBm81KVM/wzoS7yZRVflcQC3rj/Wqgi4cHSGktXTMcXrP6kquf1I14JFUj2LiFCfpZCSf/+478ifefA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    {{-- css new --}}

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.0/min/dropzone.min.css">

    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css"
        rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/selectric@1.13.0/public/selectric.min.css">
    <style>
        .title-devis {
            font-size: 16px;
            font-weight: 600;
            border-bottom: 1px solid #e5e5e5;
            padding-bottom: 2px;
            color: #333
        }

        .form-container {
            display: flex;
            justify-content: center;
        }

        .form-row {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .livraison-label {
            margin-right: 10px;
            width: 100px;
            /* Largeur du label */
        }

        .form-control .date-deal {
            width: 200px;
            /* Largeur de l'input */
        }

        .bloc-note {
            border: 1px solid #e5e5e5;
            padding: 15px;
        }

        .btn-note {
            float: right;
            margin-bottom: 10px;
        }

        .modal-lg {
            width: 90% !important;
        }

        .rating {
            display: inline-block;
        }


        /* .active {
            background-color: none !important
        } */
        .star {
            display: inline-block;
            width: 20px;
            height: 20px;
            background-image: url('assets/img/emptyimage.png');
            /* Remplacez par le chemin d'accès correct vers votre image d'étoile remplie */
            background-size: cover;
            cursor: pointer;
        }

        .star.first-star {
            background-image: url('assets/img/staractive.png');
            /* Remplacez par le chemin d'accès correct vers votre image d'étoile vide */
        }

        .star.active {
            background-image: url('assets/img/staractive.png');
            /* Remplacez par le chemin d'accès correct vers votre image d'étoile remplie */
            background-size: cover;
        }

        .delete-li:hover {
            cursor: pointer;
            background: #7B241C !important;
            color: antiquewhite !important;
        }

        .delete-li {
            cursor: pointer;
            background: #7B241C !important;
            color: antiquewhite !important;
        }

        .drop-border {
            border: 2px dashed #aaa;
        }

        .filtre-calendar {
            font-size: 14px;
            color: white;
            padding: 7px;
            border-radius: 3px;
        }

        .element-1 {
            background: #1874A2;
            border: 1px black #1874A2;

        }

        .element-2 {
            background: #0E6655;
            border: 1px black #0E6655;

        }

        .div-opp {
            height: 120px !important
        }

        .right-arrow {
            width: 35px;
            float: right;
            margin-top: -30px
        }

        .toggle.btn.btn-light,
        .toggle.btn.btn-outline-light {
            background-color: red !important;
        }

        .invoice-status.annuler:after {
            /* this selector is more specific, so it takes precedence over the other :after */
            border-color: red transparent !important;
        }

        .invoice-status.paye_total:after {
            /* this selector is more specific, so it takes precedence over the other :after */
            border-color: #0B5345 transparent !important;
        }

        .invoice-status.etablir:after {
            /* this selector is more specific, so it takes precedence over the other :after */
            border-color: #A6ACAF transparent !important;
        }

        .invoice-status.envoye:after {
            /* this selector is more specific, so it takes precedence over the other :after */
            border-color: #21618C transparent !important;
        }

        .invoice-status.paye_partielle:after {
            /* this selector is more specific, so it takes precedence over the other :after */
            border-color: #eea236 transparent !important;
        }

        .titre-oppor {
            font-size: 17px !important;
            font-weight: 700 !important;
            color: #333 !important;

        }

        .nom-client-oppor {
            font-size: 13px !important;
            font-weight: 500 !important;
            color: #333 !important;

        }

        .price {
            font-weight: 600 !important;
            color: #239B56 !important;
        }

        .options {
            font-weight: 800 !important;
            float: right;
            font-size: 17px;
            cursor: pointer;
            margin-top: -3px
        }



        /*-- badge --*/
        .badge {
            padding: 1px 9px 2px;
            font-size: 12.025px;
            font-weight: bold;
            white-space: nowrap;
            color: #ffffff;
            background-color: #999999;
            -webkit-border-radius: 9px;
            -moz-border-radius: 9px;
            border-radius: 9px;
        }

        .badge:hover {
            color: #ffffff;
            text-decoration: none;
            cursor: pointer;
        }

        .badge-error {
            background-color: #b94a48;
        }

        .badge-error:hover {
            background-color: #953b39;
        }

        .badge-warning {
            background-color: #f89406;
        }

        .badge-warning:hover {
            background-color: #c67605;
        }

        .badge-success {
            background-color: #468847;
        }

        .badge-success:hover {
            background-color: #356635;
        }

        .badge-info {
            background-color: #3a87ad;
        }

        .badge-info:hover {
            background-color: #2d6987;
        }

        .badge-inverse {
            background-color: #333333;
        }

        .badge-inverse:hover {
            background-color: #1a1a1a;
        }




        .detail-facture {
            color: black !important;
            font-size: 14px !important
        }


        .livraison {
            font-size: 13px !important;
            text-align: center !important;
            color: black !important;
        }

        .th-livraison {
            font-size: 15px !important;
            text-align: center !important;
            color: black !important;
        }

        .total-style-solde {
            color: #28B463 !important;
            font-size: 17px !important;
            font-weight: 600;

        }

        .total-style-ttc {
            color: #154360 !important;
            font-size: 16px !important;
            font-weight: 600;

        }


        #schedule-add {
            position: absolute !important;
            top: 50% !important;
            left: 50% !important;
            transform: translate(-50%, -50%) !important;
        }

        table#devis_table th {
            font-size: 14px;
        }

        .name-invoice {
            color: #34495E !important;
            font-size: 13px !important
        }

        .test {
            width: 100%;
            margin: 0 auto;
        }

        .block {
            width: 100px;
            float: left;
        }

        .livraison-label {
            font-size: 14px;
            font-weight: 600;
            color: black;
        }

        .livraison-info {
            font-size: 13px;
            font-weight: 400;
            color: black;
            margin-left: 3px
        }

        .delete {
            cursor: pointer
        }

        .select2-container--classic .select2-selection--single .select2-selection__rendered {
            float: left !important
        }

        .colored-toast.swal2-icon-success {
            background-color: #a5dc86 !important;
        }



        /* Table */
        table.table_info td.data {
            background-color: #fde9d9;
        }

        /* button groupe */
        @media only screen and (max-width: 768px) {
            /* For mobile phones: */

            .btn_mobile {
                margin-left: 2px !important;
                margin-top: 10px !important;
            }

            .btn_retour {
                margin-top: 10px !important;

                margin-left: 250px !important;

            }

        }

        @media only screen and (min-width: 768px) {
            .frais-annuler {
                margin-top: -15px !important
            }

            .invoice-subtotal {
                margin-left: 60px !important
            }

            .paiement-facture {
                margin-left: -58px !important
            }

            .filter-select {
                margin-left: 550px;
            }

        }


        .btn-save {
            background-color: #27AE60 !important;

        }


        .btn_mobile {

            background-color: #6c757d !important;
        }

        .btn-options {

            background-color: #6c757d !important;
        }


        /* data table responsive */
        .advance-table,
        .dataTables_scrollBody {
            overflow: visible !important;
        }

        /*-- hover --*/
        .list-group-item:hover {
            background-color: #E9ECEF;
        }

        .swal-wide {
            width: 650px !important;
        }

        /*-- imagepreviwe --}*/
        #img_contain {
            width: 220px;
            margin-top: 15px;


        }

        #file-input {
            margin-left: 7px;
            padding: 10px;
            background-color: gray;
        }

        #image-preview {
            height: 180px;
            width: 180px;
            display: block;
            margin-left: auto;
            margin-right: auto;
            padding: 5px;
        }

        /*-- obligatoire --*/
        .obligatoire {
            color: red;
            font-size: 12px;
        }

        .alert-danger {
            padding: 5px !important
        }

        .table-responsive {
            overflow-y: visible !important;
        }

        /*- dropdownn -*/

        /* Dropdown Button */
        .dropbtn {
            background-color: #3498DB;
            color: white;
            padding: 16px;
            font-size: 16px;
            border: none;
            cursor: pointer;
        }

        /* Dropdown button on hover & focus */
        .dropbtn:hover,
        .dropbtn:focus {
            background-color: #2980B9;
        }

        /* The container <div> - needed to position the dropdown content */
        .dropdown {
            position: relative;
            display: inline-block;
        }

        /* Dropdown Content (Hidden by Default) */
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f1f1f1;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
            bottom: 100%;
            /* Change 'top' to 'bottom' */
        }

        /* Links inside the dropdown */
        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        /* .active {
            background-color: #ddd !important;
        } */

        /* Change color of dropdown links on hover */
        .dropdown-content a:hover {
            background-color: #ddd;
        }

        /* Show the dropdown menu (use JS to add this class to the .dropdown-content container when the user clicks on
        the dropdown button) */
        .show {
            display: block;
        }


        .disabled {
            background-color: #e9ecef ! important;
            opacity: 1;
            pointer-events: auto ! important;
            cursor: not-allowed ! important;
            user-select: none;
        }
    </style>

    @yield('styles')
</head>

<body>

    <!-- Start Page Loading -->
    <div id="loader-wrapper">
        <div id="loader"></div>
        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>
    </div>
    <!-- End Page Loading -->

    <!-- Wrapper Start -->

    <div class="wrapper">
        @include('layouts.header')
        @include('layouts.sidenav')
        <section id="content" class="seipkon-content-wrapper">
            <div class="page-content">

                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="container-fluid">
                    @yield('content')

                </div>
            </div>
            <footer class="seipkon-footer-area">
                <p>SIM</p>
            </footer>
        </section>



    </div>
    <!-- End Wrapper -->


    <!-- jQuery -->
    <script src="{{ asset('assets/js/jquery-3.1.0.min.js') }}"></script>
    <!-- Bootstrap JS -->
    <script src="{{ asset('assets/plugins/bootstrap/bootstrap.min.js') }}"></script>
    <!-- Bootstrap-select JS -->
    <script src="{{ asset('assets/plugins/bootstrap-select/js/bootstrap-select.min.js') }}"></script>
    <!-- Daterange JS -->
    {{-- <script src="{{ asset('assets/plugins/daterangepicker/js/moment.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/daterangepicker/js/daterangepicker.js') }}"></script> --}}
    <!-- Jvector JS -->
    {{-- <script src="{{ asset('assets/plugins/jvector/js/jquery-jvectormap-1.2.2.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jvector/js/jquery-jvectormap-world-mill-en.js') }}"></script>
    <script src="{{ asset('assets/plugins/jvector/js/jvector-init.js') }}"></script> --}}
    <!-- Raphael JS -->
    {{-- <script src="{{ asset('assets/plugins/raphael/js/raphael.min.js') }}"></script> --}}
    <!-- Morris JS -->
    {{-- <script src="{{ asset('assets/plugins/morris/js/morris.min.js') }}"></script> --}}
    <!-- Sparkline JS -->
    {{-- <script src="{{ asset('assets/plugins/sparkline/js/jquery.sparkline.js') }}"></script> --}}
    <!-- Chart JS -->
    {{-- <script src="{{ asset('assets/plugins/charts/js/Chart.js') }}"></script> --}}
    <!-- Datatables -->
    <script src="{{ asset('assets/plugins/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/js/buttons.bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/js/buttons.html5.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/plugins/datatables/js/buttons.print.min.js') }}"></script> --}}
    <script src="{{ asset('assets/plugins/datatables/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/js/responsive.bootstrap.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/plugins/datatables/js/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/js/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/js/vfs_fonts.js') }}"></script> --}}
    <script src="{{ asset('assets/js/advance_table_custom.js') }}"></script>

    <!-- Perfect Scrollbar JS -->
    <script src="{{ asset('assets/plugins/perfect-scrollbar/jquery-perfect-scrollbar.min.js') }}"></script>
    <!-- Vue JS -->
    {{-- <script src="{{ asset('assets/plugins/vue/vue.min.js') }}"></script> --}}
    <!-- Summernote JS -->
    {{-- <script src="{{ asset('assets/plugins/summernote/js/summernote.js') }}"></script>
    <script src="{{ asset('assets/plugins/summernote/js/custom-summernote.js') }}"></script> --}}
    <!-- Dashboard JS -->
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>
    <!-- Custom JS -->
    <script src="{{ asset('assets/js/seipkon.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- fonts JS -->
    {{-- <link rel="stylesheet" href="{{ asset('assets/fonts/js/all.min.js') }}"> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/js/all.min.js"
        integrity="sha512-2bMhOkE/ACz21dJT8zBOMgMecNxx0d37NND803ExktKiKdSzdwn+L7i9fdccw/3V06gM/DBWKbYmQvKMdAA9Nw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>

    <!-- Selectsearch -->
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>

    {{-- image preview --}}

    <script>
        /* When the user clicks on the button,
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                toggle between hiding and showing the dropdown content */
        function myFunction(id) {
            document.getElementById("myDropdown" + id).classList.toggle("show");
        }

        // Close the dropdown menu if the user clicks outside of it
        window.onclick = function(event) {
            if (!event.target.matches('.dropbtn')) {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                var i;
                for (i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }
        //image_url
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#image-preview').attr('src', e.target.result);
                    $('#image-preview').hide();
                    $('#image-preview').fadeIn(650);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#file-input").change(function() {
            readURL(this);
        });

        if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
            $(".dropdown-menu")


        }

        {{-- $(function() {
            $(".dropdown-menu").on('click', 'a', function() {
                $(this).parents('.dropdown').find('button').text($(this).text());
            });
        }); --}}

        $(document).ready(function() {

        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.0/dropzone.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.5.1/sweetalert2.all.min.js"></script>
    <script type="text/javascript">
        //paiement
        function paiement() {
            $('#submit_paiement').attr('disabled', 'disabled');
            $('.erreur').empty()
            var facture_id = $('#facture_id').val()
            var date = jQuery('#date').val()
            var montant = jQuery('#montant').val()
            var method = jQuery('#method').val()
            var note = jQuery('#note').val()
            var status_retenu = "desactive"


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            jQuery.ajax({
                url: "{{ url('/savepaiement') }}/" + facture_id,
                method: 'post',
                data: {
                    status_retenu: status_retenu,
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

        //deletecontact
        function deletecontact(id) {
            swal.fire({
                title: "Suppriméer?",
                icon: 'question',
                text: "Etes – vous sur que vous voulez supprimer le contact ?",
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
                        url: "{{ url('/deletecrmcontact') }}/" + id,
                        data: {
                            _token: CSRF_TOKEN
                        },
                        dataType: 'JSON',
                        success: function(results) {
                            Swal.fire({
                                position: 'top-center',
                                icon: 'success',
                                title: 'Le contact est supprimé avec succéss',
                                showConfirmButton: false,
                                timer: 1000
                            })

                            setTimeout(function() {
                                location.reload()

                            }, 1000);

                            // refresh page after 2 seconds

                        }
                    });

                } else {
                    e.dismiss;
                }

            }, function(dismiss) {
                return false;
            })
        }

        //deleteopportunite
        function deleteopportunite(id) {
            swal.fire({
                title: "Suppriméer?",
                icon: 'question',
                text: "Etes – vous sur que vous voulez supprimer cette oportunité ?",
                type: "warning",
                showCancelButton: !0,
                customClass: 'swal-wide',
                confirmButtonText: "Oui, Confirmer!",
                cancelButtonText: "Non, Annuler!",
                reverseButtons: !0
            }).then(function(e) {

                if (e.value === true) {
                    var CSRF_TOKEN = $('meta[²name="csrf-token"]').attr('content');

                    $.ajax({
                        type: 'get',
                        url: "{{ url('/deleteopportunite') }}/" + id,
                        data: {
                            _token: CSRF_TOKEN
                        },
                        dataType: 'JSON',
                        success: function(results) {
                            if (results == 200) {
                                Swal.fire({
                                    position: 'top-center',
                                    icon: 'success',
                                    title: 'L"oportunité est supprimé avec succéss',
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
        //deleteclient
        function deleteclient(id) {
            swal.fire({
                title: "Suppriméer?",
                icon: 'question',
                text: "Si vous supprimer le client , vous allez éliminer aussi , tous les  factures , , devis , et paiements en relation avec ce client. Etes – vous sur que vous voulez supprimer le client ?",
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
                        url: "{{ url('/deleteclient') }}/" + id,
                        data: {
                            _token: CSRF_TOKEN
                        },
                        dataType: 'JSON',
                        success: function(results) {
                            Swal.fire({
                                position: 'top-center',
                                icon: 'success',
                                title: 'Le client est supprimé avec succéss',
                                showConfirmButton: false,
                                timer: 1000
                            })

                            setTimeout(function() {
                                location.reload()

                            }, 1000);

                            // refresh page after 2 seconds

                        }
                    });

                } else {
                    e.dismiss;
                }

            }, function(dismiss) {
                return false;
            })
        }
        //deleteentreprise
        function deleteentreprise(id) {
            swal.fire({
                title: "Suppriméer?",
                icon: 'question',
                text: "Si vous supprimer l'entreprise , vous allez éliminer aussi , tous les  factures , , devis , et paiements en relation avec cette entreprise. Etes – vous sur que vous voulez supprimer l'entreprise ?",
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
                        url: "{{ url('/deleteentreprises') }}/" + id,
                        data: {
                            _token: CSRF_TOKEN
                        },
                        dataType: 'JSON',
                        success: function(results) {

                            Swal.fire({
                                position: 'top-center',
                                icon: 'success',
                                title: 'Entreprise supprimé avec succéss',
                                showConfirmButton: false,
                                timer: 1000
                            })

                            setTimeout(function() {
                                location.reload()

                            }, 1000);

                            // refresh page after 2 seconds

                        }
                    });

                } else {
                    e.dismiss;
                }

            }, function(dismiss) {
                return false;
            })
        }


        //deletefournisseur
        function deletefournisseur(id) {
            swal.fire({
                title: "Suppriméer?",
                icon: 'question',
                text: "Si vous supprimer le fournisseur , vous allez éliminer aussi tous les  produits en relation avec ce fournisseur. Etes – vous sur que vous voulez supprimer le fournisseur ?",
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
                        url: "{{ url('/deletefournisseur') }}/" + id,
                        data: {
                            _token: CSRF_TOKEN
                        },
                        dataType: 'JSON',
                        success: function(results) {



                            if (results == -1) {
                                Swal.fire({
                                    position: 'top-center',
                                    icon: 'error',
                                    title: "Il y'a des factures vous ne pouvez pas supprimé",
                                    showConfirmButton: true,
                                    timer: 3000
                                })
                                return false
                            } else if (results == 200) {
                                Swal.fire({
                                    position: 'top-center',
                                    icon: 'success',
                                    title: 'Fournisseur supprimé avec succéss',
                                    showConfirmButton: false,
                                    timer: 1000
                                })

                                setTimeout(function() {
                                    location.reload()

                                }, 1000);

                            }


                            // refresh page after 2 seconds

                        }
                    });

                } else {
                    e.dismiss;
                }

            }, function(dismiss) {
                return false;
            })
        }


        //deletedevis

        function deletedevis(id) {
            swal.fire({
                title: "Suppriméer?",
                icon: 'question',
                text: "êtes-vous sûrs,vous voulez supprimer le devis!",
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
                        url: "{{ url('/deletedevis') }}/" + id,
                        data: {
                            _token: CSRF_TOKEN
                        },
                        dataType: 'JSON',
                        success: function(results) {
                            Swal.fire({
                                position: 'top-center',
                                icon: 'success',
                                title: 'Devis supprimé avecc succéss',
                                showConfirmButton: false,
                                timer: 1000
                            })

                            setTimeout(function() {
                                location.reload()

                            }, 1000);

                            // refresh page after 2 seconds

                        }
                    });

                } else {
                    e.dismiss;
                }

            }, function(dismiss) {
                return false;
            })
        }

        //deletetaxe
        function deletetaxe(id) {
            swal.fire({
                title: "Suppriméer?",
                icon: 'question',
                text: "Etes–vous sur que vous voulez supprimer cette taxe?",
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
                        url: "{{ url('/deletetaxe') }}/" + id,
                        data: {
                            _token: CSRF_TOKEN
                        },
                        dataType: 'JSON',
                        success: function(results) {
                            Swal.fire({
                                position: 'top-center',
                                icon: 'success',
                                title: "la taxe est supprimé avecc succéss",
                                showConfirmButton: false,
                                timer: 1000
                            })
                            setTimeout(function() {
                                location.reload()

                            }, 1000);
                            // refresh page after 2 seconds

                        }
                    });

                } else {
                    e.dismiss;
                }

            }, function(dismiss) {
                return false;
            })
        }


        //deleteintervention
        function deleteintervention(id) {
            swal.fire({
                title: "Suppriméer?",
                icon: 'question',
                text: "Etes–vous sur que vous voulez supprimer cette intervention?",
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
                        url: "{{ url('/deleteintervention') }}/" + id,
                        data: {
                            _token: CSRF_TOKEN
                        },
                        dataType: 'JSON',
                        success: function(results) {
                            Swal.fire({
                                position: 'top-center',
                                icon: 'success',
                                title: "l'intervention est supprimé avecc succéss",
                                showConfirmButton: false,
                                timer: 1000
                            })
                            setTimeout(function() {
                                location.reload()

                            }, 1000);
                            // refresh page after 2 seconds

                        }
                    });

                } else {
                    e.dismiss;
                }

            }, function(dismiss) {
                return false;
            })
        }

        //deletefacture
        function deletefacture(id) {
            swal.fire({
                title: "Suppriméer?",
                icon: 'question',
                text: "Etes–vous sur que vous voulez supprimer cette facture?",
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
                        url: "{{ url('/deletefacture') }}/" + id,
                        data: {
                            _token: CSRF_TOKEN
                        },
                        dataType: 'JSON',
                        success: function(results) {
                            Swal.fire({
                                position: 'top-center',
                                icon: 'success',
                                title: "la facture est supprimé avecc succéss",
                                showConfirmButton: false,
                                timer: 1000
                            })
                            setTimeout(function() {
                                location.reload()

                            }, 1000);
                            // refresh page after 2 seconds

                        }
                    });

                } else {
                    e.dismiss;
                }

            }, function(dismiss) {
                return false;
            })
        }

        //deletepaiement

        function deletepaiement(id) {
            swal.fire({
                title: "Suppriméer?",
                icon: 'question',
                text: "êtes-vous sûrs,vous voulez supprimer cette paiement!",
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
                        url: "{{ url('/deletepaiement') }}/" + id,
                        data: {
                            _token: CSRF_TOKEN
                        },
                        dataType: 'JSON',
                        success: function(results) {
                            Swal.fire({
                                position: 'top-center',
                                icon: 'success',
                                title: 'Paiement supprimé avecc succéss',
                                showConfirmButton: false,
                                timer: 1000
                            })

                            setTimeout(function() {
                                location.reload()

                            }, 1000);

                            // refresh page after 2 seconds

                        }
                    });

                } else {
                    e.dismiss;
                }

            }, function(dismiss) {
                return false;
            })
        }

        //deleteuser
        function deleteuser(id) {
            swal.fire({
                title: "Suppriméer?",
                icon: 'question',
                text: "Etes–vous sur que vous voulez supprimer l'utilisateur?",
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
                        url: "{{ url('/deleteuser') }}/" + id,
                        data: {
                            _token: CSRF_TOKEN
                        },
                        dataType: 'JSON',
                        success: function(results) {
                            Swal.fire({
                                position: 'top-center',
                                icon: 'success',
                                title: "l'utilisateur est supprimé avecc succéss",
                                showConfirmButton: false,
                                timer: 1000
                            })
                            setTimeout(function() {
                                location.reload()

                            }, 1000);
                            // refresh page after 2 seconds

                        }
                    });

                } else {
                    e.dismiss;
                }

            }, function(dismiss) {
                return false;
            })
        }

        //deletecategorie
        function deletecategorie(id) {
            swal.fire({
                title: "Suppriméer?",
                icon: 'question',
                text: "Etes–vous sur que vous voulez supprimer cette catégorie?",
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
                        url: "{{ url('/deletecategorie') }}/" + id,
                        data: {
                            _token: CSRF_TOKEN
                        },
                        dataType: 'JSON',
                        success: function(results) {
                            if (results == -1) {
                                Swal.fire({
                                    position: 'top-center',
                                    icon: 'error',
                                    title: "Il y'a des clients dans cette catégorie ,vous ne pouvez pas supprimer",
                                    showConfirmButton: true,
                                })
                                return false
                            } else {
                                Swal.fire({
                                    position: 'top-center',
                                    icon: 'success',
                                    title: "La catégorie est supprimé avecc succéss",
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

        //deletecatalogue
        function deletecatalogue(id) {
            swal.fire({
                title: "Suppriméer?",
                icon: 'question',
                text: "Etes–vous sur que vous voulez supprimer ce produit?",
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
                        url: "{{ url('/deletecatalogue') }}/" + id,
                        data: {
                            _token: CSRF_TOKEN
                        },
                        dataType: 'JSON',
                        success: function(results) {

                            if (results.error) {
                                Swal.fire({
                                    position: 'top-center',
                                    icon: 'error',
                                    title: results.error,
                                    showConfirmButton: true,
                                })


                            } else {
                                Swal.fire({
                                    position: 'top-center',
                                    icon: 'success',
                                    title: "le produit est supprimé avecc succéss",
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

        //deleterole
        function deletedepense(id) {
            swal.fire({
                title: "Suppriméer?",
                icon: 'question',
                text: "Etes–vous sur que vous voulez supprimer depense?",
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
                        url: "{{ url('/deletedepense') }}/" + id,
                        data: {
                            _token: CSRF_TOKEN
                        },
                        dataType: 'JSON',
                        success: function(results) {

                            if (results == 200) {
                                Swal.fire({
                                    position: 'top-center',
                                    icon: 'success',
                                    title: "Depense supprimé avecc succéss",
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

        //deleteconge
        function deleteconge(id) {
            swal.fire({
                title: "Suppriméer?",
                icon: 'question',
                text: "Etes–vous sur que vous voulez supprimer le congé?",
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
                        url: "{{ url('/deleteconges') }}/" + id,
                        data: {
                            _token: CSRF_TOKEN
                        },
                        dataType: 'JSON',
                        success: function(results) {

                            if (results == 200) {
                                Swal.fire({
                                    position: 'top-center',
                                    icon: 'success',
                                    title: "Congé supprimé avecc succéss",
                                    showConfirmButton: false,
                                    timer: 1000
                                })
                                setTimeout(function() {
                                    location.reload()

                                }, 1000);

                            }

                            // refresh page after 2 seconds

                        }
                    });

                } else {
                    e.dismiss;
                }

            }, function(dismiss) {
                return false;
            })
        }

        //deleterole
        function deleterole(id) {
            swal.fire({
                title: "Suppriméer?",
                icon: 'question',
                text: "Etes–vous sur que vous voulez supprimer ce role?",
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
                        url: "{{ url('/deleterole') }}/" + id,
                        data: {
                            _token: CSRF_TOKEN
                        },
                        dataType: 'JSON',
                        success: function(results) {
                            if (results == -1) {
                                Swal.fire({
                                    position: 'top-center',
                                    icon: 'error',
                                    title: 'Ce role est effectué a un utilisateur ',
                                    showConfirmButton: true,
                                    timer: 3000
                                })
                                return false
                            } else if (results == 200) {
                                Swal.fire({
                                    position: 'top-center',
                                    icon: 'success',
                                    title: "le role est supprimé avecc succéss",
                                    showConfirmButton: false,
                                    timer: 1000
                                })
                                setTimeout(function() {
                                    location.reload()

                                }, 1000);

                            }

                            // refresh page after 2 seconds

                        }
                    });

                } else {
                    e.dismiss;
                }

            }, function(dismiss) {
                return false;
            })
        }

        //read_notifs
        function read_notifs() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            jQuery.ajax({
                url: "{{ url('/readnotif') }}",
                method: 'get',
                data: {

                    _token: "{{ csrf_token() }}",
                },
                success: function(result) {
                    console.log(result)
                    $('#js-count').empty()
                    $('#js-count').html('0')
                }
            });



        }

        //deletebonlivraison
        function deletebonlivraison(id) {
            swal.fire({
                title: "Suppriméer?",
                icon: 'question',
                text: "Etes–vous sur que vous voulez supprimer la bonne de livraison?",
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
                        url: "{{ url('/deletebonlivraisonsupdate') }}/" + id,
                        data: {
                            _token: CSRF_TOKEN
                        },
                        dataType: 'JSON',
                        success: function(results) {
                            if (results == 200) {
                                Swal.fire({
                                    position: 'top-center',
                                    icon: 'success',
                                    title: "Bon de livraison est supprimé avecc succéss",
                                    showConfirmButton: false,
                                    timer: 1000
                                })
                                setTimeout(function() {
                                    location.reload()

                                }, 1000);

                            }

                            // refresh page after 2 seconds

                        }
                    });

                } else {
                    e.dismiss;
                }

            }, function(dismiss) {
                return false;
            })
        }
        //deleteboncommande
        function deleteboncommande(id) {
            swal.fire({
                title: "Suppriméer?",
                icon: 'question',
                text: "Etes–vous sur que vous voulez supprimer la boncommande?",
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
                        url: "{{ url('/deleteboncommande') }}/" + id,
                        data: {
                            _token: CSRF_TOKEN
                        },
                        dataType: 'JSON',
                        success: function(results) {
                            if (results == 200) {
                                Swal.fire({
                                    position: 'top-center',
                                    icon: 'success',
                                    title: "Boncommande est supprimé avecc succéss",
                                    showConfirmButton: false,
                                    timer: 1000
                                })
                                setTimeout(function() {
                                    location.reload()

                                }, 1000);

                            }

                            // refresh page after 2 seconds

                        }
                    });

                } else {
                    e.dismiss;
                }

            }, function(dismiss) {
                return false;
            })



        }
        //deletedevise
        function deletedevise(id) {
            swal.fire({
                title: "Suppriméer?",
                icon: 'question',
                text: "Etes–vous sur que vous voulez supprimer cette devise?",
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
                        url: "{{ url('/deletedevise') }}/" + id,
                        data: {
                            _token: CSRF_TOKEN
                        },
                        dataType: 'JSON',
                        success: function(results) {
                            if (results == 200) {
                                Swal.fire({
                                    position: 'top-center',
                                    icon: 'success',
                                    title: "Devise est supprimé avecc succéss",
                                    showConfirmButton: false,
                                    timer: 1000
                                })
                                setTimeout(function() {
                                    location.reload()

                                }, 1000);

                            }

                            // refresh page after 2 seconds

                        }
                    });

                } else {
                    e.dismiss;
                }

            }, function(dismiss) {
                return false;
            })
        }


        //deleterole
        function deletegroupe(id) {
            swal.fire({
                title: "Suppriméer?",
                icon: 'question',
                text: "Etes–vous sur que vous voulez supprimer cette groupe?",
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
                        url: "{{ url('/deletegroupe') }}/" + id,
                        data: {
                            _token: CSRF_TOKEN
                        },
                        dataType: 'JSON',
                        success: function(results) {
                            if (results == -1) {
                                Swal.fire({
                                    position: 'top-center',
                                    icon: 'error',
                                    title: 'Groupe déja affecté ',
                                    showConfirmButton: true,
                                    timer: 3000
                                })
                                return false
                            } else if (results == 200) {
                                Swal.fire({
                                    position: 'top-center',
                                    icon: 'success',
                                    title: "Groupe est supprimé avecc succéss",
                                    showConfirmButton: false,
                                    timer: 1000
                                })
                                setTimeout(function() {
                                    location.reload()

                                }, 1000);

                            }

                            // refresh page after 2 seconds

                        }
                    });

                } else {
                    e.dismiss;
                }

            }, function(dismiss) {
                return false;
            })
        }

        //delete_event
        function delete_event(id) {
            $('.close').click()
            swal.fire({
                title: "Suppriméer?",
                icon: 'question',
                text: "Etes–vous sur que vous voulez supprimer cette réunion?",
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
                        url: "{{ url('/deletevent') }}/" + id,
                        data: {
                            _token: CSRF_TOKEN
                        },
                        dataType: 'JSON',
                        success: function(results) {
                            if (results == 200) {
                                Swal.fire({
                                    position: 'top-center',
                                    icon: 'success',
                                    title: "Reunion est supprimé avecc succéss",
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
        //deletecontrat
        function deletecontrat(id) {
            $('.close').click()
            swal.fire({
                title: "Suppriméer?",
                icon: 'question',
                text: "Etes–vous sur que vous voulez supprimer le contrat?",
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
                        url: "{{ url('/deletecontrat') }}/" + id,
                        data: {
                            _token: CSRF_TOKEN
                        },
                        dataType: 'JSON',
                        success: function(results) {
                            if (results == 200) {
                                Swal.fire({
                                    position: 'top-center',
                                    icon: 'success',
                                    title: "Contrat est supprimé avecc succéss",
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

        function change_status(status, id) {

            swal.fire({
                title: status + " ?",
                icon: 'question',
                text: "Etes–vous sur que vous voulez " + status + " le congé?",
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
                        url: "{{ url('/changestatus') }}",
                        method: 'post',
                        data: {
                            status: status,
                            id: id,
                            _token: "{{ csrf_token() }}",
                        },
                        success: function(result) {
                            Swal.fire({
                                position: 'top-center',
                                icon: 'success',
                                title: 'Congé ' + status + ' avec succéss',
                                showConfirmButton: false,
                                timer: 1000
                            })
                            setTimeout(function() {
                                location.reload(true);
                            }, 1000);


                        },
                        error: function(erreur) {

                        }
                    });

                } else {
                    e.dismiss;
                }

            }, function(dismiss) {
                return false;
            })

        }
        //smartsearchselect
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"
        integrity="sha512-rMGGF4wg1R73ehtnxXBt5mbUfN9JUJwbk21KMlnLZDJh7BkPmeovBuddZCENJddHYYMkCh9hPFnPmS9sspki8g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/selectric@1.13.0/public/jquery.selectric.min.js"></script>


    <script>
        $(document).ready(function() {

            $('select:not(.opp-class)').select2({
                placeholder: 'Selectionner'
            }).on("select2:select", function(evt) {
                var id = evt.params.data.id;

                var element = $(this).children("option[value=" + id + "]");

                moveElementToEndOfParent(element);

                $(this).trigger("change");
            });

            var ele = $("select").parent().find("ul.select2-selection__rendered");
            ele.sortable({
                containment: 'parent',
                update: function() {
                    orderSortedValues();
                    console.log("" + $("select").val())
                }
            });

            // Read selected option

        });
        orderSortedValues = function() {
            var value = ''
            $("#example").parent().find("ul.select2-selection__rendered").children("li[title]").each(function(i, obj) {

                var element = $("#example").children('option').filter(function() {
                    return $(this).html() == obj.title
                });
                moveElementToEndOfParent(element)
            });
        };

        moveElementToEndOfParent = function(element) {
            var parent = element.parent();

            element.detach();

            parent.append(element);
        };
    </script>


    @yield('scripts')

</body>


</html>
