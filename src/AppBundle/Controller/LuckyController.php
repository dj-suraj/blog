<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class LuckyController extends Controller
{

    /**
     * @Route("/lucky/number/{blog}/{page}")
     * @param $blog
     * @param $page
     * @return Response
     */
    public function numberAction($blog, $page)
    {
        // $number = rand(0,$max_num);

        // return new Response('<html><body>Lucky Number : '. $number .'</body></html>');
        if (!empty($blog)) {
            return new Response('<html><body>Blog : ' . $blog . '. Page : ' . $page . '</body></html>');
        }
    }

    /**
     * @Route("/api/lucky/number")
     */
    public function apiNumberAction()
    {

        $data = ['lucky_number' => rand(0, 100)];
        return new JsonResponse($data);
    }

    /**
     * @Route("/lucky/num", name="_lucky")
     * @throws \Symfony\Component\DependencyInjection\Exception\ServiceCircularReferenceException
     * @throws \Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException
     * @throws \RuntimeException
     */
    public function numAction()
    {
        $lucky_num = rand(0, 100);

        $html = $this->container->get('templating')->render(
            'lucky/number.html.twig',
            ['luckyNumber' => $lucky_num]
        );

        return new Response($html);

    }
}
