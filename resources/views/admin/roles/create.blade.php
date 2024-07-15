@extends('admin.layouts.admin')
@section('title')
    @lang('admin.Add_roles')
@endsection
@section('content')
    <section role="main" class="content-body">
        <header class="page-header">
            <h2> @lang('admin.Add_roles')</h2>
        </header>

        <div class="row">
            <div class="col">
                <section class="card">
                    <header class="card-header">
                        <div class="card-actions">
                            <a href="#" class="card-action card-action-toggle" data-card-toggle></a>
                            <a href="#" class="card-action card-action-dismiss" data-card-dismiss></a>
                        </div>

                        <h2 class="card-title">@lang('admin.Add_roles')</h2>
                    </header>
                    <div class="card-body">

                        @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                        <form class="form-horizontal form-bordered" action="{{route('admin.roles.store')}}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row pb-4">
                                <label class="col-lg-3 control-label text-lg-end pt-2" for="title">role name</label>
                                <div class="col-lg-6">
                                    <input type="text" name="name" value="{{old('name')}}" class="form-control input-rounded" id="name" required>
                                </div>
                            </div>

                            @foreach ($groups as $group)
                                <div class="homePage-content bg-white py-4 px-3">
                                    <h4 class="main-heading text-white mb-4 p-2" style='background:#3cbc7f;'>{{ $group}}</h4>
                                    <div class="container-fluid">
                                        <div class="row">
                                            @foreach (config()->get('permission_groups.groups.' . $group) as $index => $model)

                                                <div class="col-12 col-md-4 col-lg-2">
                                                    <div class="box-control">
                                                        <div class="bar-name">
                                                            <h5 class="name">{{$index}}</h5>
                                                        </div>
                                                        <div class="row g-4">
                                                            @foreach (config()->get('permission_groups.groups.' . $group . '.' . $index) as $map)
                                                                <div class="col-12 col-md-12">
                                                                    <div class="toggle">
                                                                        <label class="switch">
                                                                            <input type="checkbox" name="permissions[]" value="{{ $map . '_' . $index }}" id="{{ $group }}{{ $index }}{{ $map }}">
                                                                            <span class="slider round"></span>
                                                                        </label>
                                                                        <label for="{{ $group }}{{ $index }}{{ $map }}" class='title'>{{ $map}}</label>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <hr>
                                        </div>
                                    </div>
                                </div>
                            @endforeach


                            <footer class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="reset" class="btn btn-default">Reset</button>
                            </footer>
                        </form>
                    </div>
                </section>
            </div>
        </div>

    </section>

@endsection
