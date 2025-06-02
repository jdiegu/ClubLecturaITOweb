<?php
session_start();
$idUser = $_SESSION["usuario"];
include_once("models/Libro.php");
include_once("models/Mensaje.php");
$oLibro = new Libro();
$oMensaje = new Mensaje();
$id = -1;
$sErr = "";

try {
    if (isset($_GET["id_libro"]) && !empty($_GET["id_libro"])) {
        $oLibro->setIdLibro($_GET["id_libro"]);
        $id = $oLibro->getIdLibro();
        $oLibro->buscar();
        $oMensaje->setIdLibro($id);
        $arrMsgs = $oMensaje->buscarTodos();

    }
} catch (\Throwable $th) {
    error_log($e->getFile() . " " . $e->getLine() . " " . $e->getMessage(), 0);
    $sErr = "Error en base de datos, comunicarse con el administrador";
}
?>
<?php include_once("header.php"); ?>

<div class="container-foro">
    <div class="foro">
        <div class="mensajes" id="mensajes">


            <?php if ($arrMsgs != null) {
                foreach ($arrMsgs as $oMsg) {
                    ?>

                    <div class="mensaje">
                        <div class="avatar"><img class="avatarImg" src="<?php echo $oMsg->getUsuario()->getImagen() ?>"></div>
                        <div class="contenido">
                            <div class="nombre"> <?php echo $oMsg->getUsuario()->getNombreCompleto() ?> </div>
                            <div class="texto">
                                <?php echo $oMsg->getMensaje() ?>
                            </div>
                        </div>
                        <div class="acciones">
                            <?php if($oMsg->getUsuario()->getNumControl() == $idUser || $_SESSION["tipo"] == 1 ){ ?>
                            <form action="crudMensaje.php" method="POST">
                                <input name="txtOpe" type="hidden" value="eliminar">
                                <input name="idMensaje" type="hidden" value="<?php echo $oMsg->getIdMensaje() ?>">
                                <input name="txtClave" type="hidden" value="<?php echo $id ?>">
                                <button>Borrar</button>
                            </form>
                            <?php } ?>
                        </div>
                    </div>

                    <?php
                }//foreach
            }
            ?>
        </div>

        <form action="crudMensaje.php" method="POST">
            <div class="entrada-mensaje">
                <input name="txtOpe" type="hidden" value="insertar">
                <input name="txtClave" type="hidden" value="<?php echo $id ?>">
                <input type="text" name="mensaje" placeholder="Mensaje" id="inputMensaje">
                <button>Enviar ➤</button>
            </div>
        </form>
    </div>

    <div class="sidebar">
        <div class="portada-foro">
            <img class="img-foro" src="<?php echo $oLibro->getPortada() ?>" alt="Portada del libro">
        </div>
        <p>
            Bienvenido al foro de <br> <?php echo $oLibro->getNombre() ?> <br>
            por favor respeta este espacio de interacción
        </p>
        <p>
            Si tienes algún problema<br>comunícate con un moderador
        </p>
    </div>
</div>

<script src="js/scrollforo.js"></script>

<?php $redi = "foro.php"; ?>
<?php include_once("footer.php"); ?>