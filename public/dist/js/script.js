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



/* $(function () {
    var availableTags = [
        "Jean-Luc",
        "Barthelemy",
        "Haikouhi",
        "Caroline",
        "Sebastien",
        "Safik",
        "Eric",
        "Cédric",
        "David",
        "Thomas",
        "Nadine",
        "Olivier"
    ];
    $("#tags").autocomplete({
        source: availableTags
    });
});

$.ui.autocomplete.filter = function (array, term) {
    var matcher = new RegExp("^" + $.ui.autocomplete.escapeRegex(term), "i");
    return $.grep(array, function (value) {
        return matcher.test(value.label || value.value || value);
    });
}; */

// fonction voir son mot de passe
function viewPW() {
    var a = document.getElementById('inputPassword');
    if (a.type === 'password') {
        a.type = 'text';
    } else {
        a.type = 'password';
    }
}
// pour le tableau du dashboard
google.charts.load('current', {'packages':['corechart']});
 google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Maries', 'Hours per Day'],
          ['Commerces',          11],
          ['Industriels',         2],
          ['Lorem 846',  2],
          ['Lorem 59', 2],
          ['Lorem 1',    7]
        ]);

        var options = {
          titre: 'Répartition des contacts'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }


