<?php
/**
 * Created by PhpStorm.
 * User: spomega
 * Date: 11/22/18
 * Time: 12:51 PM
 */
namespace App\Http\Requests\Backend\Auth\Api;




use Illuminate\Foundation\Http\FormRequest;

class LoginUserRequest extends FormRequest

{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //return $this->user()->isAdmin();
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
            'email' => 'required|string|email|max:255',
            'password'=> 'required',
        ];
    }
}
