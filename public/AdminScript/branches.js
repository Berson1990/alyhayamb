ELEMENT.locale(ELEMENT.lang.en);
Vue.use(DataTables);
Vue.use(DataTables.DataTablesServer);
Vue.component('v-select', VueSelect.VueSelect);

function toggleBounce() {
    if (marker.getAnimation() !== null) {
        marker.setAnimation(null);
    } else {
        marker.setAnimation(google.maps.Animation.BOUNCE);
    }
}


var Branches = new Vue({
        el: '#Branches',
        data: {
            BranchesData: [],
            title: '',
            url: 'http://admin.alyahyamb.com',
            dialogTableVisible: false,
            long: 24.721070,
            lat: 46.706251,
            form:
                {
                    branche_name: '',
                    branche_nameen: '',
                    adress: '',
                    addressen: '',
                    long: '',
                    lat: '',
                    branches_phone: [{
                        phone_type: '',
                        hone_typeen: '',
                        phone: ''

                    }]
                },
            // brances_phone: [],

            customFilters: [{
                vals: '',
                props: [
                    'address',
                    'addressen',
                    'branche_name',
                    'branche_nameen'
                ]
            }, {
                vals: []
            }],
            actionsDef:
                {
                    colProps: {
                        span: 8
                    }
                    ,
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
            self.getBranches();
            self.initMap(self.long, self.lat);
        }
        ,
        methods: {
            initMap: function (long, lat) {

                var self = this;
                var myCenter = new google.maps.LatLng(long, lat);
                var mapCanvas = document.getElementById("BakeryBranchesMab");
                var mapOptions = {center: myCenter, zoom: 5};
                var map = new google.maps.Map(mapCanvas, mapOptions);
                var marker = new google.maps.Marker({
                    position: myCenter,
                    map: map,
                    draggable: true,
                    animation: google.maps.Animation.DROP
                });
                marker.addListener('click', toggleBounce);
                marker.setMap(map);
                google.maps.event.trigger(map, 'resize');

                var geocoder = new google.maps.Geocoder();
                google.maps.event.addListener(map, 'click', function (event) {
                    geocoder.geocode({
                        'latLng': event.latLng
                    }, function (results, status) {
                        if (status === google.maps.GeocoderStatus.OK) {
                            console.log("location : " + results[0].geometry.location.lat() + " " + results[0].geometry.location.lng());
                            self.form.lat = results[0].geometry.location.lat();
                            self.form.long = results[0].geometry.location.lng();
                        } else {
                            console.log("Something got wrong " + status);
                        }

                    });
                });

            },

            getBranches: function () {
                var self = this;
                $.ajax({
                    url: self.url + "/getallbranches?lang=ar",
                    method: 'Get'

                }).done(function (result) {
                    console.log(result);
                    self.BranchesData = result;

                });
            }
            ,
            handleEdit: function (index, row) {

                var self = this;
                console.log(row);
                self.form = {
                    branches_id: row.branches_id,
                    branche_name: row.branche_name,
                    branche_nameen: row.branche_nameen,
                    adress: row.address,
                    addressen: row.addressen,
                    long: row.long,
                    lat: row.lat,
                    branches_phone: row.branches_phone
                };
                console.log(self.form);
                self.title = 'تعديل';
                self.dialogFormVisible = true;
            }
            ,
            Save: function () {
                var self = this;
                console.log(self.form);
                console.log(self.form.branches_id);

                if (self.form.branches_id === undefined) {
                    this.create();
                } else {
                    this.update();
                }
            }
            ,
            update: function () {
                var self = this;
                console.log(self.form);
                $.ajax({
                    url: self.url + "/pudatebranche/" + self.form.branches_id,
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
            }
            ,
            create: function () {
                var self = this;

                console.log(self.form);

                $.ajax({
                    url: self.url + "/createnewbranche?lang=ar",
                    method: 'post',
                    data: self.form
                }).done(function (result) {
                    console.log(result);
                    Branches.BranchesData.push(result);
                    self.$message({
                        showClose: true,
                        message: 'تم اضافة القسم جديد بنجاح',
                        type: 'success'
                    });

                });

            }
            ,
            clearForm: function () {
                this.form =
                    {
                        branche_name: '',
                        branche_nameen: '',
                        adress: '',
                        addressen: '',
                        long: '',
                        lat: '',
                        brances_phone: [{
                            phone_type: '',
                            hone_typeen: '',
                            phone: ''
                        }]
                    }
            },
            pushinarray: function () {
                var self = this;
                self.form.brances_phone.push({
                    phone_type: '',
                    hone_typeen: '',
                    phone: ''
                })

            },
            handleDelete: function (index, row) {
                console.log(index, row);
                var self = this;
                $.ajax({
                    url: self.url + "/deletebranche/" + row.branches_id,
                    method: 'get'
                }).done(function (result) {
                    console.log(result);
                    self.$message({
                        showClose: true,
                        message: 'تم الحذف  بنجاح',
                        type: 'success'
                    });

                    Branches.BranchesData.splice(index, 1);
                });

            }
            ,
            handleDeleteBranchesPhone: function (index, row) {
                console.log(index, row);
                var self = this;
                $.ajax({
                    url: self.url + "/deletebranchephone/" + row.branches_id,
                    method: 'get'
                }).done(function (result) {
                    console.log(result);
                    self.$message({
                        showClose: true,
                        message: 'تم الحذف  بنجاح',
                        type: 'success'
                    });

                    Branches.BranchesData.splice(index, 1);
                });

            }
        }
    })
;