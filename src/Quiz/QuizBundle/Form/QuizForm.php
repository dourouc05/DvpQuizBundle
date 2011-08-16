<?php

namespace Quiz\QuizBundle\Form;

/**
 * Form for a full quiz (including all answers, managing the randomization properly). 
 *
 * @author Thibaut
 */
class QuizForm
{
    public function getName()
    {
        return 'quiz';
    }
    
    public function buildForm(FormBuilder $builder, array $options)
    {
        $quiz = $options['data'];
        $questions = $quiz->getQuestions();
        
        foreach($questions as $id => $q)
        {
            $builder->add('text', new QuestionForm(), array('data' => $q));
        }
    }
}
