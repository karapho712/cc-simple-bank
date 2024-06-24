@extends('layout.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>History</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="HistoryTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Id</th>
                                        <th>Amount</th>
                                        <th>Transaction Type</th>
                                        <th>Status</th>
                                        <th>Desc</th>
                                        <th>Created At</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Id</th>
                                        <th>Amount</th>
                                        <th>Transaction Type</th>
                                        <th>Status</th>
                                        <th>Desc</th>
                                        <th>Created At</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@section('page-script')
    <script>
        $(function() {
            $("#HistoryTable").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                processing: true,
                serverSide: true,
                ajax: {
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'Authorization': "Bearer {{ base64_encode(auth()->user()->name) }}"
                    },
                    url: "{{ route('api.history') }}"
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        "className": "text-center",
                        "width": "35px",
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'id',
                        name: 'id',
                        "className": "text-center",
                        "width": "35px",
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'amount',
                        name: 'amount',
                        "className": "text-center",
                        "width": "35px",
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'transaction_type',
                        name: 'transaction_type',
                        "className": "text-center",
                        "width": "35px",
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'status',
                        name: 'status',
                        "className": "text-center",
                        "width": "35px",
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'description',
                        name: 'description',
                        "className": "text-center",
                        "width": "35px",
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        "className": "text-center",
                        "width": "35px",
                        orderable: false,
                        searchable: false
                    },
                ]
            });
        });
    </script>
@endsection
