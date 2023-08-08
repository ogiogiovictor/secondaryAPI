<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Authenticate\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\BaseApiController;

class LoginController extends BaseApiController
{
    public function login(LoginRequest $request){

        try {

            $validatedData = $request->validated();

            if(Auth::attempt(['email' => $validatedData['email'], 'password' => $validatedData['password'] ])){
                $authUser = Auth::user();
                $success['Authorization'] = $authUser->createToken('Sanctom+Socialite')->plainTextToken;
                $success['user'] = $authUser;
               
                return $this->sendSuccess($success, "Authorization Successufully Generated", Response::HTTP_CREATED);
            }else {
                return $this->sendError('Invalid Login', "Check your credentials and try again", Response::HTTP_UNAUTHORIZED);
            }

        }catch(\Exception $e){
            return $this->sendError("Error", $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }

     

    }


    public function register(Request $request): Object {

        try {

            $validatedData = $request->validate([
                'name' => 'required',
                'email' => 'required|string|email|unique:users,email',
                'password' => ['required', 'min:8'],
                'c_password' => 'required|same:password',
            ]);

           // $validatedData['password'] = bcrypt($validatedData['password']);
            $user = $this->UserCreate($validatedData);
            $success['Authorization'] = $user->createToken('Sanctom+Socialite')->plainTextToken;
            $success['user'] = $user;

            return $this->sendSuccess($success, "Authorization Successufully Generated", Response::HTTP_CREATED);

        }catch(\Exception $e){
            return $this->sendError("Error", $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }


    }


    private function UserCreate($postData){
        
        //Lets Create the User
       $user = User::create([
           'name' =>  $postData['name'],
           'email' => $postData['email'],
           'password' => bcrypt($postData['password']),
           'status' => 0,
       ]);
       return $user;
   }


}



