import pika
from bs4 import BeautifulSoup
import urllib.request


def callback(ch, method, properties, body):
    print(" [x] Received %r" % body)
    url = body.decode("utf-8")
    html_doc = urllib.request.urlopen(url).read()
    soup = BeautifulSoup(html_doc, 'html.parser')

    title = soup.select('title')[0].string
    print('Title is : "%s"' % title)


credentials = pika.PlainCredentials('root', 'root')
parameters = pika.ConnectionParameters('rabbitmq',
                                       5672,
                                       '/',
                                       credentials)
connection = pika.BlockingConnection(parameters)
channel = connection.channel()
channel.basic_consume(queue='task',
                      auto_ack=True,
                      on_message_callback=callback)

print(' [*] Waiting for messages. To exit press CTRL+C')
channel.start_consuming()