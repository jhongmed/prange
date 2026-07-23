Practice Range Management System 1.4.2 Release Notes

Author: Jhong Medina
Patch Brief Description: To correct the invalid JSON error after login.
Date of Release: 07/23/2026
Release Notes — Practice Range Management System (PRMS)

Resolved a recurring “Invalid JSON response” error in the Practice Range player table (dt-basic-example), which caused the table to fail to load. Root cause was a silent json_encode() failure triggered by corrupted character data in the database, compounded by several related stability and connectivity issues discovered during investigation.


Module: rangeres.php (DataTables AJAX endpoint) and related connection files
Date: July 23, 2026
Environment: WampServer, PHP 8.3.8, MySQL

1. Silent JSON encoding failure (root cause)
Problem: A player record contained malformed UTF-8 data (a corrupted “Ñ” character in a name field). PHP’s json_encode() silently returns false when it encounters invalid UTF-8, producing a completely empty AJAX response with no error, no warning, and no log entry — which DataTables then reported as “Invalid JSON response.”
Fix: Added the JSON_INVALID_UTF8_SUBSTITUTE flag to json_encode(), so invalid byte sequences are replaced with a placeholder character instead of silently failing the entire response.
File: rangeres.php
2. Missing database charset declaration
Problem: The MySQL connection did not explicitly declare a character set, increasing risk of future encoding mismatches/corruption when reading or writing text data.
Fix: Added $mysqli->set_charset("utf8mb4"); immediately after establishing the database connection.
File: rangeres.php
3. Unhandled query failures (potential fatal errors)
Problem: Per-row and count queries were not checked for failure. On PHP 8+, passing a failed query result (false) into mysqli_fetch_assoc() throws a fatal TypeError, which — combined with issue #1 — could also produce a blank/broken response.
Fix: Added false/null guards around all mysqli_query() calls; failures are now logged via error_log() and the affected row is skipped instead of crashing the script.
File: rangeres.php
4. Output buffering safety net
Problem: Any stray warning, notice, or accidental echo anywhere in the include chain could corrupt the JSON output with extra text.
Fix: Wrapped the script in ob_start() / ob_end_clean() so only the final, clean JSON payload is ever sent to the browser.
File: rangeres.php
5. Missing JSON content-type header
Fix: Added header('Content-Type: application/json'); before output, per standard practice for AJAX JSON endpoints.
File: rangeres.php
6. SQL Server (CMSSQL) connection — DSN configuration
Problem: Initial PDO connection attempts to the CMSSQL/OrcLive SQL Server database failed due to (a) architecture mismatch between the 32-bit/64-bit ODBC driver and PHP, and (b) incorrect connection string format.
Fix: Corrected the connection to use the properly configured System DSN (odbc:CMSSQL) matching PHP’s architecture, resolving both the “could not find driver” and “architecture mismatch” errors. Final login failure (error 18456) was traced to and resolved via correct SQL Server credentials.
File: update.php (folio dropdown source)
7. mysqldump / MySQL Workbench export failure
Problem: Data Export from MySQL Workbench failed on all tables with Unknown table 'column_statistics' in information_schema (1109), caused by a version mismatch between the local mysqldump client and the older MySQL server version.
Fix: Added the --column-statistics=0 flag to the export configuration to skip the unsupported metadata query.
Scope: Tooling/export process only — no application code changed.
8. Update MySQL Server Connection
Updated MySQL Server Connection Information in the following files:

logres.php

ramgeres.php

dbtest,php

rangeres1,php


Source code:
