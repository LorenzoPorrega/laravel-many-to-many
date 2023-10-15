<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProjectUpsertRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 */
	public function authorize(): bool
	{
		// retrieve the logged authenticated user
		$user = Auth::user();

		// if user->mail === "" then return true, user is authorized (to do something on the website)
		if ($user->email === "porronet99@hotmail.it") {
			return true;
		}
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
	 */
	public function rules(): array
	{
		return [
			"title" => "required|string",
			/* "language" => "required|string", */
			// Exists makes sure that the passed types_id is present in the types table to be inputted in the projects table
			"type_id" => "required|exists:types,id",
			"link" => "required|string",
			"description" => "required|string",
			"thumb" => "nullable|image|max:10240",
			"thumb_link" => "nullable|max:255",
			"release" => "required|date"
		];
	}

	/**
	 * Get the error messages for the defined validation rules.
	 *
	 * @return array<string, string>
	 */
	public function messages(): array
	{
		return [
			'title.required' => 'A title is required.',
			'link.required' => 'A link to the repository is required.',
			'description.required' => 'A description is required.',
			'thumb.required' => 'Maximum thumb image size is 10MB.',
			'language.required' => 'The repository language is required.',
			'release.required' => 'The release date is required.',
		];
	}
}
