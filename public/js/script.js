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

    function showPosition(position) {
        lat.value = position.coords.latitude;
        lon.value = position.coords.longitude;

        let prueba = new XMLHttpRequest();

        prueba.onload = function (data) {
            let result = JSON.parse(data.target.response);

            if(result.address.city){
                inputLocalidad.value = result.address.city;

            }else{
                inputLocalidad.value = result.address.town;
            }
        }

        prueba.open('get', "https://nominatim.openstreetmap.org/reverse?lat=" + position.coords.latitude + "&lon=" + position.coords.longitude + "&format=json");
        prueba.send();
    }



    // let formGeoCoder = $('#fGeocoder');
    let inputGeoCoder = $('#localidad');
    let addresses = $('#geocoderAddresses');
    let lanzado = false;

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


    function geoCode() {
        // let formGeoC = $(this);

        $.get('https://nominatim.openstreetmap.org/search?format=json&limit=3&q=' + inputGeoCoder.val()).then(
            // $.get(this.action + '?format=json&limit=3&' + formGeoC.serialize()).then(
            function (data) {

                let list = $('<div class="list-group position-absolute"></div>');

                data.forEach((address) => {
                    list.append(`<a href="#" data-lat="${address.lat}" data-lon="${address.lon}" class="list-group-item list-group-item-action">
                    ${address.display_name}</a>`);

                });
                addresses.empty();
                addresses.append(list);
                list.find('a').click(function (event) {

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

    botonMoreFilters.addEventListener('click',function(){

        if(divMoreFilters.style.display == 'none'){
            divMoreFilters.style.display = 'flex';
        }else{
            divMoreFilters.style.display = 'none';
        }

    })

});


// const preferedColor = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';

// console.log(preferedColor);

// const button = document.getElementById('changeColor');

// const setTheme = (theme) => {
//     document.documentElement.setAttribute('data-theme',theme);
//     localStorage.setItem('theme',theme);
// }

// button.addEventListener('click',function(){
//     let buttonSelect = localStorage.getItem('theme') === 'dark' ? 'light' : 'dark';

//     setTheme(buttonSelect);
// });

// setTheme(localStorage.getItem('theme') || preferedColor);
