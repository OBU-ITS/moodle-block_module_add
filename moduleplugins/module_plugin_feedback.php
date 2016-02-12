<?php

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
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Bulk course-module addition block
 *
 * @package    block_module_add
 * @author     Peter Andrew
 * @copyright  2016, Oxford Brookes University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 */

$string['pluginname'] = 'Course-Module Add';
$string['addmodule'] = 'Add module to course(s)';

require_once('module_plugin_base.php');

class module_plugin_feedback extends module_plugin_base {
    protected function module_name() {
        return 'feedback';
    }

    protected function set_module_instance_params() {
        if (isset($this->paramobj->multiple_submit)) {
            $this->moduleobj->multiple_submit = (int)$this->paramobj->multiple_submit;
        } else {
            $this->moduleobj->multiple_submit = 0;
        }
        if (isset($this->paramobj->anonymous)) {
            $this->moduleobj->anonymous = (int)$this->paramobj->anonymous;
        } else {
            $this->moduleobj->anonymous = 1;
        }
        if (isset($this->paramobj->email_notification)) {
            $this->moduleobj->email_notification = (int)$this->paramobj->email_notification;
        } else {
            $this->moduleobj->email_notification = 0;
        }
        $this->moduleobj->autonumbering = 0;
        $this->moduleobj->page_after_submit = '';

        return array(true, '');
    }

    function post_create_setup() {
        global $DB;

        $feedback = $DB->get_record('feedback', array('id'=>$this->moduleobj->instance), '*');
        feedback_items_from_template($feedback, (int)$this->paramobj->template);

        return array(true, '');
    }

    static function check_params_xml($paramsxmlobj) {
        if (empty($paramsxmlobj->title) || empty($paramsxmlobj->description) || (int)$paramsxmlobj->template < 1) {
            return false;
        }
        if (isset($paramsxmlobj->multiple_submit) && (int)$paramsxmlobj->multiple_submit != 0 && (int)$paramsxmlobj->multiple_submit != 1) {
            return false;
        }
        if (isset($paramsxmlobj->anonymous) && (int)$paramsxmlobj->anonymous != 1 && (int)$paramsxmlobj->anonymous != 2) {
            return false;
        }
        if (isset($paramsxmlobj->email_notification) && (int)$paramsxmlobj->email_notification != 0 && (int)$paramsxmlobj->email_notification != 1) {
            return false;
        }

        return true;
    }
}
