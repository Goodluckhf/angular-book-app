'use strict';

angular.module('bookList')
    .component('bookList', {
        templateUrl: '/js/book-list/book-list.template.html',
        controller: ['Book', '$log', '$rootScope', '$location', function(Book, $log, $rootScope, $location) {
            var self = this;

            self.loading = false;
            self.q = '';
            self.isError = false;
            self.currentPage = 1;
            self.books = [];
            self.sorted = {
                name: '',
                author: ''
            };

            var inverseSort = function(direction) {
                if(direction === 'asc') {
                    return 'desc';
                }

                return 'asc';
            };

            var showError = function(e) {
                angular.copy([], self.books);
                //console.log();
                self.isError = true;
                self.errorMessage = e.data.message;
            };

            var getData = function() {
                self.loading = true;
                self.isError = false;

                return Book.query({
                    sort: self.sorted,
                    q: self.q,
                    page: self.currentPage
                }).$promise.then(function(data) {
                    self.currentPage = data.current_page;
                    self.totalItems = data.total;
                    angular.copy(data.data, self.books);
                }).catch(function(err) {
                    showError(err);
                }).finally(function() {
                    self.loading = false;
                });
            };

            getData();

            self.sortByName = function() {
                self.sorted.name = inverseSort(self.sorted.name);
                getData();
            };

            self.sortByAuthor = function() {
                self.sorted.author = inverseSort(self.sorted.author);
                getData();
            };

            self.pageChanged = function() {
                getData();
            };

            self.add = function() {
                $location.path('/books/add');
            };

            self.searchChanged = $rootScope.helpers.throttle(getData, 500)
        }]
});