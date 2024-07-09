@if(Session::get('success', false))
    <?php $data = Session::get('success'); ?>
    <div id="toaster"></div>
        
        <!-- <div id="created"></div> -->
    
@endif