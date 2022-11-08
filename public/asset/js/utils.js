var Utils = new function __Utils() {
    
    this.datetime_to_int = function(datetime) {
        return Date.parse(datetime) / 1000;
    }

    this.int_to_datetime = function(int) {
        return new Date(int * 1000).toString().substring(0, 25);
    }

}