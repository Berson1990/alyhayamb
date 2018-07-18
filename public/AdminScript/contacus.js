ELEMENT.locale(ELEMENT.lang.en);
Vue.use(DataTables);
Vue.use(DataTables.DataTablesServer);
Vue.component('v-select', VueSelect.VueSelect);


var contactus = new Vue({
    el: '#contactus',
    data: {
        size_id: '',
        ContactUsData: [],
        title: '',
        url: 'http://admin.alyahyamb.com',
        dialogTableVisible: false,
        form: {
            phone_numbers: '',
            emails: '',
            address: '',
            address_en: ''
        },
        customFilters: [{
            vals: '',
            props: [
                'phone_numbers',
                'emails',
                'address',
                'address_en'
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
            url: self.url + "/getcontacus?lang=ar",
            method: 'Get'

        }).done(function (result) {
            console.log(result);
            self.ContactUsData = result;
        });
    },
    methods: {

        handleEdit: function (index, row) {

            var self = this;
            console.log(row);
            self.form = {
                contact_us_id: row.contact_us_id,
                phone_numbers: row.phone_numbers,
                emails: row.emails,
                address: row.address,
                address_en: row.address_en

            };

            this.title = 'تعديل';
            this.dialogFormVisible = true;

        },
        Save: function () {
            var self = this;
            console.log(self.form);
            console.log(self.form.contact_us_id);

            if (self.form.contact_us_id === undefined) {
                this.create();
            } else {
                this.update();
            }
        },
        create: function () {
            var self = this;
            console.log(self.form);

            $.ajax({
                url: self.url + "/postcontacus?lang=ar",
                method: 'post',
                data: self.form
            }).done(function (result) {
                console.log(result);
                contactus.ContactUsData.push(result);
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
                url: self.url + "/updatecontacus/" + self.form.contact_us_id,
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
                    phone_numbers: '',
                    emails: '',
                    address: '',
                    address_en:''

                }
        },
        handleDelete: function (index, row) {
            console.log(index, row);
            var self = this;
            $.ajax({
                url: self.url + "/deletecontacus/" + row.contact_us_id,
                method: 'delete'
            }).done(function (result) {
                console.log(result);
                self.$message({
                    showClose: true,
                    message: 'تم الحذف  بنجاح',
                    type: 'success'
                });

                contactus.ContactUsData.splice(index, 1);
            });
        }
    }

});