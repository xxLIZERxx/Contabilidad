<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    public function index() {
        $contracts = Contract::all();
        return view('contracts.index', compact('contracts'));
    }

    public function create() {
        return view('contracts.create');
    }

    public function store(Request $request) {
        Contract::create($request->all());
        return redirect()->route('contracts.index');
    }

    public function show(Contract $contract) {
        return view('contracts.show', compact('contract'));
    }

    public function edit(Contract $contract) {
        return view('contracts.edit', compact('contract'));
    }

    public function update(Request $request, Contract $contract) {
        $contract->update($request->all());
        return redirect()->route('contracts.index');
    }

    public function destroy(Contract $contract) {
        $contract->delete();
        return redirect()->route('contracts.index');
    }
}
