@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-primary">{{ __('Dashboard') }}</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- Welcome Card -->
                <div class="col-lg-12 mb-4">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <h5 class="card-title text-primary">{{ __('Welcome') }}, {{ auth()->user()->name }}!</h5>
                            <p class="card-text text-muted">{{ __('Here is a summary of your system data.') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Statistics Section -->
                <div class="col-lg-3 col-md-6">
                    <div class="card bg-primary text-white">
                        <div class="card-body">
                            <h5>{{ __('Total Users') }}</h5>
                            <h3>{{ $totalUsers }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card bg-info text-white">
                        <div class="card-body">
                            <h5>{{ __('Total Orders') }}</h5>
                            <h3>{{ $totalOrders }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card bg-secondary text-white">
                        <div class="card-body">
                            <h5>{{ __('Hosting Packages') }}</h5>
                            <h3>{{ $totalHostingPackages }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


