ELEMENT.locale(ELEMENT.lang.en);
Vue.use(DataTables);
Vue.use(DataTables.DataTablesServer);
Vue.component('v-select', VueSelect.VueSelect);

var ads = new Vue({
    el: '#ads',
    data: {
        categories_id: '',
        adsData: [],
        Item: [],
        title: '',
        url: 'http://admin.alyahyamb.com',
        dialogTableVisible: false,
        form: {
            item_id: '',
            state: '',
            offer: '',
            offeren: ''

        },
        customFilters: [{
            vals: '',
            props: [
                'item_name'
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
            url: self.url + "/getafs?lang=ar",
            method: 'Get'

        }).done(function (result) {
            console.log(result);
            self.adsData = result;
        });
        $.ajax({
            url: self.url + "/getItems",
            method: 'Get'

        }).done(function (result) {
            console.log(result);
            self.Item = result;
        });
    },
    methods: {

        handleEdit: function (index, row) {

            var self = this;
            console.log(row);
            self.form = {
                'item_id': row.item_id,
                'state': row.state,
                'ads_id': row.ads_id,
                'offer': row.offer,
                'offeren': row.offer
            };
            self.title = 'تعديل';
            self.dialogFormVisible = true;
        },
        Save: function () {
            var self = this;
            console.log(self.form);
            console.log(self.form.ads_id);

            if (self.form.ads_id === undefined) {
                this.create();
            } else {
                this.update();
            }
        },
        update: function () {
            var self = this;
            console.log(self.form);

            $.ajax({
                url: self.url + "/updateads/" + self.form.ads_id,
                method: 'Put',
                data: self.form

            }).done(function (result) {
                console.log(result);
                self.$message({
                    showClose: true,
                    message: 'تم تعديل  الاعلان بنجاح',
                    type: 'success'
                });
                window.location.reload();
            });
        },
        create: function () {
            var self = this;
            console.log(self.form);

            $.ajax({
                url: self.url + "/postads?lang=ar",
                method: 'post',
                data: self.form
            }).done(function (result) {
                console.log(result);
                ads.adsData.push(result[0]);
                self.$message({
                    showClose: true,
                    message: 'تم اضافةاعلان جديد بنجاح',
                    type: 'success'
                });

            });

        },
        clearForm: function () {
            this.form =
                {
                    item_id: '',
                    state: '',
                    offer: '',
                    offeren: ''

                }
        },

        handleDelete: function (index, row) {
            console.log(index, row);
            var self = this;
            $.ajax({
                url: self.url + "/deleteads/" + row.ads_id,
                method: 'get'
            }).done(function (result) {
                console.log(result);
                self.$message({
                    showClose: true,
                    message: 'تم حذف اعلان بنجاح',
                    type: 'success'
                });

                ads.adsData.splice(index);
            });

        }
    }

});