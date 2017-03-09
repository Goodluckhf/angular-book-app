'use strict';

angular.module('bookApp')
    .config([ '$locationProvider', '$routeProvider',
        function($locationProvider, $routeProvider) {
            $locationProvider.hashPrefix('!');
            $routeProvider.
                when('/books', {
                    template: '<book-list></book-list>'
                }).when('/book/:id',{
                    template: '<book-detail></book-detail>'
                }).when('/books/add', {
                    template: '<book-create></book-create>'
                }).when('/book/:id/edit', {
                    template: '<book-edit></book-edit>'
                }).otherwise('/books');
        }

]);