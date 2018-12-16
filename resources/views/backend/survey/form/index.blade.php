@extends('backend.layouts.app')

@section('title',app_name() . ' | ' . __('labels.backend.survey.forms.management'))

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="class card-title mb-0">
                        @lang('labels.backend.survey.forms.management')
                    </h4>
                </div>

                <div class="col-sm-7 pull-right">
                    @include('backend.survey.form.includes.header-buttons')
                </div><!--col-->
            </div><!--row-->
            <div class="row mt-4">
                <div class="col">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>@lang('labels.backend.survey.forms.table.name')</th>
                                <th>@lang('labels.backend.survey.forms.table.display_order')</th>
                                <th>@lang('labels.backend.survey.forms.table.type')</th>
                                <th>@lang('labels.backend.survey.forms.table.display_type')</th>
                                <th>@lang('labels.backend.survey.forms.table.number_of_questions')</th>
                                <th>@lang('labels.general.actions')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($forms as $form)
                                <tr>
                                    <td>{{ucwords($form->form_name_c)}}</td>
                                    <td>{{ucwords($form->display_order_c)}}</td>
                                    <td>{{ucwords($form->type_c)}}</td>
                                    <td>{{ucwords($form->display_type_c)}}</td>
                                    <td>{{ \App\Models\Survey\Question::where('form_translation_id',$form->form_transaltion()->id )->count()}}</td>
                                    <td>{!! $form->action_buttons !!}</td>
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
