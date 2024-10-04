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
 * Plugin administration pages are defined here.
 *
 * @package     local_lxtrainingrecords
 * @category    admin
 * @copyright   2024 LX <komkrit@learningx.co>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

// if ($hassiteconfig) {
//     $settings = new admin_settingpage('local_lxtrainingrecords_settings', new lang_string('pluginname', 'local_lxtrainingrecords'));

//     // phpcs:ignore Generic.CodeAnalysis.EmptyStatement.DetectedIf
//     if ($ADMIN->fulltree) {
//         // TODO: Define actual plugin settings page and add it to the tree - {@link https://docs.moodle.org/dev/Admin_settings}.
//     }
// }

// ให้เมนูมันไปแสดงที่ site admin -> local plugins -> LX Points
// ต้องสร้าง db/access.php เพื่อให้ admin และ manager เข้าถึงได้
if ($hassiteconfig) { // needs this condition or there is error on login page
    $ADMIN->add('localplugins', new admin_externalpage('local_lxtrainingrecords',
            get_string('pluginname', 'local_lxtrainingrecords'),
            new moodle_url('/local/lxtrainingrecords/index.php')));
}

