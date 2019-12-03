<?php
$BUTTONS = isset($BUTTONS) ? $BUTTONS : true;
?>
    <div class="w3-third">
    <div class="w3-col w3-hide-small" style="width:20px;">&nbsp;</div>
    <div class="w3-rest">
<?php if ($BUTTONS) { ?>
        <div class="front-page-button flush-right">
            <div class="w3-hide-medium w3-hide-large" style="height:20px">&nbsp;</div>
<p style="margin-top:0">
<?php
    if ($cfg->getClientRegistrationMode() != 'disabled'
        || !$cfg->isClientLoginRequired()) { ?>
            <a href="open.php" style="display:block" class="w3-btn w3-round w3-pale-green w3-hover-green"><?php
                echo __('Open a New Ticket');?></a>
</p>
<?php } ?>
<p>
            <a href="view.php" style="display:block" class="w3-btn w3-round w3-pale-blue w3-hover-blue"><?php
                echo __('Check Ticket Status');?></a>
</p>
        </div>
<?php } ?>
        <div class="content"><?php
    if ($cfg->isKnowledgebaseEnabled()
        && ($faqs = FAQ::getFeatured()->select_related('category')->limit(5))
        && $faqs->all()) { ?>
            <section><div class="header"><?php echo __('Featured Questions'); ?></div>
<?php   foreach ($faqs as $F) { ?>
            <div><a href="<?php echo ROOT_PATH; ?>kb/faq.php?id=<?php
                echo urlencode($F->getId());
                ?>"><?php echo $F->getLocalQuestion(); ?></a></div>
<?php   } ?>
            </section>
<?php
    }
    $resources = Page::getActivePages()->filter(array('type'=>'other'));
    if ($resources->all()) { ?>
            <section><div class="header"><?php echo __('Other Resources'); ?></div>
<?php   foreach ($resources as $page) { ?>
            <div><a href="<?php echo ROOT_PATH; ?>pages/<?php echo $page->getNameAsSlug();
            ?>"><?php echo $page->getLocalName(); ?></a></div>
<?php   } ?>
            </section>
<?php
    }
        ?></div>
    </div>
    </div>

