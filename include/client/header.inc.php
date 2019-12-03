<?php
$title=($cfg && is_object($cfg) && $cfg->getTitle())
    ? $cfg->getTitle() : 'PrayerTicketSystem :: '.__('Prayer Ticket System');
$signin_url = ROOT_PATH . "login.php"
    . ($thisclient ? "?e=".urlencode($thisclient->getEmail()) : "");
$signout_url = ROOT_PATH . "logout.php?auth=".$ost->getLinkToken();

header("Content-Type: text/html; charset=UTF-8");
header("Content-Security-Policy: frame-ancestors ".$cfg->getAllowIframes().";");
if (($lang = Internationalization::getCurrentLanguage())) {
    $langs = array_unique(array($lang, $cfg->getPrimaryLanguage()));
    $langs = Internationalization::rfc1766($langs);
    header("Content-Language: ".implode(', ', $langs));
}
?>
<!DOCTYPE html>
<html<?php
if ($lang
        && ($info = Internationalization::getLanguageInfo($lang))
        && (@$info['direction'] == 'rtl'))
    echo ' dir="rtl" class="rtl"';
if ($lang) {
    echo ' lang="' . $lang . '"';
}
?>>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?php echo Format::htmlchars($title); ?></title>
    <meta name="description" content="prayer ticket system">
    <meta name="keywords" content="PrayerTicketSystem, Prayer support system, prayer ticket system, intercession">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="<?php echo ROOT_PATH; ?>css/osticket.css?035fd0a" media="screen"/>
    <link rel="stylesheet" href="<?php echo ASSETS_PATH; ?>css/theme.css?035fd0a" media="screen"/>
    <link rel="stylesheet" href="<?php echo ASSETS_PATH; ?>css/print.css?035fd0a" media="print"/>
    <link rel="stylesheet" href="<?php echo ROOT_PATH; ?>scp/css/typeahead.css?035fd0a"
         media="screen" />
    <link type="text/css" href="<?php echo ROOT_PATH; ?>css/ui-lightness/jquery-ui-1.10.3.custom.min.css?035fd0a"
        rel="stylesheet" media="screen" />
    <link rel="stylesheet" href="<?php echo ROOT_PATH; ?>css/thread.css" media="screen">
    <link rel="stylesheet" href="<?php echo ROOT_PATH; ?>css/redactor.css" media="screen">
    <link type="text/css" rel="stylesheet" href="<?php echo ROOT_PATH; ?>css/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="<?php echo ROOT_PATH; ?>css/flags.css">
    <link type="text/css" rel="stylesheet" href="<?php echo ROOT_PATH; ?>css/rtl.css"/>
    <link type="text/css" rel="stylesheet" href="<?php echo ROOT_PATH; ?>css/select2.min.css">
    <script type="text/javascript" src="<?php echo ROOT_PATH; ?>js/jquery-3.4.0.min.js"></script>
    <script type="text/javascript" src="<?php echo ROOT_PATH; ?>js/jquery-ui-1.12.1.custom.min.js"></script>
    <script src="<?php echo ROOT_PATH; ?>js/osticket.js"></script>
    <script type="text/javascript" src="<?php echo ROOT_PATH; ?>js/filedrop.field.js"></script>
    <script src="<?php echo ROOT_PATH; ?>scp/js/bootstrap-typeahead.js"></script>
    <script type="text/javascript" src="<?php echo ROOT_PATH; ?>js/redactor.min.js"></script>
    <script type="text/javascript" src="<?php echo ROOT_PATH; ?>js/redactor-plugins.js"></script>
    <script type="text/javascript" src="<?php echo ROOT_PATH; ?>js/redactor-osticket.js"></script>
    <script type="text/javascript" src="<?php echo ROOT_PATH; ?>js/select2.min.js"></script>
    <script type="text/javascript" src="<?php echo ROOT_PATH; ?>js/fabric.min.js"></script>
    <?php
    if($ost && ($headers=$ost->getExtraHeaders())) {
        echo "\n\t".implode("\n\t", $headers)."\n";
    }

    // Offer alternate links for search engines
    // @see https://support.google.com/webmasters/answer/189077?hl=en
    if (($all_langs = Internationalization::getConfiguredSystemLanguages())
        && (count($all_langs) > 1)
    ) {
        $langs = Internationalization::rfc1766(array_keys($all_langs));
        $qs = array();
        parse_str($_SERVER['QUERY_STRING'], $qs);
        foreach ($langs as $L) {
            $qs['lang'] = $L; ?>
        <link rel="alternate" href="//<?php echo $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>?<?php
            echo http_build_query($qs); ?>" hreflang="<?php echo $L; ?>" />
<?php
        } ?>
        <link rel="alternate" href="//<?php echo $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>"
            hreflang="x-default" />
        <style>
            .w3-myfont {
                font-family: 'Verdana', bold, sans-serif;
            }
        </style>
<?php
    }
    ?>
    
