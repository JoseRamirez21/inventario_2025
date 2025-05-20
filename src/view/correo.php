<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Comunicado Oficial - Universidad</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      background-color: #f9f9f9;
      font-family: 'Georgia', serif;
      color: #333;
    }

    .email-container {
      max-width: 680px;
      margin: 50px auto;
      background-color: #fff;
      border: 1px solid #e0e0e0;
      border-radius: 8px;
      overflow: hidden;
    }

    .email-header {
      background-color:#3694e3;
      color: white;
      padding: 30px 40px;
      text-align: center;
    }

    .email-header h1 {
      margin: 0;
      font-size: 26px;
      font-weight: normal;
    }

    .email-body {
      padding: 40px;
    }

    .email-body h2 {
      font-size: 20px;
      margin-top: 0;
      margin-bottom: 20px;
      font-weight: normal;
    }

    .email-body p {
      font-size: 16px;
      line-height: 1.7;
      margin-bottom: 20px;
    }

    .email-footer {
      background-color: #f2f2f2;
      text-align: center;
      padding: 25px;
      font-size: 13px;
      color: #555;
    }

    .email-footer a {
      color: #555;
      text-decoration: underline;
    }

    .button {
      display: inline-block;
      background-color: #3694e3;
      color: white;
      text-decoration: none;
      padding: 12px 24px;
      border-radius: 4px;
      margin-top: 15px;
      font-weight: bold;
    }

    @media (max-width: 700px) {
      .email-body, .email-header, .email-footer {
        padding: 20px !important;
      }
    }
  </style>
</head>
<body>
  <div class="email-container">
    <div class="email-header">
      <h1>I E S T P "HUANTA"</h1>
    </div>
    <div class="email-body">
      <h2>Estimado/a {Nombre del destinatario},</h2>
      <p>
        Le extendemos un cordial saludo en nombre de la Universidad de Harvard. Nos dirigimos a usted para informarle sobre {{motivo o tema del comunicado}}, el cual consideramos de su interés como parte de nuestra comunidad académica.
      </p>
      <p>
        Puede acceder a más detalles a través del siguiente enlace:
      </p>
      <a href="{{URL de destino}}" class="button">Ver detalles</a>
      <p>
        Si tiene alguna consulta adicional, no dude en contactarnos. Agradecemos su atención y compromiso con la excelencia académica.
      </p>
      <p>
        Atentamente,<br><br>
        <strong>Oficina de Comunicaciones<br>I E S T P "HUANTA"</strong>
      </p>
    </div>
    <div class="email-footer">
      © {{Año actual}} I E S T P "HUANTA". Todos los derechos reservados.<br>
      <a href="{{URL de cancelación}}">Cancelar suscripción</a>
    </div>
  </div>
</body>
</html>
