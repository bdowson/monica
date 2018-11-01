<?php

namespace App\Http\Controllers\Settings;

use App\Exceptions\InvalidDataException;
use App\Models\Account\Account;
use App\Models\User\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminController
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('settings.admin.index');
    }

    /**
     * Get the primary users of all accounts
     *
     * @return JsonResponse
     */
    public function getAccountFirstUsers(): JsonResponse {
        // Gets first users created in each account

        return response()->json($this->getPrimaryUsers());
    }

    private function getPrimaryUsers() {
        return User::orderBy('created_at', 'asc')->groupBy('account_id')->with('Account')->get();
    }

    /**
     * Gets the account ID of the current logged in user
     *
     * @return JsonResponse
     */
    public function getAccountId(): JsonResponse {
        return response()->json(Auth::user()->account_id);
    }

    /**
     * Creates a new account and primary user for the account
     *
     * @throws InvalidDataException If the data is invalid
     * @throws \Throwable If there is an unexpected server error
     * @return JsonResponse
     */
    public function createNewAccount(Request $request): JsonResponse {
        try {
            DB::beginTransaction();
            $valid = Validator::make($request->all(), [
                'first_name' => 'required|max:255',
                'last_name' => 'required|max:255',
                'email' => 'required|email|max:255|unique:users',
                'password' => 'required|min:6',
                'has_access_to_paid_version_for_free' => 'sometimes|required|boolean',
            ]);

            if(!empty($valid->errors()->messages())) {
                throw new InvalidDataException($valid->errors()->first());
            }
            $valid->validate();

            Account::createDefault(
                $request->input('first_name'),
                $request->input('last_name'),
                $request->input('email'),
                $request->input('password')
            );
            DB::commit();
        } catch (InvalidDataException $e) {
            DB::rollback();
            return response()->json(['message' => $e->getMessage()], 422);
        } catch (\Throwable $e) {
            DB::rollback();
            return response()->json(['message' => 'Unknown server error'], 500);
        }
        return response()->json($this->getPrimaryUsers());
    }
}