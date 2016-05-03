<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AddCourseSubjectRequest extends Request
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
            'course_id' => 'required|unique:course_subject,course_id,NULL,id,subject_id,' . Request::get('subject_id'),
            'subject_id' => 'required',
        ];
    }
}
