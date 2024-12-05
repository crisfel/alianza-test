@extends('layouts.dashboard')
@section('content')
    <div class="pt-4">
        <p style="font-size: 27px" class="text-center mt-5 mb-1"> Bienvenida! <br>{{Auth::user()->name}}</p>
        <p style="font-size: 15px" class="text-center mt-5"> Añade los datos personales de tus empleados y después agrega su cargo en tu empresa </p>
        <p style="font-size: 35px" class="mt-4 text-center">
            <a href="#" id="btn-add"><i class="bi bi-person-add"></i></a>
        </p>
        <div class="modal fade" id="createEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title" id="exampleModalLabel">Crear Empleado</h6>
                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="form-group col-md-6 mt-2">
                                    <label for="name">Nombres</label>
                                    <input class="form-control" type="text" name="name" id="name" required>
                                </div>
                                <div class="form-group col-md-6 mt-2">
                                    <label for="lastName">Apellidos</label>
                                    <input class="form-control" type="text" name="lastName" id="lastName" required>
                                </div>
                                <div class="form-group col-md-6 mt-2">
                                    <label for="identification">Identificación</label>
                                    <input class="form-control" type="text" name="identification" id="identification" required>
                                </div>
                                <div class="form-group col-md-6 mt-2">
                                    <label for="email">Email</label>
                                    <input class="form-control" type="email" name="email" id="email" required>
                                </div>
                                <div class="form-group col-md-6 mt-2">
                                    <label for="address">Dirección</label>
                                    <input class="form-control" type="text" name="address" id="address" required>
                                </div>
                                <div class="form-group col-md-6 mt-2">
                                    <label for="phone">Teléfono</label>
                                    <input class="form-control" type="text" name="phone" id="phone" required>
                                </div>
                                <div class="col-md-6 mt-2">
                                    <label class="form-label" for="city">Seleccione una ciudad</label>
                                    <select class="form-control" id="city" name="city" aria-label="select example" data-header="Tipo">
                                        <option value="default" disabled selected>Seleccione</option>
                                        <option value="Bogota">Bogotá</option>
                                        <option value="Medellin">Medellín</option>
                                        <option value="Barranquilla">Barranquilla</option>
                                        <option value="Cartagena">Cartagena</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mt-2">
                                    <label class="form-label" for="department">Seleccione un departamento</label>
                                    <select class="form-select" id="department" name="department" aria-label="select example" data-header="Tipo">
                                        <option value="default" disabled selected>Seleccione</option>
                                        <option value="Cundinamarca">Cundinamarca</option>
                                        <option value="Antioquia">Antioquia</option>
                                        <option value="Atlantico">Atlantico</option>
                                        <option value="Bolivar">Bolivar</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mt-2">
                                    <label class="form-label" for="role">Asigna un Rol</label>
                                    <select class="form-control" id="role" name="role" aria-label="select example" data-header="role">
                                        <option value="default" selected>Seleccione</option>
                                        <option value="Colaborador">Colaborador</option>
                                        <option value="Jefe">Jefe</option>
                                    </select>
                                </div>

                                <div style="display:none" id="bossIDDiv" class="col-md-6 mt-2">
                                    <label class="form-label" for="bossID">Asigna un jefe</label>
                                    <select class="form-control" id="bossID" name="bossID" aria-label="select example" data-header="bossID" disabled>
                                        <option value="default" selected>Seleccione</option>
                                        @foreach($bosses as $boss)
                                            <option value="{{$boss->id}}">{{$boss->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 mt-2 mx-auto">
                                    <label class="form-label" for="positionIDs">Asigna un cargo</label>
                                    <select class="form-control" id="positionIDs" name="positionIDs" aria-label="select example" data-header="role" multiple>
                                        <option value="default" disabled>Seleccione</option>
                                        @foreach($positions as $position)
                                            <option value="{{$position->id}}">{{$position->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <div class="row d-flex justify-content-center">
                                        <div class="form-group col-md-6 mt-3">
                                            <label for="password">Contraseña</label>
                                            <input class="form-control" type="password" name="password" id="password" required>
                                        </div>
                                    </div>
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
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#btn-add').on('click', function() {
                $('#createEmployeeModal').modal('show');
            });

            $('#role').on('change', function() {

                $('#bossIDDiv').css('display', 'none');
                $('#bossID').prop('disabled', true);

                if ($(this).val() == 'Colaborador') {

                    $('#bossIDDiv').css('display', 'block');
                    $('#bossID').prop('disabled', false);
                }
                $('#createEmployeeModal').modal('show');
            });

            $('#btn-send').on('click', function(){
                console.log($('#bossID').val());

                if ($('#name').val() == '' || $('#lastName').val() == '' || $('#identification').val() == '' ||
                    $('#email').val() == '' || $('#address').val() == '' || $('#phone').val() == '' ||
                    $('#city').val() == null || $('#department').val() == null || $('#role').val() == null ||
                    $('#city').val() == 'default' || $('#department').val() == 'default' || $('#role').val() == 'default' ||
                    $('#password').val() == '' || ($('#role').val() == 'Colaborador' && $('#bossID').val() == null) ||
                    ($('#role').val() == 'Colaborador' && $('#bossID').val() == 'default')) {

                    Swal.fire({
                        title: 'Alerta',
                        text: 'Por favor llene los campos: nombres, apellidos, identificación, email, dirección, teléfono, ciudad, cargo, departamento, rol y contraseña',
                        icon: 'warning',
                        showCancelButton: false,
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick: false,
                        allowEscapeKey: false
                    });

                    return false;
                }

                $.ajax({
                    url: '{{getenv('APP_URL')}}/api/v1/employee/store',
                    method: 'POST',
                    data: {
                        'name': $('#name').val(),
                        'lastName': $('#lastName').val(),
                        'phone': $('#phone').val(),
                        'identification': $('#identification').val(),
                        'address': $('#address').val(),
                        'city': $('#city').val(),
                        'department': $('#department').val(),
                        'email': $('#email').val(),
                        'password': $('#password').val(),
                        'role': $('#role').val(),
                        'bossID': $('#bossID').val(),
                        'positionIDs': $('#positionIDs').val()
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
                            window.location="{{getenv('APP_URL')}}/employees";
                        });
                    }
                });
            });

        });
    </script>
@endsection
