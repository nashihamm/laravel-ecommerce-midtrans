<div x-data="{ show: false, message: '' }" 
     x-show="show" 
     x-init="@this.on('notify', message => { show = true; message = message; setTimeout(() => show = false, 3000) })"
     class="fixed top-5 right-5 z-50">
    <div x-text="message" class="bg-green-500 text-white p-4 rounded-lg shadow-lg"></div>
</div>
