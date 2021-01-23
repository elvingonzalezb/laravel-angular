import './bootstrap'; 
import 'angular';

var app = angular.module('CrudPruebaWoob', []
    , ['$httpProvider', function ($httpProvider) {
        $httpProvider.defaults.headers.post['X-CSRF-TOKEN'] = $('meta[name=csrf-token]').attr('content');
    }]);

app.controller('ContactoController', ['$scope', '$http', function ($scope, $http) {
    $scope.contactos = [];

    $scope.loadContactos = function () {
        $http.get('/contacto')
            .then(function success(e) {
                $scope.contactos = e.data.contactos;
            });
    };
    $scope.loadContactos();

    $scope.errors = [];

    $scope.contacto = {
        nombre: '',
        apellido: '',
        email: '',
        telefono: '',
        direccion: ''
    };
    $scope.initContacto = function () {
        $scope.resetForm();
        $("#add_new_contacto").modal('show');
    };
  
    $scope.addContacto = function () {
        $http.post('/contacto', {
            nombre: $scope.contacto.nombre,
            apellido: $scope.contacto.apellido,
            email: $scope.contacto.email,
            telefono: $scope.contacto.telefono,
            direccion: $scope.contacto.direccion
        }).then(function success(e) {
            $scope.resetForm();
            $scope.contactos.push(e.data.contacto);
            $("#add_new_contacto").modal('hide');

        }, function error(error) {
            $scope.recordErrors(error);
        });
    };

    $scope.recordErrors = function (error) {
        $scope.errors = [];
        if (error.data.errors.nombre) {
            $scope.errors.push(error.data.errors.nombre[0]);
        }
        if (error.data.errors.apellido) {
            $scope.errors.push(error.data.errors.apellido[0]);
        }
    }

    $scope.edit_contacto = {};
   
    $scope.initEdit = function (index) {
        $scope.errors = [];
        $scope.edit_contacto = $scope.contactos[index];
        $("#edit_contacto").modal('show');
    };
    
    $scope.updateContacto = function () {
        $http.patch('/contacto/' + $scope.edit_contacto.id, {
            nombre: $scope.edit_contacto.nombre,
            apellido: $scope.edit_contacto.apellido,
            email: $scope.edit_contacto.email,
            telefono: $scope.edit_contacto.telefono,
            direccion: $scope.edit_contacto.direccion
        }).then(function success(e) {
            $scope.errors = [];
            $("#edit_contacto").modal('hide');
        }, function error(error) {
            $scope.recordErrors(error);
        });
    };
    
    $scope.deleteContacto = function (index) {

        var confirmar = confirm("Esta seguro de eliminar el contácto?");

        if (confirmar === true) {
            $http.delete('/contacto/' + $scope.contactos[index].id)
                .then(function success(e) {
                    $scope.contactos.splice(index, 1);
                });
        }
    };

    $scope.resetForm = function () {
        $scope.contacto.nombre = '';
        $scope.contacto.apellido = '';
        $scope.contacto.email = '';
        $scope.contacto.telefono = '';
        $scope.contacto.direccion = '';
        $scope.errors = [];
    };

}]);
