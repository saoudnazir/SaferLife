from general import General
from LoadDB import LoadDB
from os.path import dirname, join
import socket
from time import sleep




client_socket = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
client_socket.connect(('127.0.0.1', 8485))
while True:
    client_socket.sendall(b"Hello3")
    sleep(2)
client_socket.close()