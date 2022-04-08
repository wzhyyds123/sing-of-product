<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class Add extends FormRequest
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
               'work'=>'required',
               'creativetime'=>'required',
               'worktime'=>'required',
               'singer'=>'required',
               'brief'=>'required',
               'song'=>'required',
               'mp3'=>'required',
               'copyright'=>'required',
               'plphone'=>'required',
               'plname'=>'required',
               'composer'=>'required',
               'lyrics'=>'required',
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        throw (new HttpResponseException(json_fail('参数错误!',$validator->errors()->all(),422)));
    }
}
