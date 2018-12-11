<?php
/**
 * Created by PhpStorm.
 * User: spomega
 * Date: 10/17/18
 * Time: 1:41 PM
 */

namespace App\Http\Requests\Backend\Survey\Form;


use Illuminate\Foundation\Http\FormRequest;

class UpdateFormRequest extends FormRequest
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
            'form_name_c' => 'required',
            'display_order_c' => 'required',
            'display_type_c' => 'required',
        ];
    }
}
