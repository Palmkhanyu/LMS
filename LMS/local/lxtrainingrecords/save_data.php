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
global $CFG, $DB, $USER;

$sql = "SELECT * FROM {local_lxtrainingrecords_temp}";
// $row = $DB->get_records_sql($sql);
$row = $DB->get_recordset_sql($sql);

foreach ($row as $key => $value) {

    //$data = new stdClass();

    //$data->id = $value->id;
    $company_code = $value->company_code;
    $employee_id = $value->employee_id;
    $prefix = $value->prefix;
    $firstname = $value->firstname;
    $lastname = $value->lastname;
    $position = $value->position;
    $section_branch = $value->section_branch;
    $department_area = $value->department_area;
    $region = $value->region;
    $division = $value->division;
    $group = $value->group;
    $unit = $value->unit;
    $email = $value->email;
    $level = $value->level;
    $cost_center = $value->cost_center;
    $dep_code = $value->dep_code;
    $methodology = $value->methodology;
    $channel = $value->channel;
    $category_code = $value->category_code;
    $course_code = $value->course_code;
    $class_no = $value->class_no;
    $desc_local = $value->desc_local;
    $desc_global = $value->desc_global;
    $start_date = $value->start_date;
    $end_date = $value->end_date;
    $training_hour = $value->training_hour;
    $training_cost = $value->training_cost;
    $evaluate_result = $value->evaluate_result;
    $training_institute = $value->training_institute;
    $training_location = $value->training_location;
    $timestamp = $value->timestamp;

    // $result = $DB->insert_record("local_lxtrainingrecords", $data, true, false);


		  $sql = "INSERT INTO mdl_local_lxtrainingrecords (company_code, employee_id, prefix, firstname, lastname, position, section_branch, department_area, region, division, [group], unit, email, [level], cost_center, dep_code, methodology, channel, category_code, course_code, class_no, desc_local, desc_global, [start_date], end_date, training_hour, training_cost, evaluate_result, training_institute, training_location, [timestamp]) VALUES ('" . $company_code . "','" . $employee_id . "','" . $prefix . "','" . $firstname . "','" . $lastname . "','" . $position . "','" . $section_branch . "','" . $department_area . "','" . $region . "','" . $division . "','" . $group . "','" . $unit . "','" . $email . "','" . $level . "','" . $cost_center . "','" . $dep_code . "','" . $methodology . "','" . $channel . "','" . $category_code . "','" . $course_code . "','" . $class_no . "','" . $desc_local . "','" . $desc_global . "','" . $start_date . "','" . $end_date . "','" . $training_hour . "','" . $training_cost . "','" . $evaluate_result . "','" . $training_institute . "','" . $training_location . "'," . $timestamp . ")";


    $DB->execute($sql);
}

$sqldel = "TRUNCATE TABLE mdl_local_lxtrainingrecords_temp";
// $DB->query($sqldel);
$DB->execute($sqldel);

// header('content-type: application:json; charset=utf8');
http_response_code(200);
echo json_encode([
    'isValid' => true,
    'ErrorMessage' => 'Saved successfully!'
]);
