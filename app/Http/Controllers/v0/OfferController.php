<?php

namespace App\Http\Controllers;

use App\Company;
use App\Offer;
use App\Professional;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class OfferController extends Controller
{

    function getAllOffers()
    {
        $now = Carbon::now();
        $offers = Offer::where('state', 'ACTIVE')
            ->where('finish_date', '>=', $now->format('Y-m-d'))
            ->where('start_date', '<=', $now->format('Y-m-d'))
            ->get();
        return response()->json(['offers' => $offers], 200);

    }

    function getOffers(Request $request)
    {
        $now = Carbon::now();
        $offers = Offer::where('state', 'ACTIVE')
            ->where('finish_date', '>=', $now->format('Y-m-d'))
            ->where('start_date', '<=', $now->format('Y-m-d'))
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

    function filterOffers2(Request $request)
    {
        $data = $request->json()->all();
        $dataFilter = $data['filter'];
        $offers = Offer::where('code', '=', $dataFilter['code'])
            ->orWhere('broad_field', 'like', $dataFilter['broad_field'] . '%')
            ->orWhere('specific_field', 'like', $dataFilter['specific_field'] . '%')
            ->orWhere('position', 'like', $dataFilter['position'] . '%')
            ->orWhere('province', 'like', $dataFilter['province'] . '%')
            ->orWhere('city', 'like', $dataFilter['city'] . '%')
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

    function filterOffers(Request $request)
    {
        $now = Carbon::now();
        $data = $request->json()->all();
        $dataFilter = $data['filters'];
        $offers = Offer::orWhere($dataFilter['conditions'])
            ->where('state', 'ACTIVE')
            ->where('finish_date', '>=', $now->format('Y-m-d'))
            ->where('start_date', '<=', $now->format('Y-m-d'))
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

    function filterOffersFields(Request $request)
    {
        $now = Carbon::now();
        $offers = Offer::where('state', 'ACTIVE')
            ->where('code', 'like', strtoupper($request->filter) . '%')
            ->OrWhere('position', 'like', '%' . strtoupper($request->filter) . '%')
            ->OrWhere('activities', 'like', strtoupper($request->filter) . '%')
            ->where('finish_date', '>=', $now->format('Y-m-d'))
            ->where('start_date', '<=', $now->format('Y-m-d'))
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

    function createOffer(Request $request)
    {
        $data = $request->json()->all();
        $company = Company::findOrFail($request->company_id);
        $response = $company->offers()->create([
            'code' => $data['code']
        ]);
        return response()->json($response, 201);

    }

    function updateOffer(Request $request)
    {

        $data = $request->json()->all();
        $offer = Offer::find($request->id)->update([
            'code' => $data['code']
        ]);
        return response()->json($offer, 201);

    }

    function deleteOffer(Request $request)
    {
        try {
            DB::beginTransaction();
            $offer = Offer::findOrFail($request->id);
            $offer->delete();
            $offer->professionals()->detach();
            DB::commit();
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

    function finishOffer(Request $request)
    {
        try {
            $offer = Offer::findOrFail($request->id)->update([
                'state' => 'FINISHED',
            ]);
            return response()->json($offer, 201);
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

    function getAppliedProfessionals(Request $request)
    {
        try {
            $offer = Offer::findOrFail($request->offer_id);
            $professionals = $offer->professionals()
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
                ], 'professionals' => $professionals], 200);
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

    function validateAppliedOffer(Request $request)
    {
        try {
            $professional = Professional::where('user_id', $request->user_id)->first();
            if ($professional) {
                $appliedOffer = DB::table('offer_professional')
                    ->where('offer_id', $request->offer_id)
                    ->where('professional_id', $professional->id)
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

    function applyOffer(Request $request)
    {
        try {
            $data = $request->json()->all();
            $user = $data['user'];
            $offer = $data['offer'];
            $professional = Professional::where('user_id', $user['id'])->first();
            if ($professional) {
                $appliedOffer = DB::table('offer_professional')
                    ->where('offer_id', $offer['id'])
                    ->where('professional_id', $professional->id)
                    ->where('state', 'ACTIVE')
                    ->first();
                if (!$appliedOffer) {
                    $professional->offers()->attach($offer['id']);
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
}
