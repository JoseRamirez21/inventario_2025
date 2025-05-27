<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>JC Licores - Recuperación de Contraseña</title>
  <style>
    body {
      font-family: Arial, Helvetica, sans-serif;
      background-color: #f4f4f4;
      padding: 20px;
      margin: 0;
    }

    .email-container {
      max-width: 600px;
      margin: 0 auto;
      background-color: #ffffff;
      border-radius: 8px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
      overflow: hidden;
    }

    .header {
      background: linear-gradient(135deg, #004080, #1E90FF);
      padding: 20px;
      color: white;
      display: flex;
      align-items: center;
      gap: 15px;
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
      user-select: none;
    }

    .company-name {
      font-size: 24px;
      font-weight: bold;
      color: white;
      text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.3);
    }

    .content {
      padding: 30px;
      color: #333333;
      line-height: 1.6;
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
      user-select: none;
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
      color: #856404;
    }

    .security-notice h4 {
      margin-bottom: 10px;
      font-size: 16px;
    }

    .security-notice ul {
      margin-left: 0;
      padding-left: 0;
      list-style: none;
    }

    .security-notice li {
      margin-bottom: 8px;
      display: flex;
      align-items: center;
      gap: 10px;
      font-weight: 600;
    }

    /* Emoji icon style */
    .security-notice li::before {
      content: attr(data-icon);
      font-size: 20px;
      display: inline-block;
      width: 25px;
      text-align: center;
      line-height: 1;
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

    /* Footer */
   

    /* Responsive */
    @media (max-width: 600px) {
      .content {
        padding: 20px;
      }
      .company-name {
        font-size: 20px;
      }
      .countdown-time {
        font-size: 28px;
      }
      .reset-link {
        width: 100%;
      }
    }
  </style>
</head>
<body>
  <div class="email-container">
    <div class="header">
       <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRcOg8Ax5g9goNiTXPtuLwE23JPqOtrO3VSEQ&s" alt="Logo de JC Licores" class="logo-img" />
      <h1 class="company-name">JC LICORES</h1>
    </div>

    <div class="content">
      <div class="notice-time">
        <div class="countdown-text">Tiempo para restablecer la contraseña:</div>
        <div class="countdown-time">02:00:00</div>
      </div>

      <div class="greeting">¡Hola estimado cliente!</div>

      <div class="message">
        <p>Hemos recibido una solicitud para recuperar tu contraseña en <strong>JC Licores</strong>.</p>
        <p>Haz clic en el siguiente botón para restablecerla:</p>
      </div>

      <a href="#" class="reset-link">Restablecer mi contraseña</a>

      <div class="security-notice">
        <h4>⚠️ Recomendaciones de Seguridad:</h4>
        <ul>
          <li data-icon="">🔒Usa una contraseña segura después de restablecerla</li>
          <li data-icon="">🔑No reutilices contraseñas anteriores</li>
          <li data-icon="">🙅‍♂️No compartas tu nueva contraseña</li>
        </ul>
      </div>

      <div class="message">
        <p>Si no solicitaste esta recuperación, ignora este mensaje o contáctanos de inmediato.</p>
        <p><strong>Gracias por confiar en JC Licores.</strong></p>
      </div>
    </div>
     <footer style="
  width: 100%;
  text-align: center;
  font-size: 13px;
  color: white;
  background: linear-gradient(135deg, #004080, #1E90FF);
  padding: 10px;
  margin-top: 30px;
  user-select: none;
">
  © JC Licores 2025
</footer>
  </div>


</body>
</html>
