<?php

use Doctrine\ORM\Mapping as ORM;

/**
 * Ministrants entity class.
 *
 * Annotations define the entity mappings to database.
 *
 * @ORM\Entity
 * @ORM\Table(name="Vermeldungen_NewsOutput")
 */
class Vermeldungen_Entity_NewsOutput extends Zikula_EntityAccess
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
     * The following are annotations which define the adress field.
     *
     * @ORM\Column(type="integer")
     */
    private $nid;
    
    /**
     * The following are annotations which define the adress field.
     *
     * @ORM\Column(type="integer")
     */
    private $general;
    
    /**
     * The following are annotations which define the adress field.
     *
     * @ORM\Column(type="integer")
     */
    private $oid;
    
    public function getId()
    {
        return $this->id;
    }
    
    public function getNid()
    {
        return $this->nid;
    }

    public function setNid($nid)
    {
        $this->nid = $nid;
    }
    
    public function getGeneral()
    {
        return $this->general;
    }

    public function setGeneral($general)
    {
        $this->general = $general;
    }
    
    public function getOid()
    {
        return $this->oid;
    }

    public function setOid($oid)
    {
        $this->oid = $oid;
    }
}
