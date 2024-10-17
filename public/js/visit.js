document.addEventListener('DOMContentLoaded', function () {
    var day = document.getElementById('day');
    var since = document.getElementById('since');
    var until = document.getElementById('until');
    var sinceDiv = document.getElementById('since-div');
    var untilDiv = document.getElementById('until-div');

    function getTodayDate() {
        const today = new Date();
        console.log(today);
        const year = today.getFullYear();
        const month = String(today.getMonth() + 1).padStart(2, '0'); // +1 porque los meses comienzan en 0
        const day = String(today.getDate()).padStart(2, '0');
        return `${year}-${month}-${day}`;
    }

    day.addEventListener('change', function () {
        var selectedOption = day.options[day.selectedIndex];
        if (selectedOption.value == 1) {
            since.setAttribute('requited', 'required');
            until.setAttribute('requited', 'required');
            sinceDiv.style.display = 'block';
            untilDiv.style.display = 'block';
        } else {
            since.removeAttribute('requited');
            until.removeAttribute('requited');
            sinceDiv.style.display = 'none';
            untilDiv.style.display = 'none';
            since.value = getTodayDate();
            until.value = getTodayDate();
        }
    });
})
