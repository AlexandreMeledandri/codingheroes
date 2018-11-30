<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Comment;
use App\Form\CommentType;
use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use App\Entity\Category;
use App\Form\ArticleType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class NewsController extends AbstractController
{
    /**
     * @Route("/news", name="news")
     */
    public function index(ArticleRepository $repo)
    {
        $articles = $repo->findAll();

        return $this->render('news/index.html.twig', [
            'controller_name' => 'NewsController',
            'articles' => $articles // il fallait un 's' à 'articles' (ᵔᴥᵔ)
        ]);
    }
    /**
    * @Route("/", name="home")
    */
    public function home()
    {
        return $this->render('news/home.html.twig', [
            'title' => 'Coding Heroes',
            'text' => 'Itescia social network'
        ]);
    }

    /**
    * @Route("/news/new", name="news_create")
    * @Route("/news/{id}/edit", name="news_edit")
    */
    public function create(Article $article = null, Request $request, ObjectManager $manager)
    {
        if(!$article)
        {
            $article = new Article();
        }

 /*       $form = $this->createFormBuilder($article)
                     ->add('title')
                     ->add('content')
                     ->getForm(); */
          $form = $this->createForm(ArticleType::class, $article);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($article);
            $manager->flush();

            return $this->redirectToRoute('news_show', ['id' => $article->getId()]);
        }
        return $this->render('news/create.html.twig', ['formArticle' => $form->createView(), 'editMode' => $article->getId() !== null]);
    }
    /**
    * @Route("/news/{id}", name="news_show")
    */
    public function show(Article $article, Request $request, ObjectManager $manager)
    {
        $comment = new Comment();

        $form = $this->createForm(CommentType::class, $comment);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $comment->setCreatedAt(new \DateTime());
            $comment->setArticle($article);

            $manager->persist($comment);
            $manager->flush();

            return $this->redirectToRoute('news_show', ['id' => $article->getId()]);
        }

        return $this->render('news/show.html.twig', [
            'article'=> $article,
            'commentForm' => $form->createView()
            ]);
    }
}
