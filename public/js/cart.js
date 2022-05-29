function getCart(){
    let cart= localStorage.getItem("cart");
    cart=JSON.parse(cart);
    return cart;
}

function save(item){
    let cart= localStorage.getItem("cart");

    if(cart!=null){
      if(!itemExists(item.item_id)){
        cart=JSON.parse(cart);
        cart.push(item);
        localStorage.setItem("cart", JSON.stringify(cart));
      }else{
        QtyUp(item.item_id,item.qty);
      }

    }else{
      cart=[];
      cart.push(item);
      localStorage.setItem("cart", JSON.stringify(cart));
    }
 }


 function QtyUp(id,qty){
    //console.log(id)
    let cart= localStorage.getItem("cart");
    if(cart!=null){
      cart=JSON.parse(cart);   
      let tmp=[]; 
      

     cart.forEach(function(item,i){

      if(id==item.item_id){
        
           item.qty+=qty;
           discount= item.discount*item.qty;
           item.total_discount=discount;
           item.subtotal=(item.qty*item.price)-(discount);
          
          // console.log(item);
           tmp.push(item);
         }else{
           tmp.push(item);
         }

     });

                
      localStorage.setItem("cart", JSON.stringify(tmp));
    }
 }


 function itemExists(id){
    let found=0;
    let cart= localStorage.getItem("cart");
    if(cart!=null){
      cart=JSON.parse(cart);  

      cart.forEach(function(item,i){
        if(id==item.item_id){
          found=1;                
         }

      });


    }else{
      found=0;
    }

    return found;
 }

 function delItem(id){
    let cart= localStorage.getItem("cart");
    if(cart!=null){
      cart=JSON.parse(cart);   
      let tmp=[];    

    cart.forEach(function(item,i){
         if(id!=item.item_id){
          tmp.push(item);
         }
      });

      localStorage.setItem("cart",JSON.stringify(tmp));
    }
 }


 function clearCart(){
      localStorage.removeItem("cart");
      cart=[];            
      localStorage.setItem("cart", JSON.stringify(cart));
    
 }    