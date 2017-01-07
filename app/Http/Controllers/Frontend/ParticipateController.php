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

use App\Picture;
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
        $pictureId = 'https://scontent.xx.fbcdn.net/v/t31.0-8/q84/s720x720/1063682_10201495830899001_1295309547_o.jpg?oh=a5e470aee1d835fd9c9ba354ce3494b8&oe=58DB33D3';
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
        /** @var \App\Picture $picture */
        $picture = new Picture();
        if (!$picture->savePicture([
            'link'          => $request->input('link'),
            'title'         => $request->input('title'),
            'description'   => $request->input('description'),
            'location'      => $request->input('location'),
            'author'        => $request->input('author'),
        ])) {
            return redirect('/participate/choose-your-picture');
        }

        return view('frontend.html.pages.funnel.success');
    }
}
