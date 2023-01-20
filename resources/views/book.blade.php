<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD</title>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/css/bootstrap.min.css' />
    <link rel='stylesheet'
        href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css' />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.css" />

</head>

<body>

    @include('admin.include.navbar')


    <div class="modal fade" id="addEmployeeModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        data-bs-backdrop="static" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Book</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="#" method="POST" id="add_employee_form" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body p-4 bg-light">
                        <div class="row">
                            <div class="col-lg">
                                <label for="name">Book Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Book Name"
                                    required>
                            </div>
                            <div class="col-lg">

                                <label for="cat_id">Category</label>
                                <select class="form-control" name="cat_id" id="cat_id">
                                    @foreach ($cat as $row)
                                        <option value="{{ $row->id }}">{{ $row->name }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="my-2">

                            <label for="cat_id">Authors</label>
                            <select class="form-control" name="auther_id" id="auther_id">
                                @foreach ($auther as $row)
                                    <option value="{{ $row->id }}">{{ $row->name }} </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="my-2">
                            <label for="avatar">Book Image</label>
                            <input type="file" name="avatar" class="form-control" required>
                        </div>
                        <div class="my-2">
                            <label for="pdf">Book Pdf</label>
                            <input type="file" name="pdf" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" id="add_employee_btn" class="btn btn-primary">Add Book</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- add new book modal end --}}

    {{-- edit book modal start --}}
    <div class="modal fade" id="editEmployeeModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        data-bs-backdrop="static" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Book</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="#" method="POST" id="edit_employee_form" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="emp_id" id="emp_id">
                    <input type="hidden" name="emp_avatar" id="emp_avatar">
                    <div class="modal-body p-4 bg-light">
                        <div class="row">
                            <div class="col-lg">
                                <label for="name">Book Name</label>
                                <input type="text" name="name" id="name" class="form-control" required>
                            </div>
                            <div class="col-lg">

                                <label for="cat_id">Category</label>
                                <select class="form-control" name="cat_id" id="cat_id">
                                    @foreach ($cat as $row)
                                        <option value="{{ $row->id }}">{{ $row->name }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="my-2">
                            <select class="form-control" name="auther_id" id="auther_id">
                                @foreach ($auther as $row)
                                    <option value="{{ $row->id }}">{{ $row->name }} </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="my-2">
                            <label for="avatar">Select Image</label>
                            <input type="file" name="avatar" class="form-control">
                        </div>
                        <div class="mt-2" id="avatar">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" id="edit_employee_btn" class="btn btn-success">Update
                            Book</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- edit employee modal end --}}

    <body>

        <div class="container">

            <div class="row my-5">

                <div class="col-lg-12">
                    <div class="card shadow">
                        <div class="card-header bg-dark d-flex justify-content-between align-items-center">
                            <h3 class="text-light">Book</h3>
                            <button class="btn btn-light" data-bs-toggle="modal"
                                data-bs-target="#addEmployeeModal"><i class="bi-plus-circle me-2"></i>Add New
                                Book</button>
                        </div>
                        <div class="card-body" id="show_all_employees">
                            <h1 class="text-center text-secondary my-5">Loading...</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        </nav>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.bundle.min.js'></script>
        <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.js"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            $(function() {

                // add new book ajax request
                $("#add_employee_form").submit(function(e) {
                    e.preventDefault();
                    const fd = new FormData(this);
                    $("#add_employee_btn").text('Adding...');
                    $.ajax({
                        url: '{{ route('store') }}',
                        method: 'post',
                        data: fd,
                        cache: false,
                        contentType: false,
                        processData: false,
                        dataType: 'json',
                        success: function(response) {
                            if (response.status == 200) {
                                Swal.fire(
                                    'Added!',
                                    'Employee Added Successfully!',
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

                // edit book ajax request
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
                        success: function(response) {
                            $("#name").val(response.name);
                            $("#cat_id").val(response.cat_id);

                            $("#auther_id").val(response.auther_id);

                            $("#avatar").html(
                                `<img src="storage/images/${response.avatar}" width="100" class="img-fluid img-thumbnail">`
                            );
                            $("#emp_id").val(response.id);
                            $("#emp_avatar").val(response.avatar);
                        }
                    });
                });

                // update employee ajax request
                $("#edit_employee_form").submit(function(e) {
                    e.preventDefault();
                    const fd = new FormData(this);
                    $("#edit_employee_btn").text('Updating...');
                    $.ajax({
                        url: '{{ route('update') }}',
                        method: 'post',
                        data: fd,
                        cache: false,
                        contentType: false,
                        processData: false,
                        dataType: 'json',
                        success: function(response) {
                            if (response.status == 200) {
                                Swal.fire(
                                    'Updated!',
                                    'Book Updated Successfully!',
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

                // delete employee ajax request
                $(document).on('click', '.deleteIcon', function(e) {
                    e.preventDefault();
                    let id = $(this).attr('id');
                    let csrf = '{{ csrf_token() }}';
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
                                method: 'delete',
                                data: {
                                    id: id,
                                    _token: csrf
                                },
                                success: function(response) {
                                    console.log(response);
                                    Swal.fire(
                                        'Deleted!',
                                        'Your file has been deleted.',
                                        'success'
                                    )
                                    fetchAllEmployees();
                                }
                            });
                        }
                    })
                });

                // fetch all book ajax request
                fetchAllEmployees();

                function fetchAllEmployees() {
                    $.ajax({
                        url: '{{ route('fetchAll') }}',
                        method: 'get',
                        success: function(response) {
                            $("#show_all_employees").html(response);
                            $("table").DataTable({
                                order: [0, 'desc']
                            });
                        }
                    });
                }
            });
        </script>
    </body>

</html>
