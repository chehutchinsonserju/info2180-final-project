<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Bugme Issue Tracker</title>
    <link rel="stylesheet" href="styles.css" />
    <script src="login.js"></script>
    <script>
        function filtr(str) {
            if (str == "") {
                document.querySelector("#issuetable").innerHTML = "";
                return;
            } else {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.querySelector("#issuetable").innerHTML = this.responseText;
                }
                };
                xmlhttp.open("GET","filtertable.php?status="+str,true);
                xmlhttp.send();
            }
        }

        function issue(str){
            if (str == "") {
                document.querySelector("#detailedissues").innerHTML = "";
                return;
            } else {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.querySelector("#detailedissues").innerHTML = this.responseText;
                }
                };
                xmlhttp.open("GET","detailedissue.php?id="+str,true);
                xmlhttp.send();
            }
        }
    </script>
</head>


<header>
    <img id="logo" src="res/buglogo.png" alt="logo"></img>
    <h1>BugMe Issue Tracker</h1>
</header>

<body>
    <div id="container">
        <div id="sidebar" class="hide">
            <button id="homeRef" class="refs"><img class = "sideIcons" src="res/home.png"><h3> Home</h3></button>
            <br>
            <button id="addUserRef" class="refs"><img class = "sideIcons" src="res/newadduser.png"><h3> Add User</h3></button>
            <br>
            <button id="newIssueRef" class="refs"><img class = "sideIcons" src="res/newIssue.png"><h3> New Issue</h3></button>
            <br>
            <button id="logoutRef" class="refs"><img class = "sideIcons" src="res/logout.png"><h3> Logout</h3></button>
        </div>

        <div class="inputs">

            <div id="Login" class="hide">
                <h1>Login</h1>
                <h3>Email</h3>
                <input type="email" id="email" required>

                <h3>Password</h3>
                <input type="password" id="password" required>
                <br>
                <button class="submit" id="Lsubmit"><b>Submit</b></button>
            </div>

            <div id="cUser" class="hide">
                <h1>New User</h1>
                <h3>First Name</h3>
                <input type="text" id="firstName" required>

                <h3>Last Name</h3>
                <input type="text" id="lastName" required>

                <h3>Password</h3>
                <input type="password" id="CUpassword" required>

                <h3>Email</h3>
                <input type="email" id="CUemail" required>
                <br>
                <button class ="submit" id="Usubmit"><b>Submit</b></button>
            </div>

            <div id ="cIssue" class="hide">
                <h1>New Issue</h1>
                <h3>Title</h3>
                <input type="text" id="title" required>

                <h3>Description</h3>
                <textarea name="text" rows="14" cols="10" wrap="soft" id="description" required></textarea>
                <br>
                <h3 id = "assignedto">Assigned to</h3>
                <select name="assignedto" id="assignedto">
                    <?php
                        include "conDB.php";
                        $sql = "SELECT firstname, lastname FROM userstable";
                        $stmt = $conn->prepare($sql);
                        $stmt->execute();
                        while($data = $stmt->fetch(PDO::FETCH_ASSOC))
                        {
                            echo "<option value='". $data['firstname']  ." ". $data['lastname'] ."'>" .$data['firstname'] ." ".$data['lastname']. "</option>"; 
                        }	
                    ?>  
                </select>
                <br>
                <h3 id = "type">Type</h3>
                <select name="type" id="type">
                    <option value = "bug">Bug</option>
                    <option value = "proposal">Proposal</option>
                    <option value = "task">Task</option>
                </select>
                <br>
                <h3 id = "priority">Priority</h3>
                <select name="priority" id="priority">
                    <option value = "minor">Minor</option>
                    <option value = "major">Major</option>
                    <option value = "critical">Critical</option>
                </select>
                <br>
                <button class ="submit" id="Isubmit"><b>Submit</b></button>
            </div>

            <div id = "home" class= "hide">
                <h1></h1>
                <h1 id= homeheading>Issues</h1>
                <button id = "cnewIssues">Create New Issue</button>
                <br>
                <h4 id = headingfilter>Filter By: </h4>
                <button name = "all"id = "all" class = "fltrbtns"  onfocus="filtr('1')">ALL</button>
                <button name = "open" id = "open" class = "fltrbtns"onfocus="filtr('2')">OPEN</button>
                <button name = "mine"id = "mine" class = "fltrbtns" onfocus="filtr('My_tickets')">MY TICKETS</button>
                <div id ="issuetable"">
            
                </div>
            </div>

            <div id = "detailedissues">

            </div>

            <div class="errormsg"></div>
        </div>
    </div>
</body>

</html>