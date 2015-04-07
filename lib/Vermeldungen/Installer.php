<?php
/**
 * Installer.
 */
class Vermeldungen_Installer extends Zikula_AbstractInstaller
{

	/**
	 * @brief Provides an array containing default values for module variables (settings).
	 * @return array An array indexed by variable name containing the default values for those variables.
	 *
	 * @author Sascha Rösler
	 */
	protected function getDefaultModVars()
	{
		return array();
	}

	/**
	 * Install the Vermeldungen module.
	 *
	 * This function is only ever called once during the lifetime of a particular
	 * module instance.
	 *
	 * @return boolean True on success, false otherwise.
	 */
	public function install()
	{
		$this->setVars($this->getDefaultModVars());

		// Create database tables.
		try {
			DoctrineHelper::createSchema($this->entityManager, array(
				'Vermeldungen_Entity_Data'
			));
		} catch (Exception $e) {
			return LogUtil::registerError($e);
		}
		
		try {
			DoctrineHelper::createSchema($this->entityManager, array(
				'Vermeldungen_Entity_General'
			));
		} catch (Exception $e) {
			return LogUtil::registerError($e);
		}
		
		HookUtil::registerSubscriberBundles($this->version->getHookSubscriberBundles());
		
		return true;
	}


	/**
	 * Upgrade the Vermeldungen module from an old version
	 *
	 * This function must consider all the released versions of the module!
	 * If the upgrade fails at some point, it returns the last upgraded version.
	 *
	 * @param  string $oldVersion   version number string to upgrade from
	 *
	 * @return mixed  true on success, last valid version string or false if fails
	 */
	public function upgrade($oldversion)
	{
		switch($oldversion)
		{
			case "1.0.0":
				HookUtil::registerSubscriberBundles($this->version->getHookSubscriberBundles());
			case "1.1.0":
				try {
					DoctrineHelper::updateSchema($this->entityManager, array('Vermeldungen_Entity_Data'));
					DoctrineHelper::updateSchema($this->entityManager, array('Vermeldungen_Entity_General'));
				} catch (Exception $e) {
					return LogUtil::registerError($e);
				}
			case "1.1.1":
				try {
					DoctrineHelper::createSchema($this->entityManager, array('Vermeldungen_Entity_Template'));
					DoctrineHelper::createSchema($this->entityManager, array('Vermeldungen_Entity_TemplateField'));
					DoctrineHelper::createSchema($this->entityManager, array('Vermeldungen_Entity_NewsField'));
				} catch (Exception $e) {
					return LogUtil::registerError($e);
				}
			case "1.1.2":
				try {
					DoctrineHelper::updateSchema($this->entityManager, array('Vermeldungen_Entity_Template'));
				} catch (Exception $e) {
					return LogUtil::registerError($e);
				}
			case "1.1.3":
				try {
					DoctrineHelper::updateSchema($this->entityManager, array('Vermeldungen_Entity_TemplateField'));
				} catch (Exception $e) {
					return LogUtil::registerError($e);
				}
			case "1.2.0":
				try {
					DoctrineHelper::createSchema($this->entityManager, array('Vermeldungen_Entity_Output'));
					DoctrineHelper::createSchema($this->entityManager, array('Vermeldungen_Entity_NewsOutput'));
				} catch (Exception $e) {
					return LogUtil::registerError($e);
				}
			case "1.2.2":
				try {
					DoctrineHelper::updateSchema($this->entityManager, array('Vermeldungen_Entity_NewsOutput'));
				} catch (Exception $e) {
					return LogUtil::registerError($e);
				}
			case "1.2.3":
				try {
					DoctrineHelper::updateSchema($this->entityManager, array('Vermeldungen_Entity_Output'));
				} catch (Exception $e) {
					return LogUtil::registerError($e);
				}
			case "2.0.0":
			    try {
					DoctrineHelper::updateSchema($this->entityManager, array('Vermeldungen_Entity_Template'));
				} catch (Exception $e) {
					return LogUtil::registerError($e);
				}
			case "2.0.1":
			    try {
					DoctrineHelper::updateSchema($this->entityManager, array('Vermeldungen_Entity_Output'));
				} catch (Exception $e) {
					return LogUtil::registerError($e);
				}
			default:
				break;
		}
		return true;
	}


	/**
	 * Uninstall the module.
	 *
	 * This function is only ever called once during the lifetime of a particular
	 * module instance.
	 *
	 * @return bool True on success, false otherwise.
	 */
	public function uninstall()
	{
		// Drop database tables
		DoctrineHelper::dropSchema($this->entityManager, array(
			'Vermeldungen_Entity_Data'
		));
		
		DoctrineHelper::dropSchema($this->entityManager, array(
			'Vermeldungen_Entity_General'
		));
		
		$this->delVars();
		
		HookUtil::unregisterSubscriberBundles($this->version->getHookSubscriberBundles());

		return true;
	}

}
