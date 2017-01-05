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

class UserFacebookHelper extends FacebookHelper
{
    /**
     * @var array $fieldPhotosRequest
     */
    protected $fieldPhotosRequest = array('created_time', 'source', 'images', 'name');

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
}