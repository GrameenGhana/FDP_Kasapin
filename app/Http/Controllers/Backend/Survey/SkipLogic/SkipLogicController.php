<?php

namespace App\Http\Controllers\Backend\Survey\SkipLogic;


use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Survey\SkipLogic\ManageSkipLogicRequest;
use App\Http\Requests\Backend\Survey\SkipLogic\StoreSkipLogicRequest;
use App\Http\Requests\Backend\Survey\SkipLogic\UpdateSkipLogicRequest;
use App\Models\Auth\Country;
use App\Models\Survey\SkipLogic;
use App\Models\Survey\SkipLogicTranslation;
use App\Models\Survey\Question;
use App\Repositories\Backend\Survey\SkipLogicRepository;
use App\Repositories\Backend\Survey\QuestionRepository;
use DB;

class SkipLogicController extends Controller
{


    /**
     * @var skiplogicRepository
     *
     */
    protected  $skiplogicRepository;

    /**
     * @var questionRepository
     *
     */
    protected  $questionRepository;


    /**
     * @param SkipLogicRepository skiplogicRepository
     * @param QuestionRepository questionRepository
     *
     */
    public function __construct(SkipLogicRepository $skiplogicRepository,QuestionRepository $questionRepository)
    {
        $this->skiplogicRepository = $skiplogicRepository;
        $this->questionRepository = $questionRepository;
    }

    /**
     * @param ManageSkipLogicRequest $request
     *
     * @return mixed
     *
     * */
    public function index(ManageSkipLogicRequest $manageSkipLogicRequest)
    {


        $skiplogics = SkipLogic::OrderBy('id','asc')->paginate('25');

        return view('backend.survey.skiplogic.index',compact('skiplogics'));

    }

    /**
     * Show the skiplogic for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $questions = Question::all();
        return view('backend.survey.skiplogic.create')->withQuestions($questions);

    }

    /**
     * @param StoreSkipLogicRequest $request
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function store(StoreSkipLogicRequest $request)
    {

        //dd($request->all());

        $skiplogic = $this->skiplogicRepository->create($request->only('question_id','formula_c','hide_c'));


        return redirect()->route('admin.survey.skiplogic.index')->withFlashSuccess(__('alerts.backend.skiplogics.created'));

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
     * Show the skiplogic for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ManageSkipLogicRequest $request, SkipLogic $skiplogic)
    {
        $questions = Question::all();
        return view('backend.survey.skiplogic.edit',compact('skiplogic'))
            ->withSkipLogic($skiplogic)->withQuestions($questions);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSkipLogicRequest $request, SkipLogic $skiplogic)
    {

        $this->skiplogicRepository->update($skiplogic, $request->only('question_id','formula_c','hide_c'));
        return redirect()->route('admin.survey.skiplogic.index')->withFlashSuccess(__('alerts.backend.skiplogics.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  ManageSkipLogicRequest $request
     * @param  SkipLogic $skiplogic
     * @return mixed
     */
    public function destroy(ManageSkipLogicRequest $request, SkipLogic $skiplogic)
    {
        $this->skiplogicRepository->deleteById($skiplogic->id);

        //  event(new RoleDeleted($role));

        return redirect()->route('admin.survey.skiplogic.index')->withFlashSuccess(__('alerts.backend.skiplogics.deleted'));
    }




}
