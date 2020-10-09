@ECHO OFF
setlocal DISABLEDELAYEDEXPANSION
SET BIN_TARGET=%~dp0/../rodrigopluz/blueprint/bin/blueprint.php
php "%BIN_TARGET%" %*
