<?php



//require_once($CFG->dirroot.'/config.php'); //'../user/profile/lib.php');

// ดึงชื่อ membercode
//require_once($CFG->dirroot . '/user/profile/lib.php'); //'../user/profile/lib.php');

// ให้โหลดข้อมูลเข้ามาเก็บใน $USER ซึ่งเป็นตัวแปรแบบ Global
//profile_load_data($USER);

global $CFG, $USER, $DB, $OUTPUT, $PAGE;

/* เช็ค error  */
// ini_set ('error_reporting', E_ALL);
// ini_set ('display_errors', '1');
// error_reporting (E_ALL|E_STRICT);

$lang_ = current_language();



$hasheading = ($PAGE->heading);
$hasnavbar = (empty($PAGE->layout_options['nonavbar']) && $PAGE->has_navbar());
$hasfooter = (empty($PAGE->layout_options['nofooter']));
$hasheader = (empty($PAGE->layout_options['noheader']));

$hassidepre = (empty($PAGE->layout_options['noblocks']) && $PAGE->blocks->region_has_content('side-pre', $OUTPUT));
$hassidepost = (empty($PAGE->layout_options['noblocks']) && $PAGE->blocks->region_has_content('side-post', $OUTPUT));

$showsidepre = ($hassidepre && !$PAGE->blocks->region_completely_docked('side-pre', $OUTPUT));
$showsidepost = ($hassidepost && !$PAGE->blocks->region_completely_docked('side-post', $OUTPUT));

$isfrontpage = $PAGE->bodyid == "page-site-index";
$iscoursepage = $PAGE->pagelayout == "course";

$haslogo = (!empty($PAGE->theme->settings->logo));
$hasshortname = (!empty($PAGE->theme->settings->shortname));
$hasgeneralalert = (!empty($PAGE->theme->settings->generalalert));

$custommenu = $OUTPUT->custom_menu();
$hascustommenu = (empty($PAGE->layout_options['nocustommenu']) && !empty($custommenu));


//$picturequery = $DB->get_record_select('user', 'id = ?', array($USER->id));
//echo $USER->id;
//$mypicture = $OUTPUT->user_picture($picturequery); //,array('size' => 65)); 


?>

<style>

  .bell {
    display: inline-block;
    position: relative;
    padding: 10px 10px;
    font-size: 16px;
  }

  .notification_ {

    /* circle shape, size and position */
    position: absolute;
    top: -0.7em;
    margin-left: 5px;
    min-width: 1.6em;
    /* or width, explained below. */
    height: 1.6em;
    border-radius: 0.8em;
    /* or 50%, explained below. */
    border: 0.05em solid white;
    background-color: red;

    /* number size and position */
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 12px;
    color: white;
  }

  .notification_side {
    position: absolute;
    top: 1.3em;
    margin-left: 19px;
    min-width: 1.6em;
    height: 1.6em;
    border-radius: 0.8em;
    border: 0.05em solid white;
    background-color: red;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 12px;
    color: white;
  }

  * {
    box-sizing: border-box;
  }

  .topnav {
    /*width:1150px;*/
    width: 100%;
    overflow: hidden;
    /*  background-color: #e9e9e9; */

    background-color: #162039;

    border-top-left-radius: 5px;
    border-top-right-radius: 5px;
    border-bottom-left-radius: 5px;
    border-bottom-right-radius: 5px;

    /* background: rgba(237, 34, 247, 1);
    background: -moz-linear-gradient(top, rgba(247, 247, 247, 1) 0%, rgba(255, 255, 255, 1) 9%, rgba(246, 246, 246, 1) 35%, rgba(218, 224, 226, 1) 100%);
    background: -webkit-gradient(left top, left bottom, color-stop(0%, rgba(247, 247, 247, 1)), color-stop(9%, rgba(255, 255, 255, 1)), color-stop(35%, rgba(246, 246, 246, 1)), color-stop(100%, rgba(218, 224, 226, 1)));
    background: -webkit-linear-gradient(top, rgba(247, 247, 247, 1) 0%, rgba(255, 255, 255, 1) 9%, rgba(246, 246, 246, 1) 35%, rgba(218, 224, 226, 1) 100%);
    background: -o-linear-gradient(top, rgba(247, 247, 247, 1) 0%, rgba(255, 255, 255, 1) 9%, rgba(246, 246, 246, 1) 35%, rgba(218, 224, 226, 1) 100%);
    background: -ms-linear-gradient(top, rgba(247, 247, 247, 1) 0%, rgba(255, 255, 255, 1) 9%, rgba(246, 246, 246, 1) 35%, rgba(218, 224, 226, 1) 100%);


    background: linear-gradient(to bottom, #ed2225 0%, #ed2225 9%, #ed2225 35%, #ed2225 100%); */

    /*
background: linear-gradient(to bottom, rgba(247,247,247,1) 0%, rgba(255,255,255,1) 9%, rgba(246,246,246,1) 35%, rgba(218,224,226,1) 100%);
*/

    /* filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#f7f7f7', endColorstr='#dae0e2', GradientType=0); */
  }

  .topnav a {
    float: left;
    display: block;
    color: black;
    text-align: center;
    padding: 50px 16px;
    text-decoration: none;
    font-size: 17px;

    text-shadow: 0px 1px 5px #3d3d3d;

    border-right: solid 1px #ffedad;
    /*line-height: 10px;*/


  }

  /* ปุ่มลูกศรลง */
  .down {
    color: #fff;
    position: absolute;
    float: right;
    margin-left: 50px;
    margin-top: -21px;
  }

  .topnav ul ul li li>a {
    color: #fff;
  }

  /* เมนูย่อย */
  .topnav ul ul {
    display: none;
    position: fixed;

    list-style: none;
    float: left;
    margin-left: 0px;


  }

  .topnav ul li:hover>ul {
    display: block;
    text-decoration: none;
    text-shadow: none;
    list-style: none;
  }

  .topnav ul ul li>a {
    margin-left: 0px;
    padding: 10px;
    border: none;
    text-shadow: none;
    float: left;
    border-bottom: 1px solid white;
    /* line-height: 20px; */
    width: 100%;
    /* display: block; */
    background: #dcdcdc;
    height: 40px;
    text-align: left;
    font-size: 17px;

  }

  .topnav a:hover {
    background-color: #898b8d;
    color: black;

  }



  .topnav a.active {
    background-color: #fbab38;
    color: #fffbbc;

  }

  .topnav .search-container {
    float: right;
  }

  .topnav input[type=text] {
    padding: 6px;
    margin-top: 8px;
    font-size: 17px;
    border: none;
    background-color: #c2a251;
    color: white;
  }

  .topnav .search-container button {
    float: right;
    padding: 6px 10px;
    margin-top: 8px;
    margin-right: 16px;
    background: #c2a251;
    font-size: 17px;
    border: none;
    cursor: pointer;
  }

  .topnav .search-container button:hover {
    background: #c2a251;
  }

  @media screen and (max-width: 600px) {
    .topnav .search-container {
      float: none;
    }

    .topnav a,
    .topnav input[type=text],
    .topnav .search-container button {
      float: none;
      display: block;
      text-align: left;
      width: 100%;
      margin: 0;
      padding: 14px;
      color: white;

    }

    .topnav input[type=text] {
      border: 1px solid #3d3d3d;
    }



  }


  .forumsearch {
    /* float: right; */
    /*margin-top: 80px;*/
    display: none;
  }


  @media (max-width: 480px) {
    .path-mod-forum .forumheaderlist .picture {
      display: block;
      width: 20%;
    }

    .path-mod-forum .forumheaderlist thead .header.lastpost {
      display: none;
    }

    td.lastpost {
      display: none;
    }

  }

  .btn-disabled {
    color: #8c8c8c;
    float: none;
    text-decoration: none;
    text-shadow: none;
    padding: 15px 35px;
    font-size: 1.2em;
    font-weight: normal;

    border-right: solid 1px #e6e6e6;
  }

  .topnav .search-container {
    float: right;

  }

  .topnav .search-container button {
    float: right;
    padding: 6px 10px;
    margin-top: 8px;
    background: #bd0106;
    font-size: 17px;
    border: none;
    cursor: pointer;
    display: none;

  }

  .topnav input[type=text] {
    padding: 6px;
    margin-top: 8px;
    font-size: 17px;
    border: none;
    background-color: #bd0106;
    color: #fff;
  }
