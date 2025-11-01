<?php

namespace tool_course_subscribe\external;

use core_external\external_api;
use core_external\external_function_parameters;
use core_external\external_multiple_structure;
use core_external\external_single_structure;
use core_external\external_value;

defined('MOODLE_INTERNAL') || die();

require_once("$CFG->libdir/externallib.php");

class get_courses extends external_api
{

    /**
     * Define los parámetros de entrada (en este caso, ninguno).
     * @return external_function_parameters
     */
    public static function execute_parameters()
    {
        return new external_function_parameters([]);
    }

    /**
     * @return array
     * @throws \coding_exception
     * @throws \dml_exception
     * @throws \invalid_parameter_exception
     */
    public static function execute()
    {
        global $DB;

        self::validate_parameters(self::execute_parameters(), []);

        $courses = $DB->get_records('course', ['visible' => 1]);

        $result = [];
        foreach ($courses as $course) {
            $result[] = [
                'id' => $course->id,
                'shortname' => $course->shortname,
                'fullname' => $course->fullname,
                'summary' => format_text($course->summary, FORMAT_HTML),
            ];
        }

        return $result;
    }

    /**
     * @return external_multiple_structure
     */
    public static function execute_returns()
    {
        return new external_multiple_structure(
            new external_single_structure([
                'id' => new external_value(PARAM_INT, 'ID del curso'),
                'shortname' => new external_value(PARAM_TEXT, 'Nombre corto del curso'),
                'fullname' => new external_value(PARAM_TEXT, 'Nombre completo del curso'),
                'summary' => new external_value(PARAM_RAW, 'Resumen del curso'),
            ])
        );
    }
}
