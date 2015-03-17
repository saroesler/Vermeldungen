<?php

/**
 * This is the admin controller class providing navigation and interaction functionality.
 */
class Vermeldungen_Controller_Admin extends Zikula_AbstractController
{
    /**
     * @brief Main function.
     * @throws Zikula_Forbidden If not ACCESS_ADMIN
     * @return template Admin/Main.tpl
     * 
     * @author Sascha Rösler
     */
    public function main()
    {
    	$this->throwForbiddenUnless(SecurityUtil::checkPermission('Vermeldungen::', '::', ACCESS_ADMIN));
    	
    	$datas = $this->entityManager->getRepository('Vermeldungen_Entity_Data')->findBy(array(),array('ddate'=>'ASC', 'dtime' => 'ASC'));
    	$general = $this->entityManager->getRepository('Vermeldungen_Entity_General')->findBy(array());
    	$outputs = $this->entityManager->getRepository('Vermeldungen_Entity_Output')->findBy(array());
    	return $this->view
    		->assign('datas', $datas)
    		->assign('outputs', $outputs)
    		->assign('general', $general)
    		->fetch('Admin/Main.tpl');
    }
    
    /**
     * @brief Churche add function.
     * @throws Zikula_Forbidden If not ACCESS_ADMIN
     * @return redirect self::ChurchesView()
     */
    /*public function DataAdd()
    {
    	$this->throwForbiddenUnless(SecurityUtil::checkPermission('Vermeldungen::', '::', ACCESS_ADMIN));
    	$action = FormUtil::getPassedValue('action', null, 'POST');
    	switch($action)
    	{
    	case 'add':
    		$name = FormUtil::getPassedValue('inname', null, 'POST');
      		$time = FormUtil::getPassedValue('intime', null, 'POST');
      		$date = FormUtil::getPassedValue('indate', null, 'POST');
    	
			if($name == "")
				return LogUtil::RegisterError($this->__("The added News has no name."), null, ModUtil::url($this->name, 'admin', 'Main'));
			if($time == "")
				return LogUtil::RegisterError($this->__("The added News has no time."), null, ModUtil::url($this->name, 'admin', 'Main'));
			
			if($date == "")
				return LogUtil::RegisterError($this->__("The added News has no date."), null, ModUtil::url($this->name, 'admin', 'Main'));
				
			$data = new Vermeldungen_Entity_Data();
			$data->setDname($name);
			$data->setDdate($date);
			$data->setDtime($time);
			$this->entityManager->persist($data);
			$this->entityManager->flush();
			LogUtil::RegisterStatus($this->__("News has been added successfully."));
			break;
		}
    	$this->redirect(ModUtil::url($this->name, 'admin', 'Main'));
    } */
    
    public function DataEdit()
    {
    	$actionid = FormUtil::getPassedValue('id',null,'GET');
		if( $actionid=="")
			return LogUtil::RegisterError($this->__("ID is missing."), null, ModUtil::url($this->name, 'admin','Main'));
		$data = $this->entityManager->find('Vermeldungen_Entity_Data', $actionid);
		if($data->getTid()){
			$form = FormUtil::newForm('Vermeldungen', $this);
    		return $form->execute('Admin/TemplateNews.tpl', new Vermeldungen_Handler_TemplateNews());
		}
		else{
			$form = FormUtil::newForm('Vermeldungen', $this);
			return $form->execute('Admin/DataEdit.tpl', new Vermeldungen_Handler_Edit());
    	}
		break;
    }
    
    /*public function DataDel()
    {
    	$actionid = FormUtil::getPassedValue('id',null,'GET');
			if( $actionid=="")
				return LogUtil::RegisterError($this->__("ID is missing."), null, ModUtil::url($this->name, 'admin','Main'));
			$church = $this->entityManager->find('Vermeldungen_Entity_Data', $actionid);
			//del church
			$this->entityManager->remove($church);
			$this->entityManager->flush();
			LogUtil::RegisterStatus($this->__("Church has been removed successfully."));
			$this->redirect(ModUtil::url($this->name, 'admin', 'Main'));
    }*/
    
