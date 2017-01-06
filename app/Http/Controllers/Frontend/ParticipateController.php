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

use App\Helpers\UserFacebookHelper;
use App\Helpers\FunnelHelper;

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
        $pictureId = 'https://scontent.xx.fbcdn.net/v/t1.0-9/1606843_10203030294619635_191121620_n.jpg?oh=225ad1b14de32bc698015b3eaefd757d&oe=5916AFB5';
        if (!$funnelHelper->saveTmpPhoto($pictureId)) {
            return false;
        }
        return view('frontend.html.pages.funnel.validate', ['tmp_photo' => $pictureId]);
    }

    /**
     * Load success view
     *
     * @url : /participate/success
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function success()
    {
        return view('frontend.html.pages.funnel.success');
    }
}
