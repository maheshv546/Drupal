	1.	All configuration is stored in the codebase.
	2.	All content types are saved as configuration and exported in YAML (.yml) format.
	3.	Content type configurations are placed in the module folder:
modules/custom/module_name/config/install/content_type.yml.
	4.	Configuration can be exported by logging into Admin → Development → Configuration Synchronization → Export → Single Item.
	•	Select the type of configuration.
	•	Copy the exported YAML.
	•	Create a file with the filename specified in the export screen.
	5.	Each content type has a separate role associated with it.
	6.	All custom blocks are created in custom code under:
modules/custom/module_name/src/Plugin/Block/BlockName.php.
	7.	Top-level and secondary navigation menus are created in the Main Navigation menu.
	8.	The Voya Header block is placed in the Header region in Block Layout so that it is available on all pages.
	9.	Voya.com specific files are stored under:
docroot/sites/www/.
	10.	If a change is made to an existing configuration, the existing YAML file must be updated.
	11.	Always check Drupal system requirements (PHP version, database, etc.) before applying updates.
	12.	The project has three environments:
	•	INTG (Integration)
	•	ACCP (Acceptance)
	•	LIVE (Production)
	13.	New Relic on Pantheon is used to monitor:
	•	Number of active users.
	•	Site outages.
	•	Logs are reviewed by the Pantheon team in New Relic.
	14.	Daily AM tasks are defined in the wiki page of the Voya GitHub repository.