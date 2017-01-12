app.controller('globalStatCtrl',['$scope', '$http',
    function($scope, $http) {
        $scope.motCle = 'all';
       // $scope.choix.critere = 'all';
        $http.get('/Projet-uml/web/app_dev.php/gestionScolarite/getAllEtudiantForStat', {})
        .then(function(response) {
            $scope.listeForAllStat = [];
            $scope.listeForAllStat = response.data;
            $scope.listeAll = [];
            $scope.nomDepartement = "Tout";
            angular.forEach($scope.listeForAllStat, function(value, key) {
               var nomDepartement = value.nomDepartement;
               var effectifPrive = 0;
               var effectifPub = 0;
               var effectifTotal = 0;
               angular.forEach($scope.listeForAllStat, function(value, key) {
                   if(value.nomDepartement == nomDepartement) {
                       if(value.statut == "prive") {
                           effectifPrive++;
                       }else {
                           effectifPub++;
                       }
                   }
               });
               effectifTotal = effectifPrive + effectifPub;
               var exist = 0;
               if($scope.listeAll.length == 0) {
                   $scope.listeAll.push({
                        'nomDepartement': nomDepartement, 
                        'effectifPrive' : effectifPrive,
                        'effectifPub' : effectifPub,
                        'effectifTotal': effectifTotal
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
                        'effectifPub' : effectifPub,
                        'effectifTotal': effectifTotal
                     });
                   }   
               }
            });
            console.log($scope.listeAll);
            $scope.afficheStatAllByEffectif($scope.listeAll);
        }, function(response) {
        });
        
        $scope.loadFormation = function () {
              if($scope.nomDepartement == "Tout") {
                 if($scope.motCle == "all") {
                    $scope.afficheStatAllByEffectif($scope.listeAll);
                 }else {
                    statAllSexeByEffectif();  
                 }
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
            if($scope.nomDepartement == "Tout") {
                if($scope.choix.motCle=="all") {
                    if($scope.choix.critere=="all") {
                        $scope.afficheStatAllByEffectif($scope.listeAll);  
                    }
                    if($scope.choix.critere=="niveau") {
                        statAll_ByNiveau();
                    }
                    if($scope.choix.critere=="nationalite") {
                        statAll_ByNationalite();
                    }
                    if($scope.choix.critere=="resultat") {
                        
                    }
                }else{
                    if($scope.choix.critere=="all") {
                        statAllSexeByEffectif(); 
                    }
                    if($scope.choix.critere=="niveau") {
                        
                    }
                    if($scope.choix.critere=="nationalite") {
                        
                    }
                    if($scope.choix.critere=="resultat") {
                        
                    }
                }    
            }else {
                
            }
            
        };
        $scope.changeCritereStat = function() {
            if($scope.nomDepartement == "Tout") {
                if($scope.motCle == "all") {
                    if($scope.choix.critere=="all") {
                        $scope.afficheStatAllByEffectif($scope.listeAll);  
                    }
                    if($scope.choix.critere=="niveau") {
                        statAll_ByNiveau();
                    }
                    if($scope.choix.critere=="nationalite") {
                        statAll_ByNationalite();
                    }
                    if($scope.choix.critere=="resultat") {
                        
                    }
                }else {
                    if($scope.choix.critere=="all") {
                        statAllSexeByEffectif(); 
                    }
                    if($scope.choix.critere=="niveau") {
                        
                    }
                    if($scope.choix.critere=="nationalite") {
                        
                    }
                    if($scope.choix.critere=="resultat") {
                        
                    }
                }
            }else {
                
            }
        }
        $scope.afficheStatAllByEffectif = function(liste) {
            $scope.ChartObjectPub = []; 
            $scope.ChartObjectPrive = []; 
            $scope.ChartObjectPub.type = "PieChart";
            $scope.ChartObjectPrive.type = "PieChart";
            var listeChartObjectPub = [];
            var listeChartObjectPrive = [];
            angular.forEach(liste, function(value, key) {
                listeChartObjectPub.push({
                    c : [{v:value.nomDepartement},{v: Number(value.effectifPub)}]
                })
            });
            angular.forEach(liste, function(value, key) {
                listeChartObjectPrive.push({
                    c : [{v:value.nomDepartement},{v: Number(value.effectifPrive)}]
                })
            });
            $scope.ChartObjectPub.data = {"cols": [
                {id: "t", label: "Topping", type: "string"},
                {id: "s", label: "Slices", type: "number"}
            ], "rows": listeChartObjectPub};
            $scope.ChartObjectPub.options = {
                'title': 'Statistiques effectif public'
            }
            $scope.ChartObjectPrive.data = {"cols": [
                {id: "t", label: "Topping", type: "string"},
                {id: "s", label: "Slices", type: "number"}
            ], "rows": listeChartObjectPrive};
            $scope.ChartObjectPrive.options = {
                'title': 'Statistiques effectif privé'
            }
        };
        
        function statAllSexeByEffectif() {
            $scope.listeAllBySexe = [];
            angular.forEach($scope.listeForAllStat, function(value, key) {
               var nomDepartement = value.nomDepartement;
               var effectifHommePrive = 0;
               var effectifFemmePub = 0;
               var effectifFemmePrive = 0;
               var effectifHommePub = 0;
               angular.forEach($scope.listeForAllStat, function(value, key) {
                   if(value.nomDepartement == nomDepartement) {
                       if(value.statut == "prive") {
                           if (value.sexe == "masculin") {
                              effectifHommePrive++;
                           }else {
                              effectifFemmePrive++;
                           }
                       }else {
                           if (value.sexe == "masculin") {
                              effectifHommePub++;
                           }else {
                              effectifFemmePub++;
                           }
                       }
                   }
               });
               var exist = 0;
               if($scope.listeAllBySexe.length == 0) {
                   $scope.listeAllBySexe.push({
                        'nomDepartement': nomDepartement, 
                        'effectifHommePrive' : effectifHommePrive,
                        'effectifHommePub' : effectifHommePub,
                        'effectifFemmePrive' : effectifFemmePrive,
                        'effectifFemmePub' : effectifFemmePub
                     });
               }else {
                   angular.forEach($scope.listeAllBySexe, function(value, key) {
                       if(value.nomDepartement == nomDepartement) {
                           exist++;
                       }
                   });
                   if(exist == 0) {
                     $scope.listeAllBySexe.push({
                        'nomDepartement': nomDepartement, 
                        'effectifHommePrive' : effectifHommePrive,
                        'effectifHommePub' : effectifHommePub,
                        'effectifFemmePrive' : effectifFemmePrive,
                        'effectifFemmePub' : effectifFemmePub
                     });
                   }   
               }
               
            });
            $scope.afficheChartSexeByEffectif($scope.listeAllBySexe);
        }

        $scope.afficheChartSexeByEffectif = function(liste) {
            $scope.ChartObjectPub = []; 
            $scope.ChartObjectPrive = []; 
            $scope.ChartObjectPub.type = "ColumnChart";
            $scope.ChartObjectPrive.type = "ColumnChart";
            var listeChartObjectPub = [];
            var listeChartObjectPrive = [];
            angular.forEach(liste, function(value, key) {
                listeChartObjectPub.push({
                    c : [ {v:value.nomDepartement},
                          {v: Number(value.effectifHommePub)},
                          {v: Number(value.effectifFemmePub)}
                        ]
                }) 
            });
            angular.forEach(liste, function(value, key) {
                listeChartObjectPrive.push({
                    c : [ {v:value.nomDepartement},
                          {v: Number(value.effectifHommePrive)},
                          {v: Number(value.effectifFemmePrive)}
                        ]
                })
            });
            $scope.ChartObjectPub.data = {"cols": [
                {id: "t", label: "Topping", type: "string"},
                {id: "s", label: "Homme", type: "number"},
                {id: "s", label: "Femme", type: "number"}
            ], "rows": listeChartObjectPub};
            $scope.ChartObjectPub.options = {
                'title': 'Statistiques par sexe au sein du public'
            };
            $scope.ChartObjectPrive.data = {"cols": [
                {id: "t", label: "Topping", type: "string"},
                {id: "s", label: "Homme", type: "number"},
                {id: "s", label: "Femme", type: "number"}
            ], "rows": listeChartObjectPrive};
            $scope.ChartObjectPrive.options = {
                'title': 'Statistiques par sexe au sein du privé'
            };
        };
        
        function statAll_ByNiveau() {
            var listeAll = [];
            angular.forEach($scope.listeForAllStat, function(value, key) {
               var nomDepartement = value.nomDepartement;
               var effectifPriveN1 = 0;
               var effectifPubN1 = 0;
               var effectifPriveN2 = 0;
               var effectifPubN2 = 0;
               var effectifPriveN3 = 0;
               var effectifPubN3 = 0;
               angular.forEach($scope.listeForAllStat, function(value, key) {
                   if(value.nomDepartement == nomDepartement) {
                       if(value.statut == "prive") {
                           if(value.niveau == "1") {
                              effectifPriveN1++;   
                           }
                           if(value.niveau == "2") {
                              effectifPriveN2++;   
                           }
                           if(value.niveau == "3") {
                              effectifPriveN3++;   
                           }
                       }else {
                           if(value.niveau == "1") {
                               effectifPubN1++;
                           }
                           if(value.niveau == "2") {
                               effectifPubN2++;
                           }
                           if(value.niveau == "3") {
                               effectifPubN3++;
                           }
                       }
                   }
               });
               var exist = 0;
               if(listeAll.length == 0) {
                   listeAll.push({
                        'nomDepartement': nomDepartement, 
                        'effectifPubN1' : effectifPubN1,
                        'effectifPubN2' : effectifPubN2,
                        'effectifPubN3' : effectifPubN3,
                        'effectifPriveN1' : effectifPriveN1,
                        'effectifPriveN2' : effectifPriveN3,
                        'effectifPriveN3' : effectifPriveN3
                     });
               }else {
                   angular.forEach(listeAll, function(value, key) {
                   if(value.nomDepartement == nomDepartement) {
                           exist++;
                       }
                   });
                   if(exist == 0) {
                     listeAll.push({
                        'nomDepartement': nomDepartement, 
                        'effectifPubN1' : effectifPubN1,
                        'effectifPubN2' : effectifPubN2,
                        'effectifPubN3' : effectifPubN3,
                        'effectifPriveN1' : effectifPriveN1,
                        'effectifPriveN2' : effectifPriveN3,
                        'effectifPriveN3' : effectifPriveN3
                     });
                   }   
               }
            });
            $scope.afficheChartAll_ByNiveau(listeAll);
        }
        
        $scope.afficheChartAll_ByNiveau = function (liste) {
            $scope.ChartObjectPub = []; 
            $scope.ChartObjectPrive = [];
            $scope.ChartObjectPub.type = "ColumnChart";
            $scope.ChartObjectPrive.type = "ColumnChart";
            var listeChartObjectPub = [];
            var listeChartObjectPrive = [];
            
            angular.forEach(liste, function(value, key) {
                listeChartObjectPub.push({
                    c : [ {v:value.nomDepartement},
                          {v: Number(value.effectifPubN1)},  
                          {v: Number(value.effectifPubN2)},
                          {v: Number(value.effectifPubN3)},
                        ]
                }) 
            });
            angular.forEach(liste, function(value, key) {
                listeChartObjectPrive.push({
                    c : [ {v:value.nomDepartement},
                          {v: Number(value.effectifPriveN1)},
                          {v: Number(value.effectifPriveN2)},
                          {v: Number(value.effectifPriveN3)}
                        ]
                })
            });
            
            $scope.ChartObjectPub.data = {"cols": [
                {id: "t", label: "Topping", type: "string"},
                {id: "s", label: "Niveau 1", type: "number"},
                {id: "s", label: "Niveau 2", type: "number"},
                {id: "s", label: "Niveau 3", type: "number"}
            ], "rows": listeChartObjectPub};
            $scope.ChartObjectPub.options = {
                'title': 'Statistiques par niveau au sein du public'
            };
            
            $scope.ChartObjectPrive.data = {"cols": [
                {id: "t", label: "Topping", type: "string"},
                {id: "s", label: "Niveau 1", type: "number"},
                {id: "s", label: "Niveau 2", type: "number"},
                {id: "s", label: "Niveau 3", type: "number"}
            ], "rows": listeChartObjectPrive};
            $scope.ChartObjectPrive.options = {
                'title': 'Statistiques par niveau au sein du privé'
            };
        } 
        
        
        $scope.statAll_ByNationalite = function () {
            $scope.listeAllNationalite = [];
            angular.forEach($scope.listeForAllStat, function(value, key) {
               var nomDepartement = value.nomDepartement;
               var effectifSenegalPrive = 0;
               var effectifEtrangerPrive = 0;
               var effectifSenegalPub = 0;
               var effectifEtrangerPub = 0;
               angular.forEach($scope.listeForAllStat, function(value, key) {
                   if(value.nomDepartement == nomDepartement) {
                       if(value.statut == "prive") {
                           if (value.nationalite == "Senegalaise") {
                              effectifSenegalPrive++;
                           }else {
                              effectifEtrangerPrive++;
                           }
                       }else {
                           if (value.nationalite == "Senegalaise") {
                              effectifSenegalPub++;
                           }else {
                              effectifEtrangerPub++;
                           }
                       }
                   }
               });
               var exist = 0;
               if($scope.listeAllByNationalite.length == 0) {
                   $scope.listeAllByNationalite.push({
                        'nomDepartement': nomDepartement, 
                        'effectifSenegalPrive' : effectifSenegalPrive,
                        'effectifSenegalPub' : effectifSenegalPub,
                        'effectifEtrangerPrive' : effectifEtrangerPrive,
                        'effectifEtrangerPub' : effectifEtrangerPub
                     });
               }else {
                   angular.forEach($scope.listeAllByNationalite, function(value, key) {
                       if(value.nomDepartement == nomDepartement) {
                           exist++;
                       }
                   });
                   if(exist == 0) {
                     $scope.listeAllByNationalite.push({
                        'nomDepartement': nomDepartement, 
                        'effectifSenegalPrive' : effectifSenegalPrive,
                        'effectifSenegalPub' : effectifSenegalPub,
                        'effectifEtrangerPrive' : effectifEtrangerPrive,
                        'effectifEtrangerPub' : effectifEtrangerPub
                     });
                   }   
               }
        });
        $scope.afficheChartNationalite_ByEffectif($scope.listeAllByNationalite);
        }
        
        
        $scope.afficheChartNationalite_ByEffectif = function(liste) {
            $scope.ChartObjectPub = []; 
            $scope.ChartObjectPrive = []; 
            $scope.ChartObjectPub.type = "ColumnChart";
            $scope.ChartObjectPrive.type = "ColumnChart";
            var listeChartObjectPub = [];
            var listeChartObjectPrive = [];
            angular.forEach(liste, function(value, key) {
                listeChartObjectPub.push({
                    c : [ {v:value.nomDepartement},
                          {v: Number(value.effectifSenegalPub)},
                          {v: Number(value.effectifEtrangerPub)}
                        ]
                }) 
            });
            angular.forEach(liste, function(value, key) {
                listeChartObjectPrive.push({
                    c : [ {v:value.nomDepartement},
                          {v: Number(value.effectifSenegalPrive)},
                          {v: Number(value.effectifEtrangerPrive)}
                        ]
                })
            });
            $scope.ChartObjectPub.data = {"cols": [
                {id: "t", label: "Topping", type: "string"},
                {id: "s", label: "Sénégalais", type: "number"},
                {id: "s", label: "Étranger", type: "number"}
            ], "rows": listeChartObjectPub};
            $scope.ChartObjectPub.options = {
                'title': 'Statistiques par nationalité au sein du public'
            };
            $scope.ChartObjectPrive.data = {"cols": [
                {id: "t", label: "Topping", type: "string"},
                {id: "s", label: "Sénégalais", type: "number"},
                {id: "s", label: "Étranger", type: "number"}
            ], "rows": listeChartObjectPrive};
            $scope.ChartObjectPrive.options = {
                'title': 'Statistiques par nationalité au sein du privé'
            };
        };
}]);