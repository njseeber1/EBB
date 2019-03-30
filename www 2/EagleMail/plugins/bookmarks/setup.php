<?php

function squirrelmail_plugin_init_bookmarks() {
    global $squirrelmail_plugin_hooks;
    $squirrelmail_plugin_hooks['menuline']['bookmarks'] = 'bookmarks';
}

function bookmarks() {
    displayInternalLink('plugins/bookmarks/bookmarks.php',_("<div id='bookmark_button'><p class='button_text'>"._("Bookmarks")."</p></div>"),'right');
    echo "&nbsp;&nbsp\n";
}

?>
