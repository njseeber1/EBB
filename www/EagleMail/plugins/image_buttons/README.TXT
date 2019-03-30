Image Buttons plugin -- Version 1.3 (copyleft Brad Donison 2003, GPL v2)

This is a plugin for SquirrelMail 1.4 and higher to optionally
display graphic images on the top menu bar instead of plain text.


Requirements
============
* SquirrelMail 1.4.x
* The compatibility plugin

(this plugin MAY also work with a patched version of SquirrelMail 1.2.x)


Features
========
* Creates button images according to user's colour prefs
* Can use site wide image files for menu bar icons
* Optionally adds text beside images
* Text and Text Buttons can be resized according to user prefs
* Site wide prefs can override user prefs
* Has tooltips for browsers that can handle them


Future Work
===========
* Adding a scheme to select images according to the user's theme
* Add icon for the SM attributions (if visible)
* How about 3-D Buttons
* User selectable icon themes???
* Include png icons
* Dump reliance on older GD for Text Buttons (or drop the Buttons)
* Add the translation code
* Any other ideas???


Installation
============
1) As with other plugins, uncompress the archive in the plugins directory.


2) Copy config.php.sample to config.php and edit global prefs therein.
   Place any customer incom images within the images directory and change
   the config file accordingly. The config file has comments on how to
   modify it.


3a)If you are running SM version 1.4.2 then:
   Edit the page_header.php file that is in the functions directory of
   the squirremlail installation, i.e. /path/to/squirrelmail/functions.
   A hook that exists in the 1.5 versions of SquirrelMail needs to be
   added to the 1.4.x version. Around line number 75 you will see the
   following function defined in SM version 1.4.2:
*** BEFORE ***

function makeInternalLink($path, $text, $target='') {
    sqgetGlobalVar('base_uri', $base_uri, SQ_SESSION);
    if ($target != '') {
        $target = " target=\"$target\"";
    }
    return '<a href="'.$base_uri.$path.'"'.$target.'>'.$text.'</a>';
}

  A few lines of code need to be inserted before the call to return. Add
  the lines of code so that the function looks like this:
*** AFTER ***

function makeInternalLink($path, $text, $target='') {
    sqgetGlobalVar('base_uri', $base_uri, SQ_SESSION);
    if ($target != '') {
        $target = " target=\"$target\"";
    }
    $tpinfo = array();
    $tpinfo[0] = $text;
    $tpinfo[1] = $path;
    $hooktext = do_hook_function('internal_link', $tpinfo);
    if ($hooktext != '')
       $text = $hooktext;
    return '<a href="'.$base_uri.$path.'"'.$target.'>'.$text.'</a>';
}


3b)If you are running SM version 1.4.1 or less then:
   Edit the page_header.php file that is in the functions directory of
   the squirremlail installation, i.e. /path/to/squirrelmail/functions.
   A hook that exists in the 1.5 versions of SquirrelMail needs to be
   added to the 1.4.x version. Around line number 75 you will see the
   following function defined in SM version 1.4.1:
*** BEFORE ***

function displayInternalLink($path, $text, $target='') {
    sqgetGlobalVar('base_uri', $base_uri, SQ_SESSION);
    if ($target != '') {
        $target = " target=\"$target\"";
    }
    echo '<a href="'.$base_uri.$path.'"'.$target.'>'.$text.'</a>';
}

  A few lines of code need to be inserted before the call to return. Add
  the lines of code so that the function looks like this:
*** AFTER ***

function displayInternalLink($path, $text, $target='') {
    sqgetGlobalVar('base_uri', $base_uri, SQ_SESSION);
    if ($target != '') {
        $target = " target=\"$target\"";
    }
    $tpinfo = array();
    $tpinfo[0] = $text;
    $tpinfo[1] = $path;
    $hooktext = do_hook_function('internal_link', $tpinfo);
    if ($hooktext != '')
       $text = $hooktext;
    echo '<a href="'.$base_uri.$path.'"'.$target.'>'.$text.'</a>';
}


4a)If you are running SM version 1.4.2 then:
   Edit the strings.php file that is in the functions directory of
   the squirremlail installation, i.e. /path/to/squirrelmail/functions.
   A hook that exists in the 1.5 versions of SquirrelMail needs to be
   added to the 1.4.x version. Around line number 450 you will see the
   following function defined in SM version 1.4.2:
*** BEFORE***

function makeComposeLink($url, $text = null)
{
    global $compose_new_win,$javascript_on;

    if(!$text) {
        $text = _("Compose");
    }

    if($compose_new_win != '1') {
        return makeInternalLink($url, $text, 'right');
    }

    /* if we can use JS, use the fancy window, else just open a new one HTML-style */
    if($javascript_on) {
        sqgetGlobalVar('base_uri', $base_uri, SQ_SESSION);
        return '<a href="javascript:void(0)" onclick="comp_in_new(\''.$base_uri.$url.'\')">'. $text.'</a>';
    }

    return makeInternalLink($url, $text, '_blank');
}

  A few lines of code need to be inserted before the call to return. Add
  the lines of code so that the function looks like this:
