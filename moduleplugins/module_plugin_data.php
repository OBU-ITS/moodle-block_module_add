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

class module_plugin_data extends module_plugin_base {
    protected function module_name() {
        return 'data';
    }

    protected function set_module_instance_params() {
        return array(true, '');
    }

    function post_create_setup() {
        global $DB;

        $course = $DB->get_record('course', array('id'=>$this->moduleobj->course), '*');
        $data = $DB->get_record('data', array('id'=>$this->moduleobj->instance), '*');
        $cm = $DB->get_record('course_modules', array('id'=>$this->moduleobj->coursemodule), '*');
        $data->instance = $data->id;
        $importer = new data_preset_existing_importer($course, $cm, $data, $this->paramobj->preset);
        $importer->import(false);

        return array(true, '');
    }

    static function check_params_xml($paramsxmlobj) {
        if (empty($paramsxmlobj->title) || empty($paramsxmlobj->description) || empty($paramsxmlobj->preset)) {
            return false;
        }
        return true;
    }
}
