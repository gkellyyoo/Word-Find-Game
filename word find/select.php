<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Word search game</title>
    <link rel="stylesheet" href="css/wordsearch.min.css" />
    <link rel="stylesheet" href="css/wordsearch.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/style.min.css" />
  </head>
  <body>

<?php

if (isset($_POST["topic"]))
{
  
   echo $_POST['topic']; 
   $topic=$_POST['topic'];
  
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "wordgame";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

$sql = $sql = "SELECT list FROM lists where topic='".$topic."'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
while($row = $result->fetch_assoc()) {

//echo $row['list'];

$pieces = explode(",", $row['list']);

$x = "";
for($i=0;$i<count($pieces);$i=$i+1)
if ($i == count($pieces)-1) {
  $x .= $pieces[$i];
} else {
  $x .= $pieces[$i] . ", ";
}
}
};


} 
else 
{
  $user = null;
  echo "no username supplied";
}


?>

    <div class="wrap">
      <h1 class="logo">Word search game</h1>
      <section id="ws-area"></section>
      <ul class="ws-words"></ul>
    </div>
    <div class="wrap">
	</div>

  <div class="wrap" id ="buttonDiv">
    <button id="myBtn" class="button">Create My Own List</button>
    <button id="importBtn" class="button">Import a sample list</button>
  </div>
    
  <!-- The Modal -->
  <div id="myModal" class="modal">

    <!-- Modal content -->
    <div class="modal-content">
      <span class="close">&times;</span>
      <form action="insert.php" method = "POST">
      <p>
      Enter a list of vocabularies splitted by comma+space below. <br>
      Example: Cat, Dog, Rabbit, Horse
      </p>
      Topic: <input type="text" name="Heading" id="Heading"></br>
  
      <textarea rows="4" cols="50" name="list",id="list">
      </textarea>
      <input type='submit'>
      </form>
      <!-- <input type="text" id="userInputList" name="userInputList" style="width:80%"> <br><br>
      <button id="userListSubmit">Create my list!</button> -->
    </div>
  </div>

  <div id="selectModal" class="modal">
    <div class="modal-content">
      <?php
        $sql = "SELECT * FROM lists";
        $result = $conn->query($sql);

        echo"<form action='select.php' method='post'>";
        echo "<select id='topic' name='topic' onChange='getSelect(this)'>";

        /*echo "<select id='topic' name='topic'>";
        */
        if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
        ?>
        //Loop Content... Example:-

        **<li><?php echo "<option value='" . $row['topic'] . "'>" . $row['topic'] . "</option>";; ?></li>**

        <?php
        }};

        echo "</select> <input type='submit'> </form>";

        if (isset($_POST["topic"]))
        {
          $user = $_POST["topic"];
          echo $user;
          echo " is your username";
        } 
        else 
        {
          $user = null;
          echo "no username supplied";
        }

        ?>  
    </div>
  </div>
    
    <script src="js/utility.min.js"></script>
    <script src="js/wordsearch.min.js"></script>
    <script type="text/javascript">
	
	  var topic;
    function getSelect(thisValue){
        console.log(thisValue.options[thisValue.selectedIndex].text);
		topic=thisValue.options[thisValue.selectedIndex].text;
    }

    var gameAreaEl = document.getElementById('ws-area');
    var gameobj = gameAreaEl.wordSearch();

    // Put words into `.ws-words`
    var words = gameobj.settings.wordsList,
      wordsWrap = document.querySelector('.ws-words');
    // for (i in words) {
    //   var liEl = document.createElement('li');
    //   liEl.setAttribute('class', 'ws-word');
    //   liEl.innerText = words[i];
    //   wordsWrap.appendChild(liEl);
    // }

    var btn = document.getElementById("myBtn");
    var importBtn = document.getElementById('importBtn');
    var modal = document.getElementById('myModal');
    var selectModal = document.getElementById('selectModal');
    var span = document.getElementsByClassName("close")[0];

    btn.onclick = function() {
      modal.style.display = "block";
    }
    span.onclick = function() {
      modal.style.display = "none";
    }
    window.onclick = function(event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }

    importBtn.onclick = function() {
      selectModal.style.display = "block";
    }
    span.onclick = function() {
      selectModal.style.display = "none";
    }
    window.onclick = function(event) {
      if (event.target == modal) {
        selectModal.style.display = "none";
      }
    }

    var pieces = "<?php echo $x ?>"
    console.log("hihihihihi:" + pieces);

    modal.style.display = "none";
    var value = pieces;
    var newList = value.split(", ");
    words = newList;
    for (i in words) {
      wordsWrap = document.querySelector('.ws-words');
      var liEl = document.createElement('li');
      liEl.setAttribute('class', 'ws-word');
      liEl.innerText = words[i];
      wordsWrap.appendChild(liEl);
    }
    </script>
  </body>
</html>