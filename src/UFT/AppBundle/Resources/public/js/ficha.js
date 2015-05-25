/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
jQuery(document).ready(function () {

    $("input").change(function (e) {
        try {
            this.setCustomValidity('');
        } catch (e) {
        }
    });

    $("select").change(function (e) {
        try {
            this.setCustomValidity('');
        } catch (e) {
        }
    });

    jQuery("select").attr("multiselect", function() {
        var valorAtributo = jQuery(this).attr('multiselect');
        if (valorAtributo == 'true') {
            $(this).select2();
            $(this).attr('required',"required");
        }
    });
});