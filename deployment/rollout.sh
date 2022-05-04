#!/bin/bash/

#set a version variable
version=1

#mysql login and db stuff
user=bash
password=1234
database=deployment

#get basic info file
echo "Please enter the dev machine(FE, BE, DMZ): "
read machine
#echo "Where did it install?(FE, BE, DMZ)?: $location"
echo "Please Enter the config File Name: "
read configFile
#="frontEndFiles.config"
if [ $machine == "FE" ]; then
    path="~/Desktop/IT490"
else
    if [ $machine == "BE" ]; then
        path="~/Desktop/IT490"
    else
        #is DMZ
        path="~/Desktop/IT490"
    fi
fi
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
    #sshpass -v -p "test" scp test@172.28.125.110:~/Desktop/SQLFiles.zip ~/deployment/v$version/SQLFiles.zip 

    #copy config file into folder
    sshpass -v -p "test" scp test@172.28.125.110:$path/frontEndFiles.config ~/deployment/v$version/$configFile 
    #read file into array
    IFS=$'\n' read -d '' -r -a lines < $configFile
    #get each file outlined in config
    pkgName=${lines[2]}
    installLoc=${lines[4]}
    services=${lines[6]}
    length=${#lines[@]}
    for ((i=8; i<${length}; i++));
        do
            echo copying ${lines[i]} from dev...
            sshpass -v -p "test" scp test@172.28.125.110:$path//${lines[i]} ~/deployment/v$version/${lines[i]} 
        done


    #zip files
    zip -r -j $pkgName ~/deployment/v$version/* -x "*.config"
    
    #remove files from qa
    for ((i=6; i<${length}; i++));
        do
            echo deleting ${lines[i]} from QA...
            ssh testqa@172.28.231.181 "rm -r ~/DeploymentTestFolder/${lines[i]}"
        done
    
    #send to QA(testqa)
    echo sending $pkgName to QA...
    sshpass -v -p "test" scp ~/deployment/v$version/$pkgName.zip testqa@172.28.231.181:$installLoc
    ssh testqa@172.28.231.181 "unzip $installLoc/$pkgName.zip -d $installLoc"
    ssh testqa@172.28.231.181 "rm -r $installLoc/$pkgName.zip"
    echo Pushed Version: $version 
    #mysql update table

    mysql --user="$user" --password="$password" --database="$database" --execute="INSERT INTO versionHistory (version, pkgName, passed) VALUES ($version, \"$pkgName\", NULL);"
    
    #restart any services based on config 

    if [ $services == "apache" ]; then
        #FE: apache 
        echo 'test' | ssh -t -t testqa@172.28.231.181 "sudo systemctl restart apache2"
        echo apache restarted
    elif [ $services == "databaseServer" ]; then
        #BE: DBServer.php
        echo 'test' | ssh -t -t testqa@172.28.231.181 "sudo systemctl restart DatabaseService.service"
        echo "Database Server restarted :)"
        echo Database Server restarted
    elif [ $services == "databaseServer" ]; then
        #BE: Mysql
        echo 'test' | ssh -t -t testqa@172.28.231.181 "sudo systemctl restart mysql"
        echo mysql restarted
    elif [ $services == "DMZServer" ]; then
        DMZ: DMZServer.php
        echo 'test' | ssh -t -t testqa@172.28.231.181 "sudo systemctl restart DMZService.service"
        echo "DMZ Server restarted :)"
    fi
        
        
    break 
    else
        let "version=version+1"
    fi

    
done



