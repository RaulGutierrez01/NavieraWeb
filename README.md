# NavieraWeb
1. Propósito del Sistema![logoAtlantisNav](https://github.com/user-attachments/assets/a35d0fa6-083c-4955-8d3b-c258015b123c)

Este sistema web tiene como objetivo principal gestionar y facilitar la interacción entre usuarios y empleados dentro de una plataforma de servicios relacionados con una navegación. La plataforma cuenta con dos interfaces principales:
      •Interfaz para empleados: Proporciona herramientas de administración, acceso a datos y funcionalidades específicas para la gestión interna.
      •	Interfaz para clientes: Ofrece a los usuarios finales un acceso personalizado para realizar consultas o interactuar con los servicios de la navegación.
El sistema incluye funcionalidades como: 
•	Inicio de sesión diferenciado por roles ( Empleado y Usuario ).
•	Registro de usuarios para clientes.
•	Diseño responsivo y moderno para una experiencia óptima en distintos dispositivos.
3. Descripción General del Proyecto
El sistema está compuesto por las siguientes partes principales:
1.	Frontend: Diseñado con HTML y CSS para proporcionar una interfaz amigable y responsiva.
2.	Backend: Desarrollado en PHP para manejar la lógica del servidor, la interacción con la base de datos y la autenticación.
3.	Base de datos: Implementada en MySQL para almacenar información crítica, como usuarios y roles.


3. Requisitos del Sistema
Antes de comenzar, asegúrese de que su entorno cumpla con los siguientes requisitos:
Hardware
•	Procesador: Dual Core o superior.
•	Memoria RAM: Mínimo 2 GB.
•	Espacio en disco: Al menos 500 MB libres.
Software
•	Servidor web: Apache (recomendado con XAMPP, WAMP o MAMP).
•	PHP: Versión 7.4 o superior.
•	Base de datos: MySQL.
•	Editor de código: Visual Studio Code, Sublime Text, Bloc de notas o cualquier otro editor.
•	Navegador: Google Chrome, Mozilla Firefox, etc.

4. Instalación y configuración del entorno
Instalación del Servidor Local: ![image](https://github.com/user-attachments/assets/9d1000f4-fff2-464d-811d-d2d71eff9a0e)

  1.	Descarga XAMPP 
  2.	Instala XAMPP y habilita los módulos necesarios:
      o	Apache.
     o	Base de datos MySQL
  3.	Acceda al panel de control de XAMPP y arranca los servicios Apache y MySQL .

Configuración del proyecto
1.	Copia los archivos de tu proyecto al directorio raíz del servidor local:
o	Para XAMPP: C:\xampp\htdocs\tu_proyecto.
 ![image](https://github.com/user-attachments/assets/e4ce8fa5-5ad9-40e4-8318-29e3165871f7)

2.	Crea una base de datos:

o	Acceda a http ://localhost /phpmyadmin/ .
o	Haz clic en Nueva .
o	Asigna el nombre de la base de datos: naviera.
 ![image](https://github.com/user-attachments/assets/2174a261-6397-44b2-a607-de612e055757)

5. Configuración de la Base de Datos
Estructura de la Base de Datos
 ![image](https://github.com/user-attachments/assets/a33b09a6-f330-481f-9226-0140f7005267)

6.Configuración de los Archivos
Los archivos están configurados según sus tareas por ejemplo: login.php que es el modulo de inicio de sesión, registrar.php que es el modulo de registrar usuario entre otros que estan en la carpeta del proyecto.
1.	Las  credenciales de la base de datos están configuradas de esta manera para que se pueda conectar a ella:
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "naviera";
2.	Ajustamos las redirecciones según las necesidades:
o	Empleado: interfaz_empleado.php.
o	Usuario: interfaz_cliente.php.

7. Pruebas del sistema
Prueba de Conexión a la Base de Datos
1.	Acceda al navegador y escriba: http://localhost/inicio.php
2.	Si aparece algún error de conexión, verifica:
o	Que el servidor MySQL está activo.
o	Las credenciales en el archivo PHP.
Prueba de inicio de sesión
 ![image](https://github.com/user-attachments/assets/9a8613b0-7793-460a-996d-2eb121e6237d)

1.	Introduzca los datos de usuario de ejemplo.
2.	Verifique que el sistema redirige correctamente según el tipo de usuario.

8. Mantenimiento
Copia de seguridad del sistema
•	Realice copias de seguridad de la base de datos con regularidad usando phpMyAdmin.
•	Descarga los archivos del proyecto periódicamente.
Actualizaciones
•	Revise la compatibilidad con nuevas versiones de PHP y MySQL.
•	Agregue cifrado de contraseñas 

9. Solución de problemas
Errores comunes
1.	No cargar la página:
      Verifica que Apache esté corriendo.
      Asegúrese de haber colocado el proyecto en la carpeta correcta.
2.	Error al conectar con la base de datos:
      Comprueba que las credenciales sean correctas.
      Verifica que la base de datos esté creada.
3.	Página en blanco tras iniciar sesión:
      Revisa el código PHP para errores con error_reporting

