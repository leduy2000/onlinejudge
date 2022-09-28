var Utils = new function __Utils() {
    
    this.datetime_to_int = function(datetime) {
        return Date.parse(datetime) / 1000;
    }
}