ELEMENT.locale(ELEMENT.lang.en);
Vue.use(DataTables);
Vue.use(DataTables.DataTablesServer);
Vue.component('v-select', VueSelect.VueSelect);

img = '';
$(document).ready(function () {
    img = [];

    function readFile() {
        for (var i = 0; i < this.files.length; i++) {
            if (this.files && this.files[0]) {
                var FR = new FileReader();
                FR.onload = function (e) {

                    document.getElementById("Item").src = e.target.result;
                    img.push(e.target.result);

                    console.log(img);
                };

                FR.readAsDataURL(this.files[0]);
            }
        }

    }

    document.getElementById("item_imge").addEventListener("change", readFile, false);

});

var Item = new Vue({
    el: '#Item',
    data: {
        categories_id: '',
        Category: [],
        rowIamges: [],
        SubCategory: [],
        imagepath: 'ItemImages/',
        title: '',
        addItem: 'اضافة منتج',
        Edit: 'تعديل',
        Delete: 'حذف',
        ItemsPics: 'صور المنتج',
        Items: [],
        dialogTableVisible: false,
        itemimages: [],
        itemname_ar: 'اسم المنتج',
        itemname_en: 'اسم المنتج بالانجليزية',
        itemdetails_ar: 'تفاصيل المنتج',
        itemdetails_en: 'تفاصيل المنتج بالانجليزية',
        price: 'سعر المنتج',
        quantity: 'العدد',
        messure_unit_ar: 'وحدة القياس',
        messure_unit_en: 'وحدة القياس بالانجليزية',
        item_totalrate: 'تقييم المنتج',
        item_ratedtimes: 'عدد مرات تقييم المنتج',
        item_isfavorite: '',
        save: 'حفظ',
        ItemPic: 'صور المنتج',
        form: {
            itemname_ar: '',
            itemname_en: '',
            itemdetails_ar: '',
            itemdetails_en: '',
            price: '',
            quantity: '',
            categories_id: '',
            sub_category_id: '',
            messure_unit_ar: '',
            messure_unit_en: '',
            item_totalrate: '',
            item_ratedtimes: '',
            item_isfavorite: '',
            image_path: []
        },
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

    },
    methods: {
        handleEdit: function (index, row) {

            var self = this;
            console.log(row);
            this.form = {
                item_id: row.item_id,
                itemname_ar: row.item_name,
                itemname_en: row.item_name,
                itemdetails_ar: row.itemdetails_ar,
                itemdetails_en: row.itemdetails_en,
                price: row.price,
                category_id: row.category_id,
                sub_category_id: row.sub_category_id,
                quantity: row.quantity,
                messure_unit_ar: row.messure_unit_ar,
                messure_unit_en: row.messure_unit_en

            };
            self.rowIamges = row.itemimages;
            console.log(this.rowIamges);
            this.title = 'تعديل';
            this.dialogFormVisible = true;


        },
        Save: function () {
            console.log(this.form);
            console.log(this.form.item_id);
            if (this.form.item_id === undefined) {
                this.create();
            } else {
                this.update();
            }
        },
        update: function () {
            this.form.img = img;
            $.ajax({
                url: "http://admin.alyahyamb.com/api/update/" + this.form.item_id,
                method: 'Put',
                data: this.form

            }).done(function (result) {
                console.log(result);
                window.location.reload();
            });
        },
        create: function () {
            console.log('here');
            this.form.category_id = this.form.categories_id;
            this.form.item_image = img;
            var self = this;
            console.log(this.form);
            $.ajax({
                url: "http://admin.alyahyamb.com/api/addItem",
                method: 'post',
                data: this.form
            }).done(function (result) {
                console.log(result);
                Item.Items.push(result);

                self.$message({
                    showClose: true,
                    message: 'تم اضافة منتج جديد بنجاح',
                    type: 'success'
                });

            });

        },
        clearForm: function () {
            this.form =
                {
                    item_name: '',
                    item_nameen: '',
                    itemdetails_ar: '',
                    itemdetails_en: '',
                    price: '',
                    category_id: '',
                    sub_category_id: '',
                    quantity: '',
                    messure_unit_ar: '',
                    messure_unit_en: '',
                    item_totalrate: '',
                    item_ratedtimes: '',
                    item_isfavorite: '',
                    image_path: []
                }

        },

        handleDelete: function (index, row) {
            console.log(index, row);
            var self = this;
            $.ajax({
                url: "http://admin.alyahyamb.com/deleteItem/" + row.item_id,
                method: 'get',
                data: this.form
            }).done(function (result) {
                console.log(result);
                self.$message({
                    showClose: true,
                    message: 'تم حذف المنتج بنجاح',
                    type: 'success'
                });

                Item.Items.splice(index);
            });


        },
        showrowpic: function (index, row) {
            console.log(row.itemimages);
            var self = this;
            self.rowIamges = row.itemimages;
            self.dialogTableVisible = true;
        },

        deleteIamge: function (item, index, rowIamges) {
            var self = this;

            console.log(index, item);
            rowIamges.splice(index, 1);


            $.ajax({
                url: "http://admin.alyahyamb.com/deletiamge/" + item.itemimages_id,
                method: 'get'
            }).done(function (result) {
                console.log(result);

                self.$message({
                    showClose: true,
                    message: 'تم حذف المنتج بنجاح',
                    type: 'success'
                });

                // self.rowIamges.splice(index);
            });
        },
        getSubCtegory: function (categories_id) {
            var self = this;
            $.ajax({
                url: "http://admin.alyahyamb.com/getsubcategory/" + categories_id + "?lang=ar",
                method: 'Get'
            }).done(function (result) {
                console.log(result);
                self.SubCategory = result;
            });
        }

    }

});