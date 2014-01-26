<?php
require_once ('view/header.php');
?>

<style>
    .overlay {
        background: none repeat scroll 0 0 #FFFFFF;
        height: 100%;
        left: 0;
        opacity: 0.8;
        position: absolute;
        top: 0;
        width: 100%;
    }
    .notifications {
        background: none repeat scroll 0 0 #FFFFFF;
        border: 1px solid #D3D3D3;
        height: 80%;
        left: 50%;
        margin-left: -40%;
        margin-top: -2em;
        position: fixed;
        top: 10%;
        width: 80%;
    }

    .notifications_top_bar {
        width:100%;
        height:2em;
        background-color: #4C66A4;

    }
    .notifications_top_bar span {
        font-size: 1.4em;
        color: #FFFFFF;
        display: block;
        font-weight: 200;
        margin: 0;

        padding-left: 0.3em;
        padding-top: 0.1em;
    }


    .notifications ul {
        list-style: none outside none;
        margin: 0 auto;
        padding: 10px 0;
        width: 100%;
    }

    .notifications ul li {
        border-bottom: 1px dashed #999999;
        color: #000000;
        min-height: 2em;
        margin-bottom: 5px;
        padding-bottom: 5px;
        width: 100%;
    }

    .notifications ul li a {
        color: #000000;

        height: 100%;
        margin: 4px auto 0 1em;
        vertical-align: top;
    }
</style>
	<div class="header">
		<div class="buttons">
			<div class="home">
				<a href="/Home/index"><img src="/images/home.jpeg" alt="home" width='49px' height='40'>
				</a>
			</div>
			<div class="title"><h1>Wx Alerts</h1></div>
			<div class="menu">
				<a href="/Settings/index"><img src="/images/menu.png" alt="menu"></a>
			</div>
			
		</div>
	</div>
	<div class="main">
	<ul>
		<li>
			<a href="/Wishlist/listItems"><img src="/images/avatar.png" alt="alerta" class="icons"><p>Alerta produs</p></a>
			<img src="/images/next.png" alt="next"class="next">
		</li>
		<li><a href="/Recurrent/index"><img src="/images/recurent_shopping.jpg" alt="recurent" class="icons"><p>Cumparaturi recurente</p></a>
			<img src="/images/next.png" alt="next" class="next">
		</li>
		<li><a href="/Random/index"><img src="/images/product_day.png" alt="alerta" class="icons"><p>Produsul zilei</p></a>
			<img src="/images/next.png" alt="next" class="next">
		</li>
		<li><a href="/Settings/index">
			<img src="/images/setup.png" alt="alerta" class="icons"><p>Setari</p></a>
			<img src="/images/next.png" alt="next" class="next">
		</li>
	</ul>
	</div>
<?php
if ( isset($data['notifications']) && count($data['notifications']) > 0 ) {
?>
    <div id="overlay" class="overlay"></div>
    <div id="notifications" class="notifications">
        <div class="notifications_top_bar">
            <span style="float:left">Notificari</span>
            <span style="float:right">
                <a href="javascript:void(0)" onclick="hideNotifications()">
                    <img src="/images/close_a_32.png">
                </a>
            </span>
        </div>

        <ul>
        <?php

        foreach ($data['notifications'] AS $notification) {

            if ($notification->getListType() == Notifications_Model::LIST_TYPE_WISHLIST) {
                $url = '/Wishlist/productDetail/?listId=' . $notification->getListId() . '&productId=' . $notification->getProductId();
                $imageUrl = '/images/avatar.png';
            } else {
                $url = '/Recurrent/listProducts/?id=' . $notification->getListId();
                $imageUrl = '/images/recurent_shopping.jpg';
            }
            ?>

            <li id="notification_container_<?=$notification->getId()?>">
                <img class="icons" alt="alerta" src="<?=$imageUrl?>"  style="width:1.7em;height:1.7em;margin-left:1em;">
                <a href="<?=$url?>"> <?=$notification->getContent()?> </a>

                <a href="javascript:void(0)" onclick="deleteNotification(<?=$notification->getId()?>)">
                    <img src="/images/close_a_32.png" style="width:1em;height:1em;">
                </a>
                <div style="clear:both"></div>
            </li>
            <?php
        }
        ?>
        </ul>
    </div>
    <script type="text/javascript">
        function hideNotifications() {
            document.getElementById('overlay').style.display = 'none';
            document.getElementById('notifications').style.display = 'none';
        }

        function deleteNotification(notificationId) {
            document.getElementById('notification_container_' + notificationId).remove();

            var xmlhttp;
            if (window.XMLHttpRequest)
            {// code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp=new XMLHttpRequest();
            }
            else
            {// code for IE6, IE5
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }

            xmlhttp.open("GET","/Wishlist/removeNotification/?notification_id=" + notificationId,true);
            xmlhttp.send();
        }
    </script>
<?php
}

require_once ('view/footer.php');