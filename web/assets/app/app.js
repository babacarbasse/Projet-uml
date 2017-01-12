'use strict';
var app = angular.module('gestionScolorite', ['googlechart','datatables','datatables.buttons']); 

app.config(function ($interpolateProvider) {
    $interpolateProvider.startSymbol('[[');
    $interpolateProvider.endSymbol(']]');
})