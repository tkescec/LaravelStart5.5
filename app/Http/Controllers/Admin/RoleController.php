<?php

namespace App\Http\Controllers\Admin;

use Sentinel;
use App\Http\Requests;
use Illuminate\Http\Request;
use Cartalyst\Sentinel\Users\IlluminateUserRepository;
use App\Http\Controllers\Controller;
use App\Models\Roles;
use App\Traits\FlashMessage;

class RoleController extends Controller
{
    use FlashMessage;

    /** @var Cartalyst\Sentinel\Users\IlluminateRoleRepository */
    protected $roleRepository;

    public function __construct()
    {
        // Middleware
        $this->middleware('sentinel.auth');
        $this->middleware('sentinel.role:administrator');

        // Fetch the Role Repository from the IoC container
        $this->roleRepository = app()->make('sentinel.roles');
        $this->roleRepository->setModel('App\Models\Roles');
    }

    /**
     * Display a listing of the roles.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = $this->roleRepository->createModel()->all();

        return view('admin.roles.index')
            ->with('roles', $roles);
    }

    /**
     * Show the form for creating a new role.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.roles.create');
    }

    /**
     * Store a newly created role in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the form data
        $result = $this->validate($request, [
            'name' => 'required',
        ]);

        // Create the Role
        $role = Sentinel::getRoleRepository()->createModel()->create([
            'name' => trim($request->get('name')),
        ]);

        // Cast permissions values to boolean
        $permissions = [];
        foreach ($request->get('permissions', []) as $permission => $value) {
            $permissions[$permission] = (bool)$value;
        }

        // Set the role permissions
        $role->permissions = $permissions;
        $role->save();

         // All done
        if ($request->ajax()) {
            return response()->json(['role' => $role], 200);
        }

        FlashMessage::flashing('success', "Role '{$role->name}' has been created.");
        return redirect()->route('roles.index');
    }

    /**
     * Display the specified role.
     *
     * @param  string  $hash
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Sentinel::findRoleById($id);
        $permissions = Roles::getRolePermissions($id);

        return view('admin.roles.show')
            ->with('role', $role)
            ->with('permissions', $permissions);
    }

    /**
     * Show the form for editing the specified role.
     *
     * @param  string  $hash
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Fetch the role object
        // $id = $this->decode($hash);
        $role = $this->roleRepository->findById($id);

        if ($role) {
            return view('admin.roles.edit')
                ->with('role', $role);
        }

        FlashMessage::flashing('error', 'Invalid role.');
        return redirect()->back();
    }

    /**
     * Update the specified role in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $hash
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Decode the role id
        // $id = $this->decode($hash);

        // Validate the form data
        $result = $this->validate($request, [
            'name' => 'required',
        ]);

        // Fetch the role object
        $role = $this->roleRepository->findById($id);
        if (!$role) {
            if ($request->ajax()) {
                return response()->json("Invalid role.", 422);
            }
            FlashMessage::flashing('error', 'Invalid role.');
            return redirect()->back()->withInput();
        }

        // Update the role
        $role->name = $request->get('name');
        $role->slug = $request->get('slug');

        // Cast permissions values to boolean
        $permissions = [];
        foreach ($request->get('permissions', []) as $permission => $value) {
            $permissions[$permission] = (bool)$value;
        }

        // Set the role permissions
        $role->permissions = $permissions;
        $role->save();

        // All done
        if ($request->ajax()) {
            return response()->json(['role' => $role], 200);
        }

        FlashMessage::flashing('success', "Role '{$role->name}' has been updated.");
        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified role from storage.
     *
     * @param  string  $hash
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        // Fetch the role object
        // $id = $this->decode($hash);
        $role = $this->roleRepository->findById($id);

        // Remove the role
        $role->delete();

        // All done
        $message = "Role '{$role->name}' has been removed.";
        if ($request->ajax()) {
            return response()->json([$message], 200);
        }

        FlashMessage::flashing('success', $message);
        return redirect()->route('roles.index');
    }

    /**
     * Decode a hashid
     * @param  string $hash
     * @return integer|null
     */
    // protected function decode($hash)
    // {
    //     $decoded = $this->hashids->decode($hash);

    //     if (!empty($decoded)) {
    //         return $decoded[0];
    //     } else {
    //         return null;
    //     }
    // }
}
