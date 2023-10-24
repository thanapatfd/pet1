<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pet;
use App\Models\Type;
use Config, Validator;


class PetController extends Controller
{
    var $rp = 15;

    public function index() {
        // $pets = Pet::all();
        $pets = Pet::paginate($this->rp);
        return view('pet/index', compact('pets'));
    }
    public function insert(Request $request){

        $rules = array(
            'name' => 'required',
            'type_id' => 'required|numeric',
        );
        $messages = array(
            'required' => 'กรุณากรอกข้อมูล :attribute ให้ครบถ้วน', 
            'numeric' => 'กรุณากรอกข้อมูล:attribute ให้เป็นตัวเลข'
        );

        $id = $request->id;
        $temp = array(
            'name' => $request->name,
            'type_id' => $request->type_id, 
        );
        
        $validator = Validator::make($temp, $rules, $messages);
        if ($validator->fails()) {
            return redirect('pet/edit/'.$id)
            ->withErrors($validator)
            ->withInput();
        }

        $pet = new Pet();
        $pet->name = $request->name;
        $pet->type_id = $request->type_id;

        $pet->save();

        if($request->hasFile('image')) //ไว้เขียนทีหลัง ความสําคัญน้อยกว่า วิธีเอาค่าจากฟอร์ม มาบันทึก
        {
            $f = $request->file('image');
            $upload_to = 'upload/images'; //แปลว่า คุณต้องไปสร้างโฟลเดอร์ชื่อนี้ไว้ในโปรเจคคุณด้วยนะ

            // get path
            $relative_path = $upload_to.'/'.$f->getClientOriginalName();
            $absolute_path = public_path().'/'.$upload_to;
            // upload file
            $f->move($absolute_path, $f->getClientOriginalName());

            // save image path to database
            $pet->image_url = $relative_path;
            $pet->save(); //< บันทึกลงฐานข้อมูล อย่าเพิ่งพิมพ์จนกว่าจะไม่มี error นะครับ
        }

        return redirect('pet')->with('ok',true)
        ->with('msg', ' บันทึกข้อมูลเรียบร้อยเเล้ว ');
    }

    public function search(Request $request){
        $query = $request->q;
        if($query) {
            $pets =  Pet::where('name', 'like', '%'.$query.'%')
            ->paginate($this->rp);
        }else {
            $pets =  pet::paginate($this->rp);
        }
        return view('pet/index', compact('pets'));
    }


    public function edit($id = null){
        $types = type::pluck('name', 'id')->prepend('เลือกรายการ', '');
        if($id) {
            // edit view
            $pet = Pet::where('id', $id)->first(); return view('pet/edit')
            ->with('pet', $pet)
            ->with('types', $types);
            } else {
            // add view
            return view('pet/add')->with('types', $types);
       }
    }

    public function update(Request $request) {

        $rules = array(
            'name' => 'required',
            'type_id' => 'required|numeric',
        );
        $messages = array(
            'required' => 'กรุณากรอกข้อมูล :attribute ให้ครบถ้วน', 
            'numeric' => 'กรุณากรอกข้อมูล:attribute ให้เป็นตัวเลข'
        );

        $id = $request->id;
        $temp = array(
            'name' => $request->name,
            'type_id' => $request->type_id, 
        );
        
        $validator = Validator::make($temp, $rules, $messages);
        if ($validator->fails()) {
            return redirect('pet/edit/'.$id)
            ->withErrors($validator)
            ->withInput();
        }
        
        $pet = pet::find($id);
        $pet->name = $request->name;
        $pet->type_id = $request->type_id;

        $pet->save();
        
        if($request->hasFile('image')){
            $f = $request->file('image');
            $upload_to = 'upload/images'; //แปลว่า คุณต้องไปสร้างโฟลเดอร์ชื่อนี้ไว้ในโปรเจคคุณด้วยนะ

            // get path
            $relative_path = $upload_to.'/'.$f->getClientOriginalName();
            $absolute_path = public_path().'/'.$upload_to;
            // upload file
            $f->move($absolute_path, $f->getClientOriginalName());

            // save image path to database
            $pet->image_url = $relative_path;
            $pet->save(); //< บันทึกลงฐานข้อมูล อย่าเพิ่งพิมพ์จนกว่าจะไม่มี error นะครับ
        }

        return redirect('pet')->with('ok',true)
        ->with('msg', ' บันทึกข้อมูลเรียบร้อยเเล้ว ');
    }

    public function remove($id){
        Pet::find($id)->delete();
        return redirect('pet')
        ->with('ok', true)
        ->with('msg', 'ลบข้อมูลสําเร็จ');
    }
}
