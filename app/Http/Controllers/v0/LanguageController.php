<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Language;
use App\Professional;

class LanguageController extends Controller
{
    function getLanguages(Request $request)
    {
        try {
            $professional = Professional::where('id', $request->user_id)->first();
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

    function showLanguage($id)
    {
        try {
            $language = Language::findOrFail($id);
            return response()->json(['language' => $language], 200);
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

    function createLanguage(Request $request)
    {
        try {
            $data = $request->json()->all();
            $dataUser = $data['user'];
            $dataLanguage = $data['language'];
            $professional = Professional::where('user_id', $dataUser['id'])->first();
            if ($professional) {
                $language = Language::where('description', $dataLanguage['description'])
                    ->where('professional_id', $professional['id'])
                    ->first();
                if (!$language) {
                    $response = $professional->languages()->create([
                        'description' => $dataLanguage ['description'],
                        'written_level' => $dataLanguage ['written_level'],
                        'spoken_level' => $dataLanguage ['spoken_level'],
                        'reading_level' => $dataLanguage ['reading_level'],
                    ]);
                    return response()->json($response, 201);
                } else {
                    return response()->json([
                        'errorInfo' => [
                            '0' => '23505',
                            '1' => '7',
                            '2' => 'ERROR:  llave duplicada viola restricción de unicidad «languages_description_unique»',
                        ]], 409);
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

    function updateLanguage(Request $request)
    {
        try {
            $data = $request->json()->all();
            $dataLanguage = $data['language'];
            $language = Language::findOrFail($dataLanguage ['id'])->update([
                'description' => $dataLanguage ['description'],
                'written_level' => $dataLanguage ['written_level'],
                'spoken_level' => $dataLanguage ['spoken_level'],
                'reading_level' => $dataLanguage ['reading_level'],
            ]);
            return response()->json($language, 201);
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

    function deleteLanguage(Request $request)
    {
        try {
            $language = Language::findOrFail($request->id)->delete();
            return response()->json($language, 201);
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
