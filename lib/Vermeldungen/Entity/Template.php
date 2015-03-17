<?php

use Doctrine\ORM\Mapping as ORM;

/**
 * Ministrants entity class.
 *
 * Annotations define the entity mappings to database.
 *
 * @ORM\Entity
 * @ORM\Table(name="Vermeldungen_Template")
 */
class Vermeldungen_Entity_Template extends Zikula_EntityAccess
{

    /**
     * The following are annotations which define the id field.
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $tid;
    
    /**
     * The following are annotations which define the adress field.
     *
     * @ORM\Column(type="string", length="1000")
     */
    private $name;
    
    /**
     * The following are annotations which define the adress field.
     *
     * @ORM\Column(type="string", length="10000")
     */
    private $value;
    
    public function getTid()
    {
        return $this->tid;
    }
    
    public function getValue()
    {
        return $this->value;
    }

    public function setValue($value)
    {
        $this->value = $value;
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
