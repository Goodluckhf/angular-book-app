'use strict';

angular.module('bookDetail')
    .component('bookDetail', {
        templateUrl: '/js/book-detail/book-detail.template.html',
        controller: ['Book', '$routeParams', '$location', function(Book, $routeParams, $location) {
            var self = this;
            self.id = $routeParams.id;
            self.isError = false;

            Book.byId({id: self.id}, function(book) {
                self.book = book.data;
            }, function(e) {
                self.isError = true;
                self.errorMessage = e.data.message;
            });

            self.remove = function() {
                if(!confirm("Вы действительно хотите удалить книгу?")) {
                    return;
                }

                Book.remove({id: self.id}, function() {
                    $location.path('/books');
                });
            };

            self.edit = function() {
                $location.path($location.path() + '/edit');
            };

        }]
});