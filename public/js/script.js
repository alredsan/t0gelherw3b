
/**
 * LOCALIZACIÓN
 */

window.addEventListener('DOMContentLoaded', function () {

    var x = document.getElementById("bGeo");

    var lat = document.getElementById("lat");
    var lon = document.getElementById("lon");

    var inputLocalidad = document.getElementById('localidad');

    x.addEventListener('click', getLocation);

    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            x.innerHTML = "GeoLocation no es compatible en este navegador, lo siento.";
        }
    }

    /**
     * Dado un latitud y longitud, hacer una consulta para obtener el nombre de la ciudad
     * @param {*} position
     */
    function showPosition(position) {
        lat.value = position.coords.latitude;
        lon.value = position.coords.longitude;

        let prueba = new XMLHttpRequest();

        prueba.onload = function (data) {
            let result = JSON.parse(data.target.response);

            if (result.address.city) {
                inputLocalidad.value = result.address.city;

            } else {
                inputLocalidad.value = result.address.town;
            }
        }

        prueba.open('get', "https://nominatim.openstreetmap.org/reverse?lat=" + position.coords.latitude + "&lon=" + position.coords.longitude + "&format=json");
        prueba.send();
    }


    let inputGeoCoder = $('#localidad');
    let addresses = $('#geocoderAddresses');
    let lanzado = false;
    /**
     * Para tecla se habilita tiempo de espera, para respectar la normativa de la API nominatim
     */
    inputGeoCoder.keydown(function (event) {

        if (!lanzado) {

            lanzado = true;
            setTimeout(function () {
                //Volver a hablitar
                lanzado = false;
                geoCode();
            }, 3000);
        }
    });

    /**
     * Metodo donde muestra el listado de la localicaciones según la busqueda
     */
    function geoCode() {

        $.get('https://nominatim.openstreetmap.org/search?format=json&limit=3&q=' + inputGeoCoder.val()).then(
            function (data) {

                let list = $('<div class="list-group position-absolute"></div>');

                data.forEach((address) => {
                    list.append(`<a href="#" data-lat="${address.lat}" data-lon="${address.lon}" class="list-group-item list-group-item-action">
                    ${address.display_name}</a>`);

                });
                addresses.empty();
                addresses.append(list);
                list.find('a').click(function (event) {
                    //Accion cuando pulse un elemento de la lista
                    inputGeoCoder.val($(this).text().trim());

                    lat.value = $(this).data().lat;
                    lon.value = $(this).data().lon;
                    addresses.empty();
                });

            },
            function (error) {
                addresses.empty();
                addresses.append(`<div class="text-danger">
                <i class="fas fa-exclamation-circle"></i>
                No se ha podido establecer la conexión con el servidor de mapas.
            </div>`);
            }
        );
    };


    let botonMoreFilters = document.getElementById('btnMoreFilters');
    let divMoreFilters = document.getElementById('divMoreFilters');

    divMoreFilters.style.display = 'none';

    botonMoreFilters.addEventListener('click', function () {

        if (divMoreFilters.style.display == 'none') {
            divMoreFilters.style.display = 'flex';
        } else {
            divMoreFilters.style.display = 'none';
        }

    })

});
