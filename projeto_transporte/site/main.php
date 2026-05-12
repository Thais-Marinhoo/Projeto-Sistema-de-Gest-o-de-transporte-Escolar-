<?php
session_start();
if(!isset($_SESSION['email'])){
    header("Location: ../index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Rota Certa</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Ícones -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- CSS da Home -->
    <link rel="stylesheet" href="mstyle.css">
    <!-- Leaflet (mapa) -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-sA+e2m6tYkG6kGk8p2bM8JQx0b0g1bQKpFf5pBf3wYk=" crossorigin=""/>
</head>

<body>

<?php include 'menu.php'; ?>


<div class="conteudo">

    <h1 class="titulo">Dashboard</h1>

    <div class="cards">
        <div class="card-info">
            <span class="material-icons icon">groups</span>
            <div>
                <p>Total de alunos</p>
                <h2>350</h2>
            </div>
        </div>

        <div class="card-info">
            <span class="material-icons icon">route</span>
            <div>
                <p>Total de rotas</p>
                <h2>9</h2>
            </div>
        </div>

        <div class="card-info">
            <span class="material-icons icon">directions_bus</span>
            <div>
                <p>Ônibus ativos</p>
                <h2>15</h2>
            </div>
        </div>
    </div>

    <div class="mapa">
         <!-- Div do mapa (preenchida pelo Leaflet) -->
         <div id="map"></div>
    </div>

</div>

<!-- Scripts do Leaflet NÂO SEI SE FUNCIONA -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-o9N1j8kT7H2jvQv6k0v1s2mLZs8b6Z9jv+qj0f5mQ2M=" crossorigin=""></script>
<script>
    // Inicializa o mapa centrado em Crateús (CE) - coordenadas aproximadas
    const map = L.map('map').setView([-5.1648, -40.3794], 13);

    // Camada base OpenStreetMap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    // Nota: por enquanto não adicionamos marcadores — apenas o mapa base
</script>

</body>
</html>