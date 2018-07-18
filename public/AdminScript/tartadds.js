ELEMENT.locale(ELEMENT.lang.en);
Vue.use(DataTables);
Vue.use(DataTables.DataTablesServer);
Vue.component('v-select', VueSelect.VueSelect);

img = '';
$(document).ready(function () {
    function readFile() {
        if (this.files && this.files[0]) {
            var FR = new FileReader();
            FR.onload = function (e) {
                document.getElementById("addsimage").src = e.target.result;
                img = e.target.result;
            };
            FR.readAsDataURL(this.files[0]);
        }
    }

    document.getElementById("adds_image").addEventListener("change", readFile, false);
});

var TartAds = new Vue({
    el: '#TartAds',
    data: {
        adds_id: '',
        TartAdsData: [],
        title: '',
        url: 'http://admin.alyahyamb.com',
        dialogTableVisible: false,
        form: {
            add_namear: '',
            add_nameen: '',
            add_quantity: '',
            add_price: ''
        },
        customFilters: [{
            vals: '',
            props: [
                'add_namear',
                'add_nameen',
                'add_quantity',
                'add_price'
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
            url: self.url + "/api/getTartAdds?lang=ar",
            method: 'Get'

        }).done(function (result) {
            console.log(result);
            self.TartAdsData = result;
        });
    },
    methods: {

        handleEdit: function (index, row) {

            var self = this;
            console.log(row);
            self.form = {
                adds_id: row.adds_id,
                add_namear: row.add_namear,
                add_nameen: row.add_nameen,
                add_quantity: row.add_quantity,
                add_price: row.add_price

            };

            this.title = 'تعديل';
            this.dialogFormVisible = true;

        },
        Save: function () {
            var self = this;
            console.log(self.form);
            console.log(self.form.adds_id);

            if (self.form.adds_id === undefined) {
                this.create();
            } else {
                this.update();
            }
        },
        create: function () {
            var self = this;
            self.form.add_image = img;
            console.log(self.form);

            $.ajax({
                url: self.url + "/api/addTartAdds?lang=ar",
                method: 'post',
                data: self.form
            }).done(function (result) {
                console.log(result);
                TartAds.TartAdsData.push(result);
                self.$message({
                    showClose: true,
                    message: 'تمت  الاضافة   بنجاح',
                    type: 'success'
                });

            });

        },
        update: function () {
            var self = this;
            self.form.add_image = img;


             console.log(self.form);

            $.ajax({
                url: self.url + "/updatetartadds/" + self.form.adds_id,
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
                    'add_namear': '',
                    'add_nameen': '',
                    'add_quantity': '',
                    'add_price': ''
                }
        },
        handleDelete: function (index, row) {
            console.log(index, row);
            var self = this;
            $.ajax({
                url: self.url + "/deletetartadds/" + row.adds_id,
                method: 'get'
            }).done(function (result) {
                console.log(result);
                self.$message({
                    showClose: true,
                    message: 'تم الحذف  بنجاح',
                    type: 'success'
                });

                TartAds.TartAdsData.splice(index, 1);
            });
        }
    }

});