<div class="w-full   pt-4 px-10 block justify-center">



    <div class="max-w-8xl ">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Administrar Usuarios') }}
            </h2>
        </x-slot>
        <div class="w-[80vw]   mx-auto  flex justify-between mb-4">

            <select id="countries" class="w-60 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5" wire:model.live="countRow">

                <option value="10">10 Registros</option>
                <option value="25">25 Registros</option>
                <option value="50">50 Registros</option>
                <option value="100">100 Registros</option>
            </select>
            <button type="button" wire:click="addOrEdit()" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center me-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">

                <svg fill="#ffffff" class="w-3.5 h-3.5 me-2" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 537.947 537.947" xml:space="preserve" stroke="#ffffff">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <g>
                            <path d="M268.974,0C120.411,0,0,120.411,0,268.974c0,148.563,120.411,268.973,268.974,268.973s268.973-120.334,268.973-268.973 C537.947,120.334,417.537,0,268.974,0z M394.51,286.033c0,11.857-9.715,21.496-21.496,21.496h-64.566v64.566 c0,11.857-9.715,21.496-21.496,21.496h-35.878c-11.857,0-21.497-9.715-21.497-21.496v-64.566h-64.566 c-11.857,0-21.497-9.715-21.497-21.496v-35.878c0-11.857,9.715-21.497,21.497-21.497h64.566v-64.566 c0-11.857,9.715-21.496,21.497-21.496h35.878c11.857,0,21.496,9.715,21.496,21.496v64.566h64.566 c11.857,0,21.496,9.716,21.496,21.497V286.033z"></path>
                        </g>
                    </g>
                </svg>
                Agregar
            </button>
        </div>

        <!-- component -->
        <!-- responsive table-->
        <div class="mt-2 w-full">
            <div class="w-[80vw] mx-auto my-4">
                {{ $users->links() }}
            </div>

            <table class="mx-auto  w-[80vw] ">
                <thead class="justify-between">
                    <tr class="bg-green-600">

                        <th class="px-16 py-2">
                            <span class="text-gray-100 font-semibold">Nombre</span>
                        </th>

                        <th class="px-16 py-2">
                            <span class="text-gray-100 font-semibold">Email</span>
                        </th>

                        <th class="px-16 py-2">
                            <span class="text-gray-100 font-semibold">Role</span>
                        </th>

                        <th class="px-16 py-2">
                            <span class="text-gray-100 font-semibold">Ultima Actualización</span>
                        </th>

                        <th class="px-16 py-2">
                            <span class="text-gray-100 font-semibold">Fecha Creación</span>
                        </th>

                        <th class="px-16 py-2">
                            <span class="text-gray-100 font-semibold">Activo</span>
                        </th>
                        <th class="px-16 py-2">
                            <span class="text-gray-100 font-semibold">Acciones</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-gray-200">
                    @forelse ($users as $UserItem )
                    <tr class="bg-white border-b-2 border-gray-200 text-center">

                        <td>
                            <span class="text-center ml-2 font-semibold">{{ $UserItem->name }}</span>
                        </td>

                        <td>
                            <span class="text-center ml-2 font-semibold">{{ $UserItem->email ?? "" }}</span>
                        </td>

                        <td>
                            <span class="text-center ml-2 font-semibold">{{ $UserItem->role->name ?? "" }}</span>
                        </td>
                        <td class="px-16 py-2">
                            <span>{{ $UserItem->updated_at }}</span>
                        </td>
                        <td class="px-16 py-2">
                            <span>{{ $UserItem->created_at }}</span>
                        </td>
                        <td class="px-16 py-2">
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="checkbox" wire:click="setActive({{ $UserItem->id }})" class="sr-only peer" {{ $UserItem->active ? 'checked' : '' }}>

                                <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                            </label>

                        </td>
                        <td class="px-16 py-2 flex justify-center">
                            <span class="text-yellow-500 flex" wire:click="addOrEdit({{ $UserItem->id }})">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-700 mx-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                    <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                                </svg>

                            </span>
                        </td>
                    </tr>
                    @empty

                    @endforelse


                </tbody>
            </table>

            <div class="w-[80vw] mx-auto my-4">
                {{ $users->links() }}
            </div>

        </div>


    </div>

    <x-modalSet wire:model.live="showModal" maxWidth2="max-w-[80%]" close="showModal">

        <x-slot name="content">
            <div class="w-full  p-4">
                <button wire:click.prevent="storeOrUpdate" class="text-white float-right mt-4 bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center me-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                    {{ isset($data['id']) ? "Actualizar" : "Guardar" }}
                </button>
                <h2 class="text-2xl font-extrabold my-4" wire:click="storeOrUpdate">{{ isset($data['id']) ? "Actualizar" : "Agregar" }} Usuario</h2>
                <div class="w-full grid grid-cols-2 gap-4">
                    <div>
                        <x-label for="name" value="Nombre" />
                        <x-input id="name" type="text" wire:model="data.name" placeholder="Ingrese el nombre" class="w-full rounded-lg my-2 border-[#E2E8F0]" />
                        <x-input-error for="data.name" />
                    </div>
                    <div>
                        <x-label for="email" value="Correo Electronico" />
                        <x-input id="email" type="text" wire:model="data.email" placeholder="Ingrese el email" class="w-full rounded-lg my-2 border-[#E2E8F0]" />
                        <x-input-error for="data.email" />
                    </div>
                </div>
                @if (!isset($data['id']))
                <div class="w-full grid grid-cols-2 gap-4 my-2">
                    <div>
                        <x-label for="password" value="Contraseña" />
                        <x-password id="password" model="data.password" placeholder="Ingrese el nombre" class="w-full rounded-lg my-2 border-[#E2E8F0]" />
                        <x-input-error for="data.password" />
                    </div>
                    <div>
                        <x-label for="confirm" value="Confirmar contraseña" />
                        <x-password model="data.password_confirmation" placeholder="confirme" class="w-full rounded-lg my-2 border-[#E2E8F0]" />
                        <x-input-error for="data.password_confirmation" />
                    </div>
                </div>
                @endif

                <div class="w-full grid grid-cols-2 gap-4">
                    <div class="flex align-middle gap-[1vw]">
                        <x-label for="name" value="Rol : " />

                        <select id="countries" class="w-60 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5" wire:model.live="data.role_id">

                            <option value="{{ null }}">-- Seleccione un rol --</option>
                            @foreach ($roles as $roleItem)
                            <option value="{{ $roleItem->id }}">{{ $roleItem->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error for="data.role_id" />
                    </div>
                </div>


            </div>

        </x-slot>

    </x-modalSet>


</div>
