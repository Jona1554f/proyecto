<?php

namespace App\Http\Controllers;

use App\Ability;
use App\AcademicFormation;
use App\Company;
use App\Course;
use App\Language;
use App\Offer;
use App\Professional;
use App\ProfessionalExperience;
use App\ProfessionalReference;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ProfessionalController extends Controller
{
    function getAbilities(Request $request)
    {
        try {
            $professional = Professional::where('user_id', $request->user_id)->first();
            if ($professional) {
                $abilities = Ability::where('professional_id', $professional->id)
                    ->where('state', '<>', 'DELETED')
                    ->orderby($request->field, $request->order)
                    ->paginate($request->limit);
                return response()->json([
                    'pagination' => [
                        'total' => $abilities->total(),
                        'current_page' => $abilities->currentPage(),
                        'per_page' => $abilities->perPage(),
                        'last_page' => $abilities->lastPage(),
                        'from' => $abilities->firstItem(),
                        'to' => $abilities->lastItem()
                    ], 'abilities' => $abilities], 200);
            } else {
                return response()->json([
                    'pagination' => [
                        'total' => 0,
                        'current_page' => 1,
                        'per_page' => $request->limit,
                        'last_page' => 1,
                        'from' => null,
                        'to' => null
                    ], 'abilities' => null], 404);
            }
        } catch (ModelNotFoundException $e) {
            return response()->json($e, 405);
        } catch (NotFoundHttpException  $e) {
            return response()->json($e, 405);
        } catch (QueryException $e) {
            return response()->json($e, 400);
        } catch (Exception $e) {
            return response()->json($e, 500);
        } catch (Error $e) {
            return response()->json($e, 500);
        } catch (ErrorException $e) {
            return response()->json($e, 500);
        }
    }

    function getAcademicFormations(Request $request)
    {
        try {
            $professional = Professional::where('user_id', $request->user_id)->first();
            if ($professional) {
                $academicFormations = AcademicFormation::where('professional_id', $professional->id)
                    ->where('state', 'ACTIVE')
                    ->orderby($request->field, $request->order)
                    ->paginate($request->limit);
            } else {
                return response()->json([
                    'pagination' => [
                        'total' => 0,
                        'current_page' => 1,
                        'per_page' => $request->limit,
                        'last_page' => 1,
                        'from' => null,
                        'to' => null
                    ], 'academicFormations' => null], 404);
            }
            return response()->json([
                'pagination' => [
                    'total' => $academicFormations->total(),
                    'current_page' => $academicFormations->currentPage(),
                    'per_page' => $academicFormations->perPage(),
                    'last_page' => $academicFormations->lastPage(),
                    'from' => $academicFormations->firstItem(),
                    'to' => $academicFormations->lastItem()
                ], 'academicFormations' => $academicFormations], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json($e, 405);
        }
    }

    function getCourses(Request $request)
    {
        try {
            $professional = Professional::where('user_id', $request->user_id)->first();
            if ($professional) {
                $courses = Course::where('professional_id', $professional->id)
                    ->orderby($request->field, $request->order)
                    ->paginate($request->limit);
                return response()->json([
                    'pagination' => [
                        'total' => $courses->total(),
                        'current_page' => $courses->currentPage(),
                        'per_page' => $courses->perPage(),
                        'last_page' => $courses->lastPage(),
                        'from' => $courses->firstItem(),
                        'to' => $courses->lastItem()
                    ], 'courses' => $courses], 200);
            } else {
                return response()->json([
                    'pagination' => [
                        'total' => 0,
                        'current_page' => 1,
                        'per_page' => $request->limit,
                        'last_page' => 1,
                        'from' => null,
                        'to' => null
                    ], 'courses' => null], 404);
            }
        } catch (ModelNotFoundException $e) {
            return response()->json($e, 405);
        } catch (NotFoundHttpException  $e) {
            return response()->json($e, 405);
        } catch (QueryException $e) {
            return response()->json($e, 400);
        } catch (Exception $e) {
            return response()->json($e, 500);
        } catch (Error $e) {
            return response()->json($e, 500);
        } catch (ErrorException $e) {
            return response()->json($e, 500);
        }
    }

    function getLanguages(Request $request)
    {
        try {
            $professional = Professional::where('user_id', $request->user_id)->first();
            if ($professional) {
                $languages = Language::where('professional_id', $professional->id)
                    ->where('state', 'ACTIVE')
                    ->orderby($request->field, $request->order)
                    ->paginate($request->limit);
                return response()->json([
                    'pagination' => [
                        'total' => $languages->total(),
                        'current_page' => $languages->currentPage(),
                        'per_page' => $languages->perPage(),
                        'last_page' => $languages->lastPage(),
                        'from' => $languages->firstItem(),
                        'to' => $languages->lastItem()
                    ], 'languages' => $languages], 200);
            } else {
                return response()->json([
                    'pagination' => [
                        'total' => 0,
                        'current_page' => 1,
                        'per_page' => $request->limit,
                        'last_page' => 1,
                        'from' => null,
                        'to' => null
                    ], 'languages' => null], 404);
            }
        } catch (ModelNotFoundException $e) {
            return response()->json($e, 405);
        } catch (NotFoundHttpException  $e) {
            return response()->json($e, 405);
        } catch (QueryException $e) {
            return response()->json($e, 400);
        } catch (Exception $e) {
            return response()->json($e, 500);
        } catch (Error $e) {
            return response()->json($e, 500);
        } catch (ErrorException $e) {
            return response()->json($e, 500);
        }
    }

    function getProfessionalExperiences(Request $request)
    {
        try {
            $professional = Professional::where('user_id', $request->user_id)->first();
            if ($professional) {
                $professionalExperiences = ProfessionalExperience::where('professional_id', $professional->id)
                    ->where('state', 'ACTIVE')
                    ->orderby($request->field, $request->order)
                    ->paginate($request->limit);
                return response()->json([
                    'pagination' => [
                        'total' => $professionalExperiences->total(),
                        'current_page' => $professionalExperiences->currentPage(),
                        'per_page' => $professionalExperiences->perPage(),
                        'last_page' => $professionalExperiences->lastPage(),
                        'from' => $professionalExperiences->firstItem(),
                        'to' => $professionalExperiences->lastItem()
                    ], 'professionalExperiences' => $professionalExperiences], 200);
            } else {
                return response()->json([
                    'pagination' => [
                        'total' => 0,
                        'current_page' => 1,
                        'per_page' => $request->limit,
                        'last_page' => 1,
                        'from' => null,
                        'to' => null
                    ], 'professionalExperiences' => null], 404);
            }
        } catch (ModelNotFoundException $e) {
            return response()->json($e, 405);
        } catch (NotFoundHttpException  $e) {
            return response()->json($e, 405);
        } catch (QueryException $e) {
            return response()->json($e, 400);
        } catch (Exception $e) {
            return response()->json($e, 500);
        } catch (Error $e) {
            return response()->json($e, 500);
        } catch (ErrorException $e) {
            return response()->json($e, 500);
        }
    }

    function getProfessionalReferences(Request $request)
    {
        try {
            $professional = Professional::where('user_id', $request->user_id)->first();
            if ($professional) {
                $professionalReferences = ProfessionalReference::where('professional_id', $professional->id)
                    ->where('state', 'ACTIVE')
                    ->orderby($request->field, $request->order)
                    ->paginate($request->limit);
                return response()->json([
                    'pagination' => [
                        'total' => $professionalReferences->total(),
                        'current_page' => $professionalReferences->currentPage(),
                        'per_page' => $professionalReferences->perPage(),
                        'last_page' => $professionalReferences->lastPage(),
                        'from' => $professionalReferences->firstItem(),
                        'to' => $professionalReferences->lastItem()
                    ], 'professionalReferences' => $professionalReferences], 200);
            } else {
                return response()->json([
                    'pagination' => [
                        'total' => 0,
                        'current_page' => 1,
                        'per_page' => $request->limit,
                        'last_page' => 1,
                        'from' => null,
                        'to' => null
                    ], 'professionalReference' => null], 404);
            }
        } catch (ModelNotFoundException $e) {
            return response()->json($e, 405);
        } catch (NotFoundHttpException  $e) {
            return response()->json($e, 405);
        } catch (QueryException $e) {
            return response()->json($e, 400);
        } catch (Exception $e) {
            return response()->json($e, 500);
        } catch (Error $e) {
            return response()->json($e, 500);
        } catch (ErrorException $e) {
            return response()->json($e, 500);
        }
    }

    function filterOffers(Request $request)
    {

        //para tener varias condiciones en un array
        //$users = User::orWhere([$request->conditions])
        $data = $request->json()->all();
        $offers = Offer::orWhere('broad_field', 'like', $data['broad_field'] . '%')
            ->orWhere('specific_field', 'like', $data['specific_field'] . '%')
            ->orWhere('position', 'like', $data['position'] . '%')
            ->orWhere('remuneration', 'like', $data['remuneration'] . '%')
            ->orWhere('working_day', 'like', $data['working_day'] . '%')
            ->orderby($request->field, $request->order)
            ->paginate($request->limit);
        return response()->json([
            'pagination' => [
                'total' => $offers->total(),
                'current_page' => $offers->currentPage(),
                'per_page' => $offers->perPage(),
                'last_page' => $offers->lastPage(),
                'from' => $offers->firstItem(),
                'to' => $offers->lastItem()
            ], 'offers' => $offers], 200);

    }

    function getAppliedCompanies(Request $request)
    {
        try {
            $professional = Professional::where('user_id', $request->user_id)->first();
            if ($professional) {
                $companies = DB::table('companies')
                    ->join('company_professional', 'company_professional.company_id', '=', 'companies.id')
                    ->where('company_professional.professional_id', $professional->id)
                    ->where('company_professional.state', 'ACTIVE')
//                    ->orWhere('offer_professional.state', 'FINISHED')
                    ->orderby('company_professional.' . $request->field, $request->order)
                    ->paginate($request->limit);
                return response()->json([
                    'pagination' => [
                        'total' => $companies->total(),
                        'current_page' => $companies->currentPage(),
                        'per_page' => $companies->perPage(),
                        'last_page' => $companies->lastPage(),
                        'from' => $companies->firstItem(),
                        'to' => $companies->lastItem()
                    ], 'companies' => $companies], 200);
            } else {
                return response()->json([
                    'pagination' => [
                        'total' => 0,
                        'current_page' => 1,
                        'per_page' => $request->limit,
                        'last_page' => 1,
                        'from' => null,
                        'to' => null
                    ], 'companies' => null], 404);
            }
        } catch (ModelNotFoundException $e) {
            return response()->json($e, 405);
        } catch (NotFoundHttpException  $e) {
            return response()->json($e, 405);
        } catch (QueryException $e) {
            return response()->json($e, 400);
        } catch (Exception $e) {
            return response()->json($e, 500);
        } catch (Error $e) {
            return response()->json($e, 500);
        }

    }

    function filterPostulants(Request $request)
    {
        $data = $request->json()->all();
        $dataFilter = $data['filters'];
        $postulants = Professional::
        join('academic_formations', 'academic_formations.professional_id', '=', 'professionals.id')
            ->orWhere($dataFilter['conditions'])
            ->where('professionals.state', 'ACTIVE')
            ->where('professionals.about_me', '<>', '')
            ->where('academic_formations.state', 'ACTIVE')
            ->orderby('professionals.' . $request->field, $request->order)
            ->paginate($request->limit);
        return response()->json([
            'pagination' => [
                'total' => $postulants->total(),
                'current_page' => $postulants->currentPage(),
                'per_page' => $postulants->perPage(),
                'last_page' => $postulants->lastPage(),
                'from' => $postulants->firstItem(),
                'to' => $postulants->lastItem()
            ], 'postulants' => $postulants], 200);

    }

    function filterPostulantsFields(Request $request)
    {
        $postulants = Professional::
        join('academic_formations', 'academic_formations.professional_id', '=', 'professionals.id')
            ->where('professionals.about_me', '<>', '')
            ->where('professionals.state', 'ACTIVE')
            ->where('academic_formations.state', 'ACTIVE')
            ->where('career', 'like', strtoupper($request->filter) . '%')
            ->OrWhere('professional_degree', 'like', '%' . strtoupper($request->filter) . '%')
            ->orderby('professionals.' . $request->field, $request->order)
            ->paginate($request->limit);
        return response()->json([
            'pagination' => [
                'total' => $postulants->total(),
                'current_page' => $postulants->currentPage(),
                'per_page' => $postulants->perPage(),
                'last_page' => $postulants->lastPage(),
                'from' => $postulants->firstItem(),
                'to' => $postulants->lastItem()
            ], 'postulants' => $postulants], 200);

    }

    /* Metodo para obtener todas las ofertas a las que aplico el profesional*/
    function getAppliedOffers(Request $request)
    {
        try {
            $professional = Professional::where('user_id', $request->user_id)->first();
            if ($professional) {
                $offers = DB::table('offers')
                    ->join('offer_professional', 'offer_professional.offer_id', '=', 'offers.id')
                    ->where('offer_professional.professional_id', $professional->id)
                    ->where('offer_professional.state', 'ACTIVE')
                    ->orWhere('offer_professional.state', 'FINISHED')
                    ->orderby('offer_professional.' . $request->field, $request->order)
                    ->paginate($request->limit);
                return response()->json([
                    'pagination' => [
                        'total' => $offers->total(),
                        'current_page' => $offers->currentPage(),
                        'per_page' => $offers->perPage(),
                        'last_page' => $offers->lastPage(),
                        'from' => $offers->firstItem(),
                        'to' => $offers->lastItem()
                    ], 'offers' => $offers], 200);
            } else {
                return response()->json([
                    'pagination' => [
                        'total' => 0,
                        'current_page' => 1,
                        'per_page' => $request->limit,
                        'last_page' => 1,
                        'from' => null,
                        'to' => null
                    ], 'offers' => null], 404);
            }
        } catch (ModelNotFoundException $e) {
            return response()->json($e, 405);
        } catch (NotFoundHttpException  $e) {
            return response()->json($e, 405);
        } catch (QueryException $e) {
            return response()->json($e, 400);
        } catch (Exception $e) {
            return response()->json($e, 500);
        } catch (Error $e) {
            return response()->json($e, 500);
        }

    }

    /* Metodo para filtrar a los profesionales*/
    function filterProfessionals(Request $request)
    {

        $data = $request->json()->all();
        $professionals = Professional::
        join('academic_formations', 'academic_formations.professional_id', '=', 'professionals.id')
            ->orWhere('academic_formations.professional_degree', 'like', $data['professional_degree'] . '%')
            ->orWhere('academic_formations.professional_degree', 'like', $data['professional_degree'] . '%')
            ->get();
        return $professionals;
        $professionals = Professional::orWhere('broad_field', 'like', $data['broad_field'] . '%')
            ->orWhere('specific_field', 'like', $data['specific_field'] . '%')
            ->orWhere('position', 'like', $data['position'] . '%')
            ->orWhere('remuneration', 'like', $data['remuneration'] . '%')
            ->orWhere('working_day', 'like', $data['working_day'] . '%')
            ->orderby($request->field, $request->order)
            ->paginate($request->limit);
        return response()->json([
            'pagination' => [
                'total' => $professionals->total(),
                'current_page' => $professionals->currentPage(),
                'per_page' => $professionals->perPage(),
                'last_page' => $professionals->lastPage(),
                'from' => $professionals->firstItem(),
                'to' => $professionals->lastItem()
            ], 'offers' => $professionals], 200);

    }

    /* Metodo para asignar ofertas a un profesional*/
    function createOffer(Request $request)
    {

        try {
            $professional = Professional::findOrFail($request->professional_id);
            $response = $professional->offers()->attach($request->offer_id);
            return response()->json($response, 201);
        } catch (ModelNotFoundException $e) {
            return response()->json('ModelNotFound', 405);
        } catch (NotFoundHttpException  $e) {
            return response()->json('NotFoundHttp', 405);
        } catch (Exception $e) {
            return response()->json('Exception', 500);
        } catch (Error $e) {
            return response()->json('Error', 500);
        }

    }

    /* Metodos para gestionar los datos personales*/
    function getProfessionals(Request $request)
    {
        $professionals = Professional::
        join('academic_formations', 'academic_formations.professional_id', '=', 'professionals.id')
            ->with('academicFormations')
            ->where('professionals.state', 'ACTIVE')
            ->where('professionals.about_me', '<>', '')
//            ->where('academic_formations.state', 'ACTIVE')
            ->orderby('professionals.' . $request->field, $request->order)
            ->paginate($request->limit);

//        $professionals = Professional::where('professionals.state', 'ACTIVE')
//            ->where('academic_formations.state', 'ACTIVE')
//            ->join('academic_formations', 'academic_formations.professional_id', '=', 'academic_formations.id')
//            ->orderby('professionals.' . $request->field, $request->order)
//            ->paginate($request->limit);
        return response()->json([
            'pagination' => [
                'total' => $professionals->total(),
                'current_page' => $professionals->currentPage(),
                'per_page' => $professionals->perPage(),
                'last_page' => $professionals->lastPage(),
                'from' => $professionals->firstItem(),
                'to' => $professionals->lastItem()
            ], 'postulants' => $professionals], 200);

    }

    function getAllProfessionals()
    {
        $professionals = Professional::
        join('academic_formations', 'academic_formations.professional_id', 'professionals.id')
            ->with('academicFormations')
            ->where('professionals.about_me', '<>', '')
            ->where('professionals.state', 'ACTIVE')->get();
        return response()->json(['professionals' => $professionals], 200);

    }

    function showProfessional($id)
    {
        try {
            $professional = Professional::where('user_id', $id)->with('academicFormations')->first();
            return response()->json(['professional' => $professional], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json($e, 405);
        } catch (NotFoundHttpException  $e) {
            return response()->json($e, 405);
        } catch (QueryException  $e) {
            return response()->json($e, 405);
        } catch (Exception $e) {
            return response()->json($e, 500);
        } catch (Error $e) {
            return response()->json($e, 500);
        }
    }

    function updateProfessional(Request $request)
    {
        try {
            $data = $request->json()->all();
            $dataProfessional = $data['professional'];

            $professional = Professional::findOrFail($dataProfessional['id']);
            $professional->update([
                'identity' => trim($dataProfessional['identity']),
                'first_name' => strtoupper(trim($dataProfessional['first_name'])),
                'last_name' => strtoupper(trim($dataProfessional['last_name'])),
                'email' => strtolower(trim($dataProfessional['email'])),
                'nationality' => strtoupper($dataProfessional['nationality']),
                'civil_state' => strtoupper($dataProfessional['civil_state']),
                'birthdate' => $dataProfessional['birthdate'],
                'gender' => strtoupper($dataProfessional['gender']),
                'phone' => trim($dataProfessional['phone']),
                'address' => strtoupper(trim($dataProfessional['address'])),
                'about_me' => strtoupper(trim($dataProfessional['about_me'])),
            ]);
            $professional->user()->update(['email' => strtolower(trim($dataProfessional['email']))]);


            return response()->json('asd', 201);
        } catch (ModelNotFoundException $e) {
            return response()->json('ModelNotFound', 405);
        } catch (NotFoundHttpException  $e) {
            return response()->json('NotFoundHttp', 405);
        } catch (QueryException $e) {
            return response()->json($e, 500);
        } catch (Exception $e) {
            return response()->json($e, 500);
        } catch (Error $e) {
            return response()->json($e, 500);
        }
    }

    function deleteProfessional(Request $request)
    {
        try {
            $professional = Professional::findOrFail($request->id)->delete();
            return response()->json($professional, 201);
        } catch (ModelNotFoundException $e) {
            return response()->json('ModelNotFound', 405);
        } catch (NotFoundHttpException  $e) {
            return response()->json('NotFoundHttp', 405);
        } catch (Exception $e) {
            return response()->json('Exception', 500);
        } catch (Error $e) {
            return response()->json('Error', 500);
        }
    }

    function validateAppliedPostulant(Request $request)
    {
        try {
            $company = Company::where('user_id', $request->user_id)->first();
            if ($company) {
                $appliedOffer = DB::table('company_professional')
                    ->where('professional_id', $request->professional_id)
                    ->where('company_id', $company->id)
                    ->where('state', 'ACTIVE')
                    ->first();
                if ($appliedOffer) {
                    return response()->json(true, 200);
                } else {
                    return response()->json(false, 200);
                }
            } else {
                return response()->json(null, 404);
            }

        } catch (ModelNotFoundException $e) {
            return response()->json($e, 405);
        } catch (NotFoundHttpException  $e) {
            return response()->json($e, 405);
        } catch (QueryException $e) {
            return response()->json($e, 409);
        } catch (\PDOException $e) {
            return response()->json($e, 409);
        } catch (Exception $e) {
            return response()->json($e, 500);
        } catch (Error $e) {
            return response()->json($e, 500);
        }
    }

    function detachCompany(Request $request)
    {
        try {
            $data = $request->json()->all();
            $user = $data['user'];
            $company = $data['company'];
            $professional = Professional::where('user_id', $user['id'])->first();
            if ($professional) {
                $response = $professional->companies()->detach($company['company_id']);
                if ($response == 0) {
                    return response()->json($response, 404);
                } else {
                    return response()->json($response, 201);
                }

            } else {
                return response()->json(0, 404);
            }
        } catch (ModelNotFoundException $e) {
            return response()->json($e, 405);
        } catch (NotFoundHttpException  $e) {
            return response()->json($e, 405);
        } catch (QueryException $e) {
            return response()->json($e, 409);
        } catch (\PDOException $e) {
            return response()->json($e, 409);
        } catch (Exception $e) {
            return response()->json($e, 500);
        } catch (Error $e) {
            return response()->json($e, 500);
        }

    }


}
