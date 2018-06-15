<?php

namespace AndyFranklin\FaqBundle\Controller;

use AndyFranklin\FaqBundle\Entity\Question;
use AndyFranklin\FaqBundle\Form\QuestionType;
use AndyFranklin\FaqBundle\Repository\QuestionRepository;
use Doctrine\ORM\EntityManagerInterface;
use AndyFranklin\FaqBundle\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\View\View;
use FOS\RestBundle\View\ViewHandlerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class QuestionController extends Controller
{
    private $viewHandler;
    private $entityManager;
    private $questionRepository;

    /**
     * QuestionController constructor.
     * @param ViewHandlerInterface $viewHandler
     * @param EntityManagerInterface $entityManager
     * @param QuestionRepository $questionRepository
     */
    public function __construct(
        ViewHandlerInterface $viewHandler,
        EntityManagerInterface $entityManager,
        QuestionRepository $questionRepository
    ) {
        $this->viewHandler = $viewHandler;
        $this->entityManager = $entityManager;
        $this->questionRepository = $questionRepository;
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

    public function addCategoryAction($id, Request $request)
    {
        /** @var Question $question */
        $question = $this->getQuestion($id);

        /** @var Category $category */
        $category = $this->entityManager->getRepository(Category::class)->find($request->get('category'));

        if (null === $category) {
            throw new NotFoundHttpException(sprintf('The category with id %s does not exist', $category));
        }

        $question->addCategory($category);

        $this->entityManager->persist($question);
        $this->entityManager->flush();

        return $this->viewHandler->handle(View::create($question, Response::HTTP_OK));
    }

    protected function getQuestion($idOrSlug)
    {
        /** @var Question $question */
        if (\is_numeric($idOrSlug)) {
            $question = $this->questionRepository->find($idOrSlug);
            if (null === $question) {
                throw new NotFoundHttpException(sprintf('The question with id %s does not exist', $idOrSlug));
            }
        } else {
            $question = $this->questionRepository->findBy(['slug' => $idOrSlug]);
            if (null === $question) {
                throw new NotFoundHttpException(sprintf('The question with slug %s does not exist', $idOrSlug));
            }
        }

        return $question;
    }

    public function singleSlugAction(String $slug)
    {
        $question = $this->getQuestion($slug);
        return $this->viewHandler->handle(View::create($question, Response::HTTP_OK));
    }

    public function singleIdAction($id)
    {
        $question = $this->getQuestion($id);
        return $this->viewHandler->handle(View::create($question, Response::HTTP_OK));
    }

    public function upRateAction($id)
    {
        $question = $this->getQuestion($id);

        $currentRating = $question->getRating();
        $question->setRating($currentRating + 1);

        $this->entityManager->persist($question);
        $this->entityManager->flush();

        return $this->viewHandler->handle(View::create($question, Response::HTTP_OK));
    }

    public function downRateAction($id)
    {
        $question = $this->getQuestion($id);

        $currentRating = $question->getRating();
        $question->setRating($currentRating - 1);

        $this->entityManager->persist($question);
        $this->entityManager->flush();

        return $this->viewHandler->handle(View::create($question, Response::HTTP_OK));
    }
}
