<style>
  #head-cont {
    margin-top: -1%;
    background: white;
    /*background: #ffff;*/
    padding: 20px;
    box-shadow: 0 3px 10px rgb(0 0 0 / 0.2);
    margin-bottom: 10px;
    width: 100%;
    border-radius: 8px;
    font-family: 'Arial';
    height: auto;
  }

  #head-cont-red {
    margin-top: -1%;
    background: #920003;
    padding: 20px;
    box-shadow: 0 3px 10px rgb(0 0 0 / 0.2);
    margin-bottom: 5px;
    width: 100%;
    border-radius: 8px;
    font-family: 'Arial';
    height: auto;
  }

  #header {
    font-size: 23px;
    color: white;
    font-family: 'Arial';
    font-weight: 700;
  }

  .mt20 {
    margin-top: 20px;
  }

  .bold {
    font-weight: bold;
    font-size: 18px;
  }

  ol li {
    margin-bottom: 10px;
  }

</style>


<div ng-hide="votingTpl">
  
  <div class="container-fluid">
    <div class="row mt20">
      <!-- LEFT CONT -->
      <div class="col-sm-7 col-md-7 col-lg-7">
        <!-- SAMPLE BALLOT -->
        <div id="head-cont-red">
          <p id="header">2022-2023 EARIST GOVERNMENT ELECTION  SAMPLE BALLOT</p>
        </div>
        <div style="width: auto;">
          <img src="img/ballot.jpg" style="max-width: 100%;">        
        </div>

      </div>
      <!-- END OF LEFT CONT -->

      <!-- RIGHT CONT -->
      <div class="col-sm-5 col-md-5 col-lg-5">
        <!-- INSTRUCTION BALLOT -->

        <div class="row" style="margin-top: 0%;">
          <div class="col-sm-12 col-md-12 col-lg-12" id="head-cont">
            <div class="row mt20">
              <div class="col-md-12">
                <p>
                  <span class="bold" style="font-size: 17px;"> STEPS ON VOTING for the MAY 9, 2022 EARIST GOVERNMENT ELECTION </span>
                  <br>Voting Time 7:00 AM - 5:00 PM
                </p>
                <ol style="color: #333;">
                  <li><span class="bold">Scan</span> sample ballot for the overview of the voting ballot.</li>
                  <li><span class="bold">Check</span> your personal details placed on the voting ballot if accurate.</li>
                  <li><span class="bold">Follow</span> the rules and regulations on the voting ballot orderly.</li>
                  <li><span class="bold">Fill out</span> your voting ballot correctly.</li>
                  <li><span class="bold">Double Check</span> your votes before you submit.</li>
                  <li><span class="bold">Check</span> and confirm your voter's receipt.</li>
                </ol>
              </div>
            </div>

            <br>
            <br>
            <div class="row" style="text-align: center; font-weight: bold;">
              <div class="col-md-12">
                <button class="btn" ng-click="ShowVotingTpl()" style="background: #920003; color: white;">Proceed on Actual Voting</button>
              </div>
            </div>
            <div class="row text-center">
              <div class="col-md-12">
                <button class="btn btn-link btn-md" style="width: 250px; height: 100px;" onclick="window.location.href = '../dashboard' ">Go to Dashboard</button>
              </div>
            </div> 

          </div>
        </div>

        
        
      </div>
    </div>
    <!-- END OF RIGHT CONT -->
  </div>



</div>

<div ng-if="votingTpl">
  <div> <?php include '../myvote/voting-add-tpl.php'; ?></div>
</div>
