@extends('backend.layouts.app')

@section('Title', __('labels.backend.survey.forms.management') .' | '.__('labels.backend.survey.forms.create'))


@section('content')

    {{ html()->form('POST', route('admin.survey.form.store'))->class('form-horizontal')->open() }}

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        @lang('labels.backend.survey.forms.management')
                        <small class="text-muted">@lang('labels.backend.survey.forms.create')</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <hr>
            <div  class="row mt-4">
                <div class="col">
                    <div  class="form-group row">
                        {{html()->label(__('validation.attributes.backend.survey.forms.name'))
                        ->class('col-md-2 form-control-label')
                        ->for('form_name_c')}}

                        <div class="col-md-10">
                            {{ html()->text('form_name_c')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.survey.forms.name'))
                                ->attribute('maxlength', 191)
                                ->required()
                                ->autofocus() }}
                        </div><!--col-->
                    </div>
                    <div class="form-group row">
                        {{html()->label(__('validation.attributes.backend.survey.forms.display_order'))
                        ->class('col-md-2 form-control-label')
                        ->for('display_order_c')}}

                        <div class="col-md-10">
                            {{ html()->text('display_order_c')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.survey.forms.display_order'))
                                ->attribute('maxlength', 191)
                                ->required()
                                ->autofocus() }}
                        </div><!--col-->
                    </div>

                    <div class="form-group row">
                        {{html()->label(__('validation.attributes.backend.survey.forms.type'))
                        ->class('col-md-2 form-control-label')
                        ->for('type_c')}}

                        <div class="col-md-10">
                            {{ html()->select('type_c')->options(['diagnotics'=>'Diagnotics','monitoring'=>'Monitoring','both'=>'Both'])
                                ->class('form-control')
                                ->required()
                                }}
                        </div><!--col-->
                    </div>

                    <div class="form-group row">
                        {{html()->label(__('validation.attributes.backend.survey.forms.display_type'))
                        ->class('col-md-2 form-control-label')
                        ->for('display_type_c')}}

                        <div class="col-md-10">
                            {{ html()->select('display_type_c')->options(['historical'=>'Historical','tabular'=>'Tabular','form'=>'Form','p&l'=>'P&L'])
                                ->class('form-control')
                                ->required()
                                }}
                        </div><!--col-->
                    </div>

                    <div class="form-group row">
                        {{html()->label(__('validation.attributes.backend.survey.forms.custom'))
                        ->class('col-md-2 form-control-label')
                        ->for('custom_c')}}

                        <div class="col-md-10">
                            {{ html()->text('custom_c')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.survey.forms.custom'))
                                ->attribute('maxlength', 191)
                                ->autofocus() }}
                        </div><!--col-->
                    </div>

                    <div class="form-group row">
                        {{html()->label(__('validation.attributes.backend.survey.forms.country'))
                        ->class('col-md-2 form-control-label')
                        ->for('country')}}

                        <div class="col-md-10">
                            <select class="form-control" name="country" id="country" required>
                                @foreach($countries as $country)
                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                @endforeach
                            </select>

                        </div><!--col-->
                    </div>

                </div>
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

