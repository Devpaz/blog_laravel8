<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array {
        switch ($this->method()) {
            case "POST": {
                return [
                    "name" => "required|max:140|unique:projects",
                    "description" => "nullable|string|min:10"
                ];
            }
            case "PUT": {
                return [
                    "name" => "required|unique:projects,name," . $this->route("project"),
                    "description" => "nullable|string|min:10"
                ];
            }
            default: {
                return [];
            }
        }
    }
}
