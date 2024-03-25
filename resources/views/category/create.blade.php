<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{csrf_token()}}"/>
    <title>Create Category</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">  
</head>
<body>
    
    <!-- Modal -->
    <div class="modal fade ajax-modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <form id="ajaxForm" method="POST">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-title"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <div class="row">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control">
                                <span id="nameError" class="text-danger error-messages"></span>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <div class="row">
                                <label for="type">Type</label>
                                <select name="type" class="form-control">
                                    <option value="">--Choose Option--</option>
                                    <option value="Electronic">Electronic</option>
                                </select>
                                <span id="typeError" class="text-danger error-messages"></span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="saveBtn"></button>
                    </div>
                </div>
            </div>
        </form>
    </div>     

    <div class="row">
        <div class="col-md-6 offset-3 mb-3" style="margin-top: 100px">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Category</button>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Type</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
                
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>

    <script>
        $(document).ready(function() {

            fetchCategory();

            function fetchCategory() {
                $.ajax({
                    type: "GET",
                    url: "/fetch-category",
                    dataType: "json",
                    success:function (response) {
                        $('tbody').html("");
                        // console.log(response.categories);
                        $.each(response.categories, function (key, item) {
                            $('tbody').append('<tr>\
                            <td>'+item.id+'</td>\
                            <td>'+item.name+'</td>\
                            <td>'+item.type+'</td>\
                            <td><button type="button" value="'+item.id+'" class="edit_student btn btn-primary btn-sm ">Edit</button></td>\
                            <td><button type="button" value="'+item.id+'" class="delete_student btn btn-danger btn-sm ">Delete</button></td>\
                        </tr>');
                        })
                    }
                })
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#modal-title').html('Create Category');
            $('#saveBtn').html('Save Category');
            var form = $('#ajaxForm')[0];
            $('#saveBtn').click(function() {

                $('.error-messages').html('');

                var formData = new FormData(form);

                $.ajax({
                    url: '{{ route("category.store") }}',
                    method: 'POST',
                    processData: false,
                    contentType: false,
                    data: formData,

                    success: function(response){

                        //Hide modal after submitting data
                        $('.ajax-modal').modal('hide');
                        swal("Success!", response.success,"success");
                    },
                    error: function(error) {
                        if(error) {
                            console.log(error.responseJSON.errors.name)
                            $('#nameError').html(error.responseJSON.errors.name);
                            $('#typeError').html(error.responseJSON.errors.type);
                            fetchCategory();
                        }
                    }
                });

            })
        });
    </script>
</body>
</html>