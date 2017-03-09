'use strict';


angular.module('bookApp', [
    'ngRoute',
    'core',
    'bookList',
    'bookDetail',
    'bookEditCreate'

], function($httpProvider) {
    $httpProvider.defaults.headers.common['Content-Type'] = 'application/x-www-form-urlencoded;charset=utf-8';
    $httpProvider.defaults.paramSerializer = '$httpParamSerializerJQLike';
});




