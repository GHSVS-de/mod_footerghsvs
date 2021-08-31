<?php
\defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Uri\Uri;
use Joomla\CMS\Helper\ModuleHelper;

$lineone = [];
$date = Factory::getDate();
$cur_year	= $date->format('Y');

if (($footerstart = trim($params->get('footerstart', ''))) !== '')
{
	$lineone[] = '&copy;' . $footerstart . '-' . $cur_year;
}
else
{
	$lineone[] = '&copy;' . $cur_year;
}

if (($footertext = trim($params->get('footertext', ''))) !== '')
{
	$lineone[] = $footertext;
}

if (($footertel = trim($params->get('footertel', ''))) !== '')
{
	$lineone[] = $footertel;
}

if (($footeremail = trim($params->get('footeremail', ''))) !== '')
{
	$lineone[] = HTMLHelper::_('email.cloak', $footeremail);
}

if (($footerweb = trim($params->get('footerweb', ''))) !== '')
{
	$lineone[] = '<a href="' . Uri::getInstance()->getScheme() . '://'
		. $footerweb . '">' . $footerweb .'</a>';
}

if (($divider = $params->get('divider', '')) === '')
{
	$divider = ' ';
}

$divider = '<span class=footerghsvsDivider>' . $divider . '</span>';

foreach ($lineone as $key =>$entry)
{
	$lineone[$key] = '<span class=footerghsvsEntry>' . $entry . '</span>';
}

$lineone = trim(implode($divider, $lineone));
$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));
require ModuleHelper::getLayoutPath('mod_footerghsvs', $params->get('layout', 'default'));
?>
