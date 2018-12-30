<?php
/**
 * Created by PhpStorm.
 * User: spomega
 * Date: 10/8/18
 * Time: 11:42 AM
 */

namespace App\Repositories\Backend\Survey;

use App\Models\Survey\FormTranslation;
use App\Models\Survey\Question;
use App\Models\Survey\QuestionMap;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;

class QuestionRepository extends BaseRepository
{

    /**
     * Specify Model class name.
     *
     * @return mixed
     */
    public function model()
    {
       return Question::class;
    }


    /**
     * @param array $data
     *
     * @return Question
     * @throws GeneralException
     */
    public function create(array $data) : Question
    {
        // Make sure it doesn't already exist
        if ($this->questionExists($data['label_c'])) {
            throw new GeneralException('A question already exists with the name '.$data['label_c']);
        }



        return DB::transaction(function () use ($data) {

            $form_translation = FormTranslation::where('form_id',$data['form_id'])->first();

            //dd($form_translation);

            $question = parent::create([
                'form_translation_id' => $form_translation->id,
                'label_c' => $data['label_c'],
                'display_order_c' => $data["display_order_c"],
                'type_c'=> $data['type_c'],
                'caption_c'=>  $data['caption_c'],
                'required_c' => $data['required_c'],
                'formula_c' => $data['formula_c'],
                'default_value_c' => $data['default_value_c'],
                'help_text_c' => $data['help_text_c'],
                'hide_c' => $data['hide_c'],
                'options_c' => $data['options_c'],
                'user_id' => \auth()->user()->id
            ]);


            if($question)
            {
                $question_map = new QuestionMap();
                $question_map->question_id = $question->id;
                $question_map->object_c =  $data['map_object'];
                $question_map->field_c =  $data['map_field'];
                $question_map->save();

                return $question;
            }

            throw new GeneralException(trans('exceptions.backend.survey.questions.create_error'));
        });
    }

    /**
     * @param Permission  $permission
     * @param array $data
     *
     * @return mixed
     * @throws GeneralException
     */
    public function update(Question $question, array $data)
    {

        //dd($question);

        //dd($question->label_c .'  =  '.$data['label_c']);

        // If the name is changing make sure it doesn't already exist
        if ($question->label_c !== $data['label_c']) {
            if ($this->questionExists($data['label_c'])) {
                throw new GeneralException('A Question already exists with the name '.$data['label_c']);
            }
        }


        return DB::transaction(function () use ($question, $data) {
            if ($question->update([
                'label_c' => $data['label_c'],
                'display_order_c' => $data["display_order_c"],
                'type_c'=> $data['type_c'],
                'caption_c'=>  $data['caption_c'],
                'required_c' => $data['required_c'],
                'formula_c' => $data['formula_c'],
                'default_value_c' => $data['default_value_c'],
                'help_text_c' => $data['help_text_c'],
                'hide_c' => $data['hide_c'],
                'options_c' => $data['options_c'],

            ])) {

                // event(new RoleUpdated($permission));

                $question_map = QuestionMap::where('question_id',$question->id)->first();
                $question_map->object_c =  $data['map_object'];
                $question_map->field_c =  $data['map_field'];
                $question_map->save();

                return $question;
            }

            throw new GeneralException(trans('exceptions.backend.survey.questions.update_error'));
        });
    }



    /**
     * @param $name
     *
     * @return bool
     */
    protected function questionExists($label) : bool
    {
        return $this->model
                ->where('label_c', $label)
                ->count() > 0;
    }

}
