<?php 
/**
 * Options - Post type section
 */

namespace Ejo\Knowledgebase;

?>
<table class="form-table">

<?php if (get_option('permalink_structure')): ?>
	<tr>
		<th><label><?= __('Archive URL slug', 'ejo-kb') ?></label></th>
		<td>
			<div class="input-row">
				<div><?php echo home_url('/', 'ejo-kb') ?></div>
				<div class="input-element"><input type="text" value="<?php echo esc_Attr(I18n::_x('encyclopedia', 'URL slug')) ?>" <?php disabled(True) ?> ></div>
			</div>
			<p class="help"><?= __('The url slug of your encyclopedia archive. This slug must not used by another post type or page.', 'ejo-kb') ?></p>
		</td>
	</tr>

	<tr>
		<th><label><?= __('Item URL slug', 'ejo-kb') ?></label></th>
		<td>
			<div class="input-row">
				<div><?php echo Home_Url('/', 'ejo-kb') ?></div>
				<div class="input-element"><input type="text" value="<?php echo esc_Attr(I18n::_x('encyclopedia', 'URL slug')) ?>" <?php disabled(True) ?> ></div>
				<div><?php echo User_TrailingSlashIt(sprintf(I18n::__('/%%%s-name%%'), sanitize_Title(Post_Type_Labels::getItemSingularName())), 'single', 'ejo-kb') ?></div>
			</div>
		</td>
	</tr>
<?php endif ?>

</table>