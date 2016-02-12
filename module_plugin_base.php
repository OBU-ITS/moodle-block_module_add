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

abstract class module_plugin_base {
    protected $paramobj;
    protected $moduleobj;

    function __construct($paramobj, $moduleobj) {
        $this->paramobj = $paramobj;
        $this->moduleobj = $moduleobj;
    }

    function create_instance() {
        // Include module lib
        $modlib = '../../mod/' . $this->module_name() . '/lib.php';
        if (file_exists($modlib)) {
            global $CFG;
            require_once($modlib);
        } else {
            return array(false, 'Module lib not found');
        }

        $ret = $this->set_module_instance_params();
        if (!$ret[0]) {
            return $ret;
        }

        // Add instance and update course_modules DB row
        $addinstancefunction = $this->module_name() . '_add_instance';
        if ($this->get_num_instance_function_params() == 1) {
            $returnfromfunc = $addinstancefunction($this->moduleobj);
        } else {
            $returnfromfunc = $addinstancefunction($this->moduleobj, true);
        }
        if (!$returnfromfunc or !is_number($returnfromfunc)) {
            // undo everything we can
            $modcontext = context_module::instance($this->moduleobj->coursemodule);
            $modcontext->delete();
            $DB->delete_records('course_modules', array('id'=>$this->moduleobj->coursemodule));
    
            if (!is_number($returnfromfunc)) {
                return array(false, "$addinstancefunction is not a valid function");
            } else {
                return array(false, 'Cannot add new module');
            }
        }
        $this->moduleobj->instance = $returnfromfunc;

        return array(true, '');
    }

    /* The add instance function for some modules takes a different number
        of parameters */
    protected function get_num_instance_function_params() {
        return 1;
    }

    function post_create_setup() {
        return array(true, '');
    }

    abstract protected function module_name();

    abstract protected function set_module_instance_params();

    static abstract function check_params_xml($paramsxmlobj);
}
