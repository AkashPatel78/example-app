@include('admin.include.header')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">
            <h6>Auther</h6>
        </li>
    </ol>
</nav>
<div class="container mt-5">

    <div class="row">
        <div class="col-md-10">
            <div class="mb-3" style="float:right">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Add Author
                </button>
            </div>

            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Author</h5>

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div id="message" class="mt-2"></div>
                        <div class="modal-body">
                            <form action="" method="POST" id="frm" enctype="multipart/form-data">
                                @csrf

                                <div class="mb-3">
                                    <label for="">Author Name</label>
                                    <input type="text" name="name" required class="form-control">
                                </div>
                                <div class="mb-3">

                                    <input type="hidden" name="status" value="1" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <button type="submit" id="frmSubmit" class="btn btn-primary">Save</button>
                                </div>

                            </form>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                        </div>
                    </div>
                </div>
            </div>
            {{-- Edit Model Start  --}}
            <div class="modal fade" id="editEmployeeModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                data-bs-backdrop="static" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Auther</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close">X</button>
                        </div>
                        <form action="#" method="POST" id="edit_employee_form" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" id="id">
                            <input type="hidden" name="emp_avatar" id="emp_avatar">
                            <div class="modal-body p-4 bg-light">
                                <div class="row">
                                    <div class="col-lg">
                                        <label for="name">Category Name</label>
                                        <input type="text" name="name" id="name" class="form-control"
                                            placeholder="Auther Name" required>
                                    </div>
                                    <div class="col-lg">

                                        <label for="status">Status</label>
                                        <select class="form-control" name="status" id="status">
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                        </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" id="edit_employee_btn" class="btn btn-success">Update
                                    Author</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>




            {{-- Edit Model End --}}

        </div>
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <table id="myTable">
                <thead>
                    <tr>

                        <th>Id</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Action</th>

                    </tr>
                </thead>


            </table>
        </div>
        <div class="col-md-1"></div>



    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.bundle.min.js'></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {

        $('#myTable').DataTable({


            processing: true,
            serverSide: true,
            ajax: '{!! route('get.record') !!}',

            columns: [{
                    data: 'id'
                },
                {
                    data: 'name'
                },
                {
                    data: 'status'
                },
                {
                    data: 'action'
                },
            ]


        });

    });
</script>
<script>
    $(document).ready(function() {

        $('#frm').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: "{{ route('formsubmitauth') }}",
                data: $('#frm').serialize(),
                type: 'post',
                success: function(result) {
                    $('#message').html(result.msg);
                    $("#frm")[0].reset();
                }


            });
        })
        // Delete record
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
                        url: '{{ route('deleteauth') }}',
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
                            $('#myTable').DataTable().ajax.reload();

                            fetchAllEmployees();
                        }
                    });
                }
            })


        });

        // edit auther ajax request
        $(document).on('click', '.editIcon', function(e) {
            e.preventDefault();
            let id = $(this).attr('id');
            $.ajax({
                url: '{{ route('editauth') }}',
                method: 'get',
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    $("#name").val(response.name);
                    $("#status").val(response.status);


                    $("#id").val(response.id);

                }
            });
        });

        // update auther ajax request
        $("#edit_employee_form").submit(function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            $("#edit_employee_btn").text('Updating...');
            $.ajax({
                url: '{{ route('updateauth') }}',
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
                            'Auther Updated Successfully!',
                            'success'
                        )
                        $('#myTable').DataTable().ajax.reload();

                    }
                    $("#edit_employee_btn").text('Update Auther');
                    $("#edit_employee_form")[0].reset();
                    $("#editEmployeeModal").modal('hide');
                }
            });
        });


    });
</script>


@include('admin.include.footer')
