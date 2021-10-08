<form>
    @if($usuarioFake)
    <input type="hidden" wire:model="idUsuario">
    @endif
    <div class="px-8 py-4">
        <div class="grid grid-flow-col grid-rows-1">
            <div class="mb-4">
                <label class="block mb-2 text-sm font-bold text-grey-darker">Nome Completo:</label>
                <input wire:model.lazy="name" 
                class="w-full uppercase px-3 py-2 border rounded text-grey-darker @error('name') border-red-700 @enderror" 
                type="text" placeholder="Insira o nome completo do usuário">
                @error('name')
                    <small class="text-red-700">{!! $message !!}</small>
                @enderror
            </div>
            <div class="mb-4 ml-4">
                <label class="block mb-2 text-sm font-bold text-grey-darker">Email</label>
                <input wire:model.lazy="email" class="w-full lowercase px-3 py-2 border rounded text-grey-darker @error('email') border-red-700 @enderror" type="text" placeholder="Insira um email válido">
                @error('email')
                    <small class="text-red-700">{!! $message !!}</small>
                @enderror
            </div>
        </div>
        <h2 class="text-center font-thin text-red-500">ATENÇÃO: O Usuário deverá solicitar a troca da senha no primeiro acesso!</h2>
    </div>
</form>
<!-- Buttons -->
@if($usuarioFake)
<div class="mx-8 mt-5 space-x-5 text-right">
    <button wire:click.prevent="resetData()" @click="showModalNew = false" class="px-4 py-2 text-sm font-bold text-gray-500 transition-colors duration-150 ease-linear bg-white border border-gray-200 rounded-xl focus:outline-none focus:ring-0 hover:bg-gray-50 focus:bg-indigo-50 focus:text-indigo">Cancelar</button>
    <button wire:click.prevent="update()" class="px-4 py-2 text-sm font-bold text-white transition-colors duration-150 ease-linear bg-green-600 border border-gray-200 rounded-xl focus:outline-none focus:ring-0 hover:bg-green-100 hover:text-green-600 focus:bg-green-50 focus:text-green-600">Alterar</button>
</div>
@else
<div class="mx-8 mt-5 space-x-5 text-right">
    <button wire:click.prevent="resetData()" @click="showModalNew = false" class="px-4 py-2 text-sm font-bold text-gray-500 transition-colors duration-150 ease-linear bg-white border border-gray-200 rounded-xl focus:outline-none focus:ring-0 hover:bg-gray-50 focus:bg-indigo-50 focus:text-indigo">Cancelar</button>
    <button wire:click.prevent="create()" class="px-4 py-2 text-sm font-bold text-white transition-colors duration-150 ease-linear bg-indigo-600 border border-gray-200 rounded-xl focus:outline-none focus:ring-0 hover:bg-indigo-100 hover:text-indigo-600 focus:bg-indigo-50 focus:text-indigo-600">Criar</button>
</div>
@endif