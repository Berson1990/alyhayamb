@extends('admintempalate.template')

@section('page-style-level')
    <style>
        .dir {
            direction: rtl;
        }

    </style>
@endsection

@section('content')
    <div id="ads">
        <div class="row">

            <br>
            <data-tables :data="adsData" :show-action-bar="false" :custom-filters="customFilters"
                         :actions-def="actionsDef">
                <el-row slot="custom-tool-bar" style="margin-bottom: 10px ; text-align: center">


                    <el-col :span="5">
                        <el-input v-model="customFilters[0].vals">
                        </el-input>
                    </el-col>

                    <el-col :span="19">
                        <el-button type="success" data-toggle="modal" data-target="#myModal" @click="clearForm()">
                            اضف اعلان
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
                        prop="item_name"
                        label="اسم المنتج بالعربية"
                >
                </el-table-column>

                <el-table-column
                        label="مكان الاعلان"
                >
                    <template slot-scope="scope">
                        <h3 v-if="scope.row.state === '1'">السلايدر</h3>
                        <h3 v-if="scope.row.state === '2'">العروض </h3>
                    </template>
                </el-table-column>
                <el-table-column
                        prop="offer"
                        label="العرض"
                >
                </el-table-column>
                <el-table-column
                        prop="offeren"
                        label="العروض بالانجليزية"
                >
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
                                    <label for="category_id"> المنتج المراد عرضه فى الاعلان :</label>
                                    <el-select v-model="form.item_id" filterable placeholder="اختار قسم"
                                               id="item_id">
                                        <el-option
                                                v-for="item in Item"
                                                :key="item.item_id"
                                                :label="item.item_name"
                                                :value="item.item_id">
                                        </el-option>
                                    </el-select>
                                </div>
                                <div class="form-group">
                                    <template>
                                        <el-radio v-model="form.state" label="1"> السلايدر</el-radio>
                                        <el-radio v-model="form.state" label="2"> العروض </el-radio>
                                    </template>
                                </div>
                                <div class="form-group">
                                    <label for="category_id"> العرض بالعربية</label>

                                    <textarea class="form-control" v-model="form.offer" placeholder="العرض"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="category_id"> العرض بالانجلزية:</label>

                                    <textarea class="form-control" v-model="form.offeren" placeholder="العرض بالانجليزية"></textarea>
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
    <script src={{asset("AdminScript/ads.js")}}></script>
@endsection