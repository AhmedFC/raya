@extends('admin.layouts.admin')
@section('title')
    @lang('admin.projects')
@endsection
@section('content')
    <section role="main" class="content-body">
        <header class="page-header">
            <h2> @lang('admin.projects')</h2>
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
                        <h5 class="modal-title"> @lang('admin.projects')</h5>
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
                            <button type="submit" class="btn btn-outline-primary mt-3" id="save-project-btn">@lang('admin.save')</button>
                        </form>
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
            let url = "{{route('admin.getProjects')}}";
            // create a datatable
            $('#example_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: url,
                "order": [[ 0, "desc" ]],
                columns: [
                    { data: 'name'},
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
            $("#form-modal").modal('show');
        }

        /*
            submit the form and will be stored to the database
        */
        function storeProject()
        {
            $("#save-project-btn").prop('disabled', true);
            let url = "{{route('admin.projects.store')}}";
            let data = {
                name: $("#name").val(),
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
                            nameValidation = '<li>' + errors.name[0] + '</li>';
                        }


                        let errorHtml = '<div class="alert alert-danger" role="alert">' +
                            '<b>Validation Error!</b>' +
                            '<ul>' + nameValidation + '</ul>' +
                            '</div>';
                        $("#error-div").html(errorHtml);
                    }
                }
            });
        }


        function editProject(id)
        {
            let url = "{{ route('admin.projects.edit', ['project' => 'brandId']) }}".replace('brandId', id);


            $.ajax({
                url: url,
                type: "GET",
                success: function(response) {
                    let brand = response.brand;
                    $("#alert-div").html("");
                    $("#error-div").html("");
                    $("#update_id").val(brand.id);
                    $("#name").val(brand.name);
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
            let url = "{{ route('admin.projects.update', ['project' => 'brandId']) }}".replace('brandId', id);
            let data = {
                id: $("#update_id").val(),
                name: $("#name").val(),
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
                            nameValidation = '<li>' + errors.name[0] + '</li>';
                        }


                        let errorHtml = '<div class="alert alert-danger" role="alert">' +
                            '<b>Validation Error!</b>' +
                            '<ul>' + nameValidation + '</ul>' +
                            '</div>';
                        $("#error-div").html(errorHtml);
                    }
                }
            });
        }


        /*
            delete record function
        */
        function destroyProject(id)
        {
            let url = "{{ route('admin.projects.destroy', ['project' => 'brandId']) }}".replace('brandId', id);
            let data = {
                name: $("#name").val(),
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
