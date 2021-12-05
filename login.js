window.addEventListener("load", event => {

    event.preventDefault();

    let fltype = {
        filtr: "all",
        type: '1',
    };
    const cleanUrl = `index.php?filter=all`.replace(/"[^-0-9+&@#/%=~_|!:,.;\(\)]"/g, '');
    fetch(cleanUrl, {
        method: 'POST',
        headers: {
            "Content-Type": "application/json",
            "Accept": "application/json",
        },
        body: JSON.stringify(fltype),
        mode: "cors"
    })

    const ermsg = document.querySelector("div#container div.inputs div.errormsg");
    const sidebar = document.querySelector("div#sidebar");

    const hmebtn = document.querySelector("button#homeRef");
    const aubtn = document.querySelector("button#addUserRef");
    const nissuebtn = document.querySelector("button#newIssueRef");
    const logoutbtn = document.querySelector("button#logoutRef");
    const Lsubbtn = document.querySelector("button#Lsubmit");
    const Usubbtn = document.querySelector("button#Usubmit");
    const Isubbtn = document.querySelector("button#Isubmit");
    const cNIssuebtn = document.querySelector("button#cnewIssues");

    const formlogin = document.querySelector("div#Login");
    const formcUser = document.querySelector("div#cUser");
    const formhome = document.querySelector("div#home");
    const formcIssue = document.querySelector("div#cIssue");
    formlogin.classList.remove("hide");
    ermsg.classList.add("hide");

    Lsubbtn.addEventListener("click", event => {
        event.preventDefault();

        const lemail = document.querySelector("input[type='email']");
        const lpw = document.querySelector("input[type='password']");

        if ((lemail.value.length != 0) && (lpw.value.length != 0)) {
            let formdata = {
                email: lemail.value,
                password: lpw.value,
            };
            const cleanUrl = `login.php?act=login`.replace(/"[^-0-9+&@#/%=~_|!:,.;\(\)]"/g, '');
            fetch(cleanUrl, {
                    method: 'POST',
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json",
                    },
                    body: JSON.stringify(formdata),
                    mode: "cors"
                })
                .then(resp => resp.text())
                .then(resp => {
                    if (parseInt(resp) == 1) {
                        formlogin.classList.add("hide");
                        formhome.classList.remove("hide");
                        sidebar.classList.remove("hide");
                    } else {
                        ermsg.classList.remove("hide");
                        ermsg.innerHTML = ("Incorrect Credentials");
                    }
                })
        }
    })

    Isubbtn.addEventListener("click", event => {
        event.preventDefault();

        const title = document.querySelector("#title");
        const description = document.querySelector("#description");
        var e = document.querySelector("select#assignedto");
        const assto = e.options[e.selectedIndex].text;
        e = document.querySelector("select#type");
        const Stype = e.value;
        e = document.querySelector("select#priority");
        const Spriority = e.value;

        if ((title.value.length != 0) && (description.value.length != 0)) {
            let formdata = {
                title: title.value,
                description: description.value,
                assigned_to: assto,
                type: Stype,
                priority: Spriority,
            };

            const cleanUrl = `cIssue.php?act=createissue`.replace(/"[^-0-9+&@#/%=~_|!:,.;\(\)]"/g, '');
            fetch(cleanUrl, {
                    method: 'POST',
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json",
                    },
                    body: JSON.stringify(formdata),
                    mode: "cors"
                })
                .then(resp => resp.text())
                .then(resp => {
                    if (parseInt(resp) == 1) {
                        formcIssue.classList.add("hide");
                        formhome.classList.remove("hide");
                    } else if (parseInt(resp) == 2) {
                        ermsg.classList.remove("hide");
                        ermsg.innerHTML = (resp);
                    }
                })
        }
    })

    Usubbtn.addEventListener("click", event => {
        event.preventDefault();

        const fname = document.querySelector("input#firstName");
        const lname = document.querySelector("input#lastName");
        const Upw = document.querySelector("#CUpassword");
        const Uemail = document.querySelector("#CUemail");
        if ((fname.value.length != 0) && (lname.value.length != 0) && (Upw.value.length != 0) && (Uemail.value.length != 0)) {
            let formdata = {
                firstname: fname.value,
                lastname: lname.value,
                password: Upw.value,
                email: Uemail.value,
            };
            const cleanUrl = `cUser.php?act=createUser`.replace(/"[^-0-9+&@#/%=~_|!:,.;\(\)]"/g, '');
            fetch(cleanUrl, {
                    method: 'POST',
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json",
                    },
                    body: JSON.stringify(formdata),
                    mode: "cors"
                })
                .then(resp => resp.text())
                .then(resp => {
                    if (parseInt(resp) == 1) {
                        formcUser.classList.add("hide");
                        formhome.classList.remove("hide");
                    } else if (parseInt(resp) == 2) {
                        ermsg.classList.remove("hide");
                        ermsg.innerHTML = (resp);
                    }
                })
        }
    })

    hmebtn.addEventListener("click", event => {
        event.preventDefault();
        formcUser.classList.add("hide");
        formcUser.classList.add("hide");
        formcIssue.classList.add("hide");
        formhome.classList.remove("hide");
    })

    cNIssuebtn.addEventListener("click", event => {
        event.preventDefault();
        formcUser.classList.add("hide");
        formhome.classList.add("hide");
        formhome.classList.add("hide");
        formcIssue.classList.remove("hide");
    })

    aubtn.addEventListener("click", event => {
        event.preventDefault();
        formcIssue.classList.add("hide");
        formhome.classList.add("hide");
        formhome.classList.add("hide");
        formcUser.classList.remove("hide");
    })

    nissuebtn.addEventListener("click", event => {
        event.preventDefault();
        formcUser.classList.add("hide");
        formhome.classList.add("hide");
        formhome.classList.add("hide");
        formcIssue.classList.remove("hide");
    })

    logoutbtn.addEventListener("click", event => {
        event.preventDefault();
        window.location.href = 'logout.php'
    })
})