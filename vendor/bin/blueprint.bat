@ECHO OFF
setlocal DISABLEDELAYEDEXPANSION
SET BIN_TARGET=%~dp0/../rodrigopluz/blueprint/bin/blueprint
php "%BIN_TARGET%" %*
