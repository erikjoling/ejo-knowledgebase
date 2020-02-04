<?php 
/**
 * Options - Post type section
 */

namespace Ejo\Knowledgebase;

?>
<table class="form-table">

<tr>
	<th><label for="<?= OptionsPage::get_options_name() ?>[post_type][name]"><?= __('Knowledgebase name', 'ejo-kb') ?></label></th>
	<td>
		<input type="text" name="<?= OptionsPage::get_options_name() ?>[post_type][name]" id="<?= OptionsPage::get_options_name() ?>[post_type][name]" value="<?= esc_attr(Post_Type::get_name()) ?>">
		<p class="help">
			<?= __('This is how your knowledgebase is called in the dashboard. For example: Encyclopedia, Lexicon, Glossary, Knowledge Base, etc.', 'ejo-kb') ?>
		</p>
	</td>
</tr>

<tr>
	<th><label for="<?= OptionsPage::get_options_name() ?>[archive_page]"><?= __('Archive Page', 'ejo-kb') ?></label></th>
	<td>
		<?php 
			wp_dropdown_pages( [
				'id'                => OptionsPage::get_options_name() . '[archive_page]',
				'name'              => OptionsPage::get_options_name() . '[archive_page]',
				'show_option_none'  => __( '&mdash; Select &mdash;' ),
				'option_none_value' => '0',
				'selected'          => Options::get_archive_page(),
			]);
		?>
		<p class="help"><code><?= get_permalink(Options::get_archive_page()) ?></code></p>
	</td>
</tr>

<tr>
	<th><label><?= __('Single Article URL', 'ejo-kb') ?></label></th>
	<td>
		<code><?= get_permalink(Options::get_archive_page()) ?>%postname%/</code>
	</td>
</tr>

</table>