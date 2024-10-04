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

// error_reporting(E_ALL);
// ini_set('display_errors', 'on');


$column = array("company_code", "employee_id", "firstname", "lastname", "position", "section_branch", "department_area", "region", 'division', 'group', 'unit', 'email', 'level', 'cost_center', 'dep_code', 'channel', 'category_code', 'course_code', 'desc_local', 'desc_global', 'start_date', 'end_date', 'training_institute', 'training_location');

$query = "SELECT * FROM {local_lxtrainingrecords_temp}";

if (!empty($_POST["search"]["value"])) {
    $query .= " WHERE `company_code` LIKE '%" . $_POST["search"]["value"] . "%' OR `employee_id` LIKE '%" . $_POST["search"]["value"] . "%' OR `firstname` LIKE '%" . $_POST["search"]["value"] . "%' OR `lastname` LIKE '%" . $_POST["search"]["value"] . "%' OR `position` LIKE '%" . $_POST["search"]["value"] . "%' OR `section_branch` LIKE '%" . $_POST["search"]["value"] . "%' OR `department_area` LIKE '%" . $_POST["search"]["value"] . "%' OR `region` LIKE '%" . $_POST["search"]["value"] . "%' OR `division` LIKE '%" . $_POST["search"]["value"] . "%' OR `group` LIKE '%" . $_POST["search"]["value"] . "%' OR `unit` LIKE '%" . $_POST["search"]["value"] . "%' OR `email` LIKE '%" . $_POST["search"]["value"] . "%' OR `level` LIKE '%" . $_POST["search"]["value"] . "%' OR `cost_center` LIKE '%" . $_POST["search"]["value"] . "%' OR `dep_code` LIKE '%" . $_POST["search"]["value"] . "%' OR `channel` LIKE '%" . $_POST["search"]["value"] . "%' OR `category_code` LIKE '%" . $_POST["search"]["value"] . "%' OR `course_code` LIKE '%" . $_POST["search"]["value"] . "%' OR `desc_local` LIKE '%" . $_POST["search"]["value"] . "%' OR `desc_global` LIKE '%" . $_POST["search"]["value"] . "%' OR `start_date` LIKE '%" . $_POST["search"]["value"] . "%' OR `end_date` LIKE '%" . $_POST["search"]["value"] . "%' OR `training_institute` LIKE '%" . $_POST["search"]["value"] . "%' OR `training_location` LIKE '%" . $_POST["search"]["value"] . "%'";
}

if (!empty($_POST["order"])) {
    $query .= ' ORDER BY ' . $column[$_POST['order']['0']['column']] . ' ' . $_POST['order']['0']['dir'] . ' ';
} else {
    $query .= ' ORDER BY id ASC ';
}

$query1 = '';

if ($_POST["length"] != 1) {
    // for sqlserver
    if ($CFG->dbtype == 'sqlsrv') {
        $query1 .= 'OFFSET ' . $_POST['start'] . ' ROWS FETCH NEXT ' . $_POST['length'] . ' ROWS ONLY';
    } else {
        // for mysql
        $query1 .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
    }
}
$number_filter_row = 0;

$records = $DB->get_records_sql($query);
foreach ($records as $record) {
    $number_filter_row++;
}

$data = array();

// $rows = $DB->get_recordset_sql($query . $query1);
$rows = $DB->get_records_sql($query . $query1);

foreach ($rows as $row) {
    $sub_array = array();
    $sub_array[] = $row->id;
    $sub_array[] = $row->company_code;
    $sub_array[] = $row->employee_id;
    $sub_array[] = $row->prefix;
    $sub_array[] = $row->firstname;
    $sub_array[] = $row->lastname;
    $sub_array[] = $row->position;
    $sub_array[] = $row->section_branch;
    $sub_array[] = $row->department_area;
    $sub_array[] = $row->region;
    $sub_array[] = $row->division;
    $sub_array[] = $row->group;
    $sub_array[] = $row->unit;
    $sub_array[] = $row->email;
    $sub_array[] = $row->level;
    $sub_array[] = $row->cost_center;
    $sub_array[] = $row->dep_code;
    $sub_array[] = $row->methodology;
    $sub_array[] = $row->channel;
    $sub_array[] = $row->category_code;
    $sub_array[] = $row->course_code;
    $sub_array[] = $row->class_no;
    $sub_array[] = $row->desc_local;
    $sub_array[] = $row->desc_global;
    $sub_array[] = $row->start_date;
    $sub_array[] = $row->end_date;
    $sub_array[] = $row->training_hour;
    $sub_array[] = $row->training_cost;
    $sub_array[] = $row->evaluate_result;
    $sub_array[] = $row->training_institute;
    $sub_array[] = $row->training_location;
    $sub_array[] = userdate($row->timestamp, '%d %B %Y, %I:%M:%S %p');
    $data[] = $sub_array;
}

// echo $query . $query1 . "<br/>";

function count_all_data()
{
    global $DB;
    $query = "SELECT * FROM {local_lxtrainingrecords_temp}";
    $results = $DB->get_records_sql($query);

    return count($results);
}

$output = array(
    'draw'   => intval($_POST['draw']),
    'recordsTotal' => count_all_data(),
    'recordsFiltered' => $number_filter_row,
    'data'   => $data
);

echo json_encode($output);
