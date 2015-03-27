<?php
class Vermeldungen_Controller_Ajax extends Zikula_AbstractController
{
	/**
	 * @brief Set imaging status of one computer
	 * @param GET $cid The number of computer
	 * @param GET $imagingstatus status of imaging
	 *
	 * This function provides a simple soloutin to image much computers fast
	 *
	 * @author Sascha Rösler
	 * @version 1.0
	 */
	
	public function News_save()
	{
		if (!SecurityUtil::checkPermission('Vermeldungen::', '::', ACCESS_ADMIN))
			return new Zikula_Response_Ajax(LogUtil::registerPermissionError());

		$ok = 0;
		$name = FormUtil::getPassedValue('name', null, 'POST');
		$date = FormUtil::getPassedValue('date', null, 'POST');
		$time = FormUtil::getPassedValue('time', null, 'POST');
		if(!$name)
			$text = ($this->__("There is no valid name!"));
		if(!$date)
			$text =($this->__("There is no valid date!"));
		if(!$time)
			$text = ($this->__("There is no valid time!"));
		if($name&&$date&&$time)
		{
			$data = new Vermeldungen_Entity_Data();
			$data->setDname($name);
			$data->setDdate($date);
			$data->setDtime($time);
			$data->setTid(0);
			$this->entityManager->persist($data);
			$this->entityManager->flush();
			LogUtil::RegisterStatus($this->__("News has been added successfully."));
			$ok = 1;
			$text = "";
		}
		
		$result['ok'] = $ok;
		$result['text'] = $text;
		
		$datas = $this->entityManager->getRepository('Vermeldungen_Entity_Data')->findBy(array(),array('ddate'=>'ASC', 'dtime' => 'ASC'));
		$outputs = $this->entityManager->getRepository('Vermeldungen_Entity_Output')->findBy(array());
    	$result["Vermeldungen"] = $this->view
    		->assign('datas', $datas)
    		->assign('outputs', $outputs)
    		->fetch('Ajax/Vermeldungen.tpl');
    	
		return new Zikula_Response_Ajax($result);
	}
	
	public function News_Del()
	{
		if (!SecurityUtil::checkPermission('Vermeldungen::', '::', ACCESS_ADMIN))
			return new Zikula_Response_Ajax(LogUtil::registerPermissionError());

		$result['ok'] = 0;
		$id = FormUtil::getPassedValue('id', null, 'POST');
		if(!isset($id)) {
			return new Zikula_Response_Ajax_BadData($this->__('missing $id'));
		}
		if($id)
		{
			$data = $this->entityManager->find('Vermeldungen_Entity_Data', $id);
			//del church
			$this->entityManager->remove($data);
			$this->entityManager->flush();
			LogUtil::RegisterStatus($this->__("News has been removed successfully."));
		}
		
		$result['id'] = $id;
		return new Zikula_Response_Ajax($result);
	}
	
	
	
	public function GeneralNews_save()
	{
		if (!SecurityUtil::checkPermission('Vermeldungen::', '::', ACCESS_ADMIN))
			return new Zikula_Response_Ajax(LogUtil::registerPermissionError());

		$ok = 0;
		$name = FormUtil::getPassedValue('name', null, 'POST');
		if(!$name)
			$text = ($this->__("There is no valid name!"));
		if($name)
		{
			$data = new Vermeldungen_Entity_General();
			$data->setGname($name);
			$data->setTid(0);
			$this->entityManager->persist($data);
			$this->entityManager->flush();
			LogUtil::RegisterStatus($this->__("News has been added successfully."));
			$ok = 1;
			$text = "";
		}
		
		$result['ok'] = $ok;
		$result['text'] = $text;
		
    	$general = $this->entityManager->getRepository('Vermeldungen_Entity_General')->findBy(array());
    	$outputs = $this->entityManager->getRepository('Vermeldungen_Entity_Output')->findBy(array());
    	$result["Vermeldungen"] = $this->view
    		->assign('outputs', $outputs)
    		->assign('general', $general)
    		->fetch('Ajax/General.tpl');
		return new Zikula_Response_Ajax($result);
	}
	
