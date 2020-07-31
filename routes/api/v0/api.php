<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::get('passwords', function () {
    $users = \App\User::orderBy('id')->get();
    $passwords = array();
    $users2 = array();
    foreach ($users as $user) {
        $passwords[] = \Illuminate\Support\Facades\Hash::make($user->identification);
        $users2[] = $user->first_lastname;
    }
    return response()->json(['users' => $users2, 'passwords' => $passwords]);
});

// Users
Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'v0\AuthController@login');
    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('logout', 'v0\AuthController@logout');
        Route::get('user', 'v0\AuthController@user');
        Route::put('users', 'v0\AuthController@updateUser');
        Route::put('password', 'v0\AuthController@changePassword');
        Route::post('users/avatar', 'v0\AuthController@uploadAvatarUri');
    });
});

/* Rutas para las ofertas*/
Route::group(['prefix' => 'offers'], function () {
    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('/professionals', 'OfferController@getAppliedProfessionals');
        Route::post('/professionals', 'OfferController@createProfessional');
        Route::post('','OfferController@createOffer');
        Route::put('','OfferController@updateOffer');
        Route::delete('','OfferController@deleteOffer');
        Route::delete('/finish','OfferController@finishOffer');
    });
});

/* Rutas para los profesionales*/
Route::group(['prefix' => 'professionals'], function () {
    Route::group(['middleware' => 'auth:api'], function () {
        Route:: get('/abilities',' ProfessionalController@getAbilities');
        Route::get('/academicFormations','ProfessionalController@getAcademicFormations');
        Route::get('/courses', 'ProfessionalController@getCourses');
        Route::get('/languages', 'ProfessionalController@getLanguages');
        Route::get('/professionalExperiences','ProfessionalController@getProfessionalExperiences');
        Route::get('/professionalReferences','ProfessionalController@getProfessionalReferences');

        Route::get('/offers','ProfessionalController@getAppliedOffers');
        Route::post('/offers/filter','ProfessionalController@filterOffers');
        Route::post('/offers', 'ProfessionalController@createOffer');
        Route::get('/companies','ProfessionalController@getAppliedCompanies');

        Route::get('/{id}','ProfessionalController@showProfessional');
        Route::post('','ProfessionalController@createProfessional');
        Route::put('','ProfessionalController@updateProfessional');
        Route::delete('','ProfessionalController@deleteProfessional');

    });
});

/* Rutas para los Formacion Academica*/
Route::group(['prefix' => 'academicFormations'], function () {
    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('',  'AcademicFormationController@getAcademicFormations');
        Route::get('/{id}',  'AcademicFormationController@showAcademicFormations');
        Route::post('', 'AcademicFormationController@createAcademicFormation');
        Route::put('',  'AcademicFormationController@updateAcademicFormation');
        Route::delete('',  'AcademicFormationController@deleteAcademicFormation');
    });
});

/* Rutas para los idiomas*/
Route::group(['prefix' => 'languages'], function () {
    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('',  'LanguageController@getLanguages');
        Route::get('/{id}',  'LanguageController@showLanguage');
        Route::post('',  'LanguageController@createLanguage');
        Route::put('',  'LanguageController@updateLanguage');
        Route::delete('', 'LanguageController@deleteLanguage');
    });
});
/* Rutas para las fortalezas*/
Route::group(['prefix' => 'abilities'], function () {
    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('',  'AbilityController@getAbilities');
        Route::get('/{id}',  'AbilityController@showAbility');
        Route::post('',  'AbilityController@createAbility');
        Route::put('',  'AbilityController@updateAbility');
        Route::delete('',  'AbilityController@deleteAbility');
    });
});

 /* Rutas para los cursos*/
 Route::group(['prefix' => 'courses'], function () {
    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('','CourseController@getCourses');
        Route::get('/{id}','CourseController@showCourse');
        Route::post('', 'CourseController@createCourse');
        Route::put('', 'CourseController@updateCourse');
        Route::delete('','CourseController@deleteCourse');
    });
});

