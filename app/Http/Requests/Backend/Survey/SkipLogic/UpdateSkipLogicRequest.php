<?php
/**
 * Created by PhpStorm.
 * User: spomega
 * Date: 10/17/18
 * Time: 1:41 PM
 */

namespace App\Http\Requests\Backend\Survey\SkipLogic;


use Illuminate\Foundation\Http\FormRequest;

class UpdateSkipLogicRequest extends FormRequest
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
            'question' => 'required',
            'formula_c' => 'required',
        ];
    }
}
