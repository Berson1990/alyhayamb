@extends('admintempalate.template')

@section('page-style-level')

@endsection

@section('content')
    <div id="Deletage">
        <div class="row">

            <br>
            <data-tables :data="DeletageData" :show-action-bar="false" :custom-filters="customFilters"
                         :actions-def="actionsDef">
                <el-row slot="custom-tool-bar" style="margin-bottom: 10px ; text-align: center">


                    <el-col :span="5">
                        <el-input v-model="customFilters[0].vals">
                        </el-input>
                    </el-col>

                    <el-col :span="19">
                        <el-button type="success" data-toggle="modal" data-target="#myModal" @click="clearForm()">
                            اضف مندوب
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
                                @click="handleEdit(scope.$index, scope.row)"> تعدل المندوب
                        </el-button>
                    </template>
                </el-table-column>

                <el-table-column
                        prop="name"
                        label="اسم المندوب"
                >
                </el-table-column>

                <el-table-column
                        prop="email"
                        label="البريد الالكترونى"
                >
                </el-table-column>
                <el-table-column
                        prop="phone"
                        label="الهاتف"
                >
                </el-table-column>
                <el-table-column label="صور المنتج">
                    <template slot-scope="scope">
                        <el-button
                                class="el-icon-picture-outline"
                                size="medium"
                                type="primary"
                                @click="showdeletageorder(scope.$index,scope.row)"
                        >
                            طلبات المندوبين
                        </el-button>
                    </template>
                </el-table-column>

                <el-table-column label="حذف">
                    <template slot-scope="scope">

                        <el-button
                                class="el-icon-delete"
                                size="medium"
                                type="danger"
                                @click="handleDelete(scope.$index, scope.row)">حذف المندوب
                        </el-button>
                    </template>
                </el-table-column>

            </data-tables>
        </div>

        {{--modal--}}
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
                                    <label for="name"> اسم المندوب</label>
                                    <input v-model="form.name" type="text" class="form-control" id="name"
                                           placeholder="اسم المندوب" name="email">
                                </div>
                                <div class="form-group">
                                    <label for="email">البريد الالكترونى</label>

                                    <input v-model="form.email" type="text" class="form-control" id="email"
                                           placeholder="البريد الالكترونى" name="pwd">
                                </div>
                                <div class="form-group">
                                    <label for="password">كلمة السر</label>

                                    <input v-model="form.password" type="password" class="form-control"
                                           id="password"
                                           placeholder=" كلمة السر" name="pwd"/>
                                </div>
                                <div class="form-group">
                                    <label for="phone">الهاتف</label>

                                    <input v-model="form.phone" type="text" class="form-control"
                                           id="phone"
                                           placeholder="الهاتف" name="pwd"/>
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success" data-dismiss="modal" @click="Save()"> حفظ

                            </button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">اغلاق
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>


        <el-dialog title="طلبات المندوب " :visible.sync="dialogTableVisible">
            <center>
                <div class="row">
                    <el-select v-model="delegateform.order_id" filterable placeholder="اختار رقم الطلب"
                               id="order_id">
                        <el-option
                                v-for="orders in Order"
                                :key="orders.order_id"
                                :label="orders.order_id"
                                :value="orders.order_id">
                        </el-option>
                    </el-select>
                </div>
                <br>
                <div class="row">
                    <button class="btn btn-success" @click="assginotdertodelgate()"> اضف الطلب للمندوب</button>
                </div>

            </center>
            <hr>

            <table class="table table-bordered">
                <thead>
                <td>رقم الطلب</td>
                <td>اسم العميل</td>
                <td>حذف</td>
                </thead>
                <tbody>
                <tr v-for="(deletageOrder , index) in DeletageOrder">
                    <td>@{{ deletageOrder.order_id }}</td>
                    <td>@{{ deletageOrder.name }}</td>
                    <td>
                        <button class="btn btn-danger"
                                @click="deleteorderformdelegate(deletageOrder,index,DeletageOrder)"> حذف الطلب من
                            المندوب
                        </button>
                    </td>
                </tr>
                </tbody>

            </table>

        </el-dialog>

    </div>

@endsection

@section('page-script-level')
    <script src={{asset("AdminScript/deletage.js")}}></script>
@endsection