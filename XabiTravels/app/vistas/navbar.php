<?php
if (session_status() === PHP_SESSION_NONE) session_start();
?>
<nav class="navbar">
    <div class="nav-container">
        
        <div class="nav-left-group">
            <a href="../public/index.php" class="nav-logo">
                <img src="../assets/img/logoxabitravels.png" alt="Logo">
            </a>
            <ul class="nav-menu">
                <li><a href="../public/index.php" class="nav-link">Inicio</a></li>
            </ul>
        </div>

        <div class="nav-auth">
            
            <button id="btn-search-trigger" class="nav-search-btn">
            Buscar
            </button>
            <?php if(isset($_SESSION['user_id'])) { ?>
               <?php if(isset($_SESSION['es_admin']) && $_SESSION['es_admin'] == 1) { ?>
                   <a href="../admin/ver_viajes.php" class="nav-btn-admin">Admin</a>
               <?php } ?>
               <a href="../public/logout.php" class="nav-btn-logout">Cerrar sesión</a>
           <?php } else { ?>
               <a href="../public/login.php" class="nav-link-login"><strong>Entrar</strong></a>
               <a href="../public/registro.php" class="nav-btn-register">Registro</a>
           <?php } ?>
        </div>
    </div>
</nav>

<div id="search-slider" class="search-slider">
    <div class="slider-header">
        <h3>FILTRAR VIAJES</h3>
        <button id="close-search" class="close-btn">&times;</button>
    </div>

    <form action="../public/buscador.php" method="GET" class="search-form">
        
        <div class="filter-group">
            <label>TIPO DE VIAJE</label>
            <select name="tipo" class="form-control">
                <option value="">Todos</option>
                <option value="Aventura">Aventura</option>
                <option value="Relax">Relax</option>
                <option value="Cultural">Cultural</option>
                <option value="Romantico">Romántico</option>
                <option value="Gastronomico">Gastronómico</option>
            </select>
        </div>

        <div class="filter-group">
            <label>DESTINO</label>
            <select name="continente" class="form-control">
                <option value="">Cualquier destino</option>
                <option value="Europa">Europa</option>
                <option value="Asia">Asia</option>
                <option value="America">América</option>
                <option value="Africa">África</option>
                <option value="Oceania">Oceanía</option>
            </select>
        </div>

        <div class="filter-group">
            <label>TUS FECHAS DISPONIBLES</label>
            
            <div style="display: flex; gap: 10px;">
                <div style="width: 50%;">
                    <span style="font-size:11px; color:#aaa;">Desde:</span>
                    <input type="date" name="f_inicio" class="form-control">
                </div>
                <div style="width: 50%;">
                    <span style="font-size:11px; color:#aaa;">Hasta:</span>
                    <input type="date" name="f_fin" class="form-control">
                </div>
            </div>
        </div>

        <button type="submit" class="btn-search-action">BUSCAR VIAJES</button>
    </form>
</div>

<div id="search-overlay" class="search-overlay"></div>

<script>
    const slider = document.getElementById('search-slider');
    const overlay = document.getElementById('search-overlay');
    const btnOpen = document.getElementById('btn-search-trigger');
    const btnClose = document.getElementById('close-search');

    function toggleSearch() {
        slider.classList.toggle('active');
        overlay.classList.toggle('active');
    }

    if(btnOpen) btnOpen.addEventListener('click', toggleSearch);
    if(btnClose) btnClose.addEventListener('click', toggleSearch);
    if(overlay) overlay.addEventListener('click', toggleSearch);
</script>