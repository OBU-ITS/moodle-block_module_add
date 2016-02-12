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

class block_module_add extends block_base {
    
    function init() {
        $this->title = get_string('pluginname', 'block_module_add');
    }


    function get_content() {
        if ($this->content !== null) {
            return $this->content;
        }

        $this->content = new stdClass;
        $this->content->text = '';
        $this->content->footer = '';

        if (has_capability('moodle/site:config', context_system::instance())) {
            $this->content->text = html_writer::link('blocks/module_add/controller.php', 'Add module to course(s)');
        }

        return $this->content;
    }


    function applicable_formats() {
        return array('site-index' => true);
    }

}


