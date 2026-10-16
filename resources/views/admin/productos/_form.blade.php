<div class="admin__campo">
    <label for="nombre">Nombre</label>
    <input type="text" id="nombre" name="nombre"
           value="{{ old('nombre', $producto->nombre ?? '') }}" required>
    @error('nombre') <small class="admin__error">{{ $message }}</small> @enderror
</div>

<div class="admin__campo">
    <label for="precio">Precio (RD$)</label>
    <input type="number" id="precio" name="precio" step="0.01" min="0"
           value="{{ old('precio', $producto->precio ?? '') }}" required>
    @error('precio') <small class="admin__error">{{ $message }}</small> @enderror
</div>

<div class="admin__campo">
    <label for="imagen">Ruta de la imagen</label>
    <input type="text" id="imagen" name="imagen" placeholder="img/productos/nike_free_metcon_7.png"
           value="{{ old('imagen', $producto->imagen ?? '') }}" required>
    @error('imagen') <small class="admin__error">{{ $message }}</small> @enderror
</div>

<div class="admin__campo">
    <label for="marca">Marca</label>
    <select id="marca" name="marca" required>
        <option value="">Selecciona...</option>
        @foreach (['nike' => 'Nike', 'converse' => 'Converse'] as $valor => $texto)
            <option value="{{ $valor }}" @selected(old('marca', $producto->marca ?? '') === $valor)>{{ $texto }}</option>
        @endforeach
    </select>
    @error('marca') <small class="admin__error">{{ $message }}</small> @enderror
</div>

<div class="admin__campo">
    <label for="genero">Género</label>
    <select id="genero" name="genero" required>
        <option value="">Selecciona...</option>
        @foreach (['hombre' => 'Hombre', 'mujer' => 'Mujer', 'unisex' => 'Unisex'] as $valor => $texto)
            <option value="{{ $valor }}" @selected(old('genero', $producto->genero ?? '') === $valor)>{{ $texto }}</option>
        @endforeach
    </select>
    @error('genero') <small class="admin__error">{{ $message }}</small> @enderror
</div>

<div class="admin__campo">
    <label for="categoria">Categoría</label>
    <select id="categoria" name="categoria" required>
        <option value="">Selecciona...</option>
        @foreach (['running' => 'Running', 'basketball' => 'Basketball', 'casual' => 'Casual'] as $valor => $texto)
            <option value="{{ $valor }}" @selected(old('categoria', $producto->categoria ?? '') === $valor)>{{ $texto }}</option>
        @endforeach
    </select>
    @error('categoria') <small class="admin__error">{{ $message }}</small> @enderror
</div>

<div class="admin__campo">
    <label for="stock">Stock</label>
    <input type="number" id="stock" name="stock" min="0"
           value="{{ old('stock', $producto->stock ?? '') }}" required>
    @error('stock') <small class="admin__error">{{ $message }}</small> @enderror
</div>