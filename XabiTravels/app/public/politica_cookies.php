<?php
include("../config.php");
$page_title = "Política de Cookies - Xabi Travels";
$additional_css = '<link rel="shortcut icon" href="../assets/img/logoxabitravels.png" type="image/x-icon"><link rel="stylesheet" href="../assets/css/legal.css">';
include("../vistas/header.php");
include("../vistas/navbar.php");
?>

<div class="legal-content">
    <div class="legal-wrapper">
        <h2>Política de Cookies</h2>

        <section class="legal-section">
            <h3>¿Qué son las cookies?</h3>
            <p>
                Las cookies son pequeños archivos de texto que se almacenan en su dispositivo (ordenador, tablet, smartphone) cuando 
                visita un sitio web. Las cookies permiten que el sitio web recuerde sus acciones y preferencias durante un período 
                de tiempo, por lo que no tiene que volver a configurarlas cada vez que regrese al sitio o navegue de una página a otra.
            </p>
        </section>

        <section class="legal-section">
            <h3>¿Qué tipos de cookies utilizamos?</h3>
            <p>
                En Xabi Travels utilizamos los siguientes tipos de cookies:
            </p>
            <h4>Cookies técnicas (necesarias)</h4>
            <p>
                Estas cookies son esenciales para que el sitio web funcione correctamente. Permiten la navegación básica y el acceso 
                a áreas seguras del sitio web. Sin estas cookies, el sitio web no puede funcionar correctamente.
            </p>
            <h4>Cookies de sesión</h4>
            <p>
                Estas cookies permiten que el sitio web recuerde información sobre su sesión de navegación, como el inicio de sesión 
                del usuario, para que no tenga que volver a iniciar sesión en cada página que visita.
            </p>
            <h4>Cookies de preferencias</h4>
            <p>
                Estas cookies permiten que el sitio web recuerde información que cambia la forma en que se comporta o se ve el sitio, 
                como su idioma preferido o la región en la que se encuentra.
            </p>
        </section>

        <section class="legal-section">
            <h3>Tabla de cookies utilizadas</h3>
            <table class="cookies-table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Propósito</th>
                        <th>Duración</th>
                        <th>Tipo</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>PHPSESSID</td>
                        <td>Identificador de sesión del usuario</td>
                        <td>Sesión</td>
                        <td>Técnica</td>
                    </tr>
                    <tr>
                        <td>user_preferences</td>
                        <td>Almacena preferencias del usuario</td>
                        <td>30 días</td>
                        <td>Preferencias</td>
                    </tr>
                </tbody>
            </table>
        </section>

        <section class="legal-section">
            <h3>¿Cómo gestionar las cookies?</h3>
            <p>
                Puede controlar y/o eliminar las cookies como desee. Puede eliminar todas las cookies que ya están en su dispositivo 
                y puede configurar la mayoría de los navegadores para evitar que se coloquen. Sin embargo, si hace esto, es posible 
                que tenga que ajustar manualmente algunas preferencias cada vez que visite un sitio y que algunos servicios y 
                funcionalidades no funcionen.
            </p>
            <p>
                La mayoría de los navegadores le permiten:
            </p>
            <ul>
                <li>Ver qué cookies tiene y eliminarlas individualmente.</li>
                <li>Bloquear cookies de terceros.</li>
                <li>Bloquear cookies de sitios específicos.</li>
                <li>Bloquear todas las cookies.</li>
                <li>Eliminar todas las cookies cuando cierre el navegador.</li>
            </ul>
            <p>
                Para obtener más información sobre cómo gestionar las cookies en los navegadores más populares, puede visitar:
            </p>
            <ul>
                <li><a href="https://support.google.com/chrome/answer/95647" target="_blank">Google Chrome</a></li>
                <li><a href="https://support.mozilla.org/es/kb/habilitar-y-deshabilitar-cookies-sitios-web-rastrear-preferencias" target="_blank">Mozilla Firefox</a></li>
                <li><a href="https://support.microsoft.com/es-es/help/17442/windows-internet-explorer-delete-manage-cookies" target="_blank">Internet Explorer</a></li>
                <li><a href="https://support.apple.com/es-es/guide/safari/sfri11471/mac" target="_blank">Safari</a></li>
            </ul>
        </section>

        <section class="legal-section">
            <h3>Cookies de terceros</h3>
            <p>
                Algunas cookies son colocadas por servicios de terceros que aparecen en nuestras páginas. Actualmente, no utilizamos 
                cookies de terceros para publicidad o seguimiento, pero si en el futuro implementamos servicios de terceros, 
                actualizaremos esta política para informarle adecuadamente.
            </p>
        </section>

        <section class="legal-section">
            <h3>Actualizaciones de esta política</h3>
            <p>
                Podemos actualizar esta Política de Cookies de vez en cuando. Le recomendamos que revise esta página periódicamente 
                para estar informado sobre cómo utilizamos las cookies. La fecha de la última actualización se indica al final de 
                esta política.
            </p>
        </section>

        <section class="legal-section">
            <h3>Contacto</h3>
            <p>
                Si tiene alguna pregunta sobre nuestra Política de Cookies, puede contactarnos a través de:
            </p>
            <ul>
                <li>Email: info@xabitravels.com</li>
                <li>Teléfono: +34 91 234 5678</li>
            </ul>
        </section>
    </div>
</div>

<?php include("../vistas/footer.php"); ?>
