<?php
//URL del endpoint en tu API .NET
// Consumir el endpoint con file_get_contents (simple)
$context = stream_context_create([
    "ssl" => [
        "verify_peer" => false,
        "verify_peer_name" => false,
        "allow_self_signed" => true
    ]
]);

$response = file_get_contents(
    "https://localhost:7000/api/users",
    false,
    $context
);

//Decodificar JSON
$users = json_decode($response, true);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Consumo de API .NET en PHP</title>
    <style>
        body{
            font-family: Arial, Helvetica, sans-serif;
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            color: #fff;
            margin: 0;
            padding: 20px;
        }
        h1{
            text-align: center;
            text-shadow: 2px 2px 5px #000;
        }
        table{
            width: 80%;
            margin: 30px auto;
            border-collapse: collapse;
            background: rgba(255, 255, 255, 0.1);
            box-shadow: 0 0 15px rgba(0,0,0,0.5);
        }
        th, td{
            padding: 12px;
            border: 1px solid #fff;
            text-align: center;
        }
        th{
            background: rgba(0,0,0,0.3);
        }
        tr:hover {
            background: rgba(255, 255, 255, 0.2);
            cursor: pointer;
        }
        .footer{
            text-align: center;
            margin-top: 40px;
            font-size: 14px;
            opacity: 0.7;
        }
    </style>
</head>
<body>
    <h1>Lista de Productos desde API .NET</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
        </tr>
        <?php if (!empty($users)): ?>
            <?php foreach ($users as $u): ?>
                <tr onclick="alert('Seleccionaste: <?= htmlspecialchars($u['name']) ?>')">
                    <td><?= htmlspecialchars($u['id']) ?></td>
                    <td><?= htmlspecialchars($u['name']) ?></td>
                </tr>

            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="3">No se encontraron usuarios</td></tr>
        <?php endif; ?>
    </table>
    <div class="footer">Demo intrusivo con PHP + API .NET, BTVDS 2026</div>
</body>
</html>