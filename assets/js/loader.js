const showLoading = function() {
    swal({
        icon: '../../assets/images/Loading-.gif',
        button:false,
        closeOnEsc:false,
        closeOnClickOutside: false,
        timer: 2000,
        onOpen: () => {
            swal.showLoading();
        }
    })
};