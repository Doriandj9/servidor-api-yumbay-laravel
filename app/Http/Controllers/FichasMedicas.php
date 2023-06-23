<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Usuarios as ControllersUsuarios;
use App\Http\Requests\CitasMedicasPostRequest;
use App\Models\CitasMedicas;
use App\Models\FichasMedicas as ModelsFichasMedicas;
use App\Models\FichasMedicasHistoriaClinica;
use App\Models\FichasMedicasRecetaMedica;
use App\Models\FichasMedicasSignosVitales;
use App\Models\HistoriaClinica;
use App\Models\RecetaMedica;
use App\Models\SignosVitales;
use App\Models\Usuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class FichasMedicas extends Controller
{
    //

    public function save(Request $request){

        $postRequest = new CitasMedicasPostRequest();
        $validator =  Validator::make($request->all(),$postRequest->rules(),$postRequest->messages());
        try {
            if($validator->fails()){
                throw new ValidationException($validator);
            }
            try {
                $user = Usuarios::where('cedula',$request->get('cedula'))->get()->first();
                if(!$user){
                    $usuarios= new Pacientes;
                    $res = $usuarios->save($request,false);
                    if($res){
                        date_default_timezone_set('America/Guayaquil');
                        $date = new \DateTime();
                        $data = [
                            'fecha' => $date->format('Y-m-d'),
                            'hora' => '00:00|00:00',
                            'pendiente' => false,
                            'id_especialidad' => intval($request->get('id_especialidad')),
                            'cedula_paciente' => $request->get('cedula'),
                            'cedula_doctor' => $request->get('cedula_doctor')
                         ];
                         CitasMedicas::create($data);
                    }
                }

                $dataFicha = [
                    'cedula' => $request->get('cedula'),
                    'nombres' => $request->get('nombres'),
                    'apellidos' => $request->get('apellidos'),
                    'direccion' => $request->get('direccion'),
                    'celular' => $request->get('celular'),
                    'fecha_nacimiento' => $request->get('fecha_nacimiento'),
                    'email' => $request->get('correo'),
                    'sexo' => $request->get('sexo'),
                    'edad' => $request->get('edad'),
                    'estado_civil' => $request->get('estado_civil'),
                    'fecha_control' => $request->get('fecha'),
                    'hora_finalizacion' => $request->get('hora_finalizacion'),
                    'antecedentes' => $request->get('antecedentes_paso'),
                    'enfermedad_actual' => $request->get('enfermedad_actual'),
                    'unidad_operativa' => $request->get('unidad_operativa'),
                    'odontograma' => $request->get('odontograma'),
                    'id_especialidad' => intval($request->get('id_especialidad')),
                    'cedula_paciente' => $request->get('cedula')
                ];

                $dataHistoriaClinica = [
                    'hora' => '00:00',
                    'motivo_consulta' => $request->get('motivo'),
                    'antecedentes_medicos' => $request->get('antecendentes'),
                    'tratamiento_actual' => $request->get('tratamiento'),
                    'alergias' => $request->get('alergias'),
                    'habitos_toxicos' => $request->get('habitos'),
                    'otros_antecedentes' => $request->get('otros_antecedentes')
                ];

                $dataSignosVitales = [
                    'talla' => $request->get('altura'),
                    'peso' => $request->get('peso'),
                    'temperatura' => $request->get('temperatura'),
                    'frecuencia_respiratoria' => $request->get('respiracion'),
                    'frecuencia_cardiaca' => $request->get('frecuencia'),
                    'presion_arterial' => $request->get('presion'),
                    // 'auscultacion_cardiaca' => $request->get('cardiaco'),
                    // 'auscultacion_pulmonar' => $request->get('pulmonar'),
                    'otros_hallazgos' => $request->get('otros_hallasgos')
                ];
                $dataRecetaMedica = [
                    'medicamentos_tratamiento' => $request->get('medicamentos')
                ];
                $ficha = ModelsFichasMedicas::create($dataFicha);
                $historiaClinica = HistoriaClinica::create($dataHistoriaClinica);
                $signosVitales = SignosVitales::create($dataSignosVitales);
                $recetaMedica = RecetaMedica::create($dataRecetaMedica);
                // datos de relacion entre tablas
                $dataFicha_HistoriaClinica = [
                    'id_historia_clinica' => $historiaClinica->id,
                    'id_fichas_medicas' => $ficha->id
                ];
                $dataFicha_SignosVitales = [
                    'id_signos_vitales' => $signosVitales->id,
                    'id_fichas_medicas' => $ficha->id
                ];
                $dataFicha_RecetaMedica = [
                    'id_receta_medica' => $recetaMedica->id,
                    'id_fichas_medicas' => $ficha->id
                ];

                FichasMedicasHistoriaClinica::create($dataFicha_HistoriaClinica);
                FichasMedicasSignosVitales::create($dataFicha_SignosVitales);
                FichasMedicasRecetaMedica::create($dataFicha_RecetaMedica);

                return response()
                ->json([
                    'ident' => 1,
                    'mensaje' => 'Se ingreso correctamente los datos'
                ]);
            } catch (\PDOException $ep) {
                return response()->json([
                    'ident' => 0,
                    'mensaje' => $ep->getMessage()
                ]);
            }

        } catch (ValidationException $e) {
            return response()->json([
                'ident' => 0,
                'mensaje' => $e->getMessage(),
                'errores' => $e->errors()
            ]);
        }
    }

    public function getForPaciente($cedula){
        try{

            $data = ModelsFichasMedicas::getForPaciente($cedula);
            return response()
            ->json([
                'ident' => 1,
                'data' => $data
            ]);

        }catch(\PDOException $e){
            return response()
            ->json([
                'ident' => 0,
                'mensaje' => $e->getMessage()
            ]);
        }
    }
}