    /*public function GeneralAdd()
    {
    	$this->throwForbiddenUnless(SecurityUtil::checkPermission('Vermeldungen::', '::', ACCESS_ADMIN));
    	$action = FormUtil::getPassedValue('gaction', null, 'POST');
    	switch($action)
    	{
    	case 'add':
    		$name = FormUtil::getPassedValue('ginname', null, 'POST');
    	
			if($name == "")
				return LogUtil::RegisterError($this->__("The added News has no name."), null, ModUtil::url($this->name, 'admin', 'Main'));
			$data = new Vermeldungen_Entity_General();
			$data->setGname($name);
			$this->entityManager->persist($data);
			$this->entityManager->flush();
			LogUtil::RegisterStatus($this->__("News has been added successfully."));
			break;
		}
    	$this->redirect(ModUtil::url($this->name, 'admin', 'Main'));
    } */
    
    public function GeneralEdit()
    {
    	$actionid = FormUtil::getPassedValue('id',null,'GET');
		if( $actionid=="")
			return LogUtil::RegisterError($this->__("ID is missing."), null, ModUtil::url($this->name, 'admin','Main'));
		$data = $this->entityManager->find('Vermeldungen_Entity_General', $actionid);
		if($data->getTid()){
			$form = FormUtil::newForm('Vermeldungen', $this);
    		return $form->execute('Admin/TemplateNews.tpl', new Vermeldungen_Handler_TemplateNews());
		}
		else{
			$form = FormUtil::newForm('Vermeldungen', $this);
			return $form->execute('Admin/GeneralEdit.tpl', new Vermeldungen_Handler_GeneralEdit());
    	}
		break;
    }
    
    public function newNewsTemplate(){
		$this->throwForbiddenUnless(SecurityUtil::checkPermission('Vermeldungen::', '::', ACCESS_ADMIN));
		$form = FormUtil::newForm('Vermeldungen', $this);
    	return $form->execute('Admin/TemplateNews.tpl', new Vermeldungen_Handler_TemplateNews());
		break;
	}
	
	 public function listTemplate()
    {
    	$this->throwForbiddenUnless(SecurityUtil::checkPermission('Vermeldungen::', '::', ACCESS_ADMIN));
    	
    	$templates = $this->entityManager->getRepository('Vermeldungen_Entity_Template')->findBy(array(),array('value'=>'ASC'));
    	return $this->view
    		->assign('templates', $templates)
    		->fetch('Template/List.tpl');
    }
    
    public function EditTemplate()
	{
		$this->throwForbiddenUnless(SecurityUtil::checkPermission('Vermeldungen::', '::', ACCESS_ADMIN));
		$form = FormUtil::newForm('Vermeldungen', $this);
    	return $form->execute('Template/TemplateEdit.tpl', new Vermeldungen_Handler_Template());
		break;
	}
	
	public function manageOutputs()
    {
    	$this->throwForbiddenUnless(SecurityUtil::checkPermission('Vermeldungen::', '::', ACCESS_ADMIN));
    	
    	$outputs = $this->entityManager->getRepository('Vermeldungen_Entity_Output')->findBy(array(),array('name'=>'ASC'));
    	
    	$tabelle = $this->view
    		->assign('outputs', $outputs)
    		->fetch('Ajax/Output.tpl');
    	
    	return $this->view
    		->assign('tabelle', $tabelle)
    		->fetch('Admin/OutputManager.tpl');
    }
    
    
    /*public function GeneralDel()
    {
    	$actionid = FormUtil::getPassedValue('id',null,'GET');
			if( $actionid=="")
				return LogUtil::RegisterError($this->__("ID is missing."), null, ModUtil::url($this->name, 'admin','Main'));
			$church = $this->entityManager->find('Vermeldungen_Entity_Data', $actionid);
			//del church
			$this->entityManager->remove($church);
			$this->entityManager->flush();
			LogUtil::RegisterStatus($this->__("Church has been removed successfully."));
			$this->redirect(ModUtil::url($this->name, 'admin', 'Main'));
    }*/
    
    /**
     * @brief Vermeldungen add function.
     * @throws Zikula_Forbidden If not ACCESS_ADMIN
     * @return redirect self::special_Vermeldungen()
     */
    public function Help()
    {
    	return $this->view
    		->assign('Vermeldungens', $Vermeldungens)
    		->fetch('Admin/Help.tpl');
    }
    
