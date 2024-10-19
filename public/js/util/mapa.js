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

function initGroupMarker(map, lista) {
    //var grupos = L.markerClusterGroup(); 

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

    for(var i = 0; i<lista.length; i++) {
        var marker = L.marker([lista[i].latitud, lista[i].longitud], { icon: pin_location });
        var msj = 'Acta N° '+lista[i].n_acta + '<br>' + lista[i].lugar_infraccion;
        /* marker.on('click', (e) => {
            var msj = lista[i].n_acta + '<br>' + lista[i].lugar_infraccion;
            e.target.bindPopup(msj).openPopup();
        }); */
        marker.bindPopup(msj);
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
    map.flyTo(defaultPoint, 13, {
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