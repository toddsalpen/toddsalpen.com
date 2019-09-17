$("#day").change(function(){
    var e = new Date,
        o = e.getHours(),
        m = o >= 12 ? "pm" : "am",
        p = "Sunday,Monday,Tuesday,Wednesday,Thursday,Friday,Saturday".split(",")[e.getDay()] + " " + "January,February,March,April,May,June,July,August,September,October,November,December".split(",")[e.getMonth()] + " " + e.getDate(),
        t = $("#day option:selected").text(),
        a = t.substring(0, t.length - 2),
        o = (o %= 12) ? o : 12,
        i = $("#time option:selected").text(),
        n = i.substring(i.length - 2);
    if (p == a) {
        if ("am" == n) switch (o) {
            case 7:
                $("#time  option[value='8:00 am']").remove();
            case 8:
                $("#time  option[value='8:00 am']").remove(), $("#time  option[value='9:00 am']").remove();
                break;
            case 9:
                $("#time  option[value='8:00 am']").remove(), $("#time  option[value='9:00 am']").remove(), $("#time  option[value='10:00 am']").remove();
                break;
            case 10:
                $("#time  option[value='8:00 am']").remove(), $("#time  option[value='9:00 am']").remove(), $("#time  option[value='10:00 am']").remove(), $("#time  option[value='11:00 am']").remove();
                break;
            case 11:
                $("#time  option[value='8:00 am']").remove(), $("#time  option[value='9:00 am']").remove(), $("#time  option[value='10:00 am']").remove(), $("#time  option[value='11:00 am']").remove(), $("#time  option[value='12:00 pm']").remove()
        }
        if ("pm" == m)switch ($("#time  option[value='8:00 am']").remove(), $("#time  option[value='9:00 am']").remove(), $("#time  option[value='10:00 am']").remove(), $("#time  option[value='11:00 am']").remove(), $("#time  option[value='12:00 pm']").remove(), $("#time  option[value='1:00 pm']").remove(), o) {
            case 12:
                break;
            case 1:
                $("#time  option[value='2:00 pm']").remove();
                break;
            case 2:
                $("#time  option[value='2:00 pm']").remove(), $("#time  option[value='3:00 pm']").remove();
                break;
            case 3:
                $("#time  option[value='2:00 pm']").remove(), $("#time  option[value='3:00 pm']").remove(), $("#time  option[value='4:00 pm']").remove();
                break;
            case 4:
                $("#time  option[value='2:00 pm']").remove(), $("#time  option[value='3:00 pm']").remove(), $("#time  option[value='4:00 pm']").remove(), $("#time  option[value='5:00 pm']").remove();
                break;
            default:
                $("#day option[value='" + t + "']").remove(), $("#time").empty(), $("#time").append('<option value="8:00 am">8:00 am</option>'), $("#time").append('<option value="9:00 am">9:00 am</option>'), $("#time").append('<option value="10:00 am">10:00 am</option>'), $("#time").append('<option value="11:00 am">11:00 am</option>'), $("#time").append('<option value="12:00 pm">12:00 pm</option>'), $("#time").append('<option value="1:00 pm">1:00 pm</option>'), $("#time").append('<option value="2:00 pm">2:00 pm</option>'), $("#time").append('<option value="3:00 pm">3:00 pm</option>'), $("#time").append('<option value="4:00 pm">4:00 pm</option>'), $("#time").append('<option value="5:00 pm">5:00 pm</option>'), $("#time").append('<option value="6:00 pm">6:00 pm</option>')
        }
    } else $("#time").empty(), $("#time").append('<option value="8:00 am">8:00 am</option>'), $("#time").append('<option value="9:00 am">9:00 am</option>'), $("#time").append('<option value="10:00 am">10:00 am</option>'), $("#time").append('<option value="11:00 am">11:00 am</option>'), $("#time").append('<option value="12:00 pm">12:00 pm</option>'), $("#time").append('<option value="1:00 pm">1:00 pm</option>'), $("#time").append('<option value="2:00 pm">2:00 pm</option>'), $("#time").append('<option value="3:00 pm">3:00 pm</option>'), $("#time").append('<option value="4:00 pm">4:00 pm</option>'), $("#time").append('<option value="5:00 pm">5:00 pm</option>'), $("#time").append('<option value="6:00 pm">6:00 pm</option>')
});