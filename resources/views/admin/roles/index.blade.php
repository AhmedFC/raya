@extends('admin.layouts.admin')
@section('title')
    @lang('admin.roles')
@endsection
@section('content')
    <section role="main" class="content-body">
        <header class="page-header">
            <h2> @lang('admin.roles')</h2>
        </header>

        <div class="card-body" style="padding:20px">
            @if(session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif
            <div class="row">
                <div class="col-sm-6">
                    <div class="mb-3">
                        <a  class="btn btn-primary" href="{{route('admin.roles.create')}}">@lang('admin.add') <i class="fas fa-plus"></i></a>
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

        <!-- start: page -->
        <!-- end: page -->
    </section>
@endsection
@push('js')
    <script type="text/javascript">

        $(function() {


            let url = "{{route('admin.getRoles')}}";
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

        function destroyProject(id)
        {
            let url = "{{ route('admin.roles.destroy', ['role' => 'brandId']) }}".replace('brandId', id);
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
