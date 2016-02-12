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

require_once('../../config.php');

global $PAGE;
$PAGE->set_url('/blocks/module_add/help_page.php');
$PAGE->set_context(get_context_instance(CONTEXT_SYSTEM));
$PAGE->set_pagelayout('standard');
$PAGE->set_title(get_string('addmodule', 'block_module_add'));
$PAGE->set_heading(get_string('addmodule', 'block_module_add'));

global $OUTPUT;
echo $OUTPUT->header();
echo $OUTPUT->heading(get_string('addmodule', 'block_module_add'));

echo '<p>Currently modules will be added to first (summary) section of each course.</p>';
echo '<h3 style="margin-top: 1.5em;">Course list</h3>';
echo '<p>Each row of the course list file should have the fields: Course ID,"Module Code"</p>';
echo '<p>Course ID or Module Code may be given. If Course ID is not known supply 0, if Module Code not know supply empty string. If both are given, Course ID is used. If more than one course exists with same Module Code, module is added to each course.</p>';
echo '<h3 style="margin-top: 1.5em;">Module parameters</h3>';
echo '<p>The module parameters XML file specifies how each course module will be instantiated. The generic structure is:</p>';
echo '<p>&lt;paramitems&gt;<br />';
echo '<span style="padding: 10px;">&lt;paramitem&gt;</span><br />';
echo '<span style="padding-left: 20px;">&lt;title&gt;Some title&lt;/title&gt;</span><br />';
echo '<span style="padding-left: 20px;">&lt;description&gt;A description&lt;/description&gt;</span><br />';
echo '<span style="padding-left: 10px;">&lt;/paramitem&gt;</span><br />';
echo '&lt;paramitems&gt;</p>';
echo '<p>If a single paramitem is given, these values are used for each course module. Otherwise a separate paramitem must be given for each row in the course list file</p>';
echo '<p>Each module type has a different number of additional values that must be given in each paramitem. These are:</p>';
echo '<h4>Book</h4>';
echo '<p>&lt;numbering&gt;none|bullets|numbers|indented&lt;numbering&gt;<br />';
echo '&lt;chapters&gt;<br />';
echo '<span style="padding: 10px;">&lt;chapter&gt;</span><br />';
echo '<span style="padding: 20px;">&lt;title&gt;A ttile&lt;/title&gt;</span><br />';
echo '<span style="padding: 20px;">&lt;content&gt;&lt;![CDATA[HTML content]]&gt;&lt;/content&gt;</span><br />';
echo '<span style="padding: 20px;">&lt;subchapters&gt; {optional}</span><br />';
echo '<span style="padding: 30px;">Chapter tags as before but without subchapters</span><br />';
echo '<span style="padding: 20px;">&lt;/subchapters&gt;</span><br />';
echo '<span style="padding: 10px;">&lt;/chapter&gt;</span><br />';
echo '&lt;/chapters&gt;</p>';
echo '<h4>Data</h4>';
echo '<p>&lt;preset&gt;A database preset&lt;/preset&gt;</p>';
echo '<h4>Feedback</h4>';
echo '<p>&lt;template&gt;A feedback template number&lt;/template&gt;</p>';
echo '<p>&lt;multiple_submit&gt;0 or 1&lt;/multiple_submit&gt; {optional} defaults to single submission</p>';
echo '<p>&lt;anonymous&gt;1 - anonymous or 2 - not anonymous&lt;/anonymous&gt; {optional} defaults to anonymous</p>';
echo '<p>&lt;email_notification&gt;0 or 1&lt;/email_notification&gt; {optional} defaults to off</p>';
echo '<h4>Page</h4>';
echo '<p>&lt;text&gt;&lt;[CDATA[HTML content]]&gt;&lt;/text&gt;</p>';
echo '<h3 style="margin-top: 1.5em;">Permissions override file</h3>';
echo '<p>Allows the inherited permissions for a module to be overridden</p>';
echo '<p>Permissions override file, CSV format: Role ID,"Capability Name","Permission"<p>';
echo '<p>Permission should be "allow" or "prevent"</p>';
echo '<p style="margin-top: 2em;"><a href="controller.php">Back to add module form</a></p>';

echo $OUTPUT->footer();
