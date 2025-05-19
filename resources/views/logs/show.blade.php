@extends('layouts.app')

@section('content')
    <!-- Breadcrumb Row Start -->
    <div class="row">
        <div class="col-md-12">
            <div class="breadcrumb-area">
                <h3>Fichier de Logs</h3>
            </div>
        </div>
    </div>
    <!-- End Breadcrumb Row -->

    <!-- Logs Table Row Start -->
    <div class="row">
        <div class="col-md-12">
            <div class="page-box">
                <div class="table-responsive">
                    <table class="table display table-bordered">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Utilisateur</th>
                                <th>Action</th>
                                <th>Timestamp</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($logs as $log)
                                <tr>
                                    @php
                                        $logData = explode(' | ', $log); // Assuming the log is formatted as "date | user | action"
                                    @endphp
                                    <td>{{ $logData[0] ?? 'N/A' }}</td>
                                    <td>{{ $logData[1] ?? 'N/A' }}</td>
                                    <td>{{ $logData[2] ?? 'N/A' }}</td>
                                    <td>{{ now()->format('Y-m-d H:i:s') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
