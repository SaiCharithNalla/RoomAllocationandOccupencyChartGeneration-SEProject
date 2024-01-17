


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>ROOM ALLOCATION</title>

    <!-- <style type="text/css">
        p, body, td, input, select, button { font-family: -apple-system,system-ui,BlinkMacSystemFont,'Segoe UI',Roboto,'Helvetica Neue',Arial,sans-serif; font-size: 14px; }
        body { padding: 0px; margin: 0px; background-color: #ffffff; }
        a { color: #1155a3; }
        .space { margin: 10px 0px 10px 0px; }
        .header { background: #003267; background: linear-gradient(to right, #011329 0%,#00639e 44%,#011329 100%); padding:20px 10px; color: white; box-shadow: 0px 0px 10px 5px rgba(0,0,0,0.75); }
        .header a { color: white; }
        .header h1 a { text-decoration: none; }
        .header h1 { padding: 0px; margin: 0px; }
        .main { padding: 10px; margin-top: 10px; }
    </style> -->

    <!-- DayPilot library -->
    <script src="js/daypilot/daypilot-all.min.js"></script>

    <link type="text/css" rel="stylesheet" href="icons/style.css" />

    <style type="text/css">
        div[style="position: absolute; padding: 2px; top: 0px; left: 1px; background-color: rgb(255, 102, 0); color: white;"] {
        display: none;
        }
        body {
            background-image: url("https://cdn.pixabay.com/photo/2016/01/13/16/21/sky-1138257_960_720.jpg")
        }
        select {
            padding: 5px;
        }

        .toolbar {
            margin: 10px 0px;
        }

        .toolbar button {
            padding: 5px 15px;
        }

        .icon {
            font-size: 14px;
            text-align: center;
            line-height: 14px;
            vertical-align: middle;

            cursor: pointer;
        }

        .toolbar-separator {
            width: 1px;
            height: 28px;
            /*content: '&nbsp;';*/
            display: inline-block;
            box-sizing: border-box;
            background-color: #ccc;
            margin-bottom: -8px;
            margin-left: 15px;
            margin-right: 15px;
        }

        .scheduler_default_rowheader_inner
        {
            border-right: 1px solid #ccc;
        }
        .scheduler_default_rowheadercol2
        {
            background: White;
        }
        .scheduler_default_rowheadercol2 .scheduler_default_rowheader_inner
        {
            top: 2px;
            bottom: 2px;
            left: 2px;
            background-color: transparent;
            border-left: 5px solid #38761d; /* green */
            border-right: 0px none;
        }
        .status_dirty.scheduler_default_rowheadercol2 .scheduler_default_rowheader_inner
        {
            border-left: 5px solid #cc0000; /* red */
        }
        .status_Maintance.scheduler_default_rowheadercol2 .scheduler_default_rowheader_inner
        {
            border-left: 5px solid #e69138; /* orange */
        }

        .area-menu {
            background-image: url("data:image/svg+xml,%3Csvg width='10' height='10' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M 0.5 1.5 L 5 6.5 L 9.5 1.5' style='fill:none;stroke:%23999999;stroke-width:2;stroke-linejoin:round;stroke-linecap:butt' /%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: center center;
            border: 1px solid #ccc;
            background-color: #fff;
            border-radius: 3px;
            opacity: 0.8;
            cursor: pointer;
        }

        .area-menu:hover {
            opacity: 1;
        }

    </style>
    
</head>
<body>
    
</div>
<div class="main">
    <div style="width:220px; float:left;">
        <div id="nav"></div>
    </div>

    <div style="margin-left: 220px;">

        <div class="toolbar">

            Room filter:
            <select id="filter">
                <option value="0">All</option>
                <option value="71">Single</option>
                <option value="120">Seminar</option>
                <option value="400">Hall</option>
            </select>

            &nbsp;&nbsp;

            <button id="addroom">Add Room</button>
            <div class="toolbar-separator"></div>

            <!-- Time range: -->
            <select id="timerange" style="display: none;">
                <option value="week" selected>Week</option>
                <option value="month" selected>Month</option>
            </select>
            <!-- <div class="toolbar-separator"></div> -->
            <label for="autocellwidth"><input type="checkbox" id="autocellwidth">Auto Cell Width</label>

        </div>

        <div id="dp"></div>
        

    </div>

</div>

<script type="text/javascript">
    const nav = new DayPilot.Navigator("nav");
    nav.selectMode = "day";
    nav.showMonths = 3;
    nav.skipMonths = 3;
    nav.onTimeRangeSelected = function(args) {
        // loadTimeline(args.start);
        // dp.update();
        // loadReservations();
        dp.startDate = args.start;

        dp.update();
    };
    nav.init();

</script>

<script>
    
    const dp = new DayPilot.Scheduler("dp");
    


    dp.allowEventOverlap = false;

    dp.days = 1;

    dp.eventDeleteHandling = "Update";

    dp.timeHeaders = [
        { groupBy: "Day", format: "d" },
        { groupBy: "Hour"}
    ];

    dp.eventHeight = 80;
    dp.cellWidth = 260;

    dp.rowHeaderColumns = [
        {title: "Room", display: "name", sort: "name"},
        {title: "Capacity", display: "capacity", sort: "capacity"},
        {title: "Status", display: "status", sort: "status"}
    ];

    dp.separators = [
        { location: DayPilot.Date.now(), color: "red" }
    ];

    dp.contextMenuResource = new DayPilot.Menu({
        items: [
            { text: "Edit...", onClick: async (args) => {
                    const capacities = [
                        {name: "71", id: 71},
                        {name: "120", id: 120},
                        {name: "400", id: 400},
                    ];

                    const statuses = [
                        {name: "Available", id: "Available"},
                        {name: "Maintance", id: "Maintance"},
                        {name: "Dirty", id: "Dirty"},
                    ];

                    const form = [
                        {name: "Room Name", id: "name"},
                        {name: "Capacity", id: "capacity", options: capacities},
                        {name: "Status", id: "status", options: statuses}
                    ];

                    const data = args.source.data;

                    const modal = await DayPilot.Modal.form(form, data);
                    if (modal.canceled) {
                        return;
                    }

                    const room = modal.result;
                    await DayPilot.Http.post("backend_room_update.php", room);
                    dp.rows.update(room);
                }},
            { text: "Delete", onClick: async (args) => {
                    const id = args.source.id;

                    await DayPilot.Http.post("backend_room_delete.php", {id: id});
                    dp.rows.remove(id);
                }
            }
        ]
    });

    dp.onBeforeRowHeaderRender = (args) => {
        const beds = (count) => {
            return count + " person" + (count > 1 ? "s" : "");
        };

        args.row.columns[1].html = beds(args.row.data.capacity);
        switch (args.row.data.status) {
            case "Dirty":
                args.row.cssClass = "status_dirty";
                break;
            case "Maintance":
                args.row.cssClass = "status_Maintance";
                break;
        }

        args.row.columns[0].areas = [
            {right: 3, top: 3, width: 16, height: 16, cssClass: "area-menu", action: "ContextMenu", visibility: "Hover"}
        ];

    };

    // http://api.daypilot.org/daypilot-scheduler-oneventmoved/
    dp.onEventMoved = async (args) => {
        const params = {
            id: args.e.id(),
            newStart: args.newStart,
            newEnd: args.newEnd,
            newResource: args.newResource
        };

        const {data} = await DayPilot.Http.post("backend_reservation_move.php", params);
        dp.message(data.message);

    };

    // http://api.daypilot.org/daypilot-scheduler-oneventresized/
    dp.onEventResized = async (args) => {
        const params = {
            id: args.e.id(),
            newStart: args.newStart,
            newEnd: args.newEnd
        };

        const {data} = await DayPilot.Http.post("backend_reservation_resize.php", params);
        dp.message("Resized");

    };

    dp.onEventDeleted = async (args) => {
        await DayPilot.Http.post("backend_reservation_delete.php", {id: args.e.id()});
        dp.message("Deleted.");
    };


    // event creating
    // http://api.daypilot.org/daypilot-scheduler-ontimerangeselected/
    dp.onTimeRangeSelected = async (args) => {
        // if (isAdmin()) {
        //     return;
        // }
        const rooms = dp.resources.map((item) => {
            return {
                name: item.name,
                id: item.id
            };
        });
        
        const form = [
            {name: "Text", id: "text"},
            {name: "Start", id: "start", dateFormat: "MM/dd/yyyy HH:mm tt"},
            {name: "End", id: "end", dateFormat: "MM/dd/yyyy HH:mm tt"},
            // {name: "Room", id: "resource", options: rooms},
        ];

        const data = {
            start: args.start,
            end: args.end,
            resource: args.resource
        };

        const modal = await DayPilot.Modal.form(form, data);

        dp.clearSelection();
        if (modal.canceled) {
            return;
        }
        const e = modal.result;

        const {data: result} = await DayPilot.Http.post("backend_reservation_create.php", e);

        e.id = result.id;
        e.status = result.status;
        dp.events.add(e);

    };

    dp.onEventClick = async (args) => {
        // if (isAdmin()) {
        //     return;
        // }
        const rooms = dp.resources.map((item) => {
            return {
                name: item.name,
                id: item.id
            };
        });

        const statuses = [
            {name: "New", id: "New"},
            // {name: "Confirmed", id: "Confirmed"},
            // {name: "Arrived", id: "Arrived"},
            // {name: "CheckedOut", id: "CheckedOut"}
            {name: "Blocked", id: "Blocked"}
        ];


        const form = [
            {name: "Text", id: "text"},
            {name: "Start", id: "start", dateFormat: "MM/dd/yyyy h:mm tt"},
            {name: "End", id: "end", dateFormat: "MM/dd/yyyy h:mm tt"},
            // {name: "Room", id: "resource", options: rooms},
            {name: "Status", id: "status", options: statuses},
            // {name: "Paid", id: "paid", options: paidoptions},
        ];

        const data = args.e.data;
        
        const modal = await DayPilot.Modal.form(form, data);

        dp.clearSelection();
        if (modal.canceled) {
            return;
        }
        const e = modal.result;
        await DayPilot.Http.post("backend_reservation_update.php", e);
        dp.events.update(e);
    };


    dp.onBeforeEventRender = async (args) => {
        const start = new DayPilot.Date(args.data.start);
        const end = new DayPilot.Date(args.data.end);

        const today = DayPilot.Date.today();
        const now = new DayPilot.Date();

        args.data.html = DayPilot.Util.escapeHtml(args.data.text) ;
        // + " (" + start.toString("M/d/yyyy") + " - " + end.toString("M/d/yyyy") + ")";
        switch (args.data.status) {
            case "New":
                const in2days = today.addDays(1);

                if (start < in2days) {
                    args.data.barColor = '#cc0000';
                    args.data.toolTip = 'Expired (not confirmed in time)';
                }
                else {
                    args.data.barColor = '#e69138';
                    const roomId = args.data.resource;










                    
                    const { status } = await DayPilot.Http.post("database_fetch.php", { id: roomId });
                    console.log(status);

                    args.data.toolTip = `Value retrieved from the database: `;
                }
                    break;
            case "Confirmed":
                const arrivalDeadline = today.addHours(18);

                if (start < today || (start.getDatePart() === today.getDatePart() && now > arrivalDeadline)) { // must arrive before 6 pm
                    args.data.barColor = "#cc4125";  // red
                    args.data.toolTip = 'Late arrival';
                }
                else {
                    args.data.barColor = "#38761d";
                    args.data.toolTip = "Confirmed";
                }
                break;
            case 'Arrived': // arrived
                const checkoutDeadline = today.addHours(10);

                if (end < today || (end.getDatePart() === today.getDatePart() && now > checkoutDeadline)) { // must checkout before 10 am
                    args.data.barColor = "#cc4125";  // red
                    args.data.toolTip = "Late checkout";
                }
                else
                {
                    args.data.barColor = "#1691f4";  // blue
                    args.data.toolTip = "Arrived";
                }
                break;
            case 'CheckedOut': // checked out
                args.data.barColor = "gray";
                args.data.toolTip = "Checked out";
                break;
            case 'blocked': // checked out
                args.data.barColor = "gray";
                args.data.toolTip = "Blocked";
                break;
            default:
                args.data.toolTip = "Unexpected state";
                break;
        }

        args.data.html = "<div>" + args.data.html + "<br /><span style='color:gray'>" + args.data.toolTip + "</span></div>";

        // const paid = args.data.paid;
        // const paidColor = "#aaaaaa";

        // args.data.areas = [
        //     { bottom: 10, right: 4, html: "<div style='color:" + paidColor + "; font-size: 8pt;'>Paid: " + paid + "%</div>", v: "Visible"},
        //     { left: 4, bottom: 8, right: 4, height: 2, html: "<div style='background-color:" + paidColor + "; height: 100%; width:" + paid + "%'></div>", v: "Visible" }
        // ];

    };



    dp.init();

    const elements = {
        filter: document.querySelector("#filter"),
        timerange: document.querySelector("#timerange"),
        autocellwidth: document.querySelector("#autocellwidth"),
        addroom: document.querySelector("#addroom"),
    };

    loadRooms();
    loadReservations();

    function loadTimeline(date) {
        dp.scale = "Manual";
        dp.timeline = [];
        const start = date.getDatePart().addHours(12);

        for (let i = 0; i < dp.days; i++) {
            dp.timeline.push({start: start.addDays(i), end: start.addDays(i+1)});
        }
    }

    function loadReservations() {
        // session_start(); 
        // console.log(dp.startDate);
        // dp.events.load("backend_reservations.php");
        // dp.events.load("backend_reservations.php?date=" + args.start);
        nav.onTimeRangeSelected = function(args) {
            console.log("Selected Date: " +args.start);
            var inputDate = args.start;
            dp.events.load("backend_reservations.php?date=" + args.start);
            dp.startDate = args.start;

            dp.update();
            
        }
        // console.log("Selected Date: " +dp.startDate);
        //     // var inputDate = args.start;
        //     dp.events.load("backend_reservations.php?date=" +dp.startDate);
    }

    async function loadRooms() {
        const {data} = await DayPilot.Http.post("backend_rooms.php", { capacity: elements.filter.value });
        dp.resources = data;
        dp.update();
    }

    elements.filter.addEventListener("change", (e) => {
        loadRooms();
    });

    elements.timerange.addEventListener("change", () => {
        // switch (this.value) {
        //     case "week":
        //         dp.days = 7;
        //         nav.selectMode = "Week";
        //         nav.select(nav.selectionDay);
        //         break;
        //     case "month":
        //         dp.days = dp.startDate.daysInMonth();
        //         nav.selectMode = "Month";
        //         nav.select(nav.selectionDay);
        //         break;
        // }
        dp.days = 1;
        nav.selectMode = "Day";
        nav.select(nav.selectionDay);
    });

    elements.autocellwidth.addEventListener("click", () => {
        dp.cellWidth = 60;  // reset for "Fixed" mode
        dp.cellWidthSpec = this.checked ? "Auto" : "Fixed";
        dp.update();
    });

    elements.addroom.addEventListener("click", async (ev) => {
        ev.preventDefault();

        const capacities = [
            {name: "71", id: 71},
            {name: "120", id: 120},
            {name: "400", id: 400},
        ];

        const form = [
            {name: "Room Name", id: "name"},
            {name: "Capacity", id: "capacity", options: capacities}
        ];

        const data = {
            capacity: 2
        };

        const modal = await DayPilot.Modal.form(form, data);
        if (modal.canceled) {
            return;
        }

        const room = modal.result;
        const {data: result} = await DayPilot.Http.post("backend_room_create.php", room);

        room.id = result.id;
        room.status = result.status;
        dp.resources.push(room);
        dp.update();

    });


</script>


</body>
</html>
