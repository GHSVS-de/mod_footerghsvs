<?php
defined('_JEXEC') or die;

use Joomla\CMS\Extension\Service\Provider\HelperFactory;
use Joomla\CMS\Extension\Service\Provider\Module;
use Joomla\CMS\Extension\Service\Provider\ModuleDispatcherFactory;
use Joomla\DI\Container;
use Joomla\DI\ServiceProviderInterface;

return new class () implements ServiceProviderInterface
{
	/**
		* Registers the service provider with a DI container.
		*
		* @param   Container  $container  The DI container.
		*
		* @return  void
		*
		* @since  4.2.6
		*/
	public function register(Container $container)
	{
		$container->registerServiceProvider(new ModuleDispatcherFactory('\\GHSVS\\Module\\FooterGhsvs'));
		$container->registerServiceProvider(new HelperFactory('\\GHSVS\\Module\\FooterGhsvs\\Site\\Helper'));
		$container->registerServiceProvider(new Module());
	}
};
