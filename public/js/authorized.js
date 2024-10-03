document.addEventListener('DOMContentLoaded', function () {
    var dni = document.getElementById('owner');
    var lot = document.getElementById('lot');

    dni.addEventListener('change', function () {
        var selectedOption = dni.options[dni.selectedIndex];
        lot.value = selectedOption.getAttribute('data-lot');
    });
})
