FROM php:5.6-cli
COPY . /usr/src/myapp
WORKDIR /usr/src/myapp/public
EXPOSE 80
CMD [ "php", "-S", "0.0.0.0:80",  "-t", "/usr/src/myapp/public" ]
