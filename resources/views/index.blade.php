<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.dataTables.min.css">
</head>
<body>
    <div class="container mt-4">
        <h1>User Management</h1>
        <button class="btn btn-primary mb-3" onclick="showAddUserModal()">Add User</button>
        <button class="btn btn-primary mb-3" id="filter-btn">Filter</button>
        <div class="row" id="filter" style="display: none;">
            <div class="col-md-12">
                <form id="filter-form">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="filter_name" name="name" class="form-control" placeholder="Name">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="filter_email" name="email" class="form-control" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label>Gender</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="filter_gender" id="male" value="male">
                            <label class="form-check-label" for="male">Male</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="filter_gender" id="female" value="female">
                            <label class="form-check-label" for="female">Female</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="filter_gender" id="other" value="other">
                            <label class="form-check-label" for="other">Other</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" id="filter_phone" name="phone" class="form-control" placeholder="Phone">
                    </div>
                    <button type="button" class="btn btn-primary" id="filter-btn-data" >Filter</button>
                    <button type="button" class="btn btn-primary" id="filter-btn-reset" >Reset</button>
                </form>
            </div>
        </div>
        <table id="userTable" class="table table-bordered">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>

    <div id="addUserModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addUserForm">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name" class="form-control" placeholder="Name">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label for="profile_image">Profile Image</label>
                            <input type="file" id="profile_image" name="profile_image" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Gender</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="male" value="male">
                                <label class="form-check-label" for="male">Male</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="female" value="female">
                                <label class="form-check-label" for="female">Female</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="other" value="other">
                                <label class="form-check-label" for="other">Other</label>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" id="phone" name="phone" class="form-control" placeholder="Phone">
                        </div>
                        <div class="form-group">
                            <label for="file">File</label>
                            <input type="file" id="file" name="file" class="form-control">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="addUser()">Save</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    
    <div id="editUserModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editUserForm">
                        <input type="hidden" id="edit_user_id" name="user_id">
                        <div class="form-group">
                            <label for="edit_name">Name</label>
                            <input type="text" id="edit_name" name="name" class="form-control" placeholder="Name">
                        </div>
                        <div class="form-group">
                            <label for="edit_email">Email</label>
                            <input type="email" id="edit_email" name="email" class="form-control" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label for="edit_profile_image">Profile Image</label>
                            <input type="file" id="edit_profile_image" name="profile_image" class="form-control">
                            <img id="edit_preview_image" src="" style="max-width: 100%; display: none;">
                        </div>
                        <div class="form-group">
                            <label>Gender</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="edit_gender" id="male" value="male">
                                <label class="form-check-label" for="male">Male</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="edit_gender" id="female" value="female">
                                <label class="form-check-label" for="female">Female</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="edit_gender" id="other" value="other">
                                <label class="form-check-label" for="other">Other</label>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="edit_phone">Phone</label>
                            <input type="text" id="edit_phone" name="phone" class="form-control" placeholder="Phone">
                        </div>
                        <div class="form-group">
                            <label for="edit_file">File</label>
                            <input type="file" id="edit_file" name="file" class="form-control">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="updateUser()">Save Changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js" integrity="sha512-WMEKGZ7L5LWgaPeJtw9MBM4i5w5OSBlSjTjCtSnvFJGSVD26gE5+Td12qN5pvWXhuWaWcVwF++F7aqu9cvqP0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {

    var table = $('#userTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/users',
        columns: [
            { data: 'image', name: 'image' },
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'phone', name: 'phone' },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
    });


    $('#filter-btn-data').click(function() {

        
        var name = $('#filter_name').val();
        var email = $('#filter_email').val();
        var gender = $('input[name="filter_gender"]:checked').val();
        var phone = $('#filter_phone').val();

       
        var url = '/users?name=' + name + '&email=' + email + '&gender=' + gender + '&phone=' + phone;

       
        table.ajax.url(url).load();
    });

    $('#filter-btn-reset').click(function(){
        $('#filter_name').val('');
    $('#filter_email').val('');
    $('input[name="filter_gender"]').prop('checked', false);
    $('#filter_phone').val('');
    })
    window.showAddUserModal = function() {
        $('#addUserModal').modal('show');
    };

  
    window.hideAddUserModal = function() {
        $('#addUserModal').modal('hide');
    };

   
  
        window.addUser = function() {
        
        var formData = new FormData();
        formData.append('name', $('#name').val());
        formData.append('email', $('#email').val());
        formData.append('profile_image', $('#profile_image')[0].files[0]); 
        formData.append('gender', $('input[name="gender"]:checked').val());
        formData.append('phone', $('#phone').val());
        formData.append('file', $('#file')[0].files[0]); 
        formData.append('_token',"{{csrf_token()}}"); 

        $.ajax({
            url: '/users/store',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false, 
            success: function(response) {
              
                if(response.errors){

                let errorMessage;
                $.each(response.errors, function(key, value) {
                    errorMessage += key + ': ' + value.join(', ') + '\n';
                });

              
                alert(errorMessage);
                }else{

                    alert('User is added successfully!');
                    table.ajax.reload();
                $('#addUserModal').modal('hide');
                $('#addUserForm')[0].reset(); 
                }
              
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    };



window.editUser = function(userId) {
    $.ajax({
        url: '/users/'+userId+'/edit' ,
        type: 'GET',
        success: function(response) {
          
            $('#edit_user_id').val(response.id);
            $('#edit_name').val(response.name);
            $('#edit_email').val(response.email);
            $('input[name="edit_gender"][value="' + response.gender + '"]').prop('checked', true);

            $('#edit_phone').val(response.phone);

            // Set profile image preview
            if (response.profile_image) {
                $('#edit_preview_image').attr('src', '/storage/' + response.profile_image).show();
            } else {
                $('#edit_preview_image').hide();
            }

           
            $('#editUserModal').modal('show');
        },
        error: function(xhr) {
            console.log(xhr.responseText);
            alert('Failed to fetch user details.');
        }
    });
};

window.DeleteUser = function(userId) {
    if (confirm('Are you sure you want to delete this user?')) {
    $.ajax({
        url: '/users/delete/'+userId ,
        type: 'GET',
        success: function(response) {
          
        if(response){
            alert('user is deleted successfully!');
            table.ajax.reload();
        }

           
          
        },
        error: function(xhr) {
            console.log(xhr.responseText);
            alert('Failed to fetch user details.');
        }
    });
   }
};
window.updateUser = function() {
        
        var formData = new FormData();
        formData.append('name', $('#edit_name').val());
        formData.append('email', $('#edit_email').val());
        formData.append('profile_image', $('#edit_profile_image')[0].files[0]); 
        formData.append('gender', $('input[name="edit_gender"]:checked').val());
        formData.append('phone', $('#edit_phone').val());
        formData.append('file', $('#edit_file')[0].files[0]); 
        formData.append('_token',"{{csrf_token()}}"); 
        let userId  = $('#edit_user_id').val();

        $.ajax({
            url: '/users/'+userId ,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false, 
            success: function(response) {
              
                if(response.errors){

                let errorMessage;
                $.each(response.errors, function(key, value) {
                    errorMessage += key + ': ' + value.join(', ') + '\n';
                });

              
                alert(errorMessage);
                }else{

                    alert('User is updated successfully');
                    table.ajax.reload();
                $('#editUserModal').modal('hide');
                $('#editUserForm')[0].reset(); 
                }
              
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    };

    $('#filter-btn').click(function() {
            $('#filter').toggle();
        });
});

    </script>
</body>
</html>
