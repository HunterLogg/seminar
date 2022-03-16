$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function editCategory(url){
    window.location.href = url;
}

function removeCategory(id,url){
    $.confirm({
        title: "Do you want delete!",
        buttons: {
            confirm : {
                btnClass: "btn-danger" ,
                keys: ["enter", "shift"],
                action : function (e) {
                    $.ajax({
                        type: 'DELETE',
                        dataType: 'JSON',
                        data: {id},
                        url: url,
                        success: function(result){
                            if(result === 1){
                                $.alert("Delete success!");
                                location.reload();
                            }
                        }
                    })
                },
            },
            cancel: function () {
                $.alert("Canceled!");
            }
        }
    });
}

function detailCategory(id,url) {
    $.confirm({
        title: "Infomation Category",
        content:function(){
            var self = this;
            self.setContent("Category Name : ");
            return $.ajax({
                method: "GET",
                dataType: 'JSON',
                url: url,
                data : id,
            }).done(function (response) {
                self.setContentAppend(response.name)
                self.setContentAppend('<br>Description: ' + response.description)
                self.setContentAppend('<br>content: ' + response.content)
                let active = response.active == '1' ? true : false
                self.setContentAppend('<br>Active: ' + active)

            })
        }
    })
}


function editBrand(url){
    window.location.href = url;
}

function removeBrand(id,url){
    $.confirm({
        title: "Do you want delete!",
        buttons: {
            confirm : {
                btnClass: "btn-danger" ,
                keys: ["enter", "shift"],
                action : function (e) {
                    $.ajax({
                        type: 'DELETE',
                        dataType: 'JSON',
                        data: {id},
                        url: url,
                        success: function(result){
                            if(result === 1){
                                $.alert("Delete success!");
                                location.reload();
                            }
                        }
                    })
                },
            },
            cancel: function () {
                $.alert("Canceled!");
            }
        }
    });
}

function detailBrand(id,url) {
    $.confirm({
        title: "Infomation Category",
        content:function(){
            var self = this;
            self.setContent("Category Name : ");
            return $.ajax({
                method: "GET",
                dataType: 'JSON',
                url: url,
                data : id,
            }).done(function (response) {
                self.setContentAppend(response.name)
                self.setContentAppend('<br>Description: ' + response.description)
                self.setContentAppend('<br>content: ' + response.content)
                let active = response.active == '1' ? true : false
                self.setContentAppend('<br>Active: ' + active)

            })
        }
    })
}


function editProduct(url){
    window.location.href = url;
}

function removeProduct(id,url){
    $.confirm({
        title: "Do you want delete!",
        buttons: {
            confirm : {
                btnClass: "btn-danger" ,
                keys: ["enter", "shift"],
                action : function (e) {
                    $.ajax({
                        type: 'DELETE',
                        dataType: 'JSON',
                        data: {id},
                        url: url,
                        success: function(result){
                            if(result === 1){
                                $.alert("Delete success!");
                                location.reload();
                            }
                        }
                    })
                },
            },
            cancel: function () {
                $.alert("Canceled!");
            }
        }
    });
}

function detailProduct(id,url) {
    $.confirm({
        title: "Infomation Category",
        content:function(){
            var self = this;
            self.setContent("Category Name : ");
            return $.ajax({
                method: "GET",
                dataType: 'JSON',
                url: url,
                data : id,
            }).done(function (response) {
                self.setContentAppend(response.name)
                self.setContentAppend('<br>Description: ' + response.description)
                self.setContentAppend('<br>Price: ' + response.price)
                let active = response.active == '1' ? true : false
                self.setContentAppend('<br>Active: ' + active)

            })
        }
    })
}

function editCart(url){
    window.location.href = url;
}

function removeCart(id,url){
    $.confirm({
        title: "Do you want delete!",
        buttons: {
            confirm : {
                btnClass: "btn-danger" ,
                keys: ["enter", "shift"],
                action : function (e) {
                    $.ajax({
                        type: 'DELETE',
                        dataType: 'JSON',
                        data: {id},
                        url: url,
                        success: function(result){
                            if(result === 1){
                                $.alert("Delete success!");
                                location.reload();
                            }
                        }
                    })
                },
            },
            cancel: function () {
                $.alert("Canceled!");
            }
        }
    });
}

function detailCart(id,url) {
    $.confirm({
        title: "Infomation Category",
        content:function(){
            var self = this;
            self.setContent("Product Name : ");
            return $.ajax({
                method: "GET",
                dataType: 'JSON',
                url: url,
                data : id,
            }).done(function (response) {
                self.setContentAppend(response.name)
                self.setContentAppend('<br>User: ' + response.user_id)
                self.setContentAppend('<br>Price: ' + response.price + ' VND')
                self.setContentAppend('<br>Quantity: ' + response.qty)
                var total = response.qty * response.price
                self.setContentAppend('<br>Total: ' + total + ' VND')

            })
        }
    })
}

function viewOrder(url){
    window.location.href = url;
}

function removeOrder(id,url){
    $.confirm({
        title: "Do you want delete!",
        buttons: {
            confirm : {
                btnClass: "btn-danger" ,
                keys: ["enter", "shift"],
                action : function (e) {
                    $.ajax({
                        type: 'DELETE',
                        dataType: 'JSON',
                        data: {id},
                        url: url,
                        success: function(result){
                            if(result === 1){
                                $.alert("Delete success!");
                                location.reload();
                            }
                        }
                    })
                },
            },
            cancel: function () {
                $.alert("Canceled!");
            }
        }
    });
}


function detailOrder(url) {
    var id = 0
    $.confirm({
        title: "Infomation Category",
        content:function(){
            var self = this;
            self.setContent("Product Name : ");
            return $.ajax({
                method: "GET",
                dataType: 'JSON',
                url: url,
                data : id,
            }).done(function (response) {
                self.setContentAppend(response[0].name)
                self.setContentAppend('<br>Total Price	: ' + response[0].order_total + ' VND')
                self.setContentAppend('<br>Status	: ' + response[0].order_status )
            })
        }
    })
}

function shipping(shipping_id, value, ok ,url) {
    $.ajax({
        type: 'GET',
        dataType: 'JSON',
        data: {value, shipping_id, ok},
        url: url,
        success: function(result){
            console.log(result);
            if(result === 1){
                $.alert(value);
                location.reload();
            }
        }
    })
}

function editUser(url){
    window.location.href = url;
}

// function detailOrder(url) {
//     $.confirm({
//         title: "Infomation Category",
//         content:function(){
//             var self = this;
//             self.setContent("Customer Name : ");
//             return $.ajax({
//                 method: "GET",
//                 dataType: 'JSON',
//                 url: url,
//             }).done(function (response) {
//                 console.log(response)
//                 // self.setContentAppend(response.name)
//                 // self.setContentAppend('<br>Total Price	: ' + response.total + ' VND')
//                 // self.setContentAppend('<br>Status	: ' + response.status )

//             })
//         }
//     })
// }