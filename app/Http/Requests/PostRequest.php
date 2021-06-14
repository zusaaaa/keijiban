<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * ユーザーがこのリクエストの権限を持っているかを判断する.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * リクエストに適用するバリデーションルールを取得
     *
     * @return array
     */
    public function rules()
    {
        return [
            "title" => "required|max:20",
            "body"  => "required"
        ];
    }

    /**
     * バリデーションエラー文を表示
     *
     * @return string
     */
    public function messages()
    {
        return [
            "title.required" => "タイトルは必須です。",
            "title.max"      => "タイトルは20文字以内で記入してください。",
            "body.required"  => "内容は必須です。"
        ];
    }
}
