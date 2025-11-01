<?php

namespace tool_course_subscribe\external;

defined('MOODLE_INTERNAL') || die();


use core_external\external_api;
use core_external\external_function_parameters;
use core_external\external_single_structure;
use core_external\external_value;
use tool_course_subscribe\adhoc\subscribe_course;

class subscribe extends external_api
{

    /**
     * @return external_function_parameters
     */
    public static function execute_parameters()
    {
        return new external_function_parameters([]);
    }

    /**
     * Crear adhoc task
     *
     * @return true[]
     */
    public static function execute()
    {
        global $CFG;

        require_once($CFG->dirroot . '/user/lib.php');
        require_once($CFG->dirroot . '/user/externallib.php');

        $raw = file_get_contents('php://input');
        $payload = json_decode($raw, true);
        $task = new subscribe_course();
        $task->set_custom_data($payload);
        \core\task\manager::queue_adhoc_task($task);

        return ['status' => true];
    }

    /**
     * @return external_single_structure
     */
    public static function execute_returns()
    {
        return new external_single_structure([
            'status' => new external_value(PARAM_BOOL, 'True si se procesó correctamente'),
        ]);
    }

}