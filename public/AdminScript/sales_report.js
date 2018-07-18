ELEMENT.locale(ELEMENT.lang.en);
Vue.use(DataTables);
Vue.use(DataTables.DataTablesServer);
Vue.component('v-select', VueSelect.VueSelect);

var SalesReport = new Vue({
        el: '#SalesReport',
        data: {
            SalesReportData: [],
            Category: [],
            Items: [],
            url: 'http://admin.alyahyamb.com/',
            ReportForm: {
                fromDate: '',
                toDate:
                    '',
                item_id:
                    '',
                categories_id:
                    ''
            }
            ,
            customFilters: [{
                vals: '',
                props: [
                    'item_name',
                    'item_nameen',
                    'itemdetails_ar',
                    'itemdetails_en',
                    'categories',
                    'subcategroy_namear',
                    'messure_unit_ar',
                    'messure_unit_en'
                ]
            }, {
                vals: []
            }],
            actionsDef:
                {
                    colProps: {
                        span: 8
                    }
                    ,
                    def: [{
                        name: 'new',
                        handler: function () {
                            this.$message("new clicked")
                        }

                    }]
                }
        },
        mounted: function () {
            var self = this;
            $.ajax({
                url: "http://admin.alyahyamb.com/api/getAllCategories?lang=ar",
                method: 'Get'

            }).done(function (result) {
                console.log(result);
                self.Category = result;

            });
            $.ajax({
                url: "http://admin.alyahyamb.com/getallitem?lang=ar",
                method: 'Get'
            }).done(function (result) {
                self.Items = result;
                console.log(self.Items);
            });
        }
        ,
        methods: {
            getReport: function () {
                var self = this;
                formDate = self.formatDatefromDate(self.ReportForm.fromDate);
                toDate = self.formatDatetoDate(self.ReportForm.toDate);
                self.ReportForm.fromDate = formDate;
                self.ReportForm.toDate = toDate;
                console.log(self.ReportForm);

                $.ajax({
                    url: self.url + "report",
                    method: 'post',
                    data: self.ReportForm
                }).done(function (result) {
                    console.log(result);
                    self.SalesReportData = result;


                });
            },
            formatDatefromDate: function (date) {
                var d = new Date(date),
                    month = '' + (d.getMonth() + 1),
                    day = '' + d.getDate(),
                    year = d.getFullYear();

                if (month.length < 2) month = '0' + month;
                if (day.length < 2) day = '0' + day;

                return [year, month, day].join('-');
            },
            formatDatetoDate: function (date) {
                var d = new Date(date),
                    month = '' + (d.getMonth() + 1),
                    day = '' + d.getDate(),
                    year = d.getFullYear();

                if (month.length < 2) month = '0' + month;
                if (day.length < 2) day = '0' + day;

                return [year, month, day].join('-');
            }
        }

    })
;