*** AFTER ***

function makeComposeLink($url, $text = null)
{
    global $compose_new_win,$javascript_on;

    if(!$text) {
        $text = _("Compose");
    }

    if($compose_new_win != '1') {
        return makeInternalLink($url, $text, 'right');
    }

    /* if we can use JS, use the fancy window, else just open a new one HTML-style */
    if($javascript_on) {
        sqgetGlobalVar('base_uri', $base_uri, SQ_SESSION);
        $tpinfo = array();
        $tpinfo[0] = $text;
        $tpinfo[1] = $base_uri.$url;
        $hooktext = do_hook_function('internal_link', $tpinfo);
        if ($hooktext != '')
            $text = $hooktext;
        return '<a href="javascript:void(0)" onclick="comp_in_new(\''.$base_uri.$url.'\')">'. $text.'</a>';
    }

    return makeInternalLink($url, $text, '_blank');
}


4b)If you are running SM version 1.4.1 or less then:
   Edit the page_header.php file that is in the functions directory of
   the squirremlail installation, i.e. /path/to/squirrelmail/functions.
   A hook that exists in the 1.5 versions of SquirrelMail needs to be
   added to the 1.4.x version. Around line number 250 you will see the
   following code section in SM version 1.4.1:
*** BEFORE ***

    $urlMailbox = urlencode($mailbox);
    if ($compose_new_win == '1') {
        echo '<a href="javascript:void(0)" onclick="comp_in_new()">'. _("Compose").'</a>';
    }
    else {
        displayInternalLink ("src/compose.php?mailbox=$urlMailbox", _("Compose"), 'right');
    }
    echo "&nbsp;&nbsp;\n";
    displayInternalLink ('src/addressbook.php', _("Addresses"), 'right');

  A few lines of code need to be inserted before the call to echo. Add
  the lines of code so the code above looks like this:
*** AFTER ***

    $urlMailbox = urlencode($mailbox);
    if ($compose_new_win == '1') {
        $tpinfo = array();
        $tpinfo[0] = $text;
        $tpinfo[1] = "src/compose.php";
        $hooktext = do_hook_function('internal_link', $tpinfo);
        if ($hooktext != '')
            $text = $hooktext;
        echo '<a href="javascript:void(0)" onclick="comp_in_new()">'. _("Compose").'</a>';
    }
    else {
        displayInternalLink ("src/compose.php?mailbox=$urlMailbox", _("Compose"), 'right');
    }
    echo "&nbsp;&nbsp;\n";
    displayInternalLink ('src/addressbook.php', _("Addresses"), 'right');


4c)If you prefer diff files, then you may be happy to see the diff file
   included with this plugin. I provided a diff to apply against version 1.4.2
   of SquirrelMail, for other version you can edit the files by hand. Of course
   if you have version 1.4.2 AND you prefer diff files because you know what
   the patch command does, BUT you already follwed the steps above and applied
   the patch by hand, then I guess you're too late for the diff file;-)
   So if it's not too late then use the sm142.diff file to patch both the
   page_header.php and strings.php files which are probably located in the
   ../../functions/  directory.


5) Go back to the main SquirrelMail directory and run configure to
   enable the plugin.


NOTES: Feel free to contibute more icons for new menu items or different
       ones for existing menu items. If you have a patch for another
       version of SquirrelMail then feel free to offer that up as well,
       Thx... For the record I do not prefer plugins or features that
       require patches to the core code to add functionality. I prefer
       sticking with the core code, but as a hook was added to 1.5
       versions of SquirrelMail I thought that I would try to make use
       of it.


Credits
=======
Thx to those who have put time and effort into prior versions of this
plugin. Unfortunately I have no idea who created version 1.1 of image_buttons
or earlier versions. For the included graphic icons thx goes to Andy Morris
for some of the icons, Cool Archive and Icon Archive for others, and myself
for some. Thx also to those on the plugins list who suggested enhancements
and contributed diffs: John B., Tomas Kuliavas and Simon Bryan.

Questions/comments/etc can be sent to:
    Brad Donison <bucovina@users.sourceforge.net>

Flames can be sent to:
    Brad Donison </dev/null>


Changes
=======
1.3   - fixed folder index bug (cut and paste can be the enemy too;-)
      - made caching of Text Buttons a user preference
      - added "Default" for size of text
      - added tooltips
      - site prefs can now take precident over user prefs
      - added more contributed icons
      = (Brad Donison)

1.2   - made this into a real plugin using the defined hooks
      - uses the version API
      - users can select desired text size
      - real icons can be used along with text and/or generated buttons
      = (Brad Donison)

1.1   - version history unknown for this version and older ones
      = (original author unknown)

