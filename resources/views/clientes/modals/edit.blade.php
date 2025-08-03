<!-- Modal Editar Cliente -->
<div x-show="showEditModal" 
     x-transition:enter="ease-out duration-300" 
     x-transition:enter-start="opacity-0" 
     x-transition:enter-end="opacity-100" 
     x-transition:leave="ease-in duration-200" 
     x-transition:leave-start="opacity-100" 
     x-transition:leave-end="opacity-0" 
     class="relative z-50" 
     style="display: none;">
    
    <!-- Overlay -->
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

    <!-- Modal -->
    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div x-show="showEditModal" 
                 x-transition:enter="ease-out duration-300" 
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" 
                 x-transition:leave="ease-in duration-200" 
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" 
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                 @click.away="closeEditModal()"
                 class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
                
                <!-- Header -->
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold leading-6 text-gray-900">Editar Cliente</h3>
                    <button @click="closeEditModal()" type="button" class="text-gray-400 hover:text-gray-600">
                        <span class="sr-only">Cerrar</span>
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Formulario -->
                <form :action="`{{ route('clientes.index') }}/${editingCliente.id}`" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')
                    
                    <!-- Nombre -->
                    <div>
                        <label for="edit_nombre" class="block text-sm font-medium leading-6 text-gray-900">Nombre *</label>
                        <div class="mt-2">
                            <input type="text" 
                                   name="nombre" 
                                   id="edit_nombre" 
                                   required
                                   x-model="editingCliente.nombre"
                                   class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6"
                                   placeholder="Ingrese el nombre">
                        </div>
                    </div>

                    <!-- Apellido -->
                    <div>
                        <label for="edit_apellido" class="block text-sm font-medium leading-6 text-gray-900">Apellido *</label>
                        <div class="mt-2">
                            <input type="text" 
                                   name="apellido" 
                                   id="edit_apellido" 
                                   required
                                   x-model="editingCliente.apellido"
                                   class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6"
                                   placeholder="Ingrese el apellido">
                        </div>
                    </div>

                    <!-- Correo -->
                    <div>
                        <label for="edit_correo" class="block text-sm font-medium leading-6 text-gray-900">Correo Electrónico *</label>
                        <div class="mt-2">
                            <input type="email" 
                                   name="correo" 
                                   id="edit_correo" 
                                   required
                                   x-model="editingCliente.correo"
                                   class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6"
                                   placeholder="ejemplo@correo.com">
                        </div>
                    </div>

                    <!-- Teléfono -->
                    <div>
                        <label for="edit_telefono" class="block text-sm font-medium leading-6 text-gray-900">Teléfono</label>
                        <div class="mt-2">
                            <input type="tel" 
                                   name="telefono" 
                                   id="edit_telefono"
                                   x-model="editingCliente.telefono"
                                   class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6"
                                   placeholder="555-123-4567">
                        </div>
                    </div>

                    <!-- Ciudad -->
                    <div>
                        <label for="edit_ciudad" class="block text-sm font-medium leading-6 text-gray-900">Ciudad</label>
                        <div class="mt-2">
                            <input type="text" 
                                   name="ciudad" 
                                   id="edit_ciudad"
                                   x-model="editingCliente.ciudad"
                                   class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6"
                                   placeholder="Ciudad de México">
                        </div>
                    </div>

                    <!-- País -->
                    <div>
                        <label for="edit_pais" class="block text-sm font-medium leading-6 text-gray-900">País</label>
                        <div class="mt-2">
                            <select name="pais" 
                                    id="edit_pais"
                                    x-model="editingCliente.pais"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                                <option value="">Seleccionar país</option>
                                <option value="México">México</option>
                                <option value="Estados Unidos">Estados Unidos</option>
                                <option value="España">España</option>
                                <option value="Colombia">Colombia</option>
                                <option value="Argentina">Argentina</option>
                                <option value="Chile">Chile</option>
                                <option value="Perú">Perú</option>
                            </select>
                        </div>
                    </div>

                    <!-- Botones -->
                    <div class="mt-6 flex items-center justify-end gap-x-3">
                        <button @click="closeEditModal()" 
                                type="button" 
                                class="rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                            Cancelar
                        </button>
                        <button type="submit" 
                                class="rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">
                            Actualizar Cliente
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>