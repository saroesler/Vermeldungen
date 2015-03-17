<?php

use Doctrine\ORM\Mapping as ORM;

/**
 * Ministrants entity class.
 *
 * Annotations define the entity mappings to database.
 *
 * @ORM\Entity
 * @ORM\Table(name="Vermeldungen_General")
 */
class Vermeldungen_Entity_General extends Zikula_EntityAccess
{

    /**
     * The following are annotations which define the id field.
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $gid;

    /**
     * The following are annotations which define the name field.
     *
     * @ORM\Column(type="string", length="1000")
     */
    private $gname;
    
    /**
     * The following are annotations which define the adress field.
     *
     * @ORM\Column(type="integer")
     */
    private $tid;
    
    public function getGid()
    {
        return $this->gid;
    }
    
    public function getId()
    {
        return $this->gid;
    }
    
    public function getGname()
    {
        return $this->gname;
    }

    public function setGname($gname)
    {
        $this->gname = $gname;
    }
    
    public function getName()
    {
        return $this->gname;
    }

    public function setName($gname)
    {
        $this->gname = $gname;
    }
    
    public function getTid()
    {
        return $this->tid;
    }
    
    public function setTid($tid)
    {
        $this->tid = $tid;
    }
    
    public function hasOutput($oid){
    	return ModUtil::apiFunc('Vermeldungen', 'Admin', 'hasOutput', array('oid' => $oid, 'nid'=>$this->getGid(), "general"=>1)); 
    }
}
