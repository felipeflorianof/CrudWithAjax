<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud with Ajax</title>
    
    <!-- !important -->

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.11.3/datatables.min.css"/>
  <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.11.3/datatables.min.js"></script>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/css/bootstrap.min.css' />
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css' />

</head>
<body>

{{-- Table --}}

<div class="container py-5">
    <div class="row my-5">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header bg-danger d-flex justify-content-between align-items-center">
                    <h3 class="text-light">Manage Employees</h3>
                    <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addEmployeeModal"><i class="bi-plus-circle me-2"></i>Add New Employee</button>
                </div>
                <div class="card-body" id="show_all_employees">
                    <table class="table table-bordered datatable" data-search="true">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="select-all"></th>
                                <th>ID</th>
                                <th>Name</th>
                                <th>E-mail</th>
                                <th>Job position</th>
                                <th>Phone</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody><button type="button" class="btn btn-danger" id="deleteSelected" style="margin-bottom: 10px;">Delete Selected</button>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- End Table --}}

{{-- add new employee modal start --}}
<div class="modal fade" id="addEmployeeModal" tabindex="-1" aria-labelledby="exampleModalLabel"
  data-bs-backdrop="static" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Employee</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="#" method="POST" id="add_employee_form" enctype="multipart/form-data">
        @csrf
        <div class="modal-body p-4 bg-light">
          <div class="row">
            <div class="col-lg">
              <label for="fname">First Name</label>
              <input type="text" name="fname" class="form-control" placeholder="First Name" required>
            </div>
            <div class="col-lg">
              <label for="lname">Last Name</label>
              <input type="text" name="lname" class="form-control" placeholder="Last Name" required>
            </div>
          </div>
          <div class="my-2">
            <label for="email">E-mail</label>
            <input type="email" name="email" class="form-control" placeholder="E-mail" required>
          </div>
          <div class="my-2">
            <label for="phone">Phone</label>
            <input type="tel" name="phone" class="form-control" placeholder="Phone" required>
          </div>
          <div class="my-2">
            <label for="post">Post</label>
            <input type="text" name="post" class="form-control" placeholder="Post" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" id="add_employee_btn" class="btn btn-primary">Add Employee</button>
        </div>
      </form>
    </div>
  </div>
</div>
{{-- add new employee modal end --}}

{{-- edit employee modal start --}}
<div class="modal fade" id="editEmployeeModal" tabindex="-1" aria-labelledby="exampleModalLabel"
  data-bs-backdrop="static" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Employee</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="#" method="POST" id="edit_employee_form" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="emp_id" id="emp_id">
        <div class="modal-body p-4 bg-light">
          <div class="row">
            <div class="col-lg">
              <label for="fname">First Name</label>
              <input type="text" name="fname" id="fname" class="form-control" placeholder="First Name" required>
            </div>
            <div class="col-lg">
              <label for="lname">Last Name</label>
              <input type="text" name="lname" id="lname" class="form-control" placeholder="Last Name" required>
            </div>
          </div>
          <div class="my-2">
            <label for="email">E-mail</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="E-mail" required>
          </div>
          <div class="my-2">
            <label for="phone">Phone</label>
            <input type="tel" name="phone" id="phone" class="form-control" placeholder="Phone" required>
          </div>
          <div class="my-2">
            <label for="post">Post</label>
            <input type="text" name="post" id="post" class="form-control" placeholder="Post" required>
          </div>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" id="edit_employee_btn" class="btn btn-success">Update Employee</button>
        </div>
      </form>
    </div>
  </div>
