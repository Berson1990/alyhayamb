ELEMENT.locale(ELEMENT.lang.en);
Vue.use(DataTables);
Vue.use(DataTables.DataTablesServer);
Vue.component('v-select', VueSelect.VueSelect);


var Deletage = new Vue({
    el: '#Deletage',
    data: {
        url: 'http://admin.alyahyamb.com/',
        DeletageData: [],
        Order: [],
        DeletageOrder: [],
        title: '',
        dialogTableVisible: false,
        form: {
            email: '',
            password: '',
            phone: '',
            name: ''
        },
        delegateform: {
            order_id: '',
            delegate_id: ''
        },
        customFilters: [{
            vals: '',
            props: [
                'name'
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
            url: self.url + "getdeletage",
            method: 'Get'

        }).done(function (result) {
            console.log(result);
            self.DeletageData = result;

        });
        $.ajax({
            url: self.url + "allorder?lang=ar",
            method: 'Get'
        }).done(function (result) {
            self.Order = result;
            console.log(self.Order);
        });

    },
    methods: {
        handleEdit: function (index, row) {

            var self = this;
            console.log(row);
            this.form = {
                user_id: row.user_id,
                email: row.email,
                password: row.password,
                phone: row.phone,
                name: row.name


            };

            console.log(this.rowIamges);
            this.title = 'تعديل';
            this.dialogFormVisible = true;


        },
        Save: function () {
            console.log(this.form);
            console.log(this.form.user_id);
            if (this.form.user_id === undefined) {
                this.create();
            } else {
                this.update();
            }
        },
        update: function () {
            var self = this;
            $.ajax({
                url: self.url + "updatedeletage/" + this.form.user_id,
                method: 'Put',
                data: this.form

            }).done(function (result) {
                console.log(result);
                self.$message({
                    showClose: true,
                    message: 'تم التعديل  بنجاح',
                    type: 'success'
                });
                window.location.reload();
            });
        },
        create: function () {

            var self = this;
            console.log(this.form);
            $.ajax({
                url: self.url + "createdeletage",
                method: 'post',
                data: this.form
            }).done(function (result) {
                console.log(result);
                Deletage.DeletageData.push(result);
                self.$message({
                    showClose: true,
                    message: 'تم اضافة  بنجاح',
                    type: 'success'
                });

            });

        },
        clearForm: function () {
            this.form =
                {
                    email: '',
                    password: '',
                    phone: '',
                    name: ''
                }

        },

        handleDelete: function (index, row) {
            console.log(index, row);
            var self = this;
            $.ajax({
                url: self.url + "deletedeletage/" + row.user_id,
                method: 'delete'

            }).done(function (result) {
                console.log(result);
                self.$message({
                    showClose: true,
                    message: 'تم حذف  بنجاح',
                    type: 'success'
                });

                Deletage.DeletageData.splice(index, 1);
            });


        },
        showdeletageorder: function (index, row) {
            var self = this;
            self.delegateform.delegate_id = row.user_id;
            console.log(row.user_id);

            self.dialogTableVisible = true;
            $.ajax({
                url: self.url + "getdeletageorders/" + row.user_id,
                method: 'Get'

            }).done(function (result) {
                console.log(result);
                self.DeletageOrder = result;

            });


        },
        assginotdertodelgate: function () {
            var self = this;
            console.log(self.delegateform.delegate_id);
            $.ajax({
                url: self.url + "assgindeletagetoorder/" + self.delegateform.order_id + '/' + self.delegateform.delegate_id,
                method: 'put'
            }).done(function (result) {
                console.log(result[0]);

                self.$message({
                    showClose: true,
                    message: 'تم اضاف مندوب  ',
                    type: 'success'
                });
                self.DeletageOrder.push(result[0]);

            });
        },
        deleteorderformdelegate: function (order, index, deletageOrder) {
            var self = this;
            console.log(order, index, deletageOrder);
            console.log(order.order_id);
            deletageOrder.splice(index, 1);


            $.ajax({
                url: self.url + "deleteassgindeletage/" + order.order_id,
                method: 'put'
            }).done(function (result) {
                console.log(result);

                self.$message({
                    showClose: true,
                    message: 'تم حذف  الطلب من المندوب',
                    type: 'success'
                });


            });
        }


    }

});