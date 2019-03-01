
/* Menu */

$('#menu').on('click', function () {
    $('.menucontent').slideToggle(1000);
    $('#menu').toggleClass('open');
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