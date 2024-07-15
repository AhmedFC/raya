@extends('admin.layouts.admin')
@section('title')
    @lang('admin.users')
@endsection
@section('content')
    <section role="main" class="content-body">
        <header class="page-header">
            <h2> @lang('admin.users')</h2>
        </header>

        <div class="card-body" style="padding:20px">
            <div class="row">
                <div class="col-sm-6">
                    <div class="mb-3">
                        <button  class="btn btn-primary" onclick="createProject()">@lang('admin.add') <i class="fas fa-plus"></i></button>
                    </div>
                </div>
            </div>
            <div id="alert-div">

            </div>
            <table class="table table-bordered table-striped mb-0" id="example_table">
                <thead>
                <tr>
                    <th>@lang('admin.name')</th>
                    <th>@lang('admin.email')</th>
                    <th>@lang('admin.phone')</th>
                    <th>@lang('admin.type')</th>
                    <th>@lang('admin.actions')</th>
                </tr>
                </thead>
                <tbody id="example-table-body">

                </tbody>
            </table>
        </div>
        <!-- project form modal -->
        <div class="modal" tabindex="-1" role="dialog" id="form-modal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"> @lang('admin.users')</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="error-div"></div>
                        <form>
                            <input type="hidden" name="update_id" id="update_id">
                            <div class="form-group">
                                <label for="name">@lang('admin.name')</label>
                                <input type="text" class="form-control" id="name" name="name">
                            </div>

                            <div class="form-group">
                                <label for="email">@lang('admin.email')</label>
                                <input type="email" class="form-control" id="email" name="email">
                            </div>
                            <div class="form-group">
                                <label for="phone">@lang('admin.phone')</label>
                                <input type="text" class="form-control" id="phone" name="phone">
                            </div>
                            <div class="form-group">
                                <label for="password">@lang('admin.password')</label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
                            <div class="form-group">
                                <label for="name">@lang('admin.type')</label>
                               <select class="form-control" name="type" id="type">
                               <option>-- choose type --</option>
                                   @foreach(\App\Models\Role::all() as $role)
                                       <option value="{{$role->name}}">{{$role->name}}</option>
                                   @endforeach
                               </select>
                            </div>
                            <button type="submit" class="btn btn-outline-primary mt-3" id="save-project-btn">@lang('admin.save')</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- view project modal -->
        <div class="modal " tabindex="-1" role="dialog" id="view-modal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">@lang('admin.highlight_info')</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <b>@lang('admin.name_en'):</b>
                        <p id="name_en_info"></p>
                        <b>@lang('admin.name_ar'):</b>
                        <p id="name_ar_info"></p>
                        <b>@lang('admin.description_en'):</b>
                        <p id="description_en_info"></p>
                        <b>@lang('admin.description_ar'):</b>
                        <p id="description_ar_info"></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- start: page -->
        <!-- end: page -->
    </section>
