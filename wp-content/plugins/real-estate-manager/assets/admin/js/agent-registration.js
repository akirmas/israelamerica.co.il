jQuery(document).ready(function($) {
    $('.form-meta-setting').find('span.title').removeClass('button-secondary widefat');

    $(".hard-coded-list li").draggable({
        connectToSortable : ".form-meta-setting ul",
        helper : "clone",
        start : function(event, ui) {
                // ui.helper.width('100%');
                // ui.helper.height('auto');
             },
        revert : "invalid",
        stop : function(event, ui) {
            $('.form-meta-setting').find('span.title').removeClass('button-secondary widefat');
            $('.form-meta-setting').find('li').removeClass('ui-draggable ui-draggable-handle').css({
                width: 'auto',
                height: 'auto'
            });

            $(".form-meta-setting ul").accordion( "refresh" );
        }
    });

    var active = false,
        sorting = false;
    var icons = {
        header: "dashicons dashicons-plus",
        activeHeader: "dashicons dashicons-minus"
    };

    $(".form-meta-setting ul")
    .accordion({
        icons: icons,
        autoHeight: false,
        header: "> li > span",
        collapsible: true,
        activate: function( event, ui){
            //this fixes any problems with sorting if panel was open 
            //remove to see what I am talking about
            if(sorting)
                $(this).sortable("refresh");   
        }
    })
    .sortable({
        revert : true,
        handle: ".title",
        placeholder: "ui-state-highlight",
        start: function( event, ui ){
            //change bool to true
            sorting=true;

            //find what tab is open, false if none
            active = $(this).accordion( "option", "active" ); 

            //possibly change animation here (to make the animation instant if you like)
            $(this).accordion( "option", "animate", { easing: 'swing', duration: 0 } );

            //close tab
            $(this).accordion({ active:false });
        },
        stop: function( event, ui ) {
            ui.item.children( ".title" ).triggerHandler( "focusout" );

            //possibly change animation here; { } is default value
            $(this).accordion( "option", "animate", { } );

            //open previously active panel
            $(this).accordion( "option", "active", active );

            //change bool to false
            sorting=false;
            // console.log(ui);
        }
    });

    $('.form-meta-setting').on('click', '.remove-field', function(event) {
        event.preventDefault();
        $(this).closest('li').remove();
        $(".form-meta-setting ul").accordion( "refresh" );
    });
});