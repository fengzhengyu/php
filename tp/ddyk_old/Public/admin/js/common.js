


 //导航的hover效果、二级菜单等功能，需要依赖element模块
layui.use('element', function(){
    var element = layui.element; //导航的hover效果、二级菜单等功能，需要依赖element模块
})
 //弹框模块 
layui.use('layer', function(){
    var layer = layui.layer;
})

//执行一个laydate实例 时间选择器
layui.use('laydate', function(){
    var laydate = layui.laydate;
     
    laydate.render({
        elem: '#startTime' //指定元素
    });
    laydate.render({
        elem: '#endTime' //指定元素
    });
   
  });
$(function(){

    //会员左侧导航栏

    $('.side-nav-item').click(function(){

        if(!$(this).hasClass("active")){
            $(this).addClass('active');
            $(this).siblings('dl').slideToggle(500);
        }else{
            $(this).removeClass('active');
            $(this).siblings('dl').slideToggle(500);
        }
    
    });
       //  //左侧菜单选中
    var urlstr = location.href;
    console.log(urlstr)
  
    $('.side-nav-child-wrapper a').each(function () {
      
        if((urlstr).indexOf($(this).attr('href')) != -1 && $(this).attr('href') != "" ){
          
            $(this).parents('dl').siblings('.side-nav-item').addClass('active');
            $(this).parents('dl').slideToggle(500);
        }
    });
       //全选
    $("table thead th input:checkbox").on("click" , function(){
        $(this).closest("table").find("tr > td:first-child input:checkbox").prop("checked",$("table thead th input:checkbox").prop("checked"));
    });
	
})
