<?php

namespace AndyFranklin\FaqBundle\Controller;

use AndyFranklin\FaqBundle\Entity\Question;
use AndyFranklin\FaqBundle\Form\QuestionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\View\View;
use FOS\RestBundle\View\ViewHandlerInterface;
use Symfony\Component\HttpFoundation\Response;


class QuestionController extends Controller
{
    private $viewHandler;
    private $entityManager;

    /**
     * QuestionController constructor.
     * @param ViewHandlerInterface $viewHandler
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(ViewHandlerInterface $viewHandler, EntityManagerInterface $entityManager)
    {
        $this->viewHandler = $viewHandler;
        $this->entityManager = $entityManager;
    }

    public function createAction(Request $request)
    {
        $question = new Question();

        //Create an un-named form so that the form doesn't use a namespace
        //Using HttpFoundationRequestHandler
        /** @var Form $form */
        $form = $this->get('form.factory')->createNamed('', QuestionType::class, $question);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager = $this->getDoctrine()->getManager();

            $this->entityManager->persist($question);
            $this->entityManager->flush();

            $view = View::create($question, Response::HTTP_OK);
        } else {
            $view = View::create($form);
        }

        return $this->viewHandler->handle($view);
    }
}
