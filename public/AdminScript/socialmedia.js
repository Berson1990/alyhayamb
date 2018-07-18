var Social = new Vue({

    el: '#social',
    data: {
        save: 'حفظ',
        SoicalData: [],
        url: 'http://admin.alyahyamb.com/',
        SoicalData: {
            facebook: '',
            twitter: '',
            skype: '',
            instgram: ''

        }
    },
    mounted: function () {
        var self = this;
        $.ajax({
            url: self.url + "socialmediadata",
            method: 'Get'

        }).done(function (result) {
            console.log(result);
            self.SoicalData = result;

            console.log(self.SoicalData);
        });
    },
    methods: {

        updateAbout: function () {
            console.log(this.aboutPolicy);
            var self = this;
            $.ajax({
                url: self.url + "updatesocialmedia/" + 1,
                method: 'Put',
                data: self.SoicalData

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