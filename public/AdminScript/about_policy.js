var aboutPolicy = new Vue({

    el: '#about',
    data: {
        save: 'حفظ',
        aboutPolicy: [],
        url: 'http://admin.alyahyamb.com/',
        aboutPolicy: {
            about_ar: '',
            about_en: '',
            policy_ar: '',
            policy_en: ''

        }
    },
    mounted: function () {
        var self = this;
        $.ajax({
            url: self.url + "getaboutpolicy?lang=ar",
            method: 'Get'

        }).done(function (result) {

            self.aboutPolicy = result['0'];

            console.log(self.aboutPolicy);
        });
    },
    methods: {

        updateAbout: function () {
            console.log(this.aboutPolicy);
            var self = this;
            $.ajax({
                url: self.url + "updateaboutpolicy/" + 1,
                method: 'Put',
                data: self.aboutPolicy

            }).done(function (result) {
                console.log(result);


                self.$message({
                    showClose: true,
                    message: 'تم بنجاح',
                    type: 'success'
                });
                // window.location.reload()
            });
        }
    }

});