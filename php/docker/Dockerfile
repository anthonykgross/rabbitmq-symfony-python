FROM anthonykgross/docker-fullstack-web:ubuntu-php7.2

MAINTAINER Anthony K GROSS

WORKDIR /var/www/html

ARG APPLICATION_ENV='dev'
ENV APPLICATION_ENV $APPLICATION_ENV

RUN apt-get update -y && \
	apt-get upgrade -y && \
	apt-get install -y supervisor nginx && \
    rm -rf /var/lib/apt/lists/* && \
    apt-get autoremove -y --purge && \
    rm -Rf /etc/nginx/sites-enabled/default && \
    mkdir -p /var/www/logs && \
    yarn global add typescript

ADD docker/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

COPY ./src /var/www/html
COPY ./docker/supervisor.conf /etc/supervisor/conf.d/supervisor.conf
COPY ./docker/nginx.conf /etc/nginx/sites-enabled/nginx.conf

RUN chmod +x /entrypoint.sh && \
    bash --rcfile "/root/.bash_profile" -ic "/entrypoint.sh permission" && \
    bash --rcfile "/root/.bash_profile" -ic "/entrypoint.sh install"

EXPOSE 80
EXPOSE 443

ENTRYPOINT ["/entrypoint.sh"]
CMD ["run"]

