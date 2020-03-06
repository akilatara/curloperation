<?php
    $url = "http://localhost/curloperation/table.html";
    $html = file_get_contents($url);
    libxml_use_internal_errors(true);
    $doc = new \DOMDocument();
    if($doc->loadHTML($html))
    {
        $result = new \DOMDocument();
        $result->formatOutput = true;
        $table = $result->appendChild($result->createElement("table"));
        $thead = $table->appendChild($result->createElement("thead"));
        $tbody = $table->appendChild($result->createElement("tbody"));

        $xpath = new \DOMXPath($doc);

        $newRow = $thead->appendChild($result->createElement("tr"));

        foreach($xpath->query("//table[@id='tbl-datatable']/thead/tr/th[position()>1]") as $header)
        {
            $newRow->appendChild($result->createElement("th", trim($header->nodeValue)));
        }

        foreach($xpath->query("//table[@id='tbl-datatable']/tbody/tr") as $row)
        {
            $newRow = $tbody->appendChild($result->createElement("tr"));

            foreach($xpath->query("./td[position()>1 and position()<7]", $row) as $cell)
            {
                $newRow->appendChild($result->createElement("td", trim($cell->nodeValue)));
            }
        }

        echo $result->saveXML($result->documentElement);
    }
    ?>