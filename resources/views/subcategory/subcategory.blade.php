@extends('admintempalate.template')

@section('page-style-level')
    <style>
        .dir {
            direction: rtl;
        }

    </style>
@endsection

@section('content')
    <div id="subCategory">
        <div class="row">

            <br>
            <data-tables :data="subCategory" :show-action-bar="false" :custom-filters="customFilters"
                         :actions-def="actionsDef">
                <el-row slot="custom-tool-bar" style="margin-bottom: 10px ; text-align: center">


                    <el-col :span="5">
                        <el-input v-model="customFilters[0].vals">
                        </el-input>
                    </el-col>

                    <el-col :span="19">
                        <el-button type="success" data-toggle="modal" data-target="#myModal" @click="clearForm()">
                            اضف قسم فرعي جديد
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
                        prop="subcategroy_namear"
                        label="اسم القسم الفرعى بالعربية"
                >
                </el-table-column>

                <el-table-column
                        prop="subcategory_nameen"
                        label="اسم القسم الفرعي بالانجليزية "
                >
                </el-table-column>

                <el-table-column
                        prop="categoryname_ar"
                        label="القسم الرئيسي"
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
                                    <label for="item_name">اسم القسم  الفرعي</label>
                                    <input v-model="form.subcategroy_namear" type="text" class="form-control"
                                           id="item_name"
                                           placeholder="اسم القسم" name="email">
                                </div>
                                <div class="form-group">
                                    <label for="item_nameen">اسم القسم الفرعي  بالانجليزية</label>

                                    <input v-model="form.subcategory_nameen" type="text" class="form-control"
                                           id="item_nameen"
                                           placeholder="اسم القسم بالانجليزية" name="pwd">
                                </div>
                                <div class="form-group">
                                    <label for="category_id"> القسم الرئيسي  :</label>
                                    <el-select v-model="form.categories_id" filterable placeholder="اختار قسم"
                                               id="category_id">
                                        <el-option
                                                v-for="category in Category"
                                                :key="category.categories_id"
                                                :label="category.categoryname_ar"
                                                :value="category.categories_id">
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
    <script src={{asset("AdminScript/subcategory.js")}}></script>
@endsection