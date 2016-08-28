<?php
/**
 * Created by PhpStorm.
 * User: kpicaza
 * Date: 28/08/16
 * Time: 12:21
 */

namespace App\Front\Controller;


use Symfony\Component\HttpFoundation\Request;

class IndexController
{
    private $twig;

    public function __construct(\Twig_Environment $twig)
    {
        $this->twig = $twig;
    }

    public function indexAction(Request $request)
    {
        return $this->twig->render(
            'default/index.html.twig'
        );
    }
}