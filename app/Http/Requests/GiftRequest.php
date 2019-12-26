<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GiftRequest extends FormRequest
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
             'discount' => 'required|numeric',
             'code' => 'required|max:250',
       
        ];
    }

    /* Return error messages response as per request type */
    public function response(array $errors)
    {
        if ($this->ajax())
        {
            return new JsonResponse(array('errors' => $errors));
        }
        else
        {
            return $this->redirector->to($this->getRedirectUrl())
                   ->withInput($this->except($this->dontFlash))
                   ->withErrors($errors, $this->errorBag);    
        }
    }

    public function validate(array $input, $id = 0)
    {
        $validator = $this->validator->make($input, $this->rules($id));
        
        if($validator->fails()) throw new InvalidInputException();
        
    }
}
