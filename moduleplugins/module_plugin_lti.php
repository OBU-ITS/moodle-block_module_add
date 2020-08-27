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
 * Bulk course-module addition block - LTI activity
 *
 * @package    block_module_add
 * @author     Peter Welham
 * @copyright  2020, Oxford Brookes University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 */

$string['pluginname'] = 'Course-Module Add';
$string['addmodule'] = 'Add module to course(s)';

require_once('module_plugin_base.php');

class module_plugin_lti extends module_plugin_base {
    protected function module_name() {
        return 'lti';
    }

    protected function set_module_instance_params() {

        if (isset($this->paramobj->typeid)) {
            $this->moduleobj->typeid = (int)$this->paramobj->typeid;
        } else {
            $this->moduleobj->typeid = 0;
        }

        // Optional parameters
		if (isset($this->paramobj->sendname)) {
            $this->moduleobj->instructorchoicesendname = (int)$this->paramobj->sendname;
		}
        if (isset($this->paramobj->sendemailaddr)) {
            $this->moduleobj->instructorchoicesendemailaddr = (int)$this->paramobj->sendemailaddr;
		}
        if (isset($this->paramobj->allowroster)) {
            $this->moduleobj->instructorchoiceallowroster = (int)$this->paramobj->allowroster;
		}
        if (isset($this->paramobj->allowsetting)) {
            $this->moduleobj->instructorchoiceallowsetting = (int)$this->paramobj->allowsetting;
		}
        if (isset($this->paramobj->customparameters)) {
            $this->moduleobj->instructorcustomparameters = $this->paramobj->customparameters;
        } else {
            $this->moduleobj->instructorcustomparameters = "";
        }
        if (isset($this->paramobj->acceptgrades)) {
            $this->moduleobj->instructorchoiceacceptgrades = (int)$this->paramobj->acceptgrades;
		}
		if (isset($this->paramobj->grade)) {
            $this->moduleobj->grade = (int)$this->paramobj->grade;
        }
		if (isset($this->paramobj->debuglaunch)) {
            $this->moduleobj->debuglaunch = (int)$this->paramobj->debuglaunch;
        }
		if (isset($this->paramobj->showtitlelaunch)) {
            $this->moduleobj->showtitlelaunch = (int)$this->paramobj->showtitlelaunch;
        }
		if (isset($this->paramobj->showdescriptionlaunch)) {
            $this->moduleobj->showdescriptionlaunch = (int)$this->paramobj->showdescriptionlaunch;
        }

        return array(true, '');
    }

    protected function get_num_instance_function_params() {
        return 2;
    }

    static function check_params_xml($paramsxmlobj) {
        if (empty($paramsxmlobj->title) || empty($paramsxmlobj->description) || (int)$paramsxmlobj->typeid < 0) {
            return false;
        }

        return true;
    }
}
