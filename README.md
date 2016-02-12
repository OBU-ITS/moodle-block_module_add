# Bulk course-module addition block
This Moodle block allows modules to be bulk added to a supplied list of courses.

The block supports a number of different module types - currently book, database, feedback, and page - and has a plugin architecture that allows for future support of others.

The block takes a CSV file listing the courses and an XML file giving the module parameters. If the XML file contains a single set of parameters then these are used to initialise all module instances. If the XML file contains a set of parameters per course then each module instance is uniquely initialised.

The block can optionally take a CSV file of permissions overrides so that the default inherited permissions can be overridden. These overrides apply to all module instances.

The block checks for the existance of modules of the same type and name on each course and depending on the option selected will skip the course, add a new instance of the module, or replace the existing instance.

It is also possible to specify whether each module should be added at the start or end of the first section and whether it should be initially visible or not.


The plugin should be installed in a directory named module_add within the Moodle blocks directory.
