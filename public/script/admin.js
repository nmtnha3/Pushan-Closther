function previewImageProduct(event) {
    var input = event.target;
    var reader = new FileReader();

    reader.onload = function () {
        var preview = document.getElementById('imageProduct-preview');
        preview.src = reader.result;
    };

    if (input.files && input.files[0]) {
        reader.readAsDataURL(input.files[0]);
    }
}

function previewAvatarSlide(event) {
    const input = event.target;
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function (e) {
            const imageSlide = document.getElementById("AvatarSlide");
            imageSlide.src = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
    }
}

document.getElementById('imageSlide').addEventListener('change', function(event) {
    previewAvatarSlide(event);
});


function previewAvatarPost(event) {
    const input = event.target;
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function (e) {
            const imageSlide = document.getElementById("AvatarPost");
            imageSlide.src = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
    }
}

