<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Gerar PDF</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="conteiner" style="margin-top: 50px; text-align: center; width: 50%; margin-left: auto; margin-right: auto;">
        <h1 class="display-4">Gerar PDF com Nome</h1>
        <form action="{{ route('pdf.gerar') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
        @csrf
        <div class="mb-3">
            <label for="nomes" class="form-label">Lista de nomes (um por linha):</label>
            <textarea name="nomes" rows="6" cols="40" required class="form-control"></textarea>
            <div class="invalid-feedback">
                Por favor, informe a lista de nomes.
            </div>
        </div>
        <div class="mb-3">
            <label for="pdf_principal" class="form-label">PDF Holerite:</label>
            <input type="file" name="pdf_principal" accept="application/pdf" required class="form-control">
            <div class="invalid-feedback">
                Por favor, selecione o PDF principal.
            </div>
        </div>
        <div class="mb-3">
            <label for="pdf_secundario" class="form-label">PDF Ponto:</label>
            <input type="file" name="pdf_secundario" accept="application/pdf" required class="form-control">
            <div class="invalid-feedback">
                Por favor, selecione o PDF secundário.
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Gerar PDF Único</button>
        </form>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>
