@extends('admin.layouts.admin')
@section('title')
    @lang('admin.dashboard')
@endsection
@section('content')
    <section role="main" class="content-body">
        <header class="page-header">
            <h2>Dashboard</h2>
        </header>

        <!-- start: page -->
        <div class="row">
            <div class="col-lg-12">
                <div class="row mb-3">
                    <div class="col-xl-4">
                        <section class="card card-featured-left card-featured-primary mb-3">
                            <div class="card-body">
                                <div class="widget-summary">
                                    <div class="widget-summary-col widget-summary-col-icon">
                                        <div class="summary-icon bg-primary">
                                            <i class="fas fa-life-ring"></i>
                                        </div>
                                    </div>
                                    <div class="widget-summary-col">
                                        <div class="summary">
                                            <h4 class="title">@lang('admin.Users')</h4>
                                            <div class="info">
                                                <strong class="amount">0</strong>
                                            </div>
                                        </div>
                                        <div class="summary-footer">
                                            <a class="text-muted text-uppercase" href="#">(view all)</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>

                </div>
            </div>
        </div>
        <!-- end: page -->
    </section>
@endsection

