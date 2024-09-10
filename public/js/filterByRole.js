function filterByRole() {
    var filter = document.getElementById("filter");
    console.log(filter.value);
    window.location.href = `/estancias/manage-users?f=${filter.value}`;
}
