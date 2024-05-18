<div x-data="{
    secuence: 0,
    messages: [],
    deleteMessage: function(id) {
        this.messages = this.messages.filter(function(message) {
            return message.id != id;
        });
    },
    addMessage: function(message) {
        this.messages.push({
            id: this.secuence++,
            title: message.title,
            message: message.message,
            type: message.type,
            duration: message.duration,
            timmer: null,
            show: true
        });
    }
}" x-init="Livewire.on('addNotification', (message) => { addMessage(message); })">
    <div x-show="messages.length > 0"
         class="fixed top-0 right-0 w-[400px] max-h-screen overflow-y-auto z-[9999999999999] scrollbar-hide overflow-x-hidden">
        <div class="px-5 pt-6 pb-8 w-full">
            <template x-for="message in messages" :key="message.id">
                <div class="pt-2 animate-right-entrance" x-init="message.timmer = setTimeout(() => {
                    message.show = false;
                    setTimeout(() => { deleteMessage(message.id); }, 500);
                }, message.duration)" x-show="message.show"
                     x-transition:out.opacity.duration.500ms x-transition:leave.opacity.duration.500ms>
                    <div
                        :class="'border-l-4 rounded-r-lg flex items-center text-white w-full p-5 relative drop-shadow-lg ' +
                        (message.type == 'danger' ? 'bg-red-700 border-red-500' :
                            message.type == 'warning' ? 'bg-yellow-700 border-yellow-500' :
                            message.type == 'info' ? 'bg-cyan-700 border-cyan-500' :
                            'bg-green-700 border-green-500')">
                        <svg x-on:click="
                            clearTimeout(message.timmer);
                            message.show = false;
                            setTimeout(() => {deleteMessage(message.id);}, 500);"
                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                             :class="'w-5 h-5 absolute top-2 right-2 cursor-pointer ' +
                            (message.type == 'danger' ? 'text-red-400' :
                                message.type == 'warning' ? 'text-yellow-400' :
                                message.type == 'info' ? 'text-cyan-400' :
                                'text-green-400')">
                            <path fill-rule="evenodd"
                                  d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z"
                                  clip-rule="evenodd"/>
                        </svg>
                        <div class="flex flex-col" style="text-shadow: 1px 1px 1px #000c;">
                            <h2 class="popin-bold text-lg" x-text="message.title"></h2>
                            <p class="popin-regular text-sm" x-html="message.message"></p>
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </div>
</div>
