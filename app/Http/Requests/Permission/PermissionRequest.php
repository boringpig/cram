<?php

namespace App\Http\Requests\Permission;

use App\Http\Requests\Request;
use App\Models\Permission;

class PermissionRequest extends Request
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
        $rules = [
            'name' => 'required|unique:permissions'
        ];

        if(isset($_REQUEST['id'])){
            $permission = Permission::find($_REQUEST['id']);
            if($_REQUEST['name'] === $permission->name){
                $rules['name'] = 'required';
            }
        }

        return $rules;
    }
}
