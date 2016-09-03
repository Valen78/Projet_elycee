(function($){
    $(function(){
        //call function scroll to top
        $.scrollUp();

        //clear alert messages after 3 secondes
        $('.alert').delay(3000).fadeOut(500);

        //update arrow icon in admin part
        $('a[role="button"]').on('click', function(){
           var arrow = $(this).find('i');
            if(arrow.hasClass('fa-caret-square-o-down'))
                arrow.removeClass('fa-caret-square-o-down').addClass('fa-caret-square-o-up');
            else
                arrow.removeClass('fa-caret-square-o-up').addClass('fa-caret-square-o-down');
        });

        //order table #posts
        $.fn.dataTable.moment('DD/MM/YYYY');

        //order table fiches and posts
        $('.tableData').DataTable({
            pageLength: 20,
            lengthChange: false,
            searching: false,
            info: false,
            columnDefs: [
                { orderable: false, targets: 0 }
            ],
            order: [],
            language: {
                processing:     "Traitement en cours...",
                search:         "Rechercher&nbsp;:",
                lengthMenu:     "Afficher _MENU_ &eacute;l&eacute;ments",
                info:           "Affichage de l'&eacute;lement _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
                infoEmpty:      "Affichage de l'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
                infoFiltered:   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
                infoPostFix:    "",
                loadingRecords: "Chargement en cours...",
                zeroRecords:    "Aucun &eacute;l&eacute;ment &agrave; afficher",
                emptyTable:     "Aucune donnée disponible dans le tableau",
                paginate: {
                    first:      "Premier",
                    previous:   "Pr&eacute;c&eacute;dent",
                    next:       "Suivant",
                    last:       "Dernier"
                },
                aria: {
                    sortAscending:  ": activer pour trier la colonne par ordre croissant",
                    sortDescending: ": activer pour trier la colonne par ordre décroissant"
                }
            }
        });

        //configuration of ckeditor for specified textarea
        $('.textarea-editor').ckeditor({
            customConfig: 'custom-config.js'
        });

        /************************************************
            handle part for action group in admin part
         ************************************************/
        url = $(location).attr('pathname');
        ids = [];
        option = '';

        //check all the checkbox and store all ids
        $('#checkAll').on('click', function(){
            var $checks = $('.all').find('input:checkbox');

            if($(this).prop('checked'))
            {
                $checks.prop('checked',true);

                $('.all input:checked').each(function(){
                    ids.push($(this).val()) ;
                });
            }
            else
            {
                $checks.removeAttr('checked');
                ids = [];
            }
        });

        //store id when one checkbox is checked
        $('.checkId').on('click', function(){
            if($(this).prop('checked'))
                ids.push($(this).val());
            else if($.inArray($(this), ids))
                delete ids[ids.indexOf($(this).val())];
        });

        //store option when select an action
        $('#status').on('change', function() {
            $('#error').remove();

            option = $('#status option:selected').val();

            if(ids == '')
                $('#action').prepend('<div id="error" class="alert alert-danger text-center text-uppercase"><p>Pensez à choisir au moins une ligne !</p></div>');
        });

        //submit form action redirect action
        $('#action').on('submit', function(e){
            $('#error').remove();

            if(ids == '')
            {
                e.preventDefault();
                $(this).prepend('<div id="error" class="alert alert-danger text-center text-uppercase"><p>Merci de choisir au moins une ligne !</p></div>');
            }
            else
            {
                if(option === 'publish' || option === 'unpublish')
                    $(this).attr('action',url + '/status/' + ids);
                else if(option === 'delete')
                {
                    e.preventDefault();
                    $('#delete').modal('show');
                }
                else
                {
                    e.preventDefault();
                    $(this).prepend('<div id="error" class="alert alert-danger text-center text-uppercase"><p>Merci de choisir une action !</p></div>');
                }
            }
        });

        //redirect action for modal confirm delete
        $('#delete').on('shown.bs.modal',function(){
            $(this).find('form').attr('action',url + '/' + ids);
        });
        /***********************************************/

        /*******************************************
            initialize and display the google map
         *******************************************/
        var lat = Math.round($('#lat').val()*100)/100;
        var lng = Math.round($('#lng').val()*100)/100;

        if(!isNaN(lat) && !isNaN(lng))
        {
            console.log(lat);
            var myLatLng = {
                lat: lat,
                lng: lng
            };

            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 15,
                center: myLatLng
            });

            var marker = new google.maps.Marker({
                position: myLatLng,
                map: map,
                title: 'Lycée Ardéchois'
            });
        }
        /******************************************/
    });
})(jQuery);