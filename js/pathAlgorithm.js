var roomStart;
var roomEnd;
var currentPosition = "";
var startedRoute = false;

//LT = LeftTop

function findRoute() {
if (roomStart == "LB" && startedRoute == false) {
    DrawPath(roomStart, "point1");
    currentPosition = "point1";
    startedRoute = true;

    if (roomEnd == "LB") {
        DrawPath(currentPosition, roomEnd);
        startedRoute = false;
    }
    else{
        DrawPath(currentPosition, "point2")
        currentPosition = "point2";
        DrawPath(currentPosition,"point3")
        currentPosition = "point3";
    }

    if (roomEnd == "LBM" && startedRoute == true) {
        DrawPath(currentPosition, "point4");
        currentPosition = "point4";
        DrawPath(currentPosition, roomEnd);
    }

    if (roomEnd "LTM" && startedRoute == true) {
        DrawPath(currentPosition, "point4");
        currentPosition = "point4";
        DrawPath(currentPosition, "point5");
        currentPosition = "point5";
        DrawPath(currentPosition, roomEnd);
    }

    if (roomEnd == "LT" && startedRoute == true) {
        DrawPath(currentPosition, "point4");
        currentPosition = "point4";
        DrawPath(currentPosition, "point5");
        currentPosition = "point5";
        DrawPath(currentPosition, "point6");
        currentPosition = "point6";
        DrawPath(currentPosition, "point7");
        currentPosition = "point7";
        DrawPath(currentPosition, "point8");
        currentPosition = "point8";
        DrawPath(currentPosition, roomEnd);
    }  
}
} //findroute()

function Drawpath(from, to){
    
}