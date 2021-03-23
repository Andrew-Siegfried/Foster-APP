<template>
    
<div id="main-page">

<nav>
<h1><p><font face="Open Sans" color="#1E87F0">Get The Facts</font></p></h1>
<div>
<img src="../assets/images/numberofkids.png">
</div>  
</nav>
  
<article>
<img src="../assets/images/age.jpg">
</article>

<div>
<article>
<img src="../assets/images/malefemale.png">
</article>
</div>  

<nav>
<img src="../assets/images/redhome.png"> 
</nav>

</div>

    
</template>

<script>

</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

* {
  box-sizing: border-box;
}

body {
  font-family: Arial, Helvetica, sans-serif;
}


/* Create two columns/boxes that floats next to each other */
nav {
  float: left;
  width: 40%;
  height: 445px; /* only for demonstration, should be removed */
  background: #ccc;
  padding: 20px;
}

article {
  float: right;
  padding: 20px;
  width: 60%;
  background-color: #f1f1f1;

}

/* Clear floats after the columns */
section:after {
  content: "";
  display: table;
  clear: both;
}

/* Responsive layout - makes the two columns/boxes stack on top of each other instead of next to each other, on small screens */
@media (max-width: 600px) {
  nav, article {
    width: 100%;
    height: auto;
  }
}

img {
    width: 100%;
    height: auto;
}

</style>

