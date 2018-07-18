@extends('admintempalate.template')

@section('page-style-level')
    <style>
        .dir {
            direction: rtl;
        }

    </style>
@endsection

@section('content')
    <div id="tartsize">
        <div class="row">

            <br>
            <data-tables :data="TartSizeData" :show-action-bar="false" :custom-filters="customFilters"
                         :actions-def="actionsDef">
                <el-row slot="custom-tool-bar" style="margin-bottom: 10px ; text-align: center">


                    <el-col :span="5">
                        <el-input v-model="customFilters[0].vals">
                        </el-input>
                    </el-col>

                    <el-col :span="19">
                        <el-button type="success" data-toggle="modal" data-target="#myModal" @click="clearForm()">
                            اضف  الوان جديدة  للتارت
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
                        prop="size_name"
                        label="اسم الحجم"
                >
                </el-table-column>
                <el-table-column
                        prop="size_no"
                        label="الحجم"
                >

                </el-table-column>
                <el-table-column
                        prop="size_price"
                        label="سعر الحجم"
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
                                    <label for="item_name">اسم الحجم  </label>
                                    <input v-model="form.size_name" type="text" class="form-control"
                                           id="item_name"
                                           placeholder="اسم  الحجم" name="email">
                                </div>
                                <div class="form-group">
                                    <label for="item_nameen">الحجم   </label>

                                    <input v-model="form.size_no" type="text" class="form-control"
                                           id="item_nameen"
                                           placeholder="الحجم    " name="pwd">
                                </div>
                                <div class="form-group">
                                    <label for="item_nameen">سعر الحجم   </label>

                                    <input v-model="form.size_price" type="text" class="form-control"
                                           id="item_nameen"
                                           placeholder="سعر الحجم    " name="pwd">
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
    <script src={{asset("AdminScript/tart_size.js")}}></script>
@endsection