</head>
<body>
    <div id="container" class="w3-auto w3-round-large w3-padding-large">
        <div class="w3-row">
            <div class="w3-twothird">
                <div class="w3-row">
                    <div class="w3-col" style="width:55px;">
                        <button class="w3-button w3-xlarge" onclick="w3_open()">☰</button>
                        <script>
                            function w3_open() {
                            document.getElementById("pcSidebar").style.display = "block";
                            }
                            function w3_close() {
                            document.getElementById("pcSidebar").style.display = "none";
                            }
                        </script>
                    </div>
                    <div class="w3-rest w3-hide-small">
                            <a href="<?php echo ROOT_PATH; ?>index.php"title="<?php echo __('Support Center'); ?>">
                        <img src="<?php echo ROOT_PATH; ?>logo.php" border=0 alt="<?php echo $ost->getConfig()->getTitle(); ?>" style="max-width:380px;width:100%;" class="w3-image">
                        </a>
                    </div>
                    <div class="w3-rest w3-hide-medium w3-hide-large" style="padding-top:10px;padding-bottom:4px">
                        <a href="<?php echo ROOT_PATH; ?>index.php"title="<?php echo __('Support Center'); ?>">
                        <img src="<?php echo ROOT_PATH; ?>logo.php" border=0 alt="<?php echo $ost->getConfig()->getTitle(); ?>" style="max-width:380px;width:100%;" class="w3-image">
                        </a>
                    </div>
                    <!--
                    <div class="w3-rest w3-hide-medium w3-hide-large" style="margin-top:7px;">
                        <span class="w3-myfont w3-xlarge">PrayerClinic.net</span>
                    </div>-->
                </div>
            </div>
            <div class="w3-third" style="height:0px;"></div>
        </div>
        <!--<div class="clear"></div>-->
        <?php
        if($nav){ ?>
        <div class="w3-sidebar w3-bar-block w3-border-right w3-animate-opacity" style="display:none; padding-right:16px; padding-top:16px;" id="pcSidebar">
            <button onclick="w3_close()" class="w3-bar-item w3-light-grey w3-hover-grey w3-margin-bottom">Close &times;</button>
            <?php
            if($nav && ($navs=$nav->getNavLinks()) && is_array($navs)){
                foreach($navs as $name =>$nav) {
                    echo sprintf('<a class="%s %s w3-mobile w3-bar-item w3-btn w3-round w3-pale-blue w3-hover-pale-green w3-margin-bottom" href="%s">%s</a>%s',$nav['active']?'active':'',$name,(ROOT_PATH.$nav['href']),$nav['desc'],"\n");
                }
            } ?>
            
                        <div>
             <?php
                if ($thisclient && is_object($thisclient) && $thisclient->isValid()
                    && !$thisclient->isGuest()) {
                 echo Format::htmlchars($thisclient->getName()).'&nbsp;|';
                 ?>
                <a href="<?php echo ROOT_PATH; ?>profile.php"><?php echo __('Profile'); ?></a> |
                <a href="<?php echo ROOT_PATH; ?>tickets.php"><?php echo sprintf(__('Tickets <b>(%d)</b>'), $thisclient->getNumTickets()); ?></a> -
                <a href="<?php echo $signout_url; ?>"><?php echo __('Sign Out'); ?></a>
            <?php
            } elseif($nav) {
                if ($thisclient && $thisclient->isValid() && $thisclient->isGuest()) { ?>
                    <a href="<?php echo $signout_url; ?>" class="w3-mobile w3-bar-item w3-btn w3-round w3-pale-blue w3-hover-pale-green w3-margin-bottom"><?php echo __('Sign Out'); ?></a><?php
                }
                elseif ($cfg->getClientRegistrationMode() != 'disabled') { ?>
                    <a href="<?php echo $signin_url; ?>" class="w3-mobile w3-bar-item w3-btn w3-round w3-pale-blue w3-hover-pale-green w3-margin-bottom"><?php echo __('Sign In'); ?></a>
            <?php
                }
            } ?>
            </div>
            <div class="w3-mobile w3-bar-item w3-round">
            <?php
            if (($all_langs = Internationalization::getConfiguredSystemLanguages())
                && (count($all_langs) > 1)) {
                $qs = array();
                parse_str($_SERVER['QUERY_STRING'], $qs);
                foreach ($all_langs as $code=>$info) {
                    list($lang, $locale) = explode('_', $code);
                    $qs['lang'] = $code;
                    ?>
                    <a class="flag flag-<?php echo strtolower($locale ?: $info['flag'] ?: $lang); ?> " style="-ms-transform:scale(1.8,1.8); -webkit-transform:scale(1.8,1.8); transform:scale(1.8,1.8)" 
                    href="?<?php echo http_build_query($qs);
                    ?>" title="<?php echo Internationalization::getLanguageDescription($code); ?>">&nbsp;</a>&nbsp;&nbsp;&nbsp;
                <?php }
                } ?>
            </div>
            
        
        </div>
        
        <?php
        }else{ ?>
        <hr/>
        <?php
        } ?>
        <div class="w3-auto">

         <?php if($errors['err']) { ?>
            <div class="w3-panel w3-pale-red w3-container w3-padding-small w3-border"><?php echo $errors['err']; ?></div>
         <?php }elseif($msg) { ?>
            <div class="w3-panel w3-pale-green w3-container w3-padding-small w3-border"><?php echo $msg; ?></div>
         <?php }elseif($warn) { ?>
            <div class="w3-panel w3-pale-yellow w3-container w3-padding-small w3-border"><?php echo $warn; ?></div>
         <?php } ?>
