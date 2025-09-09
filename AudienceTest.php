Drupal voya site code structure

1. .github - has all the workflow actions.
2. Workflow - All workflow related files are there in this folder.
3. First call in drupal will go to index.php then it will be routed to all other files.
4. Core folder has all the drupal core related modules, themes etc..
5. Modules has two folders one is contrib where the modules are provided from drupal.org and other one custom where the modules are created by us.
6. sites.php file is used to support multisite architecture.

Resource center site

1. We have usually two content related changes one is Type of Investor updates other one Uploading images. 
2. First we need to make the changes in accp site for content chnages, once done send for validation through servicenow.
3. Inorder to update Investror typre content we need to go admin/config/voya-fs/investor_type
4. Effective date in the document is the one specifies when the chnages to be done on live site. 
5. Inorder Add images go to Add media->image.
6. Once the image is added we can send the image path by going to Edit->take the url of the image->Copy the addres and send the image path in servicenow. 
