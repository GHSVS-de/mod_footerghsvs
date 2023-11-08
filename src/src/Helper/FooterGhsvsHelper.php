<?php

namespace GHSVS\Module\FooterGhsvs\Site\Helper;

\defined('_JEXEC') or die;

use Joomla\Registry\Registry;
use Joomla\CMS\Factory;
use Joomla\CMS\Uri\Uri;
use Joomla\CMS\Language\Text;
use Joomla\CMS\HTML\HTMLHelper;

class FooterGhsvsHelper
{
	public function getDisplayData(Registry $moduleParams, Object $module): array
	{
		$lineone = [];

		$displayData = [
			'cur_year' => $this->getCur_Year(),
			'footerstart' => $this->getFooterStart($moduleParams, $lineone),
			'footertext' => $this->getFooterText($moduleParams, $lineone),
			'footertel' => $this->getFooterTel($moduleParams, $lineone),
			'footeremail' => $this->getFooterEmail($moduleParams, $lineone),
			'footerweb' => $this->getFooterWeb($moduleParams, $lineone),
			'divider' => $this->getDivider($moduleParams, $lineone),
			'modId' => 'modId-' . $module->module . $module->id,
			'moduleclass_sfx' => $this->getModuleclass_sfx($moduleParams),
			'module' => $this->prepareModule($moduleParams, $module),
		];

		foreach ($lineone as $key =>$entry)
		{
			$lineone[$key] = '<span class="footerghsvsEntry ' . $key . '">' . $entry
				. '</span>';
		}

		$displayData['lineone'] = trim(implode('<span class=footerghsvsDivider>'
			. $displayData['divider'] . '</span>', $lineone));

		return $displayData;
	}

	/*
	Startjahr bis aktuelles Jahr
	ODER
	nur aktuelles Jahr
	*/
	public function getFooterStart(Registry $params, &$lineone) : string
	{
		$cur_year	= $this->getCur_Year();

		if (($footerstart = trim($params->get('footerstart', ''))) !== '')
		{
			$footerstart = '&copy;' . $footerstart . '-' . $cur_year;
		}
		else
		{
			$footerstart = '&copy;' . $cur_year;
		}

		$lineone[] = $footerstart;
		return $footerstart;
	}

	/*
	Footertext
	*/
	public function getFooterText(Registry $params, &$lineone) : string
	{
		if (($footertext = trim($params->get('footertext', ''))) !== '')
		{
			$lineone[] = $footertext;
		}

		return $footertext;
	}

	/*
	Footertel
	*/
	public function getFooterTel(Registry $params, &$lineone) : string
	{
		if (($footertel = trim($params->get('footertel', ''))) !== '')
		{
			$lineone[] = $footertel;
		}

		return $footertel;
	}

	/*
	Footeremail
	*/
	public function getFooterEmail(Registry $params, &$lineone) : string
	{

		if (($footeremail = trim($params->get('footeremail', ''))) !== '')
		{
			$footeremail = HTMLHelper::_('email.cloak', $footeremail);
			$lineone[] = $footeremail;
		}

		return $footeremail;
	}

	/*
	Footerweb
	*/
	public function getFooterWeb(Registry $params, &$lineone) : string
	{
		if (($footerweb = trim($params->get('footerweb', ''))) !== '')
		{
			$footerweb = '<a href="' . Uri::getInstance()->getScheme() . '://'
				. $footerweb . '">' . $footerweb .'</a>';
			$lineone[] = $footerweb;
		}

		return $footerweb;
	}

	/*
	Divider
	*/
	public function getDivider(Registry $params) : string
	{
		return $params->get('divider', ' ° ');
	}

	public function getModuleclass_sfx(Registry $params) : string
	{
		return $this->clean($params->get('moduleclass_sfx', ''));
	}

	private function prepareModule(Registry $params, Object $module) : object
	{
		$module->title = Text::_($module->title);
		return $module;
	}

	/*
	Aktuelles Jahr
	*/
	public function getCur_Year() : string
	{
		return Factory::getDate()->format('Y');
	}

	private function clean(String $string) : string
	{
		return empty($string) ? '' : htmlspecialchars(Text::_($string), ENT_QUOTES,
			'UTF-8');
	}
}
