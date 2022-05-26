 <?php

    // **************  Indexed Array        ***********************************************************

    $arr = ["Water", "FIRE", 33, "Humans", "Animals"];
    // var_dump($arr);
    echo ("<pre>");
    print_r($arr);
    echo ("</pre>");
    // *****************     Associative Arrays     *****************************************
    $AssoArray = array('Kunal' => 40, "Sonal" => 35, "Amaira" => 5);
    echo "<pre>";
    print_r($AssoArray);
    echo "</pre>";
    //*********         Multi dimensional Array ******************************** *
    $multiDimArray = array(
        "Father" => array("name" => "Kunal", "gender" => "Male", "Age" => 40),
        "Mother" => array("name" => "Sonal", "gender" => "female", "Age" => 35),
        "Daughter" => array("name" => "Amaira", "gender" => "female", "Age" => 5),
    );


    // !    1. ADD to an Array : array_push()

    //! Either use array_push() OR simply $arr[]=393. This'll add 393 at the end just like array_push(). This works
    // ! for all kinds pf array i.e. indexed Array, Associative arrays or multiDimewnsional Arrays. 

    print_r(array_push($arr, 100));      // Pushes aka ADDS the 2nd arguement at the end of the array. Used for adding to the array
    // RETURNS the number of elements ion the Array. 
    echo "<pre>";
    print_r($arr);
    echo "</pre>";
    // *********************************************************************************************

    echo "<pre>";
    print_r($AssoArray);
    print_r(array_merge($AssoArray, ["MOM" => 70]));    // if you need to add to the end of an Associative array, 
    //  then array_push will not work. Use array_merge. make an additional associatve array and then MERGE the two arrays
    // RETURNS the resulting array
    echo "</pre>";
    // *********************************************************************************************

    $multiDimArray["Helper"] =  array("name" => "Komal", "gender" => "female", "Age" => 21);
    echo "<pre>";
    print_r($multiDimArray);
    echo "</pre>";


    // ! 2. REMOVE from an Array   :: array_shift()
    echo ("<pre>");
    print_r(array_shift($arr) . "<br>");          // Removes the element from the beginning of an Array. RETURNS the removed element
    print_r($arr);
    echo ("</pre>");


    //! 3.  Change the value at a particular index in an array. Simply REASSIGN a new value: This overwrites the old value

    print_r($arr[2]);
    $arr[2] = "Elements Of Nature";
    echo ("<pre>");
    print_r($arr);


    //! 4.  check and Returns the length of an Array:           count()
    echo count($arr) . "<br>";
    echo count($AssoArray);
    echo "<pre>";
    print_r($AssoArray);
    echo "</pre>";


    echo "<pre>";
    print_r($multiDimArray);
    echo "</pre>";



    //!     5   in_array(): To check if a value exists within an array

    if (in_array("FIRE", $arr)) {
        echo "Element Exists <br>";
    } else {
        echo "No, Doesnt Exists";
    };


    //!     6   array_key_exists()  :   

    if (array_key_exists("Kunal", $AssoArray)) {
        echo "Key exists <br>";
    } else {
        echo "key DOESNT exists";
    };

    //!     7   array_unshift()         :: Adds an element/s to the beginning of an Array :

    array_unshift($arr, "EARTH");

    echo "<pre>";
    print_r($arr);
    echo "</pre>";

    //!     8   end()         :: gives the value of the last element

    echo (end($arr));
    echo (end($multiDimArray));
    ?>