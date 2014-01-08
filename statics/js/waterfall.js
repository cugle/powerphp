/**
 *waterfall.js�ļ�
 * �ٲ������
 * @author    Gardenia <fooying@qq.com>
 * window.onload = function(){
 *        waterfallinit({:''})//���ò���
 *        function success(data){}//��ӽڵ㺯��������true 
 *    }
 *ֻ��Ϊ�ٲ�����ʼ������ waterfallinit
 *����һ�º���
 *����ID��                parent:'main',
 *����ID��                 pin:'pin',
 *�ж�ajax�Ƿ񷵻سɹ���    successFn:success,
 *loading��ʾ��ͼƬ��ַ     loadImgSrc:'./pic/load.gif',
 *û�и���������ʾ��ͼƬ��ַ    endImg:'./pic/end.gif',
 *���������ַ                requestUrl:'request.php',
 *ÿ�������ͼƬ����Ĭ��15           requestNum:15,
 *ѡ����ʾʱ���,���Բ�����Ĭ��Ϊ1                style:4,
 *����loadingͼƬ��ID     loadImgId:loadImg,
 *
 *
 *������ݵ�html successFn����
    function success(data){
        var oParent = document.getElementById('main'); //��ȡ���ڵ�
        for(i in data){
                var oPin = document.createElement('div');
                oPin.className = 'pin';
                oParent.appendChild(oPin);
                var oBox = document.createElement('div');
                oBox.className = 'box';
                oPin.appendChild(oBox);
                var oImg = document.createElement('img');
                oImg.src = './pic/'+data[i].src;
                oBox.appendChild(oImg);
        }
        return true;
    }
}
 *
 *
 **/
 function waterfallinit(json){
    var parent = json.parent;
    var pin = json.pin;
    var successFn = json.successFn;
    var loadImgSrc = json.loadImgSrc;
    var endImgSrc = json.endImgSrc;
    var requestUrl = json.requestUrl;
    var requestNum = json.requestNum ? json.requestNum:10;
    var style = json.style;
    var loadImgId = json.loadImgId;
    var endImgId = json.endImgId;
    var oParent = document.getElementById(parent); //��ȡ���ڵ�
 /*�������*/
    ajaxRequest();
 /*����������ѭ������*/
    var ajaxState = true;
    var page = 0;
    var endData = true;             
    window.onscroll = function(){
        if(checkScrollSite() && ajaxState && endData){ 
            page++;
            ajaxState = false;
            ajaxRequest();
        }
    }
 /*�ж����ݿ����ݷ��������Ƿ�Ϊ��*/
    function checkData(data){
        var oParent = document.getElementById(parent); //��ȡ���ڵ�
        var bool = false;
        if(data[0] != undefined){
            bool = true;
        }else{
            bool = false;
        }
        return bool;
    }
 /*ajax����*/
    function ajaxRequest(){
            $.ajax({
                type:'GET',
                url:requestUrl,
                data:'page='+ page +'&requestNum=' + requestNum,
                dataType:'json',
                beforeSend:function(){
                    if(page){
                        var aPin = getClassObj(oParent,pin); //���ڵ��µ�class�ӽڵ�����
                        var lastPinH = aPin[aPin.length-1].offsetTop+
                            Math.floor(aPin[aPin.length-1].offsetHeight);
                        
                        addImg(loadImgSrc,loadImgId);
                    }
                },
                success:function(data){
                    if(successFn(data)){
                        waterfall(parent,pin,style);
                        endData = checkData(data);
                        if(!endData){
                            addImg(endImgSrc,endImgId);
                        }
                    }
                },
                complete:function(data){
                    if(page){
                        oParent.removeChild(document.getElementById(loadImgId));
                    }    
                    ajaxState = true;
                }
            })
    }
 /*У�������λ��*/
    function checkScrollSite(){
        //var aPin = getClassObj(oParent,pin); //���ڵ��µ�class�ӽڵ�����
        var scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
        var documentH = document.documentElement.clientHeight; 
        return getLastH()<scrollTop+documentH ? true:false;
    }
 /*��ȡ��ĩβ��̸߶�*/
    function getLastH(){
        var aPin = getClassObj(oParent,pin); //���ڵ��µ�class�ӽڵ�����
        var lastPinH = aPin[aPin.length-1].offsetTop+Math.floor(aPin[aPin.length-1].offsetHeight);
        return lastPinH;
    }    
    /*����ͼƬ��ǩ���磺loadingͼ��*/
    function addImg(src,id){
        var loadImg = document.createElement('img');
        loadImg.src = src;
        loadImg.id  = id;
        oParent.appendChild(loadImg);
        loadImg.style.position = 'absolute';
        loadImg.style.top = getLastH() + 'px';
        loadImg.style.left = Math.floor(oParent.offsetWidth - loadImg.offsetWidth)/2 + 'px';
            
    }
 }
 /*
*�ٲ�������
*
*/
 function  waterfall(parent,pin,style){
    var oParent = document.getElementById(parent); //��ȡ���ڵ�
    var aPin = getClassObj(oParent,pin); //���ڵ��µ�class�ӽڵ�����
    //alert(aPin.length);
    var iPinW = aPin[0].offsetWidth; //��ȡ�̶����
    var num = Math.floor(oParent.offsetWidth/iPinW); //��ȡ��������
    oParent.style.cssText = 'width:' + num*iPinW +'px;margin:0px auto;position:relative'; //���������
    
    var compareAarr = [];
    var copareAll =[];
    //alert(aPin.length);
    for(var i=0;i<aPin.length;i++){ //�����ӽڵ㳤��
        if(i<num){
            compareAarr[i] = aPin[i].offsetHeight;//��ȡÿ���ӽڵ�ĸ߶�
        }else{
            var minH = Math.min.apply('',compareAarr);//��ȡ��Сֵ
            var minKey = getMinKey(compareAarr,minH);//��ȡ��Сֵ�ļ�ֵ
            compareAarr[minKey] += aPin[i].offsetHeight;
            setmoveStyle(aPin[i],minH,aPin[minKey].offsetLeft,i,style);
        }
    }
 }
 /*
*ͨ��classѡ��Ԫ�� 
*/
 function getClassObj(parent,className){
    var obj = parent.getElementsByTagName('*');
    var result = [];
    for (var i = 0; i < obj.length; i++) {
        if (obj[i].className == className) {
            result.push(obj[i]);
        }
    }
    return result;
 }
 /**�����˶����
*setmoveStyle
*@param  obj ����
*@param  top ���벼�� 
*@param  left ���벼��
*@param  index 
*@param  style ��������ѡ��
*1���ӵ����м����
*2��͸���Ƚ���
*3�����������߷���
*4���Ӹ����½��ַ���
**/
 var startNum = 0;
 function setmoveStyle(obj,top,left,index,style){
    /*if(index <= startNum){
        return;
    }*/
    obj.style.position = 'absolute';
    switch(style){
        case 1: //�ӵ����м����
        obj.style.top = getTotalH() + 'px';
        obj.style.left = Math.floor((document.documentElement.clientWidth-obj.offsetWidth)/2) + 'px';
        $(obj).stop().animate({
            top:top,
            left:left
        },600);
        break;
        case 2://����
        obj.style.top = top + 'px';
        obj.style.left = left + 'px';
        obj.style.apacity = 0;
        obj.style.filter = 'alpha(opacity=0)';
        $(obj).stop().animate({
            opacity:1,
        },1000);
        break;
        case 3:
        obj.style.top = getTotalH() + 'px';
        if(index % 2){
            obj.style.left = -obj.offsetWidth + 'px';
        }else{
            obj.style.left = document.documentElement.clientWidth + 'px';
        
        }
        $(obj).stop().animate({
            top:top,
            left:left
        },1000);
        break;
        case 4:
        obj.style.top = getTotalH() + 'px';
        obj.style.left = left +'px';
        $(obj).stop().animate({
            top:top,
            left:left
        },1600);
        break;
    }
    //��������
    startNum = index;
 }
 /*��ȡ�������ĸ߶�,�ܸ߶�*/
 function getTotalH(){
    return document.documentElement.scrollHeight || document.body.scrollHeight; 
    
 }
 /** 
*��ȡͼƬ������Сֵ�ļ�ֵ
*
*/
 function getMinKey(arr,minH){
    for (key in arr) {
        if(arr[key] == minH){
            return key;
        }
    }
 }
 /*��ͼƬ�������ݴӶ��̶����֣�һ�㲻��*/
 function callBack(w,h,imgObj){
    //alert(w+':'+h);
    imgObj.style.width = 205 + 'px';
    var scale =  w/205;
    imgObj.style.height = Math.floor(h/scale)+ 'px';
 }
 /*�ȷ������ݹ̶��ò��ֺ�ͼ�����*/
 function loadImg(url,fn,imgObj){ 
    var img = new Image();
    img.src = url;
    if(img.complete){
        //alert(img.width);
        fn(img.width,img.height,imgObj);
    }else{
        img.onload = function(){
            fn(img.width,img.height,imgObj);
        }
    }
 }