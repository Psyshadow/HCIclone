# Subfolder for the learndash/wordpress platform

## Clone this repository
to clone the repository add a ssh key to your github settings. A ssh key can be generated with the following command (on linux):
```
ssh-keygen
```
The ssh key is saved in `~/.ssh/id_rsa.pub` by default.

After installing the ssh key to github go ahead and clone the repo to the home directory:
```
cd && git clone git@github.com:eth-ait/hci-project-group9.git
```

## Installation
To run wordpress it is easiest to use the XAMP(X-Platform Apache MySQL PHP) stack. Easiest way is to download [https://www.apachefriends.org/index.html](XAMPP).

### Serve Wordpress
Wordpress is served form a subfolder of the xampp installation (in linux it is `/opt/lampp/htdocs`. The wordpress folder with its plugins etc. is located in our github repo and can be symlinked to this location.

Create symlink to wordpress folder:
```
cd /opt/lampp/htdocs && ln -s ~/hci-project-group9/wordpress
```
