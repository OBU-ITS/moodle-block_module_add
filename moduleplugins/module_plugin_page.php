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

class module_plugin_page extends module_plugin_base {
    
    protected function module_name() {
        return 'page';
    }

    protected function set_module_instance_params() {
        $this->moduleobj->display = 0; // Display auto
        if ($this->paramobj) {
            $text = (string) $this->paramobj->text;
        } else {
            $text = '';
        }
        $this->moduleobj->page = array('itemid'=>0, 'text'=>$text, 'format'=>1);
        $this->moduleobj->printheading = 1;
        $this->moduleobj->printintro = 0;

        return array(true, '');
    }

    protected function get_num_instance_function_params() {
        return 2;
    }

    static function check_params_xml($paramsxmlobj) {
        if (empty($paramsxmlobj->title) || empty($paramsxmlobj->description) || empty($paramsxmlobj->text)) {
            return false;
        }
        return true;
    }
    
}
