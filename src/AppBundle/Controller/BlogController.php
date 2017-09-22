<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Model\Blogs;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class BlogController extends Controller
{

    /**
     * @Route("/blog/new", name="new_blog")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request)
    {

        $blog = new Blogs();
//        $blog->setTitle("First Blog");
//        $blog->setDescription("This is my first blog");
//        $blog->setIsActivated(true);

        $form = $this->createFormBuilder($blog)
            ->add('title', TextType::class, array('attr' => array('class' => 'form-control')))
            ->add('description', TextareaType::class, array('attr' => array('class' => 'form-control')))
            ->add('save', SubmitType::class, array('attr' => array('class' => 'btn btn-primary form-control')))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            return $this->redirectToRoute('new_blog');
        }

        return $this->render('default/new.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route("/blog/blog", name="new_blog1")
     */
    public function blogAction() {

        $blog = new Blogs();

        $form = $this->createForm(\BlogType::class, $blog);
        return $this->render('default/new.html.twig', array('form' => $form->createView()));
    }

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
            ->find(1);

        if (!$post) {
            throw $this->createNotFoundException();
        }

        return $this->render('blog/show.html.php', ['post' => $post]);
    }
}
