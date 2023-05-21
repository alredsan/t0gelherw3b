let element = document.querySelector('#editor');

if (element != null) {
    ClassicEditor.create(element,{
        mediaEmbed: {
            previewsInData:true
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
