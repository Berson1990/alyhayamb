@extends('admintempalate.template')

@section('page-style-level')
    <style>
        .dir {
            direction: rtl;
        }

    </style>
@endsection

@section('content')
    <div id="TartOptions">
        <div class="row">

            <br>
            <data-tables :data="tartOptionsData" :show-action-bar="false" :custom-filters="customFilters"
                         :actions-def="actionsDef">
                <el-row slot="custom-tool-bar" style="margin-bottom: 10px ; text-align: center">


                    <el-col :span="5">
                        <el-input v-model="customFilters[0].vals">
                        </el-input>
                    </el-col>

                    <el-col :span="19">
                        <el-button type="success" data-toggle="modal" data-target="#myModal" @click="clearForm()">
                            سجل ادوار / قياسات للتارت
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
                        label="المنتج"
                >
                </el-table-column>

                <el-table-column
                        prop="floorsar"
                        label="الادوار"
                >
                </el-table-column>

                <el-table-column
                        prop="size_name"
                        label="المقاسات"
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
                                    <label for="item_id"> المنتج :</label>
                                    <el-select v-model="form.item_id" filterable placeholder="اختار منتج"
                                               id="item_id">
                                        <el-option
                                                v-for="items in Items"
                                                :key="items.item_id"
                                                :label="items.item_name"
                                                :value="items.item_id">
                                        </el-option>
                                    </el-select>
                                </div>
                                <div class="form-group">
                                    <label for="floors_id"> الادوار :</label>
                                    <el-select v-model="form.floors_id" filterable placeholder="اختار دور"
                                               id="floors_id">
                                        <el-option
                                                v-for="floor in Floors"
                                                :key="floor.floors_id"
                                                :label="floor.floorsar"
                                                :value="floor.floors_id">
                                        </el-option>
                                    </el-select>
                                </div>
                                <div class="form-group">
                                    <label for="sizes_id"> المقاسات :</label>
                                    <el-select v-model="form.size_id" filterable placeholder="اختار مقاس"
                                               id="sizes_id">
                                        <el-option
                                                v-for="size in Size"
                                                :key="size.size_id"
                                                :label="size.size_name"
                                                :value="size.size_id">
                                        </el-option>
                                    </el-select>
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
    <script src={{asset("AdminScript/tartoptions.js")}}></script>
@endsection