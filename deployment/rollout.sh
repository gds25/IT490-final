#!/bin/bash/

#set a version variable
version=1

#mysql login and db stuff
user=bash
password=1234
database=deployment

#TODO:
#   Need to be able to input the package name(maybe like 3 packages/machine?)
#   Differentiate between packages, and different machines(FE, BE, DMZ)(Only the three in QA really)
#   

while :
do
    if [ ! -d "v$version" ]; then
    mkdir "v$version"
    cd v$version
    
    
    #get from dev
    sshpass -v -p "test" scp test@172.28.125.110:~/Desktop/SQLFiles.zip ~/deployment/v$version/SQLFiles.zip 
    #zip files
    #zip -r SQLFiles.zip ~/deployment/v$version/SQLFiles/
    #remove files from qa
    ssh testqa@172.28.231.181 "rm -r ~/DeploymentTestFolder/*"
    #send to QA(testqa)
    
    sshpass -v -p "test" scp ~/deployment/v$version/SQLFiles.zip testqa@172.28.231.181:~/DeploymentTestFolder/
    
    ssh testqa@172.28.231.181 "unzip DeploymentTestFolder/SQLFiles.zip -d ~/DeploymentTestFolder/"
    echo Pushed Version: $version 
    #mysql update table

    mysql --user="$user" --password="$password" --database="$database" --execute="INSERT INTO versionHistory (version, location, passed) VALUES ($version, \"backend\", NULL);"
    
    #restart any services that are running on that machine 

        #FE: apache (Working)
        #echo 'test' | ssh -t -t testqa@172.28.231.181 "sudo systemctl restart apache2"
        #echo apache restarted
        
        #manage php scripts through systemd
        #manually pass/fail each version 
        #
        #BE: Mysql, DBServer.php
        #echo 'test' | ssh -t -t testqa@172.28.231.181 "sudo pkill -9 php"
        #echo 'test' | ssh -t -t testqa@172.28.231.181 "php ~/DeploymentTestFolder/DatabaseServer.php" &
        #echo Database Server restarted

        #DMZ: DMZServer.php
        echo 'test' | ssh -t -t testqa@172.28.231.181 "sudo systemctl restart DMZService.service"
        echo "DMZ Server restarted :)"
        
    break 
    else
        let "version=version+1"
    fi

    
done



