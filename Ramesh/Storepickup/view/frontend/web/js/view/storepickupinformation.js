define([
    'jquery',
    'Magento_Ui/js/modal/modal',
    'ko',
    'uiComponent'
], function ($, modal, ko, Component) {
    'use strict';
    setInterval(loadstoreDetails, 1000);
    var functioncallcount = 0;
    var labelcallingcount = 0;
    var ajaxcallcount = 0;
    return Component.extend({
        defaults: {
            template: 'Ramesh_Storepickup/storepickupinformation'
        }
    });

    function bindeventtoshippingmethod()
    {
        var checkoutData = "";
        var myobj = localStorage.getItem('mage-cache-storage');
        myobj = JSON.parse(myobj);
        $.each(myobj, function (key, value)
        {
            if (key == 'checkout-data')
            {
                checkoutData = value;
            }
        });
        return checkoutData;
    }
    function loadstoreDetails()
    {
        var tablerows = $("#checkout-shipping-method-load table tr");

        if ($("#row_carrier_storepickup_storepickup").length == 0)
        {
            try
            {
                for (var i = 0; i < tablerows.length; i++)
                {
                    if (i != 0)
                    {

                        var row = tablerows[i];
                        var rowlable = $(row).find("td.col-carrier").attr("id").replace("label", 'row');
                        $(row).attr("id", rowlable);
                    }
                }
            }
            catch (e) {
                return true;
            }

        }
        else
        {
            if ($("#table_carrier_storepickup_storepickup").length == 0)
            {
                $("#row_carrier_storepickup_storepickup").after('<tr class="storepickup_div_template"><td colspan="3" id="table_carrier_storepickup_storepickup">Please Wait .........</td></tr>');
                functioncallcount = 0;
                getstoreInformation();
            }
        }

    }
    function getstoreInformation()
    {

        if ($("#table_carrier_storepickup_storepickup").length)
        {
            $("#table_carrier_storepickup_storepickup").html("Please Wait .........");
        }
        var tablerows = $("#checkout-shipping-method-load table tr");
        var rendertemplate = $("#storepickup_template_render").html();
        if (!$('#eventbinding').length)
        {
            $(".shipping-address-items").after("<input type='hidden' id='eventbinding' value='1'>");
            $(".action-select-shipping-item").click(function (e) {
                functioncallcount++;
                getstoreInformation();
            });
        }
        for (var i = 0; i < tablerows.length; i++)
        {
            if (i != 0)
            {
                try
                {
                    var row = tablerows[i];
                    var rowlable = $(row).find("td.col-carrier").attr("id").replace("label", 'row');
                    $(row).attr("id", rowlable);
                    $(row).click(function (e) {
                        showstoreinformation(e);
                    });
                }
                catch (e) {
                    //return true;
                }
            }
        }
        $("#setcustommethodload").val(functioncallcount);

        var checkoutData = bindeventtoshippingmethod();
        var selectedShippingRate = checkoutData.selectedShippingRate;
        var selectedShippingAddress = checkoutData.selectedShippingAddress;
        var shippingAddressFromData = checkoutData.shippingAddressFromData;
        if (selectedShippingAddress == null)
        {
            selectedShippingAddress = window.checkoutConfig.customerData.default_shipping;
        }
        else if (selectedShippingAddress == 'new-customer-address')
        {
            selectedShippingAddress = "";
        }
        else
        {
            selectedShippingAddress = selectedShippingAddress.replace("customer-address", '');
        }
        var baseUrl = window.checkoutConfig.checkoutUrl.replace("checkout/", "storepickup/store/details");
        $.ajax({
            url: baseUrl,
            data: "&selectedShippingAddress=" + selectedShippingAddress + "&shippingAddressFromData=" + JSON.stringify(checkoutData.shippingAddressFromData),
            success: function (responsedata)
            {
                var renderoutputtemplate = "";
                var result = responsedata.result;
                $.each(result, function (key, storedata)
                {
                    var temprendertemplate = rendertemplate;
                    temprendertemplate = replaceAll(temprendertemplate, "{{ID}}", storedata.id);
                    temprendertemplate = replaceAll(temprendertemplate, "{{ID}}", storedata.id);
                    temprendertemplate = replaceAll(temprendertemplate, "{{ID}}", storedata.id);
                    temprendertemplate = replaceAll(temprendertemplate, "{{ID}}", storedata.id);
                    temprendertemplate = replaceAll(temprendertemplate, "{{ID}}", storedata.id);
                    temprendertemplate = replaceAll(temprendertemplate, "{{NAME}}", storedata.name);
                    temprendertemplate = replaceAll(temprendertemplate, "{{CODE}}", storedata.short_code);
                    temprendertemplate = replaceAll(temprendertemplate, "{{STREET1}}", storedata.street1);
                    temprendertemplate = replaceAll(temprendertemplate, "{{STREET2}}", storedata.street2);
                    temprendertemplate = replaceAll(temprendertemplate, "{{CITY}}", storedata.city);
                    temprendertemplate = replaceAll(temprendertemplate, "{{STATE}}", storedata.state);
                    temprendertemplate = replaceAll(temprendertemplate, "{{COUNTRY}}", storedata.country);
                    temprendertemplate = replaceAll(temprendertemplate, "{{POSTALCODE}}", storedata.postalcode);
                    temprendertemplate = replaceAll(temprendertemplate, "{{LATITUDE}}", storedata.latitude);
                    temprendertemplate = replaceAll(temprendertemplate, "{{LONGITUDE}}", storedata.longitude);
                    temprendertemplate = replaceAll(temprendertemplate, "{{NAME}}", storedata.name);
                    temprendertemplate = replaceAll(temprendertemplate, "{{CODE}}", storedata.short_code);
                    temprendertemplate = replaceAll(temprendertemplate, "{{STREET1}}", storedata.street1);
                    temprendertemplate = replaceAll(temprendertemplate, "{{STREET2}}", storedata.street2);
                    temprendertemplate = replaceAll(temprendertemplate, "{{CITY}}", storedata.city);
                    temprendertemplate = replaceAll(temprendertemplate, "{{STATE}}", storedata.state);
                    temprendertemplate = replaceAll(temprendertemplate, "{{COUNTRY}}", storedata.country);
                    temprendertemplate = replaceAll(temprendertemplate, "{{POSTALCODE}}", storedata.postalcode);
                    temprendertemplate = replaceAll(temprendertemplate, "{{LATITUDE}}", storedata.latitude);
                    temprendertemplate = replaceAll(temprendertemplate, "{{LONGITUDE}}", storedata.longitude);

                    renderoutputtemplate += temprendertemplate;

                });
                if ($("#table_carrier_storepickup_storepickup").length)
                {
                    $("#table_carrier_storepickup_storepickup").html(renderoutputtemplate);
                }
                else
                {
                    $("#row_carrier_storepickup_storepickup").after('<tr class="storepickup_div_template"><td colspan="3" id="table_carrier_storepickup_storepickup">' + renderoutputtemplate + '</td></tr>');
                }

                if (selectedShippingRate == 'storepickup_storepickup')
                {
                    $("#table_carrier_storepickup_storepickup").show();
                }
                else
                {
                    $("#table_carrier_storepickup_storepickup").hide();
                }
                $("input[name='store_id']").click(function (e) {
                    showStoreInformation(e.toElement.value);
                    saveStoreInformation(e.toElement.value);
                });
                $(".store_more").click(function (e) {
                    showStoreInformation(e.toElement.id.replace('store_more__', ''));
                });

                functioncallcount = 0;
            }
        });
    }
    function saveStoreInformation(storeid)
    {
        storeid=parseInt(storeid);
        console.log(storeid);
    }
    function showstoreinformation(eventData)
    {

        var selectedshippingrowid = $(eventData.currentTarget).attr("id");
        if (selectedshippingrowid == 'row_carrier_storepickup_storepickup')
        {
            $("#table_carrier_storepickup_storepickup").show();
        }
        else
        {
            $("#table_carrier_storepickup_storepickup").hide();
        }
    }
    function showStoreInformation(storeid)
    {
        var options = {
            type: 'popup',
            responsive: true,
            innerScroll: true,
            title: 'Store Information',
        };

        var idname = '#storepickup_information_' + parseInt(storeid);
        $("#popup_store_information").html($(idname).html());

        var popup = modal(options, $("#popup_store_information"));
        $("#popup_store_information").modal('openModal');
    }
    function replaceAll(stringforreplace, findtext, replacevalue)
    {
        if (replacevalue == null)
        {
            replacevalue = "";
        }
        try
        {
            stringforreplace = stringforreplace.replace(findtext, replacevalue);
            if (stringforreplace.contains(findtext))
            {
                stringforreplace = replaceAll(stringforreplace, findtext, replacevalue);
            }
        }
        catch (e)
        {

        }
        return stringforreplace;
    }
});
