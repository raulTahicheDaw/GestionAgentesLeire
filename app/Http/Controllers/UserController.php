<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if ($buscar == '') {
            $usuario = User::join('roles', 'users.idrol', '=', 'roles.id')
                ->select('users.id', 'users.usuario', 'users.password', 'users.activo', 'users.idrol',
                    'roles.nombre as roles')
                ->orderBy('users.usuario', 'asc')->paginate(4);
        } else {
            $usuario = User::join('roles', 'users.idrol', '=', 'roles.id')
                ->select('users.id', 'users.usuario', 'users.password', 'users.activo', 'users.idrol',
                    'roles.nombre as roles')
                ->where('users.' . $criterio, 'like', '%' . $buscar . '%')
                ->orderBy('users.usuario', 'asc')->paginate(4);

        }
        return [
            'pagination' => [
                'total' => $usuario->total(),
                'current_page' => $usuario->currentPage(),
                'per_page' => $usuario->perPage(),
                'last_page' => $usuario->lastPage(),
                'from' => $usuario->firstItem(),
                'to' => $usuario->lastItem()
            ],
            'usuarios' => $usuario
        ];
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $user = new User();
        $user->usuario = $request->usuario;
        $user->password = bcrypt($request->password);
        $user->activo = '1';
        $user->idrol = $request->idrol;
        $user->save();
    }

    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $user = User::findOrFail($request->id);
        $user->usuario = $request->usuario;
        $user->password = bcrypt($request->password);
        $user->activo = '1';
        $user->idrol = $request->idrol;
        $user->save();
    }

    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $user = User::findOrFail($request->id);
        $user->activo = '0';
        $user->save();
    }

    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $user = User::findOrFail($request->id);
        $user->activo = '1';
        $user->save();
    }

}
