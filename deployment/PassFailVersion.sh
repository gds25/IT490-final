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
    #get package name of last passed
    pkg=$(mysql --user="$user" --password="$password" --database="$database" --execute="SELECT pkgName FROM versionHistory WHERE version = $version;")
    temppkg=( $pkg )
    pkgName="${temppkg[1]}"

    mysql --user="$user" --password="$password" --database="$database" --execute="UPDATE versionHistory SET passed = False WHERE version = $version;"
    echo "updated :("
    newVersion=$(mysql --user="$user" --password="$password" --database="$database" --execute="SELECT version FROM versionHistory WHERE version = (SELECT MAX(version) FROM versionHistory WHERE passed = true and pkgName = '$pkgName');")
    
    vars=( $newVersion )
    temp="${vars[1]}"

    echo "going to roll back to the last passed version($temp)..."

    IFS=$'\n' read -d '' -r -a lines < v$temp/$pkgName.config
    length=${#lines[@]}
    pkgName=${lines[2]}
    installLoc=${lines[4]}
    services=${lines[6]}
    #delete files
        for ((i=8; i<${length}; i++));
            do
                echo deleting ${lines[i]} from QA...
                ssh testqa@172.28.231.181 "rm -r ~/DeploymentTestFolder/${lines[i]}"
                
            done
    #send zip
    echo sending $pkgName to QA...
    sshpass -v -p "test" scp ~/deployment/v$temp/$pkgName.zip testqa@172.28.231.181:$installLoc
    ssh testqa@172.28.231.181 "unzip $installLoc/$pkgName.zip -d $installLoc"
    ssh testqa@172.28.231.181 "rm -r $installLoc/$pkgName.zip"
    echo Reverted to Version: $temp 
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
fi