</style>
 <script src='<?php echo "$CFG->wwwroot/theme/" ?>learningx/javascript/jquery-3.7.1.min.js'></script>
<!-- <script src='<?php echo "$CFG->wwwroot/theme/" ?>learningx/javascript/jquery.min.js'></script> -->
<!-- <script src='<?php echo "$CFG->wwwroot/theme/" ?>learningx/layout/slider/js/jquery-1.11.3.min.js'></script> -->
<script src='<?php echo "$CFG->wwwroot/theme/" ?>learningx/layout/slider/js/hammer.js'></script>
<link href='<?php echo "$CFG->wwwroot/theme/" ?>learningx/style/responsive.css' rel="stylesheet">
<link href='<?php echo "$CFG->wwwroot/theme/" ?>learningx/layout/slider/js/fontawesome/css/all.css' rel="stylesheet"> 

<!-- <link href='<?php echo "$CFG->wwwroot/" ?>admin/kn-report/banner/js/bootstrap.min.css' rel="stylesheet"> -->
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"> -->

<!-- <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script> -->

<!--
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
-->

<header role="banner" class="navbar navbar-fixed-top">

  <nav role="navigation" class="navbar-inner">
    <div class="container-fluid">

      <?php

      //echo $PAGE->pagelayout;
      // echo $USER->profile['level'];
      //print_r($USER);
      // echo $USER->profile['extrasex'] . " | " . $USER->profile['membercode'] . " | " . $USER->profile['extralevel'] . " | " . $USER->profile['extraposition'];
      //echo '<hr/>';
      //print_r($USER);
      
      // $context = get_context_instance(CONTEXT_SYSTEM);
      // $roles = get_user_roles($context, $USER->id, false);
      // $role = key($roles);
      // //$roleid = $roles[$role]->roleid;
      // $rolename = $roles[$role]->shortname;
      
      // echo $rolename; // admincoursereport
      // //var_dump($roles);
      
      // hide menu for forgot password
      if ($PAGE->pagelayout == 'base') {

        ?>

        <style>
          .logout2 {
            display: none;
          }
        </style>

        <?php

      }

      //// end 
      

      if ($PAGE->pagelayout == 'login') {
        //echo $OUTPUT->user_menu();
      } else {
        ?>

        <div class="logo">
          <a href="<?php echo $CFG->wwwroot; ?>">

            <?php if ($haslogo) {
              echo html_writer::empty_tag('img', array('src' => $PAGE->theme->settings->logo, 'class' => 'logo'));
            } else {
            } ?></a>

        </div>

        <div class="logout2" align="right">
          <!-- <div> -->
          <table border="0">
            <tr>
              <td>
                <!-- <a href="#" class="dropdown-toggle" data-toggle="dropdown"> -->
                <!-- <span class="label label-pill label-danger count" style="border-radius:10px;"></span> -->

                <?php
                echo '<a href=' . $CFG->wwwroot . '/message' . '>';
                ?>
                <span><i class="fa fa-bell"></i>
                  <span id="notify"></span>
                </span>

                <!-- <button class="bell"><i class="fa fa-bell"></i>
                    <div class="notification" role="status"></div>
                  </button> -->

                <?php
                echo '</a>';
                ?>
                <!-- <span class="glyphicon glyphicon-bell" style="font-size:18px;"></span> -->
                </a>
                &nbsp;
              </td>
              <td width="30px"> <?= $OUTPUT->login_info(); ?> </td>
              <td> <?php echo $USER->firstname . ' ' . $USER->lastname; ?> </td>
              <!--               
              <td> <?php   //echo '<a href=' . $CFG->wwwroot . '/login/logout.php?sesskey=' . sesskey() . '><img src=' . $CFG->wwwroot . '/theme/learningway/logout3.png></a>' ;
                ?> </td> </tr>
              -->

              <td>
                <?php
                // เปลี่ยนภาษา Home  
                if ($lang_ == 'th') {
                  echo '&nbsp;&nbsp;&nbsp;<a href=' . $CFG->wwwroot . '/login/logout.php?sesskey=' . sesskey() . '><i class="fa fa-power-off"></i> ออกจากระบบ</a>';
                } else {
                  echo '&nbsp;&nbsp;&nbsp;<a href=' . $CFG->wwwroot . '/login/logout.php?sesskey=' . sesskey() . '><i class="fa fa-power-off"></i> Log out</a>';
                }
                ;
                //จบ เปลี่ยนภาษา 
              

                ?>
              </td>
            </tr>

            <tr>
              <td colspan="4">
                <table width="100%" border='0'>
                  <tr>

                    <td colspan="4" align="right">

                      <?php
                      // เปลี่ยนภาษา Home  
                      if ($lang_ == 'th') {
                        echo '<p style="font-size:14px;"> <a href=' . $CFG->wwwroot . '/course/search/' . '><i class="fa fa-search"></i> ค้นหาบทเรียน</a>&nbsp;&nbsp;</p>';
                      } else {
                        echo '<p style="font-size:14px;"> <a href=' . $CFG->wwwroot . '/course/search/' . '><i class="fa fa-search"></i> search courses</a>&nbsp;&nbsp;</p>';
                      }
                      ;
                      //จบ เปลี่ยนภาษา 
                    

                      ?>

                    </td>


                  </tr>
                </table>
              </td>
            </tr>
          </table>

          <script>
        //    $(DOCUMENT).READY(FUNCTION () {
//var $j = 	$.noConflict(); //add 20240920
        $(document).ready(function() { //edit 20240920
	
              i = 1;

              urls = '<?php echo $CFG->wwwroot . '/theme/learningx/layout/get_notify.php'; ?>';

              data = '<?= $USER->id; ?>'

              function load_notification(data) {
                $.ajax({
                  url: urls,
                  method: "POST",
                  dataType: "json",
                  data: {
                    data: data
                  },
                  success: function (data) {
                    if (data > 0) {
                      $('#notify').addClass("notification_");
                      $('#notify').html(data);
                      $('#notify_side').addClass("notification_side");
                      $('#notify_side').html(data);
                    } else {
                      $('#notify').removeClass("notification_");
                      $('#notify').html('');
                      $('#notify_side').removeClass("notification_side");
                      $('#notify_side').html('');
                    }
                    // console.log(data);
                  }
                })
              }

              setInterval(function () {
                load_notification(data);
                // console.log(i++);
              }, 5000);

            });
          </script>
          <?php

          // echo '<p>' . $OUTPUT->login_info() . '&nbsp; ' . $USER->firstname . ' ' . $USER->lastname . '</p>';
        
          // echo '<p><a href=' . $CFG->wwwroot . '/login/logout.php?sesskey=' . sesskey() . '><img src=' . $CFG->wwwroot . '/theme/learningway/logout3.png></a>';
          ?>


        </div>
        <!-- 
          <div class="logout3" align="right">


            <?php
            //echo '<p> <a href=' . $CFG->wwwroot . '/course/search.php' . '<i class="fa fa-search"></i> ค้นหาหลักสูตร</a> xxxxxxxxxxxxxxx </p>';
            ?>

          </div> -->



      <?php } ?>


      <?php

      // check boss //
      $serverName2 = $CFG->dbhost; //serverName\instanceName
      $connectionInfo2 = array("Database" => $CFG->dbname, "UID" => $CFG->dbuser, "PWD" => $CFG->dbpass, "CharacterSet" => 'UTF-8');
      $conn2 = sqlsrv_connect($serverName2, $connectionInfo2);

      function checkUserAssessment($conn, $id)
      {
        $sql = "select * from (
          select user_id as t1 from peer_eva
          UNION
          (select manager_id as t2 from peer_eva)) t1
          where t1 is not null";

        $qry = sqlsrv_query($conn, $sql);

        while ($result = sqlsrv_fetch_array($qry, SQLSRV_FETCH_ASSOC)) {

          if ($id == $result["t1"]) {
            $status = "yes";
          }
        }
        return $status;
      }

      function checkCountAssessment($conn, $id)
      {

        $status = 'no';

        $sql = "Select count(status) as counter
        FROM peer_status
        where user_id = '$id' and status = 'completed'";

        $qry = sqlsrv_query($conn, $sql);

        while ($result = sqlsrv_fetch_array($qry, SQLSRV_FETCH_ASSOC)) {

          if ($result["counter"] == 2) {
            $status = "yes";
          }
        }
        return $status;
      }




      function checkRoles($userid)
      {

        $context = get_context_instance(CONTEXT_SYSTEM);
        $roles = get_user_roles($context, $userid, false);
        $role = key($roles);
        //$roleid = $roles[$role]->roleid;
        $rolename = $roles[$role]->shortname;

        return $rolename; // admincoursereport
        //var_dump($roles);
      }


      function checkBoss($conn2, $em_code)
      {

        if ($conn2) {

          $sql_checkboss = "SELECT table1.id, table2.data as boss, table1.idnumber as employee, table1.firstname, table1.lastname, table1.username
     FROM mdl_user as table1
     INNER JOIN mdl_user_info_data as table2
     ON table1.id = table2.userid
     Where table2.fieldid = 36 and table2.data != '' and table2.data = $em_code";

          $qry_checkboss = sqlsrv_query($conn2, $sql_checkboss);
          $result_checkboss = sqlsrv_fetch_array($qry_checkboss, SQLSRV_FETCH_ASSOC);


          if ($result_checkboss['boss'] > 0) {
            return 'yes';
          } else {
            return 'no';
          }
        }
      }

      function has_manager($idnumber)
      {
        global $DB;
        $counter = 0;

        $params = array($idnumber);
        $sql = "SELECT count(manager_id) AS counter
                FROM peer_eva
                WHERE manager_id = ?";

        $rows = $DB->get_records_sql($sql, $params);

        foreach ($rows as $key) {
          $counter = $key->counter;
        }

        if ($counter > 0)
          return true;

        return false;
      }

      function checkBossAPI($em_code, $comname)
      {

        // get data from api 
      
        $url = '';
        //$url = 'https://btsmail.bts.co.th/btsempapi/api/Child/GetChildEmployeeAndCompanyNameByID?pParentEmpID=' . $em_code . '&pComName=' . $comname;
      
        //$url = 'https://btsmail.bts.co.th/btsempapi/api/Child?pParentEmpID=' . $em_code;
      
        $headers = array(
          'APIKey: YnRzQXBpS2V5QDIwMjI='
        );


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        //for debug only!
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        //curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
      
        // ดึงค่ามาเก็บไว้ใน $result
        $result = curl_exec($ch);

        curl_close($ch);

        $obj_data = json_decode($result); // convert to object is false or none
      
        /*
        {
          "ID": 0,
          "PARENT_EMPID": "481612",
          "CHILD_EMPID": "543017,543018,636156"
        }
        */

        // foreach ($obj_data as $key => $value) {
      
        //   $ID = $value->ID;
        //   $PARENT_EMPID = $value->PARENT_EMPID;
        //   $CHILD_EMPID = $value->CHILD_EMPID;
        // }
      
        //return $obj_data->CHILD_EMPID;
      
        if ($obj_data->CHILD_EMPID != "" || $obj_data->CHILD_EMPID != null) {
          return 'yes';
        } else {
          return 'no';
        }
      }



      // get category name 
      function getCategoryName($DB, $catid, $style = null)
      {
        $sql = "SELECT id,name,idnumber FROM mdl_course_categories where id = '$catid' ";

        $catname = $DB->get_records_sql($sql);

        foreach ($catname as $key) {
          $categoryname = $key->name;
        }

        if ($style == 'u') {
          echo strtoupper($categoryname);
        } else if ($style == 'l') {
          echo strtolower($categoryname);
        } else {
          echo $categoryname;
        }

        //var_dump($catname);
      }



      function getUsersID($conn, $email)
      {

        $sql = "SELECT T1.id, T1.username, T2.data as mem_code, T1.firstname,T1.lastname,
          T3.shortname, T3.name
          FROM mdl_user as T1
          INNER JOIN mdl_user_info_data as T2
          ON (T1.id = T2.userid)
          INNER JOIN mdl_user_info_field as T3
          ON(T2.fieldid = T3.id)
          where T3.shortname = 'extramembercode' and T2.data = '$email'";

        if ($conn) {
          $qry_user = sqlsrv_query($conn, $sql);
          $data_user = sqlsrv_fetch_array($qry_user, SQLSRV_FETCH_ASSOC);

          return $data_user['username'];
        }
      }

      function getUserInfos($conn, $field, $userid)
      {
        //echo $em_code;
        $sql = "SELECT T1.username, T2.data
          FROM mdl_user as T1
          INNER JOIN mdl_user_info_data as T2
          ON (T1.id = T2.userid)
          INNER JOIN mdl_user_info_field as T3
          ON(T2.fieldid = T3.id)
          where T3.shortname = '$field' and T1.id = '$userid'";

        if ($conn) {
          $qry_user = sqlsrv_query($conn, $sql);
          $data_user = sqlsrv_fetch_array($qry_user, SQLSRV_FETCH_ASSOC);

          //echo "<br/><br/><br/><br/><br/>";
          return $data_user['data'];
          //print_r($data_user);
        }
      }


      // ดึงค่าตำแหน่ง
      //$get_username = getUsers($conn2, $USER->idnumber);
      
      $extraposition = getUserInfos($conn2, 'extraposition', $USER->id);
      $extradepartment = getUserInfos($conn2, 'extradepartment', $USER->id);
      //$extracategory = getUserInfos($conn2, 'extracategory', $USER->id);
      
      $extramembercode = getUserInfos($conn2, 'membercode', $USER->id);

      // $extralevel = getUserInfos($conn2, 'extralevel', $USER->id);
      
      // แสดงรหัสพนักงาน
      //echo 'id '.$extramembercode;
      //echo 'level '.$extralevel;
      

      ?>

      <div class="toggle">
        <a style="color:#838383;" href="#" onclick="openSlideMenu();"><i class="fa fa-bars" aria-hidden="true"></i></a>
      </div>

      <script>
        // เปลี่ยนโลโก้ เมื่อหน้าจอเล็ก mobile 
        //$(window).load(setDivVisibility);

        //$(ducument).ready(setDivVisibility);

        $(document).ready(function () {

          setDivVisibility();
        });

        $(window).resize(setDivVisibility);

        function setDivVisibility() {
          //console.log($(window).width());

          if ($(window).width() <= '1024') { // default 970
            $('.logo').css('display', 'none');

            if (($(window).width()) <= '1024') {

              $('.logo').css('display', 'block');
              var new_src = "/theme/learningx/logonew.svg";
              $('.logo img').attr('src', new_src);
            }


          } else {
            $('.logo').css('display', 'block');

            var new_src = "/theme/learningx/logonew.svg";
            $('.logo img').attr('src', new_src);

          }
        }
      </script>


      <div id="slide-menu" class="slide-nav">



        <div class="my_pic">

          <?php

          echo $OUTPUT->login_info();

          //$picturequery = $DB->get_record_select('user', 'id = ?', array($USER->id));
          //echo $USER->id;
          //$mypicture = $OUTPUT->user_picture($picturequery); //,array('size' => 65)); 
          
          // echo $mypicture;
          ?>
        </div>

        <?php
        echo '<div><a style="padding:0" href=' . $CFG->wwwroot . '/message' . '>';
        ?>
        <span id="notify_side"></span>

        <?php
        echo '</a></div>';
        ?>


        <div class="my_text">
          <?php echo "&nbsp;&nbsp;" . $USER->firstname . "&nbsp;&nbsp;" . $USER->lastname; ?>
        </div>

        <a href="#" class="btn-close" onclick="closeSlideMenu();">&times;</a>

        <!-- เปลี่ยนภาษา Home  -->
        <?php if ($lang_ == 'th') { ?>
          <a <?php if ($PAGE->pagelayout == 'mydashboard')
            echo 'class=active';
          else
            ''; ?>
            href='<?php echo $CFG->wwwroot . '/my/'; ?>' target="_self"><i class="fas fa-home"></i>&nbsp;&nbsp;
            หน้าแรก</a>
        <?php } else { ?>

          <a <?php if ($PAGE->pagelayout == 'mydashboard')
            echo 'class=active';
          else
            ''; ?>
            href='<?php echo $CFG->wwwroot . '/my/'; ?>' target="_self"><i class="fas fa-home"></i>&nbsp;&nbsp; Home</a>

        <?php }
        ; ?>


        <!-- Learn -->
        <?php if ($lang_ == 'th') { ?>
          <a <?php if ($PAGE->pagelayout == 'learn')
            echo 'class=active';
          else
            ''; ?>
            href='<?php echo $CFG->wwwroot . '/course/journey.php'; ?>' target="_self"><i
              class="fa fa-mortar-board"></i>&nbsp;&nbsp;เส้นทางการเรียนรู้ของฉัน</a>
        <?php } else { ?>

          <a <?php if ($PAGE->pagelayout == 'learn')
            echo 'class=active';
          else
            ''; ?> href='<?php echo $CFG->wwwroot . '/course/journey.php'; ?>' target="_self"><i
              class="fa fa-mortar-board"></i>&nbsp;&nbsp;Journey</a>

        <?php }
        ; ?>


        <!-- Learn Mobile -->
        <style>
          .dropdown-containerX {
            display: none;
            /* background-color: #262626; */
            padding-left: 8px;
          }

          .dropdown-btnX {
            padding: 10px 10px 10px 30px;
            text-decoration: none;
            font-size: 17px;
            display: block;
            background: none;
            border: none;
            box-shadow: none;
            width: 434px;
            margin-left: -152px;
            color: #ccc;

            border-style: solid;
            border-width: 0px 0px 1px;
            border-color: #3e3e3e;
            font-family: 'LHBankHeader';
            margin-bottom: 0;

          }

          .dropdown-btnX:hover {
            color: #ccc;
            padding: 10px 10px 10px 30px;
            text-decoration: none;
            font-size: 17px;
            display: block;
            background: #3988ff;
            border: none;
            box-shadow: none;

            width: 434px;
            margin-left: -152px;

            border-style: solid;
            border-width: 0px 0px 1px;
            border-color: #3e3e3e;
          }

          .dropdown-btnX:active {
            color: #ccc;
            padding: 10px 10px 10px 30px;
            text-decoration: none;
            font-size: 17px;
            display: block;
            background: none;
            border: none;
            box-shadow: none;
            width: 434px;
            margin-left: -152px;

            border-style: solid;
            border-width: 0px 0px 1px;
            border-color: #3e3e3e;
          }

          .dropdown-btnX:focus {
            color: #ccc;
            padding: 10px 10px 10px 30px;
            text-decoration: none;
            font-size: 17px;
            display: block;
            background: none;
            border: none;
            box-shadow: none;
            width: 434px;
            margin-left: -152px;

            border-style: solid;
            border-width: 0px 0px 1px;
            border-color: #3e3e3e;
          }
        </style>

        <script>
          var dropdown = document.getElementsByClassName("dropdown-btnX");
          var i;

          for (i = 0; i < dropdown.length; i++) {
            dropdown[i].addEventListener("click", function () {
              //  this.classList.toggle("active");
              var dropdownContent = this.nextElementSibling;
              if (dropdownContent.style.display === "block") {
                dropdownContent.style.display = "none";
              } else {
                dropdownContent.style.display = "block";
              }
            });
          }
        </script>


        <!-- Plearn Mobile -->
        <style>
          .dropdown-container {
            display: none;
            /* background-color: #262626; */
            padding-left: 8px;
          }

          .dropdown-btn {
            padding: 10px 10px 10px 30px;
            text-decoration: none;
            font-size: 17px;
            display: block;
            background: none;
            border: none;
            box-shadow: none;
            width: 434px;
            margin-left: -152px;
            color: #ccc;

            border-style: solid;
            border-width: 0px 0px 1px;
            border-color: #3e3e3e;
            font-family: 'LHBankHeader';
            margin-bottom: 0;

          }

          .dropdown-btn:hover {
            color: #ccc;
            padding: 10px 10px 10px 30px;
            text-decoration: none;
            font-size: 17px;
            display: block;
            background: #3988ff;
            border: none;
            box-shadow: none;

            width: 434px;
            margin-left: -152px;

            border-style: solid;
            border-width: 0px 0px 1px;
            border-color: #3e3e3e;
          }

          .dropdown-btn:active {
            color: #ccc;
            padding: 10px 10px 10px 30px;
            text-decoration: none;
            font-size: 17px;
            display: block;
            background: none;
            border: none;
            box-shadow: none;
            width: 434px;
            margin-left: -152px;

            border-style: solid;
            border-width: 0px 0px 1px;
            border-color: #3e3e3e;
          }

          .dropdown-btn:focus {
            color: #ccc;
            padding: 10px 10px 10px 30px;
            text-decoration: none;
            font-size: 17px;
            display: block;
            background: none;
            border: none;
            box-shadow: none;
            width: 434px;
            margin-left: -152px;

            border-style: solid;
            border-width: 0px 0px 1px;
            border-color: #3e3e3e;
          }
        </style>

        <?php if (checkRoles($USER->id) != 'admincoursereport') { ?>

          <!-- <button class="dropdown-btn"><i class="fas fa-icons"></i>&nbsp;&nbsp; <?= ($lang_ == 'th') ? 'เพลิน' : 'Plearn'; ?>
            <i class="fa fa-caret-down"></i>
          </button> -->
        <?php } ?>


        <!-- <div class="dropdown-container">

          <a style="margin-left:-9px;" <?php if (($PAGE->pagelayout == 'plearn1'))
            echo 'class=active';
          else
            ''; ?> href='<?php echo $CFG->wwwroot . '/course/plearn1.php'; ?>' target="_self">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-chevron-right"></i>&nbsp;&nbsp; Leadership Competencies</a>

          <a style="margin-left:-9px;" <?php if (($PAGE->pagelayout == 'plearn2'))
            echo 'class=active';
          else
            ''; ?> href='<?php echo $CFG->wwwroot . '/course/plearn2.php'; ?>' target="_self">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-chevron-right"></i>&nbsp;&nbsp; Functional Competencies</a>

          <a style="margin-left:-9px;" <?php if (($PAGE->pagelayout == 'plearn3'))
            echo 'class=active';
          else
            ''; ?> href='<?php echo $CFG->wwwroot . '/course/plearn3.php'; ?>' target="_self">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-chevron-right"></i>&nbsp;&nbsp; Trend & New Knowledge</a>

        </div> -->


        <script>
          var dropdown = document.getElementsByClassName("dropdown-btn");
          var i;

          for (i = 0; i < dropdown.length; i++) {
            dropdown[i].addEventListener("click", function () {
              //  this.classList.toggle("active");
              var dropdownContent = this.nextElementSibling;
              if (dropdownContent.style.display === "block") {
                dropdownContent.style.display = "none";
              } else {
                dropdownContent.style.display = "block";
              }
            });
          }
        </script>

        <?php if (checkRoles($USER->id) != 'admincoursereport') { ?>
          <!-- Badges Mobile-->
          <!-- <a <?php if (($PAGE->pagelayout == 'mybadges'))
            echo 'class=active';
          else
            ''; ?> href='<?php echo $CFG->wwwroot . '/badges/mybadges.php'; ?>' target="_self"><i class="fas fa-crown"></i>&nbsp;&nbsp; <?= ($lang_ == 'th') ? 'เหรียญตรา' : 'Badges'; ?></a> -->
        <?php } ?>


        <?php if (checkRoles($USER->id) != 'admincoursereport') { ?>
          <!-- Community Mobile-->
          <!-- <a <?php if ($PAGE->pagelayout == 'incourse' && $_GET['type'] == 'forum')
            echo 'class=active';
          else
            ''; ?> href='<?php echo $CFG->wwwroot . '/mod/forum/view.php?id=1242&type=forum'; ?>' target="_self"><i class="fa fa-comment"></i>&nbsp;&nbsp; <?= ($lang_ == 'th') ? 'ห้องสนทนาการเรียนรู้' : 'Learning Community'; ?></a> -->
        <?php } ?>

        <?php if (CheckUserAssessment($conn2, $extramembercode) == 'yes') { ?>
          <!-- Assessment Mobile-->
          <a <?php if ($PAGE->pagelayout == 'assessment')
            echo 'class=active';
          else
            ''; ?> href='<?php echo $CFG->wwwroot . '/admin/kn-report/assessment/'; ?>' target="_self"><i
              class="fa fa-sort-amount-asc"></i>&nbsp;&nbsp;
            <?= ($lang_ == 'th') ? 'แบบประเมินสมรรถนะ' : 'Assessment'; ?></a>
        <?php } ?>

        <!-- Report Mobile-->
        <style>
          .dropdown-container2 {
            display: none;
            /* background-color: #262626; */
            padding-left: 8px;
          }

          .dropdown-btn2 {
            padding: 10px 10px 10px 30px;
            text-decoration: none;
            font-size: 17px;
            display: block;
            background: none;
            border: none;
            box-shadow: none;
            width: 434px;
            margin-left: -152px;
            color: #ccc;
            font-family: 'LHBankHeader';
            border-style: solid;
            border-width: 0px 0px 1px;
            border-color: #3e3e3e;
            font-family: 'LHBankHeader';
            margin-bottom: 0;
          }

          .dropdown-btn2:hover {
            color: #ccc;
            padding: 10px 10px 10px 30px;
            text-decoration: none;
            font-size: 17px;
            display: block;
            background: #3988ff;
            border: none;
            box-shadow: none;

            width: 434px;
            margin-left: -152px;

            border-style: solid;
            border-width: 0px 0px 1px;
            border-color: #3e3e3e;
          }

          .dropdown-btn2:active {
            color: #ccc;
            padding: 10px 10px 10px 30px;
            text-decoration: none;
            font-size: 17px;
            display: block;
            background: none;
            border: none;
            box-shadow: none;
            width: 434px;
            margin-left: -152px;

            border-style: solid;
            border-width: 0px 0px 1px;
            border-color: #3e3e3e;
          }

          .dropdown-btn2:focus {
            color: #ccc;
            padding: 10px 10px 10px 30px;
            text-decoration: none;
            font-size: 17px;
            display: block;
            background: none;
            border: none;
            box-shadow: none;
            width: 434px;
            margin-left: -152px;

            border-style: solid;
            border-width: 0px 0px 1px;
            border-color: #3e3e3e;
          }
        </style>


        <button class="dropdown-btn2"><i class="fas fa-copy"></i>&nbsp;&nbsp;
          <?= ($lang_ == 'th') ? 'รายงาน' : 'Report'; ?>
          <i class="fa fa-caret-down"></i>
        </button>

        <div class="dropdown-container2">
          <!-- My Assessment -->
          <?php
          if (CheckCountAssessment($conn2, $extramembercode) == 'yes') {
            ?>
            <a style="margin-left: -10px;" <?php if ($PAGE->pagelayout == 'assessment_userreport')
              echo 'class=active';
            else
              ''; ?> href='<?php echo $CFG->wwwroot . '/admin/kn-report/assessment/report/'; ?>'
              target="_self">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-chevron-right"></i>&nbsp;&nbsp;
              <?= ($lang_ == 'th') ? 'ผลการประเมิน' : 'My Assessment'; ?>
            </a>
          <?php } ?>

          <!-- My Profile -->
          <!-- <a style="margin-left: -10px;" <?php if ($PAGE->pagelayout == 'profile')
            echo 'class=active';
          else
            ''; ?> href='<?php echo $CFG->wwwroot . '/admin/kn-report/learning/'; ?>' target="_self">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-chevron-right"></i>&nbsp;&nbsp; <?= ($lang_ == 'th') ? 'ผลการเรียน' : 'My Profile'; ?></a> -->

          <!-- My IDP -->
          <a style="margin-left: -10px;" <?php if ($PAGE->pagelayout == 'myidp')
            echo 'class=active';
          else
            ''; ?> href='<?php echo $CFG->wwwroot . '/local/lxidp/'; ?>' target="_self">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i
              class="fa fa-chevron-right"></i>&nbsp;&nbsp; <?= ($lang_ == 'th') ? 'แผนพัฒนารายบุคคล' : 'My IDP'; ?></a>

          <!-- IDP Guildline -->
          <a style="margin-left: -10px;" <?php if ($PAGE->pagelayout == 'myidp')
            echo 'class=active';
          else
            ''; ?> href='<?php echo $CFG->wwwroot . '/admin/kn-report/myidp/'; ?>'
            target="_self">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-chevron-right"></i>&nbsp;&nbsp;
            <?= ($lang_ == 'th') ? 'คู่มือแนะนำ IDP Plan' : 'Guideline IDP Plan'; ?></a>


          <?php
          if (has_manager($extramembercode)) {
            // echo $extramembercode;
            ?>

            <a style="margin-left: -10px;" <?php if ($PAGE->pagelayout == 'idpstatus')
              echo 'class=active';
            else
              ''; ?> href='<?php echo $CFG->wwwroot . '/local/lxidp/idpstatus.php'; ?>'
              target="_self">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-chevron-right"></i>&nbsp;&nbsp;
              <?= ($lang_ == 'th') ? 'สถานะ IDP' : 'IDP Status'; ?></a>

          <?php }
          ;
          ?>


        </div>

        <script>
          var dropdown = document.getElementsByClassName("dropdown-btn2");
          var i;

          for (i = 0; i < dropdown.length; i++) {
            dropdown[i].addEventListener("click", function () {
              //  this.classList.toggle("active");
              var dropdownContent = this.nextElementSibling;
              if (dropdownContent.style.display === "block") {
                dropdownContent.style.display = "none";
              } else {
                dropdownContent.style.display = "block";
              }
            });
          }
        </script>

        <!-- end -->

        <!-- User manual Mobile -->
        <!-- <a <?php if ($_GET['type'] == 'usermanual')
          echo 'class=active';
        else
          ''; ?> href='<?php echo $CFG->wwwroot . '/course/view.php?id=75&type=usermanual'; ?>' target="_self"><i class="fa fa-book"></i>&nbsp;&nbsp; <?= ($lang_ == 'th') ? 'คู่มือการใช้งาน' : 'User Manual'; ?></a> -->

        <!-- Search Mobile -->
        <!-- <a <?php if ($PAGE->pagelayout == 'searchcourse')
          echo 'class=active';
        else
          ''; ?> href='<?php echo $CFG->wwwroot . '/course/searchcourse.php'; ?>' target="_self"><i class="fa fa-search"></i>&nbsp;&nbsp; <?= ($lang_ == 'th') ? 'ค้นหาบทเรียน' : 'Search courses'; ?></a> -->

        <!-- Contact Mobile -->
        <a <?php if ($PAGE->pagelayout == 'contact')
          echo 'class=active';
        else
          ''; ?> href='<?php echo $CFG->wwwroot . '/contact/'; ?>' target="_self"><i class="fas fa-envelope"></i>&nbsp;&nbsp;
          <?= ($lang_ == 'th') ? 'ติดต่อสอบถาม' : 'Contact us'; ?></a>

        <!-- Logout Mobile -->
        <a href='<?php echo $CFG->wwwroot . '/login/logout.php?sesskey=' . sesskey(); ?>'><i
            class="fas fa-power-off"></i>&nbsp;&nbsp; <?= ($lang_ == 'th') ? 'ออกจากระบบ' : 'Log out'; ?></a>
      </div>

      <script>
        function openSlideMenu() {
          document.getElementById('slide-menu').style.width = '280px';
        }

        function closeSlideMenu() {
          document.getElementById('slide-menu').style.width = '0';
        }

        var elements = document.getElementById('slide-menu');

        var mc = new Hammer(elements);

        // listen to events is panleft panright tap press
        mc.on("panleft", function (ev) {
          // closeSlideMenu();
        });
      </script>

      <?php if ($hasshortname) { ?>
        <a class="brand" href="<?php echo $CFG->wwwroot; ?>">
          <?php echo format_string($SITE->shortname, true, array('context' => context_course::instance(SITEID))); ?>
        <?php } else {
      } ?>

    </div>

    <div class="container-fluid">
      <div class="row-fluid">
        <div class="topnav">
          <ul class="nav pull-left">

            <li>
              <!-- เปลี่ยนภาษา Home  -->
              <?php if ($lang_ == 'th') { ?>
                <a <?php if ($PAGE->pagelayout == 'mydashboard')
                  echo 'class=active';
                else
                  ''; ?> href='<?php echo $CFG->wwwroot . '/my/'; ?>' target="_self">
                  หน้าแรก
                </a>
              <?php } else { ?>
                <a <?php if ($PAGE->pagelayout == 'mydashboard')
                  echo 'class=active';
                else
                  ''; ?> href='<?php echo $CFG->wwwroot . '/my/'; ?>' target="_self">
                  Home
                </a>

              <?php }
              ; ?>
              <!-- จบ เปลี่ยนภาษา -->
            </li>


            <li>
              <?php //if (is_siteadmin() == 1) { ?>
              <!-- เปลี่ยนภาษา Learn  -->
              <?php if ($lang_ == 'th') { ?>
                <a <?php if (($PAGE->pagelayout == 'coursecategory') || ($PAGE->pagelayout == 'mycourse') || ($PAGE->pagelayout == 'course1') || ($PAGE->pagelayout == 'course2') || ($PAGE->pagelayout == 'course3') || ($PAGE->pagelayout == 'course4'))
                  echo 'class=active';
                else
                  ''; ?> href='<?php echo $CFG->wwwroot . '/course/journey.php'; ?>' target="_self">
                  <span>เส้นทางการเรียนรู้ของฉัน</span>

                </a>
              <?php } else { ?>
                <a <?php if (($PAGE->pagelayout == 'coursecategory') || ($PAGE->pagelayout == 'learn'))
                  echo 'class=active';
                else
                  ''; ?> href='<?php echo $CFG->wwwroot . '/course/journey.php'; ?>' target="_self">
                  <span>Journey</span>
                </a>
              <?php }
              ; ?>

              <!-- จบ เปลี่ยนภาษา -->
              <?php //} ?>
            </li>

            <?php if (CheckUserAssessment($conn2, $extramembercode) == 'yes') { ?>
              <li>
                <!-- Assessment  -->
                <?php if ($lang_ == 'th') { ?>

                  <a <?php if ($PAGE->pagelayout == 'assessment')
                    echo 'class=active';
                  else
                    ''; ?> href='<?php echo $CFG->wwwroot . '/admin/kn-report/assessment/'; ?>' target="_self">
                    แบบประเมินสมรรถนะ
                  </a>
                <?php } else { ?>
                  <a <?php if ($PAGE->pagelayout == 'assessment')
                    echo 'class=active';
                  else
                    ''; ?> href='<?php echo $CFG->wwwroot . '/admin/kn-report/assessment/'; ?>' target="_self">
                    Assessment
                  </a>
                <?php }
                ; ?>
                <!-- จบ เปลี่ยนภาษา -->

              </li>

            <?php } ?>

            <!-- report -->
            <?php
            if (is_siteadmin() != 1) {
              ?>

              <li>
                <!-- เปลี่ยนภาษา Home  -->
                <?php if ($lang_ == 'th') { ?>
                  <a <?php if ($PAGE->pagelayout == 'profile' || $PAGE->pagelayout == 'myteam' || $PAGE->pagelayout == 'myidp')
                    echo 'class=active';
                  else
                    ''; ?> href='<?php echo '#'; ?>' target="_self">
                    <span>รายงาน <i class="fas fa-sort-down"></i></span>
                    <!-- <font color="#fff">รายงาน</font>
                    <div style="margin-left:45px;" class="down"><i class="fas fa-sort-down"></i></div> -->
                  </a>
                <?php } else { ?>
                  <a <?php if ($PAGE->pagelayout == 'profile' || $PAGE->pagelayout == 'myteam' || $PAGE->pagelayout == 'myidp' || $PAGE->pagelayout == 'assessment_userreport')
                    echo 'class=active';
                  else
                    ''; ?> href='<?php echo '#'; ?>'
                    target="_self">
                    <span>Report <i class="fas fa-sort-down"></i></span>
                    <!-- <font color="#fff">Report</font>
                    <div style="margin-left:45px;" class="down"><i class="fas fa-sort-down"></i></div> -->
                  </a>
                <?php }
                ; ?>
                <!-- จบ เปลี่ยนภาษา -->

                <ul>


                  <!-- assessment_userreport -->
                  <?php
                  if (CheckCountAssessment($conn2, $extramembercode) == 'yes') {
                    ?>

                    <li style="width:175px;">
                      <?php if ($lang_ == 'th') { ?>
                        <a <?php if ($PAGE->pagelayout == 'assessment_userreport')
                          echo 'class=active';
                        else
                          ''; ?> href='<?php echo $CFG->wwwroot . '/admin/kn-report/assessment/report/'; ?>'
                          target="_self">ผลการประเมิน
                        </a>
                      <?php } else { ?>
                        <a <?php if ($PAGE->pagelayout == 'assessment_userreport')
                          echo 'class=active';
                        else
                          ''; ?> href='<?php echo $CFG->wwwroot . '/admin/kn-report/assessment/report/'; ?>' target="_self">My
                          Assessment
                        </a>
                      <?php }
                      ; ?>
                      <!-- จบ เปลี่ยนภาษา -->
                    </li>

                  <?php } ?>

                  <!-- เปลี่ยนภาษา My Profile  -->
                  <!-- <li style="width:175px;">
                    <?php if ($lang_ == 'th') { ?>
                      <a <?php if ($PAGE->pagelayout == 'profile')
                        echo 'class=active';
                      else
                        ''; ?> href='<?php echo $CFG->wwwroot . '/admin/kn-report/learning/'; ?>' target="_self">ผลการเรียน
                      </a>
                    <?php } else { ?>
                      <a <?php if ($PAGE->pagelayout == 'profile')
                        echo 'class=active';
                      else
                        ''; ?> href='<?php echo $CFG->wwwroot . '/admin/kn-report/learning/'; ?>' target="_self">My Profile
                      </a>
                    <?php }
                    ; ?>
                  </li> -->


                  <?php //if (CheckCountAssessment($conn2, $extramembercode) == 'yes') { 
                    ?>

                  <li style="width:175px;">
                    <!-- เปลี่ยนภาษา My Profile  -->
                    <?php if ($lang_ == 'th') { ?>
                      <a <?php if ($PAGE->pagelayout == 'myidp')
                        echo 'class=active';
                      else
                        ''; ?> href='<?php echo $CFG->wwwroot . '/local/lxidp/'; ?>' target="_self">แผนพัฒนารายบุคคล
                      </a>
                    <?php } else { ?>
                      <a <?php if ($PAGE->pagelayout == 'myidp')
                        echo 'class=active';
                      else
                        ''; ?> href='<?php echo $CFG->wwwroot . '/local/lxidp/'; ?>' target="_self">My IDP
                      </a>
                    <?php }
                    ; ?>
                    <!-- จบ เปลี่ยนภาษา -->
                  </li>

                  <li style="width:175px;">
                    <!-- เปลี่ยนภาษา Guideline  -->
                    <?php if ($lang_ == 'th') { ?>
                      <a <?php if ($PAGE->pagelayout == 'myidpguide')
                        echo 'class=active';
                      else
                        ''; ?> href='<?php echo $CFG->wwwroot . '/admin/kn-report/myidp/'; ?>' target="_self">คู่มือแนะนำ IDP Plan
                      </a>
                    <?php } else { ?>
                      <a <?php if ($PAGE->pagelayout == 'myidpguide')
                        echo 'class=active';
                      else
                        ''; ?> href='<?php echo $CFG->wwwroot . '/admin/kn-report/myidp/'; ?>' target="_self">Guideline IDP Plan
                      </a>
                    <?php }
                    ; ?>
                    <!-- จบ เปลี่ยนภาษา -->
                  </li>

                  <?php
                  if (has_manager($extramembercode)) {
                    //  echo $extramembercode;
                    ?>
                    <li style="width:175px;">
                      <!-- เปลี่ยนภาษา IDP Status  -->
                      <?php if ($lang_ == 'th') { ?>
                        <a <?php if ($PAGE->pagelayout == 'idpstatus')
                          echo 'class=active';
                        else
                          ''; ?> href='<?php echo $CFG->wwwroot . '/local/lxidp/idpstatus.php'; ?>' target="_self">สถานะ IDP
                        </a>
                      <?php } else { ?>
                        <a <?php if ($PAGE->pagelayout == 'idpstatus')
                          echo 'class=active';
                        else
                          ''; ?> href='<?php echo $CFG->wwwroot . '/local/lxidp/idpstatus.php'; ?>' target="_self">IDP Status
                        </a>
                      <?php }
                      ; ?>
                      <!-- จบ เปลี่ยนภาษา -->
                    </li>
                  <?php } ?>

                  <!-- เปลี่ยนภาษา My Team  -->
                  <?php
                  // if (checkBossAPI($USER->idnumber, $USER->aim) == 'yes') {
                  ?>
                  <!-- <li style="width:175px;">
                    <?php if ($lang_ == 'th') { ?>
                      <a <?php if ($PAGE->pagelayout == 'myteam')
                        echo 'class=active';
                      else
                        ''; ?> href=<?php echo "$CFG->wwwroot/admin/kn-report/learning_report_online_boss.php"; ?> title="My Team">
                        รายงานของทีม
                      </a>
                    <?php } else { ?>
                      <a <?php if ($PAGE->pagelayout == 'myteam')
                        echo 'class=active';
                      else
                        ''; ?> href=<?php echo "$CFG->wwwroot/admin/kn-report/learning_report_online_boss.php"; ?> title="My Team">
                        My Team
                      </a>
                    <?php }
                    ; ?>
                  </li> -->
                  <?php // }; 
                    ?>
                </ul>

              </li>
            <?php } ?>

            <!-- User Manual  -->
            <!-- <li>
            <?php if ($lang_ == 'th') { ?>
              <a <?php if ($_GET['type'] == 'usermanual')
                echo 'class=active';
              else
                ''; ?> href='<?php echo $CFG->wwwroot . '/course/view.php?id=75&type=usermanual'; ?>' target="_self">
                 คู่มือการใช้งาน
              </a>
            <?php } else { ?>
              <a <?php if ($_GET['type'] == 'usermanual')
                echo 'class=active';
              else
                ''; ?> href='<?php echo $CFG->wwwroot . '/course/view.php?id=75&type=usermanual'; ?>' target="_self">
                 User Manual
              </a>
            <?php }
            ; ?>
            </li> -->


            <!-- contact -->
            <li>
              <?php if ($lang_ == 'th') { ?>
                <a <?php if ($PAGE->pagelayout == 'contact')
                  echo 'class=active';
                else
                  ''; ?> href='<?php echo $CFG->wwwroot . '/contact/'; ?>' target="_self">
                  ติดต่อสอบถาม
                </a>
              <?php } else { ?>
                <a <?php if ($PAGE->pagelayout == 'contact')
                  echo 'class=active';
                else
                  ''; ?> href='<?php echo $CFG->wwwroot . '/contact/'; ?>' target="_self">
                  Contact us
                </a>
              <?php }
              ; ?>


            </li>

            <!-- admin -->
            <?php
            if (is_siteadmin() == 1) {
              ?>
              <li>
                <!-- เปลี่ยนภาษา Home  -->
                <?php if ($lang_ == 'th') { ?>
                  <a <?php if ($PAGE->pagelayout == 'admin' || $PAGE->pagelayout == 'admin_report' || $PAGE->pagelayout == 'report' || $PAGE->pagelayout == 'import_training' || $PAGE->pagelayout == 'userreport' || $PAGE->pagelayout == 'coursereport' || $PAGE->pagelayout == 'badgereport' || $PAGE->pagelayout == 'assessment' || $_GET['type'] == 'enrollment')
                    echo 'class=active';
                  else
                    ''; ?> href='#'>
                    <span>ผู้ดูแลระบบ <i class="fas fa-sort-down"></i></span>
                    <!-- <font color="#fff">ผู้ดูแลระบบ</font>&nbsp;&nbsp;<div style="margin-left:41px;" class="down"><i class="fas fa-sort-down"></i></div> -->
                  </a>
                <?php } else { ?>
                  <a <?php if ($PAGE->pagelayout == 'admin' || $PAGE->pagelayout == 'admin_report' || $PAGE->pagelayout == 'report' || $PAGE->pagelayout == 'import_training' || $PAGE->pagelayout == 'userreport' || $PAGE->pagelayout == 'coursereport' || $PAGE->pagelayout == 'badgereport' || $PAGE->pagelayout == 'assessment' || $_GET['type'] == 'enrollment')
                    echo 'class=active';
                  else
                    ''; ?> href='#'>
                    <span>Admin <i class="fas fa-sort-down"></i></span>
                    <!-- <font color="#fff">Admin</font>&nbsp;&nbsp;<div style="margin-left:41px;" class="down"><i class="fas fa-sort-down"></i></div> -->
                  </a>
                <?php }
                ; ?>
                <!-- จบ เปลี่ยนภาษา -->

                <ul>

                  <!-- dashboard -->
                  <!-- <li>
                  <a <?php if ($PAGE->pagelayout == 'admin_report' || $_GET['type'] == 'dashboard')
                    echo 'class=active';
                  else
                    ''; ?> href='<?php echo $CFG->wwwroot . '/admin/kn-report/dashboard.php?type=dashboard'; ?>'>Dashboard</a>
                </li> -->

                  <?php if ($USER->idnumber != 'xxxx') { ?>
                    <li>
                      <a href=<?php echo "$CFG->wwwroot/admin/user.php"; ?> title="Accounts">
                        Manage users
                      </a>
                    </li>



                    <!-- <li>
                    <a <?php if ($PAGE->pagelayout == 'add_user')
                      echo 'class=active';
                    else
                      ''; ?> href='<?php echo $CFG->wwwroot . '/admin/kn-report/check_user/'; ?>'>Check users by API</a>
                  </li> -->

                    <li>
                      <a <?php if ($PAGE->pagelayout == 'update_user')
                        echo 'class=active';
                      else
                        ''; ?> href='<?php echo $CFG->wwwroot . '/admin/kn-report/update_user/'; ?>'>Quick edit users</a>
                    </li>

                  <?php } ?>

                  <?php //if ($USER->idnumber == '999999') { 
                    ?>

                  <!-- <li>
                  <a <?php if ($PAGE->pagelayout == 'synccompu')
                    echo 'class=active';
                  else
                    ''; ?> href='<?php echo $CFG->wwwroot . '/admin/kn-report/synccompu/'; ?>'>e-Learning record Compu</a>
                </li> -->

                  <?php //} 
                    ?>


                  <li>
                    <a href=<?php echo "$CFG->wwwroot/course/management.php"; ?> title="Manage courses">
                      Manage courses
                    </a>
                  </li>

                  <li>
                    <a <?php if ($PAGE->pagelayout == 'import_banner')
                      echo 'class=active';
                    else
                      ''; ?> href='<?php echo $CFG->wwwroot . '/admin/kn-report/banner/'; ?>'>Manage banner</a>
                  </li>

                  <!-- <li>

                    <a <?php if ($PAGE->pagelayout == 'mybadge')
                      echo 'class=active';
                    else
                      ''; ?> href='<?php echo $CFG->wwwroot . '/badges/index.php?type=1'; ?>'>Manage badges</a>
                  </li> -->

                  <!-- <li>
                    <a <?php if ($PAGE->pagelayout == 'badgereport')
                      echo 'class=active';
                    else
                      ''; ?> href='<?php echo $CFG->wwwroot . '/admin/kn-report/badgereport/'; ?>'>Badge report</a>
                  </li> -->

					<li>
                    <a <?php if ($PAGE->pagelayout == 'trainingrecord')
                      echo 'class=active';
                    else
                      ''; ?> href='<?php echo $CFG->wwwroot . '/local/lxtrainingrecords/'; ?>'>Training records</a>
                  </li>

                  <li>
                    <a <?php if ($PAGE->pagelayout == 'import_training')
                      echo 'class=active';
                    else
                      ''; ?> href='<?php echo $CFG->wwwroot . '/admin/kn-report/import_training/'; ?>'>Import TBAC/PacD</a>
                  </li>

                  <li>
                    <a <?php if ($PAGE->pagelayout == 'admin_report')
                      echo 'class=active';
                    else
                      ''; ?> href='<?php echo $CFG->wwwroot . '/admin/kn-report/admin_report/'; ?>'>E-Learning report</a>
                  </li>

                  <li>
                    <a <?php if ($PAGE->pagelayout == 'admin')
                      echo 'class=active';
                    else
                      ''; ?> href='<?php echo $CFG->wwwroot . '/local/lxenrolcourses/'; ?>'>Auto enrol course</a>
                  </li>

                  <li>
                    <a <?php if ($PAGE->pagelayout == 'manage_peer')
                      echo 'class=active';
                    else
                      ''; ?> href='<?php echo $CFG->wwwroot . '/admin/kn-report/assessment/manage_peer/'; ?>'>Manage assess
                      peer</a>
                  </li>

                  <li>
                    <a <?php if ($PAGE->pagelayout == 'mapping_doc')
                      echo 'class=active';
                    else
                      ''; ?> href='<?php echo $CFG->wwwroot . '/admin/kn-report/assessment/mapping_doc/'; ?>'>Mapping assess
                      doc</a>
                  </li>

                  <li>
                    <a <?php if ($PAGE->pagelayout == 'upload_doc')
                      echo 'class=active';
                    else
                      ''; ?> href='<?php echo $CFG->wwwroot . '/admin/kn-report/assessment/upload_doc/'; ?>'>Upload assess
                      doc</a>
                  </li>

                  <li>
                    <a <?php if ($PAGE->pagelayout == 'assessment')
                      echo 'class=active';
                    else
                      ''; ?> href='<?php echo $CFG->wwwroot . '/admin/kn-report/assessment_report/'; ?>'>Assessment report</a>
                  </li>

                  <li>
                    <a <?php if ($PAGE->pagelayout == 'reports')
                      echo 'class=active';
                    else
                      ''; ?> href='<?php echo $CFG->wwwroot . '/report/log/index.php'; ?>'>Logs report</a>
                  </li>






                  <!-- <li>
                    <a <?php if ($PAGE->pagelayout == 'import_training')
                      echo 'class=active';
                    else
                      ''; ?> href='<?php echo $CFG->wwwroot . '/admin/kn-report/import_sam/'; ?>'>Import SAM & HR Users</a>
                  </li> -->

                  <!--
<li >
  <a <?php if ($PAGE->pagelayout == 'reports')
    echo 'class=active';
  else
    ''; ?> href='<?php echo $CFG->wwwroot . '/report/extendedlog/index.php'; ?>'>History logs</a>
</li>
-->


                  <li>
                    <a href='<?php echo $CFG->wwwroot . '/admin/purgecaches.php'; ?>'>Purge all caches</a>
                  </li>



                </ul>

              </li>
              <?php
            }
            ?>


            <!-- 
          <ul class="nav pull-right">

            <li>
              <div class="search-container">
                <form action"/course/search.php"> <input type="text" placeholder="ค้นหาบทเรียน" name="search">&nbsp;&nbsp;&nbsp;
                  <button type="submit"><i class="fa fa-search"></i></button>
                </form>
              </div>
            </li>

          </ul> -->


            <!-- custom menu บน moodle -->
            <?php //echo $OUTPUT->custom_menu(); 
            ?>
            <!--
                <ul class="nav pull-right">
                    <li><?php //echo $OUTPUT->page_heading_menu(); 
                    ?></li>
                </ul>
 -->

        </div>
      </div>



      <!-- <div class="search-container" style="text-align:right;margin-top:5px;">
    <form action="/course/search.php">
      <input type="text" placeholder="Search..." name="search">
      <button type="submit"><i class="fa fa-search"></i></button>
    </form>
  </div> -->







    </div>


  </nav>
</header>




<div class="container-fluid clearfix">



  <?php if ($hasnavbar) { ?>



    <nav class="breadcrumb-button"><?php echo $PAGE->button; ?></nav>


    <?php
    // echo 'You are here : ';
  
    if ($PAGE->pagelayout != 'mydashboard') {

      echo $OUTPUT->navbar();
    }

    ?>

  <?php } ?>

  <?php if ($iscoursepage) { ?>
    <h1 id="courseheader"><?php // echo  'hello'.$PAGE->heading 
      ?></h1>
  <?php } ?>

  <?php if (($isfrontpage) && ($hasgeneralalert)) { ?>
    <div id="page-header-generalalert">


      <?php echo $PAGE->theme->settings->generalalert; ?>
    </div>
  <?php } ?>
</div>

<div id="page" class="container-fluid clearfix">
  <!--

      <div id="page-header-generalalert">
  <?php echo $PAGE->theme->settings->generalalert; ?>
</div>
-->