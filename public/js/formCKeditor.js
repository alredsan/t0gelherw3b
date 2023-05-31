let element = document.querySelector('#editor');

if (element != null) {
    ClassicEditor.create(element, {
        mediaEmbed: {
            previewsInData: true
        }
    })
        .then(editor => {
            let uploadButton = document.querySelector('.ck-file-dialog-button');

            if (uploadButton) {
                uploadButton.style.display = 'none';
            }

        })
        .catch(error => {

        });

}


let inputFile = document.getElementById('FotoLogoSelec');
let photoPreview = document.getElementById('FotoPreview');

if (photoPreview) {
    inputFile.addEventListener('change', function (event) {
        let fileImagen = event.target.files[0];
        if (fileImagen && checkFileExtension(fileImagen, ['jpg', 'png', 'gif'])) photoPreview.src = URL.createObjectURL(fileImagen);
    });
}


