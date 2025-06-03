<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


session_start();
require_once('../model/admin-sesionModel.php');
require_once('../model/admin-usuarioModel.php');
require_once('../model/adminModel.php');

/*require_once('../../vendor/autoload.php');
require_once('../../vendor/phpmailer/phpmailer/src/Exception.php');
require_once('../../vendor/phpmailer/phpmailer/src/PHPMailer.php');
require_once('../../vendor/phpmailer/phpmailer/src/SMtp.php');
*/
$tipo = $_GET['tipo'];




//instanciar la clase categoria model
$objSesion = new SessionModel();
$objUsuario = new UsuarioModel();
$objAdmin = new AdminModel();

//variables de sesion
$id_sesion = $_POST['sesion'];
$token = $_POST['token'];

if ($tipo == "listar_usuarios_ordenados_tabla") {
    $arr_Respuesta = array('status' => false, 'msg' => 'Error_Sesion');
    if ($objSesion->verificar_sesion_si_activa($id_sesion, $token)) {
        //print_r($_POST);
        $pagina = $_POST['pagina'];
        $cantidad_mostrar = $_POST['cantidad_mostrar'];
        $busqueda_tabla_dni = $_POST['busqueda_tabla_dni'];
        $busqueda_tabla_nomap = $_POST['busqueda_tabla_nomap'];
        $busqueda_tabla_estado = $_POST['busqueda_tabla_estado'];
        //repuesta
        $arr_Respuesta = array('status' => false, 'contenido' => '');
        $busqueda_filtro = $objUsuario->buscarUsuariosOrderByApellidosNombres_tabla_filtro($busqueda_tabla_dni, $busqueda_tabla_nomap, $busqueda_tabla_estado);
        $arr_Usuario = $objUsuario->buscarUsuariosOrderByApellidosNombres_tabla($pagina, $cantidad_mostrar, $busqueda_tabla_dni, $busqueda_tabla_nomap, $busqueda_tabla_estado);
        $arr_contenido = [];
        if (!empty($arr_Usuario)) {
            // recorremos el array para agregar las opciones de las categorias
            for ($i = 0; $i < count($arr_Usuario); $i++) {
                // definimos el elemento como objeto
                $arr_contenido[$i] = (object) [];
                // agregamos solo la informacion que se desea enviar a la vista
                $arr_contenido[$i]->id = $arr_Usuario[$i]->id;
                $arr_contenido[$i]->dni = $arr_Usuario[$i]->dni;
                $arr_contenido[$i]->nombres_apellidos = $arr_Usuario[$i]->nombres_apellidos;
                $arr_contenido[$i]->correo = $arr_Usuario[$i]->correo;
                $arr_contenido[$i]->telefono = $arr_Usuario[$i]->telefono;
                $arr_contenido[$i]->estado = $arr_Usuario[$i]->estado;
                $opciones = '<button type="button" title="Editar" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target=".modal_editar' . $arr_Usuario[$i]->id . '"><i class="fa fa-edit"></i></button>
                                <button class="btn btn-info" title="Resetear Contraseña" onclick="reset_password(' . $arr_Usuario[$i]->id . ')"><i class="fa fa-key"></i></button>';
                $arr_contenido[$i]->options = $opciones;
            }
            $arr_Respuesta['total'] = count($busqueda_filtro);
            $arr_Respuesta['status'] = true;
            $arr_Respuesta['contenido'] = $arr_contenido;
        }
    }
    echo json_encode($arr_Respuesta);
}

if ($tipo == "registrar") {
    $arr_Respuesta = array('status' => false, 'msg' => 'Error_Sesion');
    if ($objSesion->verificar_sesion_si_activa($id_sesion, $token)) {
        //print_r($_POST);  Realizar para revisar los funcionamientos previos
        //Obtiene datos del formulario
        if ($_POST) {
            $dni = $_POST['dni'];
            $apellidos_nombres = $_POST['apellidos_nombres'];
            $correo = $_POST['correo'];
            $telefono = $_POST['telefono'];
            $password = $_POST['password'];
        // Verifica si hay campos vacíos
            if ($dni == "" || $apellidos_nombres == "" || $correo == "" || $telefono == "" || $password == "") {
                $arr_Respuesta = array('status' => false, 'mensaje' => 'Error, campos vacíos');
            } else {
                //Buscar usuario mediante ID
                $arr_Usuario = $objUsuario->buscarUsuarioByDni($dni);
                if ($arr_Usuario) {
                    // Respuesta de la consulta realizada
                    $arr_Respuesta = array('status' => false, 'mensaje' => 'Registro Fallido, Usuario ya se encuentra registrado');
                } else {
                    // Registrar un nuevo usuario 
                    $id_usuario = $objUsuario->registrarUsuario($dni, $apellidos_nombres, $correo, $telefono, $password);
                    if ($id_usuario > 0) {
                //REspuesta de la validacion de si se registro o no 
                        $arr_Respuesta = array('status' => true, 'mensaje' => 'Registro Exitoso');
                    } else {
                        $arr_Respuesta = array('status' => false, 'mensaje' => 'Error al registrar producto');
                    }
                }
            }
        }
    }
    // Retorno de la Respuesta en formato JSON
    echo json_encode($arr_Respuesta);
}

