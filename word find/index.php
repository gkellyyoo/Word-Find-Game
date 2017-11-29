<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Word search game</title>
    <link rel="stylesheet" href="css/wordsearch.css" />
    <link rel="stylesheet" href="css/style.css" />
  </head>
  <body>

  <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "wordgame";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
?> 
    <div class="wrap">
      <section class="prettyTitle"> <span>Word search game</span></section>
      
      <section id="ws-area"></section>
      <ul class="ws-words"></ul>
    </div>
    <div class="wrap">
	<!-- <form action="insert.php" method = "POST">
	Topic <input type="text" name="Heading" id="Heading"></br>
	
	<textarea rows="4" cols="50" name="list",id="list">
	</textarea>
	<input type='submit'>
	</form> -->
	
	
	
<!-- 	<Button>Button 1</Button>
	<Button>Button 2</Button>
	<Button>Button 3</Button> -->
	</div>

  <div class="wrap" id ="buttonDiv">
    <button id="myBtn" class="button">Create My Own List</button>
    <button id="importBtn" class="button">Import a sample list</button>
  </div>
    
  <!-- The Modal -->
  <div id="myModal" class="modal">

    <!-- Modal content -->
    <div class="modal-content">
      <span class="close" id="insertModalClose">&times;</span>
      <form action="insert.php" method = "POST">
      <p>
      Enter a list of vocabularies splitted by comma+space below. <br>
      Example: Cat, Dog, Rabbit, Horse
      </p>
      Topic: <input type="text" name="Heading" id="Heading" style="width: 30%"></br></br>
  
      <textarea rows="4" cols="50" name="list" id="list" style="width: 60%">
      </textarea></br>
      <input id="userListSubmit" type='submit'>
      </form>
      <!-- <input type="text" id="userInputList" name="userInputList" style="width:80%"> <br><br>
      <button id="userListSubmit">Create my list!</button> -->
    </div>
  </div>

  <div id="selectModal" class="modal">
    <div class="modal-content">
      <span class="close" id="selectModalClose">&times;</span>
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
    <script src="js/wordsearch.js"></script>
    <script type="text/javascript">
	
	
	  var topic;
    function getSelect(thisValue){
        console.log(thisValue.options[thisValue.selectedIndex].text);
		topic=thisValue.options[thisValue.selectedIndex].text;
    }
 
    var gameAreaEl = document.getElementById('ws-area');
    var gameobj = gameAreaEl.wordSearch();

      // Put words into `.ws-words`
      //var words = gameobj.settings.wordsList,
	  var words = gameobj.settings.wordsList,      
        wordsWrap = document.querySelector('.ws-words');
      for (i in words) {
        var liEl = document.createElement('li');
        liEl.setAttribute('class', 'ws-word');
        liEl.innerText = words[i];
        wordsWrap.appendChild(liEl);
      }

    var btn = document.getElementById("myBtn");
    var importBtn = document.getElementById('importBtn');
    var modal = document.getElementById('myModal');
    var selectModal = document.getElementById('selectModal');
    var insertModalX = document.getElementsByClassName("close")[0];
    var selectModalX = document.getElementsByClassName("close")[1];

    btn.onclick = function() {
      modal.style.display = "block";
    }
    insertModalX.onclick = function() {
      modal.style.display = "none";
    }
    window.onclick = function(event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }


    userListSubmit.onclick = function() {
      modal.style.display = "none";
    }

    console.log("hihihi");

    importBtn.onclick = function() {
      selectModal.style.display = "block";
    }
    selectModalX.onclick = function() {
      selectModal.style.display = "none";
    }
    window.onclick = function(event) {
      if (event.target == modal) {
        selectModal.style.display = "none";
      }
    }
    </script>
  </body>
</html>