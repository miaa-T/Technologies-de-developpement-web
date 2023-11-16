<?php
class DisplayPageView {
    public function displayHeader() {
        echo '<h2 id="titre" align="center"> Site Comparateurs de Smartphones</h2><br/>';
    }

    public function displayImage() {
        echo '<img src="./photo.jpg" ><br/>';
    }

    public function displayMenu() {
        echo '<div class="menu">
                <ul>
                    <li><a href="#">Accueil</a></li>
                    <li id="marques"><a href="#">Marques</a> <ul id="marques-list">
                            <li><a href="https://www.samsung.com/fr/">Apple</a></li>
                            <li><a href="https://www.samsung.com/fr/">Samsung</a></li>
                            <li><a href="https://www.samsung.com/fr/">Nokia</a></li>
                            <li><a href="https://www.samsung.com/fr/">Huawei</a></li>
                            <li><a href="https://www.samsung.com/fr/">Xiaomi</a></li>
                        </ul>
                    </li>
                    <li><a href="#">News</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>';
    }

    public function displayVideo() {
        echo '<video src="./video.mp4" width="400" height="400" preload="auto" controls autoplay></video>';
    }

    public function displayTable($data) {
        echo '<table border="1">
                <thead>
                    <tr>
                        <th></th>'; 
        $smartphones = [];
    
        foreach ($data as $row) {
            $smartphones[$row['Name_smartphone']] = true;
        }
    
        foreach (array_keys($smartphones) as $smartphone) {
            echo '<th>' . $smartphone . '</th>';
        }
    
        echo '</tr>
            </thead>
            <tbody>';
    
      
        $features = [];
        foreach ($data as $row) {
            $featureName = $row['Name_Features'];
            $smartphoneName = $row['Name_smartphone'];
            $features[$featureName][$smartphoneName] = $row['Value_Smartphone_Features'];
        }
        foreach ($features as $featureName => $smartphonesData) {
            echo '<tr>';
            echo '<td>' . $featureName . '</td>';
            foreach (array_keys($smartphones) as $smartphone) {
                $value = isset($smartphonesData[$smartphone]) ? $smartphonesData[$smartphone] : '';
                echo '<td>' . $value . '</td>';
            }
    
            echo '</tr>';
        }
    
        echo '</tbody></table>';
    }
    public function displayFooter() {
       echo' <br/>
        <br/>
        <a href="km_toubal@esi.dz" align-text="center">Contacter nous Via Email</a>';
    }
}
?>
