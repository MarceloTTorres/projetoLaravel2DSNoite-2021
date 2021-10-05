<?php

namespace App\Http\Livewire\Usuarios;

use Livewire\Component;
use App\Models\User;

class Lista extends Component
{
    public $modalDelete = false;
    public $usuarioFake;

    //metodos padroes
    public function resetData(){
        $this->reset();
    }

    public function render(){
        //carregar todos os usuarios do sistema
        $usuarios = User::all();

        return view('livewire.usuarios.lista')->withUsuarios($usuarios);
    }

    //metodos personalizados
    public function remover($id){
        //abre a cx de dialogo
        $this->usuarioFake = User::findOrFail(decrypt($id));
        $this->modalDelete = true;
    }
    public function delete($id){
        try {
            $usuario = User::findOrFail(decrypt($id));
            $usuario->delete();
            session()->flash('success', "Usuário bloqueado com sucesso!");
        } catch (\Exception $ex) {
            session()->flash('error', $ex->getMessage());
        }
        $this->reset();
    }
}
