function deleteUser(id, event) {
    const form = document.getElementById('delete-form' + id);
    const confirmation = confirm("¿Estás seguro de que quieres eliminar a este usuario?");
    console.log(confirmation);

    if (confirmation === true) {
        form.submit();
    }
}



