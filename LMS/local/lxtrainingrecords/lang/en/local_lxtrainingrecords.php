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
 * Plugin strings are defined here.
 *
 * @package     local_lxtrainingrecords
 * @category    string
 * @copyright   2024 LX <komkrit@learningx.co>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['pluginname'] = 'LX Training records';
$string['title'] = 'Training records';
$string['report'] = 'Report training records';
$string['lxtrainingrecords:role'] = 'Role';

$string['capability'] = '🚫 You do not have permission to view this page';
$string['eventreceived'] = 'User enrolled';
$string['eventreceiveddesc'] = "The user with id '{\$a->userid}' enrolled the course with id '{\$a->courseid}'";
$string['eventfailed'] = 'Failed enrol';
$string['eventfaileddesc'] = "The user with id '{\$a->userid}' can't enroll twice in same course with id '{\$a->courseid}'";
$string['enrol'] = 'LX Training recorded';
$string['addform'] = 'Add a new enrol course';
$string['editform'] = 'Edit enrol course';


