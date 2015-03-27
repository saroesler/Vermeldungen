<?php

use Doctrine\ORM\Mapping as ORM;

/**
 * Ministrants entity class.
 *
 * Annotations define the entity mappings to database.
 *
 * @ORM\Entity
 * @ORM\Table(name="Vermeldungen_TemplateField")
 */
class Vermeldungen_Entity_TemplateField extends Zikula_EntityAccess
{

    /**
     * The following are annotations which define the id field.
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $tfid;
    
    /**
     * The following are annotations which define the adress field.
     *
     * @ORM\Column(type="string", length="1000")
     */
    private $name;
    
    /**
     * The following are annotations which define the adress field.
     *
     * @ORM\Column(type="integer")
     */
    private $tid;
    
    public function getTfid()
    {
        return $this->tfid;
    }
    
    public function getTid()
    {
        return $this->tid;
    }

    public function setTid($tid)
    {
        $this->tid = $tid;
    }
    
    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }
}