@endsection
@push('js')
    <script type="text/javascript">

        $(function() {
            let url = "{{route('admin.getUsers')}}";
            // create a datatable
            $('#example_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: url,
                "order": [[ 0, "desc" ]],
                columns: [
                    { data: 'name'},
                    { data: 'email'},
                    { data: 'phone'},
                    { data: 'type'},
                    { data: 'action'},
                ],

            });
        });


        function reloadTable()
        {
            /*
                reload the data on the datatable
            */
            $('#example_table').DataTable().ajax.reload();
        }

        /*
            check if form submitted is for creating or updating
        */
        $("#save-project-btn").click(function(event ){
            event.preventDefault();
            if($("#update_id").val() == null || $("#update_id").val() == "")
            {
                storeProject();
            } else {
                updateProject();
            }
        })

        /*
            show modal for creating a record and
            empty the values of form and remove existing alerts
        */
        function createProject()
        {
            $("#alert-div").html("");
            $("#error-div").html("");
            $("#update_id").val("");
            $("#name").val("");
            $("#email").val("");
            $("#phone").val("");
            $("#type").val("");
            $("#password").val("");
            $("#form-modal").modal('show');
        }

        /*
            submit the form and will be stored to the database
        */
        function storeProject()
        {
            $("#save-project-btn").prop('disabled', true);
            let url = "{{route('admin.users.store')}}";
            let data = {
                name: $("#name").val(),
                phone: $("#phone").val(),
                email: $("#email").val(),
                password: $("#password").val(),
                type: $("#type").val(),
            };

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                type: "POST",
                data: data,
                success: function(response) {
                    $("#save-project-btn").prop('disabled', false);
                    let successHtml = '<div class="alert alert-success" role="alert"><b>{{trans('admin.created')}}</b></div>';
                    $("#alert-div").html(successHtml);
                    $("#name").val("");
                    $("#phone").val("");
                    $("#email").val("");
                    $("#password").val("");
                    $("#type").val("");
                    reloadTable();
                    $("#form-modal").modal('hide');
                },
                error: function(response) {
                    $("#save-project-btn").prop('disabled', false);
                    if (typeof response.responseJSON.errors !== 'undefined')
                    {
                        let errors = response.responseJSON.errors;
                        let nameValidation = "";
                        if (typeof errors.name !== 'undefined')
                        {
                            nameValidation = '<li>' + name.title_ar[0] + '</li>';
                        }


                        let emailValidation = "";
                        if (typeof errors.email !== 'undefined')
                        {
                            emailValidation = '<li>' + errors.email[0] + '</li>';
                        }
                        let phoneValidation = "";
                        if (typeof errors.phone !== 'undefined')
                        {
                            phoneValidation = '<li>' + errors.phone[0] + '</li>';
                        }
                        let passwordValidation = "";
                        if (typeof errors.password !== 'undefined')
                        {
                            passwordValidation = '<li>' + errors.password[0] + '</li>';
                        }
                        let typeValidation = "";
                        if (typeof errors.type !== 'undefined')
                        {
                            typeValidation = '<li>' + errors.type[0] + '</li>';
                        }


                        let errorHtml = '<div class="alert alert-danger" role="alert">' +
                            '<b>Validation Error!</b>' +
                            '<ul>' + nameValidation  + emailValidation + phoneValidation + passwordValidation + typeValidation + '</ul>' +
                            '</div>';
                        $("#error-div").html(errorHtml);
                    }
                }
            });
        }


        /*
            edit record function
            it will get the existing value and show the project form
        */
        function editProject(id)
        {
            let url = "{{ route('admin.users.edit', ['user' => 'brandId']) }}".replace('brandId', id);


            $.ajax({
                url: url,
                type: "GET",
                success: function(response) {
                    let brand = response.brand;
                    $("#alert-div").html("");
                    $("#error-div").html("");
                    $("#update_id").val(brand.id);
                    $("#name").val(brand.name);
                    $("#phone").val(brand.phone);
                    $("#email").val(brand.email);
                    $("#type").val(brand.type);
                    $("#form-modal").modal('show');
                },
                error: function(response) {
                    console.log(response.responseJSON)
                }
            });
        }

        /*
            sumbit the form and will update a record
        */
        function updateProject()
        {
            $("#save-project-btn").prop('disabled', true);
            let id  = $("#update_id").val();
            let url = "{{ route('admin.users.update', ['user' => 'brandId']) }}".replace('brandId', id);
            let data = {
                id: $("#update_id").val(),
                name: $("#name").val(),
                phone: $("#phone").val(),
                email: $("#email").val(),
                password: $("#password").val(),
                type: $("#type").val(),
            };
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                type: "PUT",
                data: data,
                success: function(response) {
                    $("#save-project-btn").prop('disabled', false);
                    let successHtml = '<div class="alert alert-success" role="alert"><b>{{trans('admin.updated')}}</b></div>';
                    $("#alert-div").html(successHtml);
                    $("#name").val("");
                    $("#phone").val("");
                    $("#email").val("");
                    $("#password").val("");
                    $("#type").val("");
                    reloadTable();
                    $("#form-modal").modal('hide');
                },
                error: function(response) {
                    $("#save-project-btn").prop('disabled', false);
                    if (typeof response.responseJSON.errors !== 'undefined')
                    {
                        let errors = response.responseJSON.errors;
                        let nameValidation = "";
                        if (typeof errors.name !== 'undefined')
                        {
                            nameValidation = '<li>' + name.title_ar[0] + '</li>';
                        }


                        let emailValidation = "";
                        if (typeof errors.email !== 'undefined')
                        {
                            emailValidation = '<li>' + errors.email[0] + '</li>';
                        }
                        let phoneValidation = "";
                        if (typeof errors.phone !== 'undefined')
                        {
                            phoneValidation = '<li>' + errors.phone[0] + '</li>';
                        }
                        let passwordValidation = "";
                        if (typeof errors.password !== 'undefined')
                        {
                            passwordValidation = '<li>' + errors.password[0] + '</li>';
                        }
                        let typeValidation = "";
                        if (typeof errors.type !== 'undefined')
                        {
                            typeValidation = '<li>' + errors.type[0] + '</li>';
                        }


                        let errorHtml = '<div class="alert alert-danger" role="alert">' +
                            '<b>Validation Error!</b>' +
                            '<ul>' + nameValidation  + emailValidation + phoneValidation + passwordValidation + typeValidation + '</ul>' +
                            '</div>';
                        $("#error-div").html(errorHtml);
                    }
                }
            });
        }

        function showProject(id)
        {
            $("#name-info").html("");
            $("#description-info").html("");
            let url = "{{ route('admin.users.show', ['user' => 'brandId']) }}".replace('brandId', id);
            $.ajax({
                url: url,
                type: "GET",
                success: function(response) {
                    let brand = response.brand;
                    $("#name_en_info").html(brand.title);
                    $("#name_ar_info").html(brand.title_ar);
                    $("#description_en_info").html(brand.description);
                    $("#description_ar_info").html(brand.description_ar);
                    $("#view-modal").modal('show');

                },
                error: function(response) {
                    console.log(response.responseJSON)
                }
            });
        }

        /*
            delete record function
        */
        function destroyProject(id)
        {
            let url = "{{ route('admin.users.destroy', ['user' => 'brandId']) }}".replace('brandId', id);
            let data = {
                title: $("#title").val(),
            };
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                type: "DELETE",
                data: data,
                success: function(response) {
                    let successHtml = '<div class="alert alert-success" role="alert"><b>{{trans('admin.deleted')}}</b></div>';
                    $("#alert-div").html(successHtml);
                    reloadTable();
                },
                error: function(response) {
                    console.log(response.responseJSON)
                }
            });
        }

    </script>
@endpush
