// Welcome heading
var welcomeHeading = document.getElementById("welcome-heading");
// var welcomeHeadingContent = "ইজি কোচিং সেন্টার";
var welcomeHeadingContent = "EASY COACHING CENTER";
var i = 0;

function annimation1() {
    if (i > (welcomeHeadingContent.length - 1)) {
        return 0;
    }
    // if (i > 10) {
    //     welcomeHeading.lastElementChild.innerHTML += welcomeHeadingContent.charAt(i);
    // }
    else {
        // welcomeHeading.firstElementChild.innerHTML += welcomeHeadingContent.charAt(i);
        welcomeHeading.lastElementChild.innerHTML += welcomeHeadingContent.charAt(i);
    }
    i++;
}
setInterval('annimation1()', 130);





