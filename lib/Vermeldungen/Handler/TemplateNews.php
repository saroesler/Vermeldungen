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
class Vermeldungen_Handler_TemplateNews extends Zikula_Form_AbstractHandler
{

    private $data;

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
        $class = FormUtil::getPassedValue('class',null,'GET');
        $new = false;
        if ($actionid) {
            // load user with id
            switch($class){
            	case 'general':
            		$data = $this->entityManager->find('Vermeldungen_Entity_General', $actionid);
            		break;
            	case 'special':
            		$data = $this->entityManager->find('Vermeldungen_Entity_Data', $actionid);
            		break;
            	default:
            		return LogUtil::registerError($this->__('There is no class given'));
            }

            if (!$data) {
                return LogUtil::registerError($this->__f('News with id %s not found', $actionid));
            }
        } else {
            switch($class){
            	case 'general':
            		$data = new Vermeldungen_Entity_General();
            		break;
            	case 'special':
            		$data = new Vermeldungen_Entity_Data();
            		break;
            	default:
            		return LogUtil::registerError($this->__f('There is no class given'));
            }
            $data->setTid(0);
            $new = true;
        }
        $forms = ModUtil::apiFunc('Vermeldungen', 'Template', 'getTemplateSelector');
        $this->data = $data;
        $view->assign('forms',$forms);
        $view->assign('new',$new);
        $view->assign('class',$class);
        $view->assign('data',$data);


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
        $url = ModUtil::url('Vermeldungen', 'admin', 'Main' );
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
        $data['name'] = "";
        $data->merge($d);
        $this->entityManager->persist($data);
        $this->entityManager->flush();
        
        $fields = $this->entityManager->getRepository('Vermeldungen_Entity_TemplateField')->findBy(array('tid'=>$data->getTid()),array('name'=>'ASC'));
        $i = 0;
        foreach($fields as $field){
        	$attribute = FormUtil::getPassedValue('attribute'.$i,null,'POST');
        	$tfid = FormUtil::getPassedValue('attributetfid'.$i,null,'POST');
        	
        	$hasfield = $this->entityManager->getRepository('Vermeldungen_Entity_NewsField')->findBy(array('nid'=>$data->getId(), 'tfid'=>$tfid));
        	if(isset($hasfield[0]))
        		$fielddb = $hasfield[0];
        	else
        		$fielddb = new Vermeldungen_Entity_NewsField();
        	
        	$fielddb->setNid($data->getId());
        	$fielddb->setTfid($tfid);
        	$fielddb->setValue($attribute);
        	
        	$this->entityManager->persist($fielddb);
        	$this->entityManager->flush();
        	$i ++;
        }

        return $view->redirect($url);
    }
}
