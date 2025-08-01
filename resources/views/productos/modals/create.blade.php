<dialog id="createModal" class="rounded-xl shadow-2xl border-0 backdrop:bg-black backdrop:bg-opacity-50 max-w-lg w-full p-0">
    <div class="bg-white rounded-xl overflow-hidden">
        <form action="{{ route('productos.store') }}" method="POST">
            @csrf
            <!-- Header -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-white flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Nuevo Producto
                    </h3>
                    <button type="button" 
                            onclick="closeModal('createModal')"
                            class="text-white hover:text-gray-200 transition-colors duration-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
            
            <!-- Body -->
            <div class="p-6 space-y-4 max-h-96 overflow-y-auto">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="create_nombre" class="block text-sm font-medium text-gray-700 mb-2">
                            Nombre *
                        </label>
                        <input type="text" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('nombre') border-red-300 @enderror" 
                               id="create_nombre" 
                               name="nombre" 
                               value="{{ old('nombre') }}" 
                               required
                               placeholder="Nombre del producto">
                        @error('nombre')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="create_fabricante_id" class="block text-sm font-medium text-gray-700 mb-2">
                            Fabricante *
                        </label>
                        <select class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('fabricante_id') border-red-300 @enderror" 
                                id="create_fabricante_id" 
                                name="fabricante_id" 
                                required>
                            <option value="">Selecciona un fabricante</option>
                            @foreach(App\Models\Fabricante::all() as $fabricante)
                                <option value="{{ $fabricante->id }}" {{ old('fabricante_id') == $fabricante->id ? 'selected' : '' }}>
                                    {{ $fabricante->nombre }}
                                </option>
                            @endforeach
                        </select>
                        @error('fabricante_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="create_descripcion" class="block text-sm font-medium text-gray-700 mb-2">
                        Descripción
                    </label>
                    <textarea class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('descripcion') border-red-300 @enderror" 
                              id="create_descripcion" 
                              name="descripcion" 
                              rows="3"
                              placeholder="Descripción del producto">{{ old('descripcion') }}</textarea>
                    @error('descripcion')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label for="create_precio" class="block text-sm font-medium text-gray-700 mb-2">
                            Precio *
                        </label>
                        <input type="number" 
                               step="0.01"
                               min="0"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('precio') border-red-300 @enderror" 
                               id="create_precio" 
                               name="precio" 
                               value="{{ old('precio') }}" 
                               required
                               placeholder="0.00">
                        @error('precio')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="create_stock" class="block text-sm font-medium text-gray-700 mb-2">
                            Stock *
                        </label>
                        <input type="number" 
                               min="0"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('stock') border-red-300 @enderror" 
                               id="create_stock" 
                               name="stock" 
                               value="{{ old('stock', 0) }}" 
                               required
                               placeholder="0">
                        @error('stock')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="create_categoria" class="block text-sm font-medium text-gray-700 mb-2">
                            Categoría *
                        </label>
                        <select class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('categoria') border-red-300 @enderror" 
                                id="create_categoria" 
                                name="categoria" 
                                required>
                            <option value="">Selecciona categoría</option>
                            <option value="Electrónicos" {{ old('categoria') == 'Electrónicos' ? 'selected' : '' }}>Electrónicos</option>
                            <option value="Ropa" {{ old('categoria') == 'Ropa' ? 'selected' : '' }}>Ropa</option>
                            <option value="Hogar" {{ old('categoria') == 'Hogar' ? 'selected' : '' }}>Hogar</option>
                            <option value="Deportes" {{ old('categoria') == 'Deportes' ? 'selected' : '' }}>Deportes</option>
                            <option value="Libros" {{ old('categoria') == 'Libros' ? 'selected' : '' }}>Libros</option>
                            <option value="Otros" {{ old('categoria') == 'Otros' ? 'selected' : '' }}>Otros</option>
                        </select>
                        @error('categoria')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex items-center">
                    <input type="checkbox" 
                           class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" 
                           id="create_activo" 
                           name="activo" 
                           {{ old('activo', true) ? 'checked' : '' }}>
                    <label for="create_activo" class="ml-2 block text-sm text-gray-700">
                        Producto activo
                    </label>
                </div>
            </div>
            
            <!-- Footer -->
            <div class="bg-gray-50 px-6 py-4 flex justify-end space-x-3">
                <button type="button" 
                        onclick="closeModal('createModal')"
                        class="px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500 transition-colors duration-200">
                    Cancelar
                </button>
                <button type="submit" 
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-200 flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Guardar
                </button>
            </div>
        </form>
    </div>
</dialog>