@ECHO OFF
setlocal DISABLEDELAYEDEXPANSION
SET BIN_TARGET=%~dp0/../rodrigopluz/combustor/bin/combustor
php "%BIN_TARGET%" %*
