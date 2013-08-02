<form class="navbar-search" action="">
    <input type="text" class="twitter-typeahead search-query span4" placeholder="Search for trooths, trooth rooms and true friends" autocomplete="off" spellcheck="false" dir="auto">
</form>
<ul class="nav pull-right">

    <li><a href="#">John Smith</a></li>
    <li><?php echo anchor("home/", "Home");?></li>

    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="<?php echo base_url()?>img/setting.png"/></a>
        <ul class="dropdown-menu">
            <li><a href="#">Account Setting</a></li>
            <li><?php echo anchor("user/logout/", "Logout");?></li>
        </ul>
    </li>
</ul>