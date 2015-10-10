function ClientCheckCode(var1)
    {
        if (var1.length == 12)
        {
            dummy = var1[0] + var1[1] + var1[2] + var1[3] + var1[4] + var1[5] + var1[6] + var1[7] +
                var1[8] + var1[9] + var1[10].toUpperCase() + var1[11].toUpperCase();
            var1 = dummy;
            console.log(var1, "Final output");
            return true;
        }
        else if (var1.length == 14)
        {
            if (var1[5] == "-" && var1[11] == "-")
            {
                dummy = var1[0] + var1[1] + var1[2] + var1[3] + var1[4] + var1[6] + var1[7] + var1[8] +
                var1[9] + var1[10] + var1[12].toUpperCase() + var1[13].toUpperCase();
                var1 = dummy;
                console.log(var1, "Final output2");
                return true;
            }
           else
            {
                alert("The code you entered is not formatted correctly");
                return false;
            }
        }
        else
        {
            alert("The code you entered is not formatted correctly");
            return false;
        }
    }