@extends('backend.layouts.app')

@section('title',app_name() . ' | ' . __('labels.backend.access.countries.management'))

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="class card-title mb-0">
                        @lang('labels.backend.access.countries.management')
                    </h4>
                </div>

                <div class="col-sm-7 pull-right">
                    @include('backend.auth.country.includes.header-buttons')
                </div><!--col-->
            </div><!--row-->
            <div class="row mt-4">
                <div class="col">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>@lang('labels.backend.access.countries.table.country')</th>
                                <th>@lang('labels.backend.access.countries.table.level')</th>
                                <th>@lang('labels.general.actions')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($countries as $country)
                                <tr>
                                    <td>{{ucwords($$country->name)}}</td>
                                    <td>{{ucwords($$country->admin_level)}}</td>
                                    <td> {!! $country->action_buttons !!}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div><!--col-->
            </div>
        </div><!--card-body-->
    </div>
@endsection
