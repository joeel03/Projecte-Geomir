<form method="post" action="{{ route('places.update', $file) }}" enctype="multipart/form-data">
   @method('PUT')
   @csrf
   <div class="form-group">
        <label>Fitxer: </label>
        <br>
        <label for="name">Nombre</label><br>
            <input type="text" id="name" name="name" ><br>
            <label for="description">Descripcion</label><br>
            <input type="text" id="description" name="description" ><br><br>
            <label for="upload">Archivo</label><br>
            <input type="file" id="upload" name="upload" ><br>
            <label for="latitude">Latitude</label><br>
            <input type="text" id="latitude" name="latitude" ><br><br>
            <label for="longitude">Longitude</label><br>
            <input type="text" id="longitude" name="longitude" ><br>
            <label for="category_id">Categoria</label><br>
            <input type="text" id="category_id" name="category_id" ><br><br>
            <label for="visibility_id">Visibilidad</label><br>
            <input type="text" id="visibility_id" name="visibility_id" ><br><br>

            <button type="submit" class="btn btn-primary">  Submit </button>
   </div>
   <button type="submit" class="btn btn-primary">Actualizar</button>
   <button type="reset" class="btn btn-secondary">Reset</button>

</form>
