<form method="post" action="{{ route('places.update', $file) }}" enctype="multipart/form-data">
   @method('PUT')
   @csrf
   <div class="form-group">
        <label>Fitxer: {{ $file->filepath }}</label>
        <br>
        <label for="name">Nombre</label><br>
                        <input type="text" id="name" name="name" ><br>
                        <label for="description">Descripcion</label><br>
                        <input type="text" id="description" name="description" ><br><br>
                        <label for="upload">Arxivo</label><br>
                        <input type="file" id="upload" name="upload" ><br>
                        <label for="latitud">Latitud</label><br>
                        <input type="text" id="latitud" name="latitud" ><br><br>
                        <label for="longitud">Longitud</label><br>
                        <input type="text" id="longitud" name="longitud" ><br>
                        <label for="category">Categoria</label><br>
                        <input type="text" id="category" name="category" ><br><br>
                        <label for="visibility">Visibilidad</label><br>
                        <input type="text" id="visibility" name="visibility" ><br><br>
                        <button type="submit" class="btn btn-primary">  Submit </button>
   </div>
   <button type="submit" class="btn btn-primary">Actualizar</button>
   <button type="reset" class="btn btn-secondary">Reset</button>

</form>
