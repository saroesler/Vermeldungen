<?php
/**
 * This is the User controller class providing navigation and interaction functionality.
 */
class Vermeldungen_Api_Admin extends Zikula_AbstractApi
{
	/**
	 * @brief Get available admin panel links
	 *
	 * @return array array of admin links
	 */
	public function getlinks()
	{
		$links = array();
		/**********
		* Bereitet die Listen für die Ausgabe vor
		**********/
		$outputs = $this->entityManager->getRepository('Vermeldungen_Entity_Output')->findBy(array(),array('name'=>'ASC'));
		$outputlist = array(
					array('url' => ModUtil::url('Vermeldungen', 'user', 'view'),
						'text' => $this->__('Standard View')),
				);
		$printlist = array(
					array('url' => ModUtil::url('Vermeldungen', 'admin', 'printpdf'),
						'text' => $this->__('Standard Print')),
				);
		foreach($outputs as $output){
			$outputlist[] = array('url' => ModUtil::url('Vermeldungen', 'user', 'view', array('oid'=>$output->getOid())),
						'text' => $this->__('View Output ')."\"".$output->getName()."\"");
			$printlist[] = array('url' => ModUtil::url('Vermeldungen', 'admin', 'printpdf', array('oid'=>$output->getOid())),
						'text' => $this->__('Print ')." \"".$output->getName()."\"");
		}
		$outputlist[] = array('url' => ModUtil::url('Vermeldungen', 'admin', 'manageOutputs'),
						'text' => $this->__('Manage Outputs'));
		
		
		if (SecurityUtil::checkPermission('Vermeldungen::', '::', ACCESS_ADMIN)) {
			$links[] = array(
				'url'=> ModUtil::url('Vermeldungen', 'admin', 'main'),
				'text'  => $this->__('Main'),
				'title' => $this->__('Main'),
				'class' => 'z-icon-es-config',
			);
		}
		
		if (SecurityUtil::checkPermission('Vermeldungen::', '::', ACCESS_MODERATE)) {
			$links[] = array(
				'url'=> ModUtil::url('Vermeldungen', 'user', 'view'),
				'text'  => $this->__('View'),
				'title' => $this->__('show the userlist'),
				'class' => 'z-icon-es-display',
				'links' => $outputlist
			);
		}
		
		if (SecurityUtil::checkPermission('Vermeldungen::', '::', ACCESS_MODERATE)) {
            $links[] = array(
                'url' => ModUtil::url('Vermeldungen', 'admin', 'listTemplate'),
                'text' => $this->__('Templates'),
                'class' => 'z-icon-es-cubes',
                'links' => array(
                    array('url' => ModUtil::url('Vermeldungen', 'admin', 'EditTemplate'),
                        'text' => $this->__('New Template')),
                    array('url' => ModUtil::url('Vermeldungen', 'admin', 'listTemplate'),
                        'text' => $this->__('Show Templates')),
                ));
        }
		if (SecurityUtil::checkPermission('Vermeldungen::', '::', ACCESS_MODERATE)) {
			$links[] = array(
				'url'=> ModUtil::url('Vermeldungen', 'admin', 'printpdf'),
				'text'  => $this->__('Print'),
				'title' => $this->__('Download the list'),
				'class' => 'z-icon-es-print',
				'links' => $printlist
			);
		}
		
		return $links;
	}
	
	public function getDateById($args)
	{
		$date = $this->entityManager->find('Vermeldungen_Entity_Day', $args['id']);
		return $date->getwDateFormatted();
	}
	
	public function getDayNameById($args)
	{
		if($args['short']==true)
			switch($args['id'])
			{
				case 0: $day = 'So.';break;
				case 1: $day = 'Mo.';break;
				case 2: $day = 'Di.';break;
				case 3: $day = 'Mi.';break;
				case 4: $day = 'Do.';break;
				case 5: $day = 'Fr.';break;
				case 6: $day = 'Sa.';break;
			}
		else
			switch($args['id'])
			{
				case 0: $day = 'Sonntag';break;
				case 1: $day = 'Montag';break;
				case 2: $day = 'Dinstag';break;
				case 3: $day = 'Mittwoch';break;
				case 4: $day = 'Donnerstag';break;
				case 5: $day = 'Freitag';break;
				case 6: $day = 'Samstag';break;
			}
		return $day;
	}
	
	public function hasOutput($args){
		if(!isset($args['nid']))
			return LogUtil::RegisterError($this->__("Please insert a news!"), null, "");
		if(!isset($args['oid']))
			return LogUtil::RegisterError($this->__("Please insert an output!"), null, "");
		
		$fields = $this->entityManager->getRepository('Vermeldungen_Entity_NewsOutput')->findBy(array("nid"=> $args['nid'], "oid"=> $args['oid'], "general"=> $args['general'],));
		
		if(isset($fields[0]))
			return 1;
		else
			return 0;
	}
	
	public function getPageFormatSelector($args)
	{
		$list = "<select id=\"{$args['name']}\" name=\"{$args['name']}\" >";
		
			if($args['selected']=="A5")
				$list .="<option selected value=\"A5\">A5</option>";
			else
				$list .="<option value=\"A5\">A5</option>";
			
			if($args['selected']=="A4")
				$list .="<option selected value=\"A4\">A4</option>";
			else
				$list .="<option value=\"A4\">A4</option>";
		$list .="</select>";
		return $list;
	}
	
	public function getDateSideSelector($args)
	{
		$list = "<select id=\"{$args['name']}\" name=\"{$args['name']}\" >";
		
			if($args['selected']=="left")
				$list .="<option selected value=\"left\">links</option>";
			else
				$list .="<option value=\"left\">links</option>";
			
			if($args['selected']=="right")
				$list .="<option selected value=\"right\">rechts</option>";
			else
				$list .="<option value=\"right\">rechts</option>";
		$list .="</select>";
		return $list;
	}
}
