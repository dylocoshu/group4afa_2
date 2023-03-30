<html>
<head><style>
    body {
  font-family: Libre Caslon Text;
  background-color: #FFAB91;
}

.body-text {
  padding-top: 20vh;
  text-align: center;
  position: relative;
}

.hamburger-icon {
  position: absolute;
  z-index: 3;
  top: 5vh;
  right: 5vw;
  padding-bottom: 2vh;
}

.hamburger-icon span {
  height: 5px;
  width: 40px;
  background-color: white;
  display: block;
  margin: 5px 0px 5px 0px;
  transition: 0.7s ease-in-out;
  transform: none;
}

#openmenu:checked ~ .menu-pane {
  right: -5vw;
  transform: translateX(-5vw);
}

#openmenu:checked ~ .body-text {
display: none;
}

#openmenu:checked ~ .hamburger-icon span:nth-of-type(2) {
  transform: translate(0%, 175%) rotate(-45deg);
  background-color: white;
}

#openmenu:checked ~ .hamburger-icon span:nth-of-type(3) {
  transform: rotate(45deg);
  background-color: white;
}

#openmenu:checked ~ .hamburger-icon span:nth-of-type(1) {
  opacity: 0;
}

#openmenu:checked ~ .hamburger-icon span:nth-of-type(4) {
  opacity: 0;
}

div.menu-pane {
  background-color: #000;
  position: absolute;
  right: 0;
  z-index: 2;
  transform: translateX(105vw);
  transform-origin: (0, 0);
  width: 100vw;
  height: 100%;
  transition: 0.6s ease-in-out;
}

.menu-pane p {
  color: black;
  font-size: 0.6em;
}

.menu-pane nav {
  padding: 10%;
}

.menu-links li, a, span {
      transition: 0.5s ease-in-out;
}

.menu-pane ul {
  padding: 10%;
  display: inline-block;
}

.menu-pane li {
  padding-top: 20px;
  padding-bottom: 20px;
  margin-right: 10px;
    font-size: 1em;
}


.menu-pane li:first-child {
  font-size: 1.3em;
  margin-right: -10px;
}


.menu-links li a {
  color: white;
  text-decoration: none;
}


.menu-links li:hover a {
  color: #FFAB91;
}

.menu-links li:first-child:hover a {
  color: black;  
  background-color: #FFAB91;
}

#QC-info {
  background-color: #FFAB91;
    border: 2px solid;
  border-color: #FFAB91;
display: block;
  opacity: 0;
  
}

.menu-links li:first-child:hover #QC-info {
opacity: 1;
}

.menu-links li:first-child:hover #DC-info {
opacity: 1;
}

#DC-info {
  background-color: #FFAB91;
    border: 2px solid;
  border-color: #FFAB91;
display: block;
  opacity: 0;
}


.menu-links li:first-child a {
  padding: 5px;
}



input.hamburger-checkbox {
  position: absolute;
  z-index: 3;
  top: 5vh;
  right: 5vw;
  width: 10vw;
  opacity: 0;
  height: 6vh;
}
</style></head>

<div class="menu-container">
  
  <input type="checkbox" id="openmenu" class="hamburger-checkbox">
  
  <div class="hamburger-icon">
    <label for="openmenu" id="hamburger-label">
      <span></span>
      <span></span>
      <span></span>
      <span></span>
    </label>    
  </div>

    <div class="menu-pane">
      
      <nav>
        <strong><a href="login.php">Login or Sign up</a>  </strong><br>
        <a href="about1.php"> About us </a>
        
        
      </nav>
    </div>
  

</html>