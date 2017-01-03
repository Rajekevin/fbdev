<?php

/**
 * Class UserController
 *
 * @author              Didier Youn <didier.youn@gmail.com>
 * @copyright           Copyright (c) 2016 DidYoun
 * @license             http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @link                http://www.didier-youn.com
 */
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Add like to current picture contest
     *
     * @param Request $request
     * @return string
     */
    public function addLike (Request $request)
    {
        return 'On ajoute un like !';
    }
}
