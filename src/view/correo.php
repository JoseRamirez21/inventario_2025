<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>JC Licores - Recuperación de Contraseña</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: Arial, Helvetica, sans-serif;
      background-color: #f4f4f4;
      padding: 20px;
    }

    .email-container {
      max-width: 600px;
      margin: 0 auto;
      background-color: #ffffff;
      border-radius: 8px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
      overflow: hidden;
    }

    .header {
      background: linear-gradient(135deg, #004080, #1E90FF);
      padding: 20px;
      color: white;
      display: flex;
      align-items: center;
    }

    .logo-img {
      width: 50px;
      height: 50px;
      background-color: rgba(255, 255, 255, 0.2);
      border-radius: 8px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 12px;
      color: #ffffff;
      margin-right: 15px;
    }

    .company-name {
      font-size: 24px;
      font-weight: bold;
      color: #ffffff;
      text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.3);
    }

    .content {
      padding: 30px;
      line-height: 1.6;
      color: #333333;
    }

    .notice-time {
      background-color: #e6f0ff;
      border-left: 6px solid #1E90FF;
      padding: 15px 20px;
      margin: 20px 0;
      border-radius: 8px;
      color: #003366;
      font-weight: bold;
      font-size: 18px;
      text-align: center;
      position: relative;
      display: flex;
      flex-direction: column;
      gap: 10px;
      align-items: center;
      justify-content: center;
      min-height: 10px; /* Ajuste más pequeño */
    }

    .notice-time::before {
      content: "⏳";
      font-size: 28px;
      position: absolute;
      top: 20px;
      left: 20px;
    }

    .countdown-text {
      font-size: 20px;
      color: #1E90FF;
    }

    .countdown-time {
      font-size: 36px;
      font-weight: 900;
      color: #004080;
      letter-spacing: 3px;
      font-family: 'Courier New', Courier, monospace;
    }

    .reset-link {
      display: block;
      text-align: center;
      background-color: #1E90FF;
      color: white;
      text-decoration: none;
      padding: 12px;
      border-radius: 6px;
      font-weight: bold;
      margin: 30px auto;
      width: 80%;
      transition: background-color 0.3s ease;
    }

    .reset-link:hover {
      background-color: #0066cc;
    }

    .security-notice {
      background-color: #fff3cd;
      border: 1px solid #ffeaa7;
      border-radius: 4px;
      padding: 15px;
      margin: 20px 0;
    }

    .security-notice h4 {
      color: #856404;
      margin-bottom: 10px;
      font-size: 16px;
    }

    .security-notice ul {
      color: #856404;
      margin-left: 20px;
    }

    .security-notice li {
      margin-bottom: 5px;
    }

    .greeting {
      font-size: 18px;
      margin-bottom: 20px;
      color: #004080;
      font-weight: bold;
    }

    .message {
      font-size: 16px;
      margin-bottom: 20px;
    }

    @media only screen and (max-width: 600px) {
      .content {
        padding: 20px;
      }

      .company-name {
        font-size: 20px;
      }

     .logo-img {
  width: 50px;
  height: 50px;
  margin-right: 15px;
  object-fit: contain;
  border-radius: 8px;
}


      .reset-link {
        width: 100%;
      }

      .notice-time {
        min-height: 90px; /* Ajuste más pequeño para móvil */
      }

      .countdown-time {
        font-size: 28px;
      }
    }
   

  </style>
</head>
<body>
  <div class="email-container">
    <!-- Encabezado -->
    <div class="header">
      <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRcOg8Ax5g9goNiTXPtuLwE23JPqOtrO3VSEQ&s" alt="Logo de JC Licores" class="logo-img" />
<h1 class="company-name">JC LICORES</h1>

    </div>

    <!-- Contenido -->
    <div class="content">
      <div class="notice-time">
        <div class="countdown-text">Tiempo para restablecer la contraseña:</div>
        <div id="countdown" class="countdown-time">02:00:00</div>
      </div>

      <div class="greeting">
        ¡Hola estimado cliente!
      </div>

      <div class="message">
        <p>Hemos recibido una solicitud para recuperar tu contraseña en <strong>JC Licores</strong>.</p>
        <p>Haz clic en el siguiente botón para restablecerla:</p>
      </div>

      <a href="#" class="reset-link">Restablecer mi contraseña</a>

      <div class="security-notice">
        <h4>⚠️ Recomendaciones de Seguridad:</h4>
        <ul>
          <li>Usa una contraseña segura después de restablecerla</li>
          <li>No reutilices contraseñas anteriores</li>
          <li>No compartas tu nueva contraseña</li>
        </ul>
      </div>

      <div class="message">
        <p>Si no solicitaste esta recuperación, ignora este mensaje o contáctanos de inmediato.</p>
        <p><strong>Gracias por confiar en JC Licores.</strong></p>
      </div>
    </div>

    <!-- Footer -->
    <p style="width: 100%; text-align: center; font-size: 13px; color: white; background: linear-gradient(135deg, #004080, #1E90FF); padding: 10px; margin-top: 30px;">
      © JC Licores 2025
    </p>
  </div>

  <script>
    const countdownElement = document.getElementById('countdown');
    let remainingTime = 2 * 60 * 60; // 2 horas en segundos

    function updateCountdown() {
      const hours = Math.floor(remainingTime / 3600);
      const minutes = Math.floor((remainingTime % 3600) / 60);
      const seconds = remainingTime % 60;

      countdownElement.textContent = 
        `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;

      if (remainingTime > 0) {
        remainingTime--;
      } else {
        clearInterval(timer);
        countdownElement.textContent = "00:00:00";
      }
    }

    const timer = setInterval(updateCountdown, 1000);
    updateCountdown();
  </script>
</body>
</html>
