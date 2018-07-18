@extends('admintempalate.template')

@section('page-style-level')
    <style>
        .dir {
            direction: rtl;
        }
    </style>
@endsection

@section('content')
    <div id="social">

        <div class="panel panel-body panel-head"><h2 style="text-align: center">مواقع التواصل الاجتماعى   </h2></div>


        <div class="row">
            <label> فيسبوك  </label>
            <el-input
                    type="text"
                    :rows="4"
                    placeholder="فيسبوك"
                    v-model="SoicalData.facebook">
            </el-input>
            <br>
            <br>
            <label>تويتر </label>
            <el-input
                    type="text"
                    :rows="4"
                    placeholder="عن التطبيق بالانجليزية"
                    v-model="SoicalData.twitter">
            </el-input>
            <br>
            <br>


            <label for=""> سكايب </label>
            <el-input
                    type="text"
                    :rows="4"
                    placeholder="سكايب"
                    v-model="SoicalData.skype">
            </el-input>
            <br>
            <br>

            <label for="">انستغرام  </label>
            <el-input
                    type="text"
                    :rows="4"
                    placeholder="انستغرام"
                    v-model="SoicalData.instgram">
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
    <script src="{{asset('AdminScript/socialmedia.js')}}"></script>
@endsection