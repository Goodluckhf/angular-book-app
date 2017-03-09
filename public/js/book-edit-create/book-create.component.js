'use strict';

angular.module('bookEditCreate')
    .component('bookCreate', {
        templateUrl: '/js/book-edit-create/book-edit-create.template.html',
        controller: ['Book', '$location', function(Book, $location) {
            var self = this;
            self.editing = false;

            self.add = function() {
                var formData = new FormData();
                formData.append('name', self.book.name);
                formData.append('author', self.book.author);
                formData.append('description', self.book.description);
                if(self.book.year) {
                    formData.append('year', self.book.year);
                }
                formData.append('image', self.file);

                Book.create(formData, function(response) {
                    $location.path('/book/' + response.id);
                }, function(err) {
                   console.log(err);
                });

            };

            self.cancel = function() {
                $location.path('/');
            };
        }]
});