@extends('layouts.app')


@section('contenido')
 <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="fields">
                    <div class="input-group mb-3">
                        <input type="file" class="form-control" id="import_csv" name="import_csv" accept=".csv">
                        <label class="input-group-text" for="import_csv">Upload</label>
                    </div>
                </div>
                <button type="submit" class="btn btn-success">Import CSV</button>
</form>
<h3>formato del fichero csv:</h3>
<p>Tiene que tener en la cabecera los siguientes campos:</p>
Genero;Curso;Grupo;Primer apellido;Segundo apellido;Nombre;NIA;Fnac







@endsection
