@extends('admin.layouts.admin')
@section('title')
    @lang('admin.activity')
@endsection
@section('content')
    <section role="main" class="content-body">
        <header class="page-header">
            <h2> @lang('admin.activity')</h2>

        </header>

        <div class="card-body" style="padding:20px">
            @if(session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif


            <div id="alert-div">

            </div>

            <table class="table table-bordered table-striped mb-0" id="example_table">
                <thead>
                <tr>
                    <th>@lang('admin.description')</th>
                    <th>@lang('admin.created at')</th>
                </tr>
                </thead>
                <tbody id="example-table-body">

                </tbody>
            </table>
        </div>


        @php
            $url =  route('admin.getUserActivity', ['user_id' => $user_id]);
        @endphp
        <!-- start: page -->
        <!-- end: page -->
    </section>
@endsection
@push('js')
    <script type="text/javascript">

        $(function() {
            let url = @json($url);
            // create a datatable
            $('#example_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: url,
                "order": [[ 0, "description" ]],
                columns: [
                    { data: 'description'},
                    { data: 'created_at'},
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


    </script>


@endpush
