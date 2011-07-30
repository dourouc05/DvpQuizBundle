<?php

namespace Quiz\QuizBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="Quiz\QuizBundle\Entity\Repository\SoftDeleteRepository")
 */
// Old annotations
// * @Gedmo\Loggable
class Quiz
{
    public function __construct()
    {
        $this->question = new \Doctrine\Common\Collections\ArrayCollection();
        $this->visits = 0;
        $this->random = false;
        $this->questionsToShow = -1;
        $this->deleted = false;
    }
    
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    protected $id;
    
    /**
     * @ORM\Column(type="boolean")
     */
    protected $deleted;
    
    /** 
     * @ORM\Column(type="string")
     * @Gedmo\Sluggable
     * 
     * Le nom du quiz
     */
    protected $name; 
    
    /** 
     * @ORM\Column(type="integer")
     * 
     * Le nombre de visites 
     */
    protected $visits; 
    
    /** 
     * @ORM\Column(type="boolean")
     * 
     * Faut-il afficher les questions liées de manière aléatoire (ordre et choix) ? 
     */
    protected $random; 
    
    /**
     * @ORM\Column(type="integer")
     * 
     * Si le quiz est aléatoire, le nombre de questions à montrer
     */
    protected $questionsToShow; 
    
    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="quiz")
     * 
     * Catégorie du quiz
     */
    protected $category; 
    
    /** 
     * @Gedmo\Slug(updatable=false)
     * @ORM\Column(name="slug", type="string", unique=true) 
     */
    protected $slug; 
    
    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="quiz")
     * 
     * Auteur du quiz
     */
    protected $author; 
    
    /**
     * @ORM\Column(type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    protected $created; 
    
    /**
     * @ORM\Column(type="datetime")
     * @Gedmo\Timestampable(on="update")
     */
    protected $updated; 
    
    /**
     * @ORM\OneToMany(targetEntity="Question", mappedBy="quiz")
     */
    protected $question;
    
    public function delete()
    {
        $this->deleted = true;
    }
    
    public function undelete()
    {
        $this->deleted = false;
    }
    
    public function isDeleted()
    {
        return $this->deleted; 
    }
    
    public function addVisit()
    {
        $this->visits += 1;
    }
    
    public function getQuestionsToShow()
    {
        // On ne peut donner un nombre de questions à montrer que si le quiz est aléatoire
        if($this->isRandom())
        {
            return $this->questionsToShow; 
        }
        else
        {
            return -1; 
        }
    }

    /**
     * Get id
     *
     * @return integer $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set deleted
     *
     * @param boolean $deleted
     */
    private function setDeleted($deleted)
    {
        $this->deleted = $deleted;
    }

    /**
     * Get deleted
     *
     * @return boolean $deleted
     */
    private function getDeleted()
    {
        return $this->deleted;
    }

    /**
     * Set name
     *
     * @param text $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get name
     *
     * @return text $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set visits
     *
     * @param integer $visits
     */
    private function setVisits($visits)
    {
        $this->visits = $visits;
    }

    /**
     * Get visits
     *
     * @return integer $visits
     */
    public function getVisits()
    {
        return $this->visits;
    }

    /**
     * Set random
     *
     * @param boolean $random
     */
    public function setRandom($random)
    {
        $this->random = $random;
    }

    /**
     * Get random
     *
     * @return boolean $random
     */
    public function getRandom()
    {
        return $this->random;
    }

    /**
     * Set questionsToShow
     *
     * @param integer $questionsToShow
     */
    public function setQuestionsToShow($questionsToShow)
    {
        $this->questionsToShow = $questionsToShow;
        
        if(! $this->random)
        {
            $this->random = true;
        }
    }

    /**
     * Set slug
     *
     * @param string $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * Get slug
     *
     * @return string $slug
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Get created
     *
     * @return datetime $created
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Get updated
     *
     * @return datetime $updated
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set created
     *
     * @param datetime $created
     */
    private function setCreated($created)
    {
        $this->created = $created;
    }

    /**
     * Set updated
     *
     * @param datetime $updated
     */
    private function setUpdated($updated)
    {
        $this->updated = $updated;
    }

    /**
     * Set author
     *
     * @param Quiz\QuizBundle\Entity\User $author
     */
    public function setAuthor(\Quiz\QuizBundle\Entity\User $author)
    {
        $this->author = $author;
    }

    /**
     * Get author
     *
     * @return Quiz\QuizBundle\Entity\User $author
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set category
     *
     * @param Quiz\QuizBundle\Entity\Category $category
     */
    public function setCategory(\Quiz\QuizBundle\Entity\Category $category)
    {
        $this->category = $category;
    }

    /**
     * Get category
     *
     * @return Quiz\QuizBundle\Entity\Category $category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Add question
     *
     * @param Quiz\QuizBundle\Entity\Question $question
     */
    public function addQuestion(\Quiz\QuizBundle\Entity\Question $question)
    {
        $this->question[] = $question;
    }

    /**
     * Add a bunch of questions
     *
     * @param Quiz\QuizBundle\Entity\Question $questions
     */
    public function addQuestions($questions)
    {
        if(is_array($answers))
            if(is_array($this->question))
                $this->question = array_merge($this->answer, $answers);
            else
                $this->question = $answers;
        $this->question[] = $question;
    }

    /**
     * Get question
     *
     * @return Doctrine\Common\Collections\Collection $question
     */
    public function getQuestion()
    {
        return $this->question;
    }
}