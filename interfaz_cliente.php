<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
<?php
print "  <title>AtlantisNav</title>\n";
?>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      text-align: center;
      background: #ffffff; /* Gradiente suave */
    }
    h1 {
      font-size: 2.5em;
      color: #4CAF50;
      text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
    }
    h2 {
      font-size: 2em;
      color: #4CAF50;
      text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
    }

    p {
      font-size: 1.2em;
      color: #333;
    }
  
  /* Estilos para la barra de navegación */
    .navbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 10px 20px;
      background-color:#ffffff;
      color: white;
    }
    .navbar .links a {
      margin: 0 25px;
      color: black;
      text-decoration: none;
      font-size: 1.1em;
    }
    .navbar .links a:hover {
      text-decoration: underline;
    }
    .navbar .auth-buttons button {
      background-color: #333;
      color: white;
      border: none;
      padding: 8px 12px;
      margin-left: 10px;
      cursor: pointer;
      border-radius: 4px;
    }
    .navbar .auth-buttons button:hover {
      background-color: #555;
    }

/* Estilos para la sección de información con imagen a la izquierda */
.info-section {
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 20px;
  background-color: #fffff; /* Fondo ligero para destacar f9f9f9f */
  margin: 20px auto;
  max-width: auto; /* 800px para centrear*/
  border-radius: 8px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0);/* rgba(0, 0, 0, 0.1) para borde suave*/
}

.info-image {
  width: 400px;
  height: auto;
  border-radius: 8px;
  margin-right: 20px;
}

.info-text {
  text-align: left;
}

.info-text h2 {
  color: #333; /* Color del título #4CAF50 verde*/
  margin-bottom: 10px;
}

.info-text p {
  color: #333; /* Color del texto */
}

/* Estilos para la sección de información con imagen a la izquierda */
.servi-section {
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 20px;
  background-color: #fffff; /* Fondo ligero para destacar f9f9f9f */
  margin: 20px auto;
  max-width: auto; /* 800px para centrear*/
  border-radius: 8px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);/* rgba(0, 0, 0, 0.1) para borde suave*/
}

.servi-image {
  width: 200px;
  height: auto;
  border-radius: 8px;
  margin-right: 20px;
}

.servi-text {
  text-align: left;
}

.servi-text h3 {
  color: #333; /* Color del título #4CAF50 verde*/
  margin-bottom: 10px;
}

.servi-text p {
  color: #333; /* Color del texto */
}

    /* Estilos de las tarjetas */
    .card-container {
      display: flex;
      flex-wrap: wrap; /* Permite que las tarjetas se ajusten en varias filas */
      justify-content: center; /* Centra las tarjetas en el contenedor */
      padding: 20px;
    }
    .card {
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      margin: 10px;
      padding: 15px;
      width: 300px; /* Ancho fijo de las tarjetas */
      transition: transform 0.2s;
    }
    .card img {
      width: 100%; /* Imagen ocupa el 100% del ancho de la tarjeta */
      border-radius: 8px;
      height: auto; /* Mantiene proporciones */
    }
    .card:hover {
      transform: scale(1.05); /* Efecto al pasar el mouse sobre la tarjeta */
    }
/* Estilos para la sección de testimonios */
    .testimonios {
      background-color: #fff;
      padding: 40px;
      margin: 20px 0;
    }
    .testimonios h2 {
      font-size: 2em;
      margin-bottom: 20px;
    }
    .testimonios .testimonio {
      display: flex; /* Para alinear la imagen y el texto lado a lado */
      align-items: center;
      margin: 20px auto;
      max-width: 700px;
      text-align: left;
      border-left: 4px solid #4CAF50;
      padding-left: 20px;
      font-style: italic;
      color: #555;
      background-color: #f9f9f9;
      border-radius: 10px;
      box-shadow: 0px 2px 8px rgba(0,0,0,0.1);
    }
    .testimonios .testimonio img {
      border-radius: 50%;
      width: 80px;
      height: 80px;
      object-fit: cover;
      margin-right: 20px;
    }
    .testimonios .testimonio p {
      font-size: 1.2em;
      margin: 0;
    }
    .testimonios .testimonio .cliente {
      font-weight: bold;
      margin-top: 10px;
      display: block;
      text-align: right;
      color: #333;
    }
footer {
  background-color: #fff;
  color: #fff;
  padding: 20px 0;
  text-align: center;
}

.footer-container {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 15px;
}

.logo {
  max-width: 150px;
}

.links-section, .social-section {
  display: flex;
  gap: 15px;
}

.links-section a, .social-section a {
  color: #333;
  text-decoration: none;
}

.links-section a:hover, .social-section a:hover {
  text-decoration: underline;
}

  </style>
</head>

