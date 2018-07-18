@extends('admintempalate.template')

@section('page-style-level')
    <style>
        .dir {
            direction: rtl;
        }

    </style>
@endsection

@section('content')

    <div id="Category">
        <div class="row">

            <br>
            <data-tables :data="Category" :show-action-bar="false" :custom-filters="customFilters"
                         :actions-def="actionsDef">
                <el-row slot="custom-tool-bar" style="margin-bottom: 10px ; text-align: center">


                    <el-col :span="5">
                        <el-input v-model="customFilters[0].vals">
                        </el-input>
                    </el-col>

                    <el-col :span="19">
                        <el-button type="success" data-toggle="modal" data-target="#myModal" @click="clearForm()">
                            اضف قسم جديد
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
                        prop="categoryname_ar"
                        label="اسم القسم بالعربية"
                >
                </el-table-column>

                <el-table-column
                        prop="categoryname_en"
                        label="اسم القسم بالانجليزية "
                >
                </el-table-column>


                </el-table-column>
                <el-table-column

                        label="اظهار القسم"
                >
                    <template slot-scope="scope">
                      <h3 v-if="scope.row.category_activation === 1">يعمل</h3>
                      <h3 v-if="scope.row.category_activation === 0">متوقف</h3>
                    </template>
                </el-table-column>

                <el-table-column label="صور القسم">
                    <template slot-scope="scope">
                        <img :src="'categoriesImages/' + scope.row.category_image" class="img-responsive">
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
                                    <label for="item_name">اسم القسم </label>
                                    <input v-model="form.categoryname_ar" type="text" class="form-control" id="item_name"
                                           placeholder="اسم القسم" name="email">
                                </div>
                                <div class="form-group">
                                    <label for="item_nameen">اسم القسم بالانجليزية</label>

                                    <input v-model="form.categoryname_en" type="text" class="form-control" id="item_nameen"
                                           placeholder="اسم القسم بالانجليزية" name="pwd">
                                </div>
                                <div class="form-group">
                                    <label for="itemdetails_ar">حاله القسم</label>
                                    <el-switch
                                            style="display: block"
                                            v-model="form.category_activation"
                                            active-color="#13ce66"
                                            inactive-color="#ff4949"
                                            inactive-text="متوقف"
                                            active-text="يعمل"
                                    >
                                    </el-switch>
                                </div>

                                <div class="form-group">
                                    <label for="item_imge">صورة القسم </label>
                                    <input type="file" multiple class="form-control" id="category_imge">

                                    <br>
                                    <ul class="nav">
                                        <img id="category_image" class="img-responsive" src="">
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
    <script src={{asset("AdminScript/category.js")}}></script>
@endsection