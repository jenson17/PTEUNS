<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EvaluacionFormRequest extends FormRequest
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
            'titulo' => 'required|unique:evaluacions',
            'clase_id' => 'required',
            'pregunta1' => 'required',
            'pregunta2' => 'required',
            'pregunta3' => 'required',
            'pregunta4' => 'required',
            'pregunta5' => 'required',
            'pregunta6' => 'required',
            'pregunta7' => 'required',
            'pregunta8' => 'required',
            'pregunta9' => 'required',
        ];

        foreach($this->request->get('res1') as $key => $val)
        {
          $rules['res1.'.$key] = 'required';
        }

        foreach($this->request->get('res2') as $key => $val)
        {
          $rules['res2.'.$key] = 'required';
        }

        foreach($this->request->get('res3') as $key => $val)
        {
          $rules['res3.'.$key] = 'required';
        }

        foreach($this->request->get('res4') as $key => $val)
        {
          $rules['res4.'.$key] = 'required';
        }

        foreach($this->request->get('res5') as $key => $val)
        {
          $rules['res5.'.$key] = 'required';
        }

        foreach($this->request->get('res6') as $key => $val)
        {
          $rules['res6.'.$key] = 'required';
        }

        foreach($this->request->get('res7') as $key => $val)
        {
          $rules['res7.'.$key] = 'required';
        }

        foreach($this->request->get('res8') as $key => $val)
        {
          $rules['res8.'.$key] = 'required';
        }

        foreach($this->request->get('res9') as $key => $val)
        {
          $rules['res9.'.$key] = 'required';
        }

        return $rules;
    }
}
