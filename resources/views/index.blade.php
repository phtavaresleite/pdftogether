<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Gerar PDF</title>
</head>
<body>
    <h1>Gerar PDF com Nome</h1>
    <form action="{{ route('pdf.gerar') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label for="nome">Nome:</label>
        <input type="text" name="nome" required>

        <br><br>

        <label for="pdf_principal">PDF Principal:</label>
        <input type="file" name="pdf_principal" accept="application/pdf" required>

        <br><br>

        <label for="pdf_secundario">PDF Secundário:</label>
        <input type="file" name="pdf_secundario" accept="application/pdf" required>

        <br><br>

        <button type="submit">Gerar PDF</button>
    </form>
</body>
</html>
