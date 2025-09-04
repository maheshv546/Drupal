1. All the configuration is stored in codebase.
2. All the content types are saved as configuration and exported in yml format.
3. All the content type configuration are in content module inside yml file(modules/custom/module_name/config/install/content_type.yml).
4. This Configuration can be exported after logging into admin->Development->export->singleitem->select type of configuration->copy the code and create file with the filename specified here.
5. Each content type has a separate role.
6. All the custom blocks are created in custom code(modules/custom/module_name/src/plugin/block/blockname.php).
7. Top level and secondary menus are created in Main Navigation menu.
8. Voya header block is placed in header region in block layout since it should be available in all the pages.
9. Voya.com specific files are added inside docroot/sites/www folder.
10. If change is made for already existing config we need to update that existing file.
11. Need to check drupal version system requirements for php_version, database etc...
12. We have 3 environments intg, accp and live environment.
13. New Relic in pantheon is used to check number of users currently active and any outage in the site pantheon team will check the logs in Relic.
14. Daily AM task are defined in wikipage og voya github.
