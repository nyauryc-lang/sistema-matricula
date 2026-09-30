<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Constancia de Matrícula</title>
    <style>
        body { font-family: DejaVu Sans, Arial, sans-serif; margin: 30px; font-size: 13px; color: #333; }
        .header { text-align: center; margin-bottom: 25px; border-bottom: 2px solid #1a365d; padding-bottom: 12px; }
        .header h2 { margin: 0; color: #1a365d; font-size: 22px; letter-spacing: 1px; }
        .header p { margin: 5px 0 0 0; color: #555; font-size: 12px; }
        .badge { display: inline-block; padding: 3px 8px; border-radius: 4px; font-weight: bold; }
        .badge-success { background: #d4edda; color: #155724; }
        .info-table { width: 100%; border-collapse: collapse; margin-bottom: 25px; }
        .info-table td { padding: 6px 10px; }
        .courses-table { width: 100%; border-collapse: collapse; margin-top: 15px; margin-bottom: 20px; }
        .courses-table th, .courses-table td { border: 1px solid #cbd5e1; padding: 9px 12px; }
        .courses-table th { background-color: #f1f5f9; color: #1e293b; font-weight: bold; text-align: left; }
        .total-box { margin-top: 15px; text-align: right; font-size: 14px; font-weight: bold; color: #1a365d; }
        .footer-note { margin-top: 50px; font-size: 10px; color: #888; text-align: center; border-top: 1px solid #e2e8f0; padding-top: 10px; }
        .signature-section { margin-top: 60px; width: 100%; }
        .signature-box { width: 220px; border-top: 1px solid #333; text-align: center; margin: 0 auto; font-size: 11px; padding-top: 5px; }
    </style>
</head>
<body>

    <div class="header">
        <h2>IEST LA RECOLETA</h2>
        <p>Arequipa, Perú — Constancia Oficial de Matrícula Académica</p>
    </div>

    <table class="info-table">
        <tr>
            <td style="width: 50%;"><strong>Estudiante:</strong> <?= htmlspecialchars($data['nombres'] . ' ' . $data['apellidos']) ?></td>
            <td style="width: 50%;"><strong>Email:</strong> <?= htmlspecialchars($data['email'] ?? 'No registrado') ?></td>
        </tr>
        <tr>
            <td><strong>Fecha de Matrícula:</strong> <?= htmlspecialchars($data['fecha_matricula'] ?? $data['fechaMatricula']) ?></td>
            <td><strong>Estado:</strong> <span class="badge badge-success"><?= strtoupper(htmlspecialchars($data['estado'])) ?></span></td>
        </tr>
        <tr>
            <td><strong>N° de Matrícula:</strong> MAT-<?= str_pad($data['id'], 6, '0', STR_PAD_LEFT) ?></td>
            <td><strong>Fecha de Emisión:</strong> <?= date('d/m/Y H:i') ?></td>
        </tr>
    </table>

    <h4 style="color: #1a365d; margin-bottom: 5px;">Asignaturas Matriculadas</h4>
    <table class="courses-table">
        <thead>
            <tr>
                <th style="width: 10%; text-align: center;">#</th>
                <th style="width: 70%;">Asignatura / Curso</th>
                <th style="width: 20%; text-align: center;">Créditos</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $i = 1;
            foreach ($data['cursos'] as $curso): ?>
                <tr>
                    <td style="text-align: center;"><?= $i++ ?></td>
                    <td><?= htmlspecialchars($curso['nombre_curso']) ?></td>
                    <td style="text-align: center;"><?= htmlspecialchars($curso['creditos']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="total-box">
        Total de Créditos Matriculados: <?= htmlspecialchars($data['total_creditos'] ?? $data['totalCreditos']) ?>
    </div>

    <table class="signature-section">
        <tr>
            <td style="text-align: center;">
                <div class="signature-box">
                    Dirección Académica<br>
                    IEST La Recoleta
                </div>
            </td>
        </tr>
    </table>

    <div class="footer-note">
        Este documento constituye constancia oficial generada por el Sistema de Matrícula de IEST La Recoleta. Documento válido sin enmendaduras.
    </div>

</body>
</html>