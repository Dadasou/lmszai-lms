window.InitUserScripts = function()
{
var player = GetPlayer();
var object = player.object;
var addToTimeline = player.addToTimeline;
var setVar = player.SetVar;
var getVar = player.GetVar;
window.Script1 = function()
{
  //Results

var player = GetPlayer(); //get the Storyline player
var userid =  player.GetVar("userid") ;
var progress = player.GetVar("progress");
var courseid =  player.GetVar("courseId");
var result = player.GetVar("result");
var quizattempts = player.GetVar("quizattempts");
var topic1 =  player.GetVar("topic1");
var topic2 =  player.GetVar("topic2");
var topic3 =  player.GetVar("topic3");
var topic4 =  player.GetVar("topic4");
var topic5 =  player.GetVar("topic5");
var topic6 =  player.GetVar("topic6");

var url ="https://namcor.training/api/course_progress/update_progress.php?userid=" + userid + "&progress=" + progress + "&courseid=" + courseid + "&result=" + result + "&quizattempts=" + quizattempts + "&topic1=" + topic1 + "&topic2=" + topic2 + "&topic3=" + topic3 + "&topic4=" + topic4 + "&topic5=" + topic5 + "&topic6=" + topic6;
var xhReq = new XMLHttpRequest();
		 
xhReq.open("GET", url, false);
xhReq.send(null);
var serverResponse = xhReq.responseText;
var data = JSON.parse(serverResponse);
console.log(data);

if (data.result == 'success') {
  //Set-Userid, courseid, progress, quizattempts,topic1,topic2,topic3,topic4,topic5,topic6
  player.SetVar("Extra", 1);
} else {
  player.SetVar("Extra", 0);
} 
}

};
