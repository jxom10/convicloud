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







@endsection
