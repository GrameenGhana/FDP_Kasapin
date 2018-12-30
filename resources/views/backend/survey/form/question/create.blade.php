@extends('backend.layouts.app')

@section('Title', __('labels.backend.survey.forms.management') .' | '.__('labels.backend.survey.forms.create'))


@section('content')
    {{ html()->form('POST', route('admin.survey.form.question.create'))->class('form-horizontal')->open() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        @lang('labels.backend.survey.forms.management')
                        <small class="text-muted">@lang('labels.backend.survey.forms.question')</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <hr>
            <div  class="row mt-4">
                <div class="col">

                    <div  class="form-group row">
                        <label class="col-md-2 form-control-label">Form Name</label>

                        <div class="col-md-10">
                            <b>{{ $form->form_name_c }}</b>
                        </div><!--col-->

                    </div>

                    <div  class="form-group row">
                        {{html()->label(__('validation.attributes.backend.survey.forms.questions.label'))
                        ->class('col-md-2 form-control-label')
                        ->for('label_c')}}

                        <div class="col-md-10">
                            {{ html()->text('label_c')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.survey.forms.questions.label'))
                                ->attribute('maxlength', 191)
                                ->required()
                                ->autofocus() }}
                        </div><!--col-->

                    </div>

                    <div  class="form-group row">
                        {{html()->label(__('validation.attributes.backend.survey.forms.questions.caption'))
                        ->class('col-md-2 form-control-label')
                        ->for('caption_c')}}

                        <div class="col-md-10">
                            {{ html()->text('caption_c')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.survey.forms.questions.caption'))
                                ->attribute('maxlength', 191)
                                ->autofocus() }}
                        </div><!--col-->

                    </div>

                    <div class="form-group row">
                        {{html()->label(__('validation.attributes.backend.survey.forms.questions.type'))
                        ->class('col-md-2 form-control-label')
                        ->for('type_c')}}

                        <div class="col-md-10">
                            {{ html()->select('type_c')->options($types)
                                ->class('form-control')}}
                        </div><!--col-->
                    </div>

                    <div  class="form-group row">
                        {{html()->label(__('validation.attributes.backend.survey.forms.questions.default'))
                        ->class('col-md-2 form-control-label')
                        ->for('default_value_c')}}

                        <div class="col-md-10">
                            {{ html()->text('default_value_c')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.survey.forms.questions.default'))
                                ->attribute('maxlength', 191)
                                ->autofocus() }}
                        </div><!--col-->

                    </div>

                    <div class="form-group row">
                        {{html()->label(__('validation.attributes.backend.survey.forms.questions.display_order'))
                        ->class('col-md-2 form-control-label')
                        ->for('display_order_c')}}

                        <div class="col-md-10">
                            {{ html()->text('display_order_c')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.survey.forms.questions.display_order'))
                                ->attribute('maxlength', 191)
                                ->required()
                                ->autofocus() }}
                        </div><!--col-->
                    </div>



                    <div class="form-group row">
                        {{html()->label(__('validation.attributes.backend.survey.forms.questions.required'))
                        ->class('col-md-2 form-control-label')
                        ->for('required_c')}}

                        <div class="col-md-10">
                            {{ html()->select('required_c')->options(['1'=>'Yes','0'=>'No'])
                                ->class('form-control')}}
                        </div><!--col-->
                    </div>

                    <div class="form-group row">
                        {{html()->label(__('validation.attributes.backend.survey.forms.questions.hide'))
                        ->class('col-md-2 form-control-label')
                        ->for('hide_c')}}

                        <div class="col-md-10">
                            {{ html()->select('hide_c')->options(['No','Yes'])
                                ->class('form-control')}}
                        </div><!--col-->
                    </div>

                    <div class="form-group row">
                    {{html()->label(__('validation.attributes.backend.survey.forms.questions.formula'))
                    ->class('col-md-2 form-control-label')
                    ->for('formula_c')}}

                    <div class="col-md-10">
                        {{ html()->textarea('formula_c')
                            ->class('form-control')
                            ->placeholder(__('validation.attributes.backend.survey.forms.questions.formula'))
                            ->attribute('maxlength', 191)
                            ->autofocus() }}
                    </div><!--col-->
                </div>


                    <div class="form-group row">
                        {{html()->label(__('validation.attributes.backend.survey.forms.questions.help_text'))
                        ->class('col-md-2 form-control-label')
                        ->for('help_text_c')}}

                        <div class="col-md-10">
                            {{ html()->text('help_text_c')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.survey.forms.questions.help_text'))
                                ->attribute('maxlength', 191)
                                ->autofocus() }}
                        </div><!--col-->
                    </div>

                    <div class="form-group row">
                        {{html()->label(__('validation.attributes.backend.survey.forms.questions.options'))
                        ->class('col-md-2 form-control-label')
                        ->for('options_c')}}

                        <div class="col-md-10">
                            {{ html()->text('options_c')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.survey.forms.questions.options'))
                                ->attribute('maxlength', 191)
                                ->autofocus() }}
                        </div><!--col-->
                    </div>

                    <div class="form-group row">
                        {{html()->label(__('validation.attributes.backend.survey.forms.questions.map_object'))
                        ->class('col-md-2 form-control-label')
                        ->for('map_object')}}

                        <div class="col-md-10">
                            {{ html()->select('map_object')->options([])
                                ->class('form-control')}}
                        </div><!--col-->
                    </div>

                    <div class="form-group row">
                        {{html()->label(__('validation.attributes.backend.survey.forms.questions.map_field'))
                        ->class('col-md-2 form-control-label')
                        ->for('map_field')}}

                        <div class="col-md-10">
                            {{ html()->select('map_field')->options([])
                                ->class('form-control')}}
                        </div><!--col-->
                    </div>

                </div>
                {{ html()->hidden('form_id')->value($form->id) }}
            </div>
        </div><!--card-body-->
        <div class="card-footer">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('admin.survey.form.index'), __('buttons.general.cancel')) }}
                </div><!--col-->

                <div class="col text-right">
                    {{ form_submit(__('buttons.general.crud.create')) }}
                </div><!--col-->


            </div><!--row-->
        </div><!--card-footer-->


    </div><!--card-->


    {{ html()->form()->close() }}



@endsection


@push('after-scripts')
    <script type="text/javascript">

        function loadTables(){

            var tables_url = '/admin/survey/question/tables';

            $.ajax({
                type: "GET",
                url: tables_url,
                success: function (data) {
                    $("#map_object").empty();
                    //$("#map_field").append("<option value=''> Select field</option>");
                    $.each(data, function (i, item) {
                        $("#map_object").append('<option value="' + data[i] + '">' + data[i] + '</option>');

                    });

                    loadColumns();
                },
                error: function(error){
                },
                complete: function () {
                }
            });
        }

        function loadColumns(){

            var map_object = $("#map_object option:selected").text();
            var columns_url = '/admin/survey/question/columns/'+map_object;

            $.ajax({
                type: "GET",
                url: columns_url,
                success: function (data) {
                    $("#map_field").empty();
                    //$("#map_field").append("<option value=''> Select field</option>");
                    $.each(data, function (i, item) {
                        $("#map_field").append('<option value="' + data[i] + '">' + data[i] + '</option>');

                    });
                },
                error: function(error){
                },
                complete: function () {
                }
            });
        }

        loadTables();


        $( "#map_object" ).change(function() {

            loadColumns(map_object)

        });


    </script>
@endpush