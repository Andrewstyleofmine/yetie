<?php
    function renderTemplate($path, $date = []) {
        $path = "../templates/{$path}";
        $resultHTML = "";
        if (!file_exists($path)) {
            return $resultHTML;
        }
        ob_start();
        extract($date);
        require_once($path);
        $resultHTML = ob_get_clean();
        return $resultHTML;
    }
    function format_price($price) {
        if ($price >= 1000) {
            $price = number_format($price, 0,'.', ' ');
        }
        return $price. "<b class=\"rub\">р</b>";
    }
    function count_time($expire_date) {
        $date_now = date_create(date("Y-m-d H:i:s"));
        $expire_date = date_create($expire_date);
        if ($date_now < $expire_date) {
            $date_diff = date_diff($expire_date, $date_now);
            $diff = $date_diff -> format('%D %H %I');
            $diff = explode(' ', $diff);
            $diff_array = [
              "days" => $diff[0],
              "hours" => $diff[1],
              "minutes" => $diff[2],
            ];
            $string_diff = $diff_array['days'].':'.$diff_array['hours'].':'.$diff_array['minutes'];
        } else {
            $string_diff = "Торги окончены";
        }
        return $string_diff;
    }

    function make_query($con, $sql, $query_data = []) {
        $stmt = db_get_prepare_stmt($con, $sql, $query_data);
        mysqli_stmt_execute($stmt);
        $data = mysqli_stmt_get_result($stmt);
        if ($data) {
            $result = mysqli_fetch_all($data, MYSQLI_ASSOC);

        }


        return $result;

    }
    function require_format_date($date, $is_correct_format = true) {
        $date = explode('.', $date);
        if (empty($date) or strlen($date[0]) > 2) {
            $is_correct_format = false;
        }
        return $is_correct_format;
    }
function make_insert_query($con, $sql, $query_data = []) {
    $stmt = db_get_prepare_stmt($con, $sql, $query_data);
    mysqli_stmt_execute($stmt);
    $data = mysqli_stmt_get_result($stmt);
    if ($data) {
        $result = mysqli_fetch_all($data, MYSQLI_ASSOC);

    }


    return $result;

}



