app.controller('globalStatCtrl',['$scope', '$http',
    function($scope, $http) {
        $http.get('/Projet-uml/web/app_dev.php/gestionScolarite/getAllEtudiantForStat', {})
        .then(function(response) {
            $scope.listeStat = [];
            $scope.statAll= [];
            $scope.listeStat = response.data;
            $scope.nomDepartement = "Tout";
            $scope.loadFormation = function () {
              if($scope.nomDepartement == "Tout") {
                
              }else {
                 $http.get('/Projet-uml/web/app_dev.php/gestionScolarite/getAllDepartementFormation', {})
                 .then(function(response) {
                    $scope.listeFormations = [];
                    $scope.listeFormations = response.data.listeFormation;
                 }, function(response) {
                      console.log(response.data);
                 });      
              }
              
            };
            
            $scope.changeStat = function() {
                console.log($scope.choix.motCle);
            };
            
            $scope.listeAll = [];
            angular.forEach($scope.listeStat, function(value, key) {
               var nomDepartement = value.nomDepartement;
               var effectifPrive = 0;
               var effectifPub = 0;
               angular.forEach($scope.listeStat, function(value, key) {
                   if(value.nomDepartement == nomDepartement) {
                       if(value.statut == "prive") {
                           effectifPrive++;
                       }else {
                           effectifPub++;
                       }
                   }
               });
               var exist = 0;
               if($scope.listeAll.length == 0) {
                   $scope.listeAll.push({
                        'nomDepartement': nomDepartement, 
                        'effectifPrive' : effectifPrive,
                        'effectifPub' : effectifPub
                     });
               }else {
                   angular.forEach($scope.listeAll, function(value, key) {
                   if(value.nomDepartement == nomDepartement) {
                           exist++;
                       }
                   });
                   if(exist == 0) {
                     $scope.listeAll.push({
                        'nomDepartement': nomDepartement, 
                        'effectifPrive' : effectifPrive,
                        'effectifPub' : effectifPub
                     });
                   }   
               }
               
            });
            $scope.afficheStatAll($scope.listeAll);
        }, function(response) {
        });
        
        
        $scope.afficheStatAll = function(liste) {
            $scope.ChartObject = []; 
            $scope.ChartObject.type = "PieChart";
            $scope.listeChartObject = [];
            angular.forEach(liste, function(value, key) {
                $scope.listeChartObject.push({
                    c : [{v:value.nomDepartement},{v: Number(value.effectifPrive+value.effectifPub)}]
                })
            });
        
            $scope.ChartObject.data = {"cols": [
                {id: "t", label: "Topping", type: "string"},
                {id: "s", label: "Slices", type: "number"}
            ], "rows": $scope.listeChartObject};
            $scope.ChartObject.options = {
                'title': 'Statistiques'
            };
        
        };
}]);