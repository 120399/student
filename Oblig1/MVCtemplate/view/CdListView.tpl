<html>
<head>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
    <title>CD-oversikt</title>
</head>
<body>
<h1>CD-oversikt</h1>
<p>Registrerte cd-er: <?= $COUNT ?>
</p>
<table>
    <thead>
    <tr>
        <th>Tittel</th><th>Artist</th><th>Sjanger</th><th>Utgivelsesår</th>
    </tr>
    </thead>
    <tbody>
<?= $CD_TABLE ?>
    </tbody>
</table>
</body>
</html>