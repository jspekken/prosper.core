<?php

namespace Prosper\Core\Http\Requests\Auth;

/**
 * This file is part of the Prosper/Core package.
 *
 * (c) Jelle Spekken <jspekken@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class SpringboardRequest
 * @package Prosper\Core\Http\Requests\Auth
 */
class SpringboardRequest extends FormRequest
{

    /**
     * Pre-authorize the user.
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
            'name' => ['required']
        ];
    }
}