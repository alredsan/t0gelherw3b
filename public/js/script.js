console.log("hola");

var x = document.getElementById("localidad");
var botton = document.getElementById('botonGPS');

botton.addEventListener('click', function () {
    getLocation();
});

function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    }
}

function showPosition(position) {
    // localidad.value =
    // position.coords.latitude;
    // position.coords.longitude;
}
