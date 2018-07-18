@extends('admintempalate.template')

@section('page-style-level')
    <style>
        .dir {
            direction: rtl;
        }
    </style>
@endsection

@section('content')
    <div id="about">

        <div class="panel panel-body panel-head"><h2 style="text-align: center">عن التطبيق والشروط والاحكام</h2></div>


        <div class="row">
            <label> عن التطبيق </label>
            <el-input
                    type="textarea"
                    :rows="4"
                    placeholder="عن التطبيق  "
                    v-model="aboutPolicy.about_ar">
            </el-input>
            <br>
            <br>
            <label> عن التطبيق بالانجليزية </label>
            <el-input
                    type="textarea"
                    :rows="4"
                    placeholder="عن التطبيق بالانجليزية"
                    v-model="aboutPolicy.about_en">
            </el-input>
            <br>
            <br>


            <label for="">الشروط والاحكام </label>
            <el-input
                    type="textarea"
                    :rows="4"
                    placeholder="الشروط والاحكام "
                    v-model="aboutPolicy.policy_ar">
            </el-input>
            <br>
            <br>

            <label for="">الشروط والاحكام بالانجليزية</label>
            <el-input
                    type="textarea"
                    :rows="4"
                    placeholder="الشروط والاحكام بالانجليزية"
                    v-model="aboutPolicy.policy_en">
            </el-input>


        </div>
        <br>
        <div class="row">
            <div class="col-md-6 col-md-push-4">
                <button class="btn btn-success col-md-6" @click="updateAbout()"> @{{ save }}</button>
            </div>
        </div>
        <br>
    </div>

@endsection

@section('page-script-level')
    <script src="{{asset('AdminScript/about_policy.js')}}"></script>
@endsection