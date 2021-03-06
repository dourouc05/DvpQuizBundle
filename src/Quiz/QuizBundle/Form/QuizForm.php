<?php

namespace Quiz\QuizBundle\Form;

use Quiz\QuizBundle\Entity\Quiz;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\ParameterBag;
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
    }
    
    public function buildForm(Quiz $quiz, Request $request)
    {
        $this->cache->setNamespace('form.quiz..');
        
        if(false && $this->cache->contains($quiz->getId() . '.array'))
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
                            $form['ques'][$fid]['ans'][$aid]['isri'] = $a->getIsRight(); // Is this the right answer? 
                            $form['ques'][$fid]['ans'][$aid]['expl'] = $a->getExplanation();
                            $form['ques'][$fid]['ans'][$aid]['anid'] = $a->getId();
                            $form['ques'][$fid]['ans'][$aid]['chck'] = false;
                        }
                    }
                }
            }
            
            $this->cache->save($quiz->getId() . '.array', $form, 31536000);
        }
        
        // This is not cacheable! So the second foreach round. But let's try not to
        // have both in one request. 
        $form['corr'] = (bool) ($request->getMethod() == "POST"); 
        if($form['corr'])
        {
            foreach($form['ques'] as $fid => $q)
            {
                foreach($q['ans'] as $aid => $a)
                {
                    // Support for both radio buttons and checkboxes
                    if(in_array($form['ques'][$fid]['foid'] . '-' . $form['ques'][$fid]['ans'][$aid]['anid'], $_POST)
                    || isset($_POST[$form['ques'][$fid]['foid'] . '-' . $form['ques'][$fid]['ans'][$aid]['anid']]))
                    {
                        $form['ques'][$fid]['ans'][$aid]['chck'] = true;
                    }
                }
            }
        }
        $form['req']  = $request->request;
        $form['corr'] = (bool) ($request->getMethod() == "POST"); 
        
        return $form;
    }
}
