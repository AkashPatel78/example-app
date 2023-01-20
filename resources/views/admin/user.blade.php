
@include('admin.include.header')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item active" aria-current="page"><h6>User</h6></li>
    </ol>
</nav>
<div class="container mt-5">

    <div class="row">
        <div class="col-md-10">
        {{-- Edit Model Start  --}}
            <div class="modal fade" id="editEmployeeModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                data-bs-backdrop="static" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Rented Book</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form action="#" method="POST" id="edit_employee_form" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" id="id">
                            <input type="hidden" name="emp_avatar" id="emp_avatar">
                            <div class="modal-body p-4 bg-light">
                                <div class="row">
                                    <div class="col-lg" id="view-user-rent-list">

                                        <table>

                                            <thead>
                                              <tr>
                                                <th>#</th>
                                                <th>Book Name</th>
                                              </tr>
                                            </thead>
                                            <tbody id="tBody"></tbody>
                                          </table>
                                    </div>

                                </div>




                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

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
                        <th>Email</th>
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
            ajax: '{!! route('reg.user') !!}',

            columns: [{
                    data: 'id'
                },
                {
                    data: 'name'
                },
                {
                    data: 'email'
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




        // edit auther ajax request
        $(document).on('click', '.editIcon', function(e) {
            e.preventDefault();
            let id = $(this).attr('id');
            $('#tBody').html("");
            $.ajax({
                url: '{{ route('rentbook') }}',
                method: 'get',
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    console.log(response);
                    // var userRentDetails = `<table class="table">
                    //     <thead>
                    //         <tr>
                    //             <th>#</th>
                    //             <th>Book Name</th>
                    //         </tr>
                    //     </thead>`


                    //     <tbody>
                    //         <tr>
                    //             <td scope="row"></td>
                    //             <td></td>
                    //         </tr>
                    //     </tbody>
                    // </table>`;
                    // $('#view-user-rent-list').html(userRentDetails);
                    var trHTML = '';
                        $.each(response, function (i, userData) {
                                trHTML +=
                                    '<tr><td>'+
                            userData.ord_id
                                    + '</td><td>'
                                    + userData.bookName
                                    + '</td></tr>';

                        });
                        $('#tBody').html(trHTML);
                }
            });
        });

        // update auther ajax request
        // $("#edit_employee_form").submit(function(e) {
        //     e.preventDefault();
        //     const fd = new FormData(this);
        //     $("#edit_employee_btn").text('Updating...');
        //     $.ajax({
        //         url: '{{ route('updateauth') }}',
        //         method: 'post',
        //         data: fd,
        //         cache: false,
        //         contentType: false,
        //         processData: false,
        //         dataType: 'json',
        //         success: function(response) {
        //             if (response.status == 200) {
        //                 Swal.fire(
        //                     'Updated!',
        //                     'Employee Updated Successfully!',
        //                     'success'
        //                 )
        //                 fetchAllEmployees();
        //             }
        //             $("#edit_employee_btn").text('Update Employee');
        //             $("#edit_employee_form")[0].reset();
        //             $("#editEmployeeModal").modal('hide');
        //         }
        //     });
        // });




    });
</script>


@include('admin.include.footer')
