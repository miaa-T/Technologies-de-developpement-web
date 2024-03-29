<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet" type="text/css" />
    <title>PremierTPTDW</title>
   <script src="./JQuery.js"></script>
</head>
<body>
    <h2 id="titre" align="center"> Site Comparateurs de Smartphones</h2><br/>
   
       <img src="./photo.jpg" >
       <br/>
       <div class="menu">
        <ul>
            <li><a href="#">Accueil</a></li>
            <li id="marques"><a href="#">Marques</a> <ul id="marques-list">
                    <li><a href="https://www.samsung.com/fr/">Apple</a></li>
                    <li><a href="https://www.samsung.com/fr/">Samsung</a></li>
                    <li><a href="https://www.samsung.com/fr/">Nokia</a></li>
                    <li><a href="https://www.samsung.com/fr/">Huawei</a></li>
                    <li><a href="https://www.samsung.com/fr/">Xiaomi</a></li>
                </ul>
            </li>
            <li><a href="#">News</a></li>
            <li><a href="#">Contact</a></li>
        </ul>
    </div>
       <video src="./video.mp4" width="400" height="400" preload="auto" controls
       autoplay> 
  </video>  <div class="conteneur">
  <div class="animation-image"></div>
  </div><br/>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
  $(document).ready(function() {
    function fetchAndUpdateTable() {
      $.ajax({
        type: "GET",
        url: "displaytableUser.php",
        success: function(data) {
          $("tbody").html(data);
        }
      });
    }
    setInterval(fetchAndUpdateTable, 3000);
  });
</script>

  <?php
  include("displaytableUser.php");
  ?>
        <br/>
        <br/>
        <a href="connexionAdmin.php" >Ajouter des Smartphones ou Caractéristique en tant que Administrateur</a>
<br/>
<script>
  /*  //création du formulaire 
    let form = document.createElement('form');
    form.style.display = "none";
    form.innerHTML = `
        <label for="feature">Feature:</label>
        <input type="text" id="feature" name="feature"><br><br>
        <label for="huawei">Huawei P30 Lite:</label>
        <input type="text" id="huawei" name="huawei"><br><br>
        <label for="samsung">Samsung Galaxy 21 Ultra:</label>
        <input type="text" id="samsung" name="samsung"><br><br>
        <label for="apple">Apple iPhone 15 plus:</label>
        <input type="text" id="apple" name="apple"><br><br>
        <label for="xiaomi">Xiaomi Redmi Note 12:</label>
        <input type="text" id="xiaomi" name="xiaomi"><br><br>
        <button type="button" onclick="ajouterLigne()">Ajouter une ligne </button>
    `;
    document.body.appendChild(form);

      //Insertion de la ligne au niveau de la table 
    function ajouterLigne() {
        let tables = document.getElementsByTagName('table'); // Récupéere tous les elts de type table
        if (tables.length > 0) {
            let table = tables[0]; // récupérer la table  
                 // les valeurs saisies dans les champs du formulaire
            let feature = document.getElementById('feature').value;
            let huawei = document.getElementById('huawei').value;
            let samsung = document.getElementById('samsung').value;
            let apple = document.getElementById('apple').value;
            let xiaomi = document.getElementById('xiaomi').value;

            let nouvLigne = document.createElement('tr'); //nouvelle ligne
            let nouvfeature = document.createElement('th');//head of nouvelle feature
            nouvfeature.textContent = feature;
            nouvLigne.appendChild(nouvfeature);

            let tdHuawei = document.createElement('td');
            tdHuawei.textContent = huawei;
            nouvLigne.appendChild(tdHuawei);

            let tdSamsung = document.createElement('td');
            tdSamsung.textContent = samsung;
            nouvLigne.appendChild(tdSamsung);

            let tdApple = document.createElement('td');
            tdApple.textContent = apple;
            nouvLigne.appendChild(tdApple);

            let tdXiaomi = document.createElement('td');
            tdXiaomi.textContent = xiaomi;
            nouvLigne.appendChild(tdXiaomi);
        // ajouter la logne a la table 
            table.appendChild(nouvLigne);
           
            //Supprimer le formulaire  apres l'insertion de la ligne
            let forms = document.getElementsByTagName('form');
            if (forms.length > 0) {
                let form = forms[0];
                form.parentNode.removeChild(form);
            }
        }
    }

    // Ajouter un événement de chargement
    window.addEventListener('load', function() {
        let affForm = document.getElementById('add-phone');
        affForm.addEventListener('click', function() {
            form.style.display = "block";
        });
    });*/
</script>

<script>
    // Création du formulaire en utilisant jQuery
   $(document).ready(function() {
            $("#add-phone").click(function() {
                createForm();
            });
        });
        function createForm() {
            let form = `
                <form>
                    <label for="feature">Feature:</label>
                    <input type="text" id="feature" name="feature"><br><br>
                    <label for="huawei">Huawei P30 Lite:</label>
                    <input type="text" id="huawei" name="huawei"><br><br>
                    <label for="samsung">Samsung Galaxy 21 Ultra:</label>
                    <input type="text" id="samsung" name="samsung"><br><br>
                    <label for="apple">Apple iPhone 15 plus:</label>
                    <input type="text" id="apple" name="apple"><br><br>
                    <label for="xiaomi">Xiaomi Redmi Note 12:</label>
                    <input type="text" id="xiaomi" name="xiaomi"><br><br>
                    <button type="button" onclick="ajouterLigne()">Ajouter une ligne </button>
                </form>
            `;
            $(form).insertBefore('a[href="km_toubal@esi.dz"]');
        }
   
    // Insertion de la ligne dans la table en utilisant jQuery
    function ajouterLigne() {
        let table = $('table');
        let feature = $('#feature').val();
        let huawei = $('#huawei').val();
        let samsung = $('#samsung').val();
        let apple = $('#apple').val();
        let xiaomi = $('#xiaomi').val();

        let nouvLigne = $('<tr></tr>');
        let nouvfeature = $('<th></th>').text(feature);
        nouvLigne.append(nouvfeature, $('<td></td>').text(huawei), $('<td></td>').text(samsung), $('<td></td>').text(apple), $('<td></td>').text(xiaomi));
        table.append(nouvLigne);  
         // Vider les champs après l'ajout
         $("#feature").val('');
            $("#huawei").val('');
            $("#samsung").val('');
            $("#apple").val('');
            $("#xiaomi").val('');
    }
    
</script>
<br/>
<br/>



<a href="km_toubal@esi.dz" align-text="center">Contacter nous Via Email</a>
</body>
</html>
