 <!-- delete -->
 <div class="modal" id="deleteCoateoryModel">
     <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content modal-content-demo">
             <div class="modal-header">
                 <h6 class="modal-title"> حذف الاشتراك</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
             </div>
             <form action="{{route($route)}}" method="POST">
                 {{ csrf_field() }}
                 <div class="modal-body">
                     <p>هل انت متاكد من عملية الحذف ؟</p><br>
                     <input type="hidden" name="id" id="cat_id_delete" value="">
                     <input class="form-control" name="name" id="delete_title" type="text" readonly>
                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                     <button type="submit" class="btn btn-danger">تاكيد</button>
                 </div>
         </div>
         </form>
     </div>
 </div>