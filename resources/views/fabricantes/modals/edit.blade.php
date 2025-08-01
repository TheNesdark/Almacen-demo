<dialog id="editModal" class="rounded-xl shadow-2xl border-0 backdrop:bg-black backdrop:bg-opacity-50 max-w-md w-full p-0">
    <div class="bg-white rounded-xl overflow-hidden">
        <form id="editForm" method="POST">
            @csrf
            @method('PUT')
            <!-- Header -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-white flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Editar Fabricante
                    </h3>
                    <button type="button" 
                            onclick="closeModal('editModal')"
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
                    <label for="edit_nombre" class="block text-sm font-medium text-gray-700 mb-2">
                        Nombre *
                    </label>
                    <input type="text" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" 
                           id="edit_nombre" 
                           name="nombre" 
                           required
                           placeholder="Nombre del fabricante">
                </div>
                
                <div>
                    <label for="edit_sector" class="block text-sm font-medium text-gray-700 mb-2">
                        Sector *
                    </label>
                    <select id="edit_sector"
                            name="sector"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                            required>
                        <option value="">Selecciona un sector</option>
                        <option value="Automotriz">Automotriz</option>
                        <option value="Electrónica">Electrónica</option>
                        <option value="Alimentación">Alimentación</option>
                        <option value="Textil">Textil</option>
                        <option value="Otros">Otros</option>
                    </select>
                </div>
            </div>
            
            <!-- Footer -->
            <div class="bg-gray-50 px-6 py-4 flex justify-end space-x-3">
                <button type="button" 
                        onclick="closeModal('editModal')"
                        class="px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500 transition-colors duration-200">
                    Cancelar
                </button>
                <button type="submit" 
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-200 flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Actualizar
                </button>
            </div>
        </form>
    </div>
</dialog>