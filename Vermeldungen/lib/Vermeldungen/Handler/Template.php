<?php
/**
 * Copyright Zikula Foundation 2010 - Zikula Application Framework
 *
 * This work is contributed to the Zikula Foundation under one or more
 * Contributor Agreements and licensed to You under the following license:
 *
 * @license MIT
 * @package ZikulaExamples_ExampleDoctrine
 *
 * Please see the NOTICE file distributed with this source code for further
 * information regarding copyright and licensing.
 */

/**
 * Form handler for create and edit.
 */
class Vermeldungen_Handler_Template extends Zikula_Form_AbstractHandler
{

    private $data;
    private $fields;

    /**
     * Setup form.
     *
     * @param Zikula_Form_View $view Current Zikula_Form_View instance.
     *
     * @return boolean
     */
    public function initialize(Zikula_Form_View $view)
    {
        // Get the id.
        $actionid = FormUtil::getPassedValue('id',null,'GET');
        if ($actionid) {
            // load user with id
            $data = $this->entityManager->find('Vermeldungen_Entity_Template', $actionid);

            if (!$data) {
                return LogUtil::registerError($this->__f('News with id %s not found', $actionid));
            }
            
            $fields = $this->entityManager->getRepository('Vermeldungen_Entity_TemplateField')->findBy(array('tid'=>$actionid),array());
        } else {
            $data = new Vermeldungen_Entity_Template();
            $fields = array();
        }
        $this->data = $data;
        $this->fields = $fields;
        $view->assign('data',$data);
        $view->assign('fields',$fields);


        // assign current values to form fields
        return true;
    }

    /**
     * Handle form submission.
     *
     * @param Zikula_Form_View $view  Current Zikula_Form_View instance.
     * @param array            &$args Args.
     *
     * @return boolean
     */
    public function handleCommand(Zikula_Form_View $view, &$args)
    {
    	$actionid = FormUtil::getPassedValue('id',null,'GET');
        $url = ModUtil::url('Vermeldungen', 'admin', 'listTemplate' );
        if ($args['commandName'] == 'cancel') {
            return $view->redirect($url);
        }


        // check for valid form
        if (!$view->isValid()) {
            return false;
        }
        // load form values
        $d = $view->getValues();
        print_r($d);

        // merge user and save everything
        $data = $this->data;
        $fields = $this->fields;
        $data->merge($d);
        $this->entityManager->persist($data);
        $this->entityManager->flush();
        
        $attributes_num = FormUtil::getPassedValue('attributes_num',null,'POST');
		for($i = 0;$i<=$attributes_num;$i++)
		{
			$attribute = FormUtil::getPassedValue('attribute'.$i,null,'POST');
			$fieldid = FormUtil::getPassedValue('attributeid'.$i,null,'POST');
			if($attribute!="")
			{
				if($fieldid)
					$field = $this->entityManager->find('Vermeldungen_Entity_TemplateField', $fieldid);
				else
					$field = new Vermeldungen_Entity_TemplateField();
				foreach($fields as $field){
					if($field->getName()==$attribute && $field->getTfid()!=$fieldid ){
						LogUtil::RegisterError($this->__("This Attribute does already exist!"));
						return false;
					}
				}
				$field->setTid($data->getTid());
				$field->setName($attribute);
				$this->entityManager->persist($field);
				$this->entityManager->flush();
			}
			elseif($fieldid){
				//lösche Feld
				$data = $this->entityManager->find('Vermeldungen_Entity_TemplateField', $fieldid);
				$this->entityManager->remove($data);
				$this->entityManager->flush();
			}
		}
		LogUtil::RegisterStatus($this->__("Template has been edited successfully."));
        return $view->redirect($url);
    }
}
