FROM gustavovinicius/webserver:nginxv124

WORKDIR /var/www/html

EXPOSE 81

ENTRYPOINT ["tail", "-f", "/dev/null"]