function createHeaderModal(title, error = false){
    var header = '';

    if(error) {
        header = '<div class="modal-header bg-danger">';
    } else {
        header = '<div class="modal-header bg-primary">';
    }
        header += '<h6 class="modal-title">' + title + '</h6>';
        header += '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
            header += '<span class="text-white" aria-hidden="true">&times;</span>';
        header += '</button>';
    header += '</div>';
    return header;
}

function createFooterModal(confirm, cancel = null){
    var footer = '<div class="modal-footer">';

    if(cancel == null) {
        footer += '<button class="btn btn-secondary" data-dismiss="modal">' + confirm +'</button>';
    } else {
        footer += '<button class="btn btn-secondary" data-dismiss="modal">' + cancel +'</button>';
        footer += '<button class="btn btn-primary" type="submit" type="button">' + confirm + '</button>';
    }

    footer += '</div>';
    return footer;
}

function createModalFailResponse(container, message){
    var modal = ' <div class="modal fade" id="modal-error" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">';
    modal += '<div class="modal-dialog modal-dialog-centered" role="document">';
        modal += '<div class="modal-content">';

            modal += createHeaderModal('Error', true);

            modal += '<div class="modal-body">';
            modal += '<h6>';
            modal += message;
            modal += '</h6>';
            modal += '</div>';

            modal += createFooterModal('Cerrar');

        modal += '</div>';
    modal += '</div>';
    modal += '</div>';
    container.after(modal);

    $('#modal-error').modal('show');
    $('#modal-error').on('hidden.bs.modal', function() {
        $(this).remove();
    });
}