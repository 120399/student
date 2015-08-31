<!DOCTYPE html>
<html>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
<title>Opprette ny CD</title>
</head>
<body>
<p><?= isset($MSG) ? $MSG : '' ?></p>
<h1>Opprette ny CD</h1>
<form action='CdAddForm.php' method='post'>
Tittel: <input type='text' name = 'title' size = '32'><br>
Artist: <input type='text' name = 'artist' size = '32'><br>
Produksjonsår: <input type='number' name = 'creationYear' size = '4'><br>
Sjanger: <input type='text' name = 'genre' size = '32'><br>
<input type = 'submit'>
</form>
</body>
</html>