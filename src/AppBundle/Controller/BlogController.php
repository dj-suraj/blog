<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BlogController extends Controller
{

    public function listAction()
    {
        $posts = $this->get('doctrine')
        ->getManager()
        ->createQuery('SELECT p FROM AppBundle:Post p')
        ->execute();

        return $this->render('blog/list.html.php', ['posts' => $posts]);
    }

    public function showAction()
    {
        $post = $this->get('doctrine')
        ->getManager()
        ->getRepository('AppBundle:Post')
        ->find($id);

        if (!$post) {
            throw $this->createNotFoundException();
        }

        return $this->render('blog/show.html.php', ['post' => $post]);
    }
}
