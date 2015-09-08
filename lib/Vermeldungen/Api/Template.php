<?php
/**
 * This is the User controller class providing navigation and interaction functionality.
 */
class Vermeldungen_Api_Template extends Zikula_AbstractApi
{
	/**
	 * @brief Get available admin panel links
	 *
	 * @return array array of admin links
	 */
	public function renderTemplate($args)
	{
		if(!isset($args['nid']))
			return LogUtil::RegisterError($this->__("The News doesn't exist!"), null, "");
		$news;
		switch($args['dbtype']){
			case 's':
				$news = $this->entityManager->find('Vermeldungen_Entity_Data', $args['nid']);
				break;
			case 'g':
				$news = $this->entityManager->find('Vermeldungen_Entity_General', $args['nid']);
				break;
			default:
				return "";
		}
		
		if($news->getTid()==0)
		{
			$errortext = "";
			$ausgabedatei = fopen("modules/Vermeldungen/templates/Template/Error.tpl","r");
			while(!feof($ausgabedatei))
			{
			   $errortext .= fgets($ausgabedatei);
			}
			fclose($ausgabedatei);
			return $errortext;
		}
		
		$template = $this->entityManager->find('Vermeldungen_Entity_Template', $news->getTid());
		$result = $template->getValue();
		$fields = $this->entityManager->getRepository('Vermeldungen_Entity_TemplateField')->findBy(array("tid"=> $news->getTid()));
		foreach($fields as $field){
			$attribute = $this->entityManager->getRepository('Vermeldungen_Entity_NewsField')->findBy(array("tfid"=> $field->getTfid(), "nid"=> $news->getId() ));
			$ersatz = "";
			if(isset ($attribute[0])){
				$ersatz = $attribute[0]->getValue();
			}
			$result = str_replace("{".$field->getName()."}", $ersatz, $result);
		}
		return $result;
	}
	
	public function renderPrintTemplate($args)
	{
		if(!isset($args['nid']))
			return LogUtil::RegisterError($this->__("The News doesn't exist!"), null, "");
		$news;
		switch($args['dbtype']){
			case 's':
				$news = $this->entityManager->find('Vermeldungen_Entity_Data', $args['nid']);
				break;
			case 'g':
				$news = $this->entityManager->find('Vermeldungen_Entity_General', $args['nid']);
				break;
			default:
				return "";
		}
		
		if($news->getTid()==0)
		{
			$errortext = "";
			$ausgabedatei = fopen("modules/Vermeldungen/templates/Template/Error.tpl","r");
			while(!feof($ausgabedatei))
			{
			   $errortext .= fgets($ausgabedatei);
			}
			fclose($ausgabedatei);
			return $errortext;
		}
		
		$template = $this->entityManager->find('Vermeldungen_Entity_Template', $news->getTid());
		$result = $template->getPrintTemplate();
		$fields = $this->entityManager->getRepository('Vermeldungen_Entity_TemplateField')->findBy(array("tid"=> $news->getTid()));
		foreach($fields as $field){
			$attribute = $this->entityManager->getRepository('Vermeldungen_Entity_NewsField')->findBy(array("tfid"=> $field->getTfid(), "nid"=> $news->getId() ));
			$ersatz = "";
			if(isset ($attribute[0]))
				$ersatz = $attribute[0]->getValue();
			$result = str_replace("{".$field->getName()."}", $ersatz, $result);
		}
		return $result;
	}
	
	public function renderPreview($args)
	{
		if($args['tid'] == 0)
		{
			$errortext = "";
			$ausgabedatei = fopen("modules/Vermeldungen/templates/Template/Error.tpl","r");
			while(!feof($ausgabedatei))
			{
			   $errortext .= fgets($ausgabedatei);
			}
			fclose($ausgabedatei);
			return $errortext;
		}
		
		$template = $this->entityManager->find('Vermeldungen_Entity_Template', $args['tid']);
		$result = $template->getValue();
		foreach($args['fields'] as $field){
			$templatefield = $this->entityManager->find('Vermeldungen_Entity_TemplateField', $field['attributetf']);
			$result = str_replace("{".$templatefield->getName()."}", $field['attribute'], $result);
		}
		return $result;
	}
	
	public function getTemplateSelector($args)
	{
		$templates = $this->entityManager->getRepository('Vermeldungen_Entity_Template')->findBy(array());
		
		$list = array();
		$list[] = array(
			'text' => __("No Template selected."),
			'value' => 0,
			);
		foreach($templates as $template)
		{
			$list[] = array(
			'text' => $template->getName(),
			'value' => $template->getTid(),
			);
		}
		return $list;
	}
}
