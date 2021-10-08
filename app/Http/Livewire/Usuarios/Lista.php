<?php

namespace App\Http\Livewire\Usuarios;

use Livewire\Component;
use App\Models\{Team, User};
use DB;
use Str;

class Lista extends Component
{
    public $modalDelete = false;
    public $modalRestore = false;
    public $modalNew = false;
    
    public $bloqueados = null;
    public $itensPaginas = 10;
    public $termo = "";

    public $usuarioFake;
    public $idUsuario;

    public $name;
    public $email;

    //metodos padroes
    public function resetData(){
        $this->reset();
    }

    public function render(){
        //carregar todos os usuarios do sistema
        if($this->bloqueados){
            $usuarios = User::withTrashed()
                            ->orWhere("name", 'like', "%$this->termo%")
                            ->orWhere("email", 'like', "%$this->termo%")
                            ->orderBy('name')
                            ->paginate($this->itensPaginas);
        }else{
            $usuarios = User::where("name", 'like', "%$this->termo%")
                            ->orWhere("email", 'like', "%$this->termo%")
                            ->orderBy('name')
                            ->paginate($this->itensPaginas);
        }

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
    public function restaurar($id){
        //abre a cx de dialogo
        $this->usuarioFake = User::withTrashed()->findOrFail(decrypt($id));
        $this->modalRestore = true;
    }
    public function restore($id){
        try {
            $usuario = User::withTrashed()->findOrFail(decrypt($id));
            $usuario->restore();
            session()->flash('success', "Usuário desbloqueado com sucesso!");
        } catch (\Exception $ex) {
            session()->flash('error', $ex->getMessage());
        }
        $this->reset();
    }
    public function novo(){
        $this->modalNew = true;
    }

    public function rules(){
        return [
            'name' => "required|string|min:3",
            'email' => "required|email|unique:users,email," . $this->idUsuario
        ];
    }

    public function messages(){
        return [
            'name.required' => 'O campo <strong>Nome do Usuário</strong> é obrigatório',
            'name.min' => 'O campo <strong>Nome do Usuário</strong> precisa ter no mínimo 3 caracteres',
            'email.required' => 'O campo <strong>E-mail</strong> é obrigatório',
            'email.unique' => 'Este <strong>E-mail</strong> já está sendo utilizado'
        ];
    }

    public function create(){
        $this->validate();
        DB::beginTransaction();
        try {
            $usuario = User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => Str::random(40)
            ]);
            dd($usuario->id);
            $time = Team::create([
                'name' => "Time " . $usuario->name,
                'personal_team' => '1',
                'user_id' => $usuario->id
            ]);
            $usuario->current_team_id = $time->id;
            $usuario->save();
            DB::commit();
            session()->flash('success', "Usuário cadastrado com sucesso!");
        } catch (\Exception $ex) {
            DB::rollBack();
            session()->flash('error', $ex->getMessage());
        }
        //$this->reset();
    }
}
