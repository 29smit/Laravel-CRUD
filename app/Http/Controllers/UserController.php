<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\User;
use Illuminate\Validation\ValidationException;


class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
         
          $query = User::query();

        
        if ($request->name && !empty($request->name)) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }
        if ($request->email && !empty($request->email)) {
            $query->where('email', 'like', '%' . $request->input('email') . '%');
        }
        if ($request->gender && $request->gender != "undefined") {
            $query->where('gender', $request->input('gender'));
        }
        if ($request->phone && !empty($request->phone)) {
            $query->where('phone', 'like', '%' . $request->input('phone') . '%');
        }

        $data = $query->latest()->get();

   
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('image', function($row) {
                    $btn = '<img src="storage/'.$row->image.'">';
                   
                    return $btn;
                })
                ->addColumn('action', function($row) {
                    $btn = '<a href="javascript:void(0)" onclick="editUser('.$row->id.')"class="edit btn btn-primary btn-sm">Edit</a>';
                    $btn .= ' <a href="javascript:void(0)"onclick="DeleteUser('.$row->id.')" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action','image'])
                ->make(true);
        }

        return view('users');
    }


   
    public function store(Request $request)
    {
        try {
            // Validate the request
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email|max:255',
                'profile_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                'gender' => 'required|in:male,female,other',
                'phone' => 'required|string|max:15', 
                'file' => 'required|file|max:2048',
            ]);
    
            // Store profile image in storage
            if ($request->hasFile('profile_image')) {
                $imagePath = $request->file('profile_image')->store('profile_images', 'public');
                $validatedData['image'] = $imagePath;
            }
    
            // Store other file in storage
            if ($request->hasFile('file')) {
                $filePath = $request->file('file')->store('files', 'public');
                $validatedData['file'] = $filePath;
            }
    
            // Create the user
            User::create($validatedData);
    
            // Return success response
            return response()->json(['success' => 'User added successfully.']);
        } catch (ValidationException $e) {
           
            return response()->json(['errors' => $e->errors()], 200);
        } catch (\Exception $e) {
          
            return response()->json(['error' => 'An error occurred while adding the user.'], 500);
        }
    }


    public function edit($id)
{
    // try {
       
        $user = User::findOrFail($id);

       
        return response()->json($user);
    // } catch (\Exception $e) {
       
    //     return response()->json(['error' => 'Failed to fetch user details.'], 500);
    // }
}


public function update(Request $request, $id)
{
    try {
        $user = User::findOrFail($id);

       
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
           
            'gender' => 'required|in:male,female,other',
            'phone' => 'required|string|max:15', 
          
        ]);

        // Update profile image in storage if a new image is provided
        if ($request->hasFile('profile_image')) {
            $imagePath = $request->file('profile_image')->store('profile_images', 'public');
            $validatedData['image'] = $imagePath;
        }

        // Update other file in storage if a new file is provided
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('files', 'public');
            $validatedData['file'] = $filePath;
        }

        // Update user details
        $user->update($validatedData);

        // Return success response
        return response()->json(['success' => 'User updated successfully.']);
    } catch (ValidationException $e) {
        // Handle validation errors
        return response()->json(['errors' => $e->errors()], 200);
    } catch (\Exception $e) {
        // Handle other exceptions
        return response()->json(['error' => 'An error occurred while updating the user.'], 500);
    }
}


    public function destroy($id)
    {
        try {
            // Find the user by ID
            $user = User::findOrFail($id);

            // Delete the user
            $user->delete();

            // Return success response
            return response()->json(['success' => 'User deleted successfully.']);
        } catch (\Exception $e) {
            // Handle exceptions
            return response()->json(['error' => 'Failed to delete user.'], 500);
        }
    }
    
}
