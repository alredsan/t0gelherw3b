
let formParticipation = document.forms.addVolunteer;
let divMessage = document.getElementById('message');

formParticipation.addEventListener('submit', function (event) {
    let src = this.action;

    console.log(src);
    event.preventDefault();
    event.stopPropagation();

    try {
        fetch(src, {
            method: 'GET'
        })
            .then(result => result.json())
            .then(function (data) {
                divMessage.innerHTML = '';

                divMessage.innerHTML = '<div class="alert alert-success">' + data.message + '</div>';
                console.log(data);
            })
            .catch(function () {
                divMessage.innerHTML = '';

                divMessage.innerHTML = '<div class="alert alert-danger">No se ha podido realizar la peticion</div>';
            })
    } catch (Excepcion) {

    }

});
