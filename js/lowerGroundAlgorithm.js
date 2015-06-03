var Instructions = "";


function constructInstructions(FROM,TO,Start,End)
{
    if (FROM == "LT" && TO == "R1T") {
        Instructions = "From "+Start+" head straight down the corridor towards the lunch hall.\n Turn right at the end of the corridor,
                        continue past the lift through the double doors and straight on past the lunch hall.\n Before the downward ramp make a
                        right then continue straight on down the corridor.\n Turn left at the end and continue straight through the double doors.\n
                        The room you are searching for ("+End+") is in this location. ";
        displayInstructions();}

    if (FROM == "R1T" && TO == "LT") {
        Instructions = "From "+Start+" head straight down the corridor through the double doors.\n Turn right at the end of the corridor,
                        continue straight on.\n Make a right then continue straight on past the lunch hall towards the double doors and straight through.\n 
                        Turn left at the end and continue straight through the double doors.\n
                        The room you are searching for ("+End+") is in this location. ";
        displayInstructions();}

}
 