</div>
{{-- edit employee modal end --}}

    <!-- !important -->
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.bundle.min.js'></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>

  fetchAllEmployees();

  // Inicialize a variável da tabela fora do escopo da função fetchAllEmployees()
    var table;

    $(document).ready(function() {
        // Inicialize a tabela DataTable
        table = $('.datatable').DataTable({
            // Opções da tabela DataTable
        });
    });
  
    // fetch all data using ajax request
    function fetchAllEmployees() {
        $.ajax({
            url: '{{ route('fetchAll') }}',
            method: 'get',
            dataType: "json",
            success: function (response) {
              if (table) {
                  table.destroy();
              }
                $('tbody').html("");
                $.each(response.emps, function (key, item) {
                    $('tbody').append(
                        '<tr>\
                            <td><input type="checkbox" name="emp[]" value="' + item.id + '"></td>\
                            <td>'+ item.id +'</td>\
                            <td>'+ item.first_name +' '+ item.last_name +'</td>\
                            <td>'+ item.email +'</td>\
                            <td>'+ item.post +'</td>\
                            <td>'+ item.phone +'</td>\
                            <td>\
                                <a href="#" id="'+ item.id +'" class="editIcon" data-bs-toggle="modal" data-bs-target="#editEmployeeModal"><i class="bi-pencil-square h4"></i></a>\
                                <a href="#" id="'+ item.id +'" class="text-danger mx-1 deleteIcon" ><i class="bi-trash h4"></i></a>\
                            </td>\
                        </tr>'
                    );
                });
                table = $('.datatable').DataTable({
                    order: [1, "desc"],
                    paging: true,
                    responsive: true
                });
              }
        });
    }

      // delete employee using ajax request
      $(document).on('click', '.deleteIcon', function(e) {
        e.preventDefault();
        let id = $(this).attr('id');

        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              url: '{{ route('delete') }}',
              method: 'post',
              data: {
                id: id,
                _token : '{{ csrf_token() }}'
              },
              success: function(res) {
                Swal.fire(
                  'Deleted!',
                  'Your file has been deleted.',
                  'success'
                ) 
                fetchAllEmployees();
              }
            })
          }
        });
      });

      // delete multiple data using ajax request
      $(document).on('click', '#select-all', function(e) {
        if ($(this).is(':checked')) {
          $('input[name="emp[]"]').prop('checked', true);
        }
        else {
          $('input[name="emp[]"]').prop('checked', false);
        }
      });
       $(document).on('click', '#deleteSelected', function(e) {
        e.preventDefault();

        // Check if any records are selected
        if (!$('input[name="emp[]"]:checked').length) {
          Swal.fire(
            'Error!',
            'Please select at least one record to delete.',
            'error'
          )
          return;
        }

        let ids = [];
       // iterate over selected checkboxes to get IDs of selected records
       $('input[name="emp[]"]:checked').each(function () {
          ids.push($(this).val());
       });
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
            if (result.isConfirmed) {
              $.ajax({
                url: '{{ route('deleteSelected') }}',
                method: 'post',
                data: {
                  emp: ids,
                  _token : '{{ csrf_token() }}'
                },
                success: function(res) {
                  Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                  ) 
                  $('input[name="emp[]"]:checked').each(function() {
                      $(this).prop('checked', false);
                  });
                  fetchAllEmployees();
                }
              })
            }
          });
      });

      // update employee using ajax
      $("#edit_employee_form").submit(function(e){
        e.preventDefault();
        const fd = new FormData(this);
        $("#edit_employee_btn").text('Updating...');
        $.ajax({
          url: '{{ route('update') }}',
          method: 'post',
          data: fd,
          cache: false,
          processData: false,
          contentType: false,
          dataType: 'json',
          success: function(res) {
            if(res.status == 200) {
              Swal.fire(
                'Updated!',
                'Employee successfully updated!',
                'success'
              )
              fetchAllEmployees();
            }
            $("#edit_employee_btn").text('Update Employee');
            $("#edit_employee_form")[0].reset();
            $("#editEmployeeModal").modal('hide');
          }
        });
      });

      // edit employee using ajax
        $(document).on('click', '.editIcon', function(e) {
          e.preventDefault();
          let id = $(this).attr('id');
          $.ajax({
            url: '{{ route('edit') }}',
            method: 'get',
            data: {
              id: id,
              _token: '{{ csrf_token() }}'
            },
            success: function(res) {
            $("#fname").val(res.first_name);
            $("#lname").val(res.last_name);
            $("#email").val(res.email);
            $("#phone").val(res.phone);
            $("#post").val(res.post);
            $("#emp_id").val(res.id);
            }
          });
        });


      // Add new employee with ajax request
      $("#add_employee_form").submit(function(e){
        e.preventDefault();
        const fd = new FormData(this);
        $("#add_employee_btn").text('Adding...');
        $.ajax({
          url: '{{ route('store') }}',
          method: 'post',
          data: fd,
          cache: false,
          processData: false,
          contentType: false,
          success:function(res){
            if(res.status == 200) {
              Swal.fire(
                'Added!',
                'Employee added successfully!',
                'success'
              )
              fetchAllEmployees();
            }
            $("#add_employee_btn").text('Add Employee');
            $("#add_employee_form")[0].reset();
            $("#addEmployeeModal").modal('hide');
          }
        });
      });

    </script>
    
</body>
</html>