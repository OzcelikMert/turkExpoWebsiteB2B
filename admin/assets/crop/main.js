  angular.module('app', ['ngImgCrop'])

    .controller('Ctrl', function ($scope) {
      $scope.myImage = '';
      $scope.myCroppedImage = '';

      var handleFileSelect = function (evt) {
        var file = evt.currentTarget.files[0];
        var reader = new FileReader();
        reader.onload = function (evt) {
          $scope.$apply(function ($scope) {
            $scope.myImage = evt.target.result;
          });
        };
        reader.readAsDataURL(file);
        $("#cropted").css("z-index", "2");
      };
      angular.element(document.querySelector('#fileInput')).on('change', handleFileSelect);
    });
