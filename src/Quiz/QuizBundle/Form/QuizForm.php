<?php

namespace Quiz\QuizBundle\Form;

use Quiz\QuizBundle\Entity\Quiz;
use Symfony\Component\HttpFoundation\Request;
use winzou\CacheBundle\Cache\AbstractCache;

/**
 * Form for a full quiz (including all answers, managing the randomization properly). 
 *
 * @author Thibaut
 */
class QuizForm
{
    private $cache; 
    
    public function __construct(AbstractCache $cache)
    {
        $this->cache = $cache;
        $this->cache->setNamespace('form.quiz..');
    }
    
    public function buildForm(Quiz $quiz, Request $request)
    {
        if($this->cache->contains($quiz->getId() . '.array'))
        {
            $form = $this->cache->fetch($quiz->getId() . '.array');
        }
        else
        {
            $form = array();
            $form['text'] = $quiz->getName(); 
            $form['quid'] = $quiz->getId(); 
            $form['slug'] = $quiz->getSlug();

            $questions = $quiz->getQuestions();
            foreach($questions as $fid => $q)
            {
                if(! $q->isDeleted())
                {
                    $form['ques'][$fid]['text'] = $q->getText();
                    $form['ques'][$fid]['mult'] = (bool) $q->getMultipleAnswers(); 
                    $form['ques'][$fid]['expl'] = $q->getExplanation();
                    $form['ques'][$fid]['foid'] = $q->getId();

                    $answers = $q->getAnswers();
                    foreach($answers as $aid => $a)
                    {
                        if(! $a->isDeleted())
                        {
                            $form['ques'][$fid]['ans'][$aid]['text'] = $a->getText();
                            $form['ques'][$fid]['ans'][$aid]['isri'] = $a->getIsRight();
                            $form['ques'][$fid]['ans'][$aid]['expl'] = $a->getExplanation();
                            $form['ques'][$fid]['ans'][$aid]['anid'] = $a->getId();
                        }
                    }
                }
            }
            
            $this->cache->save($quiz->getId() . '.array', $form);
        }
        
        $form['req']  = &$request;
        $form['corr'] = (bool) ($request->getMethod() == "POST"); 
        
        return $form;
    }
}
