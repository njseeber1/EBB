<?php

/**
 * Language.class.php
 *
 * Copyright (c) 2003-2004 The SquirrelMail Project Team
 * Licensed under the GNU GPL. For full terms see the file COPYING.
 *
 * This contains functions needed to handle mime messages.
 *
 * $Id: Language.class.php,v 1.2.2.1 2004/02/24 15:57:13 kink Exp $
 */

class Language {
    function Language($name) {
       $this->name = $name;
       $this->properties = array();
    }
}

?>
