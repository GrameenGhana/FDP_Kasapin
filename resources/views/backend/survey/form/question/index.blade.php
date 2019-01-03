@extends('backend.layouts.app')

@section('title',app_name() . ' | ' . __('labels.backend.survey.forms.management'))

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="class card-title mb-0">
                        @lang('labels.backend.survey.forms.management')
                        <small class="text-muted">@lang('labels.backend.survey.forms.questions.all')</small> <br/>
                        <small>[ {{$form->form_name_c}} ]</small>
                    </h4>
                </div>

                <div class="col-sm-7 pull-right">
                    @include('backend.survey.form.includes.questions-header-buttons')
                </div><!--col-->
            </div><!--row-->
            <div class="row mt-4">
                <div class="col">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>@lang('labels.backend.survey.forms.questions.label')</th>
                                <th>@lang('labels.backend.survey.forms.questions.caption')</th>
                                <th>@lang('labels.backend.survey.forms.questions.display_order')</th>
                                <th>@lang('labels.backend.survey.forms.questions.type')</th>
                                <th>@lang('labels.backend.survey.forms.questions.options')</th>
                              <!--  <th>@lang('labels.backend.survey.forms.questions.map_object')</th>
                                <th>@lang('labels.backend.survey.forms.questions.map_field')</th>-->
                                <th>@lang('labels.general.actions')</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($questions as $question)

                                <tr>
                                    <td>{{ucwords($question->label_c)}}</td>
                                    <td>{{ucwords($question->caption_c)}}</td>
                                    <td>{{ucwords($question->display_order_c)}}</td>
                                    <td>{{ucwords($question->type_c)}}</td>
                                    <td>{{ucwords($question->options_c)}}</td>
                                    <td>{!!$question->action_buttons !!}</td>
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
