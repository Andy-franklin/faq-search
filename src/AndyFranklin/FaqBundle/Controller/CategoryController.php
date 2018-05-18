<?php

namespace AndyFranklin\FaqBundle\Controller;

use AndyFranklin\FaqBundle\Entity\Category;
use AndyFranklin\FaqBundle\Form\CategoryType;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use FOS\RestBundle\View\ViewHandlerInterface;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends FOSRestController
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
        $category = new Category();

        /** @var Form $form */
        $form = $this->get('form.factory')->createNamed('', CategoryType::class, $category);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager = $this->getDoctrine()->getManager();

            $this->entityManager->persist($category);
            $this->entityManager->flush();

            $view = View::create($category, Response::HTTP_OK);
        } else {
            $view = View::create($form);
        }

        return $this->viewHandler->handle($view);
    }
}