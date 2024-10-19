let map = L.map('map', {
    gestureHandling: true
});

// Referencia de inputs
let latitud = $('#latitud');
let longitud = $('#longitud');

// Referencia de textos
let latitud_text = $('#latitud_text');
let longitud_text = $('#longitud_text');

// Referencia de la posicion capturada desde el mapa
let position = {};

// Inicio del mapa
initMap(map);

// Iniciamos el evento para capturar el doble click en el mapa
markerMap(map, position);

// Permiten la actualizacion de inputs y span del html
initInputLatLng(latitud, longitud);
initTextLatLng(latitud_text, longitud_text);

// si ya existe una ubicacion en los inputs, se pinta en el mapa
if(latitud.val() && longitud.val()) {
    var positionAux = {
        lat: latitud.val(),
        lng: longitud.val()
    };

    setMarkerMap(map, positionAux);
}