<?php

namespace App\Http\Controllers;

session_start();
use App\Models\student;
use Illuminate\Http\Request;

//
class DataController extends Controller
{
    public function getLast()
    {
        //using DB class (query builder)
        // $d = DB::table("students")
        //     ->select("id")
        //     ->orderBy("id", "DESC")
        //     ->limit(1)
        //     ->get();

        //using student model (using Eloquent ORM)
        $d = student::select("id")
            ->orderBy("id", "DESC")
            ->limit(1)
            ->get();
        if (empty($d[0]->id) || $d[0]->id == null) {
            $new = 1;
        } else {
            $new = $d[0]->id + 1;
        }
        return response()->json(["data" => $new]);
    }

    public function getSingle(string $id)
    {
        $data = student::whereId($id)->get();
        if ($data->count() > 0) {
            return response()->json($data);
        } else {
            $data = [
                ["error" => "Invalid,The Given student ID doesn't exist!!"],
            ];
            return response()->json($data);
        }
    }

    public function insert(Request $request)
    {
        // echo "<script>alert('hello');</script>";

        $request->validate([
            "name" => "required|regex:/^[a-zA-Z\s]+$/",
            "email" => "required|regex:/^[a-z]{3,}[0-9]*[\@]{1}[a-z]{2,}[\.]{1}[a-z]{2,}$/|unique:students,email,except,id",
            "age" => "required|numeric|between:15,30",
        ]);

        if ($request->class1 === "other") {
            $class = $request->class2;
        } else {
            $class = $request->class1;
        }
        $res = student::insert([
            "id" => $request->stdId,
            "std_name" => $request->name,
            "email" => $request->email,
            "std_class" => $class,
            "age" => $request->age,
        ]);

        $_SESSION['success'] = "Added Successfully..!";

        return redirect()->route('home');
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            "name" => "required|regex:/^[a-zA-Z\s]+$/",
            "email" => "required|regex:/^[a-z]{3,}[0-9]*[\@]{1}[a-z]{2,}[\.]{1}[a-z]{2,}$/|unique:students,email,except,id",
            "age" => "required|numeric|between:15,30",
        ]);
        if ($request->class1 === "other") {
            $class = $request->class2;
        } else {
            $class = $request->class1;
        }

        $res = student::where("id", $id)->update([
            "std_name" => $request->name,
            "email" => $request->email,
            "std_class" => $class,
            "age" => $request->age,
        ]);

        if ($res) {
            $_SESSION['update'] = "Record Updated Successfully..!";
        } else {
            $_SESSION['update'] = "Record Cannot Updated..!";
        }

        return redirect()->route('home');
    }

    public function delete(string $id)
    {
        $res = student::where("id", $id)->delete();
        if ($res) {
            $_SESSION['delete'] = "Record Deleted Successfully..!";
        } else {
            $_SESSION['delete'] = "Record Cannot Deleted..!";
        }
        return redirect()->route('home');
    }
}
