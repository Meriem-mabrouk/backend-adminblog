<?php

namespace App\Controller;

use App\Entity\Blog;
use App\Form\BlogType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{


    //***********************************Admin start***********************************************************//
    /**
     * @Route("/", name="display_blog")
     */
    public function index(): Response
    {

        $blogs = $this->getDoctrine()->getManager()->getRepository(Blog::class)->findAll();
        return $this->render('blog/index.html.twig', [
            'b'=>$blogs
        ]);
    }



    /**
     * @Route("/admin", name="display_admin")
     */
    public function indexAdmin(): Response
    {

        return $this->render('Admin/index.html.twig');
    }


    /**
     * @Route("/addBlog", name="addBlog")
     */
    public function addBlog(Request $request): Response
    {
        $blog = new Blog();

        $form = $this->createForm(BlogType::class,$blog);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($blog);//Add
            $em->flush();

            return $this->redirectToRoute('display_blog');
        }
        return $this->render('blog/createBlog.html.twig',['f'=>$form->createView()]);




    }

    /**
     * @Route("/removeBlog/{id}", name="supp_blog")
     */
    public function suppressionBlog(Blog  $blog): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($blog);
        $em->flush();

        return $this->redirectToRoute('display_blog');


    }
    /**
     * @Route("/modifBlog/{id}", name="modifBlog")
     */
    public function modifBlog(Request $request,$id): Response
    {
        $blog = $this->getDoctrine()->getManager()->getRepository(Blog::class)->find($id);

        $form = $this->createForm(BlogType::class,$blog);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute('display_blog');
        }
        return $this->render('blog/updateBlog.html.twig',['f'=>$form->createView()]);




    }

    //***********************************Admin End***********************************************************//



    //***********************************Client Start***********************************************************//
    /**
     * @Route("/client", name="display_client")
     */
    public function indexClient(): Response
    {

        return $this->render('Client/index.html.twig');
    }

    //***********************************Client End***********************************************************//


}