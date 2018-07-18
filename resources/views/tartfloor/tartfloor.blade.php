@extends('admintempalate.template')

@section('page-style-level')
    <style>
        .dir {
            direction: rtl;
        }

    </style>
@endsection

@section('content')
    <div id="tartFloor">
        <div class="row">

            <br>
            <data-tables :data="tartFloorData" :show-action-bar="false" :custom-filters="customFilters"
                         :actions-def="actionsDef">
                <el-row slot="custom-tool-bar" style="margin-bottom: 10px ; text-align: center">


                    <el-col :span="5">
                        <el-input v-model="customFilters[0].vals">
                        </el-input>
                    </el-col>

                    <el-col :span="19">
                        <el-button type="success" data-toggle="modal" data-target="#myModal" @click="clearForm()">
                            اضف ادوار التارت
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
                        prop="floorsar"
                        label="اسم الدور بالعربية"
                >
                </el-table-column>

                <el-table-column
                        prop="flooren"
                        label="اسم الدور بالانجليزي "
                >
                </el-table-column>
                <el-table-column
                        prop="price"
                        label="السعر"
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
                                    <label for="item_name">اسم الدور </label>
                                    <input v-model="form.floorsar" type="text" class="form-control" id="item_name"
                                           placeholder="اسم الدور" name="email">
                                </div>
                                <div class="form-group">
                                    <label for="item_nameen">اسم الدور بالانجليزية</label>

                                    <input v-model="form.flooren" type="text" class="form-control" id="item_nameen"
                                           placeholder="اسم الدور بالانجليزية" name="pwd">
                                </div>
                                <div class="form-group">
                                    <label for="item_nameen">السعر </label>

                                    <input v-model="form.price" type="text" class="form-control" id="item_nameen"
                                           placeholder="السعر  " name="pwd">
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
    <script src={{asset("AdminScript/tartfloor.js")}}></script>
@endsection