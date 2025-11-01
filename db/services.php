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
        // 'capabilities' => 'moodle/course:view'
    ]
];

$services = [
    'Course Subscribe Service' => [
        'functions' => ['tool_course_subscribe_subscribe'],
        'restrictedusers' => 0,
        'enabled' => 1,
    ]
];
