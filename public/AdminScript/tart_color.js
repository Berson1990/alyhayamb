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

var TartColor = new Vue({
    el: '#TartColor',
    data: {
        color_id: '',
        TartColorData: [],
        title: '',
        url: 'http://admin.alyahyamb.com',
        dialogTableVisible: false,
        form: {
            color_name:'',
            color_discribtion:''
        },
        customFilters: [{
            vals: '',
            props: [
                'color_name',
                'color_discribtion'
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
            url: self.url + "/api/getTartColor",
            method: 'Get'

        }).done(function (result) {
            console.log(result);
            self.TartColorData = result;
        });
    },
    methods: {

        handleEdit: function (index, row) {

            var self = this;
            console.log(row);
            self.form = {
                color_id: row.color_id,
                color_name: row.color_name,
                color_discribtion: row.color_discribtion

            };

            this.title = 'تعديل';
            this.dialogFormVisible = true;

        },
        Save: function () {
            var self = this;
            console.log(self.form);
            console.log(self.form.color_id);

            if (self.form.color_id === undefined) {
                this.create();
            } else {
                this.update();
            }
        },
        create: function () {
            var self = this;
            self.form.tart_colorImage = img;
            console.log(self.form);

            $.ajax({
                url: self.url + "/api/addTartColor",
                method: 'post',
                data: self.form
            }).done(function (result) {
                console.log(result);
                TartColor.TartColorData.push(result);
                self.$message({
                    showClose: true,
                    message: 'تمت  الاضافة   بنجاح',
                    type: 'success'
                });

            });

        },
        update: function () {
            var self = this;
            self.form.tart_colorImage = img;


            console.log(self.form);

            $.ajax({
                url: self.url + "/updatetartcolor/" + self.form.color_id ,
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
                    'color_name':'',
                    'color_discribtion':'',

                }
        },
        handleDelete: function (index, row) {
            console.log(index, row);
            var self = this;
            $.ajax({
                url: self.url + "/deletetartcolor/" + row.color_id,
                method: 'delete'
            }).done(function (result) {
                console.log(result);
                self.$message({
                    showClose: true,
                    message: 'تم الحذف  بنجاح',
                    type: 'success'
                });

                TartColor.TartColorData.splice(index);
            });
        }
    }

});