	public function GeneralNews_Del()
	{
		if (!SecurityUtil::checkPermission('Vermeldungen::', '::', ACCESS_ADMIN))
			return new Zikula_Response_Ajax(LogUtil::registerPermissionError());

		$result['ok'] = 0;
		$id = FormUtil::getPassedValue('id', null, 'POST');
		if(!isset($id)) {
			return new Zikula_Response_Ajax_BadData($this->__('missing $id'));
		}
		if($id)
		{
			$data = $this->entityManager->find('Vermeldungen_Entity_General', $id);
			$this->entityManager->remove($data);
			$this->entityManager->flush();
			
			$fields = $this->entityManager->getRepository('Vermeldungen_Entity_NewsField')->findBy(array('nid'=>$id));
			foreach($fields as $field){
				$this->entityManager->remove($field);
				$this->entityManager->flush();
			}
			LogUtil::RegisterStatus($this->__("Data has been removed successfully."));
		}
		
		$result['id'] = $id;
		return new Zikula_Response_Ajax($result);
	}
	
	public function All_Del()
	{
		if (!SecurityUtil::checkPermission('Vermeldungen::', '::', ACCESS_ADMIN))
			return new Zikula_Response_Ajax(LogUtil::registerPermissionError());

		$result['ok'] = 0;
		$result['tset'] = "Hallo";
		$news = $this->entityManager->getRepository('Vermeldungen_Entity_Data')->findBy(array(),array());
		foreach($news as $thisone)
		{
			//del news
			$this->entityManager->remove($thisone);
			$this->entityManager->flush();
			LogUtil::RegisterStatus($this->__("News has been removed successfully."));
		}
		
		$general = $this->entityManager->getRepository('Vermeldungen_Entity_General')->findBy(array(),array());
		foreach($general as $thisone)
		{
			//del worship
			$this->entityManager->remove($thisone);
			$this->entityManager->flush();
			LogUtil::RegisterStatus($this->__("News has been removed successfully."));
		}
		return new Zikula_Response_Ajax($result);
	}
	
	public function Template_Del()
	{
		if (!SecurityUtil::checkPermission('Vermeldungen::', '::', ACCESS_ADMIN))
			return new Zikula_Response_Ajax(LogUtil::registerPermissionError());

		$result['ok'] = 0;
		$id = FormUtil::getPassedValue('id', null, 'POST');
		if(!isset($id)) {
			return new Zikula_Response_Ajax_BadData($this->__('missing $id'));
		}
		if($id)
		{
			$fields = $this->entityManager->getRepository('Vermeldungen_Entity_TemplateField')->findBy(array('tid'=>$id),array('name'=>'ASC'));
			foreach($fields as $field){
				$this->entityManager->remove($field);
				$this->entityManager->flush();
			}
			$data = $this->entityManager->find('Vermeldungen_Entity_Template', $id);
			$this->entityManager->remove($data);
			$this->entityManager->flush();
			LogUtil::RegisterStatus($this->__("Template has been removed successfully."));
		}
		
		$result['id'] = $id;
		return new Zikula_Response_Ajax($result);
	}
	
	public function TemplateAll_Del()
	{
		if (!SecurityUtil::checkPermission('Vermeldungen::', '::', ACCESS_ADMIN))
			return new Zikula_Response_Ajax(LogUtil::registerPermissionError());

		$result['ok'] = 0;
		$templates = $this->entityManager->getRepository('Vermeldungen_Entity_Template')->findBy(array(),array());
		foreach($templates as $template)
		{
			$fields = $this->entityManager->getRepository('Vermeldungen_Entity_TemplateField')->findBy(array('tid'=>$template->getTid()),array('name'=>'ASC'));
			foreach($fields as $field){
				$this->entityManager->remove($field);
				$this->entityManager->flush();
			}
			$this->entityManager->remove($template);
			$this->entityManager->flush();
			LogUtil::RegisterStatus($this->__("Template has been removed successfully."));
		}
		return new Zikula_Response_Ajax($result);
	}
	
