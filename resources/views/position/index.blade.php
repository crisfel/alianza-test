@extends('layouts.dashboard')
@section('content')
    <div class="row mt-4">
    </div>

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-1 pb-0">
                                <h6 class="text-white text-center text-capitalize ps-2 mx-6 p-3">Cargos</h6>
                            </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="row">
                            <div class="col-md-12 d-flex justify-content-center">
                                <a href="#" id="btn-add" class="btn btn-primary">Crear Cargo</a>
                            </div>
                        </div>
                        <div class="table-responsive p-0">
                            <table id= "my_table" class="table table-striped align-items-center mb-0">
                                <thead class="">
                                <tr>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nombre Cargo</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Responsabilidades</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Acción</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($positions as $position)
                                        <tr class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            <td>{{$position->name}}</td>
                                            <td class="text-center">{{$position->responsibilities}}</td>
                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    <div class="d-inline">
                                                        <a style="color: darkred;" href="#" title="Editar" class="btn btn-link px-1 mb-0" onclick="showEditModal('{{$position->id}}')"><i style="color: darkslategrey; font-size: 25px !important;" class="material-icons opacity-10">edit</i></a>
                                                    </div>
                                                    <div class="d-inline">
                                                        <a style="color: darkgreen;" href="#" title="Eliminar" id="btn-delete" class="btn btn-link px-1 mb-0" onclick="deletePosition('{{$position->id}}')"><i style="color: darkred; font-size: 25px !important;" class="material-icons opacity-10">delete</i></a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="editPositionModal{{$position->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h6 class="modal-title" id="exampleModalLabel">Editar Cargo</h6>
                                                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="container">
                                                            <div class="row">
                                                                <div class="form-group col-md-6 mt-2">
                                                                    <label for="name">Nombre</label>
                                                                    <input class="form-control" type="text" name="name" id="name{{$position->id}}" value="{{$position->name}}" required>
                                                                </div>
                                                                <div class="form-group col-md-6 mt-2">
                                                                    <label for="exampleFormControlTextarea1">Responsabilidades</label>
                                                                    <textarea class="form-control" id="responsibilities{{$position->id}}" rows="3">{{$position->responsibilities}}</textarea>
                                                                </div>
                                                                <input type="hidden" id="positionID{{$position->id}}" value="{{$position->id}}">
                                                                <div class="col-md-12 d-flex justify-content-center mt-4">
                                                                    <input type="submit" class="btn btn-success" id="btn-upload" onclick="updatePosition('{{$position->id}}')" value="Modificar">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                            <style>
                                .form-control {
                                    background-color: #f2f2f2 !important ;
                                }
                            </style>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="createPositionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">Crear Cargo</h6>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="form-group col-md-6 mt-2">
                                <label for="name">Nombre</label>
                                <input class="form-control" type="text" name="name" id="name" required>
                            </div>
                            <div class="form-group col-md-6 mt-2">
                                <label for="exampleFormControlTextarea1">Responsabilidades</label>
                                <textarea class="form-control" id="responsibilities" rows="3"></textarea>
                            </div>
                            <div class="col-md-12 d-flex justify-content-center mt-4">
                                <input type="submit" class="btn btn-success" id="btn-send" value="Guardar">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready( function () {
            $('#btn-add').on('click', function() {
                $('#createPositionModal').modal('show');
            });

            $('#btn-send').on('click', function(){
                if ($('#name').val() == '') {
                    Swal.fire({
                        title: 'Alerta',
                        text: 'Por favor llene los campos: nombre',
                        icon: 'warning',
                        showCancelButton: false,
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick: false,
                        allowEscapeKey: false
                    });

                    return false;
                }

                $.ajax({
                    url: '{{getenv('APP_URL')}}/api/v1/position/store',
                    method: 'POST',
                    data: {
                        'name': $('#name').val(),
                        'responsibilities': $('#responsibilities').val(),
                    },
                    success: function() {
                        Swal.fire({
                            title: 'Éxito',
                            text: 'Registro Satisfactorio',
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonText: 'Aceptar',
                            allowOutsideClick: false,
                            allowEscapeKey: false
                        }).then(function(){
                            window.location="{{getenv('APP_URL')}}/positions";
                        });
                    }
                });
            });
        } );
    </script>
    <script>
        function showEditModal(id)
        {
            $('#editPositionModal'+id).modal('show');
        }

        function updatePosition(id)
        {
            if ($('#name'+id).val() == '') {
                Swal.fire({
                    title: 'Alerta',
                    text: 'Por favor llene los campos: nombre',
                    icon: 'warning',
                    showCancelButton: false,
                    confirmButtonText: 'Aceptar',
                    allowOutsideClick: false,
                    allowEscapeKey: false
                });

                return false;
            }

            $.ajax({
                url: '{{getenv('APP_URL')}}/api/v1/position/update',
                method: 'POST',
                data: {
                    'id': id,
                    'name': $('#name'+id).val(),
                    'responsibilities': $('#responsibilities'+id).val(),
                },
                success: function() {
                    Swal.fire({
                        title: 'Éxito',
                        text: 'Registro Modificado',
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick: false,
                        allowEscapeKey: false
                    }).then(function(){
                        window.location="{{getenv('APP_URL')}}/positions";
                    });
                }
            });
        }

        function deletePosition(id)
        {
            Swal.fire({
                title: 'Alerta',
                text: '¿Está seguro que quiere borrar este cargo?',
                icon: 'question',
                showCancelButton: false,
                confirmButtonText: 'Aceptar',
                allowOutsideClick: true,
                allowEscapeKey: false
            }).then(function(result){
                if(result.isConfirmed) {
                    $.ajax({
                        url: '{{getenv('APP_URL')}}/api/v1/position/' + id,
                        method: 'DELETE',
                        success: function () {
                            Swal.fire({
                                title: 'Éxito',
                                text: 'Registro Eliminado',
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonText: 'Aceptar',
                                allowOutsideClick: false,
                                allowEscapeKey: false
                            }).then(function () {
                                window.location = "{{getenv('APP_URL')}}/positions";
                            });
                        }
                    });
                }
            });
        }
    </script>
@endsection
