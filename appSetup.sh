#!/bin/sh
echo "moving the folder from app/code/ to appbkup/code/"
echo "====================================>"
mv app/code/* appbkup/code/
echo "done"
echo "moving the folder from appbkup to app"
echo "====================================>"
mv appbkup/* app/
echo "done"
mv appbkup/.htaccess app/
echo "Providing Permission to app folder"
echo "====================================>"
chmod -R 777 app
echo "Done"
cd app
echo "git ignoring file permission"
echo "====================================>"

git config core.fileMode false
echo "Done"
