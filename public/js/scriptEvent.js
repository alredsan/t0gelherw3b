
let formParticipation = document.forms.addVolunteer;
let divMessage = document.getElementById('message');
let numParticipante = document.getElementById("numParticipantesRest");
if (formParticipation) {
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

                    if(data.status == "error"){
                        divMessage.innerHTML = '<div class="alert alert-danger">' + data.message + '</div>';
                    }else{
                        divMessage.innerHTML = '<div class="alert alert-success">' + data.message + '</div>';
                        numParticipante.innerText = data.newNum;
                    }

                })
                .catch(function () {
                    divMessage.innerHTML = '';

                    divMessage.innerHTML = '<div class="alert alert-danger">No se ha podido realizar la peticion</div>';
                })
        } catch (Excepcion) {

        }

    });
}

let tables = $('table');

tables.addClass('table table-bordered table-hover');

tables.wrap("<div class='table-responsive'>");
