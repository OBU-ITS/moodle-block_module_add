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

require_once("{$CFG->libdir}/formslib.php");
 
class module_add_form extends moodleform {

    private $modules;


    function __construct(array $modules) {
        $this->modules = $modules;
        parent::__construct();
    }


    function definition() {
        $mform =& $this->_form;
        $mform->addElement('header','displayinfo', 'Add');

        $mform->addElement('select', 'module', 'Module', $this->modules);

        $mform->addElement('filepicker', 'courses', 'Course list');
        $mform->addRule('courses', null, 'required');

        $mform->addElement('filepicker', 'moduleparams', 'Module parameters');
        $mform->addRule('moduleparams', null, 'required');

        $options = array('0'=>'Skip', '1'=>'Add new', '2'=>'Replace');
        $mform->addElement('select', 'ifexists', 'If exists', $options);

        $mform->addElement('checkbox', 'atstart', 'Add at start', 'Adds module at end of section if unchecked');

        $mform->addElement('checkbox', 'visible', 'Visible');

        $mform->addElement('filepicker', 'permsfile', 'Permissions override file');

        $this->add_action_buttons(false, 'Add module');
    }

}
