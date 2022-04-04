<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Admin\UserRequest;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index()
    {
        if(request()->ajax())
        {
            // $query = DB::table('users');
            $query = User::query();
            // dd($query);
            return DataTables::of($query)
            ->addColumn('action', function($item){
                return '
                <div class="btn-group">
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle mr-1 mb-1" type="button"
                        data-toggle="dropdown">
                            Aksi
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="'.route('users.edit', $item->id).'">
                                Sunting
                            </a>
                            <form action="'.route('users.destroy', $item->id).'" method="POST">
                               '.csrf_field() .method_field('delete').'
                               <button type="submit" class="dropdown-item text-danger">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
                ';
            })
            ->rawColumns(['action'])
            ->make();

        }
        return view('pages.admin.user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $data = $request->validated();
        $data['password'] = bcrypt($request->password);
        User::create($data);

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // dd($id);
        // dd(User::findOrFail($id));
        $user = User::findOrFail($id);
        // dd($user);
        return view('pages.admin.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $data = $request->validated();

        $user = User::findOrFail($id);

        if($request->password){
            $data['password'] = bcrypt($request->password);
        }
        else{
            unset($data['password']);
        }
        // $data['slug'] = Str::slug($data['name'], '-');
        // $data['photo'] = $request->file('photo')->store('assets/user', 'public');

        $user->update([
            'name' => $data['name'],
            'roles' => $data['roles']
        ]);

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        // Storage::disk('local')->delete('public/assets/user/'.$user->photo);
        $user->delete();

        return redirect()->route('users.index');
    }
}
