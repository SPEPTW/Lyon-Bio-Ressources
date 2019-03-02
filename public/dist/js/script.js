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
function viewPW() {
    var a = document.getElementById('inputPassword');
    if (a.type === 'password') {
        a.type = 'text';
    } else {
        a.type = 'password';
    }
}
// pour le tableau du dashboard
function tabledash() {
var ctx = document.getElementById("myChart").getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
        datasets: [{
            label: '# of Votes',
            data: [12, 19, 3, 5, 2, 3],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
}
};