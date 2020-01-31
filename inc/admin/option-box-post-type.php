<?php 
/**
 * Options - Post type section
 */

namespace Ejo\Knowledgebase;

?>
<table class="form-table">

<tr>
	<th><label for="<?= Options::get_option_key() ?>[post_type][name]"><?= __('Knowledgebase name', 'ejo-kb') ?></label></th>
	<td>
		<input type="text" name="<?= Options::get_option_key() ?>[post_type][name]" id="<?= Options::get_option_key() ?>[post_type][name]" value="<?php echo esc_attr(Post_Type::get_name()) ?>">
		<p class="help">
			<?= __('This is how your knowledgebase is called in the dashboard. For example: Encyclopedia, Lexicon, Glossary, Knowledge Base, etc.', 'ejo-kb') ?>
		</p>
	</td>
</tr>

</table>

<?php return; ?>
<tr>
	<th><label for="item_plural_name"><?= __('Item plural name', 'ejo-kb') ?></label></th>
	<td>
		<input type="text" name="item_plural_name" id="item_plural_name" value="<?php echo esc_Attr(Options::get('item_plural_name')) ?>">
		<p class="help"><?= __('The plural name for multiple encyclopedia items. For example: Entries, Terms, Articles, etc.', 'ejo-kb') ?></p>
	</td>
</tr>


<?php if (get_Option('permalink_structure')): ?>
	<tr>
		<th><label><?= __('Archive URL slug', 'ejo-kb') ?></label></th>
		<td>
			<div class="input-row">
				<div><?php echo Home_Url('/', 'ejo-kb') ?></div>
				<div class="input-element"><input type="text" value="<?php echo esc_Attr(I18n::_x('encyclopedia', 'URL slug')) ?>" <?php disabled(True) ?> ></div>
				<?php Mocking_Bird::printProNotice('unlock', 'ejo-kb') ?>
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
				<?php Mocking_Bird::printProNotice('unlock', 'ejo-kb') ?>
			</div>

			<?php if (WPML::isPostTypeSlugTranslationEnabled()): ?>
				<p class="help warning"><?= __('This option is not available if you translate the post type url slug with WPML.', 'ejo-kb') ?></p>
			<?php else: ?>
				<p class="help">
					<?= __('The url slug of your encyclopedia items.', 'ejo-kb') ?>
					<?php if ($taxonomies = Post_Type::getAssociatedTaxonomies()): $taxonomies = Array_Map(function($taxonomy){ return "%{$taxonomy->name}%"; }, $taxonomies) ?>
						<?php printf(I18n::__('You can use these placeholders: %s'), join(', ', $taxonomies)) ?>
					<?php endif ?>
				</p>
			<?php endif ?>
		</td>
	</tr>
<?php endif ?>

</table>