<?php

namespace App\Http\Controllers;

use App\Models\Reservatorio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservatorioController extends Controller
{
    // Exibe a lista de reservatórios
    public function index()
    {
        $reservatorios = Reservatorio::all();
        return view('reservatorios.index', compact('reservatorios'));
    }

    // Exibe o formulário para criar um novo reservatório
    public function create()
    {
        return view('reservatorios.create');
    }

    // Salva o novo reservatório no banco de dados
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'volume_maximo' => 'required|numeric',
            'volume_atual' => 'required|numeric',
            'ultima_atualizacao' => 'required|date',
        ]);

        Reservatorio::create([
            'nome' => $request->nome,
            'volume_maximo' => $request->volume_maximo,
            'volume_atual' => $request->volume_atual,
            'ultima_atualizacao' => $request->ultima_atualizacao,
            'user_id' => Auth::id(),  // Usando o usuário logado
        ]);

        return redirect()->route('reservatorios.index')->with('success', 'Reservatório criado com sucesso!');
    }

    // Exibe o formulário de edição do reservatório
    public function edit(Reservatorio $reservatorio)
    {
        return view('reservatorios.edit', compact('reservatorio'));
    }

    // Atualiza o reservatório no banco de dados
    public function update(Request $request, Reservatorio $reservatorio)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'volume_maximo' => 'required|numeric',
            'volume_atual' => 'required|numeric',
            'ultima_atualizacao' => 'required|date',
        ]);

        $reservatorio->update([
            'nome' => $request->nome,
            'volume_maximo' => $request->volume_maximo,
            'volume_atual' => $request->volume_atual,
            'ultima_atualizacao' => $request->ultima_atualizacao,
        ]);

        return redirect()->route('reservatorios.index')->with('success', 'Reservatório atualizado com sucesso!');
    }

    // Exclui um reservatório do banco de dados
    public function destroy(Reservatorio $reservatorio)
    {
        $reservatorio->delete();
        return redirect()->route('reservatorios.index')->with('success', 'Reservatório excluído com sucesso!');
    }
}
