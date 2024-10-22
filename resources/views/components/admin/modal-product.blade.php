<div id="productModal" class="fixed inset-0 bg-gray-800 bg-opacity-70 hidden justify-center items-center" onclick="closeModal(event)">
    <div class="bg-white p-6 rounded-lg shadow-lg max-w-lg w-full relative" onclick="event.stopPropagation()">
        <h2 id="modalProductName" class="text-2xl font-bold mb-2 text-gray-800"></h2>
        <p id="modalProductDescription" class="mb-4 text-gray-600"></p>
        <img id="modalProductImage" class="w-full h-48 object-cover mb-4 rounded-lg shadow-md" alt="Product Image" />
        <p id="modalProductPrice" class="text-lg font-semibold mb-2 text-gray-800"></p>
        <p id="modalProductStock" class="mb-4 text-gray-600"></p>
        
        <!-- Icon to close the modal -->
        <button onclick="closeModal()" class="absolute top-3 right-3 text-gray-600 hover:text-gray-800">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <div class="flex justify-end mt-4">
            <a id="modalEditLink" href="#" class="flex items-center text-green-500 hover:text-green-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3H5a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-8h-7z" />
                </svg>
                Edit
            </a>
        </div>
    </div>
</div>
