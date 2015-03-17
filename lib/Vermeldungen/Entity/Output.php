<?php

use Doctrine\ORM\Mapping as ORM;

/**
 * Ministrants entity class.
 *
 * Annotations define the entity mappings to database.
 *
 * @ORM\Entity
 * @ORM\Table(name="Vermeldungen_Output")
 */
class Vermeldungen_Entity_Output extends Zikula_EntityAccess
{

    /**
     * The following are annotations which define the id field.
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $oid;

    /**
     * The following are annotations which define the adress field.
     *
     * @ORM\Column(type="string", length="1000")
     */
    private $name;
    
    /**
     * The following are annotations which define the adress field.
     *
     * @ORM\Column(type="string", length="1000")
     */
    private $pageformat;
    
    public function getOid()
    {
        return $this->oid;
    }
    
    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }
    
    public function getPageFormat()
    {
        return $this->pageformat;
    }

    public function setPageFormat($pageformat)
    {
        $this->pageformat = $pageformat;
    }
}
