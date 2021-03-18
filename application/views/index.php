<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/bootstrap.min.css">
    <link rel="stylesheet" href="assets/style.css">
    <title>Register</title>
</head>
<body class="bg-dark">
    <div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a href="" class="navbar-brand mt-auto"><span class="text-danger big">M</span><span class="lit">Nerds</span></a>
            <a href="login.html" class="ml-auto nav-item"><button class="btn btn-sm btn-outline-primary">Login</button></a>
        </nav>
        </div>
    <center>
    <div class="card col-lg-5 mt-1">
    <div class="card-header">
        <h1 class="text-success">Sign Up</h1>
        <p><strong>It's quick and easy</strong></p>
    </div>
    <form class="card-body" action="Welcome/register" method="post" onsubmit="return clickBut()">
        <h6 class="text-left mb-1 mt-2"><strong>Name</strong></h6>
        <div>
            <p id="fName"></p>
            <input type="text" placeholder="First Name" class="form-control mt-1" name="fname" id="fname" onkeyup="fNameCheck()">
        </div>
        <div>
            <p id="lName"></p>
            <input type="text" placeholder="Surname" class="form-control" name="lname" id="lname" onkeyup="lNameCheck()">
        </div>
        <div>
            <p id="othername"></p>
            <input type="text" placeholder="Other Names(optional)" class="form-control" name="otherName" id="otherName">
        </div>
        <div>
            <p class="text-left"><strong>Date of birth</strong></p>
            <div class="row">
                <div class="col-3">
                    <select class="form-control" name="day" id="day" required>
                        <option disabled selected>Day</option>
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>4</option>
                        <option>6</option>
                        <option>7</option>
                        <option>8</option>
                        <option>9</option>
                        <option>10</option>
                        <option>11</option>
                        <option>12</option>
                        <option>13</option>
                        <option>14</option>
                        <option>15</option>
                        <option>16</option>
                        <option>17</option>
                        <option>18</option>
                        <option>19</option>
                        <option>20</option>
                        <option>21</option>
                        <option>22</option>
                        <option>23</option>
                        <option>24</option>
                        <option>25</option>
                        <option>26</option>
                        <option>27</option>
                        <option>28</option>
                        <option>29</option>
                        <option>30</option>
                        <option>31</option>
                    </select>
                </div>
                <div class="col-3">
                    <select id="month" name="month" class="form-control" required>
                        <option disabled selected>Month</option>
                        <option>January</option>
                        <option>February</option>
                        <option>March</option>
                        <option>April</option>
                        <option>May</option>
                        <option>June</option>
                        <option>July</option>
                        <option>August</option>
                        <option>September</option>
                        <option>October</option>
                        <option>November</option>
                        <option>December</option>
                    </select>
                </div>
                <div class="col-3">
                    <select id="year" name="year" class="form-control" required>
                        <option disabled selected>Year</option>
                        <option>1975</option>
                        <option>1976</option>
                        <option>1977</option>
                        <option>1978</option>
                        <option>1979</option>
                        <option>1980</option>
                        <option>1981</option>
                        <option>1982</option>
                        <option>1983</option>
                        <option>1984</option>
                        <option>1985</option>
                        <option>1986</option>
                        <option>1987</option>
                        <option>1988</option>
                        <option>1989</option>
                        <option>1990</option>
                        <option>1991</option>
                        <option>1992</option>
                        <option>1993</option>
                        <option>1994</option>
                        <option>1995</option>
                        <option>1996</option>
                        <option>1997</option>
                        <option>1998</option>
                        <option>1999</option>
                        <option>2000</option>
                        <option>2001</option>
                        <option>2002</option>
                        <option>2003</option>
                        <option>2004</option>
                        <option>2005</option>
                    </select>
                </div>
            </div>
        </div>
            <p class="text-left mt-2"><strong>Gender</strong></p>
        <div class="row">
            <div class="form-check col-3 ml-3 form-control">
                <input class="form-check-input" type="radio" name="gender" id="gender">
                <label class="form-check-label" for="flexRadioDefault1">Male</label>
              </div>
              <div class="form-check col-3 ml-2 form-control">
                <input class="form-check-input" type="radio" name="gender" id="gender" checked>
                <label class="form-check-label" for="flexRadioDefault2">Female</label>
              </div>
              <div class="form-check col-3 ml-2 form-control">
                <input class="form-check-input" type="radio" name="gender" id="gender" checked>
                <label class="form-check-label" for="flexRadioDefault2">Other</label>
              </div>
        </div>
        <h6 class="text-left mb-1 mt-2"><strong>Location</strong></h6>
        <div>
            <input type="text" id="address" name="address" placeholder="Address" class="form-control mt-2">
        </div>
        <div>
            <input type="text" id="country" name="country" placeholder="Country" class="form-control mt-2">
        </div>
        <h6 class="text-left mb-1 mt-2"><strong>Contact</strong></h6>
        <div>
            <p class="text-danger" id="phone"></p>
            <input type="tel" placeholder="Phone No." id="phoneNo" name="phoneNo" class="form-control"  onkeyup="invaNumber()">
        </div>
        <div>
            <p id="email"></p>
            <input type="text" placeholder="Email" class="form-control" id="Email" name="Email" onkeyup="emailCheck()">
        </div>
        <h6 class="text-left mb-1 mt-2"><strong>Security</strong></h6>
        <div>
            <p class="text-danger" id="length"></p>
            <input type="password" placeholder="Password" id="pass" name="pass" class="form-control mt-2">
        </div>
        <div>
            <p class="text-danger" id="errorMessage"></p>
            <input type="password" placeholder="Confirm password" id="copass" name="copass" class="form-control mt-2" onkeyup="myFunction()">
        </div>
        <button class="btn btn-lg form-control space btn-outline-success mt-2" type="submit">Submit</button>
    </form>
    </div>
    </center>
    <script src="assets/fm.js"></script>
</body>
</html>