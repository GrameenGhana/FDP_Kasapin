<?php
/**
 * Created by PhpStorm.
 * User: spomega
 * Date: 10/28/18
 * Time: 7:13 PM
 */

namespace App\Http\Requests\Backend\Survey\Form;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuestionRequest extends FormRequest

{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'caption_c' => 'required',
            'type_c' => 'required',
            'required_c' => 'required',
            'label_c' => 'required',
            'display_order_c' => 'required',
            'map_object' => 'required',
            'map_field' => 'required'
        ];
    }
}
