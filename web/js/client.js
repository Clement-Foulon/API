var app = angular.module('myApp', []);
app.controller('myCtrl', appController);

function appController($http, $scope) {
    $http.get("/API/web/app_dev.php/contacts")
            .then(function (response) {
                $scope.contacts = response.data;
                $scope.filtreProjet = "";
            });
}