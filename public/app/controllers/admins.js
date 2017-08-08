app.controller('adminsController', function($scope, $http, API_URL) {
    //retrieve employees listing from API
    $http.get(API_URL + "admins")
            .success(function(response) {
                $scope.admins = response;
            });

    //show modal form
    $scope.toggle = function(modalstate, id) {
        $scope.modalstate = modalstate;
        switch (modalstate) {
            case 'add':
                $scope.form_title = "Yeni Admin Ekle";
                break;
            case 'edit':
                $scope.form_title = "Admin Düzenle";
                $scope.id = id;
                $http.get(API_URL + 'admins/' + id)
                        .success(function(response) {
                            console.log(response);
                            $scope.admin = response;
                        });
                break;
            default:
                break;
        }
        console.log(id);
        $('#myModal').modal('show');
    }

    //save new record / update existing record
    $scope.save = function(modalstate, id) {
        var url = API_URL + "admins";
        //append employee id to the URL if the form is in edit mode
        if (modalstate === 'edit'){
            url += "/" + id;
        }

        $http({
            method: 'POST',
            url: url,
            data: $.param($scope.admin),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).success(function(response) {
            console.log(response);
            location.reload();
        }).error(function(response) {
            console.log(response);
            alert('This is embarassing. An error has occured. Please check the log for details');
        });
    }

    //delete record
    $scope.confirmDelete = function(id) {
        var isConfirmDelete = confirm('Are you sure you want to DELETE this record?');
        if (isConfirmDelete) {
            alert(API_URL);
            $http({
                method: 'DELETE',
                url: API_URL + 'admins/'+ id

            }).
                    success(function(data) {
                        console.log(data);
                        location.reload();
                    }).
                    error(function(data) {
                        console.log(data);
                        alert('Unable to delete');
                    });
        } else {
            return false;
        }
    }
});
