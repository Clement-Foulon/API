var app = angular.module('myApp',[]);

var token = "FPDkhhyh/i8ylgcbSGNtA1PfSAyjvfRHiZK+vO+yxrFdqFaEjjGwEO/hQqpvKSWspts=";

app.controller('contactController', contactController);

function contactController($http, $scope) {
    $http.get("/API/web/app_dev.php/contacts")
            .then(function (response) {
                $scope.contacts = response.data;
                $scope.filtreProjet = "";
            });

    $scope.addContact = function () {
        $http({url: "/API/web/app_dev.php/contacts", params: {"civilite": $scope.contact.civilite, "prenom": $scope.contact.prenom, "nom": $scope.contact.nom,
                "datenaissance": $scope.contact.dateNaissance, "rue": $scope.contact.adresses.rue, "codepostal": $scope.contact.adresses.codePostal,
                "ville": $scope.contact.adresses.ville}, method: "POST", headers: {'X-Auth-Token': token}});
        $scope.contact = null;
        location.reload();
    };

    $scope.deleteContact = function ($id) {
        $http({url: "/API/web/app_dev.php/contacts/" + $id, params: {"id": $id}, method: "DELETE", headers: {'X-Auth-Token': token}});
        location.reload();
    };

    $scope.addToken = function () {
        $http({url: "/API/web/app_dev.php/tokens", method: "POST", params: {"login": $scope.login, "password": $scope.password}}).then(function (response) {
            $scope.token = response.data;
        });
    };

}


