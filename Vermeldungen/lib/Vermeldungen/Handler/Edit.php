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
class Vermeldungen_Handler_Edit extends Zikula_Form_AbstractHandler
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
        if ($actionid) {
            // load user with id
            $data = $this->entityManager->find('Vermeldungen_Entity_Data', $actionid);

            if (!$data) {
                return LogUtil::registerError($this->__f('News with id %s not found', $actionid));
            }
            $view->assign('data',$data);
        } else {
            echo 'No ID';
        }


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
        $d['tid'] = 0;

        // merge user and save everything
        $data = $this->entityManager->find('Vermeldungen_Entity_Data', $actionid);
        $data->merge($d);
        $this->entityManager->persist($data);
        $this->entityManager->flush();

        return $view->redirect($url);
    }
}
