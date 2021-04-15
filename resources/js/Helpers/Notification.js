class Notification {

    success() {
        new Noty({
            type: 'success',
            layout: 'topRight',
            text: 'Successfully Done',
            timeout: 5000,
        }).show();
    }

    alert() {
        new Noty({
            type: 'alert',
            layout: 'topRight',
            text: 'Are you sure?',
            timeout: 5000,
        }).show();
    }

    error(msg) {
        new Noty({
            type: 'error',
            layout: 'topRight',
            text: msg != null ? msg : 'Something went wrong !',
            timeout: 5000,
        }).show();
    }

    warning() {
        new Noty({
            type: 'warning',
            layout: 'topRight',
            text: 'Oops, Wrong',
            timeout: 5000,
        }).show();
    }
}

export default Notification = new Notification();