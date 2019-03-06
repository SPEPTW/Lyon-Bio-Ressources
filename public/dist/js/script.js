/* Menu */

$('#menu').on('click', function () {
    $('.menucontent').slideToggle(1000);
    $('#menu').toggleClass('open');
});


/* Data Table */

$(document).ready(function () {
    $('#tablecontact').DataTable({
        'order': [
            [1, 'asc']
        ]
    });
    $('#tablecategorie').DataTable({
        'order': [
            [1, 'asc']
        ]
    });

    $('#tableorganisation').DataTable({
        'order': [
            [1, 'asc']
        ]
    });

    $('#tableevenement').DataTable({
        'order': [
            [1, 'asc']
        ]
    });

    
    $('#evenement_note').summernote();
    
});