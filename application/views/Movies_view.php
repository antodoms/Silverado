<?php include_once("header.php") ?>





<main onload="resettable(); checkCookie();">
        
        <div id="list" class="container">
          <br>
            <h2>NOW PLAYING</h2>
            <div class="movies"  onclick="resettable(); deleteAllCookies(); showtime(1);">
                <img class="thumbnail" src="<?php echo asset_url(); ?>images/thumbnails/avengers.png" alt="thumbnail" />
                <h2>Avengers</h2>
               
                
            </div>
            
            <div class="movies"  onclick="resettable(); deleteAllCookies(); showtime(2);">
                <img class="thumbnail"  src="<?php echo asset_url(); ?>images/thumbnails/incredibles.png" alt="" />
                <h2>Incredibles</h2>
            </div>
            
            <div class="movies" onclick="resettable(); deleteAllCookies(); showtime(3);">
                <img class="thumbnail"  src="<?php echo asset_url(); ?>images/thumbnails/FaultInOurStars.png" alt="" />
                <h2>The Fault in our Stars</h2>
            </div>
            
            <div class="movies"  onclick="resettable(); deleteAllCookies(); showtime(4);">
                <img class="thumbnail"  src="<?php echo asset_url(); ?>images/thumbnails/lifeofpi.png" alt="thumbnail" />
                <h2>Life of Pi</h2>
            </div>
        </div>
          <div id="description" class="container">
            <h2>DESCRIPTION</h2>
             <div class="description" id="1" hidden>
               <img class="age" src="<?php echo asset_url(); ?>images/ratings/M.png" alt="ageguidance" />
                <p> <b>IMDB Rating</b> - 8.1</p>
                <p> <b>Rotten Tomato Rating</b> - 75%</p>
                <p> <b>Genre</b> - Action , Thriller, Suspense, Sci-Fi</p>
                <p>While all of these things (script, action, special effects and so on and so forth) are important... it's no good having them spot on if you don't have a cast that just isn't right. But fortunately, for fans and for the actors involved, Whedon's cast not only work brilliantly together but are perfectly comfortable wailing on each other and threatening each other all day and night.</p>
                <button>Read More</button>
                <div class="more">
                  <p><b>Director: </b> Joss Whedon</p>
                  <p><b>Crew: </b>Robert Downey Jr., Chris Evans, Scarlett Johansson</p>
                  <iframe src="https://www.youtube.com/embed/JAUoeqvedMo" style="width: 99% !important;height: 400px;margin: 0 auto;" allowfullscreen></iframe>
                </div>
            </div>
            
            <div class="description" id="2">
                <img class="age" src="<?php echo asset_url(); ?>images/ratings/PG.png" alt="ageguidance" />
                <p> <b>IMDB Rating</b> - 8.0</p>
                <p> <b>Rotten Tomato Rating</b> - 97%</p>
                <p> <b>Genre</b> - Action , Family, Suspense</p>
                <p>The Incredibles is a 2004 American computer-animated comedy superhero film written and directed by Brad Bird and released by Walt Disney Pictures. It was the sixth film produced by Pixar Animation Studios. The film's title is the name of a family of superheroes who are forced to hide their powers and live a quiet suburban life. Mr. Incredible's desire to help people draws the entire family into a battle with a villain and his killer robot.</p>
                <button>Read More</button>
                <div class="more">
                  <p><b>Director: </b>Brad Bird</p>
                  <p><b>Crew: </b> Craig T. Nelson, Samuel L. Jackson, Holly Hunter </p>
                  <iframe src="https://www.youtube.com/embed/eZbzbC9285I" style="width: 99% !important;height: 400px;margin: 0 auto;" allowfullscreen></iframe>
                </div>
            </div>
            
            <div class="description" id="3">
                <img class="age" src="<?php echo asset_url(); ?>images/ratings/R.png" alt="ageguidance" />
                <p> <b>IMDB Rating</b> - 7.9</p>
                <p> <b>Rotten Tomato Rating</b> - 80%</p>
                <p> <b>Genre</b> - Romantic, Suspense</p>
                <p>he Fault in Our Stars is the sixth novel by author John Green, published in January 2012. The story is narrated by a sixteen-year-old cancer patient Hazel Grace Lancaster, who is forced by her parents to attend a support group in the "Literal Heart of Jesus" where she subsequently meets and falls in love with seventeen-year-old Augustus Waters, an ex-basketball player, as well as an amputee.</p>
                <button>Read More</button>
                <div class="more">
                  <p><b>Director: </b>Josh Boone</p>
                  <p><b>Crew: </b>Shailene Woodley, Ansel Elgort, Nat Wolff</p>
                  <iframe src="https://www.youtube.com/embed/9ItBvH5J6ss" style="width: 99% !important;height: 400px;margin: 0 auto;" allowfullscreen></iframe>
                </div>
            </div>
            
            <div class="description" id="4">
                <img class="age" src="<?php echo asset_url(); ?>images/ratings/MA.png" alt="ageguidance" />
                <p> <b>IMDB Rating</b> - 8</p>
                <p> <b>Rotten Tomato Rating</b> - 89%</p>
                <p> <b>Genre</b> - Thriller, Suspense</p>
                <p>Life of Pi is a Canadian fantasy adventure novel by Yann Martel published in 2001. The protagonist, Piscine Molitor ″Pi″ Patel, an Indian boy from Pondicherry, explores issues of spirituality and practicality from an early age. He survives 227 days after a shipwreck while stranded on a lifeboat in the Pacific Ocean with a Bengal tiger named Richard Parker.</p>
                <button>Read More</button>
                <div class="more">
                  <p><b>Director: </b>Ang Lee</p>
                  <p><b>Crew: </b>Suraj Sharma, Irrfan Khan, Rafe Spall, Gérard Depardieu, Tabu, and Adil Hussain.</p>
                  <iframe src="https://www.youtube.com/embed/j9Hjrs6WQ8M" style="width: 99% !important;height: 400px;margin: 0 auto;" allowfullscreen></iframe>
                </div>
            </div>
            
            <h2>CHOOSE SHOW TIME:</h2>
             <table id="datemob">
             <tr>
               <th>Monday</th>
               <td></td>
             </tr>
             <tr>
               <th>Tuesday</th>
               <td></td>
             </tr>
             <tr>
               <th>Wednesday</th>
               <td></td>
             </tr>
             <tr>
               <th>Thursday</th>
               <td></td>
             </tr>
             <tr>
               <th>Friday</th>
               <td></td>
             </tr>
             <tr>
               <th>Saturday</th>
               <td></td>
             </tr>
             <tr>
               <th>Sunday</th>
               <td></td>
             </tr>
           </table>
            <table id="datetime">
              <tr>
                <th>Monday</th>
                <th>Tuesday</th>		
                <th>Wednesday</th>
                <th>Thursday</th>
                <th>Friday</th>
                <th>Saturday</th>
                <th>Sunday</th>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              
            </table>
          </div>
         <div class="container">
          
        </div>
        
        <div class="container">
            <form action="http://titan.csit.rmit.edu.au/~e54061/wp/testbooking.php" method='post'>
               <h2 class="seathead">SELECT SEATS:</h2>
                <table id="ticket" style="display: table;width: 100%;">
              <tr>
                <th>Ticket Type</th>
                <th>Quantity</th>		
                <th>Subtotal</th>
              </tr>
              <tr>
                <td>Normal Adult</td>
                <td>
                    <div onclick="settheatre('SA');" >Add Seats</div>
                </td>
                <td style="text-align: center;"><input type="hidden" name="SA" value="1"> AUD 0.00</td>
              </tr>
              <tr>
                <td>Normal Concession</td>
                <td>
                    <div onclick="settheatre('SP');">Add Seats</div>
                </td>
                <td style="text-align: center;"><input type="hidden" name="SP" value="1"> AUD 0.00</td>
              </tr>
              <tr>
                <td>Normal Child</td>
                <td>
                    <div onclick="settheatre('SC');">Add Seats</div>
                </td>
                <td style="text-align: center;"><input type="hidden" name="SC" value="1"> AUD 0.00</td>
              </tr>
              <tr>
                <td>First Class Adult</td>
                <td>
                    <div onclick="settheatre('FA');">Add Seats</div>
                </td>
                <td style="text-align: center;"><input type="hidden" name="FA" value="0"> AUD 0.00</td>
              </tr>
              <tr>
                <td>First Class Child </td>
                <td>
                    <div onclick="settheatre('FC');">Add Seats</div>
                </td>
                <td style="text-align: center;"><input type="hidden" name="FC" value="0"> AUD 0.00</td>
              </tr>
              <tr>
                <td>Beanbag - 1 Person </td>
                <td>
                    <div onclick="settheatre('B1');">Add Seats</div>
                </td>
                <td style="text-align: center;"><input type="hidden" name="B1" value="0"> AUD 0.00</td>
              </tr>
              <tr>
                <td>Beanbag - 2 People</td>
                <td>
                    <div onclick="settheatre('B2');">Add Seats</div>
                </td>
                <td style="text-align: center;"><input type="hidden" name="B2" value="0"> AUD 0.00</td>
              </tr>
              <tr>
                <td>Beanbag - 3 children  </td>
                <td>
                    <div onclick="settheatre('B3');">Add Seats</div>
                </td>
                <td style="text-align: center;"><input type="hidden" name="B3" value="0"> AUD 0.00</td>
              </tr>
              
              <tr>
                <td style="text-transform: uppercase;"><b>Total price </b></td>
                <td style="text-align: center;">
                <input id="price" type="hidden" name="price" value="0">
                <input type="hidden" name="movie" value="0">
                <input type="hidden" name="day" value="0">
                <input type="hidden" name="time" value="0">
                </td>
                <td><input id="formsubmit" type="submit" value="Get Ticket"></td>
              </tr>
              
            </table>
            </form> 
        </div>


        <div id="theatre" class="white_content">
          <div class="NT1">
            <button id="B1">B1</button>
            <button id="B2">B2</button>
            <button id="B3">B3</button>
            <button id="B4">B4</button>
            <button id="B5">B5</button>
            <br>
            <button id="B11">B11</button>
            <button id="B12">B12</button>
            <button id="B13">B13</button>
            <button id="B14">B14</button>
            <button id="B15">B15</button>
            <br>
            <button id="B21">B21</button>
            <button id="B22">B22</button>
            <button id="B23">B23</button>
            <button id="B24">B24</button>
            <button id="B25">B25</button>
            <br>
            <button id="B31">B31</button>
            <button id="B32">B32</button>
            <button id="B33">B33</button>
            <button id="B34">B34</button>
            <button id="B35">B35</button>
            <br>
          </div>
          <div class="FT">
            <button id="A1">A1</button>
            <button id="A2">A2</button>
            <button id="A3">A3</button>
            <button id="A4">A4</button>
            <br>
            <button id="A5">A5</button>
            <button id="A6">A6</button>
            <button id="A7">A7</button>
            <button id="A8">A8</button>
            <br>
            <button id="A9">A9</button>
            <button id="A10">A10</button>
            <button id="A11">A11</button>
            <button id="A12">A12</button>
            <br>
          </div>
          <div class="NT2">
            <button id="B6">B6</button>
            <button id="B7">B7</button>
            <button id="B8">B8</button>
            <button id="B9">B9</button>
            <button id="B10">B10</button>
            <br>
            <button id="B16">B16</button>
            <button id="B17">B17</button>
            <button id="B18">B18</button>
            <button id="B19">B19</button>
            <button id="B20">B20</button>
            <br>
            <button id="B26">B26</button>
            <button id="B27">B27</button>
            <button id="B28">B28</button>
            <button id="B29">B29</button>
            <button id="B30">B30</button>
            <br>
            <button id="B36">B36</button>
            <button id="B37">B37</button>
            <button id="B38">B38</button>
            <button id="B39">B39</button>
            <button id="B40">B40</button>
            <br>
          </div>
          <div class="BT">
            <button id="C1">C1</button>
            <button id="C2">C2</button>
            <button id="C3">C3</button>
            <button id="C4">C4</button>
            <button id="C5">C5</button>
            <button id="C6">C6</button>
            <br>
            <button id="C7">C7</button>
            <button id="C8">C8</button>
            <button id="C9">C9</button>
            <button id="C10">C10</button>
            <button id="C11">C11</button>
            <button id="C12">C12</button>
            <br>
          </div>
          <div style="margin-left: 40%; margin-right: 40%;  background-color: white;color: black;font-weight: bolder;text-align: -webkit-center;padding: 20px;" onclick="document.getElementById('theatre').style.display='none';document.getElementById('fade').style.display='none';">OK</div>
        </div>
        <div id="fade" class="black_overlay" onclick="document.getElementById('theatre').style.display='none';document.getElementById('fade').style.display='none';"></div>

        
        </main>






<?php include_once("footer.php") ?>