    public function printpdf()
    {
    	$monate = array(1=>"Januar",
                2=>"Februar",
                3=>"M&auml;rz",
                4=>"April",
                5=>"Mai",
                6=>"Juni",
                7=>"Juli",
                8=>"August",
                9=>"September",
                10=>"Oktober",
                11=>"November",
                12=>"Dezember");
    	$oid = FormUtil::getPassedValue('oid',0,'GET');
    	$format;
    	if($oid){
    		$output = $this->entityManager->find('Vermeldungen_Entity_Output', $oid);
    		$format = $output->getPageFormat();
    	}
    	else
    		$format = A4;
    	//get next sunday
    	$sgnaturedate = new DateTime();
    	while(($sgnaturedate->format("D"))!="Sun")
    	{
    		//Ein Tag addieren
			$sgnaturedate->add(new DateInterval('P1D')); 
		}
    	$tcpdf = PluginUtil::loadPlugin('SystemPlugin_Tcpdf_Plugin');
		$pdf = $tcpdf->createPdf(P, 'mm', $format , true, 'UTF-8', false);
		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Maria, Hilfe der Christen');
		$pdf->SetTitle('Vermeldungen');
		if($format == A4){
			$pdf->SetLeftMargin(20);
			$pdf->SetTopMargin(20);
			$pdf->SetRightMargin(20);
		}
		else{
			$pdf->SetLeftMargin(10);
			$pdf->SetTopMargin(10);
		}
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
		$pdf->SetFont('', '',12);
		// add a page
		$pdf->AddPage();
		
		//get Data
    	$datas = $this->entityManager->getRepository('Vermeldungen_Entity_Data')->findBy(array(),array('ddate'=>'ASC', 'dtime' => 'ASC'));
    	$general = $this->entityManager->getRepository('Vermeldungen_Entity_General')->findBy(array());
    	$i = 0;
    	foreach($datas as $data){
    		if(!$data->hasOutput($oid))
    			unset($datas[$i]);
    		$i ++;
    	}
    	$i = 0;
    	foreach($general as $data){
    		if(!$data->hasOutput($oid))
    			unset($general[$i]);
    		$i ++;
    	}
    	
    	$dates= array();
    	$row =0;
    	$datekey=0;
    	/*foreach($datas as $data)
    	//format the dates, that the date of a day is shown only on the highest cell
    	{
    		if($datekey>0)
    		{
    			if($dates[$datekey-1]['date']!=$data->getDDateFormattedout())
    			{
    				$row++;
    				$dates[] = array("date"=>$data->getDDateFormattedout(),"rows"=>1, "row"=>$row);
    				$datekey++;
    			}
    			else
    				$dates[$datekey-1]['rows']++;
    		}
    		else
			{
				$row++;
				$dates[] = array("date"=>$data->getDDateFormattedout(),"rows"=>1, "row"=>$row);
				$datekey++;
			}
    		$row++;
    	}*/
    	
		// set some text to print
		$signaturemounth = $sgnaturedate->format("n");
		$signaturemounthde = $monate[$signaturemounth];
		
		$heading = "<h1  style=\"text-align:center;\">Vermeldungen vom So.".$sgnaturedate->format(" d. ").$signaturemounthde.$sgnaturedate->format(" Y")."</h1>";
		
		$doc_last = 0;
		$doc_row = 0;
		$doc_date = 0;
		
		if($format == A4){
			$txt = $this->view
				->assign('datas', $datas)
				->assign('dates', $dates)
				->assign('heading',$heading)
				->fetch('Print/VermeldungenA4.tpl');
		}
		else{
			$txt = $this->view
				->assign('datas', $datas)
				->assign('dates', $dates)
				->assign('heading',$heading)
				->fetch('Print/VermeldungenA5.tpl');
		}
    	
    		
		$pdf->writeHTML($txt, true, false, true, false, '');
		
		//general vermeldungen
		
		// print a block of text using Write()
		// output the HTML content
		//$pdf->writeHTML($txt, true, false, true, false, '');
		foreach($general as $generales){
			if($generales->getTid() == 0)
				$pdf->Write(0, $generales->getGname()."\n\n", '', 0, '', true, 0, false, false, 0);
			else
				$pdf->writeHTML(ModUtil::apiFunc('Vermeldungen', 'Template', 'renderTemplate', array('nid' => $generales->getGid(), 'dbtype'=>'g')), true, false, true, false, '');
		}
		// reset pointer to the last page
		$pdf->lastPage();

		// ---------------------------------------------------------

		//Close and output PDF document
		ob_end_clean();
		$pdf->Output('Vermeldungen_'.$sgnaturedate->format("Y_m_d").'.pdf', 'I');
		System::shutdown();
		return;
    }
}

