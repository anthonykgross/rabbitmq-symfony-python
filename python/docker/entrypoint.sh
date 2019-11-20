#!/bin/bash
set -e

source ~/.bash_profile

install() {
    pip install -r requirements.txt
}

tests() {
    gosu docker python console.py tests
}

run() {
    mkdir -p /var/log/supervisor
    supervisord -c /etc/supervisor/conf.d/supervisor.conf
#    tail -f
}

permission() {
    chown -Rf docker:docker .
}

case "$1" in
"install")
    echo "Install"
    install
    ;;
"tests")
    echo "Tests"
    tests
    ;;
"run")
    echo "Run"
    run
    ;;
"permission")
    echo "Permission"
    permission
    ;;
*)
    echo "Custom command : $@"
    exec "$@"
    ;;
esac