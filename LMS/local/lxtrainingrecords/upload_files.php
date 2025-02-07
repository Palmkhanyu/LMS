<?php
// This file is part of Moodle - https://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.

/**
 * Plugin version and other meta-data are defined here.
 *
 * @package     local_lxtrainingrecords
 * @copyright   2024 LX <komkrit@learningx.co>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once('../../config.php');

global $CFG, $DB;


// header('Content-type:application/json;charset=utf-8');

try {
    if (
        !isset($_FILES['file']['error']) ||
        is_array($_FILES['file']['error'])
    ) {
        throw new RuntimeException('Invalid parameters.');
    }

    switch ($_FILES['file']['error']) {
        case UPLOAD_ERR_OK:
            break;
        case UPLOAD_ERR_NO_FILE:
            throw new RuntimeException('No file sent.');
        case UPLOAD_ERR_INI_SIZE:
        case UPLOAD_ERR_FORM_SIZE:
            throw new RuntimeException('Exceeded filesize limit.');
        default:
            throw new RuntimeException('Unknown errors.');
    }

    $file_data = fopen($_FILES['file']['tmp_name'], 'r');

    $line = fgetcsv($file_data);
    if (count($line) >= 30) { // จำนวนคอลัมน์ในไฟล์
        $sqldel = "TRUNCATE TABLE mdl_local_lxtrainingrecords_temp";
        $DB->execute($sqldel);
    }

    $firstline = true;
    while (($row = fgetcsv($file_data, 10000, ",")) !== FALSE) {
        if (!$firstline) {
            // Code to insert into database
           // print_r($row);
            $company_code = $row[0];
            $employee_id = $row[1];
            $prefix = $row[2];
            $firstname = $row[3];
            $lastname = $row[4];
            $position = $row[5];
            $section_branch = $row[6];
            $department_area = $row[7];
            $region = $row[8];
            $division = $row[9];
            $group = $row[10];
            $unit = $row[11];
            $email = $row[12];
            $level = $row[13];
            $cost_center = $row[14];
            $dep_code = $row[15];
            $methodology = $row[16];
            $channel = $row[17];
            $category_code = $row[18];
            $course_code = $row[19];
            $class_no = $row[20];
            $desc_local = $row[21];
            $desc_global = $row[22];
            $start_date = $row[23];
            $end_date = $row[24];
            $training_hour = $row[25];
            $training_cost = $row[26];
            $evaluate_result = $row[27];
            $training_institute = $row[28];
            $training_location = $row[29];
            $timestamp = time();


			/* sqlsrv use [keyword] no `keyword` */
            $sql = "INSERT INTO mdl_local_lxtrainingrecords_temp (company_code, employee_id, prefix, firstname, lastname, position, section_branch, department_area, region, division, [group], unit, email, [level], cost_center, dep_code, methodology, channel, category_code, course_code, class_no, desc_local, desc_global, [start_date], end_date, training_hour, training_cost, evaluate_result, training_institute, training_location, [timestamp]) VALUES ('" . $company_code . "','" . $employee_id . "','" . $prefix . "','" . $firstname . "','" . $lastname . "','" . $position . "','" . $section_branch . "','" . $department_area . "','" . $region . "','" . $division . "','" . $group . "','" . $unit . "','" . $email . "','" . $level . "','" . $cost_center . "','" . $dep_code . "','" . $methodology . "','" . $channel . "','" . $category_code . "','" . $course_code . "','" . $class_no . "','" . $desc_local . "','" . $desc_global . "','" . $start_date . "','" . $end_date . "','" . $training_hour . "','" . $training_cost . "','" . $evaluate_result . "','" . $training_institute . "','" . $training_location . "'," . $timestamp . ")";
			
/*
			$sql = "INSERT INTO mdl_local_lxtrainingrecords_temp (company_code, employee_id, prefix, firstname, lastname, position, section_branch, department_area, region, division, [group], unit, email, [level], cost_center, dep_code, methodology, channel, category_code, course_code, class_no, desc_local, desc_global, [start_date], end_date, training_hour, training_cost, evaluate_result, training_institute, training_location, [timestamp]) VALUES ('xxx','xxx','xxx','xxx','xxx','xxx','xxx','xxx','xxx','xxx','xxx','xxx','xxx','xxx','xxx' , 'xxx','xxx','xxx','xxx','xxx','xxx','xxx','xxx','xxx','xxx','xxx','xxx','xxx','xxx','xxx',1111)";
			
			$sql = "INSERT INTO mdl_local_lxtrainingrecords_temp (`company_code`, `employee_id`, `prefix`, `firstname`, `lastname`, `position`, `section_branch`, `department_area`, `region`, `division`, `group`, `unit`, `email`, `level`, `cost_center`, `dep_code`, `methodology`, `channel`, `category_code`, `course_code`, `class_no`, `desc_local`, `desc_global`, `start_date`, `end_date`, `training_hour`, `training_cost`, `evaluate_result`, `training_institute`, `training_location`, `timestamp`) VALUES ('" . $company_code . "','" . $employee_id . "','" . $prefix . "','" . $firstname . "','" . $lastname . "','" . $position . "','" . $section_branch . "','" . $department_area . "','" . $region . "','" . $division . "','" . $group . "','" . $unit . "','" . $email . "','" . $level . "','" . $cost_center . "','" . $dep_code . "','" . $methodology . "','" . $channel . "','" . $category_code . "','" . $course_code . "','" . $class_no . "','" . $desc_local . "','" . $desc_global . "','" . $start_date . "','" . $end_date . "','" . $training_hour . "','" . $training_cost . "','" . $evaluate_result . "','" . $training_institute . "','" . $training_location . "'," . $timestamp . ")";
			*/

            $DB->execute($sql);
		

            // if (!$DB->execute($sql)) {
            //     // Something went wrong, send the err message as JSON
            //     http_response_code(400);

            //     echo json_encode([
            //         'status' => 'error',
            //         'message' => 'cannot insert data'
            //     ]);
           // }
        }
        $firstline = false;
    }


    http_response_code(200);
    echo json_encode([
        'status' => 'success',
        'message' => 'insert data success'
    ]);

} catch (RuntimeException $e) {
    // Something went wrong, send the err message as JSON
    http_response_code(400);
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
}
