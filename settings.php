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
 * @package     tool_course_subscribe
 * @category    admin
 * @copyright   2025 Jhon Rangel <jrangelardila@gmail.com>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

if ($hassiteconfig) {
    //Site settings
    $settings = new admin_settingpage(
        'tool_course_subscribe_settings',
        new lang_string('pluginname', 'tool_course_subscribe')
    );
    // Role selector
    $roles = role_get_names(null, ROLENAME_ORIGINAL);
    $options = [];
    foreach ($roles as $roleid => $rolename) {
        $options[$roleid] = $rolename->localname;
    }
    $settings->add(new admin_setting_configselect(
        'tool_course_subscribe/roleid',
        get_string('selectrole', 'tool_course_subscribe'),
        get_string('selectrole_desc', 'tool_course_subscribe'),
        array_key_first($options),
        $options
    ));

    //Course selector
    $courses = get_courses();
    $courseoptions = [];
    foreach ($courses as $course) {
        $courseoptions[$course->id] = format_string($course->shortname . "-" . $course->fullname);
    }
    $settings->add(new admin_setting_configselect(
        'tool_course_subscribe/courseid',
        get_string('selectcourse', 'tool_course_subscribe'),
        get_string('selectcourse_desc', 'tool_course_subscribe'),
        array_key_first($courseoptions),
        $courseoptions
    ));

    $ADMIN->add('tools', $settings);
}

