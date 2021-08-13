function Tools() {

    this.validateDate = function(date) {
        var regex = new RegExp("([0-9]{4}[-](0[1-9]|1[0-2])[-]([0-2]{1}[0-9]{1}|3[0-1]{1})|([0-2]{1}[0-9]{1}|3[0-1]{1})[-](0[1-9]|1[0-2])[-][0-9]{4})");
        return regex.test(date);
    }

    this.getDateYYMMDD = function(value) {
        var parts = value.split("-");
        return parts[0] + parts[1] + parts[2];
    }

    this.getDateForma = function(value, format = "dd/mm/yyyy") {
        var parts = value.split("-");
        let today = new Date(parts[0], parts[1] - 1, parts[2]);
        return (
            format == "dd/mm/yyyy" ? (
                (today.getDate() > 9 ? today.getDate() : "0" + today.getDate()) +
                "/" +
                (today.getMonth() + 1 > 9 ?
                    today.getMonth() + 1 :
                    "0" + (today.getMonth() + 1)) +
                "/" +
                today.getFullYear()) :
            today.getFullYear() + "-" + (today.getMonth() + 1 > 9 ? today.getMonth() + 1 : "0" + (today.getMonth() + 1)) + "-" + (today.getDate() > 9 ? today.getDate() : "0" + today.getDate())
        );
    }

    this.getNull = function(value) {
        return value == null ? '' : value;
    }

    this.getTimeForma = function(value, option) {
        let ar = value.split(":");
        let hr = ar[0];
        let min = parseInt(ar[1]);
        let arsec = ar[2].split(".");
        let sec = parseInt(arsec[0]);
        if (sec < 10) {
            sec = "0" + sec;
        }
        if (min < 10) {
            min = "0" + min;
        }
        let ampm = "am";
        if (hr > 12) {
            hr -= 12;
            ampm = "pm";
        }
        return option ? (hr > 9 ? hr : "0" + hr) + ":" + min + ":" + sec + " " + ampm : hr + ":" + min + ":" + sec;
    }

    this.getTimeForma24 = function(value) {
        var hourEnd = value.indexOf(":");
        var H = +value.substr(0, hourEnd);
        var h = H % 12 || 12;
        var ampm = (H < 12 || H === 24) ? "AM" : "PM";
        return h + value.substr(hourEnd, 3) + ":" + value.substr(6, 2) + " " + ampm;
    }

    this.formatMoney = function(amount, decimalCount = 2, decimal = ".", thousands = "") {
        try {
            decimalCount = Math.abs(decimalCount);
            decimalCount = isNaN(decimalCount) ? 2 : decimalCount;

            const negativeSign = amount < 0 ? "-" : "";

            let i = parseInt(amount = Math.abs(Number(amount) || 0).toFixed(decimalCount)).toString();
            let j = (i.length > 3) ? i.length % 3 : 0;

            return negativeSign + (j ? i.substr(0, j) + thousands : '') + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" +
                thousands) + (decimalCount ? decimal + Math.abs(amount - i).toFixed(decimalCount).slice(2) : "");
        } catch (e) {
            return 0;
        }
    }

    this.getCurrentDate = function() {
        let today = new Date();
        let formatted_date = today.getFullYear() + "-" + ((today.getMonth() + 1) > 9 ? (today.getMonth() + 1) : '0' + (
            today.getMonth() + 1)) + "-" + (today.getDate() > 9 ? today.getDate() : '0' + today.getDate());
        return formatted_date;
    }

    this.getCurrentTime = function() {
        let today = new Date();
        let formatted_time = (today.getHours() > 9 ? today.getHours() : '0' + today.getHours()) + ":" + (today.getMinutes() > 9 ? today.getMinutes() : '0' + today.getMinutes()) + ":" + (today.getSeconds() > 9 ? today.getSeconds() : '0' + today.getSeconds());
        return formatted_time;
    }

    this.getCurrentMonth = function() {
        let today = new Date();
        return (today.getMonth() + 1);
    }

    this.getCurrentYear = function() {
        let today = new Date();
        return today.getFullYear();
    }

    this.diasEnUnMes = function(mes, year) {
        mes = mes.toUpperCase();
        var meses = ["ENERO", "FEBRERO", "MARZO", "ABRIL", "MAYO", "JUNIO", "JULIO", "AGOSTO", "SEPTIEMBRE", "OCTUBRE", "NOVIEMBRE", "DICIEMBRE"];
        return new Date(year, meses.indexOf(mes) + 1, 0).getDate();
    }

    this.nombreMes = function(mes) {
        let array = [
            "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
            "Julio", "Agosto", "Setiembre", "Octubre", "Noviembre", "Diciembre"
        ];
        return array[mes - 1];
    }

    this.isNumeric = function(value) {
        let number = String(value);
        if (number.trim().length === 0 || number === 'undefined')
            return false;

        if (isNaN(number.trim())) {
            return false;
        } else {
            return true;
        }
    };

    this.AlertSuccess = function(title = "", message, position = "top", align = "right") {
        $.notify({
            title: title,
            message: message
        }, {
            type: 'success',
            placement: {
                from: position,
                align: align
            },
            z_index: 2000,
        });
    }

    this.AlertWarning = function(title = "", message, position = "top", align = "right") {
        $.notify({
            title: title,
            message: message
        }, {
            type: 'warning',
            placement: {
                from: position,
                align: align
            },
            z_index: 2000,
        });
    }

    this.AlertError = function(title = "", message, position = "top", align = "right") {
        $.notify({
            title: title,
            message: message
        }, {
            type: 'error',
            placement: {
                from: position,
                align: align
            },
            z_index: 2000,
        });
    }

    this.AlertInfo = function(title = "", message, position = "top", align = "right") {
        $.notify({
            title: title,
            message: message
        }, {
            type: 'info',
            placement: {
                from: position,
                align: align
            },
            z_index: 2000,
        });
    }

    this.ModalDialog = function(title, mensaje, type, callback) {
        swal({
            title: title,
            text: mensaje,
            type: type,
            showCancelButton: true,
            confirmButtonText: "Si",
            cancelButtonText: "No",
            allowOutsideClick: false
        }).then((isConfirm) => {
            if (isConfirm.value) {
                callback(true)
            } else {
                callback(false)
            }
        });
    }

    this.ModalAlertSuccess = function(title, message) {
        swal({ title: title, text: message, type: "success", showConfirmButton: true, allowOutsideClick: false });
    }
    this.ModalAlertWarning = function(title, message) {
        swal({ title: title, text: message, type: "warning", showConfirmButton: true, allowOutsideClick: false });
    }
    this.ModalAlertError = function(title, message) {
        swal({ title: title, text: message, type: "error", showConfirmButton: true, allowOutsideClick: false });
    }
    this.ModalAlertInfo = function(title, message) {
        swal({ title: title, text: message, type: "info", showConfirmButton: false, allowOutsideClick: false, allowEscapeKey: false, });
    }
}