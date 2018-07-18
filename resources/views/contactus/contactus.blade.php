@extends('admintempalate.template')

@section('page-style-level')
    <style>
        .dir {
            direction: rtl;
        }

    </style>
@endsection

@section('content')
    <div id="contactus">
        <div class="row">

            <br>
            <data-tables :data="ContactUsData" :show-action-bar="false" :custom-filters="customFilters"
                         :actions-def="actionsDef">
                <el-row slot="custom-tool-bar" style="margin-bottom: 10px ; text-align: center">


                    <el-col :span="5">
                        <el-input v-model="customFilters[0].vals">
                        </el-input>
                    </el-col>

                    <el-col :span="19">
                        <el-button type="success" data-toggle="modal" data-target="#myModal" @click="clearForm()">
                            اضف وسيلة للتواصل
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
                        prop="phone_numbers"
                        label="الهاتف"
                >
                </el-table-column>
                <el-table-column
                        prop="emails"
                        label="البريد الالكترونى"
                >

                </el-table-column>
                <el-table-column
                        prop="address"
                        label="العنوان"
                >
                </el-table-column>
                <el-table-column
                        prop="address_en"
                        label="العنوان بالانجليزية "
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
                                    <label for="item_name">الهاتف </label>
                                    <input v-model="form.phone_numbers" type="text" class="form-control"
                                           id="item_name"
                                           placeholder="الهاتف" name="email">
                                </div>
                                <div class="form-group">
                                    <label for="item_nameen">البريد الالكترونى </label>

                                    <input v-model="form.emails" type="text" class="form-control"
                                           id="item_nameen"
                                           placeholder="البريد الالكترونى" name="pwd">
                                </div>
                                <div class="form-group">
                                    <label for="item_nameen">العنوان </label>

                                    <input v-model="form.address" type="text" class="form-control"
                                           id="item_nameen"
                                           placeholder="العنوان" name="pwd">
                                </div>
                                <div class="form-group">
                                    <label for="item_nameen">العنوان بالانجليزية </label>

                                    <input v-model="form.address_en" type="text" class="form-control"
                                           id="item_nameen"
                                           placeholder="العنوان بالانجليزية" name="pwd">
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
    <script src={{asset("AdminScript/contacus.js")}}></script>
@endsection