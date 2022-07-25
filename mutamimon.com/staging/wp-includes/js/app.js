
// get data from database 

var productRef = firebase.database().ref('products');

productRef.once("value" , (snapshot)=>{
    snapshot.forEach((element)=>{
        console.log(element.val());
    })
})