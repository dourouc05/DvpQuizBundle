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
            if(! $q->isDeleted())
            {
                $form[$fid]['text'] = $q->getText();
                $form[$fid]['mult'] = $q->getMultipleAnswers(); 
                $form[$fid]['expl'] = $q->getExplanation();

                $answers = $q->getAnswers();
                foreach($answers as $aid => $a)
                {
                    if(! $a->isDeleted())
                    {
                        $form[$fid]['ans'][$aid]['text'] = $a->getText();
                        $form[$fid]['ans'][$aid]['isri'] = $a->getIsRight();
                        $form[$fid]['ans'][$aid]['expl'] = $a->getExplanation();
                    }
                }
            }
        }
        
        return $form;
    }
}
