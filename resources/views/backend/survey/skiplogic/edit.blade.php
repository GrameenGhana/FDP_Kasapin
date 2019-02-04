@extends('backend.layouts.app')

@section('Title', __('labels.backend.survey.skiplogics.management') .' | '.__('labels.backend.survey.skiplogics.edit'))

@section('content')
    {{ html()->modelForm($skiplogic, 'PATCH', route('admin.survey.skiplogic.update', $skiplogic))->class('form-horizontal')->open() }}

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        @lang('labels.backend.survey.skiplogics.management')
                        <small class="text-muted">@lang('labels.backend.survey.skiplogics.edit')</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <hr>
            <div  class="row mt-4">
                <div class="col">

                    <div class="form-group row">
                        {{html()->label(__('validation.attributes.backend.survey.skiplogics.question'))
                        ->class('col-md-2 form-control-label')
                        ->for('question')}}

                        <div class="col-md-10">
                            <select class="form-control" name="question" id="question" required>
                                @foreach($questions as $question)
                                    <option value="{{ $question->id }}">{{ $question->label_c }}</option>
                                @endforeach
                            </select>

                        </div><!--col-->
                    </div>

                    <div  class="form-group row">
                        {{html()->label(__('validation.attributes.backend.survey.skiplogics.logic_operator'))
                        ->class('col-md-2 form-control-label')
                        ->for('logic_operator')}}

                        <div class="col-md-10">
                            {{ html()->select('logic_operator')->options(['=='=>'==','!='=>'!=','>='=>'>=','<='=>'<=','<'=>'<','>'=>'>'])
                                ->class('form-control')
                                ->required()
                                }}
                        </div><!--col-->
                    </div>

                    <div class="form-group row">
                        {{html()->label(__('validation.attributes.backend.survey.skiplogics.question_value'))
                        ->class('col-md-2 form-control-label')
                        ->for('question_value')}}

                        <div class="col-md-10">
                            {{ html()->text('question_value')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.survey.skiplogics.question_value'))
                                ->attribute('maxlength', 191)
                                ->required()
                                ->autofocus() }}
                        </div><!--col-->
                    </div>

                    <div class="form-group row">
                        {{html()->label(__('validation.attributes.backend.survey.skiplogics.formula'))
                        ->class('col-md-2 form-control-label')
                        ->for('formula_c')}}

                        <div class="col-md-10">
                            {{ html()->text('formula_c')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.survey.skiplogics.formula'))
                                ->attribute('maxlength', 191)
                                ->readonly()
                                ->autofocus() }}
                        </div><!--col-->

                    </div>

                    <div class="form-group row">
                        {{html()->label(__('validation.attributes.backend.survey.skiplogics.question_hide'))
                        ->class('col-md-2 form-control-label')
                        ->for('question_id')}}

                        <div class="col-md-10">
                            <select class="form-control" name="question_id" id="question_id" required>
                                @foreach($questions as $question)
                                    <option value="{{ $question->id }}">{{ $question->label_c }}</option>
                                @endforeach
                            </select>

                        </div><!--col-->
                    </div>



                    <div class="form-group row">
                        {{html()->label(__('validation.attributes.backend.survey.skiplogics.hide'))
                        ->class('col-md-2 form-control-label')
                        ->for('hide_c')}}

                        <div class="col-md-10">
                            {{ html()->select('hide_c')->options(['No','Yes'])
                                ->class('form-control')
                                ->required()
                                }}
                        </div><!--col-->
                    </div>



                </div>
            </div>
        </div><!--card-body-->
        <div class="card-footer">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('admin.survey.skiplogic.index'), __('buttons.general.cancel')) }}
                </div><!--col-->

                <div class="col text-right">
                    {{ form_submit(__('buttons.general.crud.update')) }}
                </div><!--col-->


            </div><!--row-->
        </div><!--card-footer-->


    </div><!--card-->

    {{ html()->closeModelForm() }}
@endsection


@push('after-scripts')
    <script type="text/javascript">
        $( "#question_value" ).keyup(function() {

            $("#formula_c").val( $( "#question" ).children("option:selected"). val() + $( "#logic_operator" ).val() + $( "#question_value" ).val() );

        });

        $( "#question" ).change(function() {

            $("#formula_c").val( $( "#question" ).children("option:selected"). val() + $( "#logic_operator" ).val() + $( "#question_value" ).val() );

        });

        $( "#logic_operator" ).change(function() {

            $("#formula_c").val( $( "#question" ).children("option:selected"). val() + $( "#logic_operator" ).val() + $( "#question_value" ).val() );

        });
    </script>
@endpush




