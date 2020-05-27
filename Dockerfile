FROM php:7.4-cli-buster

RUN apt -y update && apt -y upgrade
RUN apt -y install figlet git zip unzip
RUN apt-get -y autoremove && apt-get -y clean

# alter bash prompt
ENV PS1A="\u@randomenglish.test:\w> "
RUN echo 'PS1=$PS1A' >> ~/.bashrc

# intro message when attaching to shell
RUN echo 'figlet -w 120 Random English' >> ~/.bashrc

# install composer - see https://medium.com/@c.harrison/speedy-composer-installs-in-docker-builds-41eea6d0172b
RUN curl -sS https://getcomposer.org/installer | php && mv composer.phar /usr/local/bin/composer && \
    composer global require hirak/prestissimo --no-plugins --no-scripts

# Prevent the container from exiting
CMD tail -f /dev/null

RUN docker-php-ext-install mysqli
