<?php

namespace App\Http\Requests;

use App\DTO\UserRegisterDto;
use App\Models\Position;
use App\Models\User;
use App\Rules\UniqueUserPhoneRule;
use App\Services\ApiValidationService;
use App\Services\TokenService;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UserStoreFormRequest
 * @package App\Http\Requests
 */
class UserStoreFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        /** @var ApiValidationService $apiTokenValidationService */
        $apiTokenValidationService = app()->make(ApiValidationService::class);

        return $apiTokenValidationService->checkRelevanceHeaderApiToken($this->header('token'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'min:2', 'max:60'],
            'email' => ['required', 'min:2', 'max:100', 'email', 'unique:'.User::class.',email'],
            'phone' => ['required', 'min:9', 'strong_phone', new UniqueUserPhoneRule()],
            'position_id' => ['required', 'numeric', 'exists:'.Position::class.',id'],
            'photo' => ['required', 'image', 'mimes:jpeg,jpg', 'max:5000']
        ];
    }

    public function messages()
    {
        return [
            'position_id.exists' => 'User`s position id. You can get list of all positions with their IDs using the API method GET api/v1/positions'
        ];
    }

    /**
     * @return UserRegisterDto
     */
    public function getDto() : UserRegisterDto
    {
        return new UserRegisterDto(
            array_merge(
                $this->validated(),
                ['token' => $this->header('token')]
            )
        );
    }
}
