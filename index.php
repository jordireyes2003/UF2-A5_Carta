<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carta del Restaurante</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
    <div style="text-align: center;">
    <h1>🍴O Pote Gallego🥩</h1>
    </div>

        <div class="columnas-container">
            <div class="columnas">
                <?php
                $xml = simplexml_load_file('carta.xml');
                $platos_por_tipo = array();

                // Agrupar platos por tipo
                foreach ($xml->plato as $plato) {
                    $tipo = (string)$plato['tipo'];
                    $platos_por_tipo[$tipo][] = $plato;
                }

                // Imprimir primeros y segundos en columnas
                foreach (array('Primero', 'Marisco') as $tipo) {
                    echo '<div class="columna">';
                    echo '<h2 style="text-align: center;">' . ucfirst($tipo) . '</h2>';
                    foreach ($platos_por_tipo[$tipo] as $plato) {
                        imprimirPlato($plato);
                    }
                    echo '</div>';
                }

                // Función para imprimir cada plato
                function imprimirPlato($plato) {
                    echo '<div class="plato">';
                    echo '<h3>' . $plato->nombre . '</h3>';
                    if (!empty($plato->imagen)) {
                        echo '<img src="' . $plato->imagen . '" alt="' . $plato->nombre . '"width="150";>';
                    }
                    echo '<p><strong>Precio:</strong> ' . $plato->precio . '</p>';
                    echo '<p><strong>Descripción:</strong> ' . $plato->descripcion . '</p>';
                    echo '<p><strong>Calorías:</strong> ' . $plato->calorias . '</p>';
                    echo '<p><strong>Características:</strong>';
                    echo '<ul>';
                    foreach ($plato->ingredientes->categoria as $categoria) {
                        echo '<li>' . $categoria . '</li>';
                    }
                    echo '</ul></p>';
                    echo '</div>';
                }
                ?>
            </div>
            <div class="columnas">
                <?php
                // Imprimir marisco y postre en columnas
                foreach (array('Segundos', 'Postre') as $tipo) {
                    echo '<div class="columna">';
                    echo '<h2 style="text-align: center;">' . ucfirst($tipo) . '</h2>';
                    foreach ($platos_por_tipo[$tipo] as $plato) {
                        imprimirPlato($plato);
                    }
                    echo '</div>';
                }
                ?>
            </div>
        </div>
        
        <div class="columnas-container">
            <div class="columnas">
                <?php
                // Imprimir refrescos en columnas
                echo '<div class="columna">';
                echo '<h2>Refrescos</h2>';
                foreach ($platos_por_tipo['Refrescos'] as $plato) {
                    imprimirPlato($plato);
                }
                echo '</div>';
                ?>
            </div>
            <div class="columnas">
                <?php
                // Imprimir vinos en columnas
                echo '<div class="columna">';
                echo '<h2>Vinos</h2>';
                foreach ($platos_por_tipo['Vinos'] as $plato) {
                    imprimirPlato($plato);
                }
                echo '</div>';
                ?>
                
            </div>
        </div>
    </div>
</body>
</html>

