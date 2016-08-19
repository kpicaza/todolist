<?php
/**
 * Created by PhpStorm.
 * User: kpicaza
 * Date: 13/08/16
 * Time: 21:30
 */

namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;

class IndexController
{
    public function indexAction()
    {
        return new Response('<div class="welcome">Welcome to In Famework app</div>');
    }
}
