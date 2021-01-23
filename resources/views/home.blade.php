@extends('layouts.app')

@section('content')
    <div class="container" ng-controller="ContactoController">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <button class="btn btn-primary btn-xs pull-right" ng-click="initContacto()">Registrar</button>
                        Listado de Contácto
                    </div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif


                        <table class="table table-bordered table-striped" ng-if="contactos.length > 0">
                            <tr>
                                <th>No.</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Email</th>
                                <th>Teléfono</th>
                                <th>Dirección</th>
                                <th>Action</th>
                            </tr>
                            <tr ng-repeat="(index, contacto) in contactos">
                                <td>
                                    @{{ index + 1 }}
                                </td>
                                <td>@{{ contacto.nombre }}</td>
                                <td>@{{ contacto.apellido }}</td>
                                 <td>@{{ contacto.email }}</td>
                                <td>@{{ contacto.telefono }}</td>
                                 <td>@{{ contacto.direccion }}</td>
                                <td>
                                    <button class="btn btn-success btn-xs" ng-click="initEdit(index)">Editar</button>
                                    <button class="btn btn-danger btn-xs" ng-click="deleteContacto(index)" >Eliminar</button>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" tabindex="-1" role="dialog" id="add_new_contacto">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Agreagr Contácto</h4>
                    </div>
                    <div class="modal-body">

                        <div class="alert alert-danger" ng-if="errors.length > 0">
                            <ul>
                                <li ng-repeat="error in errors">@{{ error }}</li>
                            </ul>
                        </div>

                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" name="nombre" class="form-control" ng-model="contacto.nombre">
                        </div>
                        <div class="form-group">
                            <label for="apellido">Apellido</label>
                            <input type="text" name="apellido" class="form-control" ng-model="contacto.apellido">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control" ng-model="contacto.email">
                        </div>
                        <div class="form-group">
                            <label for="telefono">Teléfono</label>
                            <input type="text" name="telefono" class="form-control" ng-model="contacto.telefono">
                        </div>
                        <div class="form-group">
                            <label for="direccion">Dirección</label>
                            <textarea name="direccion" rows="5" class="form-control"
                                      ng-model="contacto.direccion"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" ng-click="addContacto()">Enviar</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" tabindex="-1" role="dialog" id="edit_contacto">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Actualizar Contato</h4>
                    </div>
                    <div class="modal-body">

                        <div class="alert alert-danger" ng-if="errors.length > 0">
                            <ul>
                                <li ng-repeat="error in errors">@{{ error }}</li>
                            </ul>
                        </div>

                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" name="nombre" class="form-control" ng-model="edit_contacto.nombre">
                        </div>
                        <div class="form-group">
                            <label for="apellido">Apellido</label>
                            <input type="text" name="apellido" class="form-control" ng-model="edit_contacto.apellido">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" name="email" class="form-control" ng-model="edit_contacto.email">
                        </div>
                        <div class="form-group">
                            <label for="telefono">Teléfono</label>
                            <input type="text" name="telefono" class="form-control" ng-model="edit_contacto.telefono">
                        </div>
                        <div class="form-group">
                            <label for="direccion">Dirección</label>
                            <textarea name="direccion" rows="5" class="form-control"
                                      ng-model="edit_contacto.direccion"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" ng-click="updateContacto()">Actualizar</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection