@extends('backend.layouts.app')

@section('title',app_name() . ' | ' . __('labels.backend.survey.skiplogics.management'))

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="class card-title mb-0">
                        @lang('labels.backend.survey.skiplogics.management')
                    </h4>
                </div>

                <div class="col-sm-7 pull-right">
                    @include('backend.survey.skiplogic.includes.header-buttons')
                </div><!--col-->
            </div><!--row-->
            <div class="row mt-4">
                <div class="col">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>@lang('labels.backend.survey.skiplogics.table.question')</th>
                                <th>@lang('labels.backend.survey.skiplogics.table.formula')</th>
                                <th>@lang('labels.backend.survey.skiplogics.table.hide')</th>
                                <th>@lang('labels.general.actions')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($skiplogics as $skiplogic)
                                <tr>
                                    <td>{{ucwords($skiplogic->question->label_c)}}</td>
                                    <td>{{ucwords($skiplogic->formula_c)}}</td>
                                    <td>{{ucwords($skiplogic->hide_c)}}</td>
                                    <td>{!! $skiplogic->action_buttons !!}</td>
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
