const defaultPoint = [-24.7892, -65.4106];

let pin_location = L.icon({
    iconUrl: "/css/leaflet/images/pin.png",
    iconSize: [35, 35],
    iconArchor: [17,36]
});

let marker = L.marker([0,0], { icon: pin_location });
let markerInMap = false;

// Referencia de Inputs
let lat = null;
let lng = null;

// Referencia de Textos
let lat_text = null;
let lng_text = null;

let routingControl = null;

let customControl =  L.Control.extend({  

    options: {
        position: 'topleft'
    },

    onAdd: function (map) {

        var container = L.DomUtil.create('input');
        container.type = "button";

        container.style.backgroundColor = 'white'; 
        container.style.backgroundImage = 'url("/css/leaflet/images/salta_icon.png")';
        container.style.backgroundSize = "25px 25px";
        container.style.width = '30px';
        container.style.height = '30px';

        container.onclick = function() {
            flyToDefaultView(map);
        }

        /* container.onmouseover = function(){
            container.style.backgroundColor = '#1A2B57'; 
        } */

        /* container.onmouseout = function(){
            container.style.backgroundColor = 'white'; 
        } */

        return container;
    }
});

function initMap(map) {
    setViewMap(map);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
        maxZoom: 19
    }).addTo(map);
    
    map.doubleClickZoom.disable();
    map.setMinZoom(8);

    customControlMap(map);
}

function initRouting(map, positionStart, positionEnd) {
    routingControl =  L.Routing.control({
        waypoints: [
          L.latLng(positionStart.lat, positionStart.lng),
          L.latLng(positionEnd.lat, positionEnd.lng)
        ],
        language: 'es',
        draggableWaypoints: false,
        routeWhileDragging: false,
        createMarker: function() { return null; }
    }).addTo(map);
}

function removeRouting(map) {
    map.eachLayer((layer) => {
        if (layer instanceof L.Marker) {
            layer.remove();
        }
    });

    if(routingControl) map.removeControl(routingControl);
}

function initGroupMarker(map, lista) {

    var grupos = L.markerClusterGroup({ 
        iconCreateFunction: function (cluster) { 
            var markers = cluster.getAllChildMarkers(); 
            return L.divIcon({ 
                html: markers.length, 
                className: 'mycluster', 
                iconSize: L.point(40, 40)
            }); 
        } 
    });

    for(var i = 0; i < lista.length; i++) {
        var marker = L.marker([
            lista[i].envio_venta.latitud, 
            lista[i].envio_venta.longitud
        ], { icon: pin_location });
        
        var estado_venta = 'ENVIADO';

        if(lista[i].estado == '1') estado_venta = 'PAGADO';
        else if(lista[i].estado == '2') estado_venta = 'EN PREPARACION';

        var info = `<b>Venta N° ${ lista[i].id }</b> <br>
                    Abonó: $ ${ lista[i].total} <br>
                    Estado: ${ estado_venta } <br>
                    Cliente: ${ lista[i].envio_venta.name } <br>
                    Domicilio: ${ lista[i].envio_venta.domicilio } <br>
                    Telefono: ${ lista[i].envio_venta.telefono } <br>
        `;

        marker.bindPopup(info);
        grupos.addLayer(marker);
    }

    map.addLayer(grupos);
}

function initInputLatLng(inplat, inplng) {
    lat = inplat;
    lng = inplng;
}

function initTextLatLng(textlat, textlng) {
    lat_text = textlat;
    lng_text = textlng;
}

function setViewMap(map) {
    map.setView(defaultPoint, 12);
}

function customControlMap(map) {
    map.addControl(new customControl());
}

function flyToDefaultView(map) {
    map.flyTo(defaultPoint, 12, {
        animate: true,
        duration: 0.25
    });
}

function markerMap(map, position) {

    map.on("dblclick", (event) => {
        position = event.latlng;
        setMarkerMap(map, position);
    });
}

function verifyMarkerInMap(map) {
    if(! markerInMap) {
        markerInMap = true;
        marker.addTo(map);
    }
}

function setMarkerMap(map, position) {
    verifyMarkerInMap(map);

    marker.setLatLng(position);
    map.panTo(position);

    // Actualizamos valor en los inputs
    if(lat != null && lng != null) {
        lat.val(position.lat);
        lng.val(position.lng);
    }

    // Actualizamos valor en los textos (span)
    if(lat_text != null && lng_text != null) {
        lat_text.text(position.lat);
        lng_text.text(position.lng);
    }
}