app.controller('statistiquesCtrl',['$scope', '$http',
    function($scope, $http) {
       $scope.listeOption = [];
       $scope.getOptionsDepartement = function() {
          $http.post('addData/getOptionAtSelectedDept', {
               'idDepartement' : $scope.idDepartement
            }
          ).then(function(response) {
              $scope.listeOption = response.data;
            }, function(response) {
                console.log(response.data);
          });
       }
       
       $scope.listeFormations = [];
       $scope.getFormationsOption = function() {
          $http.post('addData/getFormationAtOption', {
               'idOption' : $scope.idOption
            }
          ).then(function(response) {
              $scope.listeFormations = response.data;
            }, function(response) {
                console.log(response.data);
          });
       }
       
    }
]);