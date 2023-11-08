<?php

namespace GHSVS\Module\FooterGhsvs\Site\Dispatcher;

\defined('_JEXEC') or die;

use Joomla\CMS\Dispatcher\AbstractModuleDispatcher;
use Joomla\CMS\Helper\HelperFactoryAwareInterface;
use Joomla\CMS\Helper\HelperFactoryAwareTrait;

class Dispatcher extends AbstractModuleDispatcher implements HelperFactoryAwareInterface
{
	use HelperFactoryAwareTrait;

	protected function getLayoutData()
	{
		/* From parent:
		$module
		$params
		$app
		$input
		$template
		*/
		$data = parent::getLayoutData();
		$helper = $this->getHelperFactory()->getHelper('FooterGhsvsHelper');

		/* From Dispatcher and Helper:
		$cur_year String Current Year
		$footerstart String Start year to Current year OR just Current Year
		$footertext String
		$footertel String
		$footeremail String Cloaked email
		$footerweb String HTML-Anchor
		$divider String
		$modId String Soemthing like "modId-mod_footerghsvs123456"
		$moduleclass_sfx String
		$module->title String Translated if lang string entered
		$lineone String Concated entries separated by $divider
		$helper FooterGhsvsHelper
		*/

		$displayData = $helper->getDisplayData($data['params'], $data['module']);
		$displayData['helper'] = $helper;
		$data['app']->getDocument()->getWebAssetManager()->getRegistry()
			->addExtensionRegistryFile('mod_footerghsvs');
		return array_merge($data, $displayData);
	}
}
