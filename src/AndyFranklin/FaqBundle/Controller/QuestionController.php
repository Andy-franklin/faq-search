<?php

namespace AndyFranklin\FaqBundle\Controller;

use AndyFranklin\FaqBundle\Entity\Question;
use AndyFranklin\FaqBundle\Form\QuestionType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class QuestionController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }

    public function createAction()
    {
        $question = new Question();

        $form = $this->createForm(QuestionType::class, $question);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($question);
            $em->flush();
        }
    }
}
