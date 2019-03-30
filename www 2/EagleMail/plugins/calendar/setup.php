<?php

/**
 * setup.php
 *
 * Copyright (c) 2002-2004 The SquirrelMail Project Team
 * Licensed under the GNU GPL. For full terms see the file COPYING.
 *
 * Originally contrubuted by Michal Szczotka <michal@tuxy.org>
 *
 * init plugin into squirrelmail
 *
 * $Id: setup.php,v 1.5.2.1 2004/02/24 15:57:30 kink Exp $ 
 */

function squirrelmail_plugin_init_calendar() {
    global $squirrelmail_plugin_hooks;
    $squirrelmail_plugin_hooks['menuline']['calendar'] = 'calendar';
}

function calendar() {
    /* Add Calendar link to upper menu */
    displayInternalLink('plugins/calendar/calendar.php',_("<div id='calendar_button'><p class='button_text'>"._("Calendar")."</p></div>"),'right');
  //  echo "<img src=\"../images/divider.png\" border=\"0\" align=\"absmiddle\">\n";
}

?>
