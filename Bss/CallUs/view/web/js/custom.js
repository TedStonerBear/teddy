require(
        [
            'jquery',
            'Magento_Ui/js/modal/modal'
        ],
        function(
            $,
            modal
        ) {
            var options = {
                type: 'popup',
                responsive: true,
                innerScroll: true,
                title: 'Contact Submit',
                buttons: false,
            };

            var popup = modal(options, $('#id01'));

            $(".callus").click(function(){
                $('#id01').modal('openModal');
            })
        }