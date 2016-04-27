<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Filmes;
use AppBundle\Entity\Genero;

class FilmesController extends Controller {

    /**
     * @return \Doctrine\ORM\EntityManager
     */
    
    private function getEm()
    {
        return $this->getDoctrine()->getManager();
    }
    
    /**
     * @Route("/filmes", name="filmes_index")
     */
    public function indexAction() {
        
        //Model
        $filmes = $this->getEm()->getRepository('AppBundle:Filmes');
        $retorno = $filmes-> findAll();
        
        /*filmes->findBy(
                array('genero' => 'Terror',
                    'lancamento' => false
                    )
                ); */
                
        //findByGenero('Terror');
        //findAll()
        
        //View
        return $this->render('filmes/index.html.twig', 
                array('filmes'=>$retorno)
        );
    }

    /**
     * @Route("/filmes/cadastro")
     */
   
    public function cadastroAction() {
        $filme = new Filmes();
        $filme->setGenero('Terror');
        $filme->setLancamento(false);
        $filme->setNome('Donnie Dark');

        $doctrine = $this->getEm();
        $doctrine->persist($filme);
        $doctrine->flush();

        return $this->render('filmes/cadastro.html.twig');
    }
    
    /**
     * @Route("/filmes/genero", name="genero_index")
     */
    
    public function generoAction()
    {
        $repositorio = $this->getEm()->getRepository('AppBundle:Genero');
        
        $dados = $repositorio-> findBy(array(), array('nome' => "ASC"));
        
        //DESC é ordem decrescente
        
        return $this->render('filmes/genero.html.twig', array(
            'dados' => $dados
        ) );
    }
    
    /**
     * @Route("/filmes/genero/cadastro", name="genero_cadastro")
     */
    
    public function generoCadastroAction()
    {
        return $this->render('filmes/genero-cadastro.html.twig');
    }
    
     /**
     * @Route("/filmes/genero/criar")
     */
    
    public function criarGeneroAction(Request $request)
    {
        $nomeGenero = $request->get('nome');
        
        $genero = new Genero();
        $genero->setNome($nomeGenero);
        
        $doctrine = $this->getEm();
        $doctrine->persist($genero);
        
        $doctrine->flush();
        
        return $this->redirectToRoute('genero_index');
    }
}

//só um flush
//doctrine cadastra no banco