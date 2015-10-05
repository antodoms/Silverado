 
<?php include_once("header.php") ?>

<main>
            <div id="contact">
            <div class="container">
                <h2>Contact Us</h2>
                
                <form method='post' action='http://titan.csit.rmit.edu.au/~e54061/wp/testcontact.php'>
                   
                    <p class="contact">Email:</p>
                    <p><input type="email" name='email' placeholder="Example@mail.com" style="color: black" required></p>
                    <p class="contact">Subject:</p> 
                    <p><select name='subject'>
                       <option value="General Enquiry">General Enquiry</option>
                       <option value="Group and Corporate bookings">Group and Corporate bookings</option>
                       <option value="Suggestions and Complaints">Suggestions and Complaints</option>
                    </select></p>
                    <textarea name='message' rows="10" cols="70" placeholder="Write datails here" required></textarea>
                    <input type="submit" value="Submit">
                    
                </form>
                
            </div>
            </div>
        </main>



<?php include_once("footer.php") ?>