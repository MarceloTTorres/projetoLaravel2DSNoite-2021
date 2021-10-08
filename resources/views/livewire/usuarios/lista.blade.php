<x-slot name="header">
    <h2 class="text-xl font-thin leading-tight text-gray-800 text-center">
        {{ __('Usuários') }}
    </h2>
</x-slot>

<div class="py-12" wire:poll>
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
    <div class="py-2">
            <div class="grid grid-flow-col grid-rows-1">
                <div class="row-span-1 row-end-1">
                    <div class="inline-flex items-center p-2 text-sm leading-none text-purple-600 bg-white rounded-full shadow text-teal">
                        <span wire:click.prevent="novo()" class="inline-flex items-center justify-center h-6 px-4 text-white bg-indigo-600 rounded-full cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                        </span>
                        <span class="inline-flex px-2">Clique no botão para cadastrar um novo usuário.</span>
                    </div>
                </div>
                <div class="row-span-1 row-end-1 " >
                    <div class="inline-block align-bottom">
                        {{ date("d/m/Y H:i") }} 
                    </div>
                </div>
                <div class="row-span-1 row-end-1 items-center">
                    <div class="text-xs text-right">
                    Exibir
                    <select wire:model="itensPaginas" class="mx-2 text-xs border rounded text-grey-darker" dir="rtl">
                            <option value="10">10</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                            <option value="500">500</option>
                            <option value="1000">1000</option>
                        </select>
                        <input type="text" wire:model="termo" class="mx-2 text-xs uppercase rounded" placeholder="Pesquisar...">
                        <div class="relative inline-block w-10 mr-2 align-middle transition duration-200 ease-in select-none">
                            <input type="checkbox" wire:model="bloqueados" id="bloqueados" name="bloqueados" value="1" class="absolute block w-5 h-5 bg-white rounded-full appearance-none cursor-pointer border-1 toggle-checkbox checked:border-none"/>
                            <label for="bloqueados" class="block h-5 overflow-hidden bg-gray-300 rounded-full cursor-pointer toggle-label"></label>
                        </div>
                        <label for="bloqueados" class="text-xs text-gray-700">Bloqueados</label>
                    </div>
                </div>
            </div>
            @if($modalNew)
            <div class="fixed top-0 bottom-0 left-0 right-0 z-50 flex items-center justify-center overflow-auto text-gray-500 bg-black bg-opacity-40" x-transition:enter="transition ease duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                <!-- Modal -->
                <div class="p-6 mx-10 bg-white shadow-2xl rounded-xl sm:w-10/12" x-transition:enter="transition ease duration-100 transform" x-transition:enter-start="opacity-0 scale-90 translate-y-1" x-transition:enter-end="opacity-100 scale-100 translate-y-0" x-transition:leave="transition ease duration-100 transform" x-transition:leave-start="opacity-100 scale-100 translate-y-0" x-transition:leave-end="opacity-0 scale-90 translate-y-1">
                    <!-- Title -->
                    <div class="flex flex-row justify-between bg-white border-b border-gray-200 rounded-tl-lg rounded-tr-lg">
                        <div class="px-8 py-4 text-xl font-bold text-black">Cadastro de Usuário</div>
                        <div class="py-4">
                            <svg wire:click="resetData()" class="w-6 h-6 cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </div>
                    </div>

                    @include('livewire.usuarios.componentes.form')

                </div>
            </div>
            @endif
        </div>
        <div class="w-full">
            <div class="my-6 bg-white rounded shadow-md">
                <table class="w-full table-auto min-w-max">
                    <thead>
                        <tr class="text-sm leading-normal text-gray-600 uppercase bg-gray-200">
                            <th class="px-6 py-3 text-left">Usuário</th>
                            <th class="px-6 py-3 text-left">Email</th>
                            <th class="px-6 py-3 text-left">Equipe</th>
                            <th class="px-6 py-3 text-left">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm font-light text-gray-600">
                    @forelse($usuarios as $usuario)
                        <tr class="border-b border-gray-200 hover:bg-gray-100 @if($usuario->deleted_at) bg-red-200 @endif">
                            <td class="px-6 py-3 text-left whitespace-nowrap">
                                <div class="flex items-center">
                                    <img src="{{$usuario->profile_photo_url}}" class="h-8 w-8 rounded-full object-cover mr-4">
                                    <span class="font-medium">{{$usuario->name}}</span>
                                </div>
                            </td>
                            <td class="px-6 py-3 text-left whitespace-nowrap">
                                <div class="flex items-center">
                                    <span class="font-medium">{{$usuario->email}}</span>
                                </div>
                            </td>
                            <td class="px-6 py-3 text-left whitespace-nowrap">
                                <div class="flex items-center">
                                    <span class="font-medium">{{$usuario->team->name ?? '-'}}</span>
                                </div>
                            </td>
                            <td class="">
                                <div class="px-6 py-3 text-right grid grid-cols-3 grid-flow-col gap-4">
                                    <div wire:click.prevent="trocarSenha('{{ encrypt($usuario->id) }}')" class="w-4 mr-2 transform cursor-pointer hover:text-green-500 hover:scale-150" title="Trocar Senha">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                        </svg>
                                    </div>
                                    <div wire:click.prevent="alterar('{{ encrypt($usuario->id) }}')" class="w-4 mr-2 transform cursor-pointer hover:text-green-500 hover:scale-150" title="Alterar">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </div>
                                    @if($usuario->deleted_at)
                                    <div wire:click.prevent="restaurar('{{ encrypt($usuario->id) }}')" class="w-4 mr-2 transform cursor-pointer hover:text-green-500 hover:scale-150" title="Restaurar">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                        </svg>
                                    </div>
                                    @else
                                    @if($usuario->id != Auth::user()->id)
                                    <div wire:click.prevent="remover('{{ encrypt($usuario->id) }}')" class="w-4 mr-2 transform cursor-pointer hover:text-green-500 hover:scale-150" title="Bloquear">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </div>
                                    @endif
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="px-6 py-3 text-left whitespace-nowrap">
                                <div class="flex items-center">
                                    <span class="font-medium">Nenhum Usuário Encontrado</span>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        {{ $usuarios->links() }}
    </div>
    @if($modalDelete)
        @include('livewire.componentes.dialogDanger',
        [
            'titulo' => "Bloqueio de Usuário",
            'mensagem' => "Tem certeza que deseja bloquear o usuário $usuarioFake->name?",
            'acao' => "delete('" . encrypt($usuarioFake->id) . "')",
            'textoAcao' => "Bloquear"
            ])
    @endif
    @if($modalRestore)
        @include('livewire.componentes.dialogWarning',
        [
            'titulo' => "Desbloqueio de Usuário",
            'mensagem' => "Tem certeza que deseja desbloquear o usuário $usuarioFake->name?",
            'acao' => "restore('" . encrypt($usuarioFake->id) . "')",
            'textoAcao' => "Desbloquear"
            ])
    @endif

    @if (session()->has('error'))
        @include('livewire.componentes.alertError')
    @endif
    @if (session()->has('success'))
        @include('livewire.componentes.alertSuccess')
    @endif
</div>