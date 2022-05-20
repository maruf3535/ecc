// Signup form subjects select function.
function subSelect() {
    var selected = [];
    for (var i of document.getElementById("subjects").options) {
        if (i.selected) {
            selected.push(i.text);
        }
    }
    var str = selected.join(", ").toString();
    var subCon = document.getElementById("subjects-container");
    subCon.value = str;
}


// Admin 'Accept' and 'Delete' confirmation button function
var forms = document.getElementsByClassName("decission");
// When press 'ACCEPT' key cofirmation alert
var accepts = document.getElementsByClassName("accept");
Array.from(accepts).forEach((accept) => {
    accept.addEventListener('click', () => {
        let acpConfirm = window.confirm("Are you accept this data?");
        if (acpConfirm) {
            Array.from(forms).forEach((form) => {
                form.setAttribute("method", "POST");
            })
        }
    })
})

// When press 'REJECT' key cofirmation alert
var rejects = document.getElementsByClassName("reject");
Array.from(rejects).forEach((reject) => {
    reject.addEventListener('click', () => {
        let delConfirm = window.confirm("Are you sure to delete this pending request parmanently?");
        if (delConfirm) {
            Array.from(forms).forEach((form) => {
                form.setAttribute("method", "POST");
            })
        }
    })
})



