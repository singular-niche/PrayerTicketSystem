
<div>
    <h1><?php echo __('Frequently Asked Questions');?></h1>
    <div><strong><?php echo __('Search Results'); ?></strong></div>
<?php
    if ($faqs->exists(true)) {
        echo '<div id="faq">'.sprintf(__('%d FAQs matched your search criteria.'),
            $faqs->count())
            .'<ol>';
        foreach ($faqs as $F) {
            echo sprintf(
                '<li><a href="faq.php?id=%d" class="previewfaq">%s</a></li>',
                $F->getId(), $F->getLocalQuestion(), $F->getVisibilityDescription());
        }
        echo '</ol></div>';
    } else {
        echo '<strong class="faded">'.__('The search did not match any FAQs.').'</strong>';
    }
?>
</div>
