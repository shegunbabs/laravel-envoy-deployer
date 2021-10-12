**Laravel Envoy Web-App Setup Script**
You can use the envoy script to

 - Setup a Laravel web application on an Ubuntu VPS Setup 
 - Nginx server bloc for the web application

**Usage**
To set up a Laravel web application (on your VPS) a domain name and a git repo url is required.

The domain name must have been registered and its A records pointed to the your VPS IP address.

*Ensure you have the correct access rights to the repo (meaning you have added you machine's ssh public key on the repo)*


    #setup Laravel application on your VPS
    user@server:~/envoy-scripts$ ./vendor/bin/envoy run www-setup --domain=example.com --git=git@bitbucket.org:username/repo.git

To setup Nginx server bloc

    #setup Nginx server bloc for your application
    user@server:~/envoy-scripts$ ./vendor/bin/envoy run nginx-setup --domain=example.com
To run both commands together

    user@server:~/envoy-scripts$ ./vendor/bin/envoy run deploy --domain=example.com --git=git@bitbucket.org:username/repo.git


Command Variables
| variable stroke | variable description |
|--|--|
| --domain=example.com | Used to specify the Laravel application domain |
| --git=git@bitbucket.org:username/repo.git | Used to specify the git repo of the web application |
| --www_path=/var/www | Used to specify the Laravel application www path. Default is /var/www |
| --php_version=8.0 | Used to specify the Laravel application php version. default is 8.0 |
| --domain=example.com | Used to specify the Laravel application domain |

