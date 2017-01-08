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

use App\Helpers\ContestHelper;

class HomeController extends Controller
{
    /**
     * Load homepage and items of current contest
     *
     * @url : /
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        /** @var \App\Helpers\ContestHelper $contestHelper */
        $contestHelper = new ContestHelper();
        /** @var array|bool $contestData */
        $contestData = $contestHelper->getCurrentContestData();

        return view('frontend.html.index', ['contestData' => $contestData]);
    }

    /**
     * Load rules view
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function rules()
    {
        return view('frontend.html.pages.rules');
    }

    /**
     * Load CGU view
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function cgu()
    {
        return view('frontend.html.pages.cgu');
    }
}
