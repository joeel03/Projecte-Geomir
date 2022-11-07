<form method="post" action="{{ route('files.update', $file) }}" enctype="multipart/form-data">
   @method('PUT')
   @csrf
   <div class="form-group">
        <label>Fitxer: {{ $file->filepath }}</label>
        <br>
        <label for="upload">Nou fitxer:</label>
        <input type="file" class="form-control" name="upload"/>
   </div>
   <button type="submit" class="btn btn-primary">Actualizar</button>
   <button type="reset" class="btn btn-secondary">Reset</button>

</form>
