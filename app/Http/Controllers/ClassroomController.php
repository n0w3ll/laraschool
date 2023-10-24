<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use Illuminate\Http\Request;
use Auth;

class ClassroomController extends Controller
{
    public function list()
    {
        $data['getRecord'] = Classroom::getRecord();
        $data['header_title'] = "Class List";
        return view('admin.class.list', $data);
    }

    public function add()
    {
        $data['header_title'] = "Add New Class";
        return view('admin.class.add', $data);
    }

    public function insert(Request $request)
    {
        $classroom = new Classroom;
        $classroom->name = $request->name;
        $classroom->status = $request->status;
        $classroom->created_by = Auth::user()->id;
        $classroom->save();

        return redirect('admin/class/list')->with('success','Classroom created successfully');
    }

    public function edit($id)
    {
        $data['getRecord'] = Classroom::getSingle($id);
        if(!empty($data['getRecord']))
        {
            $data['header_title'] = 'Edit Class';
            return view('admin.class.edit', $data);
        }
        else {
            abort(404);
        }

    }

    public function update(Request $request, $id)
    {
        request()->validate([
            'name'=> 'required|unique:classrooms,name,'.$id
        ]);

        $classroom = Classroom::getSingle($id);
        $classroom->name = trim($request->name);
        $classroom->status = $request->status;
        $classroom->save();

        return redirect('admin/class/list')->with('success','Classroom successfully updated');
    }

    public function delete($id)
    {
        $classroom = Classroom::getSingle($id);
        $classroom->delete();

        return redirect('admin/class/list')->with('success','Classroom successfully deleted');
    }
    public function softdelete($id)
    {
        $classroom = Classroom::getSingle($id);
        $classroom->is_deleted = 1;
        $classroom->save();

        return redirect('admin/class/list')->with('success','Classroom successfully deleted');
    }
}
