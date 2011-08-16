<?php

namespace Quiz\QuizBundle\Form;

use Quiz\QuizBundle\Entity\Quiz;

/**
 * Form for a full quiz (including all answers, managing the randomization properly). 
 *
 * @author Thibaut
 */
class QuizForm
{
    public function buildForm(Quiz $quiz)
    {
        $questions = $quiz->getQuestions();
        $form = array();
        
        foreach($questions as $fid => $q)
        {
            $form[$fid]['text'] = $q->getText();
            
            $answers = $q->getAnswers();
            foreach($answers as $aid => $a)
            {
                
            }
        }
        
        return $form;
    }
}
