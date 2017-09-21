<?php

namespace AppBundle\Entity\Model;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\Response;

/**
 * Blog
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Model\BlogRepository")
 */
class Blog
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_activated", type="boolean")
     */
    private $isActivated;

    /**
     * @var integer
     *
     * @ORM\Column(name="user_id", type="integer")
     */
    private $userId;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Blog
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Blog
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set isActivated
     *
     * @param boolean $isActivated
     * @return Blog
     */
    public function setIsActivated($isActivated)
    {
        $this->isActivated = $isActivated;

        return $this;
    }

    /**
     * Get isActivated
     *
     * @return boolean
     */
    public function getIsActivated()
    {
        return $this->isActivated;
    }

    /**
     * Set userId
     *
     * @param integer $userId
     * @return Blog
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return integer
     */
    public function getUserId()
    {
        return $this->userId;
    }

    public function createAction()
    {
        $blog = new self();
        $blog->setTitle('First Blog');
        $blog->setDescription('This is my first blog');
        $blog->setIsActivated(false);
        $blog->setUserId(1);

        $em = $this->getDoctrine()->getManager();

        // tell Doctrine to save the Product eventually
        $em->persist($blog);

        // actually executes the queries ..
        $em->flush();

        return new Response('Blog saved!');
    }

    public function showAction($blogId)
    {
        $blog = $this->getDoctrine()->getRepository('AppBundle:Blog')->find($blogId);

        if (!$blog) {
            return new Response('No blog found for ID ' . $blogId);
        }
    }

    public function updateAction($blogId, $updatedBlogInfo)
    {
        $em = $this->getDoctrine()->getManager();
        $blog = $em->getRepository('AppBundle:Blog')->find($blogId);

        if(!$blog) {
            return new Response('No blog found for ID ' . $blogId);
        }

        $blog->setTitle($updatedBlogInfo['title']);
        $em->flush();

        return $this->redirectToRoute('/');
    }

    public function deleteAction($blogId)
    {
        $em = $this->getDoctrine()->getManager();
        $blog = $em->getRepository('AppBundle:Blog')->find($blogId);

        if(!$blog) {
            return new Response('No blog found for ID ' . $blogId);
        }

        $em->remove($blogId);
        $em->flush();

        return $this->redirectToRoute('/');
    }

    public function searchAction($title) {


//        $em = $this->getDoctrine()->getManager();
//        $query = $em->createQuery(
//            'SELECT * from AppBundle:Blog b where b.title like \':title\''
//        )->setParameter('title', $title);
//
//        $blogs = $query->getResult();

        $repository = $this->getDoctrine()->getRepository('AppBundle:Blog');

        $query = $repository->createQueryBuilder('b')
            ->where('b.title like \':title\'')
            ->setParameter('title', $title)
            ->orderBy('b.title', 'ASC')
            ->getQuery();

        $blogs = $query->getResult();

        return $this->redirectToRoute('/');
    }


}
