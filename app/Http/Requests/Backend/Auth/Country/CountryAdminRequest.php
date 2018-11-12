<?php
/**
 * Created by PhpStorm.
 * User: spomega
 * Date: 10/28/18
 * Time: 7:13 PM
 */

namespace App\Http\Requests\Backend\Auth\Country;




use Illuminate\Foundation\Http\FormRequest;

class CountryAdminRequest extends FormRequest

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
            //
        ];
    }
}