<body>
 <!-- Barra de navegación -->
  <div class="navbar">
    <div class="links">
      <a href="inicio.php">Inicio</a>
   <a href="fags.php">Preguntas Frecuentes</a>
    </div>
    <div class="auth-buttons">
  <button onclick="location.href='rastrear_carga_cliente.php'">Ratrear Carga</button>

    </div>
  </div>
<?php
echo "<img src='NAVIERA.webp' alt='Esta es una descripcion alternativa de la imagen para cuando no se pueda mostrar' width='1350' height='400' align='center'/>";
?>
<!-- Contenedor de imagen e información -->
<div class="info-section">
  <img src="atlantisnav.webp" alt="Descripción de la imagen" class="info-image">
  <div class="info-text">
    <h2>AtlantisNav</h2>
    <p>Bienvenido a AtlantisNav, tu socio confiable en soluciones de transporte marítimo. Nos especializamos en ofrecer servicios de envío globales con un enfoque en seguridad, eficiencia y compromiso con el cliente. Explora nuestras soluciones y descubre cómo podemos ayudarte a mover tus cargas de forma segura y puntual.</p>
  </div>
</div>

<!--<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d7874.773471736586!2d-79.70635763900034!3d9.298958562940046!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2spa!4v1728546944146!5m2!1sen!2spa" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>-->
  <!-- Ícono del menú hamburguesa debajo de la imagen -->
  <div class="menu-icon" onclick="toggleMenu()">
    <div></div>
    <div></div>
    <div></div>
  </div>
<h3>Soluciones</h3>
<!-- Contenedor de imagen e información -->
<div class="servi-section">
  <img src="798.jfif" alt="Descripción de la imagen" class="servi-image">
  <div class="servi-text">
    <h3>Transporte de Carga Marítima</h3>
    <p>Ofrecemos servicios especializados de transporte marítimo para todo tipo de carga, desde contenedores hasta carga a granel. Nuestro equipo asegura un manejo seguro y eficiente para garantizar que tus mercancías lleguen a su destino en perfectas condiciones.<a href="servicio1.php">ver mas...</a></p>
  </div>
</div>

<div class="servi-section">
  <img src="TransporteInternacional.webp" alt="Descripción de la imagen" class="servi-image">
  <div class="servi-text">
    <h3>Transporte Internacional</h3>
    <p>Disponemos de rutas marítimas seguras y confiables que conectan los principales puertos del mundo, proporcionando soluciones de envío flexibles y adaptadas a tus necesidades.<a href="servicio1.php">ver mas...</a></p>
  </div>
</div>

<div class="servi-section">
  <img src="LogisticaAlmacenamiento.jpg" alt="Descripción de la imagen" class="servi-image">
  <div class="servi-text">
    <h3>Logística y Almacenamiento</h3>
    <p> Nuestro servicio de logística incluye almacenamiento seguro, carga y descarga para facilitar la cadena de suministro de nuestros clientes.<a href="servicio1.php">ver mas...</a></p>
  </div>
</div>

 <!-- Sección de Testimonios -->
  <div class="testimonios">
    <h2>¿Qué Dicen Nuestros Clientes?</h2>

    <div class="testimonio">
      <img src="hombre.png" alt="Juan Pérez">
      <p>"El servicio de CanalNav ha sido excepcional. No sólo entregan a tiempo, sino que también mantienen nuestra carga segura en todo momento. Totalmente recomendado."</p>
      <span class="cliente">- Juan Pérez, Importador</span>
    </div>

    <div class="testimonio">
      <img src="cliente2.jpg" alt="María López">
      <p>"CanalNav nos ha permitido expandir nuestras operaciones a nivel internacional con su eficiente sistema de gestión de contenedores. El seguimiento en tiempo real es una gran ventaja."</p>
      <span class="cliente">- María López, Exportadora</span>
    </div>

    <div class="testimonio">
      <img src="cliente3.jpg" alt="Roberto Martínez">
      <p>"Sus servicios de transporte de carga refrigerada han sido clave para nuestra cadena de suministro de alimentos. Excelente soporte y logística impecable."</p>
      <span class="cliente">- Roberto Martínez, Distribuidor de Alimentos</span>
    </div>
  </div>

</body>
<footer>
  <div class="footer-container">
    <div class="logo-section">
      <img src="logoAtlantisNav.png" alt="Logo" class="logo">
    </div>
    <div class="links-section">
      <a href="sobre-nosotros.html">Sobre Nosotros</a>
      <a href="privacidad.html">Política de Privacidad</a>
      <a href="contacto.html">Contacto</a>
    </div>
    <div class="social-section">
      <a href="https://facebook.com" target="_blank">Facebook</a>
      <a href="https://instagram.com" target="_blank">Instagram</a>
      <a href="https://twitter.com" target="_blank">Twitter</a>
    </div>
  </div>
</footer>

</html>
