#!/usr/bin/env bash

echo -e "\e[32m*******************************"
echo -e "* setup.sh - setup for edu-m1 *"
echo -e "*******************************\e[0m\n"

php_version=php5.6

shopt -s expand_aliases
source /etc/profile.d/02-php-aliases.sh

echo -en "Checking php version    \e[33;1m${php_version}\e[0m                "

if $(type -t ${php_version} 2) > /dev/null; then
    echo -e "\e[32m[OK]\e[0m";
else
    echo -e "\e[31;1m[ERROR]\n\e[0m\nSorry: ${php_version} must be available to proceed.\e[0m\n";
    exit 2
fi

# Create local database schemas and users for all local sites and vhosts for them:
sites=(
#   'client  db_host     db_name   db_user   db_pass       php   web_host                web_aliases (space delimited)'
    'edu-m1  localhost   edu_m1    edu_m1    Password123   5.6   edu-m1.demacmedia.com   www.edu-m1.demacmedia.com'
)

for i in "${sites[@]}"; do
    arr=(${i// / })
    client=${arr[0]}
    db_host=${arr[1]}
    db_name=${arr[2]}
    db_user=${arr[3]}
    db_pass=${arr[4]}
    php=${arr[5]}
    web_host=${arr[6]}
    web_aliases=""
    if [ -d /srv/www/${client}/magento ]; then
        home_dir="/srv/www/${client}/magento"
    else
        home_dir="/srv/www/${client}"
    fi
    for j in "${arr[@]:7}"; do
        web_aliases="${web_aliases} -a ${j}"
    done;

    echo -en "Creating mysql database \e[33;1m${db_name}\e[0m                "
    echo "drop schema if exists ${db_name};" | MYSQL_PWD=root mysql -uroot
    echo "create schema ${db_name};" | MYSQL_PWD=root mysql -uroot
    echo -e "\e[32m[OK]\e[0m"
    echo -en "Creating mysql user     \e[33;1m${db_user}@${db_host}\e[0m      "
    echo "grant all privileges on ${db_name}.* to '${db_user}'@'${db_host}' identified by '${db_pass}';" | MYSQL_PWD=root mysql -uroot
    echo -e "\e[32m[OK]\e[0m"

    echo -en "Setting up apache vhost \e[33;1m${web_host}\e[0m "
    sudo vhost add -d ${home_dir} -n ${web_host} ${web_aliases} -p ${php} -f > /dev/null 2>&1
    echo -e "\e[32m[OK]\e[0m"
    echo -n "Restarting apache                             "
    sudo service apache2 restart > /dev/null 2>&1
    echo -e "\e[32m[OK]\e[0m"
done

echo -n "Installing sample data                        "
zcat /srv/www/edu-m1/m1.sample-data.sql.gz | MYSQL_PWD=root mysql -uroot edu_m1
echo -e "\e[32m[OK]\e[0m"

echo -n "Running Magento M1 setup                      "
cd "/srv/www/edu-m1/magento"
php5.6 -f install.php -- \
--license_agreement_accepted "yes" \
--locale "en_CA" \
--timezone "America/Toronto" \
--default_currency "CAD" \
--db_host "localhost" \
--db_name "edu_m1" \
--db_user "edu_m1" \
--db_pass "Password123" \
--db_prefix "" \
--session_save "files" \
--admin_frontname "admin" \
--url "https://edu-m1.demacmedia.com/" \
--use_rewrites "yes" \
--use_secure "yes" \
--secure_base_url "https://edu-m1.demacmedia.com/" \
--use_secure_admin "yes" \
--admin_firstname "Admin" \
--admin_lastname "User" \
--admin_email "admin@example.com" \
--admin_username "admin" \
--admin_password "Password123" \
--encryption_key "db23ad69b9028bc105e3ec8ac1cf62a8" \
> /dev/null
echo -e "\e[32m[OK]\e[0m\n"

external_ip=$(cat /vagrant/config.yml | grep vagrant_ip | cut -d' ' -f2 | xargs)
echo "Add the following line to your host file:"
echo -e "\e[33;1m${external_ip}        edu-m1.demacmedia.com\e[0m\n"
echo -e "Access the site at \e[32;1mhttps://edu-m1.demacmedia.com\e[0m\n"
echo -e "Admin site details:\n    URL:  https://edu-m1.demacmedia.com/admin\n    User: admin\n    Pass: Password123\n"

