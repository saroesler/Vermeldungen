<?php

use Doctrine\ORM\Mapping as ORM;

/**
 * Ministrants entity class.
 *
 * Annotations define the entity mappings to database.
 *
 * @ORM\Entity
 * @ORM\Table(name="Vermeldungen_Data")
 */
class Vermeldungen_Entity_Data extends Zikula_EntityAccess
{

    /**
     * The following are annotations which define the id field.
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $did;

    /**
     * The following are annotations which define the name field.
     *
     * @ORM\Column(type="string", length="1000")
     */
    private $dname;
    
    /**
     * The following are annotations which define the adress field.
     *
     * @ORM\Column(type="date")
     */
    private $ddate;
    
    /**
     * The following are annotations which define the adress field.
     *
     * @ORM\Column(type="time")
     */
    private $dtime;
    
    /**
     * The following are annotations which define the adress field.
     *
     * @ORM\Column(type="integer")
     */
    private $tid;
    
    
    public function getDid()
    {
        return $this->did;
    }
    
    public function getId()
    {
        return $this->did;
    }
    
    public function getDname()
    {
        return $this->dname;
    }

    public function setDname($dname)
    {
        $this->dname = $dname;
    }
    
    public function getName()
    {
        return $this->dname;
    }

    public function setName($dname)
    {
        $this->dname = $dname;
    }
    
    public function getDdate()
    {
        return $this->ddate;
    }
    
    public function getDDateFormatted()
    {
        return $this->ddate->format('d.m.Y');
    }
    
    public function getDDateFormattedout()
    {
    	$trans = array(
			'Monday'    => 'Montag',
			'Tuesday'   => 'Dienstag',
			'Wednesday' => 'Mittwoch',
			'Thursday'  => 'Donnerstag',
			'Friday'    => 'Freitag',
			'Saturday'  => 'Samstag',
			'Sunday'    => 'Sonntag',
			'Mon'       => 'Mo',
			'Tue'       => 'Di',
			'Wed'       => 'Mi',
			'Thu'       => 'Do',
			'Fri'       => 'Fr',
			'Sat'       => 'Sa',
			'Sun'       => 'So',
			'January'   => 'Januar',
			'February'  => 'Februar',
			'March'     => 'März',
			'May'       => 'Mai',
			'June'      => 'Juni',
			'July'      => 'Juli',
			'October'   => 'Oktober',
			'December'  => 'Dezember',
		);
		$weekday = $this->ddate->format('l');
		$weekday = strtr($weekday, $trans);  
		$date = $this->ddate->format(' d. F');
		$date = strtr($date, $trans);  
        return $weekday . "<br /> <nobr>" . $date . "</nobr>" ;
    }
    
    public function setDdate($Ddate)
    {
    	$this->ddate = new \Datetime($Ddate);
    }
    
    public function getDtime()
    {
        return $this->dtime;
    }
    
    public function getDtimeFormatted()
    {
        return $this->dtime->format('G:i');
    }
    
    public function setDtime($dtime)
    {
        $this->dtime = new \DateTime($dtime);
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
    	return ModUtil::apiFunc('Vermeldungen', 'Admin', 'hasOutput', array('oid' => $oid, 'nid'=>$this->getDid(), 'general'=>0)); 
    }
}
