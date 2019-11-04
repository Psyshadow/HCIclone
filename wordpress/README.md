# Subfolder for the learndash/wordpress platform

## Clone this repository
to clone the repository add a ssh key to your github settings. A ssh key can be generated with the following command:

Linux:
```
ssh-keygen
```
The ssh key is saved in `~/.ssh/id_rsa.pub` by default.

After installing the ssh key to github go ahead and clone the repo to the home directory:
```
cd && git clone git@github.com:eth-ait/hci-project-group9.git
```

Windows:
TODO

## Installation
To install wordpress it is easiest to use the XAMP(X-Platform Apache MySQL PHP) stack. Easiest way is to download [XAMPP](https://www.apachefriends.org/index.html). XAMPP is available for Windows, Mac and Linux.

### Link the github folder to the server
Wordpress is served form a subfolder of the xampp installation (in linux it is `/opt/lampp/htdocs`). The wordpress folder with its plugins etc. is located in our github repo and can be symlinked to this location.

Create symlink to wordpress folder:

Linux:
```
cd /opt/lampp/htdocs && ln -s ~/hci-project-group9/wordpress
```

Windows:
TODO

## Run the website
Run the xampp stack:
Linux:
```
cd /opt/lampp && sudo ./manager-linux-x64.run
```
or add a function to the `.bashrc`:
```
function runWordpress(){
  sudo ./opt/lampp/manager-linux-x64.run
}
```

Windows:
TODO

### Navigate to website
The website can be found at the followin url: `localhost/wordpress/`
To log in to the admin interface use the following url: `localhost/wordpress/wp-admin`

## Contribution
Be aware of the git workflow:
* Main development branch is `develop`
* To develop features use a new branch called `feature/<feature_name>`.
* Merge features to develop
* Merge develop to master only for complete prototype versions

## Users
* MySQL:
  * server: sfk2019.ch
  * user: administrator 
  * password: 123456

## Further Links
* [Learndash Bootcamp](http://localhost/wordpress/wp-admin/admin.php?page=learndash_lms_overview)
* [Chart.js](https://www.chartjs.org/docs/latest/)
* [User management](https://de.wordpress.org/plugins/wp-user-manager/)
* [Wordpress Plugins](https://developer.wordpress.org/plugins/intro/what-is-a-plugin/)
