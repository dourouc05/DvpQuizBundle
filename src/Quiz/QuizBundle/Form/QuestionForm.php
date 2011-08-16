<?php

namespace Quiz\QuizBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

/**
 * A question and its answers
 *
 * @author Thibaut
 */
class QuestionForm extends AbstractType
{
    public function getName()
    {
        return 'question';
    }
    
    public function buildForm(FormBuilder $builder, array $options)
    {
        $question = $options['data'];
        $answers  = $question->getAnswers();
    }
}
