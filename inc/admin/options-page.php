<?php 

Namespace Ejo\Knowledgebase;

?>

<div class="wrap">

    <h1><?= get_admin_page_title() ?></h1>
    
    <?php if (isset($_GET['options_saved'])): ?>
        <div id="message" class="updated fade">
            <p><strong><?= __('Settings saved.', 'ejo-kb') ?></strong></p>
        </div>
    <?php endif ?>

    <style>
        .postbox-container {
            width: 100%;
            max-width: 960px;
            float: none;
        }

        input[type="text"], input[type="password"] {
            width: 100%;
        }
    </style>

    <form method="post" action="">
        <div class="metabox-holder">

            <div class="postbox-container">
                <?php foreach (Options::get_option_boxes() as $box): ?>
                    <div class="postbox">
                        <h2 class="hndle"><?php echo $box->title ?></h2>
                        <div class="inside"><?php include $box->file ?></div>
                    </div>
                <?php endforeach ?>
            </div>

        </div>

        <p class="submit">
            <input type="submit" class="button-primary" value="<?= __('Save Changes', 'ejo-') ?>">
        </p>

        <?php wp_nonce_field('save_knowledgebase_options') ?>
    </form>

</div>