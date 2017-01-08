<?php

/**
 * Class ParticipateController
 *
 * @author              Didier Youn <didier.youn@gmail.com>
 * @copyright           Copyright (c) 2016 DidYoun
 * @license             http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @link                http://www.didier-youn.com
 */
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Helpers\FunnelHelper;
use App\Helpers\ContestHelper;
use App\Helpers\UserFacebookHelper;

class ParticipateController extends Controller
{
    /**
     * Load choose pictures view
     *
     * @url : /participate/choose-your-picture
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function choose()
    {
        /** @var \App\Helpers\UserFacebookHelper $userFbHelper */
        $userFbHelper = new UserFacebookHelper();
        /** @var \App\Helpers\FunnelHelper $funnelHelper */
        $funnelHelper = new FunnelHelper();
        /** @var array $albums */
        $albums = $userFbHelper->getAlbums();

        $funnelHelper->initFunnelParticipation();

        return view('frontend.html.pages.funnel.choose', ['albums' => $albums]);
    }

    /**
     * Load valid picture view
     *
     * @url : /participate/valid-your-picture
     * @return bool|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function valid()
    {
        /** @var \App\Helpers\FunnelHelper $funnelHelper */
        $funnelHelper = new FunnelHelper();
        $pictureId = 'https://scontent-cdg2-1.xx.fbcdn.net/v/l/t1.0-9/14322278_10210800817956318_4011993129875928157_n.jpg?oh=72c49d9d4654652032972e05bdc4ae9e&oe=58E5B5D6';
        if (!$funnelHelper->saveTmpPhoto($pictureId)) {
            return false;
        }
        return view('frontend.html.pages.funnel.validate', ['tmp_photo' => $pictureId]);
    }

    /**
     * Load success view
     *
     * @url : /participate/success
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function success(Request $request)
    {
        /** @var \App\Helpers\ContestHelper $contestHelper */
        $contestHelper = new ContestHelper();
        /** @var \App\Helpers\FunnelHelper $funnelHelper */
        $funnelHelper = new FunnelHelper();
        if (!$contestHelper->addPhotoToContest($request)) {
            return redirect('/participate/choose-your-picture');
        }
        /*
         * Destroy all previous data after success page
         */
        $funnelHelper->deleteTmpUserParticipation();

        return view('frontend.html.pages.funnel.success');
    }
}
