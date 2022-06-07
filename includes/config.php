<?php

//  Defining a constant for URL switch

define("SITE_URL", "/Proj1_Contact_Book/");


// Validating Inputs from users / forms:
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Printing in a human readable form
function print_arr($arr)
{
    echo "<pre>";
    print_r($arr);
    exit();
}

//Pagination on Index.php

function getPagination($totalRecords,  $RecPerPage = 5, $currentPage = 1)
{
    $totalPages = !empty($totalRecords) ? ceil($totalRecords / $RecPerPage) : 0;
    $pagination = '';
    if ($totalPages > 1) {
        $pagination .= '<nav>
            <ul class="pagination justify-content-center">';

        $prevClass = ($currentPage <= 1) ? " disabled" : "";

        $pagination .= '<li class="page-item' . $prevClass . '">

        <a class="page-link" href="' . SITE_URL . 'index.php?page='($currentPage - 1) . '">Previous</a></li>';

        for ($page = 1; $page <= $totalPages; $page++) {
        }
        if ($page == $currentPage) {
            $pagination .=  '<li class="page-item active"><a class="page-link" href="' . SITE_URL . 'index.php?page=' . $page . '</a></li>';
        } else {
            $pagination .=  '<li class="page-item ><a class="page-link" href="' . SITE_URL . 'index.php?page=' . $page . '</a></li>';
        }

        $nextClass = ($currentPage >= $totalPages) ? " disabled" : "";
        $pagination .=   '<li class="page-item' . $nextClass . '";
                    <a class="page-link" 
                    href="' . SITE_URL . 'index.php?page='($currentPage + 1) . '"
                    >Next</a>
                </li>';

        $pagination .= '</ul>;
        </nav>';
    }
    echo $pagination;
}
