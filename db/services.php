<?php


defined('MOODLE_INTERNAL') || die();

$functions = [
    'tool_course_subscribe_subscribe' => [
        'classname' => 'tool_course_subscribe\external\subscribe',
        'methodname' => 'execute',
        'classpath' => '',
        'description' => get_string('tool_course_subscribe', 'service_desc'),
        'type' => 'write',
        'ajax' => true,

    ],
    'tool_course_subscribe_get_allcourses' => [
        'classname' => 'tool_course_subscribe\external\get_courses',
        'methodname' => 'execute',
        'classpath' => '',
        'description' => get_string('tool_course_subscribe', 'get_courses_desc'),
        'type' => 'write',
        'ajax' => true,

    ]
];

$services = [
    'Course Subscribe Service' => [
        'functions' => ['tool_course_subscribe_subscribe', 'tool_course_subscribe_get_allcourses'],
        'restrictedusers' => 0,
        'enabled' => 1,
    ]
];
