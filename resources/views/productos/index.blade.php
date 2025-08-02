@extends('layouts.app')

@section('title', 'Productos')
@section('page-title', 'Gestión de Productos')

@section('content')
<div class="space-y-6">
    <!-- Mensajes de éxito -->
    @if(session('success'))
        <div class="bg-green-50 border border-green-200 rounded-lg p-4 flex items-center" x-data="{ show: true }" x-show="show" x-transition>
            <svg class="w-5 h-5 text-green-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span class="text-green-700 flex-1">{{ session('success') }}</span>
            <button @click="show = false" class="text-green-400 hover:text-green-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    @endif

    <!-- Header con botón -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Lista de Productos</h2>
            <p class="text-gray-600 mt-1">Gestiona todos los productos del inventario</p>
        </div>
        <button type="button" 
                onclick="openModal('createModal')"
                class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-200 shadow-sm">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            Nuevo Producto
        </button>
    </div>

    <!-- Tabla de productos -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        @if($productos->count() > 0)
            <!-- Versión Desktop (tabla normal) -->
            <div class="hidden lg:block">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Producto</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fabricante</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Categoría</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Precio</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stock</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($productos as $producto)
                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center mr-3">
                                                <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                                </svg>
                                            </div>
                                            <div>
                                                <div class="text-sm font-medium text-gray-900">{{ $producto->nombre }}</div>
                                                @if($producto->descripcion)
                                                    <div class="text-sm text-gray-500">{{ Str::limit($producto->descripcion, 50) }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $producto->fabricante->nombre }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-purple-100 text-purple-800">
                                            {{ $producto->categoria }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        ${{ number_format($producto->precio, 2) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $producto->stock > 10 ? 'bg-green-100 text-green-800' : ($producto->stock > 0 ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                            {{ $producto->stock }} unidades
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $producto->activo ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $producto->activo ? 'Activo' : 'Inactivo' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                        <button type="button" 
                                                onclick="editProducto({{ $producto->id }}, '{{ $producto->nombre }}', '{{ $producto->descripcion }}', {{ $producto->precio }}, {{ $producto->stock }}, '{{ $producto->categoria }}', {{ $producto->fabricante_id }}, {{ $producto->activo ? 'true' : 'false' }})"
                                                class="inline-flex items-center px-3 py-1 border border-blue-300 rounded-md text-blue-700 bg-blue-50 hover:bg-blue-100 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors duration-200">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </button>
                                        <button type="button" 
                                                onclick="deleteProducto({{ $producto->id }}, '{{ $producto->nombre }}')"
                                                class="inline-flex items-center px-3 py-1 border border-red-300 rounded-md text-red-700 bg-red-50 hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-red-500 transition-colors duration-200">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Versión Mobile/Tablet (cards) -->
            <div class="lg:hidden p-4 space-y-4">
                @foreach($productos as $producto)
                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 shadow-sm">
                        <div class="flex items-start justify-between mb-3">
                            <div class="flex items-center flex-1">
                                <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center mr-3 flex-shrink-0">
                                    <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                    </svg>
                                </div>
                                <div class="min-w-0 flex-1">
                                    <h3 class="text-sm font-medium text-gray-900 truncate">{{ $producto->nombre }}</h3>
                                    <p class="text-xs text-gray-500">{{ $producto->fabricante->nombre }}</p>
                                </div>
                            </div>
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $producto->activo ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }} ml-2 flex-shrink-0">
                                {{ $producto->activo ? 'Activo' : 'Inactivo' }}
                            </span>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-3 text-sm mb-4">
                            <div>
                                <span class="text-gray-500 text-xs">Categoría:</span>
                                <div class="font-medium">
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-purple-100 text-purple-800">
                                        {{ $producto->categoria }}
                                    </span>
                                </div>
                            </div>
                            <div>
                                <span class="text-gray-500 text-xs">Precio:</span>
                                <div class="font-medium text-gray-900">${{ number_format($producto->precio, 2) }}</div>
                            </div>
                            <div class="col-span-2">
                                <span class="text-gray-500 text-xs">Stock:</span>
                                <div class="font-medium">
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $producto->stock > 10 ? 'bg-green-100 text-green-800' : ($producto->stock > 0 ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                        {{ $producto->stock }} unidades
                                    </span>
                                </div>
                            </div>
                        </div>
                        
                        @if($producto->descripcion)
                            <p class="text-xs text-gray-600 mb-4 bg-white p-2 rounded border">{{ Str::limit($producto->descripcion, 100) }}</p>
                        @endif
                        
                        <div class="flex space-x-2">
                            <button type="button" 
                                    onclick="editProducto({{ $producto->id }}, '{{ $producto->nombre }}', '{{ $producto->descripcion }}', {{ $producto->precio }}, {{ $producto->stock }}, '{{ $producto->categoria }}', {{ $producto->fabricante_id }}, {{ $producto->activo ? 'true' : 'false' }})"
                                    class="flex-1 inline-flex items-center justify-center px-3 py-2 border border-blue-300 rounded-md text-blue-700 bg-blue-50 hover:bg-blue-100 text-sm transition-colors duration-200">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                Editar
                            </button>
                            <button type="button" 
                                    onclick="deleteProducto({{ $producto->id }}, '{{ $producto->nombre }}')"
                                    class="flex-1 inline-flex items-center justify-center px-3 py-2 border border-red-300 rounded-md text-red-700 bg-red-50 hover:bg-red-100 text-sm transition-colors duration-200">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                                Eliminar
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12">
                <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                </svg>
                <h3 class="text-lg font-medium text-gray-900 mb-2">No hay productos registrados</h3>
                <p class="text-gray-500 mb-6">Comienza agregando tu primer producto al inventario</p>
                <button type="button" 
                        onclick="openModal('createModal')"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-200">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Crear Primer Producto
                </button>
            </div>
        @endif
    </div>
</div>

<!-- Importar modales -->
@include('productos.modals.create')
@include('productos.modals.edit')
@include('productos.modals.delete')
@endsection

@push('scripts')
<script>
// Funciones para manejar los modales dialog
function openModal(modalId) {
    document.getElementById(modalId).showModal();
}

function closeModal(modalId) {
    document.getElementById(modalId).close();
}

// Cerrar modal al hacer clic en el backdrop
document.addEventListener('click', function(e) {
    if (e.target.tagName === 'DIALOG') {
        e.target.close();
    }
});

// Funciones específicas para productos
function editProducto(id, nombre, descripcion, precio, stock, categoria, fabricanteId, activo) {
    document.getElementById('editForm').action = `/productos/${id}`;
    document.getElementById('edit_nombre').value = nombre;
    document.getElementById('edit_descripcion').value = descripcion || '';
    document.getElementById('edit_precio').value = precio;
    document.getElementById('edit_stock').value = stock;
    document.getElementById('edit_categoria').value = categoria;
    document.getElementById('edit_fabricante_id').value = fabricanteId;
    document.getElementById('edit_activo').checked = activo;
    openModal('editModal');
}

function deleteProducto(id, nombre) {
    document.getElementById('deleteForm').action = `/productos/${id}`;
    document.getElementById('deleteName').textContent = nombre;
    openModal('deleteModal');
}

// Mostrar modal de crear si hay errores de validación
@if($errors->any() && !request()->has('_method'))
    document.addEventListener('DOMContentLoaded', function() {
        openModal('createModal');
    });
@endif

// Cerrar modal con tecla Escape
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        const openModals = document.querySelectorAll('dialog[open]');
        openModals.forEach(modal => modal.close());
    }
});
</script>
@endpush