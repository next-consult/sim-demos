function test_number(number, test) {

    if (!isNaN(number) && parseFloat(number) >= parseFloat(test)) {
        return true
    } else {
        return false
    }


}

function save_facture() {
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



    if ($('#ordre_table tr').length <= 1) {
        test = false
        title_var = "La facture est vide"

    } else {
        title_var = "Il faut remplir tous les champs correctement"

    }




    var ids = $("input[name='id[]']")
        .map(function() {

            if (!$(this).val()) {
                test = false

            }

            return $(this).val();
        }).get();


    var all_remises = []

    for (var i = 0; i < ids.length; i++) {

        var remises = $("#type_remise-" + ids[i] + " option:selected").val()

        all_remises.push(remises)
    }



    var descriptions = $("input[name='description[]']")
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
    var tva = $("input[name='tva[]']")
        .map(function() {
            if (!$(this).val()) {
                test = false
                $(obligatoire).insertAfter(this);

            } else if (!test_number($(this).val(), 1)) {
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
        var items = []

        for (let i = 0; i < descriptions.length; i++) {
            var total_tva = 0
            var total_ttc = 0
            var remise_valeur = 0
            total_ht = parseFloat(prix_ht[i])


            total_tva = (parseFloat(prix_ht[i]) * (parseFloat(tva[i]) / 100))

            var total_remise = 0


            if (remise[i] != null) {


                remise_valeur = remise[i];
                if (all_remises[i] == 'pourcentage') {
                    total_remise = parseFloat(total_ht) * (parseFloat(remise_valeur) / 100)

                } else if (all_remises[i] == 'montant') {
                    total_remise = remise_valeur

                }


            }

            total_ttc = (parseFloat(total_ht) + parseFloat(total_tva)) - total_remise


            items.push({
                'id': ids[i],
                'description': descriptions[i],
                'prix_ht': prix_ht[i],
                'tva': tva[i],
                'remise': remise_valeur,
                'type_remise': all_remises[i],
                'total_remise': total_remise,
                'total_tva': total_tva,
                'total_ttc': total_ttc,
            })

        }

        var itemsJson = JSON.stringify(items);
        console.log(itemsJson)
        

    }





}



















function save() {



    $('.erreur').empty()

    var selected = $('#ordre_select').val()
    var test = true

    {{-- if (selected.length == 0) {
        test = false
        $('.select-obligatoire').html('Ce champ est obligatoire');
    } --}}

    var ordresJson = JSON.stringify(selected);

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });

    jQuery.ajax({
        url: "{{ url('/get_ordres') }}",
        method: 'post',
        data: {
            ordres: ordresJson,
            _token: "{{ csrf_token() }}",
        },
        success: function(result) {
            var array_id = []
            array_id = $("input[name='id[]']")
                .map(function() {

                    return $(this).val();
                }).get();





            var rowCount = $('#ordre_table tr').length;
            var ordres = []
            ordres = result.ordres

            for (let ordre of ordres) {



                //delete null
                if (ordre.items.description == null) {
                    ordre.items.description = ''
                }
                if (ordre.items.prix_ht == null) {
                    ordre.items.prix_ht = ''
                }
                if (ordre.items.tva == null) {
                    ordre.items.tva = ''
                }
                if (ordre.items.remise == null) {
                    ordre.items.remise = ''
                }
                if (ordre.items.prix_ht == null) {
                    ordre.items.prix_ht = ''
                }
                if (ordre.items.total_tva == null) {
                    ordre.items.total_tva = ''
                }
                if (ordre.items.total_ttc == null) {
                    ordre.items.total_ttc = ''
                }
                //

                if (array_id.includes(ordre.id.toString()) == false) {
                    var name_remise = "type_remise-" + ordre.id
                    $('#ordre_table tr:last').after(
                        "<tr id='" + ordre.id +
                        "'><td><input type='hidden'name='id[]' required value='" + ordre.id +
                        "'/>" +
                        ordre.numero + "</td>" +
                        "<td><input class='form-control' name='description[]' required value='" +
                        ordre.items.description + "'/></td>" +
                        "<td><input class='form-control' name='prix_ht[]' type='number' required value='" +
                        ordre
                        .items.prix_ht + "'/></td>" +
                        "<td><input class='form-control' name='tva[]' type='number' required value='" +
                        ordre
                        .items.tva + "'/></td>" +
                        "<td> <div class='row justify-content-start'> <div class='col-md-6'><input type='number' class='form-control' value='" +
                        ordre.items.remise +
                        "' name='remise[]' required style='width:70px'></div><div class='col-md-6'><select class='form-select none' style='margin-top:5px' id=" +
                        name_remise +
                        "><option value='pourcentage'> <span style='font-size:10px'>%</span></option><option value='montant'><span style='font-size:10px'>TND </span></option></select></div></div></td>" +
                        "<td>" + ordre.items.prix_ht + "</td>" +
                        "<td>" + ordre.items.total_tva + "</td>" +
                        "<td>" + ordre.items.total_ttc + "</td>" +
                        "<td><a class='btn btn_mobile' onclick ='delete_operation($(this))'>X</a></td>" +
                        "</tr>"
                    )
                }



            }

            array_id = $("input[name='id[]']")
                .map(function() {

                    return $(this).val();
                }).get();




            for (var i = 0; i < array_id.length; i++) {
                if (selected.includes(array_id[i].toString()) == false) {
                    $('table#ordre_table tr#' + array_id[i]).remove();
                    array_id.splice(i, 1);
                    i--;

                }

            }


        }
    });


}

function delete_operation(row) {
    {{-- row.closest('tr').remove(); --}}
    var trid = row.closest('tr').attr('id');
    row.closest('tr').remove();
    array_id = $("input[name='id[]']")
        .map(function() {

            return $(this).val();
        }).get();


    var selected = $('#ordre_select').val()

    for (id of selected) {

        if (array_id.includes(id.toString()) == false) {

            $("#ordre_select option[value=" + id + "]").prop('selected', false);


        }


    }
    $('#ordre_select').change()
}



//frais
function delete_frais(row) {
    row.closest('tr').remove();
}


//deletefrais

function add_frais() {
    $('#frais_table  tbody:last').after("<tr> " +
        "<td style='width:90%'><br>" +
        "<input type='text' class='form-control' placeholder='Nom du frais' name='titre[]'>" +
        "<input type='number' class='form-control' name='montant[]' placeholder='Montant'" +
        " style='margin-top:5px'>" +
        " </td>" +
        "<td>" +
        "<a class='btn btn-danger ' style='float:right;margin-left:5px' onclick=delete_frais($(this))><span style='font-size:12px'>Annuler</span></a>" +
        "</td>" +
        " </tr>")
}






$(document).ready(function() {




    {{-- $('#adddevis').submit(function(e) {
        $('#submit_devis').attr('disabled','disabled');
        $('#date_erreur').empty()
        var date = jQuery('#date_devis').val()
        var client_id = jQuery('#client_id').val()
        var entreprise_id = jQuery('#entreprise_id').val()

        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        jQuery.ajax({
            url: "{{ url('/adddevis') }}",
            method: 'post',
            data: {
                date: date,
                client_id: client_id,
                entreprise_id: entreprise_id,
                _token: "{{ csrf_token() }}",
            },
            success: function(result) {
                if (result.errors) {
                    $('#submit_devis').removeAttr('disabled');
                    $('#date_erreur').html(result.errors[0])
                } else if (result.success_id) {
            
                                              
          window.location.href = `editdevis/${result.success_id}`;



                }

            }
        });



    }); --}}
});