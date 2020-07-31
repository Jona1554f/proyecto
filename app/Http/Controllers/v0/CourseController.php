<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Professional;
use App\Course;

class CourseController extends Controller
{
    function getCourses(Request $request)
    {
        try {
            $professional = Professional::where('id', $request->user_id)->first();
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

    function showCourse($id)
    {
        try {
            $course = Course::findOrFail($id);
            return response()->json(['course' => $course], 200);
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

    function createCourse(Request $request)
    {
        try {
            $data = $request->json()->all();
            $dataUser = $data['user'];
            $dataCourse = $data['course'];
            $professional = Professional::where('user_id', $dataUser['id'])->first();
            if ($professional) {
                $response = $professional->courses()->create([
                    'event_type' => $dataCourse ['event_type'],
                    'institution' => strtoupper($dataCourse ['institution']),
                    'event_name' => strtoupper($dataCourse ['event_name']),
                    'start_date' => $dataCourse ['start_date'],
                    'finish_date' => $dataCourse ['finish_date'],
                    'hours' => $dataCourse ['hours'],
                    'type_certification' => $dataCourse ['type_certification'],
                ]);
                return response()->json($response, 201);
            } else {
                return response()->json(null, 404);
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

    function updateCourse(Request $request)
    {
        try {
            $data = $request->json()->all();
            $dataCourse = $data['course'];
            $course = Course::findOrFail($dataCourse ['id'])->update([
                'event_type' => $dataCourse ['event_type'],
                'institution' => $dataCourse ['institution'],
                'event_name' => $dataCourse ['event_name'],
                'start_date' => $dataCourse ['start_date'],
                'finish_date' => $dataCourse ['finish_date'],
                'hours' => $dataCourse ['hours'],
                'type_certification' => $dataCourse ['type_certification'],
            ]);
            return response()->json($course, 201);
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

    function deleteCourse(Request $request)
    {
        try {
            $course = Course::findOrFail($request->id)->delete();
            return response()->json($course, 201);
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
