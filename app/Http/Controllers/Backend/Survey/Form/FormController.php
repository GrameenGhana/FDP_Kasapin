<?php

namespace App\Http\Controllers\Backend\Survey\Form;


use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Survey\Form\ManageFormRequest;
use App\Http\Requests\Backend\Survey\Form\StoreFormRequest;
use App\Http\Requests\Backend\Survey\Form\UpdateFormRequest;
use App\Models\Auth\Country;
use App\Models\Survey\Form;
use App\Repositories\Backend\Survey\FormRepository;

class FormController extends Controller
{


    /**
     * @var formRepository
     *
     */
    protected  $formRepository;


    /**
     * @param FormRepository formRepository
     *
     */
    public function __construct(FormRepository $formRepository)
    {
        $this->formRepository = $formRepository;
    }

    /**
     * @param ManageFormRequest $request
     *
     * @return mixed
     *
     * */
    public function index(ManageFormRequest $manageFormRequest)
    {

        return view('backend.survey.form.index')
            ->withForms($this->formRepository->OrderBy('id','asc')->paginate('25'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::all();
        return view('backend.survey.form.create')->withCountries($countries);

    }

    /**
     * @param StoreFormRequest $request
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function store(StoreFormRequest $request)
    {

        $form = $this->formRepository->create($request->only('form_name_c','display_order_c','type_c','display_type_c','custom_c','country'));


        return redirect()->route('admin.survey.form.index')->withFlashSuccess(__('alerts.backend.forms.created'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ManageFormRequest $request,Form $form)
    {
        $countries = Country::all();
        return view('backend.survey.form.edit')
            ->withForm($form)->withCountries($countries);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFormRequest $request, Form $form)
    {
        //
        $this->formRepository->update($form, $request->only('form_name_c','display_order_c','type_c','display_type_c','custom_c','country'));
        return redirect()->route('admin.survey.form.index')->withFlashSuccess(__('alerts.backend.forms.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  ManageFormRequest $request
     * @param  Form $form
     * @return mixed
     */
    public function destroy(ManageFormRequest $request,Form $form)
    {
        $this->formRepository->deleteById($form->id);

        //  event(new RoleDeleted($role));

        return redirect()->route('admin.survey.form.index')->withFlashSuccess(__('alerts.backend.forms.deleted'));
    }



}
