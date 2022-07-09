<?php
$mysession = $_SESSION['uniqueid'];
$count = count($data);
for ($i = 0; $i < $count; $i++) {
    if ($data[$i]['sender_message_id'] == $mysession) {
?>
        <div id="receiver_msg_container">
            <div id="receiver_msg">
                <p class="m-0" id="receiver_ptag"><?php echo $data[$i]['message']; ?></p>
            </div>
            <div id="receiver_image" style="background-size: 100% 100%; background-image:url('<?php echo "../upload/" . $_SESSION['image']; ?>')"></div>
        </div>
    <?php
    } else {
    ?><div id="sender_msg_container">
            <div id="sender_image" style="background-size: 100% 100%; background-image:url('<?= base_url('/assets/img/undraw_profile.svg') ?>')"></div>
            <div id="sender_msg">
                <p class="m-0" id="receiver_ptag"><?php echo $data[$i]['message']; ?></p>
            </div>
        </div>
<?php
    }
}
?>