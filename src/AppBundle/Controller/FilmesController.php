<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Filmes;

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
     * @Route("/filmes/genero")
     */
    
    public function generoAction()
    {
        $repositorio = $this->getEm()->getRepository('AppBundle:Genero');
        $dados = $repositorio-> findAll();
        
        return $this->render('filmes/genero.html.twig', array(
            'dados' => $dados
        ) );
    }
    
    /**
     * @Route("/filmes/genero/cadastro")
     */
    
    public function generoCadastroAction()
    {
        return $this->render('filmes/genero-cadastro.html.twig');
    }
    
     /**
     * @Route("/filmes/genero/criar")
     */
    
    public function criarGeneroAction()
    {
        
    }
}

//doctrine cadastra no banco