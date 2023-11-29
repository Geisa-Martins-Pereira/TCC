<div class="container">
    <div class="clock">
        <div id="controle-clock-toggle" class="<?php
                    if (!empty($_SESSION['page'])) {
                        echo 'clocka';
                    }
                    ?>">
            <div id="Datea" class="clock-time">
                  
            </div>
            <div class="horas">
                <div id="hoursa" class="clock-time"></div>
                <div id="space" class="clock-time">:</div>
                <div id="mina" class="clock-time"></div>
            </div>
        </div>
    </div>
</div>