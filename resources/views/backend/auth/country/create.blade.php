@extends('backend.layouts.app')

@section('Title', __('labels.backend.access.countries.management') .' | '.__('labels.backend.access.countries.create'))


@section('content')

    {{ html()->form('POST', route('admin.auth.country.store'))->class('form-horizontal')->open() }}

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        @lang('labels.backend.access.countries.management')
                        <small class="text-muted">@lang('labels.backend.access.countries.create')</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <hr>
            <div  class="row mt-4">
                <div class="col">
                    <div  class="form-group row">
                        {{html()->label(__('validation.attributes.backend.access.countries.name'))
                        ->class('col-md-2 form-control-label')
                        ->for('name')}}

                        <div class="col-md-10">
                            {{ html()->text('name')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.access.countries.name'))
                                ->attribute('maxlength', 191)
                                ->required()
                                ->autofocus() }}
                        </div><!--col-->
                    </div>
                    <div class="form-group row">
                        {{html()->label(__('validation.attributes.backend.access.countries.iso'))
                        ->class('col-md-2 form-control-label')
                        ->for('iso_code')}}

                        <div class="col-md-10">
                            {{ html()->text('iso_code')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.access.countries.iso'))
                                ->attribute('maxlength', 191)
                                ->required()
                                ->autofocus() }}
                        </div><!--col-->
                    </div>
                    <div class="form-group row">
                    {{html()->label(__('validation.attributes.backend.access.countries.average_gate'))
                   ->class('col-md-2 form-control-label')
                   ->for('avg_gate_price')}}

                    <div class="col-md-10">
                        {{ html()->text('avg_gate_price')
                            ->class('form-control')
                            ->placeholder(__('validation.attributes.backend.access.countries.average_gate'))
                            ->attribute('maxlength', 191)
                            ->required()
                            ->autofocus() }}
                    </div><!--col-->
                </div>
                    <div class="form-group row">
                        {{html()->label(__('validation.attributes.backend.access.countries.currency'))
                        ->class('col-md-2 form-control-label')
                        ->for('currency')}}

                        <div class="col-md-10">
                            {{ html()->text('currency')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.access.countries.currency'))
                                ->required()
                                ->autofocus() }}
                        </div><!--col-->
                    </div>
                    <div class="form-group row">
                        {{html()->label(__('validation.attributes.backend.access.countries.admin'))
                        ->class('col-md-2 form-control-label')
                        ->for('admin_level')}}

                        <div class="col-md-10">
                            {{ html()->select('admin_level')->options(['1'=>'1','2','3','4','5','6','7'])
                                ->class('form-control')}}
                        </div><!--col-->
                    </div>
                    <div id="add_level" class="form-group row">

                    </div>
                </div>
            </div>
        </div><!--card-body-->
        <div class="card-footer">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('admin.auth.country.index'), __('buttons.general.cancel')) }}
                </div><!--col-->

                <div class="col text-right">
                    {{ form_submit(__('buttons.general.crud.create')) }}
                </div><!--col-->


            </div><!--row-->
        </div><!--card-footer-->


    </div><!--card-->

    {{ html()->form()->close() }}




@endsection

