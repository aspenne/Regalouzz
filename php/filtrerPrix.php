<article>
<div id="filter-icon"></div>
<form id="filter-form" action="./Liste_produit.php" method="get" style="display: none;">
  <label for="min">Prix minimum:</label><br>
  <input type="text" id="min" name="min"><br>
  <label for="max">Prix maximum:</label><br>
  <input type="text" id="max" name="max"><br><br>
</form>
<input id="filter-input" type="submit" value="Filtrer" class="submit_button"  onclick="rechercher();">
</article>

<style> 

#filter-icon {
  width: 30px;
  height: 30px;
  background-image: url("../img/site/filtreIcon.png");
  border-radius : 10px;
  
}

#filter-icon:hover {
  background-color : rgb(39, 168, 224);
  cursor: pointer;

}

.submit_button {
    cursor: pointer;
    background-color: rgb(39, 168, 224);
}
.submit_button {
    height: 25px;
    width: 150px;
    margin-left: 20px;
    border: 0px;
    border-radius: 20px;
}
</style>

<script>
  const filterIcon = document.getElementById("filter-icon");
  const filterForm = document.getElementById("filter-form");
  const filterInput = document.getElementById("filter-input");

  filterIcon.addEventListener("click", () => {
    if ((filterForm.style.display === "none") && (filterInput.style.display === "none")) {
      filterForm.style.display = "block";
      filterInput.style.display = "block";
    } else {
      filterForm.style.display = "none";
      filterInput.style.display = "none";
    }
  });
</script>
<script src="../Javascript/rechercher.js"></script>



