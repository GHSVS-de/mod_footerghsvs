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
	/* Contains only relevant entries as concated string. */
	private $lineone = [];

	public function getDisplayData(Registry $moduleParams, Object $module): array
	{
		$displayData = [
			'cur_year' => $this->getCur_Year(),
			'footerstart' => $this->getFooterStart($moduleParams),
			'footertext' => $this->getFooterText($moduleParams),
			'footertel' => $this->getFooterTel($moduleParams),
			'footeremail' => $this->getFooterEmail($moduleParams),
			'footerweb' => $this->getFooterWeb($moduleParams),
			'divider' => $this->getDivider($moduleParams),
			'modId' => 'modId-' . $module->module . $module->id,
			'moduleclass_sfx' => $this->getModuleclass_sfx($moduleParams),
			'module' => $this->prepareModule($moduleParams, $module),
		];

		foreach ($this->lineone as $key =>$entry)
		{
			$this->lineone[$key] = '<span class="footerghsvsEntry ' . $key . '">' . $entry
				. '</span>';
		}

		$displayData['lineone'] = trim(implode('<span class=footerghsvsDivider>'
			. $displayData['divider'] . '</span>', $this->lineone));

		return $displayData;
	}

	/*
	Startjahr bis aktuelles Jahr
	ODER
	nur aktuelles Jahr
	*/
	public function getFooterStart(Registry $params) : string
	{
		$cur_year	= $this->getCur_Year();

		if (($footerstart = trim($params->get('footerstart', ''))) !== '')
		{
			$this->lineone['footerstart'] = '&copy;' . $footerstart . '-' . $cur_year;
		}
		else
		{
			$this->lineone['footerstart'] = '&copy;' . $cur_year;
		}

		return $footerstart;
	}

	/*
	Footertext
	*/
	public function getFooterText(Registry $params) : string
	{
		if (($footertext = trim($params->get('footertext', ''))) !== '')
		{
			$this->lineone['footertext'] = $footertext;
		}

		return $footertext;
	}

	/*
	Footertel
	*/
	public function getFooterTel(Registry $params) : string
	{
		if (($footertel = trim($params->get('footertel', ''))) !== '')
		{
			$this->lineone['footertel'] = $footertel;
		}

		return $footertel;
	}

	/*
	Footeremail
	*/
	public function getFooterEmail(Registry $params) : string
	{
		if (($footeremail = trim($params->get('footeremail', ''))) !== '')
		{
			$this->lineone['footeremail'] = HTMLHelper::_('email.cloak', $footeremail);
		}

		return $footeremail;
	}

	/*
	Footerweb
	*/
	public function getFooterWeb(Registry $params) : string
	{
		if (($footerweb = trim($params->get('footerweb', ''))) !== '')
		{
			$footerwebLinked = '<a href="' . Uri::getInstance()->getScheme() . '://'
				. $footerweb . '">' . $footerweb .'</a>';
			$this->lineone['footerweb'] = $footerwebLinked;
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
