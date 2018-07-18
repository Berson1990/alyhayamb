ELEMENT.locale(ELEMENT.lang.en);
Vue.use(DataTables);
Vue.use(DataTables.DataTablesServer);
Vue.component('v-select', VueSelect.VueSelect);

var subCategory = new Vue({
    el: '#subCategory',
    data: {
        categories_id: '',
        subCategory: [],
        Category: [],
        title: '',
        url: 'http://admin.alyahyamb.com',
        dialogTableVisible: false,
        form: {
            subcategroy_namear: '',
            subcategory_nameen: '',
            categories_id: ''
        },
        customFilters: [{
            vals: '',
            props: [
                'subcategroy_namear',
                'subcategory_nameen',
                'categoryname_ar'
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
            url: self.url + "/gatsubcategory?lang=ar",
            method: 'Get'

        }).done(function (result) {
            console.log(result);
            self.subCategory = result;
        });
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
                'sub_category_id': row.sub_category_id,
                'subcategroy_namear': row.subcategroy_namear,
                'subcategory_nameen': row.subcategory_nameen,
                'categoryname_ar': row.categoryname_ar,
                'categories_id':row.categories_id

            };

            self.title = 'تعديل';
            self.dialogFormVisible = true;


        },
        Save: function () {
            var self = this;
            console.log(self.form);
            console.log(self.form.sub_category_id);

            if (self.form.sub_category_id === undefined) {
                this.create();
            } else {
                this.update();
            }
        },
        update: function () {
            var self = this;
            console.log(self.form);

            $.ajax({
                url: self.url + "/updatesubcategory/" + self.form.sub_category_id + "?lang=ar",
                method: 'Put',
                data: self.form

            }).done(function (result) {
                console.log(result);
                self.$message({
                    showClose: true,
                    message: 'تم تعديل القسم الفرعي بنجاح',
                    type: 'success'
                });
                window.location.reload();
            });
        },
        create: function () {
            var self = this;
            console.log(self.form);

            $.ajax({
                url: self.url + "/postsubcategory?lang=ar",
                method: 'post',
                data: self.form
            }).done(function (result) {
                console.log(result);
                subCategory.subCategory.push(result[0]);
                self.$message({
                    showClose: true,
                    message: 'تم اضافة القسم فرعي جديد بنجاح',
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
            $.ajax({
                url: self.url + "/deletesubcategory/" + row.sub_category_id,
                method: 'get'
            }).done(function (result) {
                console.log(result);
                self.$message({
                    showClose: true,
                    message: 'تم حذف القسم فرعي بنجاح',
                    type: 'success'
                });

                subCategory.subCategory.splice(index);
            });

        }
    }

});