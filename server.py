import os
import sys
from http.server import HTTPServer, CGIHTTPRequestHandler

webDir = '.'
port = 80
if len(sys.argv) > 1:
    webDir = sys.argv[1]
if len(sys.argv) > 2:
    port = int(sys.argv[2])

print('webDir "%s", port %s' % (webDir, port))
os.chdir(webDir)
serverAddress = ("", port)
serverObject = HTTPServer(serverAddress, CGIHTTPRequestHandler)
serverObject.serve_forever()
