<?php
if(!defined('OSTCLIENTINC') || !$category || !$category->isPublic()) die('Access Denied');
?>

<div>
    <h1><?php echo __('Frequently Asked Questions');?></h1>
    <div id="breadcrumbs">
    <a href="index.php"><?php echo __('All Categories');?></a>
    &raquo;
    </div>

    <h2><strong><?php echo $category->getLocalName() ?></strong></h2>
<p>
<?php echo Format::safe_html($category->getLocalDescriptionWithImages()); ?>
</p>
<?php
$faqs = FAQ::objects()
    ->filter(array('category'=>$category))
    ->exclude(array('ispublished'=>FAQ::VISIBILITY_PRIVATE))
    ->annotate(array('has_attachments' => SqlAggregate::COUNT(SqlCase::N()
        ->when(array('attachments__inline'=>0), 1)
        ->otherwise(null)
    )))
    ->order_by('-ispublished', 'question');

if ($faqs->exists(true)) {
    echo '<div id="faq">
            <ol>';
foreach ($faqs as $F) {
        $attachments=$F->has_attachments?'<span class="Icon file"></span>':'';
        echo sprintf('
            <li><a href="faq.php?id=%d" class="w3-text-dark-grey" >%s &nbsp;%s</a></li>',
            $F->getId(),Format::htmlchars($F->question), $attachments);
    }
    echo '  </ol>
         </div>';
}else {
    echo '<strong>'.__('This category does not have any FAQs.').' <a href="index.php">'.__('Back To Index').'</a></strong>';
}
?>
</div>
