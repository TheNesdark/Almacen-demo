<dialog id="createModal" class="rounded-xl shadow-2xl border-0 backdrop:bg-black backdrop:bg-opacity-50 max-w-md w-full p-0">
    <div class="bg-white rounded-xl overflow-hidden">
        <form action="{{ route('fabricantes.store') }}" method="POST">
            @csrf
            <!-- Header -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-white flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Nuevo Fabricante
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
            <div class="p-6 space-y-4">
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
                           placeholder="Nombre del fabricante">
                    @error('nombre')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="create_sector" class="block text-sm font-medium text-gray-700 mb-2">
                        Sector *
                   </label>
                    <select class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('sector') border-red-300 @enderror" 
                            id="create_sector" 
                            name="sector" 
                            required>
                    <option value="">Selecciona un sector</option>
                        <option value="Automotriz">Automotriz</option>
                        <option value="Electrónica">Electrónica</option>
                        <option value="Alimentación">Alimentación</option>
                        <option value="Textil">Textil</option>
                        <option value="Otros">Otros</option>
                    </select>
                    @error('sector')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
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