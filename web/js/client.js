var app = angular.module('myApp', []);

app.controller('contactController', contactController);

function contactController($http, $scope, $window) {

    $http.get("/API/web/app_dev.php/contacts")
            .then(function (response) {
                $scope.contacts = response.data;
                $scope.filtreContact = "";
            });

    $scope.addContact = function () {
        $http({url: "/API/web/app_dev.php/contacts", params: {"civilite": $scope.newContact.civilite, "prenom": $scope.newContact.prenom, "nom": $scope.newContact.nom,
                "datenaissance": $scope.newContact.dateNaissance, "rue": $scope.newContact.adresses.rue, "codepostal": $scope.newContact.adresses.codePostal,
                "ville": $scope.newContact.adresses.ville}, method: "POST", headers: {'X-Auth-Token': $window.sessionStorage.getItem('token')}});
        $scope.contact = null;
        location.reload();
    };

    $scope.deleteContact = function ($id) {
        $http({url: "/API/web/app_dev.php/contacts/" + $id, params: {"id": $id}, method: "DELETE", headers: {'X-Auth-Token': $window.sessionStorage.getItem('token')}});
        location.reload();
    };

    $scope.addToken = function () {
        $http({url: "/API/web/app_dev.php/tokens", method: "POST", params: {"login": $scope.login, "password": $scope.password}}).then(function (response) {
            $window.sessionStorage.setItem('token', response.data.value);
            $window.sessionStorage.setItem('idToken', response.data.id);
        });
    };

    $scope.deleteToken = function () {
        $http({url: "/API/web/app_dev.php/tokens/" + $window.sessionStorage.getItem('idToken'), method: "DELETE", params: {"id": $window.sessionStorage.getItem('idToken')}});
        $window.sessionStorage.removeItem('token');
        $scope.login = null;
        $scope.password = null;
    };

    $scope.editContact = function ($contact) {
        $contact.edit = true;
    };

    $scope.cancelContact = function ($contact) {
        $contact.edit = false;
        location.reload();
    };

    $scope.validateContact = function ($contact) {
        $http({url: "/API/web/app_dev.php/contacts/" + $contact.id, params: {"civilite": $contact.civilite, "prenom": $contact.prenom, "nom": $contact.nom,
                "datenaissance": $contact.dateNaissance, "idadresse": $contact.adresses[0].id, "rue": $contact.adresses[0].rue, "codepostal": $contact.adresses[0].codePostal,
                "ville": $contact.adresses[0].ville}, method: "PATCH", headers: {'X-Auth-Token': $window.sessionStorage.getItem('token')}});
        $scope.edit = false;
        location.reload();
    };




}


