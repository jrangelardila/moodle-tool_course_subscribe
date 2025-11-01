<?php

namespace tool_course_subscribe\adhoc;

use core\task\adhoc_task;

class subscribe_course extends adhoc_task
{

    /**
     * Inscribir el usuario
     *
     * @throws \coding_exception
     * @throws \dml_exception
     * @throws \invalid_parameter_exception
     */
    public function execute()
    {
        global $CFG;

        require_once($CFG->dirroot . '/user/externallib.php');

        $data = $this->get_custom_data();
        $users = \core_user_external::get_users_by_field('email', [$data->billing->email]);
        $user = reset($users);
        if (empty($user)) {
            mtrace("El usuario no existe, creando el usuario....");
            \core_user_external::create_users([
                [
                    'username' => $data->billing->email,
                    'email' => $data->billing->email,
                    'firstname' => $data->billing->first_name,
                    'lastname' => $data->billing->last_name,
                    'password' => $data->billing->email,
                    'auth' => 'manual',
                    'phone1' => $data->billing->phone
                ]
            ]);
            $users = \core_user_external::get_users_by_field('email', [$data->billing->email]);
            $user = reset($users);
        }

        $instances = enrol_get_instances(get_config('tool_course_subscribe', 'courseid'), true);
        foreach ($instances as $instance) {
            if ($instance->enrol === 'manual') {
                mtrace("Matriculando el usuario");
                $enrol = enrol_get_plugin('manual');
                $enrol->enrol_user($instance, $user['id'], get_config('tool_course_subscribe', 'roleid'), time());
                break;
            }
        }

    }
}