<?php

/**
 * Class ContestController
 *
 * @author              Didier Youn <didier.youn@gmail.com>
 * @copyright           Copyright (c) 2016 DidYoun
 * @license             http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @link                http://www.didier-youn.com
 */
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContestController extends Controller
{
    public function getPicturesByLike()
    {
        return('Filtre par like');
    }

    public function getPicturesByNewest()
    {
        return('Filtre par nouveauté');
    }

    public function getPicturesByAlphabetical()
    {
        return('Filtre par alphabet');
    }
}
