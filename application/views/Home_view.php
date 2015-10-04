
<?php include_once("header.php") ?>


        <main>
            <div id="carousel">
                <img class="active" src="<?php echo asset_url(); ?>images/empty-cinema.jpg" alt="empty cinema" />
            </div>
                
             <div id="about">
            <div class="container">
                <h1>WHATS NEW ?</h1>
                <div class="item">
                <img src="<?php echo asset_url(); ?>images/details/3d.jpg" alt="3d" />
                <p>New 3D Projection Technology</p>
                </div>
                <div class="item">
                <img src="<?php echo asset_url(); ?>images/details/seats.jpg" alt="seats" />
                <p>Upgraded New Seats with an addition of 12 Beanbag Seats</p>
                </div>
                <div class="item">
                <img src="<?php echo asset_url(); ?>images/details/dolby.jpg" alt="dolby" />
                <p>New Dolby Lighting and Sounds</p>
                 </div>

            </div>
            </div>
            
            <div class="container" id="newMovies">
                <h1>CURRENTLY PLAYING</h1>
                <div>
                    <img class="movies" src="<?php echo asset_url(); ?>images/thumbnails/avengers.png" id="1" alt="avengers" />
                    <button onclick="redirecthome(1);">View Details</button>
                </div>
                <div>
                    <img class="movies" src="<?php echo asset_url(); ?>images/thumbnails/incredibles.png" id="2" alt="incredibles" />
                    <button onclick="redirecthome(2);">View Details</button>
                </div>
                <div>
                    <img class="movies" src="<?php echo asset_url(); ?>images/thumbnails/FaultInOurStars.png" id="3" alt="FaultInOurStars" />
                    <button onclick="redirecthome(3);">View Details</button>
                </div>
                <div>
                    <img class="movies" src="<?php echo asset_url(); ?>images/thumbnails/lifeofpi.png" id="4" alt="lifeofpi" />
                    <button onclick="redirecthome(4);">View Details</button>
                </div>
            </div>
            
            
           
        </main>

<?php include_once("footer.php") ?>