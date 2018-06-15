<?php

namespace AndyFranklin\FaqBundle\Controller;

use AndyFranklin\FaqBundle\Entity\Answer;
use AndyFranklin\FaqBundle\Form\AnswerType;
use AndyFranklin\FaqBundle\Repository\AnswerRepository;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use FOS\RestBundle\View\ViewHandlerInterface;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AnswerController extends FOSRestController
{
    private $viewHandler;
    private $entityManager;
    private $answerRepository;

    /**
     * QuestionController constructor.
     * @param ViewHandlerInterface $viewHandler
     * @param EntityManagerInterface $entityManager
     * @param AnswerRepository $answerRepository
     */
    public function __construct(
        ViewHandlerInterface $viewHandler,
        EntityManagerInterface $entityManager,
        AnswerRepository $answerRepository
    ) {
        $this->viewHandler = $viewHandler;
        $this->entityManager = $entityManager;
        $this->answerRepository = $answerRepository;
    }

    public function createAction(Request $request)
    {
        $answer = new Answer();

        /** @var Form $form */
        $form = $this->get('form.factory')->createNamed('', AnswerType::class, $answer);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager = $this->getDoctrine()->getManager();

            $this->entityManager->persist($answer);
            $this->entityManager->flush();

            $view = View::create($answer, Response::HTTP_OK);
        } else {
            $view = View::create($form);
        }

        return $this->viewHandler->handle($view);
    }

    public function upRateAction($id)
    {
        $answer = $this->getAnswer($id);

        $currentRating = $answer->getRating();
        $answer->setRating($currentRating + 1);

        $this->entityManager->persist($answer);
        $this->entityManager->flush();

        return $this->viewHandler->handle(View::create($answer, Response::HTTP_OK));
    }

    public function downRateAction($id)
    {
        $answer = $this->getAnswer($id);

        $currentRating = $answer->getRating();
        $answer->setRating($currentRating - 1);

        $this->entityManager->persist($answer);
        $this->entityManager->flush();

        return $this->viewHandler->handle(View::create($answer, Response::HTTP_OK));
    }

    protected function getAnswer($idOrSlug)
    {
        /** @var Answer $answer */
        if (\is_numeric($idOrSlug)) {
            $answer = $this->answerRepository->find($idOrSlug);
            if (null === $answer) {
                throw new NotFoundHttpException(sprintf('The answer with id %s does not exist', $idOrSlug));
            }
        } else {
            $answer = $this->answerRepository->findBy(['slug' => $idOrSlug]);
            if (null === $answer) {
                throw new NotFoundHttpException(sprintf('The answer with slug %s does not exist', $idOrSlug));
            }
        }

        return $answer;
    }
}