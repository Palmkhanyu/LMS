<?php

/**
 * Configuration for learningx theme.
 *
 * DO NOT MODIFY THIS THEME!
 * COPY IT FIRST, THEN RENAME THE COPY AND MODIFY IT INSTEAD.
 *
 * For full information about creating Moodle themes, see:
 * http://docs.moodle.org/dev/Themes_2.0
 *
 * @package   theme_learningx
 * @authors   Komkrit Aree
 * @license   http://www.knmedia.co.th
 */

$THEME->name = 'learningx';
$THEME->doctype = 'html5';
$THEME->parents = array('bootstrapbase');
//$THEME->sheets = array('custom', 'blockicons', 'profilebar', 'font-awesome.min', 'settings','easyslider');
$THEME->sheets = array('custom', 'blockicons', 'profilebar', 'font-awesome.min', 'settings');

$THEME->yuicssmodules = array();
$THEME->supportscssoptimisation = false;
$THEME->editor_sheets = array('editor', 'easyslider');
//$THEME->javascripts_footer = array('jquery','easyslider','enableslider');
$THEME->rendererfactory = 'theme_overridden_renderer_factory';

$THEME->layouts = array(

    // Most backwards compatible layout without the blocks - this is the layout used by default.
    'base' => array(
        'file' => 'columns1.php',
        'regions' => array(),
    ),

    'admin_report' => array(
        'file' => 'columns1.php',
        'regions' => array(),
    ),


'trainingrecord' => array(
        'file' => 'columns1.php',
        'regions' => array(),
    ),


    'reports' => array(
        'file' => 'columns1.php',
        'regions' => array(),
    ),


    'contact' => array(
        'file' => 'columns1.php',
        'regions' => array(),
    ),

    'profile' => array(
        'file' => 'columns1.php',
        'regions' => array(),
    ),
    'myidp' => array(
        'file' => 'columns1.php',
        'regions' => array(),
    ),
    'assessment_userreport' => array(
        'file' => 'columns1.php',
        'regions' => array(),
    ),
    'myprofile' => array(
        'file' => 'columns1.php',
        'regions' => array(),
    ),
    'mybadges' => array(
        'file' => 'columns1.php',
        'regions' => array(),
    ),

    'import_banner' => array(
        'file' => 'columns1.php',
        'regions' => array(),
    ),

    'coursereport' => array(
        'file' => 'columns1.php',
        'regions' => array(),
    ),

    'import_training' => array(
        'file' => 'columns1.php',
        'regions' => array(),
    ),
    'manage_peer' => array(
        'file' => 'columns1.php',
        'regions' => array(),
    ),

    'update_user' => array(
        'file' => 'columns1.php',
        'regions' => array(),
    ),
    'badgereport' => array(
        'file' => 'columns1.php',
        'regions' => array(),
    ),

    'add_user' => array(
        'file' => 'columns1.php',
        'regions' => array(),
    ),


    // Standard layout with blocks, this is recommended for most pages with general information.
    'standard' => array(
        'file' => 'columns3.php',
        'regions' => array('side-pre', 'side-post'),
        'defaultregion' => 'side-pre',
    ),

    // Main course page. // หน้าแสดงโครงสร้างหลักสูตรก่อนคลิก
    'course' => array(

        'file' => 'viewcourse.php',
        'regions' => array('side-pre', 'side-post'),
        'defaultregion' => 'side-pre',
        'options' => array('langmenu' => true),

    ),

    'coursecategory' => array(
        /*
        'file' => 'columns3.php',
        'regions' => array('side-pre', 'side-post'),
        'defaultregion' => 'side-pre',
        */

        'file' => 'columns1.php',
        'regions' => array(),
    ),

    // view scorm ////part of course, typical for modules - default page layout if $cm specified in require_login().
    'incourse' => array(
        'file' => 'incourse.php',

        'regions' => array('side-pre', 'side-post'),
        'defaultregion' => 'side-pre',

    ),

    'forum' => array(
        'file' => 'forum.php',

        'regions' => array('side-pre', 'side-post'),
        'defaultregion' => 'side-pre',

    ),

    // The site home page.
    /*
    'frontpage' => array(
        //  'file' => 'columns2.php',
        'file' => 'frontpage.php',
        //'regions' => array('side-pre', 'side-post','center-post'),
        'regions' => array('side-pre', 'side-post'),
        //   'defaultregion' => 'side-pre',
        'defaultregion' => 'side-pre',
        'options' => array('nonavbar' => true),
    ),
    */

    'frontpage' => array(
        'file' => 'frontpage_new.php',
        'regions' => array('side-pre', 'side-post'),
        'defaultregion' => 'side-pre',
    ),

    // Server administration scripts.
    'admin' => array(
        'file' => 'admin.php',
        'regions' => array('side-pre'),
        'defaultregion' => 'side-pre',
    ),

    // My dashboard page.
    'mydashboard' => array(
        'file' => 'home.php',
        // แก้ dashboard
        //'regions' => array('side-post'),
        //'defaultregion' => 'content',

        // original
          'regions' => array('side-pre', 'side-post'),
         'defaultregion' => 'side-pre',


    ),

    // My dashboard page.
    'mybadges' => array(
        'file' => 'columns1.php',

        'regions' => array('side-pre', 'side-post'),
        'defaultregion' => 'side-pre',


    ),

    // Assessment page.
    'assessment' => array(
        'file' => 'columns1.php',
        'regions' => array()
    ),
    'assessment_report' => array(
        'file' => 'columns1.php',
        'regions' => array()
    ),

    // My Course page.
    'mycourse' => array(
        'file' => 'columns1.php',
        'regions' => array()
    ),

    'course1' => array(
        'file' => 'columns1.php',
        'regions' => array()
    ),
    'course2' => array(
        'file' => 'columns1.php',
        'regions' => array()
    ),
    'course3' => array(
        'file' => 'columns1.php',
        'regions' => array()
    ),
    'course4' => array(
        'file' => 'columns1.php',
        'regions' => array()
    ),
    'course5' => array(
        'file' => 'columns1.php',
        'regions' => array()
    ),

    'synccompu' => array(
        'file' => 'columns1.php',
        'regions' => array()
    ),

    'coursereport' => array(
        'file' => 'columns1.php',
        'regions' => array()
    ),

    // All Courses page.
    'allcourse' => array(
        'file' => 'columns1.php',
        'regions' => array()
    ),

    // Media Courses page.
    'mediacourse' => array(
        'file' => 'columns1.php',
        'regions' => array()
    ),

    'podcast' => array(
        'file' => 'columns1.php',
        'regions' => array()
    ),

    'ebook' => array(
        'file' => 'columns1.php',
        'regions' => array()
    ),

    'vdo' => array(
        'file' => 'columns1.php',
        'regions' => array()
    ),

    'thp' => array(
        'file' => 'columns1.php',
        'regions' => array()
    ),

    'search' => array(
        'file' => 'columns1.php',
        'regions' => array()
    ),
    'searchcourse' => array(
        'file' => 'columns1.php',
        'regions' => array()
    ),




    // In-house Courses page.
    'training' => array(
        'file' => 'columns1.php',
        'regions' => array()
    ),


    /*
    'mycourse' => array(
        'file' => 'home.php',
        // แก้ dashboard
        // 'regions' => array('side-post'),
       //  'defaultregion' => 'content',
        'regions' => array('side-pre', 'side-post'),
        'defaultregion' => 'side-pre',

 
    ),
*/

    // My public page.
    'mypublic' => array(
        'file' => 'columns3.php',
        'regions' => array('side-pre', 'side-post'),
        'defaultregion' => 'side-pre',
    ),

    // Pages that appear in pop-up windows - no navigation, no blocks, no header.
    'popup' => array(
        'file' => 'popup.php',
        'regions' => array(),
        'options' => array('nofooter' => true, 'nonavbar' => true),
    ),
    // No blocks and minimal footer - used for legacy frame layouts only!
    'frametop' => array(
        'file' => 'columns1.php',
        'regions' => array(),
        'options' => array('nofooter' => true, 'nocoursefooter' => true),
    ),
    // Embeded pages, like iframe/object embeded in moodleform - it needs as much space as possible.
    'embedded' => array(
        'file' => 'embedded.php',
        'regions' => array()
    ),
    // Used during upgrade and install, and for the 'This site is undergoing maintenance' message.
    // This must not have any blocks, links, or API calls that would lead to database or cache interaction.
    // Please be extremely careful if you are modifying this layout.
    'maintenance' => array(
        'file' => 'maintenance.php',
        'regions' => array(),
    ),
    // Should display the content and basic headers only.
    'print' => array(
        'file' => 'columns3.php',
        'regions' => array(),
        'options' => array('nofooter' => true, 'nonavbar' => false),
    ),
    // The pagelayout used when a redirection is occuring.
    'redirect' => array(
        'file' => 'embedded.php',
        'regions' => array(),
    ),


    // The pagelayout used for reports.
    'report' => array(
        'file' => 'grade_report.php',
        'regions' => array('side-pre'),
        'defaultregion' => 'side-pre',
    ),


    // The pagelayout used for safebrowser and securewindow.
    'secure' => array(
        'file' => 'secure.php',
        'regions' => array('side-pre', 'side-post'),
        'defaultregion' => 'side-pre'
    ),
    // idreamba edit login page
    'login' => array(
        'file' => 'login.php',
        'regions' => array(),
        'options' => array('langmenu' => true),
    ),

    'learn' => array(
        'file' => 'columns1.php',
        'regions' => array()
    ),

    'plearn1' => array(
        'file' => 'columns1.php',
        'regions' => array()
    ),

    'plearn2' => array(
        'file' => 'columns1.php',
        'regions' => array()
    ),

    'plearn3' => array(
        'file' => 'columns1.php',
        'regions' => array()
    ),
    
    'searchcourse' => array(
        'file' => 'columns1.php',
        'regions' => array()
    ),
    'upload_doc' => array(
        'file' => 'columns1.php',
        'regions' => array()
    ),
    'mapping_doc' => array(
        'file' => 'columns1.php',
        'regions' => array()
    ),
);


$THEME->csspostprocess = 'learningx_process_css';
