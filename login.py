#!/usr/bin/env python3
import cgi
import cgitb
import mysql.connector

cgitb.enable()

# Conectar a la base de datos
db = mysql.connector.connect(
    host="localhost",
    user="root",
    password="1234",
    database="appchurreriadb"
)

# Obtener datos del formulario
form = cgi.FieldStorage()
username = form.getvalue("username")
password = form.getvalue("password")

# Consultar la base de datos para validar las credenciales
cursor = db.cursor()
query = "SELECT id FROM Usuario WHERE username=%s AND password=%s"
values = (username, password)
cursor.execute(query, values)
user_id = cursor.fetchone()

# Redirigir al menú principal si las credenciales son válidas, o mostrar un mensaje de error
if user_id:
    print("Location: menu_principal.html\n")
else:
    print("Content-type: text/html\n")
    print("<html><body>")
    print("<h2>Error: Credenciales inválidas.</h2>")
    print("<a href='index.html'>Volver al inicio de sesión</a>")
    print("</body></html>")
    
db.close()