	public function Template_load()
	{
		if (!SecurityUtil::checkPermission('Vermeldungen::', '::', ACCESS_ADMIN))
			return new Zikula_Response_Ajax(LogUtil::registerPermissionError());

		$result = array();
		$result['ok'] = 0;
		$id = FormUtil::getPassedValue('id', null, 'POST');
		$nid = FormUtil::getPassedValue('nid', null, 'POST');
		$fieldcounter = 0;
		if(!isset($id)) {
			return new Zikula_Response_Ajax_BadData($this->__('missing $id'));
		}
		if($id)
		{
			$fields = $this->entityManager->getRepository('Vermeldungen_Entity_TemplateField')->findBy(array('tid'=>$id),array());
			foreach($fields as $field){
				$hasattribute = $this->entityManager->getRepository('Vermeldungen_Entity_NewsField')->findBy(array('nid'=>$nid, 'tfid'=>$field->getTfid()));
				if(isset($hasattribute[0]))
					$result['fieldvalue'.$fieldcounter] = $hasattribute[0]->getValue();
				else
					$result['fieldvalue'.$fieldcounter] = "";
				$result['fieldid'.$fieldcounter] = $field->getTfid();
				$result['fieldname'.$fieldcounter] = $field->getName();
				$fieldcounter ++;
			}
		}
		
		$result['id'] = $id;
		$result['fieldnum'] = $fieldcounter;
		return new Zikula_Response_Ajax($result);
	}
	
	public function Preview()
	{
		if (!SecurityUtil::checkPermission('Vermeldungen::', '::', ACCESS_ADMIN))
			return new Zikula_Response_Ajax(LogUtil::registerPermissionError());
		
		$tid = FormUtil::getPassedValue('tid', null, 'POST');
		
		if(!isset($tid)) {
			return new Zikula_Response_Ajax_BadData($this->__('missing $id'));
		}
		if($tid)
		{
			$num = FormUtil::getPassedValue('attributenum', null, 'POST');
			$fields = array();
			for($i = 0; $i < $num; $i ++){
				$field = array();
				$field['attribute'] = FormUtil::getPassedValue('attribute'.$i, null, 'POST');
				$field['attributetf'] = FormUtil::getPassedValue('attributetf'.$i, null, 'POST');
				$fields[] = $field;
			}
			
			$result['preview'] = ModUtil::apiFunc('Vermeldungen', 'Template', 'renderPreview', array("tid" => $tid, "fields"=> $fields));
		}
		else
			$result['preview']="";
		
		return new Zikula_Response_Ajax($result);
	}
	
	//Outputs
	public function Output_save()
	{
		if (!SecurityUtil::checkPermission('Vermeldungen::', '::', ACCESS_ADMIN))
			return new Zikula_Response_Ajax(LogUtil::registerPermissionError());

		$ok = 0;
		$name = FormUtil::getPassedValue('name', null, 'POST');
		$format = FormUtil::getPassedValue('format', null, 'POST');
		if(!$name)
			$text = ($this->__("There is no valid name!"));
		if($name)
		{
			$data = new Vermeldungen_Entity_Output();
			$data->setName($name);
			$data->setPageFormat($format);
			$this->entityManager->persist($data);
			$this->entityManager->flush();
			LogUtil::RegisterStatus($this->__("Output has been added successfully."));
			$ok = 1;
			$text = "";
		}
		
		$result['ok'] = $ok;
		$result['text'] = $text;
		
    	$outputs = $this->entityManager->getRepository('Vermeldungen_Entity_Output')->findBy(array());
    	$result["Outputs"] = $this->view
    		->assign('outputs', $outputs)
    		->fetch('Ajax/Output.tpl');
		return new Zikula_Response_Ajax($result);
	}
	
	public function Output_Del()
	{
		if (!SecurityUtil::checkPermission('Vermeldungen::', '::', ACCESS_ADMIN))
			return new Zikula_Response_Ajax(LogUtil::registerPermissionError());

		$result['ok'] = 0;
		$id = FormUtil::getPassedValue('id', null, 'POST');
		if(!isset($id)) {
			return new Zikula_Response_Ajax_BadData($this->__('missing $id'));
		}
		if($id)
		{
			$data = $this->entityManager->find('Vermeldungen_Entity_Output', $id);
			$this->entityManager->remove($data);
			$this->entityManager->flush();
			
			$fields = $this->entityManager->getRepository('Vermeldungen_Entity_NewsOutput')->findBy(array('oid'=>$id));
			foreach($fields as $field){
				$this->entityManager->remove($field);
				$this->entityManager->flush();
			}
			LogUtil::RegisterStatus($this->__("Output has been removed successfully."));
		}
		
		$result['id'] = $id;
		return new Zikula_Response_Ajax($result);
	}
	
