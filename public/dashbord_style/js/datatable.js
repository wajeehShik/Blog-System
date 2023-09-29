$(document).ready(function(){
    $(document).on('input','#search_by_name',function(e){
    var search_by_name=$(this).val();
    var token_search=$("#token_search").val();
    var ajax_search_url=$("#ajax_search_url").val();
    console.log(
        ajax_search_url)
    jQuery.ajax({
      url:ajax_search_url,
      type:'post',
      dataType:'html',
      cache:false,
      data:{search_by_name:search_by_name,"_token":token_search},
      success:function(data){
       $("#ajax_responce_serarchDiv").html(data);
      },
      error:function(){
    
      }
    });
    });
    //status
    $('#search_by_status').change((e)=>{
      // console.log(e.target.value);
      
      var search_by_name=$("#search_by_name").val();
      var url=$("#ajax_search_url").val();
      var select_option=e.target.value;
      var token_search=$("#token_search").val();
      console.log(url)
      jQuery.ajax({
        url:url,
        type:'post',
        dataType:'html',
        cache:false,
        data:{search_by_name:search_by_name,select_option:select_option,"_token":token_search},
        success:function(data){
       
         $("#ajax_responce_serarchDiv").html(data);
        },
        error:function(){
      
        }
      });
          })
          //email
          $(document).on('input','#search_by_email',function(e){
            var search_by_email=$(this).val();
            var search_by_name=$('#search_by_name').val();
            var token_search=$("#token_search").val();
            var ajax_search_url=$("#ajax_search_url").val();
            jQuery.ajax({
              url:ajax_search_url,
              type:'post',
              dataType:'html',
              cache:false,
              data:{search_by_email:search_by_email,search_by_name:search_by_name,"_token":token_search},
              success:function(data){
               $("#ajax_responce_serarchDiv").html(data);
              },
              error:function(){
              }
            });
            });
//mobile search_by_mobile
$(document).on('input','#search_by_mobile',function(e){
  var search_by_mobile=$(this).val();
  var search_by_name=$('#search_by_name').val();
  var search_by_email=$('#search_by_email').val();
  var token_search=$("#token_search").val();
  var ajax_search_url=$("#ajax_search_url").val();
  jQuery.ajax({
    url:ajax_search_url,
    type:'post',
    dataType:'html',
    cache:false,
    data:{search_by_mobile:search_by_mobile,search_by_name:search_by_name,search_by_email:search_by_email,"_token":token_search},
    success:function(data){
     $("#ajax_responce_serarchDiv").html(data);
    },
    error:function(){
    }
  });
  });

    $(document).on('click','#ajax_pagination_in_search a ',function(e){
        console.log(e);
    e.preventDefault();
    var search_by_name=$("#search_by_name").val();
    var url=$(this).attr("href");
    var token_search=$("#token_search").val();
    
    jQuery.ajax({
      url:url,
      type:'post',
      dataType:'html',
      cache:false,
      data:{search_by_name:search_by_name,"_token":token_search},
      success:function(data){
     
       $("#ajax_responce_serarchDiv").html(data);
      },
      error:function(){
    
      }
    });
    });
    });