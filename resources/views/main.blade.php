<!doctype html>
<html ng-app="bookApp">
    <head>
        <title>Книги</title>
        <link rel="stylesheet" href="/css/bootstrap.css">
        <link rel="stylesheet" href="/css/app.css">
        <script src="/js/vendor/angular.js"></script>
        <script src="/js/vendor/angular-route.min.js"></script>
        <script src="/js/vendor/angular-resource.min.js"></script>
        <script src="/js/vendor/angular-animate.js"></script>
        <script src="/js/vendor/angular-touch.js"></script>
        <script src="/js/vendor/ui-bootstrap.js"></script>
        <script src="/js/app.module.js"></script>
        <script src="/js/helper.js"></script>
        <script src="/js/core/core.module.js"></script>
        <script src="/js/core/book/book.module.js"></script>
        <script src="/js/core/book/book.service.js"></script>
        <script src="/js/core/file-model/file-model.module.js"></script>
        <script src="/js/core/file-model/file-model.directive.js"></script>
        <script src="/js/app.config.js"></script>
        <script src="/js/book-list/book-list.module.js"></script>
        <script src="/js/book-list/book-list.component.js"></script>
        <script src="/js/book-detail/book-detail.module.js"></script>
        <script src="/js/book-detail/book-detail.component.js"></script>
        <script src="/js/book-edit-create/book-edit-create.module.js"></script>
        <script src="/js/book-edit-create/book-edit.component.js"></script>
        <script src="/js/book-edit-create/book-create.component.js"></script>
    </head>
    <body>
        <div class="container">
            <div ng-view></div>
        </div>

    </body>
</html>