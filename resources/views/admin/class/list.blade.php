@extends('layouts.app')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Class List <small class="text-secondary">(Total: {{ $getRecord->total() }} )</small></h1>
                </div>
                <div class="col-sm-6" style="text-align: right">
                    <a href="{{ url('admin/class/add') }}" class="btn btn-primary">Add New Class</a>
                </div>

            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Add New Admin -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Search Class</h3>
                        </div>
                        <form method="get" action="">
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <input type="text" class="form-control" value="{{ Request::get('name') }}" name="name" placeholder="Name">
                                    </div>

                                    <div class="form-group col-md-3">
                                        <input type="date" class="form-control" value="{{ Request::get('date') }}" name="date" placeholder="Date">
                                    </div>

                                    <div class="form-group col-md-3">
                                        <button class="btn btn-primary" type="submit">Search</button>
                                        <a href="{{ url('admin/class/list') }}" class="btn btn-success" type="submit">Clear</a>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </form>
                    </div>
                    <!-- /.card -->


                </div>
                <!--/.col (left) -->

            </div>
            <!-- Admin List -->
            <div class="row">
                <!-- /.col -->
                <div class="col-md-12">

                    @include('_message')

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Class List</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Created By</th>
                                        <th>Date Created</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($getRecord as $value)
                                        <tr>
                                            <td>{{ $value->id }}</td>
                                            <td>{{ $value->name }}</td>
                                            <td>
                                                @if($value->status == 0)
                                                    <small class="badge badge-success">Active</small>
                                                @else
                                                    <small class="badge badge-danger">Inactive</small>
                                                @endif
                                            </td>
                                            <td>{{ $value->created_by_name }}</td>
                                            <td>{{ date('d-m-Y H:i A', strtotime($value->created_at)) }}</td>
                                            <td>
                                                <a href="{{ url('admin/class/edit/' . $value->id) }}" class="btn btn-primary">Edit</a>
                                                <a href="{{ url('admin/class/delete/' . $value->id) }}" class="btn btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="pr-3 pt-3 float-right">
                                {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>

        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection