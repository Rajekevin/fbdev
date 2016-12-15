<?php

/**
 * Class HomeController
 *
 * @author              Didier Youn <didier.youn@gmail.com>
 * @copyright           Copyright (c) 2016 DidYoun
 * @license             http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @link                http://www.didier-youn.com
 */
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        return view('frontend.html.index');
    }
}
