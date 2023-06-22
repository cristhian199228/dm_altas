<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class CrearUsuarios extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:crear-usuarios';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        $usuario = Usuario::All();
        foreach ($usuario as $usr) {

            $arr = explode(".", $usr->correo);
            $arr1 = explode("@", $arr[1]);

            $user = new User;
            $user->nombres = ucfirst($arr[0]) . ' ' . ucfirst($arr1[0]);
            $user->email = $usr->correo;
            $user->azure_id = '6479a534-5d86-4037-994a-37836cdd42d0';
            $user->password = Hash::make($arr[0] . '.' . $arr1[0]);
            $user->save();

            $usuarios = Usuario::find($usr->id);
            $usuarios->password = $arr[0] . '.' . $arr1[0];
            $usuarios->save();
        }
    }
}
