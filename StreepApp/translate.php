<!-- data uit MySQL zijn standaard in het Engels, dit vertaalt het naar Nederlands !-->
<?php
function translate_names($eng) {
    $names = array (
      'Januari' => 'January',
      'Februari' => 'February',
      'Maart' => 'March',
      'April' => 'April',
      'Mei' => 'May',
      'Juni' => 'June',
      'Juli' => 'July',
      'Augustus' => 'August',
      'September' => 'September',
      'Oktober' => 'October',
      'November' => 'November',
      'December' => 'December',
);
    return array_search($eng, $names);
}
?>