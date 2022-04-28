#!/bin/bash/

#mysql login and db stuff
user=bash
password=1234
database=deployment


echo "Please enter the version number: "
read version
#echo "Where did it install?(FE, BE, DMZ)?: $location"
echo "Did it pass(p) or fail(f)?: "
read passFail

if [ $passFail == "p" ]; then
    echo cool, updating database TO PASSED...
    mysql --user="$user" --password="$password" --database="$database" --execute="UPDATE versionHistory SET passed = True WHERE version = $version;"
    echo "updated :)"
    echo "Here is where we would then push to Prod, just not setup"
    #TODO: Push to prod
else
    echo alright, updating database to FAILED...
    mysql --user="$user" --password="$password" --database="$database" --execute="UPDATE versionHistory SET passed = False WHERE version = $version;"
    echo "updated :("
    newVersion=$(mysql --user="$user" --password="$password" --database="$database" --execute="SELECT version FROM versionHistory WHERE version = (SELECT MAX(version) FROM versionHistory WHERE passed = true);")
    
    vars=( $newVersion )
    temp="${vars[1]}"

    echo "going to roll back to the last passed version($temp)..."

    #remove files from qa
    ssh testqa@172.28.231.181 "rm -r ~/DeploymentTestFolder/*"
    #send to QA(testqa)
    
    sshpass -v -p "test" scp ~/deployment/v$temp/SQLFiles.zip testqa@172.28.231.181:~/DeploymentTestFolder/
    
    ssh testqa@172.28.231.181 "unzip DeploymentTestFolder/SQLFiles.zip -d ~/DeploymentTestFolder/"
    echo Pushed Previous Version: $temp 

    #DMZ: DMZServer.php
    echo 'test' | ssh -t -t testqa@172.28.231.181 "sudo systemctl restart DMZService.service"
    echo "DMZ Server restarted :)"

fi
