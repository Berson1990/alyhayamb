@extends('admintempalate.template')

@section('page-style-level')
    <style>
        .dir {
            direction: rtl;
        }

    </style>
@endsection

@section('content')
    <div id="SalesReport">

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-body">
                    <div class="form-group">
                        <div class="block">
                            <span class="demonstration">من تاريخ</span>
                            <el-date-picker
                                    v-model="ReportForm.fromDate"
                                    type="date"
                                    placeholder="Pick a day">
                            </el-date-picker>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="block">
                            <span class="demonstration">الى تاريخ</span>
                            <el-date-picker
                                    v-model="ReportForm.toDate"
                                    type="date"
                                    placeholder="Pick a day">
                            </el-date-picker>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="category_id"> المنتج :</label>
                        <el-select v-model="ReportForm.item_id"
                                   filterable placeholder="اختار قسم"
                                   id="category_id">
                            <el-option
                                    v-for="item in Items"
                                    :key="item.item_id"
                                    :label="item.item_name"
                                    :value="item.item_id">
                            </el-option>
                        </el-select>
                    </div>
                    <div class="form-group">
                        <label for="category_id"> القسم :</label>
                        <el-select v-model="ReportForm.categories_id" v-on:change="getSubCtegory(form.categories_id)"
                                   filterable placeholder="اختار قسم"
                                   id="category_id">
                            <el-option
                                    v-for="category in Category"
                                    :key="category.categories_id"
                                    :label="category.categoryname_ar"
                                    :value="category.categories_id">
                            </el-option>
                        </el-select>
                    </div>

                    <div class="form-group">
                        <button class="btn btn-success col-md-6" @click="getReport()">بـــحــث</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">

            <br>
            <data-tables :data="SalesReportData" :show-action-bar="false" :custom-filters="customFilters"
                         :actions-def="actionsDef">
                <el-row slot="custom-tool-bar" style="margin-bottom: 10px ; text-align: center">

                    <el-col :span="5">
                        <el-input v-model="customFilters[0].vals">
                        </el-input>
                    </el-col>

                </el-row>

                <el-table-column
                        prop="order_id"
                        label="رقم الطلب"
                >
                </el-table-column>
                <el-table-column
                        prop="item_name"
                        label="اسم المنتج"
                >
                </el-table-column>

                <el-table-column
                        prop="item_nameen"
                        label="اسم المنتج بالانجلزيزة"
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
                        prop="item_totalrate"
                        label="التقييم"
                >
                </el-table-column>

                <el-table-column
                        prop="item_ratedtimes"
                        label="عدد مرات التقييم"
                >
                </el-table-column>

            </data-tables>
        </div>

    </div>
@endsection

@section('page-script-level')
    <script src={{asset("AdminScript/sales_report.js")}}></script>
@endsection