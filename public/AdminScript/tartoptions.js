ELEMENT.locale(ELEMENT.lang.en);
Vue.use(DataTables);
Vue.use(DataTables.DataTablesServer);
Vue.component('v-select', VueSelect.VueSelect);

var TartOptions = new Vue({
    el: '#TartOptions',
    data: {
        tartOptionsData: [],
        Items: [],
        Floors: [],
        Size: [],
        title: '',
        url: 'http://admin.alyahyamb.com',
        dialogTableVisible: false,
        form: {
            item_id: '',
            floors_id: '',
            size_id: ''
        },
        customFilters: [{
            vals: '',
            props: [
                'item_name',
                'floorsar',
                'size_name'
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
        self.getItem();
        self.getFloors();
        self.getSize();
        self.getTartOptions();
    },
    methods: {

        getTartOptions: function () {
            var self = this;
            $.ajax({
                url: self.url + "/gettartoptions",
                method: 'Get'

            }).done(function (result) {
                // console.log(result);
                self.tartOptionsData = result;
            });
        },
        getItem: function () {
            var self = this;
            $.ajax({
                url: self.url + "/getallitem?lang=ar",
                method: 'Get'

            }).done(function (result) {
                console.log(result);
                self.Items = result;
            });
        },
        getFloors: function () {
            var self = this;
            $.ajax({
                url: self.url + "/api/getTartSize?lang=ar",
                method: 'Get'

            }).done(function (result) {
                self.Size = result;
                console.log(self.Size);

            });

        },
        getSize: function () {
            var self = this;
            $.ajax({
                url: self.url + "/getallfloor?lang=ar",
                method: 'Get'

            }).done(function (result) {
                self.Floors = result;
                console.log(self.Floors);
            });

        },
        handleEdit: function (index, row) {

            var self = this;
            console.log(row);
            self.form = {
                'tart_option_id': row.tart_option_id,
                'item_id': row.item_id,
                'floors_id': row.floors_id,
                'size_id': row.size_id

            };

            self.title = 'تعديل';
            self.dialogFormVisible = true;


        },
        Save: function () {
            var self = this;
            console.log(self.form);
            console.log(self.form.tart_option_id);

            if (self.form.tart_option_id === undefined) {
                this.create();
            } else {
                this.update();
            }
        },
        update: function () {
            var self = this;
            console.log(self.form);

            $.ajax({
                url: self.url + "/updatenewtartoptions/" + self.form.tart_option_id,
                method: 'Put',
                data: self.form

            }).done(function (result) {
                console.log(result);
                self.$message({
                    showClose: true,
                    message: 'تم تعديل بنجاح',
                    type: 'success'
                });
                window.location.reload();
            });
        },
        create: function () {
            var self = this;
            console.log(self.form);

            $.ajax({
                url: self.url + "/postnewtartoptions?lang=ar",
                method: 'post',
                data: self.form
            }).done(function (result) {
                console.log(result);
                TartOptions.tartOptionsData.push(result[0]);
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
                    item_id: '',
                    floors_id: '',
                    size_id: ''
                }
        },

        handleDelete: function (index, row) {
            console.log(index, row);
            var self = this;
            $.ajax({
                url: self.url + "/deletetartoptions/" + row.tart_option_id,
                method: 'get'
            }).done(function (result) {
                console.log(result);
                self.$message({
                    showClose: true,
                    message: 'تم حذف  بنجاح',
                    type: 'success'
                });

                TartOptions.tartOptionsData.splice(index, 1);
            });

        }
    }

});