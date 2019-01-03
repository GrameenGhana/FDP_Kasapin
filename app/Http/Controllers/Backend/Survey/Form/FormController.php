<?php

namespace App\Http\Controllers\Backend\Survey\Form;


use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Survey\Form\ManageFormRequest;
use App\Http\Requests\Backend\Survey\Form\StoreFormRequest;
use App\Http\Requests\Backend\Survey\Form\StoreQuestionRequest;
use App\Http\Requests\Backend\Survey\Form\UpdateFormRequest;
use App\Http\Requests\Backend\Survey\Form\UpdateQuestionRequest;
use App\Models\Auth\Country;
use App\Models\Survey\Form;
use App\Models\Survey\FormTranslation;
use App\Models\Survey\Question;
use App\Repositories\Backend\Survey\FormRepository;
use App\Repositories\Backend\Survey\QuestionRepository;
use DB;

class FormController extends Controller
{


    /**
     * @var formRepository
     *
     */
    protected  $formRepository;

    /**
     * @var questionRepository
     *
     */
    protected  $questionRepository;


    /**
     * @param FormRepository formRepository
     * @param QuestionRepository questionRepository
     *
     */
    public function __construct(FormRepository $formRepository,QuestionRepository $questionRepository)
    {
        $this->formRepository = $formRepository;
        $this->questionRepository = $questionRepository;
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
    public function edit(ManageFormRequest $request, Form $form)
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
    public function destroy(ManageFormRequest $request, Form $form)
    {
        $this->formRepository->deleteById($form->id);

        //  event(new RoleDeleted($role));

        return redirect()->route('admin.survey.form.index')->withFlashSuccess(__('alerts.backend.forms.deleted'));
    }

    # retrieve questions page
    public function allQuestions(Form $form)
    {

        $questions = FormTranslation::where('form_id',$form->id)->first()->question()->get();

        //dd(Question::find(2)->map());

        //dd($tables);

        return view('backend.survey.form.question.index', compact('questions','form'));
    }


    #  add questions
    public function createQuestion(Form $form)
    {

       // $tables = $this->getTables();

        $types = ['Text'=>'Text','Single Select' => 'Single Select','Multi Select'=>'Multi Select','Number'=>'Number',
            'Decimal'=>'Decimal','Logic Formula'=>'Logic Formula','Math Formula'=>'Math Formula','Geolocation'=>'Geolocation'];

        return view('backend.survey.form.question.create', compact('form','types'));
    }

    /**
     * Store the specified resource from storage.
     *
     * @param  StoreQuestionRequest $request
     * @return mixed
     */
    public function storeQuestion(StoreQuestionRequest $request)
    {
        //dd($request);

        $questions = FormTranslation::where('form_id',$request->input('form_id'))->first()->question()->get();

        $form = Form::find($request->input('form_id'));

        $question = $this->questionRepository->create($request->only('caption_c','type_c','required_c','formula_c','label_c','default_value_c',
            'display_order_c','help_text_c','hide_c','options_c','form_id','map_object','map_field'));


        return redirect()->route('admin.survey.form.question.all',$form)->withFlashSuccess(__('alerts.backend.questions.created'))->withQuestions($questions)->withForm($form);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editQuestion(ManageFormRequest $request, Question $question)
    {
        $form = FormTranslation::find($question->form_translation_id)->form()->first();

        $types = ['Text'=>'Text','Single Select' => 'Single Select','Multi Select'=>'Multi Select','Number'=>'Number',
            'Decimal'=>'Decimal','Logic Formula'=>'Logic Formula','Math Formula'=>'Math Formula','Geolocation'=>'Geolocation'];


        return view('backend.survey.form.question.edit',compact('types','form'))
            ->withQuestion($question)->withForm($form);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateQuestion(UpdateQuestionRequest $request, Question $question)
    {

        $questions = FormTranslation::where('form_id',$request->input('form_id'))->first()->question()->get();

        $form = Form::find($request->input('form_id'));

        $this->questionRepository->update($question, $request->only('caption_c','type_c','required_c','formula_c','label_c','default_value_c',
            'display_order_c','help_text_c','hide_c','options_c','map_object','map_field'));

        return redirect()->route('admin.survey.form.question.all',$form)->withFlashSuccess(__('alerts.backend.questions.updated'))->withQuestions($questions)->withForm($form);
    }


    /**
     * @return array
     */
    public function getTables()
    {
        $tables_db = DB::select('SHOW TABLES');
        $tables =[];
        foreach($tables_db as $table)
        {
            array_push($tables,$table->Tables_in_fdp_db);
        }


        return $tables;
    }

    /**
     * @param $tables
     * @return array
     */
    public function getTableColumns($table)
    {
        $tablecolumns = \Schema::getColumnListing($table);

        $columns =[];
        foreach($tablecolumns as $column)
        {
            array_push($columns,$column);
        }


        return $columns;
    }

}
