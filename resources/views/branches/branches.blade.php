@extends('admintempalate.template')7

@section('page-style-level')
    <style>
        .dir {
            direction: rtl;
        }

        .google-map {
            width: 100%;
            height: 400px;
            margin: 0 auto;
            background: gray;
        }

    </style>

@endsection

@section('content')

    <div id="Branches" class="dir">
        <div class="row">

            <br>
            <data-tables :data="BranchesData" :show-action-bar="false" :custom-filters="customFilters"
                         :actions-def="actionsDef">
                <el-row slot="custom-tool-bar" style="margin-bottom: 10px ; text-align: center">


                    <el-col :span="5">
                        <el-input v-model="customFilters[0].vals">
                        </el-input>
                    </el-col>

                    <el-col :span="19">
                        <el-button type="success" data-toggle="modal" data-target="#myModal" @click="clearForm()">
                            اضف فرع جديد
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
                        prop="branche_name"
                        label="اسم الفرع"
                >
                </el-table-column>

                <el-table-column
                        prop="branche_nameen"
                        label="اسم الفرع بالانجليزية "
                >
                </el-table-column>

                <el-table-column
                        prop="adress"
                        label="عنوان الفرع"
                >
                </el-table-column>
                <el-table-column
                        prop="addressen"
                        label="عنو ان الفرع  بالانجليزية "
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
                                    <label for="branche_name">اسم الفرع </label>
                                    <input v-model="form.branche_name" type="text" class="form-control"
                                           id="branche_nameen"
                                           placeholder="اسم الفرع" name="email">
                                </div>
                                <div class="form-group">
                                    <label for="branche_nameen">اسم الفرع بالانجليزية</label>

                                    <input v-model="form.branche_nameen" type="text" class="form-control"
                                           id="branche_nameen"
                                           placeholder="اسم الفرع بالانجليزية" name="pwd">
                                </div>
                                <div class="form-group">
                                    <label for="adress">عنوان الفرع </label>

                                    <input v-model="form.adress" type="text" class="form-control"
                                           id="adress"
                                           placeholder="عنوان الفرع " name="pwd">
                                </div>
                                <div class="form-group">
                                    <label for="addressen">عنوان الفرع بالانجليزية</label>

                                    <input v-model="form.addressen" type="text" class="form-control"
                                           id="addressen"
                                           placeholder="اسم الفرع بالانجليزية" name="pwd">
                                </div>
                                {{--v-for--}}
                                <div v-for="branchesphone in form.branches_phone">
                                    <div class="form-group">
                                        <label> نوع الرقم (جوال / ارضى / فاكس)</label>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" v-model="branchesphone.phone_type">
                                    </div>
                                    <div class="form-group">
                                        <label> type of Phone (Mobile \ home \ fax)</label>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" v-model="branchesphone.phone_typeen">
                                    </div>
                                    <div class="form-group">
                                        <label>الرقم </label>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" v-model="branchesphone.phone">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary" type="button" @click="pushinarray()"><i class="fa fa-plus"></i> اضف رقم اخر </button>
                                </div>
                                <br>
                                <div class="form-group">
                                    <div class="google-map" id="BakeryBranchesMab"></div>
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
    <script src="//maps.googleapis.com/maps/api/js?key=AIzaSyD07DXc-MtRg-bXxfcrvqJH4NBo2lfLYeE"></script>

    <script src={{asset("AdminScript/branches.js")}}></script>




@endsection