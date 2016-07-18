$hostname = "vagrant"

$script = <<SCRIPT
	
echo Installing LAMP stack
apt-get update -y
debconf-set-selections <<< 'mysql-server-5.5 mysql-server/root_password password root' 
debconf-set-selections <<< 'mysql-server-5.5 mysql-server/root_password_again password root'
sudo apt-get install -y apache2 libapache2-mod-php5 php5 php5-mysql mysql-server php5-xdebug
sudo service mysql stop
sudo sed -i "s/bind-address.*/bind-address = 0.0.0.0/" /etc/mysql/my.cnf
sudo service mysql start
echo "use mysql;update user set host='%' where user='root' and host='#{$hostname}';flush privileges;" | mysql -uroot -proot
sudo rm -rf /var/www/html 
sudo ln -s /vagrant /var/www/html 
echo "ServerName localhost" >> /etc/apache2/apache2.conf
sudo cat > /etc/php5/mods-available/xdebug.ini << EOF
zend_extension=xdebug.so
xdebug.remote_enable=On
xdebug.remote_connect_back=On
xdebug.remote_autostart=Off
xdebug.remote_log=/tmp/xdebug.log
EOF
a2enmod rewrite
sudo service apache2 restart 
echo Install done
SCRIPT

Vagrant.configure(2) do |config|
	config.vm.box = "ubuntu/trusty64"
	config.vm.hostname = $hostname
	# Uncomment the next line if you want a DHCP address
	# config.vm.network "public_network"
	config.vm.network "forwarded_port", guest: 80, host: 8080
	config.vm.network "forwarded_port", guest: 3306, host: 6033
	config.vm.synced_folder ".", "/vagrant", owner: "vagrant", mount_options: ["dmode=775,fmode=775"]
	config.vm.provider "virtualbox" do |vb|
 		vb.memory = 1024
	end
	config.vm.provision "shell", inline: $script
end