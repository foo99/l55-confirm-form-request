<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Contracts\Validation\Factory as ValidationFactory;
use App\Exceptions\ConfirmRequestValidationException;

trait ConfirmRequestTrait
{
    protected function failedValidation(Validator $validator)
    {
        $failed = $validator->failed();
    
        // 確認画面用フラグのバリデーションを除外
        unset($failed['_confirm']);
        
        // 確認画面用フラグ以外にエラーが無い場合は、確認画面フラグを有効
        if (empty($failed)) {
            request()->merge(['_confirm' => 'true']);
        }
        
        // 確認画面用フラグのバリデーションメッセージを取り除くために
        // ValidationExceptionを継承したExceptionを使用
        throw (new ConfirmRequestValidationException($validator))
                    ->errorBag($this->errorBag)
                    ->redirectTo($this->getRedirectUrl());
    }
    
    public function validator(ValidationFactory $factory)
    {
        // 確認画面用フラグのバリデーションを追加
        $rules = array_merge($this->rules(), [
            '_confirm' => 'required|accepted',
        ]);

        $validator = $factory->make(
            $this->validationData(),
            $rules,
            $this->messages(),
            $this->attributes()
        );

        return $validator;
    }
}
