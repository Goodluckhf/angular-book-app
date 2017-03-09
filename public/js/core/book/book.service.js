'use strict';

angular.module('core.book')
    .factory('Book', [ '$resource',
        function($resource) {
            return $resource('/api/Book.:method', {}, {
                query: {
                    method: 'GET',
                    isArray: false,
                    params : {
                        method: 'getList'
                    }
                },
                byId: {
                    method: 'GET',
                    isArray: false,
                    params: {
                        method: 'getById'
                    }
                },
                remove: {
                    method: 'POST',
                    isArray: false,
                    params: {
                        method: 'remove'
                    }
                },
                save: {
                    method: 'POST',
                    isArray: false,
                    headers: {'Content-Type': undefined},
                    transformRequest: angular.identity,
                    params: {
                        method: 'edit',
                    }
                },
                create: {
                    method: 'POST',
                    isArray: false,
                    headers: {'Content-Type': undefined},
                    transformRequest: angular.identity,
                    params: {
                        method: 'add',
                    }
                }
            });
        }
]);