	public function Output_EditSave()
	{
		if (!SecurityUtil::checkPermission('Vermeldungen::', '::', ACCESS_ADMIN))
			return new Zikula_Response_Ajax(LogUtil::registerPermissionError());

		$result['ok'] = 0;
		$id = FormUtil::getPassedValue('oid', null, 'POST');
		$name = FormUtil::getPassedValue('name', null, 'POST');
		$format = FormUtil::getPassedValue('format', null, 'POST');
		if(!isset($id)) {
			return new Zikula_Response_Ajax_BadData($this->__('missing $id'));
		}
		if($id)
		{
			$data = $this->entityManager->find('Vermeldungen_Entity_Output', $id);
			$data->setName($name);
			$data->setPageFormat($format);
			$this->entityManager->persist($data);
			$this->entityManager->flush();
			$result['ok'] = 1;
			$result['text'] = "";
			LogUtil::RegisterStatus($this->__("Output has been edited successfully."));
		}
		
		$result['id'] = $id;
		$result['format'] = $format;
		$result['value'] = $name;
		return new Zikula_Response_Ajax($result);
	}
	
	public function OutputAll_Del()
	{
		if (!SecurityUtil::checkPermission('Vermeldungen::', '::', ACCESS_ADMIN))
			return new Zikula_Response_Ajax(LogUtil::registerPermissionError());

		$result['ok'] = 0;
		$result['tset'] = "Hallo";
		$news = $this->entityManager->getRepository('Vermeldungen_Entity_Output')->findBy(array(),array());
		foreach($news as $thisone)
		{
			$fields = $this->entityManager->getRepository('Vermeldungen_Entity_NewsOutput')->findBy(array('oid'=>$thisone->getOid()));
			foreach($fields as $field){
				$this->entityManager->remove($field);
				$this->entityManager->flush();
			}
			//del news
			$this->entityManager->remove($thisone);
			$this->entityManager->flush();
			LogUtil::RegisterStatus($this->__("Output has been removed successfully."));
		}
		
		$result["Outputs"] = $this->view
    		->fetch('Ajax/OutputStd.tpl');
		return new Zikula_Response_Ajax($result);
	}
	
	public function OutputSet(){
		if (!SecurityUtil::checkPermission('Vermeldungen::', '::', ACCESS_ADMIN))
			return new Zikula_Response_Ajax(LogUtil::registerPermissionError());

		$result['ok'] = 0;
		$result['tset'] = "Hallo";
		$oid = FormUtil::getPassedValue('oid', null, 'POST');
		$nid = FormUtil::getPassedValue('nid', null, 'POST');
		$state = FormUtil::getPassedValue('state', null, 'POST');
		$dbclass = FormUtil::getPassedValue('dbclass', null, 'POST');
		
		if($state){
			$outputs = $this->entityManager->getRepository('Vermeldungen_Entity_NewsOutput')->findBy(array('oid'=>$oid,'nid'=>$nid),array());
			if( isset($outputs[0]) )
				$output = $outputs[0];
			else
				$output = new Vermeldungen_Entity_NewsOutput();
			
			$output->setNid($nid);
			$output->setOid($oid);
			if($dbclass == 'general')
				$output->setGeneral(1);
			else
				$output->setGeneral(0);
			$this->entityManager->persist($output);
			$this->entityManager->flush();
		}
		else{
			$outputs = $this->entityManager->getRepository('Vermeldungen_Entity_NewsOutput')->findBy(array('oid'=>$oid,'nid'=>$nid),array());
			if( isset($outputs[0]) ){
				$output = $outputs[0];
				$this->entityManager->remove($output);
				$this->entityManager->flush();
			}
		}
		
		$result['text'] = "";
		
		return new Zikula_Response_Ajax($result);
	}
}
