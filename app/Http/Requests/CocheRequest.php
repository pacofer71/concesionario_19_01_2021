<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Rules\KilometrosRule;

class CocheRequest extends FormRequest
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
    public function prepareForValidation(){
        if(is_uploaded_file($this->foto)){
            $nombre='img/coches/'.uniqid()."_".$this->foto->getClientOriginalName();
            Storage::disk('public')->put($nombre, File::get($this->foto));
            $this->merge([
                'nombre_foto'=>"storage/$nombre"
            ]);

        }
        if($this->marca_id==-1){
            $this->merge(['marca_id'=>null]);
        }
        $this->merge([
            'modelo'=>ucwords($this->modelo),
            'color'=>ucwords($this->color)
        ]);

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'modelo'=>['required'],
            'color'=>['required'],
            'foto'=>['nullable', 'image'],
            'kilometros'=>[new KilometrosRule()],
            'nombre_foto'=>['nullable'],
            'marca_id'=>['nullable']
        ];
    }
    public function messages(){
        return [
            'modelo.required'=>'El modelo es obligatorio.',
            'color.required'=>'El color es obligatorio.',
            'foto.image'=>"EL archivo debe tener formato de imagen.",
            'kilometros.digits_between'=>'Número de kilometros erroneo'
        ];
    }
}
