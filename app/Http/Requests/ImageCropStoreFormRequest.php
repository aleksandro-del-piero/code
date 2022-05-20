<?php

namespace App\Http\Requests;

use App\DTO\ImageCropDto;
use Illuminate\Foundation\Http\FormRequest;

class ImageCropStoreFormRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'image' => ['required', 'image']
        ];
    }

    public function messages()
    {
        return [
            'image' => 'Uploaded file must be an image'
        ];
    }

    /**
     * @return ImageCropDto
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     */
    public function getDto() : ImageCropDto
    {
        return new ImageCropDto($this->validated());
    }
}
