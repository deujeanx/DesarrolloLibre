const origenFiltro = document.getElementById('originFilter');
const destinoFiltro = document.getElementById('destinyFilter');

$(document).ready(function() {
    $(origenFiltro).select2();
});

$(document).ready(function() {
    $(destinoFiltro).select2();
});