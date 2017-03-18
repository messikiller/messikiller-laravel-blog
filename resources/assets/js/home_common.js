;$(document).ready(function()
{
    // nprogress and pjax configure
    NProgress.configure({
        template: '<div class="bar" role="bar" style="height:3px;background:#3498db;">'
        +'<div class="peg"></div></div><div class="spinner" role="spinner">'
        +'<div class="spinner-icon" style="border-left-color:#eaeaea;border-top-color:#eaeaea;"></div></div>'
    });
    $(document).pjax('a', '#pjax-container').on('pjax:timeout', function(event){
        event.preventDefault();
    }).on('pjax:start', function(){
        NProgress.start();
    }).on('pjax:end', function(){
        NProgress.done();
    });

    // navbar configure
    $('.catebar > li > a').hover(function(){
        $(this).next('ul.children').show();
    }, function(){
        $(this).next('ul.children').hide();
    });

    $('.catebar > li > ul.children').mouseover(function(){
        $(this).prev('a').children('i.fa-angle-left').removeClass('fa-rotate-270').addClass('fa-rotate-270');
        $(this).show();
    }).mouseout(function(){
        $(this).prev('a').children('i.fa-angle-left').removeClass('fa-rotate-270');
        $(this).hide();
    });

    // navbar stickup configure
    $('#navbar').stickUp();

    // footer image popover configure
    $('#footer .donation img').each(function(){
        $(this).popover({
            placement: 'top',
            trigger: 'hover',
            content: $(this).attr('alt'),
            tipClass: 'donate-tip'
        });
    });

    // sidebar content toggle btn
    $('#sidebar .sidebar-box .btn-sidebox-toggle').click(function(){
        if ($(this).children('i.fa').is('.fa-rotate-90')) {
            $(this).children('i.fa').removeClass('fa-rotate-90');
            $(this).parents('.sidebar-box').first().children('.siderbar-box-content').first().slideDown('fast');
        } else {
            $(this).children('i.fa').addClass('fa-rotate-90');
            $(this).parents('.sidebar-box').first().children('.siderbar-box-content').first().slideUp('fast');
        }
    });

    // tooltip
    $('[data-toggle="tooltip"]').tooltip();
});
