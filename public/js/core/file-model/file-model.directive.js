'use strict';

angular.module('core.fileModel')
    .directive('fileModel', ['$parse', function ($parse) {
        return {
            require: 'ngModel',
            restrict: 'A',
            link: function(scope, element, attrs, ctrl) {
                element.bind('change', function(){

                    var file = element[0].files[0];
                    if(!file) {
                        return;
                    }

                    var extn = file.name.split(".").pop().toLowerCase();
                    ctrl.$setViewValue(ctrl.$name, file.name);
                    //console.log(ctrl);
                    if (attrs.validExtensions != null) {
                        var extensions = attrs.validExtensions.split(',');
                        var validExtension = false;

                        extensions.forEach(function(x) {
                            if (x === extn) {
                                validExtension = true;
                            }
                        });
                        ctrl.$setValidity('type', validExtension);
                    }


                    if (attrs.maxSize != null) {
                        var maxSize = attrs.maxSize;

                        var valid = (file.size / 1024) <= maxSize;
                        ctrl.$setValidity('size', valid);
                    }

                    $parse(attrs.fileModel).assign(scope,file);
                    scope.$apply();
                });
            }
        };
    }]);