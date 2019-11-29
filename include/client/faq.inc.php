<?php
if(!defined('OSTCLIENTINC') || !$faq  || !$faq->isPublished()) die('Access Denied');

$category=$faq->getCategory();

?>
<div>

<h1><?php echo __('Frequently Asked Questions');?></h1>
<div id="breadcrumbs">
    <a href="index.php"><?php echo __('All Categories');?></a>
    &raquo; <a href="faq.php?cid=<?php echo $category->getId(); ?>"><?php echo $category->getLocalName(); ?></a>
</div>

<div class="faq-content">
<div class="article-title flush-left">
<?php echo $faq->getLocalQuestion() ?>
</div>
<div class="faded"><?php echo sprintf(__('Last Updated %s'),
    Format::relativeTime(Misc::db2gmtime($category->getUpdateDate()))); ?></div>
<br/>
<div class="thread-body bleed">
<?php echo $faq->getLocalAnswerWithImages(); ?>
</div>
<br/>
</div>
</div>
