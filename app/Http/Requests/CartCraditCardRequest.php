<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CartCraditCardRequest extends FormRequest
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
            'recipient' => 'required|max:255',
            'recipient_mobile' => 'required|regex:/(09)[0-9]{8}/',
            'recipient_county' => 'required|max:255',
            'recipient_district' => 'required|max:255',
            'recipient_zipcode' => 'required|max:255',
            'recipient_address' => 'required|max:255'
        ];
    }

    public function messages()
    {
        return [
           'required' => ':attribute 欄位必需填寫。',
           'max' => ':attribute 不可超過 :max字元。',
           'regex' => ':attribute 不符合驗證格式。'
        ];
    }

    public function attributes()
    {
            return [
                'recipient' => '收件人',
                'recipient_mobile' => '收件人手機號碼',
                'recipient_county' => '收件人城市',
                'recipient_district' => '收件人地區',
                'recipient_zipcode' => '收件人區碼',
                'recipient_address' => '收件人地址'
            ];

    }
}
