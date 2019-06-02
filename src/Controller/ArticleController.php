<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Service\ArticleService;
use App\Entity\Article;
use App\Entity\User;
use App\Form\ArticleType;
class ArticleController extends AbstractController
{
    /**
     * @Route("/articles", name="article_list")
     */
    public function list( Request $request, ArticleService $articleService ){
        $query = $request->query->get( 'query' );
        $sort = $request->query->get( 'sort', 'id' );
        if( !empty( $query ) ){
            $articles = $articleService->search( $query, $sort );
        }else{
            $articles = $articleService->getAll( $sort );
        }
        return $this->render( 'article/list.html.twig', array(
            'articles' => $articles,
            'incomingCounter' => $articleService->countIncoming(),
        ));
    }
    /**
     * @Route("/article/add", name="article_add")
     */
    public function add( Request $request ){
        $article = new article();
        $form = $this->createForm( ArticleType::class, $article );
        $form->handleRequest( $request );
        if( $form->isSubmitted() && $form->isValid() ){
            $article->setOwner( $this->getUser() );
            $em = $this->getDoctrine()->getManager();
            $em->persist( $article );
            $em->flush();
            return $this->redirectToRoute( 'article_show', array(
                'id' => $article->getId(),
            ));
        }
        return $this->render( 'article/add.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    /**
     * @Route("/article/{id}", name="article_show", requirements={"id"="\d+"})
     */
    public function show( ArticleService $articleService, $id ){
        $article = $articleService->get( $id );
        if( empty( $article ) ){
            return new Response( 'article Not Found', 404 );
        }
        return $this->render( 'article/show.html.twig', array(
            'article' => $article,
        ));
    }
    
}