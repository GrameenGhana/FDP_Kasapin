@extends('backend.layouts.app')

@section('title', app_name() . ' | Audit Logs' )

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        Audit Management <small class="text-muted">Audit Logs</small>
                    </h4>
                </div><!--col-->

            </div><!--row-->

            <div class="row mt-4">
                <div class="col">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Model</th>
                                <th scope="col">Action</th>
                                <th scope="col">User</th>
                                <th scope="col">Time</th>
                                <th scope="col">Old Values</th>
                                <th scope="col">New Values</th>
                            </tr>
                            </thead>
                            <tbody >
                            @foreach($audits as $audit)
                                <tr>
                                    <td>{{ $audit->auditable_type }} (id: {{ $audit->auditable_id }})</td>
                                    <td>{{ $audit->event }}</td>
                                    <td>{{ $audit->user->name }}</td>
                                    <td>{{ $audit->created_at }}</td>
                                    <td>
                                        <table class="table">
                                            @foreach($audit->old_values as $attribute => $value)
                                                <tr>
                                                    <td><b>{{ $attribute }}</b></td>
                                                    <td>{{ $value }}</td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </td>
                                    <td>
                                        <table class="table">
                                            @foreach($audit->new_values as $attribute => $value)
                                                <tr>
                                                    <td><b>{{ $attribute }}</b></td>
                                                    <td>{{ $value }}</td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div><!--col-->
            </div><!--row-->

        </div><!--card-body-->
    </div><!--card-->
@endsection

