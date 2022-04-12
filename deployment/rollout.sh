#!/bin/bash/

#set a version variable
version=1

#mysql login and db stuff
user=bash
password=1234
database=deployment

while :
do
    if [ ! -d "v$version" ]; then
    mkdir "v$version"
    cd v$version
    
    echo $version
    #get from dev
    sshpass -v -p "test" scp test@172.28.125.110:~/Desktop/SQLFiles.zip ~/deployment/v$version/SQLFiles.zip 
    #zip files
    #zip -r SQLFiles.zip ~/deployment/v$version/SQLFiles/

    ssh testqa@172.28.231.181 "rm -r ~/DeploymentTestFolder/*"
    #send to QA(testqa)
    
    sshpass -v -p "test" scp ~/deployment/v$version/SQLFiles.zip testqa@172.28.231.181:~/DeploymentTestFolder/
    
    ssh testqa@172.28.231.181 "unzip DeploymentTestFolder/SQLFiles.zip -d ~/DeploymentTestFolder/"
    #TODO:mysql update table

    mysql --user="$user" --password="$password" --database="$database" --execute="INSERT INTO versionHistory (version, location, passed) VALUES ($version, \"backend\", False);"
    
    #restart any services that are running on that machine 
        #FE: apache
        #BE: Mysql, DBServer.php, rabbit(?)
        #DMZ: DMZServer.php?
    break 
    else
        let "version=version+1"
    fi
done



