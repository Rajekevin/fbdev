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
    // @TODO : Déplacer ces méthodes dans les classes appropriées

    public function addLike (Request $request)
    {
        /** @TODO : Mettre ça dans un putain de middleware */
        if(!$request->isXmlHttpRequest()) {
            return false;
        }

        return 'On ajoute un like !';
    }

    public function addPicture (Request $request)
    {
        if(!$request->isXmlHttpRequest()) {
            return false;
        }

        return 'On ajoute une photo !';
    }
}
