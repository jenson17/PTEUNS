<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Resultado;
use DB;
use Codedge\Fpdf\Fpdf\Fpdf;
use Carbon\Carbon;

class UserController extends Controller
{
   public function __construct(){

        Carbon::setLocale('es');
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
           
           $user = User::findOrFail($id);

           return response()->json([
                'success' => true,
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
           ]); 

        } catch (Exception $e) {
            
            return response()->json([
               'error' => $e.getMessage()
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        $user = User::findOrFail($id);

        $data = [
            'name' => 'required',
        ];

        if ($user->email != $request->email) {
            $data['email'] = 'required|email|unique:users';
        }

        $this->validate($request, $data);

        try {

           $user->name = $request->name;
           $user->email = $request->email;
           $user->save();

            return response()->json([
                'success' => true,
                'mensaje' => 'Perfil Actualizado'
            ]);

       } catch (Exception $e) {
           
           return response()->json([
               'error' => $e.getMessage()
           ]);
       }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function cambiarPassword(Request $request){
        $user = Auth::user();
        $this->validate($request, [
            'old_password' => 'required',
            'new_password_1' => 'required|min:6|same:new_password_2',
        ],[
            'new_password_1.required' => 'El campo nueva contraseña es requerido',
            'new_password_1.min' => 'El campo nueva contraseña debe tener al menos :min caracteres',
            'new_password_1.same' => 'Las contraseñas no coinciden',
        ]);

        if($request->new_password_1 == $request->new_password_2){
            try{

                 if(Hash::check($request->old_password, $user->password))
                {
                    $usuario = User::FindOrFail($user->id);
                    $usuario->password = Hash::make($request->new_password_1);
                    $usuario->save();
                    return response()->json([
                        'success' => 'true',
                        'mensaje' => "Contraseña actualizada con exito"
                    ]);
                }else{
                    return response()->json([
                        'success_falso' => 'true',
                        'mensaje' => "La contraseña anterior es incorrecta"
                    ]);
                }                
            }catch (\Exception $e){
                return response()->json([
                    'error' => $e->getMessage()
                ]);
            }
        }else{
            return response()->json([
                'success_falso' => 'true',
                'mensaje' => "Las contraseñas no coinciden"
            ]);
        }
    }

    public function pdfuser(Request $request){

            $fpdf=new FPDF();
            $fpdf->AddPage();

            $fpdf->SetFont('Arial','B',15);
            // Movernos a la derecha
            $fpdf->Cell(80);
            // Título
            $fpdf->Cell(30,7,utf8_decode("República Bolivariana de Venezuela"),0,1,'C');
            $fpdf->Cell(80);
            $fpdf->Cell(30,7,utf8_decode("Ministerio del Poder Popular para la Educación"),0,1,'C');
            $fpdf->Cell(80);
            $fpdf->Cell(30,7,'Unidad Educativa Nacional "San Casimiro"',0,1,'C');
            $fpdf->Cell(80);
            $fpdf->Cell(30,7,'San Casimiro - Estado Aragua',0,1,'C');
            $fpdf->Cell(80);
            $fpdf->Cell(30,7,'Reporte de las Evaluaciones',0,1,'C');
            $fpdf->Ln();

            if( \Auth::user()->admin() ){

                $resultados = Resultado::all();
            }else{

                 $resultados = Resultado::where('user_id','=',\Auth::user()->id)->get();
            }

            foreach ($resultados as $res) {
                
                $array [] = $res;
            }
 
                $count = 0;

                if (isset($array) ) {

                    $fpdf->SetXY(30, 67);
                    $fpdf->SetFont('Arial','B',10);
                    $fpdf->Cell(30,7, utf8_decode("Usuario"),0, 0 , 'L' );
                    $fpdf->Cell(30,7, utf8_decode("Prueba"),0, 0 , 'L' );
                    $fpdf->Cell(30,7, utf8_decode("Calificacíon"),0, 0 , 'L' );
                    $fpdf->Cell(30,7, utf8_decode("Condición"),0, 0 , 'L' );
                    $fpdf->Cell(40,7, utf8_decode("Fecha y Hora"),0, 0 , 'L' );
                    $fpdf->SetXY(30,70); // 77 = 70 posiciónY_anterior + 7 altura de las de cabecera
                    $fpdf->SetFont('Arial','',10);

                  foreach($array as $fila)
                    {

                        $usuario = DB::table('resultados as res')->join('evaluacions_users as eva','res.evaluacions_users_id','=','eva.id')->join('evaluacions as ev','eva.evaluacion_id','=','ev.id')->join('users as user','res.user_id','=','user.id')->select('user.name','ev.titulo','res.acumulado','res.estado','res.created_at')->where('res.id','=',$fila->id)->where('res.user_id','=',$fila->user_id)->first();

                        $count +=20;
                        //Atención!! el parámetro valor 0, hace que sea horizontal
                        $fpdf->Cell(30,$count, utf8_decode($usuario->name),0, 0 , 'L' );
                        $fpdf->Cell(30,$count, utf8_decode($usuario->titulo),0, 0 , 'L' );
                        $fpdf->Cell(30,$count, utf8_decode($usuario->acumulado),0, 0 , 'L' );
                        if ($usuario->estado == 1) {
                           $fpdf->Cell(30,$count, utf8_decode("Aprobado"),0, 0 , 'L' );
                        }else{
                             $fpdf->Cell(30,$count, utf8_decode("Reprobado"),0, 0 , 'L' );
                        }
                        $fpdf->Cell(40,$count, $usuario->created_at ,0, 0 , 'L' );

                        $fpdf->SetXY(30,70);
                        $fpdf->SetFont('Arial','',10); //Fuente, normal, tamaño
                    }
                }else{
                    $fpdf->Ln();
                    $fpdf->Ln();
                    $fpdf->Ln();
                    $fpdf->Ln();
                    $fpdf->SetFont('Arial','B',15);
                    $fpdf->Cell(80);
                    $fpdf->Cell(30,7,'No tienes registros',0,1,'C');
                }
                

            $fpdf->Output();

            exit;

    }
}
