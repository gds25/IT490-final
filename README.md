# IT490
# Project Documentation

WHAT YOU NEED:
- Oracle VM Virtual Box
- Github Account
- Seed project:  https://github.com/gds25/IT490-final
- Ubuntu 20.04 LTS image
- ZeroTier VPN

For Each VM Machine:

Download Ubuntu disk image onto VM Virtualbox

After you have to install the following packages:
	- Php
	- Php-amqplib
	- Rabbitmq-server
	- Mysql-server
	- Apache2
	- Zerotier-cli
	- VSCode or any preferred code editor
	- IPTables
	- Openssl

Once installed, you must join each machine into a zerotier network where each VM has its own IP.

Additionally, you have to enable the rabbitmq-management plugin.

How To Setup PROD-QA-DEV Clusters:

There will be 9 machines in the cluster in total: 3 Front End, 3 Backend/Database, and 3 Development clusters.

CONFIGURING THE FRONT END

- All of the files within the Git Repo must be moved into var/www/html

- Access the SQLServer.ini within the html/SQLFiles directory

- Edit the SQLServer.ini and set the BROKER_HOST IP to the relative Backend VM’s ZeroTier IP. (So if it is a Development Front End; Set the BROKER_HOST to the Development Backend’s ZeroTier IP)

- Create a new file ‘/etc/apache2/conf-available/ssl-params.conf’ with the following:
(from https://www.arubacloud.com/tutorial/how-to-enable-https-protocol-with-apache-2-on-ubuntu-20-04.aspx)

SSLCipherSuite EECDH+AESGCM:EDH+AESGCM:AES256+EECDH:AES256+EDH
    
    SSLProtocol All -SSLv2 -SSLv3 -TLSv1 -TLSv1.1
    
    SSLHonorCipherOrder On
    
    Header always set X-Frame-Options DENY
    
    Header always set X-Content-Type-Options nosniff
    
    # Requires Apache >= 2.4
    
    SSLCompression off
    
    SSLUseStapling on
    
    SSLStaplingCache "shmcb:logs/stapling-cache(150000)"
    
    
    # Requires Apache >= 2.4.11
    
    SSLSessionTickets Off

-Use the command ‘openssl req -newkey rsa:4096 \  -x509 \  -sha256 \ -days 3650 \ -nodes \ -out CRT_PATH.crt \ -keyout KEY_PATH.key’ to create a self-signed SSL certificate

-In ‘ /etc/apache2/sites-available/default-ssl.conf’ make sure ‘SSLCertificateFile’ points to the path of your generated .crt file and ‘SSLCertificateKeyFile’ points to your .key file

-Configure your firewall to allow Ports 80, 443, and 22.

-Make sure the document root in  ‘etc/apche2/sites-available/000-default.conf’ points to var/www/html and the serverName points to your ip or a domain name of your choosing, while the VirtualHost should point to either 80 (http connection) or 443 (https)

CONFIGURING THE BACK END

-All of the files within the Git Repo must be moved into var/www/html

-Access the SQLServer.ini and DMZServer.ini within the html/SQLFiles directory

-Edit the SQLServer.ini and DMZServer.ini and set both the BROKER_HOST IP’s to the machine’s own ZeroTier IP. (This is because the machine is the brokerhost)

-Access the deployment folder in var/www/html and locate the DatabaseServer.service file

-Edit the DatabaseServer.service file and change the execution path to where DatabaseServer.php is

-Copy DatabaseServer.service to etc/systemd/system

-Start the DatabaseServer.service

-Each backend VM must create a crontab for emailScript.php that runs every 24 hours to ensure the database email list gets new anime episode releases daily

CONFIGURING THE DMZ SERVER

-All of the files within the Git Repo must be moved into var/www/html

-Access the DMZServer.ini within the html/SQLFiles directory

-Edit the DMZServer.ini and set the BROKER_HOST IP to the relative Backend VM’s ZeroTier IP. (So if it is a Development DMZ; Set the BROKER_HOST to the Development Backend’s ZeroTier IP)

-Access the deployment folder in var/www/html and locate the DMZServer.service file

-Edit the DMZServer.service file and change the execution path to where DMZServer.php is on your machine (Typically in var/www/html/SQLFiles)

-Copy DMZServer.service to etc/systemd/system

-Start the DMZServer.service

Additionally, you must access the SQLServer.ini and DMZServer.ini to ensure that you have the relative user, password, exchanges,and queues setup right on each machine’s RabbitMQ configuration

Setting up the MySQL Database:

The DatabaseServer.php holds the default username and password to access the mysql database: dran and pharmacy.

You must either create that same user in mysql or change both the information in DatabaseServer.php and in mysql cli.

Additionally, there is an animeDatabaseBackup.sql located in SQLFiles that holds all of the backed up information in our current server.

This is concurrent for ALL THREE BACKEND VMs: Production, QA, and Dev. So it must be done for all three.

Setting up the Replicated Database:

In the Git Repo, there is a file called animeDatabaseBackup.sql

Setup the VM just like you did; however, make the Production Backend VM the master server and use the Replicated Database VM as the slave server while utilizing the animeDatabaseBackup.sql to ensure both databases have the same database information.

Setting up the Deployment Server

The deployment files are found in the Git Repo under the deployment directory

This requires a separate VM setup in order to run outside of the Prod-QA-Dev Clusters

The main files are the rollout.sh for the Dev to QA and the PassFailVersion.sh for the Dev to Prod.

All the config files are set in order to transfer the respective files.

Within the rollout.sh and PassFailVersion.sh, it is important to change all the IP’s in the code to the respective Prod, QA or Dev VM and their respective OS username and login.

The rollout.sh script will prompt the user for two inputs.  The first is asking which machine is trying to test their files (FE, BE, DMZ).  This allows for each machine to create files that are not specifically for their machine in QA and Prod.  The second prompt asks for the configuration file that holds all the information necessary to complete and send a package.  This information includes the machine it is being installed to, the path of the file’s installation location, as well as listing out all the files included in the package.  

PassFailVersion.sh asks the user for a version number and if that version passed or failed. This is to indicate whether or not to push the package to prod after testing in QA.  If the user marks the version as passed, it simply follows the same procedure that the rollout.sh script did, where it uses the config file to copy files to prod, but this time copies from the deployment server since it is keeping all the specific version of the files for that package.  It will then mark the version as passed in it’s table.  If the version fails, it will revert the QA machine back to the last version that did pass, and note the failed version in its table.  

Setting up the Production Backend Firewall:

The production backend VM must be protected via a firewall

Any preferred method can be used; however, IPTables is utilized for this specific seed project

Our specific firewall blocks HTTPS and HTTP and allows outgoing UDP protocol and incoming UDP traffic on port 9993 as well as port 5672/15672 for Zerotier One and RabbitMQ communication.

More chain rules can be added depending on what level of security is needed.
