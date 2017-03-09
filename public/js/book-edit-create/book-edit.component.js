'use strict';

angular.module('bookEditCreate')
    .component('bookEdit', {
        templateUrl: '/js/book-edit-create/book-edit-create.template.html',
        controller: ['Book', '$routeParams', '$location', function(Book, $routeParams, $location) {
            var self = this;
            self.id = $routeParams.id;
            self.editing = true;

            Book.byId({id: self.id}, function(book) {
                self.book = book.data;
            }, function(e) {
                self.isError = true;
                self.errorMessage = e.data.message;
            });

            self.cancel = function() {
                $location.path('/');
            };

            self.save = function() {
                var formData = new FormData();
                formData.append('id', self.book.id);
                formData.append('name', self.book.name);
                formData.append('year', self.book.year);
                formData.append('author', self.book.author);
                formData.append('description', self.book.description);
                if(self.file) {
                    formData.append('image', self.file);
                }
                Book.save({}, formData, function(data) {
                    angular.copy(data.data, self.book);
                }, function(er) {
                    console.log(er);
                });

            };

        }]
});