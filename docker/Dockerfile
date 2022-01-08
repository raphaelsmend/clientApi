FROM debian:buster

RUN apt update
RUN apt upgrade -y
RUN apt install software-properties-common -y
RUN apt install wget -y
RUN apt update && apt-get install -y gnupg2
RUN wget -q https://packages.sury.org/php/apt.gpg -O- | apt-key add -
RUN echo "deb https://packages.sury.org/php/ buster main" | tee /etc/apt/sources.list.d/php.list
RUN apt update
RUN apt install php7.2 libapache2-mod-php7.2 php7.2-fpm php7.2-cgi php7.2-cli php7.2-common php7.2-json php7.2-opcache php7.2-mysql php7.2-xml php7.2-mbstring php7.2-zip php7.2-gd php7.2-cgi php7.2-fpm php7.2-curl php7.4-xdebug -y
RUN apt install apache2 openssl unzip -y
RUN service apache2 restart
RUN apt install net-tools -y
RUN apt install iputils-ping -y
RUN apt install nano -y
RUN apt install git -y
RUN apt install libapache2-mod-security2 -y
RUN wget https://getcomposer.org/composer.phar
RUN mv composer.phar /usr/local/bin/composer
RUN chmod +x /usr/local/bin/composer
RUN composer global require laravel/installer
RUN a2enmod ssl
RUN a2enmod rewrite
RUN service apache2 restart
CMD ["/usr/sbin/apache2ctl", "-D", "FOREGROUND"]