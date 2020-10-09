@ECHO OFF
setlocal DISABLEDELAYEDEXPANSION
SET BIN_TARGET=%~dp0/../rodrigopluz/combustor/bin/combustor.php
php "%BIN_TARGET%" %*
