<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Professional;
use App\AcademicFormation;


class AcademicFormationController extends Controller
{
    function getAcademicFormations(Request $request)
    {
        try {
            $professional = Professional::where('id', $request->user_id)->first();
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

    function showAcademicFormation($id)
    {
        try {
            $academicFormation = AcademicFormation::findOrFail($id);
            return response()->json(['academicFormation' => $academicFormation], 200);
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

    function createAcademicFormation(Request $request)
    {
        try {
            $data = $request->json()->all();
            $dataUser = $data['user'];
            $dataAcademicFormation = $data['academicFormation'];
            $professional = Professional::where('user_id', $dataUser['id'])->first();
            if ($professional) {
                $response = $professional->academicFormations()->create([
                    'institution' => $dataAcademicFormation ['institution'],
                    'career' => $dataAcademicFormation ['career'],
                    'professional_degree' => $dataAcademicFormation ['professional_degree'],
                    'registration_date' => $dataAcademicFormation ['registration_date'],
                    'senescyt_code' => $dataAcademicFormation ['senescyt_code'],
                    'has_titling' => $dataAcademicFormation ['has_titling'],
                ]);
                return response()->json($response, 201);
            } else {
                return response()->json(null, 404);
            }
        } catch (
            ModelNotFoundException $e) {
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

    function updateAcademicFormation(Request $request)
    {
        try {
            $data = $request->json()->all();
            $dataAcademicFormation = $data['academicFormation'];
            $academicFormation = AcademicFormation::findOrFail($dataAcademicFormation ['id'])->update([
                'institution' => $dataAcademicFormation ['institution'],
                'career' => $dataAcademicFormation ['career'],
                'professional_degree' => $dataAcademicFormation ['professional_degree'],
                'registration_date' => $dataAcademicFormation ['registration_date'],
                'senescyt_code' => $dataAcademicFormation ['senescyt_code'],
                'has_titling' => $dataAcademicFormation ['has_titling'],
            ]);
            return response()->json($academicFormation, 201);
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

    function deleteAcademicFormation(Request $request)
    {
        try {
            $academicFormation = AcademicFormation::findOrFail($request->id)->delete();
            return response()->json($academicFormation, 201);
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
}
