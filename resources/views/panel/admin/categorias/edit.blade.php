@extends('adminlte::page')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

@section('title', 'Editar')
@section('content_header')
@stop

@section('content')
<div class="container mt-5"> <!-- Añadido mt-5 para margen superior -->
    <div class="row justify-content-center"> <!-- Centrado horizontalmente -->
        <div class="col-12 mb-3">
            <h1>Editar Datos de la Categoria "{{ $categoria->nombre }}"</h1>
            <a href="{{ route('categoria.index') }}" class="btn btn-sm" style="background-color: #022340; color: white; text-transform: uppercase;">
                Volver Atrás
            </a>
        </div>
        <div class="col-12">
            @include('panel.admin.categorias.forms.form')
        </div>
    </div>
</div>
@stop

@section('css')
    
@stop

@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const updateButton = document.getElementById('update-button');

        if (updateButton) {
            updateButton.addEventListener('click', function (event) {
                event.preventDefault();

                Swal.fire({
                    title: '¡Atención!',
                    html: `
                        <div style="text-align: center;">
                            <i class="fas fa-exclamation-triangle" style="color: #D91C35; font-size: 50px;"></i>
                            <h4 style="margin-top: 10px;">Confirmación de Actualización</h4>
                            <p style="color: #343a40;">¿Estás seguro de que deseas actualizar los datos?</p>
                        </div>
                    `,
                    showCancelButton: true,
                    confirmButtonColor: '#1AD992',
                    cancelButtonColor: '#D91C35',
                    confirmButtonText: 'Sí, actualizar!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        event.target.closest('form').submit();
                    }
                });
            });
        }
    });
</script>
@stop


