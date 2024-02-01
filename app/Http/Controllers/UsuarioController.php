<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Perfil;
use App\Models\Endereco;
use App\Models\EnderecoUsuario;

use Illuminate\Http\Request;


class UsuarioController extends Controller
{
    //Listagem
    public function index()
    {
        return Usuario::all();
    }

    public function create()
    {
        
    }

    //Salvar
    public function store(Request $request)
    {
        $data = $request->all();
    
        $perfil = Perfil::firstOrCreate(['perfil' => $data['perfil']['perfil']]);
    
        $usuario = Usuario::create([
            'nome' => $data['nome'],
            'email' => $data['email'],
            'cpf' => $data['cpf'],
            'endereco' => $data['endereco'],
            'endereco_alternativo' => $data['endereco_alternativo'],
            'perfil_id' => $perfil->id, 
        ]);
    
        $enderecoPrincipal = Endereco::create([
            'endereco' => $data['endereco'],
        ]);
    
        $usuario->enderecos()->attach($enderecoPrincipal->id);
    
        if (!empty($data['endereco_alternativo'])) {
            $enderecoAlternativo = Endereco::create([
                'endereco' => $data['endereco_alternativo'],
            ]);
    
            $usuario->enderecos()->attach($enderecoAlternativo->id);
        }
    
        return response()->json($usuario, 201);

    }

    //Exibir
    public function show(Usuario $usuario)
    {
        return $usuario;
    }

    //Editar
    public function edit(Usuario $usuario)
    {
        $usuario->load('perfil');
        return response()->json($usuario, 200);
    }

    //Atualizar
    public function update(Request $request, Usuario $usuario)
    {
        $data = $request->all();

    
        $usuario->update([
            'nome' => $data['nome'],
            'email' => $data['email'],
            'cpf' => $data['cpf'],
            'endereco' => $data['endereco'],
            'endereco_alternativo' => $data['endereco_alternativo'],
            
        ]);

        return response()->json($usuario, 200);
    }  

    //Excluir
    public function destroy($id)
    {
    
        EnderecoUsuario::where('usuario_id', $id)->delete();

        Usuario::destroy($id);

        return response()->json(null, 204);
    }
}