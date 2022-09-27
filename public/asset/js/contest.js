var Contest = new function __Contest() {

}

Contest.form = new function __ContestForm() {

    this.create = function() {
        console.log($('#start-time').val(), $('#end-time').val());
        console.log(Date.parse($('#start-time').val()));
        var d = new Date(Date.parse($('#start-time').val()));
        console.log(d);
        console.log(Date.parse(d));
    }
}