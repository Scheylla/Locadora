<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Filmes;

class FilmesController extends Controller {

    /**
     * @Route("/filmes", name="filmes_index")
     */
    public function indexAction() {

        $doctrine = $this->getDoctrine()->getEntityManager();
        $filmes = $doctrine->getRepository('AppBundle:Filmes');
        
        $retorno = $filmes->findAll();

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
        $filme->setLancamento(true);
        $filme->setNome('Rec');

        $doctrine = $this->getDoctrine()->getEntityManager();
        $doctrine->persist($filme);
        $doctrine->flush();

        return $this->render('filmes/cadastro.html.twig');
    }

}

//doctrine cadastra no banco