let map = null;

$(document).on('click', '#button_map', function(e) {
    e.preventDefault();

    // Si se envio el parametro 0, nos trae todas las ventas disponibles
    var url = '/panel/ventas_mapa/0';
    
    $.get(url, function(response) {
        if(response.success) {
            map = L.map('map_2', {
                fullscreenControl: true,
                fullscreenControlOptions: {
                    position: 'topleft'
                }
            });
            initMap(map);
            initGroupMarker(map, response.data);
            $('#modal-mapa').modal('show');
        } else {
            createModalFailResponse($('#modal-mapa'), response.message);
        }
    })
    .fail(function (jqXHR, textStatus, errorThrown) {
        //modal.createModalFailResponse(formJq, errorThrown);
        console.log("Error", textStatus, errorThrown);
    });
});

$('#modal-mapa').on('shown.bs.modal', function(){
    map.invalidateSize();
});

$('#modal-mapa').on('hidden.bs.modal', function() {
    map.remove();
});