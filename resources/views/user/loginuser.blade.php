<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1, width=device-width" />
    <base href="/public">
    <link rel="stylesheet" href="css/globalone.css" />
    <link rel="stylesheet" href="css/indexone.css" />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Zen Kaku Gothic Antique:wght@400;700&display=swap"
    />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
  <form action="{{ route('login') }}" method="post">
        @csrf

    <div class="template-3sign-in">
      <div class="own-an-account-container">
        <span>Own an Account? </span>
        <a href="/" class="jump-right-in fw-bolder">JUMP RIGHT IN</a>
      </div>
      <div class="form">
        <div class="flex-col">
          <div class="checkboxlabel">
            <div class="terms">I accept the terms & Condition</div>
            <div class="checkbox">
            <input class="form-check-input" style="width:90%;height:90%;box-shadow:none" type="checkbox" value="" id="flexCheckChecked" required>
            
            </div>
          </div>
          
          <div class="btn-prytemplate1">
            <div class="btn-prytemplate1-child"> <button type="submit" style="    width: 100%;
    height: 100%;
    border-radius: 54px;" class="btn btn-primary btn-lg get-started">SIGN IN</button></div>
           
          </div>
        </div>
        
        <div class="input-lineusername-parent">
        
          <div class="input-lineusername">
            <div class="johndadev">
            <input type="email" style="display: block;
    width: 188%;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    border: 0;
    border-radius: 0;
    padding: 5px 0;
    box-shadow: none;
    border-bottom: 2px solid #BDBDBD;
    background: transparent;" required class="colorm form-control" value="{{ old('email') }}" name="email" placeholder="johndadev@gamil.com">

            </div>
          
            <div class="label">
              <div class="username">Email</div>
            </div>
            @if(session()->has('error'))
            <div class="alert error fw-bolder" style=" position: relative; bottom: 4rem;left: -18px; color:red ; margin:0 auto; position: absolute;padding-top:12px" role="alert" id="dataToRemove">
 Invalid User
</div>@endif 
          </div>
          <div class="input-lineemail-copy">
            <div class="johndoeemailcom">
            <input type="password"  style=" display: block;
    width: 188%;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    border: 0;
    border-radius:0;
    padding:5px 0;
    box-shadow:none;
    border-bottom: 2px solid #BDBDBD;
    background: transparent;" required class="form-control colorm" name="password" placeholder="*********">
            </div>
            <div class="label2">
              <div class="username">Password</div>
              
            </div>
                 

          </div>
          
        </div>
        
      </div>
      


      </form >

      <b class="join-connect"
        >Join & Connect the Fastest Growing Online Community</b
      ><div class="btn-group">
        <div class="btn-outlinetemplate1-copy">
          <div class="btn-outlinetemplate1-copy-child"></div>
          <div class="span">
            <div class="sign-up-with">Sign up with Google </div>
            <img
              class="icons8-google"
              alt=""
              src="./public/icons8google@2x.png"
            />
          </div>
        </div>
     
        <div class="btn-outlinetemplate1-copy">
          <div class="btn-outlinetemplate1-copy-child"></div>
          <div class="span">
            <div class="sign-up-with1">Sign up with Github</div>
            <div class="background"></div>
            <img class="shape-icon" alt="" src="./public/shape@2x.png" />
          </div>
        </div>
      </div>
      

      <img class="bg-left-icon" alt="" src="./public/bgleft@2x.png" />

      <div class="lorem-ipsum-dolor">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
        tempor incididun.
      </div>
      <b class="online-community-for-container">
        <p class="online-community-for">Online Community For</p>
        <p class="online-community-for">Front-end Developers</p>
      </b>
      <img
        class="illustration-icon"
        alt=""
        src="./public/illustration@2x.png"
      />

      <img class="new-shape-icon1" alt="" src="./public/new-shape@2x.png" />

      <img class="tick-box-icon" alt="" src="./public/tick-box-icon@2x.png" />
    </div>
  </body>
</html>
