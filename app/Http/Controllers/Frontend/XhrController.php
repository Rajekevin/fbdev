<?php

/**
 * Class XhrController
 *
 * @author              Didier Youn <didier.youn@gmail.com>
 * @copyright           Copyright (c) 2016 DidYoun
 * @license             http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @link                http://www.didier-youn.com
 */
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

use App\Helpers\UserHelper;
use App\Helpers\FacebookHelper;
use App\Helpers\UserFacebookHelper;

class XhrController extends Controller
{
    /** @var \App\Helpers\UserHelper */
    protected $userHelper;
    /** @var \App\Helpers\UserFacebookHelper $fbUserHelper */
    protected $fbUserHelper;
    /** @var \App\Helpers\FacebookHelper$fbHelper */
    protected $fbHelper;

    /**
     * Return albums as JSON
     *
     * @return string
     */
    public function getAlbums()
    {
        $this->fbUserHelper = new UserFacebookHelper();

        return json_encode($this->fbUserHelper->getAlbums());
    }

    /**
     * Return photo from albumId as JSON
     *
     * @param string $albumId
     * @return string
     */
    public function getPhotoFromAlbumId($albumId)
    {
        $this->fbUserHelper = new UserFacebookHelper();

        return json_encode($this->fbUserHelper->getPhotosFromAlbumId($albumId));
    }
}
