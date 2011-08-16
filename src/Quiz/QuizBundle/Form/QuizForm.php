<?php

namespace Quiz\QuizBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

/**
 * Form for a full quiz (including all answers, managing the randomization properly). 
 *
 * @author Thibaut
 */
class QuizForm extends AbstractType
{
    public function getName()
    {
        return 'quiz';
    }
    
    public function buildForm(FormBuilder $builder, array $options)
    {
        
    }
}
