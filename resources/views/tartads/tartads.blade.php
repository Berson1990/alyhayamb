@extends('admintempalate.template')

@section('page-style-level')
    <style>
        .dir {
            direction: rtl;
        }

    </style>
@endsection

@section('content')
    <div id="TartAds">
        <div class="row">

            <br>
            <data-tables
                    v-loading="loading"
                    :data="TartAdsData" :show-action-bar="false" :custom-filters="customFilters"
                    :actions-def="actionsDef">
                <el-row slot="custom-tool-bar" style="margin-bottom: 10px ; text-align: center">


                    <el-col :span="5">
                        <el-input v-model="customFilters[0].vals">
                        </el-input>
                    </el-col>

                    <el-col :span="19">
                        <el-button type="success" data-toggle="modal" data-target="#myModal" @click="clearForm()">
                            اضف اضافة جديدة للتارت
                        </el-button>
                    </el-col>

                </el-row>
                <el-table-column label="تعديل">
                    <template slot-scope="scope">
                        <el-button
                                data-toggle="modal"
                                data-target="#myModal"
                                class="el-icon-edit"
                                size="medium"
                                type="warning"
                                @click="handleEdit(scope.$index, scope.row)">تعديل
                        </el-button>
                    </template>
                </el-table-column>
                <el-table-column
                        prop="add_namear"
                        label="اسم الاضافة بالعربية"
                >
                </el-table-column>
                <el-table-column
                        prop="add_nameen"
                        label="اسم الاضافة بالانجليزية "
                >
                </el-table-column>
                <el-table-column
                        prop="add_quantity"
                        label="الكمية "
                >
                </el-table-column>
                <el-table-column
                        prop="add_price"
                        label=" السعر "
                >
                </el-table-column>
                <el-table-column label="صور الاضافة">
                    <template slot-scope="scope">
                        <img :src="'tartImages/' + scope.row.add_image" class="img-responsive">
                    </template>
                </el-table-column>


                <el-table-column label="حذف">
                    <template slot-scope="scope">

                        <el-button
                                class="el-icon-delete"
                                size="medium"
                                type="danger"
                                @click="handleDelete(scope.$index, scope.row)">حذف
                        </el-button>
                    </template>
                </el-table-column>
            </data-tables>
        </div>
        {{--model --}}
        <div class="row" dir="rtl">
            <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">@{{ title }}</h4>
                        </div>
                        <div class="modal-body">
                            <form :model="form">

                                <div class="form-group">
                                    <label for="item_name">اسم الاضافة بالعربية</label>
                                    <input v-model="form.add_namear" type="text" class="form-control"
                                           id="item_name"
                                           placeholder="اسم الاضافة بالعربية" name="email">
                                </div>
                                <div class="form-group">
                                    <label for="item_nameen">اسم الاضافة بالانجليزية</label>

                                    <input v-model="form.add_nameen" type="text" class="form-control"
                                           id="item_nameen"
                                           placeholder="اسم الاضافة الانجليزية " name="pwd">
                                </div>

                                <div class="form-group">
                                    <label for="item_nameen">الكمية</label>

                                    <input v-model="form.add_quantity" type="text" class="form-control"
                                           id="item_nameen"
                                           placeholder="الكمية" name="pwd">
                                </div>
                                <div class="form-group">
                                    <label for="item_nameen">السعر</label>

                                    <input v-model="form.add_price" type="text" class="form-control"
                                           id="item_nameen"
                                           placeholder="السعر" name="pwd">
                                </div>

                                <div class="form-group">
                                    <label for="item_imge">صورة الاضافة </label>
                                    <input type="file" multiple class="form-control" id="adds_image">

                                    <br>
                                    <ul class="nav">
                                        <img id="addsimage" class="img-responsive" src="">
                                    </ul>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success" data-dismiss="modal" @click="Save()">
                                حفظ
                            </button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">اغلاق
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        {{--model end--}}
    </div>

@endsection

@section('page-script-level')
    <script src={{asset("AdminScript/tartadds.js")}}></script>
@endsection