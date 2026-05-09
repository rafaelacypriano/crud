<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Curso;

class CursoController extends Controller
{
    public function index()
    {
        $rows = Curso::all();
        return view('admin.cursos.index', compact('rows'));
    }
    public function adicionar() 
    {
        return view('admin.cursos.adicionar');
    }

    public function editar($id) 
    {
        // busca o registro pelo id
        $linha = Curso::find($id);
        // manda o registro encontrado para a visão editar
        return view('admin.cursos.editar', compact('linha'));
    }

    public function excluir($id) 
    {
        // busca e deleta o registro
        Curso::find($id)->delete();
        // redireciona de volta para a lista
        return redirect()->route('admin.cursos');

    }

    public function salvar(Request $req)
    {
        $dados = $req->all();

        // Lógica do Checkbox (transforma em 'sim' ou 'não')
        if(isset($dados['publicado'])){
            $dados['publicado'] = 'sim';
        } else {
            $dados['publicado'] = 'não';
        }

        // Lógica do Upload da Imagem
        if($req->hasFile('arquivo')){
            $imagem = $req->file('arquivo');
            $num = rand(1111,9999);
            $dir = "img/cursos/";
            $ext = $imagem->guessClientExtension();
            $nomeImagem = "imagem_" . $num . "." . $ext;
            $imagem->move($dir, $nomeImagem);
            $dados['imagem'] = $dir . "/" . $nomeImagem;
        }

        Curso::create($dados);
        return redirect()->route('admin.cursos');
    }

    public function atualizar(Request $req, $id)
    {
        $dados = $req->all();

        if(isset($dados['publicado'])){
            $dados['publicado'] = 'sim';
        } else {
            $dados['publicado'] = 'não';
        }

        if($req->hasFile('arquivo')){
            $imagem = $req->file('arquivo');
            $num = rand(1111,9999);
            $dir = "img/cursos/";
            $ext = $imagem->guessClientExtension();
            $nomeImagem = "imagem_" . $num . "." . $ext;
            $imagem->move($dir, $nomeImagem);
            $dados['imagem'] = $dir . "/" . $nomeImagem;
        }

        Curso::find($id)->update($dados);
        return redirect()->route('admin.cursos');
    }
}