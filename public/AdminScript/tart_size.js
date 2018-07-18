ELEMENT.locale(ELEMENT.lang.en);
Vue.use(DataTables);
Vue.use(DataTables.DataTablesServer);
Vue.component('v-select', VueSelect.VueSelect);


var tartsize = new Vue({
    el: '#tartsize',
    data: {
        size_id: '',
        TartSizeData: [],
        title: '',
        url: 'http://admin.alyahyamb.com',
        dialogTableVisible: false,
        form: {
            size_name: '',
            size_no: '',
            size_price: ''
        },
        customFilters: [{
            vals: '',
            props: [
                'size_name',
                'size_no',
                'size_price'
            ]
        }, {
            vals: []
        }],
        actionsDef: {
            colProps: {
                span: 8
            },
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
            url: self.url + "/api/getTartSize",
            method: 'Get'

        }).done(function (result) {
            console.log(result);
            self.TartSizeData = result;
        });
    },
    methods: {

        handleEdit: function (index, row) {

            var self = this;
            console.log(row);
            self.form = {
                size_id :row.size_id,
                size_name: row.size_name,
                size_no: row.size_no,
                size_price: row.size_price

            };

            this.title = 'تعديل';
            this.dialogFormVisible = true;

        },
        Save: function () {
            var self = this;
            console.log(self.form);
            console.log(self.form.size_id);

            if (self.form.size_id === undefined) {
                this.create();
            } else {
                this.update();
            }
        },
        create: function () {
            var self = this;
            console.log(self.form);

            $.ajax({
                url: self.url + "/api/addTartSize",
                method: 'post',
                data: self.form
            }).done(function (result) {
                console.log(result);
                tartsize.TartSizeData.push(result);
                self.$message({
                    showClose: true,
                    message: 'تمت  الاضافة   بنجاح',
                    type: 'success'
                });

            });

        },
        update: function () {
            var self = this;
            console.log(self.form);
            $.ajax({
                url: self.url + "/updatetartsize/" + self.form.size_id,
                method: 'Put',
                data: self.form

            }).done(function (result) {
                console.log(result);
                self.$message({
                    showClose: true,
                    message: 'تم التعديل   بنجاح',
                    type: 'success'
                });
                window.location.reload();
            });
        },
        clearForm: function () {
            this.form =
                {
                    'size_name': '',
                    'size_no': '',
                    'size_price': ''

                }
        },
        handleDelete: function (index, row) {
            console.log(index, row);
            var self = this;
            $.ajax({
                url: self.url + "/deletetartsize/" + row.size_id,
                method: 'delete'
            }).done(function (result) {
                console.log(result);
                self.$message({
                    showClose: true,
                    message: 'تم الحذف  بنجاح',
                    type: 'success'
                });

                tartsize.TartSizeData.splice(index);
            });
        }
    }

});