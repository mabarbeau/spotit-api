<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Request extends FormRequest
{

    /**
     * Get only the changed values
     * 
     * @return array
     */
    public function getChanges() : array
    {
        $modelName = $this->route()->parameterNames()[0];
        $original = $this->$modelName->getAttributes();

        return array_filter($this->all(), function ($value, $key) use ($original) {
            return isset($original[$key]) && $original[$key] !== $value;
        }, ARRAY_FILTER_USE_BOTH);
    }
}