/* Rutas para las experiencias pofesionales*/
Route::group(['prefix' => 'professionalExperiences'], function () {
    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('', 'ProfessionalExperienceController@getProfessionalExperiences');
        Route::get('/{id}', 'ProfessionalExperienceController@showProfessionalExperience');
        Route::post('',  'ProfessionalExperienceController@createProfessionalExperience');
        Route::put('',  'ProfessionalExperienceController@updateProfessionalExperience');
        Route::delete('',  'ProfessionalExperienceController@deleteProfessionalExperience');
    });
});

 /* Rutas para las referencias pofesionales*/
Route::group(['prefix' => 'professionalReferences'], function () {
    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('','ProfessionalReferenceController@getProfessionalReferences');
        Route::get('/{id}','ProfessionalReferenceController@showProfessionalReference');
        Route::post('','ProfessionalReferenceController@createProfessionalReference');
        Route::put('', 'ProfessionalReferenceController@updateProfessionalReference');
        Route::delete('','ProfessionalReferenceController@deleteProfessionalReference');
    });
});

 /* Rutas para las empresas*/
 Route::group(['prefix' => 'companies'], function () {
    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('/professionals', 'CompanyController@getAppliedProfessionals');
        Route::get('/offers', 'CompanyController@getOffers');
        Route::post('offers',  'CompanyController@createOffer');
        Route::put('/offers',  'CompanyController@updateOffer');
        Route::post('/offers/filter', 'CompanyController@filterOffers');
        Route::get('',  'CompanyController@getAllCompanies');
        Route::get('/{id}',  'CompanyController@showCompany');
        Route::put('','CompanyController@updateCompany');
        Route::delete('',  'CompanyController@deleteCompany');
    });
});

/* Rutas para obtener todos los profesionales y ofertas*/

    Route::get('/postulants',  'ProfessionalController@getProfessionals');
    Route::post('/postulants/apply',  'CompanyController@applyPostulant');
    Route::post('/postulants/detachCompany',  'ProfessionalController@detachCompany');
    Route::post('/companies/detachPostulant',  'CompanyController@detachPostulant');
    Route::get('/postulants/validateAppliedPostulant',  'ProfessionalController@validateAppliedPostulant');
    Route::get('/oportunities',  'OfferController@getOffers');

    Route::get('/oportunities/validateAppliedOffer', 'OfferController@validateAppliedOffer');
    Route::post('/oportunities/apply',  'OfferController@applyOffer');
    Route::get('/totalCompanies', function () {

        $totalCompanies = \App\Company::where('state', 'ACTIVE')->count();

        return response()->json(['totalCompanies' => $totalCompanies], 200);
});
    Route::get('/totalOffers', function () {
        $now = Carbon::now();
        $totalOffers = \App\Offer::where('state', 'ACTIVE')
        ->where('finish_date', '>=', $now->format('Y-m-d'))
        ->where('start_date', '<=', $now->format('Y-m-d'))
        ->count();
        return response()->json(['totalOffers' => $totalOffers], 200);
});
    Route::get('/totalProfessionals', function () {
        $totalProfessionals = \App\Professional::where('state', 'ACTIVE')->count();
        return response()->json(['totalProfessionals' => $totalProfessionals], 200);
});
$router->get('/offers', ['uses' => 'OfferController@getAllOffers']);
/****************************************/

/* Rutas para filtrar a los profesionales y ofertas*/
    Route::post('/offers/filter',  'OfferController@filterOffers');
    Route::get('/oportunities/filter',  'OfferController@filterOffersFields');
    Route::post('/postulants/filter',  'ProfessionalController@filterPostulants');
    Route::get('/postulants/filter',  'ProfessionalController@filterPostulantsFields');
/****************************************/
    Route::get('/professionals',  'ProfessionalController@getAllProfessionals');
    Route::get('/validate_cedula',  'UserController@validateCedula');

  