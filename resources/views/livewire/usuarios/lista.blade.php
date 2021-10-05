<x-slot name="header">
    <h2 class="text-xl font-thin leading-tight text-gray-800 text-center">
        {{ __('Usuários') }}
    </h2>
</x-slot>


<div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
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
                                    <span class="font-medium">{{$usuario->team->name}}</span>
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

    @if (session()->has('error'))
        @include('livewire.componentes.alertError')
    @endif
    @if (session()->has('success'))
        @include('livewire.componentes.alertSuccess')
    @endif
</div>