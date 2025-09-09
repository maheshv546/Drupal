Drupal Voya Site Code Structure
The `.github` folder contains all the workflow actions.

The `workflow` folder holds all workflow-related files.

The first request in Drupal is handled by `index.php`, which routes it to other files.

The `core` folder contains all Drupal core modules, themes, and related files.

The `modules` folder has two subfolders:

- `contrib`: contains contributed modules from drupal.org.

- `custom`: contains custom modules developed by us.

The `sites.php` file is used to support multisite architecture.

Resource Center Site
We usually make two types of content-related changes:

- Updates to the “Type of Investor.”

- Uploading images.

First, make the changes in the ACCP site, and once completed, send them for validation through ServiceNow.

To update the Investor Type content, go to: `admin/config/voya-fs/investor_type`

The “Effective Date” mentioned in the document specifies when the changes should be applied to the live site.

To add images, navigate to: `Add media -> Image`.

After adding the image, go to `Edit`, copy the image URL from the address bar, and send the image path in ServiceNow.