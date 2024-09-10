function onLoad(event) {
    var input = event.target;
    var file = input.files[0];
    var reader = new FileReader();

    reader.onload = function (e) {
        document.getElementById('profileImage').src = e.target.result;
    };

    if (file) {
        reader.readAsDataURL(file);
    }
};
