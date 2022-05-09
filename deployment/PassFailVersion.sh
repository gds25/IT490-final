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
        #TODO: Push to prod
        #get package name of version
        pkg=$(mysql --user="$user" --password="$password" --database="$database" --execute="SELECT pkgName FROM versionHistory WHERE version = $version;")
        temppkg=( $pkg )
        pkgName="${temppkg[1]}"
        #read file into array
        IFS=$'\n' read -d '' -r -a lines < v$version/$pkgName.config
        #get each file outlined in config
        pkgName=${lines[2]}
        installLoc=${lines[5]}
        prodMachine=${lines[4]}
        services=${lines[7]}
        length=${#lines[@]}
    if [ $prodMachine == "FE" ]; then
        ProdMachineName="gds25"
        ProdIP="172.27.201.179"
        ProdPass='R0seli197$'

        #remove files from qa
        for ((i=9; i<${length}; i++));
            do
                echo deleting ${lines[i]} from QA...
                ssh gds25@172.27.201.179 "rm -r $installLoc/${lines[i]}"
            done
        
        #send to QA(testqa)
        echo sending $pkgName to QA...
        sshpass -v -p 'R0seli197$' scp ~/deployment/v$version/$pkgName.zip gds25@172.27.201.179:$installLoc
        ssh gds25@172.27.201.179 "unzip $installLoc/$pkgName.zip -d $installLoc"
        ssh gds25@172.27.201.179 "rm -r $installLoc/$pkgName.zip"
        echo Pushed Version: $version 
        
        #restart any services based on config 

        if [ $services == "apache" ]; then
            #FE: apache 
            echo 'R0seli197$' | ssh -t -t gds25@172.27.201.179 "sudo systemctl restart apache2"
            echo apache restarted
        elif [ $services == "databaseServer" ]; then
            #BE: DBServer.php
            echo 'R0seli197$' | ssh -t -t gds25@172.27.201.179 "sudo systemctl restart DatabaseService.service"
            echo "Database Server restarted :)"
            echo Database Server restarted
        elif [ $services == "databaseServer" ]; then
            #BE: Mysql
            echo 'pharmacy' | ssh -t -t gds25@172.27.201.179 "sudo systemctl restart mysql"
            echo mysql restarted
        elif [ $services == "DMZServer" ]; then
            DMZ: DMZServer.php
            echo 'R0seli197$' | ssh -t -t gds25@172.27.201.179 "sudo systemctl restart DMZService.service"
            echo "DMZ Server restarted :)"
        fi

    else
        if [ $qaMachine == "BE" ]; then
        ProdMachineName="dran"
        ProdIP="172.27.35.201"
        ProdPass='pharmacy'

        #remove files from qa
        for ((i=9; i<${length}; i++));
            do
                echo deleting ${lines[i]} from QA...
                ssh dran@172.27.35.201 "rm -r $installLoc/${lines[i]}"
            done
        
        #send to QA(testqa)
        echo sending $pkgName to QA...
        sshpass -v -p 'pharmacy' scp ~/deployment/v$version/$pkgName.zip dran@172.27.35.201:$installLoc
        ssh dran@172.27.35.201 "unzip $installLoc/$pkgName.zip -d $installLoc"
        ssh dran@172.27.35.201 "rm -r $installLoc/$pkgName.zip"
        echo Pushed Version: $version 
        
        #restart any services based on config 

        if [ $services == "apache" ]; then
            #FE: apache 
            echo 'pharmacy' | ssh -t -t dran@172.27.35.201 "sudo systemctl restart apache2"
            echo apache restarted
        elif [ $services == "databaseServer" ]; then
            #BE: DBServer.php
            echo 'pharmacy' | ssh -t -t dran@172.27.35.201 "sudo systemctl restart DatabaseService.service"
            echo "Database Server restarted :)"
            echo Database Server restarted
        elif [ $services == "databaseServer" ]; then
            #BE: Mysql
            echo 'pharmacy' | ssh -t -t dran@172.27.35.201 "sudo systemctl restart mysql"
            echo mysql restarted
        elif [ $services == "DMZServer" ]; then
            DMZ: DMZServer.php
            echo 'pharmacy' | ssh -t -t dran@172.27.35.201 "sudo systemctl restart DMZService.service"
            echo "DMZ Server restarted :)"
        fi
        else
            #is DMZ
        ProdMachineName="bsingh"
        ProdIP="172.27.175.139"
        ProdPass='05072000'

        #remove files from qa
        for ((i=9; i<${length}; i++));
            do
                echo deleting ${lines[i]} from QA...
                ssh bsingh@172.27.175.139 "rm -r $installLoc/${lines[i]}"
            done
        
        #send to QA(testqa)
        echo sending $pkgName to QA...
        sshpass -v -p '05072000' scp ~/deployment/v$version/$pkgName.zip bsingh@172.27.175.139:$installLoc
        ssh bsingh@172.27.175.139 "unzip $installLoc/$pkgName.zip -d $installLoc"
        ssh bsingh@172.27.175.139 "rm -r $installLoc/$pkgName.zip"
        echo Pushed Version: $version 
        
        #restart any services based on config 

        if [ $services == "apache" ]; then
            #FE: apache 
            echo '05072000' | ssh -t -t bsingh@172.27.175.139 "sudo systemctl restart apache2"
            echo apache restarted
        elif [ $services == "databaseServer" ]; then
            #BE: DBServer.php
            echo '05072000' | ssh -t -t bsingh@172.27.175.139 "sudo systemctl restart DatabaseService.service"
            echo "Database Server restarted :)"
            echo Database Server restarted
        elif [ $services == "databaseServer" ]; then
            #BE: Mysql
            echo '05072000' | ssh -t -t bsingh@172.27.175.139 "sudo systemctl restart mysql"
            echo mysql restarted
        elif [ $services == "DMZServer" ]; then
            DMZ: DMZServer.php
            echo '05072000' | ssh -t -t bsingh@172.27.175.139 "sudo systemctl restart DMZService.service"
            echo "DMZ Server restarted :)"
        fi
    fi
    fi

    echo "Pushed to prod"
    
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
    QAMachine=${lines[4]}
    installLoc=${lines[5]}
    services=${lines[7]}
    if [ $QAMachine == "FE" ]; then
        qaMachineName="gds25"
        qaIP="172.27.249.118"
        qaPass='R0seli197$'

        #remove files from qa
        for ((i=9; i<${length}; i++));
            do
                echo deleting ${lines[i]} from QA...
                ssh gds25@172.27.249.118 "rm -r $installLoc/${lines[i]}"
            done
        
        #send to QA(testprod)
        echo sending $pkgName to QA...
        sshpass -v -p 'R0seli197$' scp ~/deployment/v$version/$pkgName.zip gds25@172.27.249.118:$installLoc
        ssh gds25@172.27.249.118 "unzip $installLoc/$pkgName.zip -d $installLoc"
        ssh gds25@172.27.249.118 "rm -r $installLoc/$pkgName.zip"
        echo Pushed Version: $version 
        #mysql update table

        mysql --user="$user" --password="$password" --database="$database" --execute="INSERT INTO versionHistory (version, pkgName, passed) VALUES ($version, \"$pkgName\", NULL);"
        
        #restart any services based on config 

        if [ $services == "apache" ]; then
            #FE: apache 
            echo 'R0seli197$' | ssh -t -t gds25@172.27.249.118 "sudo systemctl restart apache2"
            echo apache restarted
        elif [ $services == "databaseServer" ]; then
            #BE: DBServer.php
            echo 'R0seli197$' | ssh -t -t gds25@172.27.249.118 "sudo systemctl restart DatabaseService.service"
            echo "Database Server restarted :)"
            echo Database Server restarted
        elif [ $services == "databaseServer" ]; then
            #BE: Mysql
            echo 'R0seli197$' | ssh -t -t gds25@172.27.249.118 "sudo systemctl restart mysql"
            echo mysql restarted
        elif [ $services == "DMZServer" ]; then
            DMZ: DMZServer.php
            echo 'R0seli197$' | ssh -t -t gds25@172.27.249.118 "sudo systemctl restart DMZService.service"
            echo "DMZ Server restarted :)"
        fi

else
    if [ $QAMachine == "BE" ]; then
        qaMachineName="dran"
        qaIP="172.27.34.208"
        qaPass='pharmacy'

        #remove files from qa
        for ((i=9; i<${length}; i++));
            do
                echo deleting ${lines[i]} from QA...
                ssh dran@172.27.34.208 "rm -r $installLoc/${lines[i]}"
            done
        
        #send to QA(testprod)
        echo sending $pkgName to QA...
        sshpass -v -p 'pharmacy' scp ~/deployment/v$version/$pkgName.zip dran@172.27.34.208:$installLoc
        ssh dran@172.27.34.208 "unzip $installLoc/$pkgName.zip -d $installLoc"
        ssh dran@172.27.34.208 "rm -r $installLoc/$pkgName.zip"
        echo Pushed Version: $version 
        #mysql update table

        mysql --user="$user" --password="$password" --database="$database" --execute="INSERT INTO versionHistory (version, pkgName, passed) VALUES ($version, \"$pkgName\", NULL);"
        
        #restart any services based on config 

        if [ $services == "apache" ]; then
            #FE: apache 
            echo 'pharmacy' | ssh -t -t dran@172.27.34.208 "sudo systemctl restart apache2"
            echo apache restarted
        elif [ $services == "databaseServer" ]; then
            #BE: DBServer.php
            echo 'pharmacy' | ssh -t -t dran@172.27.34.208 "sudo systemctl restart DatabaseService.service"
            echo "Database Server restarted :)"
            echo Database Server restarted
        elif [ $services == "databaseServer" ]; then
            #BE: Mysql
            echo 'pharmacy' | ssh -t -t dran@172.27.34.208 "sudo systemctl restart mysql"
            echo mysql restarted
        elif [ $services == "DMZServer" ]; then
            DMZ: DMZServer.php
            echo 'pharmacy' | ssh -t -t dran@172.27.34.208 "sudo systemctl restart DMZService.service"
            echo "DMZ Server restarted :)"
        fi
    else
        #is DMZ
        qaMachineName="bsingh"
        qaIP="127.27.118.99"
        qaPass='05072000'

        #remove files from qa
        for ((i=9; i<${length}; i++));
            do
                echo deleting ${lines[i]} from QA...
                ssh bsingh@127.27.118.99 "rm -r $installLoc/${lines[i]}"
            done
        
        #send to QA(testprod)
        echo sending $pkgName to QA...
        sshpass -v -p '05072000' scp ~/deployment/v$version/$pkgName.zip bsingh@127.27.118.99:$installLoc
        ssh bsingh@127.27.118.99 "unzip $installLoc/$pkgName.zip -d $installLoc"
        ssh bsingh@127.27.118.99 "rm -r $installLoc/$pkgName.zip"
        echo Pushed Version: $version 
        #mysql update table

        mysql --user="$user" --password="$password" --database="$database" --execute="INSERT INTO versionHistory (version, pkgName, passed) VALUES ($version, \"$pkgName\", NULL);"
        
        #restart any services based on config 

        if [ $services == "apache" ]; then
            #FE: apache 
            echo '05072000' | ssh -t -t bsingh@127.27.118.99 "sudo systemctl restart apache2"
            echo apache restarted
        elif [ $services == "databaseServer" ]; then
            #BE: DBServer.php
            echo '05072000' | ssh -t -t bsingh@127.27.118.99 "sudo systemctl restart DatabaseService.service"
            echo "Database Server restarted :)"
            echo Database Server restarted
        elif [ $services == "databaseServer" ]; then
            #BE: Mysql
            echo '05072000' | ssh -t -t bsingh@127.27.118.99 "sudo systemctl restart mysql"
            echo mysql restarted
        elif [ $services == "DMZServer" ]; then
            DMZ: DMZServer.php
            echo '05072000' | ssh -t -t bsingh@127.27.118.99 "sudo systemctl restart DMZService.service"
            echo "DMZ Server restarted :)"
        fi
    fi
fi
fi
