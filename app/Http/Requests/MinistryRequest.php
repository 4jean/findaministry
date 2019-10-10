<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\MyHelper\Fam;

class MinistryRequest extends FormRequest
{

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
        return ($this->method() === 'POST')  ? $this->rulesCreate() : ($this->method() === 'PUT') ? $this->rulesUpdate() : [];
    }

    public function attributes()
    {
        return  [
            'phone1' => 'Telephone',
            'phone2' => 'Mobile',
            'fb' => 'Facebook url',
            'yt' => 'Youtube url',
            'tw' => 'Twitter url',
            'inst' => 'Instagram url',
            'min_cat_id' => 'Ministry Category',
            'state' => 'State',
            'country' => 'Country',
            'min_photo' => 'Ministry Photo',
        ];
    }

    protected function getValidatorInstance()
    {
        $input = $this->all();

        $input['min_cat_id'] = Fam::decodeHash($input['min_cat_id']);

        $this->getInputSource()->replace($input);

        return parent::getValidatorInstance();
    }

   protected function rulesCreate()
   {
       return [
           'name' => 'required|string|min:10|max:50',
           'description' => 'required|string',
           'city' => 'sometimes|nullable|string|min:3|max:20',
           'postal_code' => 'sometimes|nullable|string|min:4|max:10',
           'phone1' => 'sometimes|nullable|string|min:6|max:15',
           'phone2' => 'sometimes|nullable|string|min:6|max:15',
           'website' => 'sometimes|nullable|url|min:10|max:200',
           'fb' => 'sometimes|nullable|url|min:10|max:200',
           'yt' => 'sometimes|nullable|url|min:10|max:200',
           'tw' => 'sometimes|nullable|url|string|min:5|max:200',
           'inst' => 'sometimes|nullable|url|string|min:5|max:200',
           'email' => 'sometimes|nullable|email|min:8|max:100',
           'min_photo' => 'sometimes|nullable|image|mimes:jpeg,gif,png,jpg|max:2048',
           'keywords' => 'sometimes|nullable|string|min:3|max:100',
           'founder' => 'sometimes|nullable|string|min:6|max:100',
           'address' => 'required|string|min:6|max:120',
           'min_cat_id' => 'required|exists:min_cats,id',
           'country' => 'required|string',
           'state' => 'required|string',
       ];
   }

   protected function rulesUpdate()
   {
       return [
           'description' => 'required|string',
           'postal_code' => 'sometimes|nullable|string|min:4|max:10',
           'city' => 'sometimes|nullable|string|min:3|max:20',
           'phone1' => 'sometimes|nullable|string|min:6|max:15',
           'phone2' => 'sometimes|nullable|string|min:6|max:15',
           'website' => 'sometimes|nullable|url|min:10|max:200',
           'fb' => 'sometimes|nullable|url|min:10|max:200',
           'yt' => 'sometimes|nullable|url|min:10|max:200',
           'tw' => 'sometimes|nullable|url|string|min:5|max:200',
           'inst' => 'sometimes|nullable|url|string|min:5|max:200',
           'email' => 'sometimes|nullable|email|min:8|max:100',
           'min_photo' => 'sometimes|nullable|image|mimes:jpeg,gif,png,jpg|max:2048',
           'keywords' => 'sometimes|nullable|string|min:3|max:100',
           'founder' => 'sometimes|nullable|string|min:6|max:100',
           'address' => 'required|string|min:6|max:120',
           'min_cat_id' => 'required|exists:min_cats,id',
       ];
   }
}
