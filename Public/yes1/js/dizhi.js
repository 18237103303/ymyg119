function dizhi(zhi) {
    var arr= zhi.split('-');
    var arr0=arr[0];
    var arr1=arr[0]?'0,'+arr[0]:'';
    var arr2=arr[1]?'0,'+arr[0]+','+arr[1]:'';
    var arr3=arr[1]?arr[1]:'';
    var arr4=arr[2]?arr[2]:'';
    var loc	= new Location();
    var arr8='';var arr9='';var arr10='';
    if(arr0){
        var arr5=eval('(' + loc.zhi(0) + ')');
        arr8=arr5[arr0];
    }
    if(arr3){
        var arr6=eval('(' + loc.zhi(""+arr1+"") + ')');
        arr9=arr6[arr3];
    }
    if(arr4){
        var arr7=eval('(' + loc.zhi(""+arr2+"") + ')');
        arr10=arr7[arr4];
    }
    return arr8+arr9+arr10;
}