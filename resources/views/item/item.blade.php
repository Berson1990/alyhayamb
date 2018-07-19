@extends('admintempalate.template')

@section('page-style-level')
    <style>
        .dir {
            direction: rtl;
        }

        /*.el-carousel__item h3 {*/
        /*color: #475669;*/
        /*font-size: 18px;*/
        /*opacity: 0.75;*/
        /*line-height: 300px;*/
        /*margin: 0;*/
        /*}*/

        /*.el-carousel__item:nth-child(2n) {*/
        /*background-color: #99a9bf;*/
        /*}*/

        /*.el-carousel__item:nth-child(2n+1) {*/
        /*background-color: #d3dce6;*/
        /*}*/

    </style>
@endsection

@section('content')
    <div id="Item">
        <div class="row">

            <br>
            <data-tables :data="Items" :show-action-bar="false" :custom-filters="customFilters"
                         :actions-def="actionsDef">
                <el-row slot="custom-tool-bar" style="margin-bottom: 10px ; text-align: center">


                    <el-col :span="5">
                        <el-input v-model="customFilters[0].vals">
                        </el-input>
                    </el-col>

                    <el-col :span="19">
                        <el-button type="success" data-toggle="modal" data-target="#myModal" @click="clearForm()">
                            @{{addItem}}
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
                                @click="handleEdit(scope.$index, scope.row)">@{{Edit}}
                        </el-button>
                    </template>
                </el-table-column>

                <el-table-column
                        prop="item_name"
                        label="اسم المنتج"
                >
                </el-table-column>

                <el-table-column
                        prop="item_nameen"
                        label="اسم المنتج بالعربية"
                >
                </el-table-column>
                <el-table-column
                        prop="itemdetails_ar"
                        label="تفاصيل المنتج"
                >
                </el-table-column>
                <el-table-column
                        prop="itemdetails_en"
                        label="تفاصيل المنتج بالانجليزية"
                >
                </el-table-column>
                <el-table-column
                        prop="price"
                        label="سعر المنتج"
                >
                </el-table-column>
                <el-table-column
                        prop="categoryname_ar"
                        label="القسم"
                >
                </el-table-column>
                <el-table-column
                        prop="subcategroy_namear"
                        label=" القسم الفرعي"
                >
                </el-table-column>
                <el-table-column
                        prop="quantity"
                        label="العدد"
                >
                </el-table-column>
                <el-table-column
                        prop="messure_unit_ar"
                        label="وحدة القياس "
                >
                </el-table-column>
                <el-table-column
                        prop="messure_unit_en"
                        label="وحدة القياس بالانجليزية"
                >
                </el-table-column>
                <el-table-column
                        prop="item_totalrate"
                        label="التقييم"
                >
                </el-table-column>

                <el-table-column
                        prop="item_ratedtimes"
                        label="عدد مرات التقييم"
                >
                </el-table-column>

                <el-table-column label="صور المنتج">
                    <template slot-scope="scope">
                        <el-button
                                class="el-icon-picture-outline"
                                size="medium"
                                type="primary"
                                @click="showrowpic(scope.$index,scope.row)"
                        >@{{ ItemsPics }}
                        </el-button>
                    </template>
                </el-table-column>

                <el-table-column label="حذف">
                    <template slot-scope="scope">

                        <el-button
                                class="el-icon-delete"
                                size="medium"
                                type="danger"
                                @click="handleDelete(scope.$index, scope.row)">@{{ Delete }}
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
                                    <label for="item_name">@{{itemname_ar}}</label>
                                    <input v-model="form.itemname_ar" type="text" class="form-control" id="item_name"
                                           placeholder="ادخل اسم المنتج بالعربية" name="email">
                                </div>
                                <div class="form-group">
                                    <label for="item_nameen">@{{ itemname_en }}</label>

                                    <input v-model="form.itemname_en" type="text" class="form-control" id="item_nameen"
                                           placeholder="ادخل اسم المنتج بالانجليزية" name="pwd">
                                </div>
                                <div class="form-group">
                                    <label for="itemdetails_ar">@{{ itemdetails_ar }}</label>

                                    <textarea v-model="form.itemdetails_ar" type="text" class="form-control"
                                              id="itemdetails_ar"
                                              placeholder="ادخل تفاصيل المنتج " name="pwd"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="itemdetails_en">@{{ itemdetails_en }}</label>

                                    <textarea v-model="form.itemdetails_en" type="text" class="form-control"
                                              id="itemdetails_en"
                                              placeholder="ادخل تفاصيل المنتج بالانجليزية" name="pwd"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="price">@{{ price }}</label>

                                    <input v-model="form.price" type="text" class="form-control" id="price"
                                           placeholder="ادخل سعر المنتج  " name="pwd">
                                </div>
                                <div class="form-group">
                                    <label for="category_id"> القسم :</label>
                                    <el-select v-model="form.categories_id"
                                               v-on:change="getSubCtegory(form.categories_id)" filterable
                                               placeholder="اختار قسم"
                                               id="category_id">
                                        <el-option
                                                v-for="category in Category"
                                                :key="category.categories_id"
                                                :label="category.categoryname_ar"
                                                :value="category.categories_id"
                                        >
                                        </el-option>
                                    </el-select>

                                </div>
                                <div class="form-group">
                                    <label for="sub_category_id"> القسم الفرعي :</label>
                                    <el-select v-model="form.sub_category_id" filterable placeholder="اختار قسم"
                                               id="sub_category_id">
                                        <el-option
                                                v-for="subcategory in SubCategory"
                                                :key="subcategory.sub_category_id"
                                                :label="subcategory.subcategroy_namear"
                                                :value="subcategory.sub_category_id">
                                        </el-option>
                                    </el-select>

                                </div>

                                <div class="form-group">
                                    <label for="name_en">@{{ quantity }}</label>

                                    <input v-model="form.quantity" type="text" class="form-control" id="name_en"
                                           placeholder="ادخل العدد   " name="pwd">
                                </div>
                                <div class="form-group">
                                    <label for="messure_unit_ar">@{{ messure_unit_ar }}</label>

                                    <input v-model="form.messure_unit_ar" type="text" class="form-control"
                                           id="messure_unit_ar"
                                           placeholder="ادخل وحدة قياس المنتج   " name="pwd">
                                </div>
                                <div class="form-group">
                                    <label for="messure_unit_en">@{{ messure_unit_en }}</label>

                                    <input v-model="form.messure_unit_en" type="text" class="form-control"
                                           id="messure_unit_en"
                                           placeholder="ادخل وحدة قياس المنتج بالانجليزيه   " name="pwd">
                                </div>


                                <div class="form-group">
                                    <label for="item_imge">@{{ ItemPic }}</label>
                                    <input type="file" multiple class="form-control" id="item_imge">

                                    <br>
                                    <ul class="nav">
                                        {{--<img id="SalesCate" class="img-responsive" :src=images>--}}
                                        <li v-for="(item , index) in rowIamges">
                                            <a href="javascript:;" @click="deleteIamge(item,index,rowIamges)">X <img
                                                        v-bind:src="'ItemImages/' + item.image_path"></a>
                                        </li>
                                    </ul>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success" data-dismiss="modal" @click="Save()">@{{ save
                                }}
                            </button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">اغلاق
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>


        <el-dialog title="صور المنتج" :visible.sync="dialogTableVisible">


            <template>
                <el-carousel indicator-position="outside">
                    <el-carousel-item v-for="item in rowIamges" :key="item">
                        {{--@{{item.itemimages.image_path}}--}}
                        <img v-bind:src="'ItemImages/' + item.image_path">
                    </el-carousel-item>
                </el-carousel>
            </template>

        </el-dialog>

    </div>

@endsection

@section('page-script-level')
    <script src={{asset("AdminScript/item.js")}}></script>
@endsection