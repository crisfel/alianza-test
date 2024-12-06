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
                                <h6 class="text-white text-center text-capitalize ps-2 mx-6 p-3">Empleados</h6>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="row">
                                <div class="col-md-12 d-flex justify-content-center">
                                    <a href="#" id="btn-add" class="btn btn-primary">Crear empleado</a>
                                </div>
                            </div>
                            <div class="table-responsive mt-3 p-0">
                                <table id= "my_table" class="table table-striped table-align-items-center mb-0">
                                    <thead class="">
                                    <tr>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nombre</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Identificación</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Teléfono</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Dirección</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ciudad</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Departamento</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Rol</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jefe</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Cargos</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Acción</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($employees as $employee)
                                        <tr class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            <td>{{$employee->name.' '. $employee->last_name}}</td>
                                            <td class="text-center">{{$employee->identification}}</td>
                                            <td class="text-center">{{$employee->phone}}</td>
                                            <td class="text-center">{{$employee->address}}</td>
                                            <td class="text-center">{{$employee->city}}</td>
                                            <td class="text-center">{{$employee->department}}</td>
                                            <td class="text-center">{{$employee->role}}</td>
                                            <td class="text-center">{{$employee->email}}</td>
                                            <td class="text-center">{{isset($employee->boss) ? $employee->boss->name : 'No aplica'}}</td>
                                            <td class="text-center">
                                                <ul>
                                                @foreach($employee->userPositions as $userPosition)
                                                    <li>{{$userPosition->position->name}}</li>
                                                @endforeach
                                                </ul>
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    <div class="d-inline">
                                                        <a style="color: darkred;" href="#" title="Editar" class="btn btn-link px-1 mb-0" onclick="showEditModal('{{$employee->id}}')"><i style="color: darkslategrey; font-size: 25px !important;" class="material-icons opacity-10">edit</i></a>
                                                    </div>
                                                    <div class="d-inline">
                                                        <a style="color: darkgreen;" href="#" title="Eliminar" id="btn-delete" class="btn btn-link px-1 mb-0" onclick="deletePosition('{{$employee->id}}')"><i style="color: darkred; font-size: 25px !important;" class="material-icons opacity-10">delete</i></a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="editEmployeeModal{{$employee->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
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
                                                                    <input class="form-control" type="text" name="name" id="name{{$employee->id}}" value="{{$employee->name}}" required>
                                                                </div>
                                                                <div class="form-group col-md-6 mt-2">
                                                                    <label for="lastName">Apellidos</label>
                                                                    <input class="form-control" type="text" name="lastNam" id="lastName{{$employee->id}}" value="{{$employee->last_name}}" required>
                                                                </div>
                                                                <div class="form-group col-md-6 mt-2">
                                                                    <label for="identification">Identificación</label>
                                                                    <input class="form-control" type="text" name="identification" id="identification{{$employee->id}}" value="{{$employee->identification}}" required>
                                                                </div>
                                                                <div class="form-group col-md-6 mt-2">
                                                                    <label for="email">Email</label>
                                                                    <input class="form-control" type="email" name="email{{$employee->id}}" id="email{{$employee->id}}" value="{{$employee->email}}" required>
                                                                </div>
                                                                <div class="form-group col-md-6 mt-2">
                                                                    <label for="address">Dirección</label>
                                                                    <input class="form-control" type="text" name="address{{$employee->id}}" id="address{{$employee->id}}" value="{{$employee->address}}" required>
                                                                </div>
                                                                <div class="form-group col-md-6 mt-2">
                                                                    <label for="phone">Teléfono</label>
                                                                    <input class="form-control" type="text" name="phone{{$employee->id}}" id="phone{{$employee->id}}" value="{{$employee->phone}}" required>
                                                                </div>
                                                                <div class="col-md-6 mt-2">
                                                                    <label class="form-label" for="city">Seleccione una ciudad</label>
                                                                    <select class="form-control" id="city{{$employee->id}}" name="city{{$employee->id}}" aria-label="select example" data-header="Tipo">
                                                                        <option value="default" disabled>Seleccione</option>
                                                                        <option value="{{$employee->city}}" Selected>{{$employee->city}}</option>
                                                                        <option value="Bogota">Bogotá</option>
                                                                        <option value="Medellin">Medellín</option>
                                                                        <option value="Barranquilla">Barranquilla</option>
                                                                        <option value="Cartagena">Cartagena</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-6 mt-2">
                                                                    <label class="form-label" for="department">Seleccione un departamento</label>
                                                                    <select class="form-select" id="department{{$employee->id}}" name="department{{$employee->id}}" aria-label="select example" data-header="Tipo">
                                                                        <option value="default" disabled>Seleccione</option>
                                                                        <option value="{{$employee->department}}" Selected>{{$employee->department}}</option>
                                                                        <option value="Cundinamarca">Cundinamarca</option>
                                                                        <option value="Antioquia">Antioquia</option>
                                                                        <option value="Atlantico">Atlantico</option>
                                                                        <option value="Bolivar">Bolivar</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-6 mt-2">
                                                                    <label class="form-label" for="role">Asigna un Rol</label>
                                                                    <select class="form-control" id="role{{$employee->id}}" name="role{{$employee->id}}" onchange="showBosses('{{$employee->id}}')" aria-label="select example" data-header="role">
                                                                        <option value="default" selected>Seleccione</option>
                                                                        <option value="{{$employee->role}}" Selected>{{$employee->role}}</option>
                                                                        <option value="Colaborador">Colaborador</option>
                                                                        <option value="Jefe">Jefe</option>
                                                                    </select>
                                                                </div>

                                                                <div style="display:none" id="bossIDDiv{{$employee->id}}" class="col-md-6 mt-2">
                                                                    <label class="form-label" for="bossID">Asigna un jefe</label>
                                                                    <select class="form-control" id="bossID{{$employee->id}}" name="bossID{{$employee->id}}" aria-label="select example" data-header="bossID" disabled>
                                                                        <option value="default" selected>Seleccione</option>
                                                                        @foreach($bosses as $boss)
                                                                            @if (isset($employee->boss) && $employee->boss->id == $boss->id)
                                                                                <option value="{{$boss->id}}" selected>{{$boss->name}}</option>
                                                                            @else
                                                                                <option value="{{$boss->id}}">{{$boss->name}}</option>
                                                                            @endif
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-6 mt-2 mx-auto">
                                                                    <label class="form-label" for="positionIDs">Asigna un cargo</label>
                                                                    <select class="form-control" id="positionIDs{{$employee->id}}" name="positionIDs{{$employee->id}}" aria-label="select example" data-header="role" multiple>
                                                                        <option value="default" disabled>Seleccione</option>
                                                                        @foreach($positions as $position)
                                                                            <option value="{{$position->id}}"
                                                                            @foreach($employeesPositions as $employeePosition)
                                                                                @if($employeePosition->user_id == $employee->id && $employeePosition->position_id == $position->id)
                                                                                    selected
                                                                                    @break
                                                                                @endif
                                                                            @endforeach
                                                                            >{{$position->name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="row d-flex justify-content-center">
                                                                        <div class="form-group col-md-6 mt-3">
                                                                            <label for="password">Contraseña</label>
                                                                            <input class="form-control" type="password" name="password" id="password{{$employee->id}}" required>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <input type="hidden" id="employeeID{{$employee->id}}" value="{{$employee->id}}">
                                                                <div class="col-md-12 d-flex justify-content-center mt-4">
                                                                    <input type="submit" class="btn btn-success" id="btn-upload" onclick="updateEmployee('{{$employee->id}}')" value="Modificar">
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
                });

                $('#btn-send').on('click', function(){
                    console.log('name:' + $('#name').val());
                    console.log('lastName:' + $('#lastName').val());
                    console.log('phone:' + $('#phone').val());
                    console.log('identification:' + $('#identification').val());
                    console.log('address:' + $('#address').val());
                    console.log('city:' + $('#city').val());
                    console.log('department:' + $('#department').val());
                    console.log('email:' + $('#email').val());
                    console.log('password:' + $('#password').val());
                    console.log('role:' + $('#role').val());
                    console.log('bossID:' + $('#bossID').val());
                    console.log('positionIDs:' + $('#positionIDs').val());

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

        <script>
            function showEditModal(id)
            {
                $('#editEmployeeModal'+id).modal('show');
            }

            function showBosses(id)
            {
                console.log($('#bossIDDiv' + id));

                $('#bossIDDiv' + id).css('display', 'none');

                $('#bossID' + id).prop('disabled', true);

                if ($('#role' + id).val() == 'Colaborador') {
                    $('#bossIDDiv' + id).css('display', 'block');
                    $('#bossID' + id).prop('disabled', false);
                }
            }

            function updateEmployee(id)
            {
                console.log('name:' + $('#name'+id).val());
                console.log('lastName:' + $('#lastName'+id).val());
                console.log('phone:' + $('#phone'+id).val());
                console.log('identification:' + $('#identification'+id).val());
                console.log('address:' + $('#address'+id).val());
                console.log('city:' + $('#city'+id).val());
                console.log('department:' + $('#department'+id).val());
                console.log('email:' + $('#email'+id).val());
                console.log('password:' + $('#password'+id).val());
                console.log('role:' + $('#role'+id).val());
                console.log('bossID:' + $('#bossID'+id).val());
                console.log('positionIDs:' + $('#positionIDs'+id).val());
                /*
                if ($('#name').val() == '' || $('#lastName').val() == '' || $('#identification').val() == '' ||
                    $('#email').val() == '' || $('#address').val() == '' || $('#phone').val() == '' ||
                    $('#city').val() == null || $('#department').val() == null || $('#role').val() == null ||
                    $('#city').val() == 'default' || $('#department').val() == 'default' || $('#role').val() == 'default' ||
                    ($('#role').val() == 'Colaborador' && $('#bossID').val() == null) || ($('#role').val() == 'Colaborador' && $('#bossID').val() == 'default')) {

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
                */


                $.ajax({
                    url: '{{getenv('APP_URL')}}/api/v1/employee/update',
                    method: 'POST',
                    data: {
                        'employeeID': id,
                        'name': $('#name'+id).val(),
                        'lastName': $('#lastName'+id).val(),
                        'phone': $('#phone'+id).val(),
                        'identification': $('#identification'+id).val(),
                        'address': $('#address'+id).val(),
                        'city': $('#city'+id).val(),
                        'department': $('#department'+id).val(),
                        'email': $('#email'+id).val(),
                        'password': $('#password'+id).val(),
                        'role': $('#role'+id).val(),
                        'bossID': $('#bossID'+id).val(),
                        'positionIDs': $('#positionIDs'+id).val()
                    },
                    success: function() {
                        Swal.fire({
                            title: 'Éxito',
                            text: 'Modificación Satisfactoria',
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonText: 'Aceptar',
                            allowOutsideClick: false,
                            allowEscapeKey: false
                        }).then(function(){
                            window.location="{{getenv('APP_URL')}}/employees";
                        });
                    },
                    error: function(r){
                        console.log(r)
                    }
                });
            }

        </script>


@endsection
