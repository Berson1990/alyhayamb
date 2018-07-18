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
                document.getElementById("category_image").src = e.target.result;
                img = e.target.result;
            };
            FR.readAsDataURL(this.files[0]);
        }
    }

    document.getElementById("category_imge").addEventListener("change", readFile, false);
});

var Category = new Vue({
    el: '#Category',
    data: {
        categories_id: '',
        Category: [],
        title: '',
        url: 'http://admin.alyahyamb.com',
        dialogTableVisible: false,
        form: {
            categoryname_ar: '',
            categoryname_en: '',
            category_image: '',
            category_activation: true
        },
        customFilters: [{
            vals: '',
            props: [
                'categoryname_ar',
                'categoryname_en'
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
            url: self.url + "/api/getAllCategories?lang=ar",
            method: 'Get'

        }).done(function (result) {
            console.log(result);
            self.Category = result;

        });
    },
    methods: {

        handleEdit: function (index, row) {

            var self = this;
            console.log(row);
            self.form = {
                categories_id: row.categories_id,
                categoryname_ar: row.categoryname_ar,
                categoryname_en: row.categoryname_en,
                category_activation: row.category_activation

            };
            if (row.category_activation === 1) {
                self.form.category_activation = true;
            } else {
                self.form.category_activation = false;
            }


            this.title = 'تعديل';
            this.dialogFormVisible = true;


        },
        Save: function () {
            var self = this;
            console.log(self.form);
            console.log(self.form.categories_id);

            if (self.form.categories_id === undefined) {
                this.create();
            } else {
                this.update();
            }
        },
        update: function () {
            var self = this;
            self.form.category_image = img;

            if (self.form.category_activation === true) {
                self.form.category_activation = 1;
            } else {
                self.form.category_activation = 0;
            }

            console.log(self.form);


            $.ajax({
                url: self.url + "/updatecategory/" + self.form.categories_id + "?lang=ar",
                method: 'Put',
                data: self.form

            }).done(function (result) {
                console.log(result);
                self.$message({
                    showClose: true,
                    message: 'تم تعديل القسم  بنجاح',
                    type: 'success'
                });
                window.location.reload();
            });
        },
        create: function () {
            var self = this;
            self.form.category_id = self.form.categories_id;
            self.form.category_image = img;
            if (self.form.category_activation === true) {
                self.form.category_activation = 1;
            } else {
                self.form.category_activation = 0;
            }
            console.log(self.form);

            $.ajax({
                url: self.url + "/postcategory?lang=ar",
                method: 'post',
                data: self.form
            }).done(function (result) {
                console.log(result);
                Category.Category.push(result);
                self.$message({
                    showClose: true,
                    message: 'تم اضافة القسم جديد بنجاح',
                    type: 'success'
                });

            });

        },
        clearForm: function () {
            this.form =
                {
                    categoryname_ar: '',
                    categoryname_en: '',
                    category_image: '',
                    category_activation: ''
                }
        },

        handleDelete: function (index, row) {
            console.log(index, row);
            var self = this;
            console.log( row.categories_id);
            $.ajax({
                url: self.url + "/deletecategory/" + row.categories_id,
                method: 'get'
            }).done(function (result) {
                console.log(result);
                self.$message({
                    showClose: true,
                    message: 'تم حذف القسم بنجاح',
                    type: 'success'
                });

                Category.Category.splice(index,1);
            });

        }
    }

});