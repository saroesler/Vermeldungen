<?php

use Doctrine\ORM\Mapping as ORM;

/**
 * Ministrants entity class.
 *
 * Annotations define the entity mappings to database.
 *
 * @ORM\Entity
 * @ORM\Table(name="Vermeldungen_NewsFields")
 */
class Vermeldungen_Entity_NewsField extends Zikula_EntityAccess
{

    /**
     * The following are annotations which define the id field.
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * The following are annotations which define the name field.
     *
     * @ORM\Column(type="integer")
     */
    private $nid;
    
    /**
     * The following are annotations which define the adress field.
     *
     * @ORM\Column(type="integer")
     */
    private $tfid;
    
    /**
     * The following are annotations which define the adress field.
     *
     * @ORM\Column(type="string", length="1000")
     */
    private $value;
    
    public function getId()
    {
        return $this->id;
    }
    
    public function getValue()
    {
        return $this->value;
    }

    public function setValue($value)
    {
        $this->value = $value;
    }
    
    public function getTfid()
    {
        return $this->tfid;
    }
    
    public function setTfid($tfid)
    {
        $this->tfid = $tfid;
    }
    public function getNid()
    {
        return $this->nid;
    }
    
    public function setNid($nid)
    {
        $this->nid = $nid;
    }
}
