@extends('backend.layouts.app')

@section('Title', __('labels.backend.access.countries.management') .' | '.__('labels.backend.access.countries.create'))


@section('content')
    {{ html()->form('POST', route('admin.auth.country.admin.create'))->class('form-horizontal')->open() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        @lang('labels.backend.access.countries.management')
                        <small class="text-muted">@lang('labels.backend.access.countries.admin')</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <hr>
            <div  class="row mt-4">
                <div class="col">
                    <div class="form-group row">
                        {{html()->label(__('validation.attributes.backend.access.countries.admin'))
                        ->class('col-md-2 form-control-label')
                        ->for('admin_level_1')}}

                        <div class="col-md-10">
                            {{ html()->select('admin_level_1')->options($admininfo)
                                ->class('form-control')}}
                        </div><!--col-->
                    </div>
                    <div class="form-group row">
                        {{html()->label(__('validation.attributes.backend.access.countries.parent'))
                        ->class('col-md-2 form-control-label')
                        ->for('parent')}}

                        <div class="col-md-10">
                            {{ html()->text('parent')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.access.countries.parent'))
                                ->attribute('maxlength', 191)
                                ->required()
                                ->autofocus() }}
                        </div><!--col-->

                        <div class="col-md-10">
                            {{ html()->select('admin_select')->options($admininfo)
                                ->class('form-control')->style('display:none')}}
                        </div><!--col-->
                    </div>
                    <div class="form-group row">
                        {{html()->label(__('validation.attributes.backend.access.countries.admin_name'))
                        ->class('col-md-2 form-control-label')
                        ->for('admin_name')}}

                        <div class="col-md-10">
                            {{ html()->text('name')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.access.countries.admin_name'))
                                ->attribute('maxlength', 191)
                                ->required()
                                ->autofocus() }}
                        </div><!--col-->
                    </div>
                </div>
                {{ html()->hidden('country_id')->value($country) }}
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
