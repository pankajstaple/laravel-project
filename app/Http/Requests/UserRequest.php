<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
             'first_name' => 'required|max:255',
             'last_name' => 'required|max:255',
             'email' => 'required|email|unique:users,email,:id',
             'password' => 'required|min:6',
             'profile_image' => 'image|mimes:jpeg,jpg,png|max:10000',

        ];
    }

    public function response(array $errors)
    {

      return $this->redirector->to($this->getRedirectUrl())
               ->withInput($this->except($this->dontFlash))
               ->withErrors($errors, $this->errorBag);    
    }

    public function validate(array $input, $id = 0)
    {
        $validator = $this->validator->make($input, $this->rules($id));
        
        if($validator->fails()) throw new InvalidInputException();
        
    }
}