if ($tipo == "actualizar") {
    $arr_Respuesta = array('status' => false, 'msg' => 'Error_Sesion');
    if ($objSesion->verificar_sesion_si_activa($id_sesion, $token)) {
        //print_r($_POST);
        //repuesta
        if ($_POST) {
            $id = $_POST['data'];
            $dni = $_POST['dni'];
            $nombres_apellidos = $_POST['nombres_apellidos'];
            $correo = $_POST['correo'];
            $telefono = $_POST['telefono'];
            $estado = $_POST['estado'];

            if ($id == "" || $dni == "" || $nombres_apellidos == "" || $correo == "" || $telefono == "" || $estado == "") {
                //repuesta
                $arr_Respuesta = array('status' => false, 'mensaje' => 'Error, campos vacíos');
            } else {
                $arr_Usuario = $objUsuario->buscarUsuarioByDni($dni);
                if ($arr_Usuario) {
                    if ($arr_Usuario->id == $id) {
                        $consulta = $objUsuario->actualizarUsuario($id, $dni, $nombres_apellidos, $correo, $telefono, $estado);
                        if ($consulta) {
                            $arr_Respuesta = array('status' => true, 'mensaje' => 'Actualizado Correctamente');
                        } else {
                            $arr_Respuesta = array('status' => false, 'mensaje' => 'Error al actualizar registro');
                        }
                    } else {
                        $arr_Respuesta = array('status' => false, 'mensaje' => 'dni ya esta registrado');
                    }
                } else {
                    $consulta = $objUsuario->actualizarUsuario($id, $dni, $nombres_apellidos, $correo, $telefono, $estado);
                    if ($consulta) {
                        $arr_Respuesta = array('status' => true, 'mensaje' => 'Actualizado Correctamente');
                    } else {
                        $arr_Respuesta = array('status' => false, 'mensaje' => 'Error al actualizar registro');
                    }
                }
            }
        }
    }
    echo json_encode($arr_Respuesta);
}
if ($tipo == "reiniciar_password") {
    $arr_Respuesta = array('status' => false, 'msg' => 'Error_Sesion');
    if ($objSesion->verificar_sesion_si_activa($id_sesion, $token)) {
        //print_r($_POST);
        $id_usuario = $_POST['id'];
        $password = $objAdmin->generar_llave(10);
        $pass_secure = password_hash($password, PASSWORD_DEFAULT);
        $actualizar = $objUsuario->actualizarPassword($id_usuario, $pass_secure);
        if ($actualizar) {
            $arr_Respuesta = array('status' => true, 'mensaje' => 'Contraseña actualizado correctamente a: ' . $password);
        } else {
            $arr_Respuesta = array('status' => false, 'mensaje' => 'Hubo un problema al actualizar la contraseña, intente nuevamente');
        }
    }
    echo json_encode($arr_Respuesta);
}
if ($tipo == "sent_email_password") {
    $arr_Respuesta = array('status' => false, 'msg' => 'Error_Sesion');
    if($objSesion -> verificar_sesion_si_activa($id_sesion, $token)){
        $datos_sesion = $objSesion->buscarSesionLoginById($id_sesion);
        $datos_usuario = $objUsuario->buscarUsuarioById($datos_sesion->id_usuario);
        $llave = $objAdmin->generar_llave(30);
        $token = password_hash($llave, PASSWORD_DEFAULT);
        $update = $objUsuario->updateResetPassword($datos_sesion->id_usuario, $llave, 1);
        if ($update) {
         //Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function

//Load Composer's autoloader (created by composer, not included with PHPMailer)
//require '../../vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'mail.importecsolutions.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'sisga_ramirez@importecsolutions.com';                     //SMTP username
    $mail->Password   = 'sisga_ramirez';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('sisga_ramirez@importecsolutions.com', 'Cambio de Contraseña');
    $mail->addAddress($datos_usuario->correo, $datos_usuario->nombres_apellidos);     //Add a recipient
   /* $mail->addAddress('ellen@example.com');               //Name is optional
    $mail->addReplyTo('info@example.com', 'Information');
    $mail->addCC('cc@example.com');
    $mail->addBCC('bcc@example.com');

    //Attachments
    $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
*/
    //Content
    $mail->isHTML(true);   
    $mail->CharSet = 'UTF-8';                         
    $mail->Subject = 'Cambio de Contraseña - Sistema de  Inventario';
    $mail->Body    = '






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
       <div style="width: 100%; text-align: center;">
  <div style="margin-bottom: 8px;">
    Tiempo para restablecer la contraseña:
  </div>
  <div>
    02:00:00
  </div>
</div>



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





    ';
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
        }else{
            echo "Fallo al actualizarlo";
        }
       // print_r($token);
    }
}