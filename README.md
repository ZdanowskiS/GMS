# GMS
Genie Managment System

GMS is based on LMS architecture and is addressed to LMS users.

Working with PostgreSQL database. It allows storing some customer data and CPE configuration.
Therfore GMS can be used on its own without LMS. At the same time it is not meant to replace Lan Management System or any similar solution.
Data from other systems can be copied and managed using customer _externalid_.

# Installation
1. Configure Apache2 virtual host.
2. Create database, add database structure.
3. Add Smarty to GMS directory.

# Functionality
1. GMS can storage some customer and CPE informations including configuration.
2. GMS allows creating multiple actions for configuring different CPE functions.
3. GMS can set configuration from web page.

GMS can't send configuration to CPE on GenieACS request. This functionality requires additional communication API. API can be based on solution available in LightCSV-Genieacs.

# Support

For support options contact by mail: sylwesterzdanowski[at]gmail.com
