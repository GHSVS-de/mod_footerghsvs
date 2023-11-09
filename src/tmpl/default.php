<?php
defined('_JEXEC') or die;

/* From Dispatcher:
$module
$params
$app
$input
$template

$cur_year String Current Year
$footerstart String Start year
$footertext String
$footertel String
$footeremail String Email
$footerweb String
$divider String
$modId String Soemthing like "modId-mod_footerghsvs123456"
$moduleclass_sfx String
$module->title String Translated if lang string entered
$lineone String Concated entries separated by $divider
$helper FooterGhsvsHelper
*/

if (!$lineone)
{
	return;
}
?>
<div id="<?php echo  $modId; ?>" class="footerghsvs mod_footerghsvs" aria-label="Copyright">
	<?php echo $lineone; ?>
</div>
