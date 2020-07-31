<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Company;
use App\Offer;
use App\Professional;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class CompanyController extends Controller
{

    function applyPostulant(Request $request)
    {
        try {
            $data = $request->json()->all();
            $user = $data['user'];
            $postulant = $data['postulant'];
            $company = Company::where('user_id', $user['id'])->first();
            if ($company) {
                $appliedOffer = DB::table('company_professional')
                    ->where('professional_id', $postulant['id'])
                    ->where('company_id', $company->id)
                    ->where('state', 'ACTIVE')
                    ->first();
                if (!$appliedOffer) {
                    $company->professionals()->attach($postulant['id']);
                    return response()->json(true, 201);
                } else {
                    return response()->json(false, 201);
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

    function detachPostulant(Request $request)
    {
        try {
            $data = $request->json()->all();
            $user = $data['user'];
            $postulant = $data['postulant'];
            $company = Company::where('user_id', $user['id'])->first();
            if ($company) {
                $response = $company->professionals()->detach($postulant['professional_id']);
                return response()->json($response, 201);

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

    function getAppliedProfessionals(Request $request)
    {
        try {
            $company = Company::where('user_id', $request->user_id)->first();

            if ($company) {
                $professionals = DB::table('professionals')
                    ->join('company_professional', 'company_professional.professional_id', '=', 'professionals.id')
                    ->where('company_professional.company_id', $company->id)
                    ->where('company_professional.state', 'ACTIVE')
                    ->orderby('company_professional.' . $request->field, $request->order)
                    ->paginate($request->limit);
                return response()->json([
                    'pagination' => [
                        'total' => $professionals->total(),
                        'current_page' => $professionals->currentPage(),
                        'per_page' => $professionals->perPage(),
                        'last_page' => $professionals->lastPage(),
                        'from' => $professionals->firstItem(),
                        'to' => $professionals->lastItem()
                    ], 'professionals' => $professionals], 200);
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

    function getOffers(Request $request)
    {
        try {
            $company = Company::where('user_id', $request->id)->first();
            $offers = $company->offers()
                ->where('state', 'ACTIVE')
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

    function filterOffers(Request $request)
    {
        try {
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

    function getAllProfessionals()
    {
        $offers = Offer::where('state', 'ACTIVE')
            ->get();
        return response()->json(['offers' => $offers], 200);

    }

    function showCompany($id)
    {
        try {
            $company = Company::where('user_id', $id)->first();
            return response()->json(['company' => $company], 200);
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

    function createOffer(Request $request)
    {
        try {
            $data = $request->json()->all();
            $dataOffer = $data['offer'];
            $dataCompany = $data['company'];
            $company = Company::where('user_id', $dataCompany['id'])->first();
            $response = $company->offers()->create([
                'code' => strtoupper($dataOffer ['code']),
                'contact' => strtoupper($dataOffer ['contact']),
                'email' => strtolower($dataOffer ['email']),
                'phone' => $dataOffer ['phone'],
                'cell_phone' => $dataOffer ['cell_phone'],
                'contract_type' => $dataOffer ['contract_type'],
                'position' => strtoupper($dataOffer ['position']),
                'broad_field' => $dataOffer ['broad_field'],
                'specific_field' => $dataOffer ['specific_field'],
                'training_hours' => $dataOffer ['training_hours'],
                'experience_time' => $dataOffer ['experience_time'],
                'remuneration' => $dataOffer ['remuneration'],
                'working_day' => $dataOffer ['working_day'],
                'number_jobs' => $dataOffer ['number_jobs'],
                'start_date' => $dataOffer ['start_date'],
                'finish_date' => $dataOffer ['finish_date'],
                'activities' => strtoupper($dataOffer ['activities']),
                'aditional_information' => strtoupper($dataOffer ['aditional_information']),
                'province' => $dataOffer ['province'],
                'city' => $dataOffer ['city'],
            ]);
            return response()->json($response, 201);
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

    function updateOffer(Request $request)
    {
        try {
            $data = $request->json()->all();
            $dataOffer = $data['offer'];
            $response = Offer::findOrFail($dataOffer['id'])->update([
                'code' => strtoupper($dataOffer ['code']),
                'contact' => strtoupper($dataOffer ['contact']),
                'email' => strtolower($dataOffer ['email']),
                'phone' => $dataOffer ['phone'],
                'cell_phone' => $dataOffer ['cell_phone'],
                'contract_type' => $dataOffer ['contract_type'],
                'position' => strtoupper($dataOffer ['position']),
                'broad_field' => $dataOffer ['broad_field'],
                'specific_field' => $dataOffer ['specific_field'],
                'training_hours' => $dataOffer ['training_hours'],
                'experience_time' => $dataOffer ['experience_time'],
                'remuneration' => $dataOffer ['remuneration'],
                'working_day' => $dataOffer ['working_day'],
                'number_jobs' => $dataOffer ['number_jobs'],
                'start_date' => $dataOffer ['start_date'],
                'finish_date' => $dataOffer ['finish_date'],
                'activities' => strtoupper($dataOffer ['activities']),
                'aditional_information' => strtoupper($dataOffer ['aditional_information']),
                'province' => $dataOffer ['province'],
                'city' => $dataOffer ['city'],
            ]);
            return response()->json($response, 201);
        } catch (ModelNotFoundException $e) {
            return response()->json('ModelNotFound', 405);
        } catch (NotFoundHttpException  $e) {
            return response()->json('NotFoundHttp', 405);
        } catch (QueryException  $e) {
            return response()->json($e, 405);
        } catch (Exception $e) {
            return response()->json('Exception', 500);
        } catch (Error $e) {
            return response()->json('Error', 500);
        }
    }

    function updateCompany(Request $request)
    {
        try {
            $data = $request->json()->all();
            $dataCompany = $data['company'];
            $company = Company::findOrFail($dataCompany['id']);
            $company->update([
                'identity' => trim($dataCompany['identity']),
                'email' => strtolower(trim($dataCompany['email'])),
                'nature' => $dataCompany['nature'],
                'trade_name' => strtoupper(trim($dataCompany['trade_name'])),
                'comercial_activity' => strtoupper(trim($dataCompany['comercial_activity'])),
                'phone' => trim($dataCompany['phone']),
                'cell_phone' => trim($dataCompany['cell_phone']),
                'web_page' => strtolower(trim($dataCompany['web_page'])),
                'address' => strtoupper(trim($dataCompany['address'])),
            ]);
            $company->user()->update(['email' => strtolower(trim($dataCompany['email']))]);
            return response()->json($company, 201);
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

    function deleteCompany(Request $request)
    {
        try {
            $offer = Offer::findOrFail($request->id)->delete();
            return response()->json($offer, 201);
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

}
