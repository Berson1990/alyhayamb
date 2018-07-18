ELEMENT.locale(ELEMENT.lang.en);
Vue.use(DataTables);
Vue.use(DataTables.DataTablesServer);
Vue.component('v-select', VueSelect.VueSelect);


var tartFloor = new Vue({
    el: '#tartFloor',
    data: {
        categories_id: '',
        tartFloorData: [],
        title: '',
        url: 'http://admin.alyahyamb.com',
        dialogTableVisible: false,
        form: {
            floorsar: '',
            flooren: '',
            price: ''

        },
        customFilters: [{
            vals: '',
            props: [
                'floorsar',
                'flooren',
                'price'
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
            url: self.url + "/getallfloor?lang=ar",
            method: 'Get'

        }).done(function (result) {
            console.log(result);
            self.tartFloorData = result;

        });
    },
    methods: {

        handleEdit: function (index, row) {

            var self = this;
            console.log(row);
            self.form = {
                floors_id: row.floors_id,
                floorsar: row.floorsar,
                flooren: row.flooren,
                price: row.price

            };

            this.title = 'تعديل';
            this.dialogFormVisible = true;


        },
        Save: function () {
            var self = this;
            console.log(self.form);
            console.log(self.form.floors_id);

            if (self.form.floors_id === undefined) {
                this.create();
            } else {
                this.update();
            }
        },
        update: function () {
            var self = this;
            console.log(self.form);


            $.ajax({
                url: self.url + "/updatefloor/" + self.form.floors_id,
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
        create: function () {
            var self = this;

            console.log(self.form);

            $.ajax({
                url: self.url + "/createfloor?lang=ar",
                method: 'post',
                data: self.form
            }).done(function (result) {
                console.log(result);
                tartFloor.tartFloorData.push(result);
                self.$message({
                    showClose: true,
                    message: 'تم الاضافة بنجاح',
                    type: 'success'
                });

            });

        },
        clearForm: function () {
            this.form =
                {
                    floorsar: '',
                    flooren: '',
                    price: ''
                }
        },

        handleDelete: function (index, row) {
            console.log(index, row);
            var self = this;
            $.ajax({
                url: self.url + "/deletefloor/" + row.floors_id,
                method: 'delete'
            }).done(function (result) {
                console.log(result);
                self.$message({
                    showClose: true,
                    message: 'تم الحذف  بنجاح',
                    type: 'success'
                });

                tartFloor.tartFloorData.splice(index);
            });

        }
    }

});