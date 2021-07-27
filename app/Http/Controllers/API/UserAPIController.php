<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\User;
use App\Models\Account;
use Faker\Factory as Faker;


use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

use Intervention\Image\Facades\Image as AlterImage;



class UserAPIController extends AppBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->get('per_page')) {
            $per_page = $request->get('per_page');
        }else{
            $per_page = 20;
        }
        
        if ($request->get('sort')) {
            $sort = $request->get('sort');
        }else{
            $sort = "desc";
        }

        if ($request->get('filter')) {
            $filter = $request->get('filter');
        }else{
            $filter = "";
        }
        if ($request->get('with')) {
            $with = $request->get('with');
        }else{
            $with = "";
        }

        $users = $query
            ->with('account', 'properties_owner')
            ->filter($filter)

            ->paginate($per_page);

        return $this->sendResponse($users->toArray(), 'Accounts retrieved successfully');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input_user = $request->only(['name','last_name','email','slug']);
        $input_account = $request->except(['name','last_name','email','slug','password', 'image']);
        // $input_user['slug'] = Str::slug($request->name."-".$request->last_name);
        // if($request->role_id) $input_account['role_id'] = (int)$request->role_id;

        $faker = Faker::create();

        $user = new User;
        $user->fill($input_user);
        if(!$request->password) $user->password = bcrypt($faker->password);
        $user->save();

        if($user){
            $account = new Account;
            $account->fill($input_account);
            $account->user_id = $user->id;
            $account->save();
        

            if($request->hasFile('image')){
                $image = $request->file('image');
                $this->validate($request, [

                    'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048000'
        
                ]);

                $url = 'images/users/';
                $imageNewName = $user->id.'-'.time().'.jpg';

                $path_larg = $url.'larg/'.$imageNewName;
                $thumbnail = $url.'thumbnail/'.$imageNewName;
                $larg_img = $this->transformImage($image, 400, 400, $path_larg);
                // $thumbnail_img = $this->transformImage($image, 100, 100, $thumbnail);

                // return [$larg_img , $medium_img , $small_img] ;
                if ($larg_img) {
                    
                    $account->fill(
                        [
                            'image' => asset('storage/'.$path_larg),
                            // 'thumbnail' => asset('storage/'.$thumbnail),
                        ])->save();
                }else{
                    return "error al subir imagenes";
                }
            }
        }

        return $this->sendResponse($user->toArray(), 'Account updated successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::with('account')->find($id);

        if (empty($user)) {
            return $this->sendError('User not found');
        }

        return $this->sendResponse($user->toArray(), 'User retrieved successfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $input_user = $request->only(['name','last_name','slug','email']);
        $input_account = $request->except(['name','last_name','slug','email', 'image']);
        // if($request->role_id) $input_account['role_id'] = (int)$request->role_id;
        // return $input_account;

        $user = User::find($id);

        if (empty($user)) {
            return $this->sendError('Account not found');
        }

        $user->fill($input_user);
        $user->save();

        if($user->account){
            $user->account->fill($input_account)->save();
        }else{
            $account = new Account;
            $account->fill($input_account);
            $account->user()->associate($user);
            $account->save();
        }



        if($request->hasFile('image')){
            $image = $request->file('image');
            $this->validate($request, [

                'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048000'
    
            ]);

            $url = 'images/users/';
            $imageNewName = $user->id.'-'.time().'.jpg';

            $path_larg = $url.'larg/'.$imageNewName;
            // $thumbnail = $url.'thumbnail/'.$imageNewName;
            $larg_img = $this->transformImage($image, 400, 400, $path_larg);
            // $thumbnail_img = $this->transformImage($image, 100, 100, $thumbnail);

            // return [$larg_img , $medium_img , $small_img] ;
            if ($larg_img) {
                
                $user->account->fill(
                    [
                        'image' => asset('storage/'.$path_larg),
                        // 'thumbnail' => asset('storage/'.$thumbnail),
                    ])->save();
            }else{
                return "error al subir imagenes";
            }
        }

        return $this->sendResponse($user->toArray(), 'Account updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /** @var User $user */
        $account = User::find($id);

        if (empty($account)) {
            return $this->sendError('User not found');
        }

        $account->delete();

        return $this->sendSuccess('User deleted successfully');    
    }

    private function transformImage($image, $width, $height, $path)
    {
        $result_image = AlterImage::make($image)->encode('jpg',75);
        $result_image->resize($width, $height, function ($constraint){
            $constraint->aspectRatio();
            $constraint->upsize();
        } );
        // $larg_image->crop(1280,800);
        $store = Storage::disk('public')->put( $path, $result_image->stream());
        return $store;
        
    }

    public function properties_user($id)
    {
        $user = User::find($id)->properties_owner()->get();
        

        return $this->sendResponse($user->toArray(), 'Properties retrieved successfully');

    }

    public function owner_users(Request $request)
    {
        $query = User::query();

        
        if ($request->get('per_page')) {
            $per_page = $request->get('per_page');
        }else{
            $per_page = 20;
        }
        
        if ($request->get('sort')) {
            $sort = $request->get('sort');
        }else{
            $sort = "desc";
        }

        if ($request->get('filter')) {
            $filter = $request->get('filter');
        }else{
            $filter = "";
        }


        $users = $query->with('account','properties_owner')
            ->filter($filter)
            ->has('properties_owner')
            ->paginate($per_page);
            
        
        return $this->sendResponse($users->toArray(), 'Account retrieved successfully');

    }


    public function customer_users(Request $request)
    {
        $query = User::query();

        
        if ($request->get('per_page')) {
            $per_page = $request->get('per_page');
        }else{
            $per_page = 20;
        }
        
        if ($request->get('sort')) {
            $sort = $request->get('sort');
        }else{
            $sort = "desc";
        }

        if ($request->get('filter')) {
            $filter = $request->get('filter');
        }else{
            $filter = "";
        }


        $query->filter(function ($value, $key){
            return $value['transactions_customer']->count() >=1 ;
        });
        $query->with('account')
            ->filter($filter)
            ->paginate($per_page);

        return $this->sendResponse($query->toArray(), 'Account retrieved successfully');

    }


}
