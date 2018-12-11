<?php
/**
 * Created by PhpStorm.
 * User: spomega
 * Date: 10/8/18
 * Time: 11:42 AM
 */

namespace App\Repositories\Backend\Survey;

use App\Helpers\Auth\Auth;
use App\Models\Survey\Form;
use App\Models\Survey\FormTranslation;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;

class FormRepository extends BaseRepository
{

    /**
     * Specify Model class name.
     *
     * @return mixed
     */
    public function model()
    {
       return Form::class;
    }


    /**
     * @param array $data
     *
     * @return Form
     * @throws GeneralException
     */
    public function create(array $data) : Form
    {
        // Make sure it doesn't already exist
        if ($this->formExists($data['form_name_c'])) {
            throw new GeneralException('A form already exists with the name '.$data['form_name_c']);
        }



        return DB::transaction(function () use ($data) {
            $form = parent::create([
                'form_name_c' => $data['form_name_c'],
                'display_order_c' => $data["display_order_c"],
                'type_c'=> $data['type_c'],
                'display_type_c'=>  $data['display_type_c'],
                'custom_c' => $data['custom_c'],
                'user_id' => \auth()->user()->id
            ]);


            if($form)
            {

                //add form created event  here

                FormTranslation::create([
                    'form_id' => $form->id,
                    'country_id' => $data['country'],
                    'display_name_c' => $form->form_name_c,
                    'user_id' => \auth()->user()->id
                ]);

                return $form;
            }

            throw new GeneralException(trans('exceptions.backend.survey.forms.create_error'));
        });
    }

    /**
     * @param Permission  $permission
     * @param array $data
     *
     * @return mixed
     * @throws GeneralException
     */
    public function update(Form $form, array $data)
    {


        // If the name is changing make sure it doesn't already exist
        if ($form->form_name_c !== $data['form_name_c']) {
            if ($this->formExists($data['form_name_c'])) {
                throw new GeneralException('A Form already exists with the name '.$data['form_name_c']);
            }
        }


        return DB::transaction(function () use ($form, $data) {
            if ($form->update([
                'form_name_c' => $data['form_name_c'],
                'display_order_c' => $data["display_order_c"],
                'type_c'=> $data['type_c'],
                'display_type_c'=>  $data['display_type_c'],
                'custom_c' => $data['custom_c'],

            ])) {

                // event(new RoleUpdated($permission));

                return $form;
            }

            throw new GeneralException(trans('exceptions.backend.survey.forms.update_error'));
        });
    }



    /**
     * @param $name
     *
     * @return bool
     */
    protected function formExists($name) : bool
    {
        return $this->model
                ->where('form_name_c', $name)
                ->count() > 0;
    }

}
