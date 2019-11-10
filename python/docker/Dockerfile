FROM anthonykgross/docker-base:ubuntu

MAINTAINER Anthony K GROSS

WORKDIR /src

ARG APPLICATION_ENV='dev'
ENV APPLICATION_ENV $APPLICATION_ENV
ENV PYTHONIOENCODING=UTF-8

RUN apt-get update -y && \
	apt-get upgrade -y && \
	apt-get install -y python3 python3-pip && \
    rm -rf /var/lib/apt/lists/* && \
    apt-get autoremove -y --purge && \
    mkdir -p /var/log

RUN ln -sf /usr/bin/python3.6 /usr/bin/python && \
    ln -sf /usr/bin/python3.6-config /usr/bin/python-config && \
    ln -sf /usr/bin/pip3 /usr/bin/pip && \
	pip install supervisor==4.0.2 && \
    ln -sf /usr/local/bin/supervisord /usr/bin/supervisord

ADD docker/entrypoint.sh /entrypoint.sh
RUN mkdir -p /etc/supervisor/conf.d/ && \
    chmod +x /entrypoint.sh

COPY ./src /src
COPY ./docker/supervisor.conf /etc/supervisor/conf.d/supervisor.conf

RUN chmod +x /entrypoint.sh && \
    bash --rcfile "/root/.bash_profile" -ic "/entrypoint.sh permission" && \
    bash --rcfile "/root/.bash_profile" -ic "/entrypoint.sh install"

ENTRYPOINT ["/entrypoint.sh"]
CMD ["run"]
