<?php

/**
 * Class UserFacebookHelper
 *
 * @author              Didier Youn <didier.youn@gmail.com>
 * @copyright           Copyright (c) 2016 DidYoun
 * @license             http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @link                http://www.didier-youn.com
 */
namespace App\Helpers;

use App\Picture;

class UserFacebookHelper extends FacebookHelper
{
    /**
     * @var array $fieldPhotosRequest
     */
    protected $fieldPhotosRequest = array('created_time', 'source', 'images', 'name');
    /** @var \App\Picture $picture */
    protected $picture;

    /**
     * UserFacebookHelper constructor.
     */
    public function __construct()
    {
        $this->picture = new Picture();
    }

    /**
     * Get albums and photos
     *
     * @return array
     */
    public function getAlbums()
    {
        /** @var array $albumsPhotoData */
        $albumsPhotoData = [];
        /** @var array $albums */
        $albums = $this->facebook->get('/me/albums', $this->userAccessToken)->getDecodedBody();
        /** @var array $album */
        foreach ($albums['data'] as $album) {
            if (!isset($album['id'])) {
                continue;
            }
            /** @var array $photosAlbum */
            $photosAlbum = $this->getPhotosFromAlbumId($album['id']);
            $albumsPhotoData[] = [
                'id' => $album['id'],
                'name' => $album['name'],
                'photos' => $photosAlbum
            ];
        }

        return $albumsPhotoData;
    }

    /**
     * Get photos from album id
     *
     * @param $albumId
     * @return bool|array
     */
    public function getPhotosFromAlbumId($albumId)
    {
        /** @var array $photos */
        $photos = [];
        /** @var array $facebookPhotoRequest */
        $facebookPhotoRequest = $this->facebook->get($albumId . '/photos/uploaded?fields=' . implode(',', $this->fieldPhotosRequest), $this->userAccessToken)->getDecodedBody();
        if (!isset($facebookPhotoRequest) || !isset($facebookPhotoRequest['data'])) {
            return false;
        }
        /** @var array $photo */
        foreach ($facebookPhotoRequest['data'] as $photo) {
            /** @var null $photoName */
            $photoName = null;
            if (isset($photo['name'])) {
                /** @var string $photoName */
                $photoName = $photo['name'];
            }
            $photos[] = [
                'id'            => $photo['id'],
                'picture'       => $photo['source'],
                'size'          => $photo['images'],
                'name'          => $photoName,
                'created_time'  => $photo['created_time']
            ];
        }

        return $photos;
    }

    /**
     * Share picture in user wall
     *
     * @param string $pictureId
     * @return bool
     */
    public function sharePicture($pictureId)
    {
        if (!isset($pictureId) || !$pictureId) {
            return false;
        }
        /** @var array $pictureData */
        $pictureData = $this->picture->load($pictureId);
        if (!isset($pictureData) || !isset($pictureData['link']) || !isset($pictureData['title'])
            || !isset($pictureData['location'])
        ) {
            return false;
        }
        // @TODO : chopper les bonnes datas
        $feedData = [
            "access_token"  => $this->userAccessToken,
            "message"       => "Bonjour",
            "link"          => 'test',
            "picture"       => $pictureData['link'],
            "name"          => $pictureData['title'],
            "caption"       => $pictureData['location'],
            "description"   => "Bonjour"
        ];
        try {
            $result = $this->facebook->post('/me/feed', $feedData, $this->userAccessToken);
            if ($result) {
                return true;
            }
            return false;
        } catch(\Facebook\Exceptions\FacebookResponseException $e) {
            return false;
        } catch(\Facebook\Exceptions\FacebookSDKException $e) {
            return false;
        }
    }
}