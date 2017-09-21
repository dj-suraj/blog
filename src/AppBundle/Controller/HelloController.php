<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use AppBundle\Model\User;

class HelloController extends Controller
{

    /**
     * @Route("/hello/index/{name}/{lname}")
     * @param $lname
     * @param $name
     * @param Request $request
     * @return Response
     */
    public function indexAction($lname, $name, Request $request)
    {
        // return new Response('<html><body>Hello '.$name. ' ' .$lname. '</body></html>');
        // return $this->redirect('http://symfony.com/doc');
        // return new RedirectResponse($this->generateUrl('homepage'));
        // $templating = $this->get('templating');
        // dump($templating);
        // $this->addFlash("notice", "level up!");
        // return new RedirectResponse($this->generateUrl('homepage'));

        // $params = $this->get('router')->generate('blog_show', ['id' => 'my-post', 'category' => 'Symfony']);
        // $params = $this->generateUrl('blog_show', ['id' => 'my-post'], UrlGeneratorInterface::ABSOLUTE_URL);

        $users = [];

        $users[] = new User(1, 'DJ-Kapil', 1);
        $users[] =new User(2, 'DJ-Malita', 1);
        $users[] =new User(3, 'DJ-Suraj', 1);
        $users[] =new User(4, 'DJ-Amir', 1);
        $users[] =new User(5, 'DJ-Madhuri', 1);
        $users[] =new User(6, 'DJ-Ajay', 1);

        return $this->render('blog/cycle.html.twig', ['users' => $users]);
    }

    /**
     * @Route("/hello/show/{slug}", defaults={"slug" = "slug"}, requirements={"slug": "\d+"})
     * @param $slug
     */
    public function showAction($slug)
    {
        dump($slug);
        die();
    }

    /**
     * @Route("/home/{_locale}", defaults={"_locale": "en"}, requirements={"_locale": "en|fr"})
     * @Method({"GET", "HEAD"})
     * @param $_locale
     * @param Request $request
     */
    public function homeAction($_locale, Request $request)
    {
        dump($request->getUser());
        die();
    }
}
