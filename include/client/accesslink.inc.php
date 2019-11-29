<?php
if(!defined('OSTCLIENTINC')) die('Access Denied');

$email=Format::input($_POST['lemail']?$_POST['lemail']:$_GET['e']);
$ticketid=Format::input($_POST['lticket']?$_POST['lticket']:$_GET['t']);

if ($cfg->isClientEmailVerificationRequired())
    $button = __("Email Access Link");
else
    $button = __("View Ticket");
?>
<h1><?php echo __('Check Ticket Status'); ?></h1>
<p><?php
echo __('Please provide your email address and a ticket number.');
if ($cfg->isClientEmailVerificationRequired())
    echo ' '.__('An access link will be emailed to you.');
else
    echo ' '.__('This will sign you in to view your ticket.');
?></p>
<form action="login.php" method="post" id="clientLogin" class="w3-card w3-responsive">
    <?php csrf_token(); ?>
<div class="w3-cell-row">
    <div class="w3-cell w3-container w3-mobile">
    <div><strong><?php echo Format::htmlchars($errors['login']); ?></strong></div>
    <div>
        <label for="email"><?php echo __('Email Address'); ?>:
        <input id="email" placeholder="<?php echo __('e.g. john.doe@osticket.com'); ?>" type="text"
            name="lemail" size="30" value="<?php echo $email; ?>" class="nowarn w3-input"></label>
    </div>
    <div>
        <label for="ticketno"><?php echo __('Ticket Number'); ?>:
        <input id="ticketno" type="text" name="lticket" placeholder="<?php echo __('e.g. 051243'); ?>"
            size="30" value="<?php echo $ticketid; ?>" class="nowarn w3-input"></label>
    </div>
    <p>
        <input class="w3-btn w3-round w3-light-grey w3-hover-pale-green" type="submit" value="<?php echo $button; ?>">
    </p>
    </div>
    <div class="w3-cell w3-container w3-mobile">
<?php if ($cfg && $cfg->getClientRegistrationMode() !== 'disabled') { ?>
        <?php echo __('Have an account with us?'); ?>
        <a href="login.php"><?php echo __('Sign In'); ?></a> <?php
    if ($cfg->isClientRegistrationEnabled()) { ?>
<?php echo sprintf(__('or %s register for an account %s to access all your tickets.'),
    '<a href="account.php?do=create">','</a>');
    }
}?>
    </div>
</div>
</form>
<p>
<?php
if ($cfg->getClientRegistrationMode() != 'disabled'
    || !$cfg->isClientLoginRequired()) {
    echo sprintf(
    __("If this is your first time contacting us or you've lost the ticket number, please %s open a new ticket %s"),
        '<a href="open.php">','</a>');
} ?>
</p>
