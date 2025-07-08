<div class='mx-auto m-5 text-center'>
    <h2 class='
        text-<?= $block->setting('text_color') ?><?= $block->setting('text_transparency') ?> 
        text-4xl
        my-<?= $block->setting('margin_y') ?> 
        py-<?= $block->setting('padding_y') ?> 
        xy-<?= $block->setting('padding_x') ?> '
    >
        <?= $block->setting('title_text') ?>
    </h2>
    <p class='mt-8 text-pretty text-lg font-medium sm:text-xl/8 text-<?= $block->setting('subtitle_text_color') ?><?= $block->setting('subtitle_text_transparency') ?>'>
        <?= $block->setting('subtitle_text') ?>
    </p>
</div>