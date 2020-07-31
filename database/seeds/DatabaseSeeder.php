<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // States
        factory(App\Models\State::class)->create([
            'code' => '1',
            'name' => 'ACTIVE',
            'state' => 1,
        ]);
        factory(App\Models\State::class)->create([
            'code' => '2',
            'name' => 'INACTIVE',
            'state' => 1,
        ]);
        factory(App\Models\State::class)->create([
            'code' => '3',
            'name' => 'DELETED',
            'state' => 1,
        ]);

        // Catalogues
        // Workday Principal
        factory(App\Models\Catalogue::class)->create([
            'code' => 'work',
            'name' => 'Jornada',
            'type' => 'workdays.principal',
            'icon' => 'pi pi-calendar',
            'state_id' => 1,
        ]);

        // Workday Secundary
        factory(App\Models\Catalogue::class)->create([
            'code' => 'lunch',
            'name' => 'Almuerzo',
            'type' => 'workdays.secondary',
            'icon' => 'pi pi-briefcase',
            'state_id' => 1,
        ]);

        // Task Processes
        factory(App\Models\Catalogue::class)->create([
            'code' => 'academic',
            'name' => 'ACADEMICO',
            'type' => 'tasks.process',
            'icon' => 'pi pi-calendar',
            'state_id' => 1,
        ]);
        factory(App\Models\Catalogue::class)->create([
            'code' => 'administrative',
            'name' => 'ADMINISTRATIVO',
            'type' => 'tasks.process',
            'icon' => 'pi pi-calendar',
            'state_id' => 1,
        ]);
        factory(App\Models\Catalogue::class)->create([
            'code' => 'entailment',
            'name' => 'VINCULACION',
            'type' => 'tasks.process',
            'icon' => 'pi pi-calendar',
            'state_id' => 1,
        ]);
        factory(App\Models\Catalogue::class)->create([
            'code' => 'investigation',
            'name' => 'INVESTIGACION',
            'type' => 'tasks.process',
            'icon' => 'pi pi-calendar',
            'state_id' => 1,
        ]);

        // Task Subprocesses academic
        factory(App\Models\Catalogue::class)->create([
            'parent_code_id' => 3,
            'code' => '1',
            'name' => 'IMPARTIR CLASES PRESENCIALES, VIRTUALES O EN LINEA',
            'type' => 'tasks.activity',
            'icon' => 'pi pi-briefcase',
            'state_id' => 1,
        ]);
        factory(App\Models\Catalogue::class)->create([
            'parent_code_id' => 3,
            'code' => '2',
            'name' => 'PREPARACION Y ACTUALIZACION DE CLASES, SEMINARIOS, TALLERES Y OTROS',
            'type' => 'tasks.activity',
            'icon' => 'pi pi-briefcase',
            'state_id' => 1,
        ]);
        factory(App\Models\Catalogue::class)->create([
            'parent_code_id' => 3,
            'code' => '3',
            'name' => 'DISEÑO Y ELABORACION DE GUIAS, MATERIAL DIDACTICO Y SYLLABUS',
            'type' => 'tasks.activity',
            'icon' => 'pi pi-briefcase',
            'state_id' => 1,
        ]);
        factory(App\Models\Catalogue::class)->create([
            'parent_code_id' => 3,
            'code' => '4',
            'name' => 'ORIENTACION Y ACOMPAÑAMIENTO A TRAVES DE TUTORIAS PRESENCIALES O VIRTUALES, INDIVIDUALES O GRUPALES',
            'type' => 'tasks.activity',
            'icon' => 'pi pi-briefcase',
            'state_id' => 1,
        ]);
        factory(App\Models\Catalogue::class)->create([
            'parent_code_id' => 3,
            'code' => '5',
            'name' => 'ELABORACION DE REPORTES DE NIVEL ACADEMICO REFERENTE A EVALUACIONES, TRABAJOS Y RENDIMIENTO DEL ESTUDIANTE',
            'type' => 'tasks.activity',
            'icon' => 'pi pi-briefcase',
            'state_id' => 1,
        ]);
        factory(App\Models\Catalogue::class)->create([
            'parent_code_id' => 3,
            'code' => '6',
            'name' => 'VISITAS DE CAMPO',
            'type' => 'tasks.activity',
            'icon' => 'pi pi-briefcase',
            'state_id' => 1,
        ]);
        factory(App\Models\Catalogue::class)->create([
            'parent_code_id' => 3,
            'code' => '7',
            'name' => 'PREPARACION, ELABORACION, APLICACION Y CALIFICACION DE EXAMENES Y  PRACTICAS ',
            'type' => 'tasks.activity',
            'icon' => 'pi pi-briefcase',
            'state_id' => 1,
        ]);

        // Task Subprocesses administrative
        factory(App\Models\Catalogue::class)->create([
            'parent_code_id' => 4,
            'code' => '1',
            'name' => 'PARTICIPACION EN PROCESOS DEL SISTEMA NACIONAL DE EVALUACION PARA INGRESO A UNIVERSIDADES',
            'type' => 'tasks.activity',
            'icon' => 'pi pi-briefcase',
            'state_id' => 1,
        ]);
        factory(App\Models\Catalogue::class)->create([
            'parent_code_id' => 4,
            'code' => '2',
            'name' => 'ACTIVIDADES DE DIRECCION O GESTION EN SUS DISTINTOS NIVELES DE ORGANIZACION ACADEMICA E INSTITUCIONAL',
            'type' => 'tasks.activity',
            'icon' => 'pi pi-briefcase',
            'state_id' => 1,
        ]);
        factory(App\Models\Catalogue::class)->create([
            'parent_code_id' => 4,
            'code' => '3',
            'name' => 'REUNIONES DE ORGANO COLEGIADO SUPERIOR',
            'type' => 'tasks.activity',
            'icon' => 'pi pi-briefcase',
            'state_id' => 1,
        ]);
        factory(App\Models\Catalogue::class)->create([
            'parent_code_id' => 4,
            'code' => '4',
            'name' => 'DISEÑO DE PROYECTOS DE CARRERAS Y PROGRAMAS DE ESTUDIOS',
            'type' => 'tasks.activity',
            'icon' => 'pi pi-briefcase',
            'state_id' => 1,
        ]);
        factory(App\Models\Catalogue::class)->create([
            'parent_code_id' => 4,
            'code' => '5',
            'name' => 'ACTIVIDADES RELACIONADAS CON LA EVALUACION INSTITUCIONAL EXTERNA',
            'type' => 'tasks.activity',
            'icon' => 'pi pi-briefcase',
            'state_id' => 1,
        ]);

        // Task Subprocesses entailment
        factory(App\Models\Catalogue::class)->create([
            'parent_code_id' => 5,
            'code' => '1',
            'name' => 'DIRECCION SEGUIMIENTO Y EVALUACION DE PRACTICAS PRE PROFESIONALES',
            'type' => 'tasks.activity',
            'icon' => 'pi pi-briefcase',
            'state_id' => 1,
        ]);
        factory(App\Models\Catalogue::class)->create([
            'parent_code_id' => 5,
            'code' => '2',
            'name' => 'DISEÑO E IMPARTICION DE CURSOS DE EDUCACION CONTINUA O DE CAPACITACION Y ACTUALIZACION',
            'type' => 'tasks.activity',
            'icon' => 'pi pi-briefcase',
            'state_id' => 1,
        ]);
        factory(App\Models\Catalogue::class)->create([
            'parent_code_id' => 5,
            'code' => '3',
            'name' => 'PARTICIPACION EN ACTIVIDADES DE PROYECTOS SOCIALES, ARTISTICOS, PRODUCTIVOS Y EMPRESARIALES DE VINCULACION CON LA SOCIEDAD',
            'type' => 'tasks.activity',
            'icon' => 'pi pi-briefcase',
            'state_id' => 1,
        ]);
        factory(App\Models\Catalogue::class)->create([
            'parent_code_id' => 5,
            'code' => '4',
            'name' => 'ELABORACION DE INFORMES DE SEGUIMIENTO DE PROYECTOS DE VINCULACION',
            'type' => 'tasks.activity',
            'icon' => 'pi pi-briefcase',
            'state_id' => 1,
        ]);

        // Task Subprocesses investigation
        factory(App\Models\Catalogue::class)->create([
            'parent_code_id' => 6,
            'code' => '1',
            'name' => 'GESTIONAR PROYECTOS DE INVESTIGACION, COMUNITARIOS Y/O DE EMPRENDIMIENTO',
            'type' => 'tasks.activity',
            'icon' => 'pi pi-briefcase',
            'state_id' => 1,
        ]);
        factory(App\Models\Catalogue::class)->create([
            'parent_code_id' => 3,
            'code' => '2',
            'name' => 'DIRECCION Y TUTORIAS PARA LA ELABORACION DE TRABAJOS PARA LA OBTENCION DE TITULO',
            'type' => 'tasks.activity',
            'icon' => 'pi pi-briefcase',
            'state_id' => 1,
        ]);
        factory(App\Models\Catalogue::class)->create([
            'parent_code_id' => 3,
            'code' => '3',
            'name' => 'DIRECCION Y PARTICIPACION DE PROYECTOS DE INVESTIGACION E INNOVACION BASICA, APLICADA, TECNOLOGICA',
            'type' => 'tasks.activity',
            'icon' => 'pi pi-briefcase',
            'state_id' => 1,
        ]);
        factory(App\Models\Catalogue::class)->create([
            'parent_code_id' => 6,
            'code' => '4',
            'name' => 'REALIZACION DE INVESTIGACION PARA LA RECUPERACION, FORTALECIMIENTO Y POTENCIAC ION DE LOS SABERES ANCESTRALES',
            'type' => 'tasks.activity',
            'icon' => 'pi pi-briefcase',
            'state_id' => 1,
        ]);
        factory(App\Models\Catalogue::class)->create([
            'parent_code_id' => 6,
            'code' => '5',
            'name' => 'PARTICIPACION EN CONGRESOS, SEMINARIOS Y CONFERENCIAS PARA LA PRESENTACION DE AVANCES Y RESULTADOS DE SUS INVESTIGACIONES',
            'type' => 'tasks.activity',
            'icon' => 'pi pi-briefcase',
            'state_id' => 1,
        ]);
        factory(App\Models\Catalogue::class)->create([
            'parent_code_id' => 6,
            'code' => '6',
            'name' => 'DISEÑO, GESTION Y PARTICIPACION EN REDES Y PROGRAMAS DE INVESTIGACION LOCAL NACIONAL E INTERNACIONAL',
            'type' => 'tasks.activity',
            'icon' => 'pi pi-briefcase',
            'state_id' => 1,
        ]);
        factory(App\Models\Catalogue::class)->create([
            'parent_code_id' => 6,
            'code' => '7',
            'name' => 'PARTICIPACION EN COMITES O CONSEJOS ACADEMICOS Y EDITORIALES DE REVISTAS CIENTIFICAS Y ACADEMICAS INDEXADAS, Y DE ALTO IMPACTO CIENTIFICO O ACADEMICO',
            'type' => 'tasks.activity',
            'icon' => 'pi pi-briefcase',
            'state_id' => 1,
        ]);
        factory(App\Models\Catalogue::class)->create([
            'parent_code_id' => 6,
            'code' => '8',
            'name' => 'DIFUSION DE RESULTADOS Y BENEFICIOS SOCIALES DE LA INVESTIGACION, A TRAVES DE PUBLICACIONES, PRODUCCIONES ARTISTICAS, ACTUACIONES, CONCIERTOS, CREACION U ORGANIZACION DE INSTALACIONES Y DE EXPOSICIONES, ENTRE OTROS',
            'type' => 'tasks.activity',
            'icon' => 'pi pi-briefcase',
            'state_id' => 1,
        ]);

        // Ethnic origin
        factory(App\Models\Catalogue::class)->create([
            'code' => '1',
            'name' => 'INDIGENA',
            'type' => 'ethnic_origin',
            'state_id' => 1,
        ]);
        factory(App\Models\Catalogue::class)->create([
            'code' => '2',
            'name' => 'AFROECUATORIANO',
            'type' => 'ethnic_origin',
            'state_id' => 1,
        ]);
        factory(App\Models\Catalogue::class)->create([
            'code' => '3',
            'name' => 'NEGRO',
            'type' => 'ethnic_origin',
            'state_id' => 1,
        ]);
        factory(App\Models\Catalogue::class)->create([
            'code' => '4',
            'name' => 'MULATO',
            'type' => 'ethnic_origin',
            'state_id' => 1,
        ]);
        factory(App\Models\Catalogue::class)->create([
            'code' => '5',
            'name' => 'MONTUBIO',
            'type' => 'ethnic_origin',
            'state_id' => 1,
        ]);
        factory(App\Models\Catalogue::class)->create([
            'code' => '6',
            'name' => 'MESTIZO',
            'type' => 'ethnic_origin',
            'state_id' => 1,
        ]);
        factory(App\Models\Catalogue::class)->create([
            'code' => '7',
            'name' => 'BLANCO',
            'type' => 'ethnic_origin',
            'state_id' => 1,
        ]);
        factory(App\Models\Catalogue::class)->create([
            'code' => '8',
            'name' => 'OTRO',
            'type' => 'ethnic_origin',
            'state_id' => 1,
        ]);
        factory(App\Models\Catalogue::class)->create([
            'code' => '9',
            'name' => 'NO REGISTRA',
            'type' => 'ethnic_origin',
            'state_id' => 1,
        ]);

        // Sex
        factory(App\Models\Catalogue::class)->create([
            'code' => '1',
            'name' => 'HOMBRE',
            'type' => 'sex',
            'state_id' => 1,
        ]);
        factory(App\Models\Catalogue::class)->create([
            'code' => '2',
            'name' => 'MUJER',
            'type' => 'sex',
            'state_id' => 1,
        ]);
        // Gender
        factory(App\Models\Catalogue::class)->create([
            'code' => '1',
            'name' => 'MASCULINO',
            'type' => 'gender',
            'state_id' => 1,
        ]);
        factory(App\Models\Catalogue::class)->create([
            'code' => '2',
            'name' => 'FEMENINO',
            'type' => 'gender',
            'state_id' => 1,
        ]);

        // Indetification Type
        factory(App\Models\Catalogue::class)->create([
            'code' => '1',
            'name' => 'CEDULA',
            'type' => 'indetification_type',
            'state_id' => 1,
        ]);
        factory(App\Models\Catalogue::class)->create([
            'code' => '2',
            'name' => 'PASAPORTE',
            'type' => 'indetification_type',
            'state_id' => 1,
        ]);

        // Blood Type
        factory(App\Models\Catalogue::class)->create([
            'code' => '1',
            'name' => 'A+',
            'type' => 'blood_type',
            'state_id' => 1,
        ]);
        factory(App\Models\Catalogue::class)->create([
            'code' => '2',
            'name' => 'A-',
            'type' => 'blood_type',
            'state_id' => 1,
        ]);
        factory(App\Models\Catalogue::class)->create([
            'code' => '3',
            'name' => 'B+',
            'type' => 'blood_type',
            'state_id' => 1,
        ]);
        factory(App\Models\Catalogue::class)->create([
            'code' => '4',
            'name' => 'B-',
            'type' => 'blood_type',
            'state_id' => 1,
        ]);
        factory(App\Models\Catalogue::class)->create([
            'code' => '5',
            'name' => 'AB+',
            'type' => 'blood_type',
            'state_id' => 1,
        ]);
        factory(App\Models\Catalogue::class)->create([
            'code' => '6',
            'name' => 'AB-',
            'type' => 'blood_type',
            'state_id' => 1,
        ]);
        factory(App\Models\Catalogue::class)->create([
            'code' => '7',
            'name' => 'O+',
            'type' => 'blood_type',
            'state_id' => 1,
        ]);
        factory(App\Models\Catalogue::class)->create([
            'code' => '8',
            'name' => 'O-',
            'type' => 'blood_type',
            'state_id' => 1,
        ]);

        // career modality
        factory(App\Models\Catalogue::class)->create([
            'code' => '1',
            'name' => 'PRESENCIAL',
            'type' => 'career_modality',
            'state_id' => 1,
        ]);
        factory(App\Models\Catalogue::class)->create([
            'code' => '2',
            'name' => 'SEMI-PRESENCIAL',
            'type' => 'career_modality',
            'state_id' => 1,
        ]);
        factory(App\Models\Catalogue::class)->create([
            'code' => '3',
            'name' => 'DISTANCIA',
            'type' => 'career_modality',
            'state_id' => 1,
        ]);
        factory(App\Models\Catalogue::class)->create([
            'code' => '4',
            'name' => 'DUAL',
            'type' => 'career_modality',
            'state_id' => 1,
        ]);

        // career type
        factory(App\Models\Catalogue::class)->create([
            'code' => '1',
            'name' => 'TECNICATURA',
            'type' => 'career_type',
            'state_id' => 1,
        ]);
        factory(App\Models\Catalogue::class)->create([
            'code' => '2',
            'name' => 'TECNOLOGIA',
            'type' => 'career_type',
            'state_id' => 1,
        ]);

        // location
        factory(App\Models\Catalogue::class)->create([
            'code' => 'ec',
            'name' => 'ECUADOR',
            'type' => 'country',
            'state_id' => 1,
        ]);
        factory(App\Models\Catalogue::class)->create([
            'parent_code_id' => 60,
            'code' => '17',
            'name' => 'PICHINCHA',
            'type' => 'province',
            'state_id' => 1,
        ]);
        factory(App\Models\Catalogue::class)->create([
            'parent_code_id' => 61,
            'code' => '1',
            'name' => 'QUITO',
            'type' => 'canton',
            'state_id' => 1,
        ]);

        factory(App\Role::class)->create([
            'code' => '1',
            'name' => 'DOCENTE',
            'state_id' => 1,
        ]);

        factory(App\Role::class)->create([
            'code' => '2',
            'name' => 'ADMINISTRATIVO',
            'state_id' => 1,
        ]);


       // factory(App\User::class, 100)->create();
    }
}
